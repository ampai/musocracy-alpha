<?php 

	Class Song_Model extends CI_Model
	{
		function get_song($song_id)
		{
			$q = $this->db->get_where('song', array('id'=>$song_id));
			if ($q->num_rows() == 1) return $q->result(); 
			return NULL;
		}

		function add_song($song, $party_id)
		{
			/* $song array(
				'title'    => spotify title data, 
				'artist'   => spotify artist data,
				'album'    => spotify album data,
				'track_id' => spotify track data,
				'party_id' => party id of calling party);
			*/
			$this->db->insert('song', $song);
			$q = $this->db->query("SELECT MAX(location) as tail FROM playlist WHERE party_id=".$party_id);
			$res = $q->result();
			$loc = $res[0]->tail + 1;
			$this->db->insert('playlist', array('party_id'=> $party_id, 'song_id'=> $song['id'], 'location'=>$loc));
		}

		function lock_vote($song_id, $user_id)
		{
			$result = $this->get_song($song_id);
			if($result != NULL)
			{
				$new_vote = array('votes' => ($result[0]->votes) + 1);
				$this->db->update('song', $new_vote);
				$this->db->delete('vote', array('song_id' => $song_id, 'guest_id' => $user_id));
				$this->db->insert('vote', array('song_id'=>$song_id, 'guest_id'=>$user_id, 'is_skip'=>0));
				$q = $this->db->get_where('party', array('id'=>($result[0]->playlist_id)));
				$pl = $q->result();
				//echo $new_vote['votes'];
				if($new_vote['votes'] >= $pl[0]->threshold)
					$this->lock_song($song_id);
			}
			//else
				//echo "No song with that ID.";
		}

		function skip_vote($song_id, $user_id)
		{	
			$result = $this->get_song($song_id);
			if(!($result[0]->is_locked))
			{
				$new_vote = array('skips' => ($result[0]->skips) + 1);
				$this->db->update('song', $new_vote);
				//echo "skip added";
				$this->db->delete('vote', array('song_id' => $song_id, 'guest_id' => $user_id));
				$this->db->insert('vote', array('song_id'=>$song_id, 'guest_id'=>$user_id, 'is_skip'=>1));
				$q = $this->db->get_where('party', array('id'=>$result[0]->playlist_id));
				$pl = $q->result();
				if($new_vote['skips'] >= $pl[0]->threshold)
				{
					$this->remove_song($song_id);
					//echo "song removed";
				}
			}
			//elseif ($result == NULL) 
			//{
				//echo "No song with that ID.";
			//}
			//else
				//echo "no skip vote added; song is locked";
		}

		function remove_song($song_id)
		{
			$this->db->delete('song', array('id' => $song_id));
		}

		function lock_song($song_id)
		{
			$this->db->update('song', array('is_locked' => 1));
			//echo "song locked";
		}

		function unlock_song($song_id)
		{
			$this->db->update('song', array('is_locked' => 0));
			//echo "song unlocked";
		}

		function bump_song($song_id)
		{
			//not implemented in alpha
		}
	}

 ?>