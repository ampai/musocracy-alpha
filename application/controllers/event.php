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
				'access_code' => 'PASSWORD',
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

}

/* End of file event.php */
/* Location: ./application/controllers/event.php */