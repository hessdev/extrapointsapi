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
class Playoff_model extends CI_Model {

	function Playoff_model() {
		parent::__construct();
	}

	function get($year = 2010) {
		$this->db->cache_on();
		$this->db->select('p.playoff_spot, p.playoff_week as week, o.id as ownerid, o.slug, os.teamname, s.seed_rank as seed, (SELECT SUM(ps.totpts) FROM lineup l LEFT JOIN player_stats ps ON l.playerid=ps.playerid AND l.year=ps.year AND l.week=ps.week WHERE l.week=p.playoff_week AND l.year='.$this->db->escape($year).' AND l.position IN (\'AQB1\',\'BRB1\',\'BRB2\',\'CWR1\',\'CWR2\',\'DPK1\',\'EDF1\',\'EDF2\',\'EDF3\') AND l.ownerid=o.id ) AS totpts', FALSE);
		$this->db->join('owners o', 'o.id = p.playoff_ownerid');
		$this->db->join('owner_schedule os', 'os.ownerid = p.playoff_ownerid AND os.year = p.playoff_year');
		$this->db->join('playoff_seeds s', 's.seed_year = p.playoff_year AND s.seed_ownerid = p.playoff_ownerid');
		$this->db->where('p.playoff_year', $year);
		$this->db->order_by('p.playoff_spot', 'ASC');
		$query = $this->db->get('playoffs p');
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function spots() {
		$query = $this->db->query('SHOW COLUMNS FROM playoffs LIKE \'playoff_spot\'');
		if ($query->num_rows() == 1) {
			$row = $query->row_array();
			$spots = substr($row['Type'], 5,-2);
			$spots = preg_replace("/\'/", "", $spots);
			$spot_list = explode(',', $spots);
			sort($spot_list);
			return $spot_list;
		} else {
			return array();
		}
	}
}
?>