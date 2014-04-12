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




		//get guest list

		$this->load->view('header', $data);	
		$this->load->view('lobby/lobby', $data);
		$this->load->view('footer');

	}


	function test_lobby(){

		$data = "";
		$this->load->view('header', $data, FALSE);
		$this->load->view('lobby/test_lobby', $data, FALSE);
		$this->load->view('footer', $data, FALSE);
	}

	function bad_lobby(){
		$this->load->view('header');

		echo "<h1>Sorry - the lobby you tried to join either doesn't exist, is closed, or you provided the wrong access code. Try another lobby!</h1>";
		$this->load->view('footer');
	}

	function test_spotify_connection(){
		//Check if event exists
		//Check if event is open
		//Check if user (guest? Host?) is allowed to enter the event
		$is_host = false;
		$joinable = false;

		// STEP 1  Loading the HTML scraping library
		$this->load->library('scraping');

		// STEP 2 Set spotify MetaData URI 
		$spotify_metadata_url = "https://ws.spotify.com/search/1/track.json?q=";


		// STEP 3 Logic 

		$song_name = $this->input->post('song');
		// Change spaces in search term into '+' 
		$song_name = str_replace(" ", "+", $song_name);
		$song_name = str_replace(" ", "+", $song_name);

		$page = $this->scraping->page($spotify_metadata_url.$song_name);
	    $json_arr = json_decode($page, true);
	    
	    $ret = "";

	    if ($json_arr["info"]["num_results"] < 1) {
	    	echo "Spotify returned nothing for your query.";
	    }else{
	    	$ret .= "<dl class='dl-horizontal'><dt>Title</dt><dd>".$json_arr["tracks"][0]["name"]."</dd>";
	   	 	$ret .= "<dt>Album</dt><dd>".$json_arr["tracks"][0]["album"]["name"]." (".$json_arr["tracks"][0]["album"]["released"].")</dd>";
	   		$ret .= "<dt>Track Artist</dt><dd>".$json_arr["tracks"][0]["artists"][0]["name"]."</dd>";
	   		$ret .= "</dl>";
	   		if (isset($json_arr["tracks"][0]["href"])) {
	   			$spotify_track_uri = $json_arr["tracks"][0]["href"];
	   			$ret .= "<br />";
	   			$ret .= "<iframe src='https://embed.spotify.com/?uri=spotify:track:".$spotify_track_uri."' width='300' height='80' frameborder='0' allowtransparency='true'></iframe>";
	   			
	   		}else{


	   		}
	   		
		echo $ret."<hr />";

	    }

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

	function test_spotify_out($track_title = NULL){

		if (isset($track_title)) {
			var_dump($this->spotify_lib->searchTrack($track_title)->tracks[0]);
		}else{

			var_dump($this->spotify_lib->searchTrack('frozen')->tracks[0]);	
		}
		

	}

	// Ajax Method 
	function add_song(){
		// Need two parameters
		// event_id and track_id (song_id)

		$data['spotify_uri'] = $this->input->post('add_uri');

		$spotify_iframe = $this->load->view('snippets/spotify_iframe', $data, true);
		// $spotify_iframe 	 = '<li class="list-group-item"><iframe src="https://embed.spotify.com/?uri=';
		// $spotify_iframe 	.= $data['spotify_uri'];
		// $spotify_iframe		.=  '" width="500" height="80" frameborder="0" allowtransparency="true"></iframe></li>';

		echo $spotify_iframe;

	}



}

/* End of file event.php */
/* Location: ./application/controllers/event.php */