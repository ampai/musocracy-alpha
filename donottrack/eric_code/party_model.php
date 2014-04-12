<?php 
	class Party_Model extends CI_Model
	{
		function create_party($data)
		{
			/* $data array(
				'name'      => party name, 
				'host_id'   => duh,
				'password'  => duh,
				'is_private'=> 0 for open 1 for private default is 0,
				'start_time'=> duh,
				'end_time'  => duh,
				'max_guest' => if null default is 50,
				'threshold' => yeah,
				'max_songs' => if null default is 15);
			*/
			$this->db->insert('party', $data);
		}

		function add_guest($guest_id, $name, $party_id)
		{
			$this->db->insert('guest', array('party_id'=>$party_id, 'id'=>$guest_id, 'name'=>$name));
		}

		function remove_guest($guest_id)
		{
			$this->db->delete('guest', array('id'=> $guest_id));
		}

		function get_guest_list($party_id)
		{
			$q = $this->db->get_where('guest', array('party_id' => $party_id));
			if ($q->num_rows() > 0) return $q->result();
			return NULL;
		}

		function get_name($pl_id)
		{
		$q = $this->db->get_where('party', array('id' => $pl_id));
		if ($q->num_rows() == 1) return $q->result()[0]->name;
		return NULL;
		}

		function get_host($pl_id)
		{
			$q = $this->db->get_where('party', array('id' => $pl_id));
			if ($q->num_rows() == 1) return $q->result()[0]->host_name;
			return NULL;
		}

		function get_all_songs($pl_id)
		{
			$q = $this->db->get_where('song', array('playlist_id' => $pl_id));
			if ($q->num_rows() > 0) return $q->result();
			return NULL;
		}

		function set_privacy($pl_id, $priv)
		{
			$this->db->update('party', array('is_private' => $priv));
			//echo "Privacy Set.";
		}

		function set_password($pl_id, $pw)
		{
			$this->db->update('party', array('password' => $pw));
			//echo "Password Set.";
		}

		function set_threshold($pl_id, $thrs)
		{
			$this->db->update('party', array('threshold' => $thrs));
			//echo "Threshold Set.";
		}

		function set_maxs($pl_id, $max_guests, $max_songs)
		{
			if($max_guests != NULL) $this->db->update('party', array('max_guests' => $max_guests));
			if($max_songs != NULL) $this->db->update('party', array( 'max_songs' => $max_songs));
			//echo "Maximums Set.";
		}

		function end_playlist($pl_id, $user_name)
		{
			//TODO: removed all records associated with party
		}
	}
 ?>