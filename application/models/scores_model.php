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
class Scores_model extends CI_Model {

	function Scores_model() {
		parent::__construct();
	}

	function data($year = 2010, $week = 1, $team_id = 0) {
		log_message('debug', 'scores_model->data('.$year.', '.$week.', '.$team_id.')');
		$team_totals = $this->teams->total_scores($year, $week, $team_id);
		foreach ($team_totals as $team) {
			$team_total_points[$team['id']] = ($team['ytdtotal'] != '') ? $team['ytdtotal'] : 0;
		}
		$this->db->cache_on();
		$scores = array();
		$teams = array();
		$this->db->select('o.slug, o.division, os.scheduleid, os.teamname, o.id AS ownerid, l.playerid, l.position as lineup_pos, l.updateddate as lineup_date, p.id as player_id, p.name, p.position as plyr_pos, t.teamid, t.team as team_city, t.name as team_name, s.oppteamid, s.gametype, s.gamedate, DATE_ADD(s.gamedate, INTERVAL 3 HOUR) AS enddate, ps.id as statid, ps.*', FALSE);
		$this->db->join('owners o', 'o.id = l.ownerid');
		$this->db->join('owner_schedule os', 'os.ownerid = l.ownerid AND os.year = l.year');
		$this->db->join('players p', 'p.id = l.playerid AND p.year = l.year');
		$this->db->join('nfl_schedule s', 's.teamid = p.teamid AND s.week = l.week AND s.year = l.year AND s.oppteamid IS NOT NULL', null, false);
		$this->db->join('nfl_teams t', 't.teamid = p.teamid');
		$this->db->join('player_stats ps', 'ps.playerid = l.playerid AND ps.year = l.year AND ps.week = l.week', 'left');
		//log_message('debug', 'team_id: '.$team_id);
		if (!empty($team_id)) $this->db->where('l.ownerid', $team_id);
		$this->db->where('l.week', $week);
		$this->db->where('l.year', $year);
		$this->db->order_by('os.scheduleid ASC, l.position ASC');
		$query = $this->db->get('lineup l');
		//log_message('debug', 'scores->data->sql: '.$this->db->last_query());
		if ($query->num_rows() > 0) {
			$positions = $this->config->item('positions');
			$num_starters = $this->config->item('num_starters');
			$lineup_date = new DateTime('1970-01-01 00:00:00', $this->config->item('timezone'));
			//echo 'lineup_date: '.$lineup_date->format(DATE_ATOM)."\n\n";
			$last_owner_id = 0;
			foreach ($query->result_array() as $row) {
				$owner_id = $row['ownerid'];
				if ($owner_id != $last_owner_id) {
					$last_owner_id = $owner_id;
					$lineup_date = new DateTime('1970-01-01 00:00:00', $this->config->item('timezone'));
					//echo 'last_owner_id('.$last_owner_id.') lineup_date: '.$lineup_date->format(DATE_ATOM)."\n\n";
				}
				if (!array_key_exists($owner_id, $teams)) {
					$teams[$owner_id] = array(
						'id' => $owner_id,
						'name' => $row['teamname'],
						'url' => site_url('team/'.$row['slug'].'/'.$year),
						'slug' => $row['slug'],
						'division' => $row['division'],
						'schedule' => $row['scheduleid'],
						'points' => 0,
						'efficiency' => sprintf("%.1f",0),
						'total_points' => $team_total_points[$owner_id],
						'possible_points' => 0,
						'lineup_date' => $lineup_date->format(DATE_ATOM),
						'players' => array(),
						'points_by_pos' => array()
					);
					for($c = 0; $c < count($positions); $c++) {
						$teams[$owner_id]['points_by_pos'][$positions[$c]] = array();
					}
				}
				$player_pos = substr($row['lineup_pos'], 1, 2);
				$lineup_pos = $row['lineup_pos'];
				$player_lineup_date = new DateTime($row['lineup_date'], $this->config->item('timezone'));
				if ($player_lineup_date > $lineup_date) {
					$lineup_date = $player_lineup_date;
					$teams[$owner_id]['lineup_date'] = $lineup_date->format(DATE_ATOM);
					//$scores[$owner_id]['lineup_date'] = date(DATE_ATOM, $lineup_date);
					//echo 'owner_id('.$owner_id.') lineup_date: '.date(DATE_ATOM, $lineup_date)."\n\n";
				}

				//echo print_r($row);
				$player_pos_index = intval(substr($row['lineup_pos'], 3));
				$game_start_date = (empty($row['gamedate'])) ? '1970-01-01 00:00:00' : $row['gamedate'];
				$game_end_date = (empty($row['enddate'])) ? '1970-01-01 00:00:00' : $row['enddate'];
				$now = new DateTime($this->config->item('now'), $this->config->item('timezone'));
				$game_start = new DateTime($game_start_date, $this->config->item('timezone'));
				$game_end = new DateTime($game_end_date, $this->config->item('timezone'));
				$player_has_played = ($game_start > $now && $row['oppteamid'] != 'BYE') ? false : true;
				$player_in_play = false;
				if ($player_pos_index > $num_starters[array_search($player_pos, $positions)]) {
					$starter = false;
				} else {
					$starter = true;
				}
				if ($row['oppteamid'] == 'BYE') {
					$player_pts = 0;
					$player_pts_val = 'B';
				} elseif (empty($row['totpts'])) {
					$player_pts = 0;
					if ($player_has_played) {
						$player_pts_val = 0;
						//$player_in_play = ($now >= $game_start && $now <= $game_end) ? true : false;
						//log_message('debug', 'Player: '.$row['name'].' in_play: '.$in_play.' now: '.$now->format(DATE_ATOM).' game_start: '.$game_start->format(DATE_ATOM).' game_end: '.$game_end->format(DATE_ATOM));
						//if ($row['totpts'] == '') {
						//	$player_in_play = true;
						//}
						//$in_play = ($player_in_play) ? 'Yes' : 'No';
						//log_message('debug', 'Player: '.$row['name'].' in_play: '.$in_play.' points: '.$row['totpts']);
					} else {
						$player_pts_val = 'NA';
						$player_in_play = true;
					}
				} else {
					$player_pts = $row['totpts'];
					$player_pts_val = $row['totpts'];
				}
				$stats = array();
				foreach ($this->config->item('stats_map') as $key => $value) {
					$stats[$key] = (!empty($row[$value])) ? $row[$value] : 0;
				}
				$position = (!empty($row['position'])) ? $row['position'] : $player_pos;
				$teams[$owner_id]['players'][] = array(
					'id' => $row['player_id'],
					'lineup_id' => $lineup_pos,
					'name' => $row['name'],
					'starter' => $starter,
					'position' => $position,
					'lineup_position' => $player_pos,
					'points' => $player_pts,
					'points_val' => $player_pts_val,
					'has_played' => $player_has_played,
					'in_play' => $player_in_play,
					'team_city' => $row['team_city'],
					'team' => $row['teamid'],
					'team_name' => $row['team_name'],
					'opponent' => ($row['gametype'] == 'H' || $row['oppteamid'] == 'BYE') ? $row['oppteamid'] : '@'.$row['oppteamid'],
					'home' => ($row['gametype'] == 'H'),
					'game_start' => $game_start->format(DATE_ATOM),
					'game_end' => $game_end->format(DATE_ATOM),
					'stats' => $stats
				);
				if ($player_pos == 'TX') $player_pos = lineup_pos_from_player_pos($row['plyr_pos']);
				$teams[$owner_id]['points_by_pos'][$player_pos][] = $player_pts;
			}
			foreach ($teams as $team_id => $team) {
				foreach ($team['players'] as $pos => $plyr) {
					$teams[$team_id]['points'] += ($plyr['starter']) ? $plyr['points'] : 0;
				}
				foreach ($team['points_by_pos'] as $pos => $points) {
					rsort($points);
					$pos_cnt = $num_starters[array_search($pos, $this->config->item('positions'))];
					if (count($points) > 0) {
						for ($p = 0; $p < $pos_cnt; $p++) {
							//log_message('debug', 'possible_points('.$team_id.')('.$pos.')['.$p.']: '.$points[$p]);
							//log_message('debug', 'points: '.print_r($points, true));
							$teams[$team_id]['possible_points'] += $points[$p];
						}
					}
				}
				$teams[$team_id]['efficiency'] = ($teams[$team_id]['possible_points'] > 0) ? sprintf("%.1f",$teams[$team_id]['points']/$teams[$team_id]['possible_points']*100) : sprintf("%.1f",0);
				unset($teams[$team_id]['points_by_pos']);
			}
		}
		foreach ($teams as $team_id => $team) {
			$team['pts_index'] = str_pad($team['points'], 2, '0', STR_PAD_LEFT)
				.str_pad(intval($team['efficiency']*10), 3, '0', STR_PAD_LEFT)
				.str_pad($team['possible_points'], 2, '0', STR_PAD_LEFT)
				.str_pad($team['total_points'], 2, '0', STR_PAD_LEFT);
			$scores[] = $team;
		}
		return $scores;
	}

	function get($year = 2015, $week = 1) {
		$team_totals = $this->teams->total_scores($year, $week);
		foreach ($team_totals as $team) {
			$team_total_points[$team['id']] = ($team['ytdtotal'] != '') ? $team['ytdtotal'] : 0;
		}
		$this->db->cache_on();
		$scores = array();
		$this->db->select('o.slug, os.teamname, o.id AS ownerid, l.playerid, l.position, p.name, p.position as plyr_pos, s.oppteamid, s.gamedate, DATE_ADD(s.gamedate, INTERVAL 3 HOUR) AS enddate, ps.totpts', FALSE);
		$this->db->join('owners o', 'o.id = l.ownerid');
		$this->db->join('owner_schedule os', 'os.ownerid = l.ownerid AND os.year = l.year');
		$this->db->join('players p', 'p.id = l.playerid AND p.year = l.year');
		$this->db->join('nfl_schedule s', 's.teamid = p.teamid AND s.week = l.week AND s.year = l.year AND s.oppteamid IS NOT NULL', null, false);
		$this->db->join('nfl_teams t', 't.teamid = p.teamid');
		$this->db->join('player_stats ps', 'ps.playerid = l.playerid AND ps.year = l.year AND ps.week = l.week', 'left');
		$this->db->where('l.week', $week);
		$this->db->where('l.year', $year);
		$this->db->order_by('os.scheduleid ASC, l.position ASC');
		$query = $this->db->get('lineup l');
		//echo '<pre>'.$this->db->last_query().'</pre>';
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			$positions = $this->config->item('positions');
			$num_starters = $this->config->item('num_starters');
			foreach ($query->result() as $row) {
				$player_pos = substr($row->position, 1, 2);
				$player_pos_index = intval(substr($row->position, 3));
				$game_date = (empty($row->enddate)) ? '1970-01-11 00:00:00' : $row->enddate;
				$player_has_played = (strtotime($game_date) > strtotime($this->config->item('now')) && $row->oppteamid != 'BYE') ? false : true;
				if (!array_key_exists($row->ownerid, $scores)) {
					$scores[$row->ownerid] = array(
						'id' => $row->ownerid,
						'name' => $row->teamname,
						'url' => site_url('team/'.$row->slug.'/'.$year),
						'points' => 0,
						'efficiency' => sprintf("%.1f",0),
						'total_points' => $team_total_points[$row->ownerid],
						'possible_points' => 0,
						'positions' => array(),
						'points_by_pos' => array()
					);
					for($c=0; $c<count($positions); $c++) {
						$scores[$row->ownerid]['positions'][$player_pos] = array();
						$scores[$row->ownerid]['points_by_pos'][$player_pos] = array();
					}
				}
				if ($player_pos_index > $num_starters[array_search($player_pos, $positions)]) {
					$player_class = 'item bnch';
					$starter = false;
				} else {
					$player_class = (!$player_has_played) ? 'item active' : 'item';
					$starter = true;
				}
				if ($row->oppteamid == 'BYE') {
					$player_pts = 0;
					$player_pts_val = 'B';
				} elseif (empty($row->totpts)) {
					$player_pts = 0;
					$player_pts_val = ($player_has_played) ? '0' : 'NA';
				} else {
					$player_pts = $row->totpts;
					$player_pts_val = $row->totpts;
				}
				$scores[$row->ownerid]['positions'][$player_pos][] = array(
					'id' => $row->playerid,
					'name' => $row->name,
					'starter' => $starter,
					'points' => $player_pts,
					'points_val' => $player_pts_val,
					'opponent' => $row->oppteamid,
					'class' => $player_class,
					'end_date' => $game_date
				);
				if ($player_pos == 'TX') $player_pos = lineup_pos_from_player_pos($row->plyr_pos);
				$scores[$row->ownerid]['points_by_pos'][$player_pos][] = $player_pts;
			}
			foreach ($scores as $team_id => $team) {
				foreach ($team['positions'] as $pos => $players) {
					foreach ($players as $plyr) {
						$scores[$team_id]['points'] += ($plyr['starter']) ? $plyr['points'] : 0;
					}
				}
				foreach ($team['points_by_pos'] as $pos => $points) {
					rsort($points);
					$pos_cnt = $num_starters[array_search($pos, $positions)];
					if ($pos_cnt > 0) {
						for ($p = 0; $p < $pos_cnt; $p++) $scores[$team_id]['possible_points'] += $points[$p];
					}
				}
				$scores[$team_id]['efficiency'] = ($scores[$team_id]['possible_points'] > 0) ? sprintf("%.1f",$scores[$team_id]['points']/$scores[$team_id]['possible_points']*100) : sprintf("%.1f",0);
			}
		}
		return $scores;
	}

	function week($year = 2015, $week = 0) {
		$this->db->cache_on();
		$scores_week = 1;
		$this->db->select_max('week','max_week');
		$this->db->where('year', $year);
		$query = $this->db->get('player_stats');
		$row = $query->row_array();
		$max_week = $row['max_week'];
		if (is_numeric($max_week)) $scores_week = $max_week;
		if ($week > 0 && $week < $scores_week) $scores_week = $week;
		$this->db->cache_off();
		return $scores_week;
	}

	function records_week($year = 2015) {
		$this->db->cache_on();
		$week = 1;
		$this->db->select_min('week','min_week');
		$this->db->where('year', $year);
		$this->db->where('gametype', 'H');
		$this->db->where("gamedate > '".$this->config->item('now')."'");
		$query = $this->db->get('nfl_schedule');
		if ($query->num_rows() == 1) {
			$row = $query->row_array();
			$min_week = (intval($row['min_week']) >= 1 && intval($row['min_week']) <= 17) ? intval($row['min_week']) - 1 : 17;
		} else {
			$min_week = 1;
		}
		//log_message('debug', 'records_week('.$year.').min_week: '.$min_week);
		if ($min_week < 17) {
			for ($i = $min_week; $i <= 17; $i++) {
				$this->db->select('id');
				$this->db->where('week', $i);
				$this->db->where('year', $year);
				$this->db->where('gametype', 'H');
				$query = $this->db->get('nfl_schedule');
				$available_games = $query->num_rows();
				//log_message('debug', 'records_week('.$year.', '.$i.').available_games: '.$available_games);
				$this->db->select('id');
				$this->db->where('week', $i);
				$this->db->where('year', $year);
				$this->db->where('gametype', 'H');
				$this->db->where("gamedate > '".$this->config->item('now')."'");
				$query = $this->db->get('nfl_schedule');
				$games_left = $query->num_rows();
				//log_message('debug', 'records_week('.$year.', '.$i.').games_left: '.$games_left);
				$week = $i;
				if ($games_left < $available_games) {
					break;
				} else {
					$week = $i;
				}
			}
		} else {
			$week = 17;
		}
		//log_message('debug', 'records_week('.$year.', '.$i.').week: '.$week);
		$this->db->cache_off();
		return $week;
	}

}
?>