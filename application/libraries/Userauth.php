<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Userauth {

	function Userauth() {
		$this->CI =& get_instance();
		$this->CI->load->helper('security');
		$this->CI->load->helper('cookie');
		log_message('debug', 'Started Userauth');
	}

	function get_data($username, $password) {
		$this->CI->db->cache_off();
		$user_data = array();
		$query = $this->CI->db->get_where('owners', array('username' => $username, 'password' => $password));
		if($query->num_rows() == 1) {
			$user_data = $query->row_array();
		}
		return $user_data;
	}

	function logged_in() {
    	$this->CI->db->cache_off();
		$this->CI->load->library('user_agent');
    	if ($this->CI->agent->is_robot()) {
    		return false;
    	} else {
	    	$sess_user = $this->CI->session->userdata('username');
	    	$sess_pass = $this->CI->session->userdata('password');
	    	if( $sess_user == '' || $sess_pass == '') {
				return false;
	    	}
	    	$session_data = array(
				'username' => $sess_user,
				'password' => $sess_pass
			);
			$query = $this->CI->db->get_where('owners', $session_data);
			log_message('debug', 'Login query for '.$sess_user.' '.$this->CI->db->last_query());
			if ($query->num_rows() == 1) {
				return true;
			} else {
				return false;
			}
    	}
	}

	function login($username, $password) {
		$is_logged_in = false;
		$msg = '';
		$user_data = $this->get_data($username, $password);
		if (!empty($user_data)) {
			$session_data = array();
			$session_data['id'] = $user_data['id'];
			$session_data['username'] = $user_data['username'];
			$session_data['password'] = $user_data['password'];
			$session_data['is_admin'] = ($user_data['username'] == $this->CI->config->item('admin_username')) ? 1 : 0;
			$session_data['division'] = $user_data['division'];
			$session_data['leagueid'] = $user_data['leagueid'];
			$session_data['firstname'] = $user_data['firstname'];
			$session_data['lastname'] = $user_data['lastname'];
			$session_data['teamname'] = $user_data['teamname'];
			$session_data['shortname'] = $user_data['shortname'];
			$session_data['email'] = $user_data['email'];
			$session_data['email1'] = $user_data['email1'];
			$session_data['email2'] = $user_data['email2'];
			$session_data['sendemail'] = $user_data['sendemail'];
			$session_data['slug'] = $user_data['slug'];
			$this->CI->session->set_userdata($session_data);
			log_message('debug', 'User '.$user_data['username'].' logged in ('.$_SERVER['REMOTE_ADDR'].': '.$_SERVER['HTTP_USER_AGENT'].')');
			$msg = 'Login successful';
			$is_logged_in = true;
		} else {
			$user_data = array();
			$query = $this->CI->db->get_where('owners', array('username' => $username));
			if ($query->num_rows() > 0) {
				$msg = 'Invalid Password';
			} else {
				$msg = 'Invalid Username';
			}
		}
		return array($is_logged_in, $msg);
	}

	function logout() {
		$this->CI->session->set_userdata(
			array(
				'id' => 0,
				'username' => '',
				'password' => '',
				'is_admin' => 0,
				'leagueid' => '',
				'firstname' => '',
				'lastname' => '',
				'lastname' => '',
				'email' => '',
				'email1' => '',
				'email2' => '',
				'slug' => ''
			)
		);
		return true;
	}

	function send_password($owner_id = 0) {
		$query = $this->CI->db->get_where('owners', array('id' => $owner_id));
		if ($query->num_rows() == 1) {
			$owner = $query->row_array();
			$this->CI->load->library('email');
			$this->CI->email->from($this->CI->config->item('commissioner_email'), 'The Commissioner');
			$this->CI->email->subject('Extra Points Login Information');
			if (!empty($owner['email'])) $this->CI->email->to($owner['email']);
			if (!empty($owner['email1'])) $this->CI->email->to($owner['email1']);
			if (!empty($owner['email2'])) $this->CI->email->to($owner['email2']);
			$this->CI->email->message('Below is the login information for '.$owner['teamname'].' for extrapoints.net'."\n\n".'Username: '.$owner['username']."\n".'Password: '.$owner['password']."\n");
			if ($this->CI->email->send()) {
				return true;
			} else {
				if ($this->CI->config->item('debug_mode')) echo $this->CI->email->print_debugger();
				return false;
			}
		} else {
			return false;
		}
	}

	function update($username, $data = array()) 	{
		if (!empty($username)) {
			if (!empty($data['password'])) $this->CI->db->set('password', $data['password']);
			$this->CI->db->set('email', $data['email']);
			$this->CI->db->set('email1', $data['email1']);
			$this->CI->db->set('email2', $data['email2']);
			$this->CI->db->set('firstname', $data['firstname']);
			$this->CI->db->set('lastname', $data['lastname']);
			$this->CI->db->set('teamname', $data['teamname']);
			$this->CI->db->set('shortname', $data['shortname']);
			$this->CI->db->set('abbvname', $data['abbvname']);
			$this->CI->db->set('homephone', $data['homephone']);
			$this->CI->db->set('workphone', $data['workphone']);
			$this->CI->db->where('cellphone', $username);
			$this->CI->db->update('owners');
			if ( $this->CI->db->affected_rows() > 0 ) {
				return 'Account information for \''.$username.'\' updated successfully.';
			} else {
				return 'Update failed for user: \''.$username.'\'';
			}
		} else {
			return 'No username provided';
		}

	}

}
?>