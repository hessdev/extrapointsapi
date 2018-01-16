<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* @property CI_Loader $load
* @property CI_Form_validation $form_validation
* @property CI_Input $input
* @property CI_Email $email
* @property CI_DB_active_record $db
* @property CI_Session $session
* @property View $view
*/
class Talk_model extends CI_Model {

	function Talk_model() {
		parent::__construct();
	}

	function add($post = array()) {
		if (!isset($post['status'])) $post['status'] = 'a';
		if (!isset($post['postdate'])) $post['postdate'] = $this->config->item('now');
		if (!isset($post['postedby'])) $post['postedby'] = $this->session->userdata('username');
		$this->db->set($post);
		$this->db->insert('talk');
		return ($this->db->affected_rows() > 0);
	}

	function count($category = '') {
		$this->db->cache_on();
		$this->db->select('id');
		$this->db->where('status', 'a');
		if (!empty($category)) $this->db->where('category', $category);
		$query = $this->db->get('talk');
		$this->db->cache_off();
		return $query->num_rows();
	}

	function delete($post_id = 0) {
		if (!empty($post_id)) {
			$this->db->set('status', 'i');
			$this->db->where('id', $post_id);
			$this->db->update('talk');
			return ($this->db->affected_rows() > 0);
		} else {
			return false;
		}
	}

	function update($post = array()) {
		if (!empty($post['id'])) {
			$post_id = $post['id'];
			unset($post['id']);
		} else {
			$post_id = 0;
		}
		if (!empty($post_id) && !empty($post)) {
			$this->db->where('id', $post_id);
			$this->db->set($post);
			$this->db->update('talk');
			return ($this->db->affected_rows() > 0);
		} else {
			return false;
		}
	}

	function get_post($post_id) {
		$this->db->cache_on();
		$this->db->where('id', $post_id);
		$this->db->where('status', 'a');
		$this->db->limit(1);
		$query = $this->db->get('talk');
		$this->db->cache_off();
		if ($query->num_rows() == 1) {
			return $query->row_array();
		} else {
			return array();
		}
	}

	function get($category = '', $start_rec = 0, $username = '') {
		$items = array();
		$categories = $this->config->item('talk_cat_names');
		//$this->db->cache_on();
		$this->db->select('t.id, t.text, t.title, t.postdate, t.category, os.teamname, o.id as ownerid, o.username, o.firstname, o.lastname', FALSE);
		$this->db->join('owners o', 'o.username = t.postedby');
		$this->db->join('owner_schedule os', 'os.ownerid = o.id AND os.year = '.$this->config->item('default_year'));
		$this->db->where('t.status', 'a');
		if (!empty($category)) $this->db->where('t.category', $category);
		if (!empty($username)) $this->db->where('t.postedby', $username);
		$this->db->order_by('postdate','DESC');
		$this->db->limit($this->config->item('talk_items_per_page'), $start_rec);
		$query = $this->db->get('talk t');
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$post_date = new DateTime($row['postdate'], $this->config->item('timezone'));
				$cat_index = array_search($row['category'], $this->config->item('talk_cats'));
				$category_name = $categories[$cat_index];
				$items[] = array(
					'id' => $row['id'],
					'text' => decode_content($row['text']),
					'title' => $row['title'],
					'post_date' => $post_date->format(DATE_ATOM),
					'category' => $category_name,
					'category_code' => $row['category'],
					'team_id' => $row['ownerid'],
					'user_name' => $row['username'],
					'first_name' => $row['firstname'],
					'last_name' => $row['lastname'],
					'team_name' => $row['teamname']
				);
			}
		}
		return $items;
	}
}
?>