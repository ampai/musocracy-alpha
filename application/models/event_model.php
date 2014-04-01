<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
* This model talks to the events table.
*  Relevant tables: event
*				 	event_guests
*/
class Event_model extends CI_Model {

	private $event_table = 'events';
	private $events_guests_table = 'event_guests';

	/**
	 * Create new user record
	 *
	 * @param array [name, host_id, start, end, max_guests]
	 * @return	array
	 */
	function create_event($array) {
		//  -insert into event table the above information
		//  -generate a unique acces keyfor guests 
		if ($this->db->insert($this->event_table, $array)) {
			$event_id = $this->db->insert_id();
			return $event_id;
		}

		return NULL;
	}


	function get_event_id_from_name($e_name){
		$e_id = NULL;
		


		return $e_id;
	}

	function is_joinable_event(){
		
		


	}

}

/* End of file event.php */
/* Location: ./application/models/event.php */