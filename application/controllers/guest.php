<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Guest extends CI_Controller {
	


		function __construct(){
			parent::__construct();
			$this->load->library(array('session', 'tank_auth', 'spotify_lib', 'form_validation'));
			$this->load->helper('url');

			
			
			$this->load->model('Event_model');


		}


		public function index()
		{
			
			echo "Guest has landed!";
			
		}


		// Authenticate a guest into a lobby 
		// -need to trick Tank_auth into thinking a user is currently registered
		// tank auth uses the following main session keys to store data
		// 'user_id', 'username', 'status'
		function join(){

			// First check if the access code matches any open lobbies 
			// 1. If yes, then it's likely a legitimate user [TODO: Captcha]
			// 2. Implant the session keys to trick Tank_auth
			// 3. Redirect the user to the event lobby homepage

			$access_code = $this->input->post('access_code');
			$event_id = $this->Event_model->get_event_id_by_code($access_code);

			if ($event_id > 0) {
				// Event exists
				// $this->_trick_tank_auth(...);

				echo "Would have taken you to lobby/".$event_id;
			}else{

				echo "bad code";
			}

		}


		function _trick_tank_auth($u_id, $uname, $ustatus){

			$this->session->set_userdata(array(
					'user_id'	=> $u_id,
					'username'	=> $uname,
					'status'	=> 1  //activated of course
					
			));


		}
	
	}



	
	/* End of file guest.php */
	/* Location: ./application/controllers/guest.php */