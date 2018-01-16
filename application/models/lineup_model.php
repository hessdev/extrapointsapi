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
class Lineup_model extends CI_Model {

	function Lineup_model() {
		parent::__construct();
	}

	function get($owner_id = 0, $year = 2015, $week = 1) {
		$data = array();
		$now = new DateTime($this->config->item('now'), $this->config->item('timezone'));
		$positions = $this->config->item('positions');
		$num_starters = $this->config->item('num_starters');
		$this->db->cache_on();
		$this->db->select('l.playerid, l.position, DATE_ADD(l.updateddate, INTERVAL '.$this->config->item('time_diff').' HOUR) AS updateddate, p.name, p.position AS playerpos, p.img as playerimg, s.gametype, s.gamedate, DATE_ADD(s.gamedate, INTERVAL '.$this->config->item('time_diff').' HOUR) AS fgamedate, DATE_ADD(s.gamedate, INTERVAL 3 HOUR) AS enddate, t.teamid AS team, t.type AS hometype, t.city AS homecity, t.state AS homestate, t.zip AS homezip, t.stadium AS homestadium, t.surface AS homesurface, ot.teamid AS oppteam, ot.type AS awaytype, ot.city AS awaycity, ot.state AS awaystate, ot.zip AS awayzip, ot.stadium AS awaystadium, ot.surface AS awaysurface', FALSE);
		$this->db->join('players p', 'p.id = l.playerid AND p.year = l.year');
		$this->db->join('nfl_schedule s', 's.teamid = p.teamid AND s.week = l.week AND s.year = l.year');
		$this->db->join('nfl_teams t', 't.teamid = p.teamid');
		$this->db->join('nfl_teams ot', 'ot.teamid = s.oppteamid');
		$this->db->where('l.ownerid', $owner_id);
		$this->db->where('l.week', $week);
		$this->db->where('l.year', $year);
		$this->db->order_by('l.position', 'ASC');
		$query = $this->db->get('lineup l');
		//log_message('debug', 'lineup->get(): '.$this->db->last_query());
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			$lineup = $query->result_array();
			if (!empty($lineup)) {
				foreach ($lineup as $player) {
					//print_r($player);
					//log_message('debug', 'player: '.print_r($player, true));
					$lineup_position = $player['position'];
					$player_pos = substr($lineup_position, 1, 2);
					$player_pos_index = intval(substr($lineup_position, 3));
					$game_start_date = (empty($player['gamedate'])) ? new DateTime('1970-01-01 00:00:00', $this->config->item('timezone')) : new DateTime($player['fgamedate'], $this->config->item('timezone'));
					$game_end_date = (empty($player['enddate'])) ? new DateTime('1970-01-01 00:00:00', $this->config->item('timezone')) : new DateTime($player['enddate'], $this->config->item('timezone'));
					$lineup_updated = (empty($player['updateddate'])) ? new DateTime('1970-01-01 00:00:00', $this->config->item('timezone')) : new DateTime($player['updateddate'], $this->config->item('timezone'));
					$player_has_played = ($game_start_date > $now && $player['oppteam'] != 'BYE') ? false : true;
					//echo $player['playerid'].': '.$position.' '.$player['name']."\n\n";
					if ($player['oppteam'] == 'BYE') {
						$location = null;
						$stadium = null;
						$surface = null;
					} else {
						if ($player['gametype'] == 'H') {
							$location = $player['homecity'].', '.$player['homestate'];
							$stadium = $player['homestadium'];
							$surface = $player['homesurface'];
						} else {
							$location = $player['awaycity'].', '.$player['awaystate'];
							$stadium = $player['awaystadium'];
							$surface = $player['awaysurface'];
						}
					}
					if ($player_pos_index > $num_starters[array_search($player_pos, $positions)]) {
						$starter = false;
					} else {
						$starter = true;
					}
					if (in_array($player['playerpos'], array('DB','DL','DT','LB','CB','S','DE'))) {
						$lineup_pos = 'DF';
					} elseif ($player['playerpos'] == 'K') {
						$lineup_pos = 'PK';
					} elseif ($player['playerpos'] == 'TE') {
						$lineup_pos = 'WR';
					} else {
						$lineup_pos = $player['playerpos'];
					}
					$data[] = array(
						'id' => $player['playerid'],
						'name' => $player['name'],
						'lineup_position' => $lineup_position,
						'position' => $player_pos,
						'player_position' => $lineup_pos,
						'starter' => $starter,
						'img' => $player['playerimg'],
						'has_played' => $player_has_played,
						'opponent' => ($player['gametype'] == 'H' || $player['oppteam'] == 'BYE') ? $player['oppteam'] : '@'.$player['oppteam'],
						'home' => ($player['gametype'] == 'H'),
						'team' => $player['team'],
						'location' => $location,
						'stadium' => $stadium,
						'surface' => $surface,
						'game_start' => $game_start_date->format(DATE_ATOM),
						'game_end' => $game_end_date->format(DATE_ATOM),
						'updated' => $lineup_updated->format(DATE_ATOM)
					);
				}
			}
		}
		return $data;
	}

	function roster_week($year = 2015, $week = 0) {
		//$this->db->cache_on();
		$roster_week = 17;
		$this->db->select_min('week','min_week');
		$this->db->where('gamedate > \''.$this->config->item('now').'\'');
		$this->db->where('year', $year);
		$query = $this->db->get('nfl_schedule');
		$row = $query->row_array();
		$min_week = $row['min_week'];
		if (is_numeric($min_week)) $roster_week = $min_week;
		if ($week > 0 && $week < $roster_week) $roster_week = $week;
		//log_message('debug', 'roster_week:'.$this->db->last_query());
		$this->db->cache_off();
		return $roster_week;
	}


	function update($year = 2015, $week = 17, $owner_id = 0, $data = array()) {
		$data_years = $this->config->item('data_years');
		if (!empty($data) && in_array($year, $data_years) && $week >= 1 && $week <= 17) {
			$this->db->trans_strict(false);
			$this->db->trans_start();
			foreach ($data as $pos => $player_id) {
				$this->db->set('playerid', $player_id);
				$this->db->set('updateddate', $this->config->item('now'));
				$this->db->where('ownerid', $owner_id);
				$this->db->where('year', $year);
				$this->db->where('week >=', $week);
				$this->db->where('position', $pos);
				$this->db->update('lineup');
			}
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				$this->db->cache_delete_all();
			}
			return $this->db->trans_status();
		} else {
			return false;
		}
	}

	function week($year = 2015) {
		$this->db->cache_on();
		$week = 1;
		$weekdays_to_exclude = array('Wednesday','Thursday','Friday','Saturday');
		$this->db->select_min('week','min_week');
		$this->db->where('year', $year);
		$this->db->where('gametype', 'H');
		$this->db->where_not_in("DATE_FORMAT(gamedate,'%W')",$weekdays_to_exclude);
		$this->db->where("gamedate > '".$this->config->item('now')."'");
		$query = $this->db->get('nfl_schedule');
		if ($query->num_rows() == 1) {
			$row = $query->row_array();
			$min_week = (intval($row['min_week']) >= 1 && intval($row['min_week']) <= 17) ? intval($row['min_week']) : 17;
		} else {
			$min_week = 1;
		}
		if ($min_week < 17) {
			for($i=$min_week; $i<=17; $i++) {
				$this->db->select('id');
				$this->db->where('week', $i);
				$this->db->where('year', $year);
				$this->db->where('gametype', 'H');
				$this->db->where_not_in("DATE_FORMAT(gamedate,'%W')",$weekdays_to_exclude);
				$this->db->where("DATE_FORMAT(gamedate,'%k') >= 13");
				$query = $this->db->get('nfl_schedule');
				$available_games = $query->num_rows();
				$this->db->select('id');
				$this->db->where('week', $i);
				$this->db->where('year', $year);
				$this->db->where('gametype', 'H');
				$this->db->where_not_in("DATE_FORMAT(gamedate,'%W')",$weekdays_to_exclude);
				$this->db->where("gamedate > '".$this->config->item('now')."'");
				$query = $this->db->get('nfl_schedule');
				$games_left = $query->num_rows();
				if ($games_left > 1) {
					$week = $i;
					if ($games_left < $available_games) {
						$week++;
					}
					break;
				} elseif ($i == 17) {
					$week = 17;
				}
			}
		} else {
			$week = 17;
		}
		$this->db->cache_off();
		return $week;
	}
}
?>