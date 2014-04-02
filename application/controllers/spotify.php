<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Spotify extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('session', 'tank_auth', 'spotify_lib'));
		$this->load->helper('url');

		if (!$this->tank_auth->is_logged_in()) {
			$this->session->set_flashdata('not_logged_in', 'You need to be registered to see that!');
			redirect('/auth/login/');
		}

		

	}

	public function index()
	{

		echo "things loaded corrently";
		
	}



	public function test()
	{

		$dump_arr = $this->spotify_lib->searchTrack('frozen');

		var_dump($dump_arr);

	}

}

/* End of file spotify.php */
/* Location: ./application/controllers/spotify.php */