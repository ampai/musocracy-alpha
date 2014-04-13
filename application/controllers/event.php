<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

class Event extends CI_Controller

{


	function __construct()
	{
		parent::__construct();
		$this->load->library(array('session', 'tank_auth', 'spotify_lib'));
		$this->load->helper('url');

		if (!$this->tank_auth->is_logged_in()) {
			$this->session->set_flashdata('not_logged_in', 'You need to be registered to see that!');
			redirect('/auth/login/');
		}

		$this->load->library('form_validation', 'tank_auth');
		$this->load->model('Event_model');

	}

	function index()
	{

		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$this->dashboard();

		}
	}


	function create_event()
	{
		// AJAX processing for an event

		// If from AJAX, then process, otherwise, do nothing
		if ($this->input->is_ajax_request()) {
		

			$event_data = array(

				'id' => NULL,
				'name' => $this->input->post('event_name'),
				'access_code' => $this->_generate_access_code(),
				'host_id' => $this->tank_auth->get_user_id(),
				'start' => $this->input->post('event_time_start'),
				'end' => $this->input->post('event_time_end'),
				'max_users' => $this->input->post('guestcount')


				);

			$ins_id = $this->Event_model->create_event($event_data);
			
			if (!is_null($ins_id)) {

				// Insert occured succesfully, build output to drop into the Create Event section or div
				$event_data['event_id'] = $ins_id;
				$success_html = $this->load->view('snippets/event_create_success', $event_data, true);

				$return = array(
					'status' 	=> 'success',
					'message'	=> 'Event created succesfully',
					'html' 		=> $success_html

					);

				// Create a default playlist for the event, nothing needs to be shown 
				// default playlist creates an entry in event_playlists and not playlists table 
				//	because playlists table requires song_ids to be present, default will be empty...
				$this->Event_model->create_default_playlist($ins_id);



			}else{

				$return = array(
					'status' 	=> 'failed',
					'message'	=> 'Sorry, something caused an error, try again',
				

					);

			}

			echo json_encode($return);

				// End of AJAX processing
		}else{

			$this->index();
		}


	}

	// having trouble getting it to work 
	// function join()

	// {
	// 	//set the session variable that allows a user to be joined after
	// 	// performing a check to see if event name & access code pairs match up 
	// 	// other wise redirect user to home page with flashdata OR back to dashboard

	// 	$data['ename'] = $this->input->post('selected_event_name');
	// 	$data['ecode'] = $this->input->post('event_access_code');

	// 	$allow = $this->Event_model->let_me_in($data['ename'], $data['ecode']);
	// 	if ($allow) {
	// 		$data['access'] = "Allowed!";
	// 	}else{
	// 		$data['access'] = "Not allowed.";
	// 	}
	// 	$this->load->view('header');
	// 	$this->load->view('lobby/lobby', $data, FALSE);	
	// 	$this->load->view('footer');

	// }



	function dashboard()
	{

		// get user information
		$data['curr_username'] = $this->tank_auth->get_username();


		// get all event names
		$data['event_names_arr'] = $this->Event_model->get_all_event_names();

		$data['name_id'] = $this->Event_model->get_all_event_name_id_pairs();
		
		$this->load->view('header');
		$this->load->view('event/dashboard', $data);
		$this->load->view('footer');

	}


	function lobby($event_id){
		//check if lobby exists
		//	->fetch some lobby details:
		//		->build the lobby playlist
		// 		->fetch the list of guests


		//check if joining user is the host, then set the flag in session
		//	 -> this allow for administrative controls to be enabled for user in lobby home view

		//get some data about current user
		$data['host_name'] = $this->tank_auth->get_username();
		//$data['is_host'] = $this->Event_model->is_host($user_id, $event_id);

		//get event details
		$lobby_exists = $this->Event_model->get_event_name($event_id);
		if ($lobby_exists) {
			$data['event_name'] = $lobby_exists;
			$data['event_id'] = $event_id;
			$this->session->set_userdata('curr_event_id', $event_id);
		}else{
			$this->session->set_flashdata('bad_lobby_warn', 'Bad Lobby');
			redirect('event/dashboard');
		}
		

		//get playlist data (initial view)
		$data['existing_tracks'] = $this->build_playlist_view($event_id);

		//get guest list

		$this->load->view('header', $data);	
		$this->load->view('lobby/lobby', $data);
		$this->load->view('footer');

	}


	function bad_lobby(){
		$this->load->view('header');

		echo "<h1>Sorry - the lobby you tried to join either doesn't exist, is closed, or you provided the wrong access code. Try another lobby!</h1>";
		$this->load->view('footer');
	}


	function _generate_access_code(){
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$random_string_length = 5;
		$code = '';
		 for ($i = 0; $i < $random_string_length; $i++) {
		      $code .= $characters[mt_rand(0, strlen($characters) - 1)];
		 }

		 // Check to make sure this code does not match any existing codes
		 if ($this->Event_model->check_access_code_uniqueness($code)) {
		 	return $code;
		 }else{

		 	return $this->_generate_access_code();

		 }


		
	}

		

	//AJAX 
	// Get track information from search query, send it to modal snippet 
	function get_track_search_results(){
		$track_name = $this->input->post('search_q');
		$data['max_results'] = 6; //$this->input->post('num_results');
		// Reach out to Spotify_lib and get search results for track
		$raw_spotify_out = array();
		$raw_spotify_out = $this->spotify_lib->searchTrack($track_name);
		$data['tracks_arr'] = $raw_spotify_out->tracks; 



		$results_out = $this->load->view('snippets/modal_search_results', $data, true);
		echo $results_out;

		// var_dump($raw_spotify_out->tracks);

	}

	// TESTTING Function for output based on track search
	function test_spotify_out($track_title = NULL){

		if (isset($track_title)) {
			var_dump($this->spotify_lib->searchTrack($track_title)->tracks[0]);
		}else{

			var_dump($this->spotify_lib->searchTrack('frozen')->tracks[0]);	
		}
		

	}

	// TESTING function for output based on URI search
	function test_spotify_out_uri($track_uri = NULL){

		if (isset($track_uri)) {
			var_dump($this->spotify_lib->lookup($track_title));
		}else{

			var_dump($this->spotify_lib->lookup('spotify:track:1H5tvpoApNDxvxDexoaAUo')->track);	
		}
		

	}


	// Ajax Method 
	function add_song(){
		
		//retrieve the data submitted to POST by AJAX submit
		$lookup_uri = $this->input->post('add_uri');
		$target_event = $this->input->post('c_event_id');
		
		// Get full details about this particular track:uri:* 
		$track_info_obj = $this->spotify_lib->lookup($lookup_uri)->track;

		// Extract relevant details from info_object 
		$data['track_name'] = !empty($track_info_obj->name) ? $track_info_obj->name : "Unavailable";
		$data['track_album'] = !empty($track_info_obj->album->name) ? $track_info_obj->album->name : "Unavailable";
		$data['track_album_date'] = !empty($track_info_obj->album->released) ? $track_info_obj->album->released : "Unavailable";
		$data['track_artist'] = !empty($track_info_obj->artists[0]->name) ? $track_info_obj->artists[0]->name : "Unavailable";
		$data['track_uri'] = $lookup_uri;
		// Persistence
		// - Add to the event_tracks table [cheating - need to go the song table <-> playlist <-> event_playlist route]
		$this->Event_model->add_track_to_event($target_event, $data);

		//return formatted list item to append to playlist
		$track_line_item = $this->load->view('snippets/spotify_mediaobject', $data, true);
		echo $track_line_item;
	}



	function build_playlist_view($event_id = 0, $host_view = false){
		
		if ($this->input->is_ajax_request()) {
			// AJAX request, check for appropriate POST items and set the event_id that way
			$ajax_event_id = $this->input->post('c_event_id');
			if (isset($ajax_event_id)) {
				$event_id = $ajax_event_id;
			}
		}
		//handle it non-AJAX
		//host checker
		if ($host_view) {
			//return a special-host only view?
		}

		// error checking:  need event_id to figure out which tracks to display
		if ($event_id == 0) {
			return '';
		}

		// Get an array of all tracks from DB for that event 
		$tracks_arr = $this->Event_model->get_all_event_tracks($event_id);
		$html_out = '';
		if ($tracks_arr) {
			//tracks exist
			//loop through and build some HTML!

			foreach ($tracks_arr as $track_array_element) {
				$html_out .= $this->load->view('snippets/spotify_mediaobject', $track_array_element, true);
			}


			if ($this->input->is_ajax_request()) {
				echo $html_out;
			}else{
				return $html_out;
			}
			
		}else{
			//no tracks exist
			//skip playlist buildint step
			if ($this->input->is_ajax_request()) {
				echo "";
			}else{
				return "";
			}
		}
		

	}

}

/* End of file event.php */
/* Location: ./application/controllers/event.php */