<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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

	}

	function index()
	{

		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			//$this->load->view('welcome', $data);
			echo "Create an event page";
		}
	}


	function create_event()
	{
		//Creates an event
		//Check if user creating the event is a host
		//Validation to make sure event created for present, not past, etc.

	}


	function join_event()

	{

		//Add a guest user to the event
		
	}



	function dashboard()
	{

		$sess_data = $this->session->all_userdata();
		$data['user_list'] = $sess_data;
		$data['test_key'] = "test value";
		$this->load->view('header');
		$this->load->view('event/dashboard', $data);
		$this->load->view('footer');

	}

}

/* End of file event.php */
/* Location: ./application/controllers/event.php */