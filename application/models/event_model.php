<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
* This model talks to the events table.
*  Relevant tables: event
*				 	event_guests
*/
class Event_model extends CI_Model {

	private $event_table = 'events';
	private $events_guests_table = 'event_guests';
	private $event_playlists_table = 'event_playlists';
	private $event_tracks_table = 'event_tracks';

	private $playlist_table = 'playlist';
	private $song_table = 'songs';

	/**
	 * Create new event record
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


	/**
	 * Create new song record for an event
	 *
	 * @param int [event_id]
	 * @param array [track_name, track_artist, track_ablum, track_album_date, track_uri]
	 * 
	 */
	function add_track_to_event($e_id, $t_data) {
		if (!isset($e_id) || !isset($t_data)) {
			return false;
		}
		$insert_obj = array(
			'event_id' => $e_id,
			'track_name' => $t_data['track_name'],
			'track_artist' => $t_data['track_artist'],
			'track_album' => $t_data['track_album'],
			'track_album_date' => $t_data['track_album_date'],
			'track_uri' => $t_data['track_uri']
			);

		$this->db->insert($this->event_tracks_table, $insert_obj);

	}

	function get_all_event_tracks($e_id){
		if (!isset($e_id)) {
			return false;
		}

		$this->db->order_by("ordering", "desc");
		$query = $this->db->get_where($this->event_tracks_table, array("event_id" => $e_id));

		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{

			return false;
		}

	}

	// For a given event_id, track_id, increment either the upvote or downvote
	function update_track_vote($e_id, $t_uri, $v_type){
		// vote type definition
		$vote_col = "upvote"; //default

		if (strcmp($v_type, 'up') == 0) {
			$vote_col = "upvotes";
		}else{
			$vote_col = "downvotes";
		}

		// where clause definition
		$where_clause = arraY(
					'event_id' => $e_id,
					'track_uri' => $t_uri
				);

		
		// update the table
		$this->db->set($vote_col, $vote_col." + 1", false);
		$this->db->where($where_clause);
		$this->db->update($this->event_tracks_table);



		// ordering only changes if a vote has been cast, so
		// determine the new ordering
		// a bit of a kludge, but let's get this project done...

		// define ordering column value
		// need to fetch the values of the upvote and downvote fields
		// then let ordering.val = upvote.val - downvote.val 
		// then set ordering field
		$ordering_val = 0;
		$temp_query = $this->db->get_where($this->event_tracks_table, $where_clause, 1, 0);
		if ($temp_query->num_rows() > 0) {
			$temp_query_arr = $temp_query->row_array();
			$upvotes = $temp_query_arr['upvotes'];
			$downvotes = $temp_query_arr['downvotes'];

			$ordering_val = $upvotes - $downvotes;
		}
		
		$this->db->set('ordering', $ordering_val, true);
		$this->db->where($where_clause);
		$this->db->update($this->event_tracks_table);


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

	function get_all_event_name_id_pairs(){
		$name_id_pairs = array();

		//Select all names from event_table
		$this->db->select('name, id');
		$this->db->from($this->event_table);
		$query = $this->db->get();


		//populate names_arr with just the party names
		if ($query->num_rows() > 0) {

			//One or more rows returned
			foreach ($query->result_array() as $row) {
				$name_id_pairs[$row['name']] = $row['id'];

			}

		}
		
		return $name_id_pairs;

	}


	// Creates a playlist with the same id as event_id
	function create_default_playlist($e_id){
		if (!isset($e_id)) {
			return false;
		}
		$insert_data = array(
						'id' 		  => NULL,
						'event_id' 	  => $e_id,
						'playlist_id' => $e_id
							);
		//inserting an entry into playlist_table with playlist ID the same as event_id
		$this->db->insert($this->event_playlists_table, $insert_data);



	}


	// Checks if the provided access code is unique in the events table
	// Returns: true if unique, false if identical key exists 
	function check_access_code_uniqueness($to_check){
		if (!isset($to_check)) {
				
			return false;
		}

		$where_clause = array('access_code' => $to_check);	
		$query = $this->db->get_where($this->event_table, $where_clause);

		if ($query->num_rows() > 0) {
			// Access key exists that's already there
			return false;
		}else{
			// Unique 
			return true; 
		}

	}



}

/* End of file event.php */
/* Location: ./application/models/event.php */