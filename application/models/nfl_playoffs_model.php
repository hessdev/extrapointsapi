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
class NFL_Playoffs_model extends CI_Model {

	function NFL_Playoffs_model() {
		parent::__construct();
	}

	function get($year = 2010) {
		$player_points = $this->player_points($year);
		$team_results = $this->team_results($year);
		$playoffs = array();
		$this->db->cache_on();
		$this->db->select('o.playoff_ownerid, o.playoff_name, l.lineup_playerid, l.lineup_position, p.name, p.teamid', FALSE);
		$this->db->join('nfl_playoff_lineup l', 'l.lineup_ownerid = o.playoff_ownerid AND l.lineup_year = o.playoff_year');
		$this->db->join('players p', 'p.id = l.lineup_playerid AND p.year = l.lineup_year');
		$this->db->where('o.playoff_year', $year);
		$this->db->order_by('o.playoff_order', 'ASC');
		$this->db->order_by('l.lineup_position', 'ASC');
		$query = $this->db->get('nfl_playoff_owners o');
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$team_id = $row->playoff_ownerid;
				if (!array_key_exists($team_id, $playoffs)) {
					$playoffs[$row->playoff_ownerid] = array(
						'name' => $row->playoff_name,
						'points' => 0,
						'players' => array(),
						'points_by_rnd' => array()
					);
				}
				if (!array_key_exists($row->lineup_playerid, $playoffs[$team_id]['players'])) {
					$player_results = (array_key_exists($row->teamid, $team_results)) ? $team_results[$row->teamid] : array();
					if (array_key_exists($row->lineup_playerid, $player_points)) {
						foreach ($player_points[$row->lineup_playerid] as $rnd => $points) {
								$player_results[$rnd]['points'] = $points;
								$player_results[$rnd]['output'] = $points;
						}
					}
					$playoffs[$team_id]['players'][$row->lineup_position] = array(
						'name' => $row->name,
						'team' => $row->teamid,
						'scores' => $player_results
					);
				}
			}
			for ($rnd = 1; $rnd <= 4; $rnd++) {
				foreach($playoffs as $team_id => $data) {
					foreach($data['players'] as $pos => $player) {
						$playoffs[$team_id]['points'] += $player['scores'][$rnd]['points'];
						if (!array_key_exists($rnd, $playoffs[$team_id]['points_by_rnd'])) $playoffs[$team_id]['points_by_rnd'][$rnd] = 0;
						$playoffs[$team_id]['points_by_rnd'][$rnd] += $player['scores'][$rnd]['points'];
					}
				}
			}
			return $playoffs;
		}
	}

	function player_points($year = 2010) {
		$players = array();
		$this->db->cache_on();
		$this->db->where('stat_year', $year);
		$query = $this->db->get('nfl_playoff_stats');
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				if (!array_key_exists($row->stat_playerid, $players)) $players[$row->stat_playerid] = array();
				if (!array_key_exists($row->stat_rnd, $players[$row->stat_playerid])) $players[$row->stat_playerid][$row->stat_rnd] = $row->stat_points;
			}
		}
		return $players;
	}

	function team_results($year = 2010) {
		$results = array();
		$this->db->cache_on();
		$this->db->where('playoff_year', $year);
		$this->db->order_by('playoff_teamid', 'ASC');
		$this->db->order_by('playoff_rnd', 'ASC');
		$query = $this->db->get('nfl_playoff_schedule');
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				if (!array_key_exists($row->playoff_teamid, $results)) {
					$results[$row->playoff_teamid] = array();
				}
				if (!array_key_exists($row->playoff_rnd, $results[$row->playoff_teamid])) {
					$now = strtotime('now');
					$game_date = strtotime($row->playoff_game_date);
					$output = ($game_date > $now) ? 'NA' : '0';
					$results[$row->playoff_teamid][$row->playoff_rnd] = array(
						'points' => 0,
						'output' => (in_array($row->playoff_oppteamid, array('B','NA','X'))) ? $row->playoff_oppteamid : $output
					);
				}
			}
		}
		return $results;
	}

}