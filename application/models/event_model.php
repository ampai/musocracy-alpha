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


	function get_event_name($e_id){
		$e_name = "";
		$query = $this->db->get_where($this->event_table, array('id' => $e_id));

		if ($query->num_rows() > 0) {
			// one or more rows returned
			$res_arr = $query->result_array();

			return $res_arr[0]['name'];
		}else{
			return false;
		}

	}


	function let_me_in($event_name, $event_code){
		$ret = false;
		// check if the code matches the event name, return 

		$query = $this->db->get_where('events', array('name' => $event_name, 'access_code' => $event_code));
		if ($query->num_rows == 1) {
			//even if two events have the same name, the access key is unique across all keys
			// 37^5 possible access keys, need to check distribution of keys to see collisions

			$ret = true; 

		}

		return $ret;
	}

	function get_all_event_names(){
		$names_arr = array();

		//Select all names from event_table
		$this->db->select('name');
		$this->db->from($this->event_table);
		$query = $this->db->get();


		//populate names_arr with just the party names
		if ($query->num_rows() > 0) {

			//One or more rows returned
			foreach ($query->result_array() as $row) {
				$names_arr[] = $row['name'];
			}

		}
		
		return $names_arr;

	}

}

/* End of file event.php */
/* Location: ./application/models/event.php */