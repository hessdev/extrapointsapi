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
class Teams_model extends CI_Model {

	function Teams_model() {
		parent::__construct();
	}

	function data($year = 2016, $week = 1, $owner_id = 0) {
		$this->load->model('Lineup_model', 'lineup', TRUE);
		$this->load->model('Scores_model', 'scores', TRUE);
		$this->load->model('Career_model', 'career', TRUE);
		$now = new DateTime($this->config->item('now'), $this->config->item('timezone'));
		$num_starters = $this->config->item('num_starters');
		$positions = $this->config->item('positions');
		$team_data = array();
		$schedules = array();
		$points_by_year = array();
		$team_points_by_year = array();
		$teams = $this->get_by_year($year);
		if (!empty($teams)) {
			foreach($teams as $team) {
				$team_id = $team['id'];
				$team_data[$team_id] = array(
					'id' => $team_id,
					'name' => $team['teamname'],
					'owner' => $team['firstname'].' '.$team['lastname'],
					'short_name' => $team['shortname'],
					'slug' => $team['slug'],
					'division' => substr($team['scheduleid'], 1, -1),
					'schedule' => $team['scheduleid'],
					'record' => '0-0-0',
					'record_val' => 0,
					'div_record_val' => 0,
					'total_points' => 0,
					'total_points_division' => 0,
					'efficiency' => 0,
					'possible_points' => 0,
					'points_against' => 0,
					'points_against_division' => 0,
					'h2h_index' => 0,
					'pts_index' => 0,
					'players' => array(),
					'weeks' => array(),
					'history' => array(),
					'points_by_position' => array(
						'QB' => 0,
						'RB' => 0,
						'WR' => 0,
						'PK' => 0,
						'DF' => 0
					)
				);
				$schedules[$team['scheduleid']] = $team_id;
			}
			$total_scores = $this->total_scores($year, $week);
			if (!empty($total_scores)) {
				foreach ($total_scores as $i => $team) {
					$team_id = $team['id'];
					$team_data[$team_id]['total_points'] = $team['ytdtotal'];
				}
			}
			$records = $this->get_by_record($year, $week);
			if (!empty($records)) {
				foreach ($records as $team_id => $team) {
					list($headtohead, $headtohead_div, $points, $name, $slug, $owner_id, $division, $wins, $losses, $ties, $divwins, $divlosses, $divties) = explode('^', $team);
					$team_data[$team_id]['record'] = $wins.'-'.$losses.'-'.$ties;
					$team_data[$team_id]['record_val'] = $headtohead;
					$team_data[$team_id]['div_record'] = $divwins.'-'.$divlosses.'-'.$divties;
					$team_data[$team_id]['div_record_val'] = $headtohead_div;
				}
			}
			foreach ($team_data as $team_id => $data) {
				foreach($data['points_by_position'] as $pos => $points) {
					$position_data = $this->position_rankings($year, $week, $pos);
					if (!empty($position_data)) {
						foreach ($position_data as $pdata) {
							$team_data[$pdata['id']]['points_by_position'][$pos] = $pdata['pos_points'];
						}
					}
				}
				$players = $this->player_stats($year, $week, $team_id);
				if (!empty($players)) {
					$player_list = array();
					foreach ($players as $player) {
						$player_id = $player['playerid'];
						$lineup_position = substr($player['position'], 1, 2);
						$lineup_position_index = intval(substr($player['position'], 3));
						if (!array_key_exists($player_id, $player_list)) {
							$player_list[$player_id] = array(
								'id' => $player_id,
								'name' => $player['playername'],
								'lineup_position' => $lineup_position,
								'position' => $player['playerpos'],
								'img' => $player['img'],
								'team' => $player['teamid'],
								'potential_points' => 0,
								'points' => $player['playerpts'],
								'starter_points' => 0,
								'points_ratio' => 0,
								'points_per_start' => 0,
								'starts' => 0,
								'blanks' => 0,
								'rank' => 0,
							);
						}
						$is_starter = ($lineup_position_index <= $num_starters[array_search($lineup_position, $positions)]);
						$player_list[$player_id]['potential_points'] += $player['totpts'];
						if ($is_starter) {
							$player_list[$player_id]['starter_points'] += $player['totpts'];
							$player_list[$player_id]['starts'] += 1;
							if (empty($player['totpts'])) $player_list[$player_id]['blanks'] += 1;
						}
					}
					$sorted_player_list = array();
					foreach ($player_list as $player_id => $player) {
						if (!empty($player['starts'])) {
							$player['points_per_start'] = number_format($player['starter_points'] / $player['starts'], 2, '.', '');
						}
						if (!empty($player['potential_points'])) {
							$player['points_ratio'] = number_format($player['starter_points'] / $player['potential_points'] * 100, 2, '.', '');
						}
						if (empty($player['points'])) {
							$player['points'] = 0;
						}
						$sorted_player_list[] = $player;
					}
					usort($sorted_player_list, "sort_players_by_points");
					$team_data[$team_id]['players'] = array_reverse($sorted_player_list);
					foreach ($team_data[$team_id]['players'] as $i => $player) {
						$team_data[$team_id]['players'][$i]['rank'] = $i + 1;
					}
				}
				$team_data[$team_id]['roster'] = $this->lineup->get($team_id, $year, $week);
			}
			for ($w = 1; $w <= $week; $w++) {
				$scores = $this->scores->get($year, $w);
				foreach ($scores as $team) {
					$team_id = $team['id'];
					$team_data[$team_id]['weeks'][$w] = array(
						'week' => $w,
						'points' => $team['points'],
						'efficiency' => $team['efficiency'],
						'possible_points' => $team['possible_points'],
						'total' => $team['total_points'],
						'division_game' => false,
						'opponent' => array(
							'team_name' => 'None',
							'team_id' => 0,
							'points' => 0,
							'division' => ''
						)
					);
					$team_data[$team_id]['possible_points'] += $team['possible_points'];
				}
			}
			//log_message('debug', 'team_data: '.print_r($team_data, true));
			foreach ($team_data as $team_id => $data) {
				$efficiency = ($team_data[$team_id]['possible_points'] > 0) ? $team_data[$team_id]['total_points'] / $team_data[$team_id]['possible_points'] * 100 : 0;
				$team_data[$team_id]['efficiency'] = number_format($efficiency, 2, '.', '');
				$schedule = $this->get_team_schedule($year, $team_id);
				if (!empty($schedule)) {
					foreach ($schedule as $game) {
						$game_week = $game['week'];
						$opp_team_id = $game['oppteamid'];
						//log_message('debug', 'team_data '.$team_id.' opp_team_id: '.$opp_team_id);
						$team_data[$team_id]['weeks'][$game_week]['opponent']['team_name'] = $game['oppname'];
						$team_data[$team_id]['weeks'][$game_week]['opponent']['short_name'] = $game['oppshortname'];
						$team_data[$team_id]['weeks'][$game_week]['opponent']['team_id'] = $opp_team_id ;
						$team_data[$team_id]['weeks'][$game_week]['opponent']['division'] = substr($game['oppscheduleid'], 1, -1);
						if ($game_week <= $week) {
							//log_message('debug', 'team_data(week'.$game_week.'): '.print_r($team_data[$opp_team_id]['weeks'][$game_week], true));
							$team_data[$team_id]['weeks'][$game_week]['opponent']['points'] = $team_data[$opp_team_id]['weeks'][$game_week]['points'];
							$team_data[$team_id]['points_against'] += $team_data[$opp_team_id]['weeks'][$game_week]['points'];
							if ($team_data[$team_id]['division'] == $team_data[$team_id]['weeks'][$game_week]['opponent']['division']) {
								$team_data[$team_id]['weeks'][$game_week]['division_game'] = true;
								$team_data[$team_id]['points_against_division'] += $team_data[$opp_team_id]['weeks'][$game_week]['points'];
								$team_data[$team_id]['total_points_division'] += $team_data[$team_id]['weeks'][$game_week]['points'];
							}
						} else {
							$team_data[$team_id]['weeks'][$game_week]['week'] = $game_week;
							if ($team_data[$team_id]['division'] == $team_data[$team_id]['weeks'][$game_week]['opponent']['division']) {
								$team_data[$team_id]['weeks'][$game_week]['division_game'] = true;
							} else {
								$team_data[$team_id]['weeks'][$game_week]['division_game'] = false;
							}
						}
					}
				}
				$history = $this->career->history($team_id);
				//log_message('debug', 'history: '.print_r($history, true));
				if (!empty($history)) {
					foreach ($history as $row) {
						$team_points_by_year[$team_id][$row['year']] = $row['points'];
						$history_data = array(
							'year' => $row['year'],
							'points' => $row['points'],
							'name' => $row['team'],
							'games' => $row['games'],
							'rank' => 1,
							'record' => $row['wins'].'-'.$row['losses'].'-'.$row['ties'],
							'division_record' => $row['divwins'].'-'.$row['divlosses'].'-'.$row['divties'],
							'highest_score' => $row['bestscore'],
							'lowest_score' => $row['worstscore'],
							'points_champ' => ($row['pointschamp'] == '1'),
							'h2h_champ' => ($row['headtoheadchamp'] == '1'),
							'playoffchamp' => ($row['pointschamp'] == '1'),
							'last_place' => ($row['toiletchamp'] == '1')
						);
						$team_data[$team_id]['history'][] = $history_data;
						if (!array_key_exists($row['year'], $points_by_year)) {
							$points_by_year[$row['year']] = array();
						}
					}
				}
			}
			$league_history = $this->career->history();
			if (!empty($league_history)) {
				foreach ($league_history as $row) {
					$points_by_year[$row['year']][] = $row['points'];
				}
			}
			foreach ($points_by_year as $year => $data) {
				rsort($points_by_year[$year]);
			}
			//echo '<pre>'.print_r($points_by_year, true).'</pre>';
			//echo '<pre>'.print_r($team_points_by_year, true).'</pre>';
			$teams = array();
			foreach ($team_data as $team_id => $data) {
				$data['h2h_index'] = str_pad($data['record_val'], 2, '0', STR_PAD_LEFT)
					.str_pad($data['div_record_val'], 2, '0', STR_PAD_LEFT)
					.str_pad($data['total_points'], 3, '0', STR_PAD_LEFT)
					.str_pad($data['total_points_division'], 3, '0', STR_PAD_LEFT);
				$data['pts_index'] = str_pad($data['total_points'], 3, '0', STR_PAD_LEFT)
					.str_pad($data['record_val'], 2, '0', STR_PAD_LEFT)
					.str_pad($data['div_record_val'], 2, '0', STR_PAD_LEFT)
					.str_pad($data['total_points_division'], 3, '0', STR_PAD_LEFT);
				$weeks = $data['weeks'];
				$data['weeks'] = array();
				foreach($weeks as $wk) {
					$data['weeks'][] = $wk;
				}
				foreach ($data['history'] as $y => $past_year_data) {
					$rank = 0;
					$last_rank = 0;
					$last_points = 99999;
					$past_year = $past_year_data['year'];
					//echo '<pre>'.print_r($points_by_year[$past_year], true).'</pre>';
					//echo '<pre>'.$data['name'].': '.$past_year."\n";
					foreach ($points_by_year[$past_year] as $x => $past_points) {
						//echo '-- Last Points: '.$last_points."\n";
						//echo '-- Past Points: '.$past_points."\n";
						//echo '-- Team Points: '.$team_points_by_year[$team_id][$past_year]."\n";
						$rank = ($last_points == $past_points) ? $last_rank : $x + 1;
						//echo '-- Rank: '.$rank."\n";
						if ($team_points_by_year[$team_id][$past_year] == $past_points) {
							$data['history'][$y]['rank'] = $rank;
							//echo '-- Team Rank: '.$rank."\n";
							break;
						}
						$last_rank = $rank;
						$last_points = $past_points;
					}
				}
				$teams[] = $data;
			}
			return $teams;
		}
	}

	function get_by_record($year = 2015, $week = 14) {
		$teams = array();
		$this->db->cache_on();
		$sql = 'SELECT o.slug, os.teamname, o.division, o.id AS ownerid, os.scheduleid, s.oppid AS oppscheduleid, s.week, oto.shortname AS oppname, osot.ownerid AS oppteamid'."\n";
		$sql .= ',(SELECT SUM(ps.totpts) AS ytdtotal FROM lineup l LEFT JOIN player_stats ps ON l.playerid=ps.playerid AND l.year=ps.year AND l.week=ps.week WHERE l.week=s.week AND l.year='.$this->db->escape($year).' AND l.position IN (\'AQB1\',\'BRB1\',\'BRB2\',\'CWR1\',\'CWR2\',\'DPK1\',\'EDF1\',\'EDF2\',\'EDF3\') AND l.ownerid=o.id) AS totpts_team'."\n";
		$sql .= ',(SELECT SUM(ps.totpts) AS ytdtotal FROM lineup l LEFT JOIN player_stats ps ON l.playerid=ps.playerid AND l.year=ps.year AND l.week=ps.week WHERE l.week=s.week AND l.year='.$this->db->escape($year).' AND l.position IN (\'AQB1\',\'BRB1\',\'BRB2\',\'CWR1\',\'CWR2\',\'DPK1\',\'EDF1\',\'EDF2\',\'EDF3\') AND l.ownerid=osot.ownerid ) AS totpts_oppteam'."\n";
		$sql .= 'FROM owners o, schedule s, owner_schedule os, owner_schedule osot, owners oto'."\n";
		$sql .= 'WHERE o.id=os.ownerid'."\n";
		$sql .= 'AND os.scheduleid=s.scheduleid'."\n";
		$sql .= 'AND s.oppid=osot.scheduleid'."\n";
		$sql .= 'AND s.week<='.$this->db->escape($week)."\n";
		$sql .= 'AND osot.year='.$this->db->escape($year)."\n";
		$sql .= 'AND os.year='.$this->db->escape($year)."\n";
		$sql .= 'AND osot.ownerid=oto.id'."\n";
		$sql .= 'ORDER BY os.scheduleid ASC, s.week ASC';
		$query = $this->db->query($sql);
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$owner_id = $row['ownerid'];
				$schedule_id = substr($row['scheduleid'], 0, 5);
				$opp_schedule_id = substr($row['oppscheduleid'], 0, 5);
				if (!array_key_exists($owner_id, $teams)) {
					$teams[$owner_id] = array(
						'name' => $row['teamname'],
						'slug' => $row['slug'],
						'points' => 0,
						'wins' => 0,
						'losses' => 0,
						'ties' => 0,
						'divwins' => 0,
						'divlosses' => 0,
						'divties' => 0,
						'headtohead' => 0,
						'headtoheaddiv' => 0,
						'division' => substr($row['scheduleid'], 1, -1)
					);
				}
				if (!empty($row['totpts_team'])) {
					$teams[$owner_id]['points'] += $row['totpts_team'];
					if ($row['totpts_team'] > $row['totpts_oppteam']) {
						$teams[$owner_id]['headtohead'] += 2;
						$teams[$owner_id]['wins'] += 1;
						if ($schedule_id == $opp_schedule_id) {
							$teams[$owner_id]['headtoheaddiv'] += 2;
							$teams[$owner_id]['divwins'] += 1;
						}
					} elseif ($row['totpts_team'] == $row['totpts_oppteam']) {
						$teams[$owner_id]['headtohead'] += 1;
						$teams[$owner_id]['ties'] += 1;
						if ($schedule_id == $opp_schedule_id) {
							$teams[$owner_id]['headtoheaddiv'] += 1;
							$teams[$owner_id]['divties'] += 1;
						}
					} else {
						$teams[$owner_id]['losses'] += 1;
						if ($schedule_id == $opp_schedule_id) {
							$teams[$owner_id]['divlosses'] += 1;
						}
					}
				}
			}
			/*
			echo '<pre>';
			print_r($teams);
			echo '</pre>';
			*/
			$sorted_teams = array();
			foreach ($teams as $owner_id => $team) {
				$points = sprintf("%03d", $team['points']);
				$headtohead = sprintf("%03d", $team['headtohead']);
				$headtohead_div = sprintf("%03d", $team['headtoheaddiv']);
				$sorted_teams[$owner_id] = $headtohead.'^'.$headtohead_div.'^'.$points.'^'.$team['name'].'^'.$team['slug'].'^'.$owner_id.'^'.$team['division'].'^'.$team['wins'].'^'.$team['losses'].'^'.$team['ties'].'^'.$team['divwins'].'^'.$team['divlosses'].'^'.$team['divties'];
			}
			arsort($sorted_teams);
			/*
			echo '<pre>';
			print_r($sorted_teams);
			echo '</pre>';
			*/
			return $sorted_teams;
		}
	}

	function get_by_id($owner_id = 0, $year = 2015) {
		$this->db->cache_on();
		$this->db->select('o.id, o.division, o.slug, o.leagueid, o.email, o.email1, o.email2, o.firstname, o.lastname, o.homephone, o.workphone, o.cellphone, s.teamname, s.shortname, s.abbvname, s.scheduleid');
		$this->db->join('owner_schedule s', 'o.id = s.ownerid');
		$this->db->where('s.year', $year);
		$this->db->where('o.id', $owner_id);
		$query = $this->db->get('owners o');
		$this->db->cache_off();
		if ($query->num_rows() == 1) {
			return $query->row_array();
		} else {
			return null;
		}
	}

	function get_by_slug($slug = '', $year = 2015) {
		$this->db->cache_on();
		$this->db->select('o.id, o.division, o.slug, o.leagueid, o.email, o.email1, o.email2, o.firstname, o.lastname, o.homephone, o.workphone, o.cellphone, s.teamname, s.shortname, s.abbvname, s.scheduleid');
		$this->db->join('owner_schedule s', 'o.id = s.ownerid');
		$this->db->where('s.year', $year);
		$this->db->where('o.slug', $slug);
		$query = $this->db->get('owners o');
		$this->db->cache_off();
		if ($query->num_rows() == 1) {
			return $query->row_array();
		} else {
			return null;
		}
	}

	function get_by_year($year = 2015) {
		$this->db->cache_on();
		$this->db->select('o.id, o.division, o.slug, o.leagueid, o.email, o.email1, o.email2, o.firstname, o.lastname, o.homephone, o.workphone, o.cellphone, s.teamname, s.shortname, s.abbvname, s.scheduleid');
		$this->db->join('owner_schedule s', 'o.id = s.ownerid');
		$this->db->where('s.year', $year);
		$this->db->order_by('s.scheduleid', 'ASC');
		$query = $this->db->get('owners o');
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return null;
		}
	}

	function get_team_schedule($year = 2015, $owner_id = 0) {
		$this->db->cache_on();
		$this->db->select('o.slug, os.teamname, o.id AS ownerid, os.scheduleid, s.oppid AS oppscheduleid, s.week, osot.teamname AS oppname, osot.shortname AS oppshortname, osot.ownerid AS oppteamid', FALSE);
		$this->db->join('schedule s', 's.scheduleid = os.scheduleid');
		$this->db->join('owners o', 'o.id = os.ownerid');
		$this->db->join('owner_schedule osot', 'osot.year = os.year AND osot.scheduleid = s.oppid');
		$this->db->where('os.year', $year);
		$this->db->where('o.id', $owner_id);
		$this->db->order_by('os.scheduleid', 'ASC');
		$this->db->order_by('s.week', 'ASC');
		$query = $this->db->get('owner_schedule os');
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function player_stats($year = 2015, $week = 1, $owner_id = 0) {
		$this->db->cache_on();
		$this->db->select('o.slug, os.teamname, o.id AS ownerid, l.playerid, l.position, p.name AS playername, p.position as playerpos, p.teamid, p.img, s.oppteamid, ps.totpts, l.week, (SELECT SUM(pst.totpts) FROM player_stats pst WHERE pst.playerid = l.playerid AND pst.year = '.$year.') as playerpts', FALSE);
		$this->db->join('owners o', 'o.id = l.ownerid');
		$this->db->join('owner_schedule os', 'os.ownerid = o.id AND os.year = '.$year);
		$this->db->join('players p', 'p.id = l.playerid');
		$this->db->join('nfl_teams t', 't.teamid = p.teamid');
		$this->db->join('nfl_schedule s', 's.year = l.year AND s.week = l.week AND s.teamid = p.teamid AND s.oppteamid IS NOT NULL', null, false);
		$this->db->join('player_stats ps', 'l.playerid = ps.playerid AND l.year = ps.year AND l.week = ps.week', 'left');
		$this->db->where('l.week <=', $week);
		$this->db->where('l.year', $year);
		$this->db->where('l.ownerid', $owner_id);
		$this->db->order_by('l.ownerid, l.week, l.position');
		$query = $this->db->get('lineup l');
		//echo '<pre>'.$this->db->last_query().'</pre>';
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function position_rankings($year = 2015, $week = 1, $position = 'QB') {
		$this->db->cache_on();
		$select = 'o.id, s.teamname, o.slug, '."\n";
		switch($position) {
			case 'QB':
				$select .= '(SELECT SUM(ps.totpts) FROM player_stats ps, lineup l WHERE l.ownerid=o.id AND l.position=\'AQB1\' AND l.year='.$this->db->escape($year).' AND l.week <= '.$this->db->escape($week).' AND l.playerid=ps.playerid AND l.week=ps.week AND l.year=ps.year) AS pos_points'."\n";
				break;
			case 'RB':
				$select .= '(SELECT SUM(ps.totpts) FROM player_stats ps, lineup l WHERE l.ownerid=o.id AND l.position IN (\'BRB1\',\'BRB2\') AND l.year='.$this->db->escape($year).' AND l.week <= '.$this->db->escape($week).' AND l.playerid=ps.playerid AND l.week=ps.week AND l.year=ps.year) AS pos_points'."\n";
				break;
			case 'WR':
				$select .= '(SELECT SUM(ps.totpts) FROM player_stats ps, lineup l WHERE l.ownerid=o.id AND l.position IN (\'CWR1\',\'CWR2\') AND l.year='.$this->db->escape($year).' AND l.week <= '.$this->db->escape($week).' AND l.playerid=ps.playerid AND l.week=ps.week AND l.year=ps.year) AS pos_points'."\n";
				break;
			case 'PK':
				$select .= '(SELECT SUM(ps.totpts) FROM player_stats ps, lineup l WHERE l.ownerid=o.id AND l.position=\'DPK1\' AND l.year='.$this->db->escape($year).' AND l.week <= '.$this->db->escape($week).' AND l.playerid=ps.playerid AND l.week=ps.week AND l.year=ps.year) AS pos_points'."\n";
				break;
			case 'DF':
				$select .= '(SELECT SUM(ps.totpts) FROM player_stats ps, lineup l WHERE l.ownerid=o.id AND l.position IN (\'EDF1\',\'EDF2\',\'EDF3\') AND l.year='.$this->db->escape($year).' AND l.week <= '.$this->db->escape($week).' AND l.playerid=ps.playerid AND l.week=ps.week AND l.year=ps.year) AS pos_points'."\n";
				break;
			default:
				$select .= '(SELECT SUM(ps.totpts) FROM player_stats ps, lineup l WHERE l.ownerid=o.id AND l.position IN (\'AQB1\',\'BRB1\',\'BRB2\',\'CWR1\',\'CWR2\',\'DPK1\',\'EDF1\',\'EDF2\',\'EDF3\') AND l.year='.$this->db->escape($year).' AND l.week <= '.$this->db->escape($week).' AND l.playerid=ps.playerid AND l.week=ps.week AND l.year=ps.year) AS pos_points'."\n";
		}
		$this->db->select($select, FALSE);
		$this->db->join('owner_schedule s', 's.ownerid = o.id AND s.year = '.$this->db->escape($year));
		$this->db->order_by('pos_points', 'DESC');
		$query = $this->db->get('owners o');
		//echo '<pre>'.$this->db->last_query().'</pre>';
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function total_scores($year = 2015, $week = 0, $team_id = 0) {
		$this->db->cache_on();
		$this->db->select('o.id, o.slug, s.teamname, (SELECT SUM(s.totpts) AS ytdtotal FROM lineup l LEFT JOIN player_stats s ON l.playerid=s.playerid AND l.year=s.year AND l.week=s.week WHERE l.week<='.$this->db->escape($week).' AND l.year='.$this->db->escape($year).' AND l.position IN (\'AQB1\',\'BRB1\',\'BRB2\',\'CWR1\',\'CWR2\',\'DPK1\',\'EDF1\',\'EDF2\',\'EDF3\') AND l.ownerid=o.id ) AS ytdtotal', false);
		$this->db->join('owner_schedule s','s.ownerid = o.id AND s.year = '.$this->db->escape($year));
		if (!empty($team_id)) $this->db->where('o.id', $team_id);
		$this->db->order_by('ytdtotal DESC', FALSE);
		$query = $this->db->get('owners o');
		//echo '<pre>'.$this->db->last_query().'</pre>';
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function total_scores_by_week($year = 2015, $week = 0) {
		$this->db->cache_on();
		$this->db->select('o.id, o.slug, s.teamname, (SELECT SUM(s.totpts) AS ytdtotal FROM lineup l LEFT JOIN player_stats s ON l.playerid=s.playerid AND l.year=s.year AND l.week=s.week WHERE l.week='.$this->db->escape($week).' AND l.year='.$this->db->escape($year).' AND l.position IN (\'AQB1\',\'BRB1\',\'BRB2\',\'CWR1\',\'CWR2\',\'DPK1\',\'EDF1\',\'EDF2\',\'EDF3\') AND l.ownerid=o.id ) AS wktotal', false);
		$this->db->join('owner_schedule s','s.ownerid = o.id AND s.year = '.$this->db->escape($year));
		$this->db->order_by('wktotal DESC', FALSE);
		$query = $this->db->get('owners o');
		//echo '<pre>'.$this->db->last_query().'</pre>';
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

}
?>