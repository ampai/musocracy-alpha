<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

class Event extends CI_Controller

{


	function __construct()
	{
		parent::__construct();
		$this->load->library(array('session', 'tank_auth'));
		$this->load->helper('url');

		if (!$this->tank_auth->is_logged_in()) {
			$this->session->set_flashdata('not_logged_in', 'You need to be registered to see that!');
			redirect('/auth/login/');
		}

		$this->load->library('form_validation');
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
		//Creates an event
		//Check if user creating the event is a host 
		//Validation to make sure event created for present, not past, etc.

		// If from AJAX, then process, otherwise, do nothing
		if ($this->input->is_ajax_request()) {
		

			$event_data = array(

				'id' => NULL,
				'name' => $this->input->post('event_name'),
				'access_code' => $this->_generate_access_code(),
				'host_id' => '666',
				'start' => $this->input->post('event_time_start'),
				'end' => $this->input->post('event_time_end'),
				'max_users' => $this->input->post('guestcount')


				);

			$ins_id = $this->Event_model->create_event($event_data);
			if (!is_null($ins_id)) {
				// Insert occured succesfully 

				$success_html = $this->load->view('snippets/event_create_success', $event_data, true);

				$return = array(
					'status' 	=> 'success',
					'message'	=> 'Event created succesfully',
					'html' 		=> $success_html

					);

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


	function join()

	{
		//Add a guest user to the event
		$this->load->view('header');
		
		$this->load->view('modal');

		$this->load->view('footer');


	}



	function dashboard()
	{

		// get user information
		$data['curr_username'] = $this->tank_auth->get_username();

		$this->load->view('header');
		$this->load->view('event/dashboard', $data);
		$this->load->view('footer');

	}
	function test_lobby(){

		$data = "";
		$this->load->view('header', $data, FALSE);
		$this->load->view('lobby/lobby', $data, FALSE);
		$this->load->view('footer', $data, FALSE);
	}

	function lobby(){
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


		return $code;
	}

		



}

/* End of file event.php */
/* Location: ./application/controllers/event.php */