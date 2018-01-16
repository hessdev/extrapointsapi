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
class Players_model extends CI_Model {

	function Players_model() {
		parent::__construct();
	}

	function get($player_id = 0, $year = 0) {
		$player = array(
			'player_id' => $player_id
		);
		if (!empty($player_id)) {
			$this->db->cache_on();
			$this->db->select('p.id, p.year, p.name AS playername, p.img, p.position, p.height, p.weight, p.college, p.born, t.teamid, t.name AS teamname, t.team, t.zip');
			$this->db->where('p.id', $player_id, FALSE);
			if (!empty($year)) $this->db->where('p.year', $year);
			$this->db->join('nfl_teams t', 'p.teamid = t.teamid', FALSE);
			$this->db->limit(1);
			$query = $this->db->get('players p');
			$this->db->cache_off();
			if ($query->num_rows() == 1) {
				$data = $query->row_array();
				$player_slug = url_title($data['playername'].'-'.$data['teamid'], '-', true);
				$player = array(
					'year' => $year,
					'player_slug' => $player_slug,
					'player_id' => $data['id'],
					'player_name' => $data['playername'],
					'player_img' => $data['img'],
					'position' => $data['position'],
					'height' => $data['height'],
					'weight' => $data['weight'],
					'college' => $data['college'],
					'born' => $data['born'],
					'team' => $data['teamid'],
					'team_name' => $data['teamname'],
					'team_city' => $data['team'],
					'team_zip' => $data['zip']
				);
				switch ($data['position']) {
					case 'CB':
					case 'DB':
					case 'DE':
					case 'DL':
					case 'DT':
					case 'LB':
					case 'NT':
					case 'S':
						$player['lineup_position'] = 'DF';
						break;
					case 'TE':
						$player['lineup_position'] = 'WR';
						break;
					default:
						$player['lineup_position'] = $player['position'];
						break;
				}
			} else {
				$player = array();
			}
		}
		return $player;
	}

	function get_total_points($player_id = 0, $year = 2015, $week = 17) {
		$this->db->cache_on();
		$this->db->select_sum('totpts');
		$this->db->where('playerid', $player_id);
		$this->db->where('year', $year);
		$this->db->where('week <=', $week);
		$query = $this->db->get('player_stats');
		$this->db->cache_off();
		$result = $query->result();
		return $result[0]->totpts;
	}

	function stats($player_id = 0, $year = 2015) {
		$stats = array(
			'weeks_played' => array(),
			'tds' => 0,
			'off_tds' => 0,
			'def_tds' => 0,
			'st_tds' => 0,
			'total_pts' => 0,
			'pass_atts' => 0,
			'pass_comp' => 0,
			'pass_yds' => 0,
			'pass_td' => 0,
			'pass_pts' => 0,
			'rush_atts' => 0,
			'rush_yds' => 0,
			'rush_td' => 0,
			'rush_pts' => 0,
			'receptions' => 0,
			'rec_yds' => 0,
			'rec_td' => 0,
			'targets' => 0,
			'rec_pts' => 0,
			'twoptconv' => 0,
			'fg_made' => 0,
			'fg_atts' => 0,
			'fg_made_lt40' => 0,
			'fg_made_gt40' => 0,
			'fg_made_gt50' => 0,
			'fg_made_gt60' => 0,
			'kick_pts' => 0,
			'interceptions' => 0,
			'sacks' => 0,
			'sack_pts' => 0,
			'def_pts' => 0,
			'fum_td' => 0,
			'int_td' => 0,
			'kick_td' => 0,
			'punt_td' => 0,
			'other_td' => 0
		);
		if (!empty($player_id)) {
			//$this->db->cache_on();
			$this->db->select('p.*, t.*, s.*, o.zip as oppzip, DATE_ADD(s.gamedate, INTERVAL '.$this->config->item('time_diff').' HOUR) AS gamedate', FALSE);
			$this->db->where('p.playerid', $player_id);
			if (!empty($year)) $this->db->where('p.year', $year);
			$this->db->join('nfl_teams t', 'p.team = t.teamid', FALSE);
			$this->db->join('nfl_schedule s', 'p.team = s.teamid AND p.year = s.year AND p.week = s.week', FALSE);
			$this->db->join('nfl_teams o', 's.oppteamid = o.teamid', FALSE);
			$query = $this->db->get('player_stats p');
			//$this->db->cache_off();
			log_message('debug', $this->db->last_query());
			if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $stat) {
					if (!in_array($stat['week'], $stats['weeks_played'])) $stats['weeks_played'][] = $stat['week'];
					$stats['total_pts'] += $stat['totpts'];
					$stats['pass_atts'] += $stat['passatt'];
					$stats['pass_comp'] += $stat['passcomp'];
					$stats['pass_yds'] += $stat['passyds'];
					if (isset($stat['passyds'])) {
						if ($stat['passyds'] > 249) {
							$stats['pass_pts'] += 2 + intval(($stat['passyds'] - 250) / 50);
						}
					}
					$stats['rush_atts'] += $stat['rushes'];
					$stats['rush_yds'] += $stat['rushyds'];
					if (isset($stat['rushyds'])) {
						if ($stat['rushyds'] > 74 && $stat['rushyds'] < 100) {
							$stats['rush_pts'] += 3;
						} elseif ($stat['rushyds'] > 99) {
							$stats['rush_pts'] += 4 + intval(($stat['rushyds'] - 100) / 25);
						}
					}
					$stats['rec_yds'] += $stat['recyds'];
					if (isset($stat['recyds'])) {
						if ($stat['recyds'] > 74) {
							$stats['rec_pts'] += 1 + intval(($stat['recyds'] - 75) / 25);
						}
					}
					$stats['receptions'] += $stat['receptions'];
					if (isset($stat['receptions'])) {
						$stats['rec_pts'] += intval($stat['receptions'] / 3);
					}
					$stats['targets'] += $stat['targets'];
					$stats['pass_td'] += $stat['passtd'];
					$stats['rush_td'] += $stat['rushtd'];
					$stats['rec_td'] += $stat['rectd'];
					$stats['punt_td'] += $stat['puntrettd'];
					$stats['other_td'] += $stat['otrrettd'];
					$stats['int_td'] += $stat['inttd'];
					$stats['fum_td'] += $stat['fumtd'];
					$stats['punt_td'] += $stat['puntrettd'];
					$stats['other_td'] += $stat['otrrettd'];
					$stats['off_tds'] += $stat['passtd'] + $stat['rushtd'] + $stat['rectd'];
					$stats['def_tds'] += $stat['fumtd'] + $stat['inttd'];
					$stats['st_tds'] += $stat['kicktd'] + $stat['puntrettd'] + $stat['otrrettd'];
					$stats['twoptconv'] += $stat['twoptpassconv'] + $stat['twoptrunconv'] + $stat['twoptrecvconv'];
					$stats['fg_atts'] += $stat['fgatts'];
					$stats['fg_made'] += $stat['fgmade'];
					$stats['fg_made_lt40'] += $stat['fgmadelt40'];
					$stats['fg_made_gt40'] += $stat['fgmadegt40'];
					$stats['fg_made_gt50'] += $stat['fgmadegt50'];
					$stats['fg_made_gt60'] += $stat['fgmadegt60'];
					$stats['interceptions'] += $stat['interceptions'];
					$stats['sacks'] += $stat['defsacks'];
					if (isset($stat['defsacks'])) $stats['sack_pts'] += ceil($stat['defsacks']);
					$stats['def_pts'] = $stats['sack_pts'] + ($stats['interceptions'] * 2);
				}
				$stats['tds'] = $stats['off_tds'] + $stats['def_tds'] + $stats['st_tds'];
				$stats['kick_pts'] = $stats['fg_made_lt40'] + (2 * $stats['fg_made_gt40']) + (3 * $stats['fg_made_gt50']) + (10 * $stats['fg_made_gt60']);
			}
		}
		return $stats;
	}

	function schedule($player_id = '') {
		$schedule = array();
		//$this->db->cache_on();
		$this->db->select('s.week, s.gamedate, s.gametype, t.teamid AS team, t.type AS hometype, t.city AS homecity, t.state AS homestate, t.stadium AS homestadium, t.surface AS homesurface, ot.teamid AS oppteam, ot.type AS awaytype, ot.city AS awaycity, ot.state AS awaystate, ot.stadium AS awaystadium, ot.surface AS awaysurface', FALSE);
		$this->db->join('nfl_teams t', 'p.teamid = t.teamid', FALSE);
		$this->db->join('nfl_schedule s', 'p.teamid = s.teamid AND p.year = s.year', FALSE);
		$this->db->join('nfl_teams ot', 's.oppteamid = ot.teamid', FALSE);
		$this->db->where('p.id', $player_id, FALSE);
		$this->db->order_by('s.week');
		$query = $this->db->get('players p');
		log_message('debug', $this->db->last_query());
		//$this->db->cache_off();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $game) {
				if ($game['gametype'] == 'H') {
					$game_type = $game['gametype'];
					$opponent = $game['oppteam'];
					$stadium = $game['homestadium'];
					$stadium_type = $game['hometype'];
					$surface = $game['homesurface'];
					$location = $game['homecity'].', '.$game['homestate'];
					$game_date = new DateTime($game['gamedate'], $this->config->item('timezone'));
					$game_date_str = $game_date->format(DATE_ATOM);
				} elseif ($game['gametype'] == 'A') {
					$game_type = $game['gametype'];
					$opponent = '@'.$game['oppteam'];
					$stadium = $game['awaystadium'];
					$stadium_type = $game['awaytype'];
					$surface = $game['awaysurface'];
					$location = $game['awaycity'].', '.$game['awaystate'];
					$game_date = new DateTime($game['gamedate'], $this->config->item('timezone'));
					$game_date_str = $game_date->format(DATE_ATOM);
				} else {
					$opponent = $game['oppteam'];
					$stadium = '';
					$stadium_type = '';
					$surface = '';
					$location = '';
					$game_date_str = '';
					$game_type = 'B';
				}
				$schedule[] = array(
					'week' => $game['week'],
					'type' => $game_type,
					'opponent' => $opponent,
					'stadium' => $stadium,
					'stadium_type' => $stadium_type,
					'surface' => $surface,
					'location' => $location,
					'date' => $game_date_str
				);
			}
		}
		return $schedule;
	}

	function results($player_id = 0, $year = 2015) {
		$results = array(
			'stats' => array(
				'weeks_played' => array(),
				'tds' => 0,
				'off_tds' => 0,
				'def_tds' => 0,
				'st_tds' => 0,
				'total_pts' => 0,
				'pass_atts' => 0,
				'pass_comp' => 0,
				'pass_yds' => 0,
				'pass_td' => 0,
				'pass_pts' => 0,
				'rush_atts' => 0,
				'rush_yds' => 0,
				'rush_td' => 0,
				'rush_pts' => 0,
				'receptions' => 0,
				'rec_yds' => 0,
				'targets' => 0,
				'rec_td' => 0,
				'rec_pts' => 0,
				'twopt_conv' => 0,
				'fg_made' => 0,
				'fg_atts' => 0,
				'fg_made_lt40' => 0,
				'fg_made_gt40' => 0,
				'fg_made_gt50' => 0,
				'fg_made_gt60' => 0,
				'kick_pts' => 0,
				'interceptions' => 0,
				'sacks' => 0,
				'sack_pts' => 0,
				'def_pts' => 0,
				'fum_td' => 0,
				'int_td' => 0,
				'kick_td' => 0,
				'punt_td' => 0,
				'other_td' => 0
			),
			'games' => array()
		);
		if (!empty($player_id)) {
			$this->db->cache_on();
			$this->db->select('p.id as player_id, s.week as game_week, s.gamedate, s.gametype, t.teamid AS teamid, t.type AS hometype, t.city AS homecity, t.state AS homestate, t.stadium AS homestadium, t.surface AS homesurface, ot.teamid AS oppteam, ot.type AS awaytype, ot.city AS awaycity, ot.state AS awaystate, ot.stadium AS awaystadium, ot.surface AS awaysurface, ps.*', FALSE);
			$this->db->where('p.id', $player_id);
			if (!empty($year)) $this->db->where('p.year', $year);
			$this->db->join('nfl_teams t', 'p.teamid = t.teamid', FALSE);
			$this->db->join('nfl_schedule s', 'p.teamid = s.teamid AND p.year = s.year', FALSE);
			$this->db->join('nfl_teams ot', 's.oppteamid = ot.teamid', FALSE);
			$this->db->join('player_stats ps', 'ps.playerid = p.id AND ps.year = s.year AND ps.week = s.week', 'left');
			$this->db->order_by('s.week', 'ASC');
			$query = $this->db->get('players p');
			$this->db->cache_off();
			//log_message('debug', $this->db->last_query());
			if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $result) {
					if ($result['gametype'] == 'H') {
						$game_type = $result['gametype'];
						$opponent = $result['oppteam'];
						$stadium = $result['homestadium'];
						$stadium_type = $result['hometype'];
						$surface = $result['homesurface'];
						$location = $result['homecity'].', '.$result['homestate'];
						$game_date = new DateTime($result['gamedate'], $this->config->item('timezone'));
						$game_date_str = $game_date->format(DATE_ATOM);
					} elseif ($result['gametype'] == 'A') {
						$game_type = $result['gametype'];
						$opponent = '@'.$result['oppteam'];
						$stadium = $result['awaystadium'];
						$stadium_type = $result['awaytype'];
						$surface = $result['awaysurface'];
						$location = $result['awaycity'].', '.$result['awaystate'];
						$game_date = new DateTime($result['gamedate'], $this->config->item('timezone'));
						$game_date_str = $game_date->format(DATE_ATOM);
					} else {
						$opponent = $result['oppteam'];
						$stadium = '';
						$stadium_type = '';
						$surface = '';
						$location = '';
						$game_date_str = '';
						$game_type = 'B';
					}
					$week = array(
						'week' => $result['game_week'],
						'type' => $game_type,
						'opponent' => $opponent,
						'stadium' => $stadium,
						'stadium_type' => $stadium_type,
						'surface' => $surface,
						'location' => $location,
						'date' => $game_date_str
					);
					if (!in_array($result['week'], $results['stats']['weeks_played']) && !empty($result['week'])) {
						$results['stats']['weeks_played'][] = intval($result['week']);
					}
					$results['stats']['total_pts'] += $result['totpts'];
					$results['stats']['pass_atts'] += $result['passatt'];
					$results['stats']['pass_comp'] += $result['passcomp'];
					$results['stats']['pass_yds'] += $result['passyds'];
					if (isset($result['passyds'])) {
						if ($result['passyds'] > 249) {
							$results['stats']['pass_pts'] += 2 + intval(($result['passyds'] - 250) / 50);
						}
					}
					$results['stats']['rush_atts'] += $result['rushes'];
					$results['stats']['rush_yds'] += $result['rushyds'];
					if (isset($result['rushyds'])) {
						if ($result['rushyds'] > 74 && $result['rushyds'] < 100) {
							$results['stats']['rush_pts'] += 3;
						} elseif ($result['rushyds'] > 99) {
							$results['stats']['rush_pts'] += 4 + intval(($result['rushyds'] - 100) / 25);
						}
					}
					$results['stats']['rec_yds'] += $result['recyds'];
					if (isset($result['recyds'])) {
						if ($result['recyds'] > 74) {
							$results['stats']['rec_pts'] += 1 + intval(($result['recyds'] - 75) / 25);
						}
					}
					$results['stats']['receptions'] += $result['receptions'];
					if (isset($result['receptions'])) {
						$results['stats']['rec_pts'] += intval($result['receptions'] / 3);
					}
					$results['stats']['targets'] += $result['targets'];
					$results['stats']['pass_td'] += $result['passtd'];
					$results['stats']['rush_td'] += $result['rushtd'];
					$results['stats']['rec_td'] += $result['rectd'];
					$results['stats']['punt_td'] += $result['puntrettd'];
					$results['stats']['other_td'] += $result['otrrettd'];
					$results['stats']['int_td'] += $result['inttd'];
					$results['stats']['fum_td'] += $result['fumtd'];
					$results['stats']['punt_td'] += $result['puntrettd'];
					$results['stats']['other_td'] += $result['otrrettd'];
					$results['stats']['off_tds'] += $result['passtd'] + $result['rushtd'] + $result['rectd'];
					$results['stats']['def_tds'] += $result['fumtd'] + $result['inttd'];
					$results['stats']['st_tds'] += $result['kicktd'] + $result['puntrettd'] + $result['otrrettd'];
					$results['stats']['twopt_conv'] += $result['2ptpassconv'] + $result['2ptrunconv'] + $result['2ptrecvconv'];
					$results['stats']['fg_atts'] += $result['fgatts'];
					$results['stats']['fg_made'] += $result['fgmade'];
					$results['stats']['fg_made_lt40'] += $result['fgmadelt40'];
					$results['stats']['fg_made_gt40'] += $result['fgmadegt40'];
					$results['stats']['fg_made_gt50'] += $result['fgmadegt50'];
					$results['stats']['fg_made_gt60'] += $result['fgmadegt60'];
					$results['stats']['interceptions'] += $result['interceptions'];
					$results['stats']['sacks'] += $result['defsacks'];
					if (isset($result['defsacks'])) $results['stats']['sack_pts'] += ceil($result['defsacks']);
					$results['stats']['def_pts'] = $results['stats']['sack_pts'] + ($results['stats']['interceptions'] * 2);
					foreach ($this->config->item('stats_map') as $key => $value) {
						$week[$key] = $result[$value];
					}
					$week['tds'] = $week['pass_td'] + $week['rush_td'] + $week['rec_td'] + $week['punt_td'] + $week['kick_td'] + $week['other_td'] + $week['fum_td'] +  + $week['int_td'];
					$results['games'][] = $week;
				}
				$results['stats']['tds'] = $results['stats']['off_tds'] + $results['stats']['def_tds'] + $results['stats']['st_tds'];
				$results['stats']['kick_pts'] = $results['stats']['fg_made_lt40'] + (2 * $results['stats']['fg_made_gt40']) + (3 * $results['stats']['fg_made_gt50']) + (10 * $results['stats']['fg_made_gt60']);
			}
		}
		return $results;
	}

	function leaders($year = 2015, $week = 17, $position = 'all', $limit = 50) {
		//$this->db->cache_on();
		$leaders = array();
		$this->db->select('p.id, p.name, p.teamid, p.position, l.ownerid, os.teamname, os.shortname, o.slug, (SELECT SUM(s.totpts) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS totpts', FALSE);
		$this->db->join('lineup l', 'p.id = l.playerid AND p.year = l.year AND l.week = '.$this->db->escape($week), 'left');
		$this->db->join('owner_schedule os', 'l.ownerid = os.ownerid AND l.year = os.year', 'left');
		$this->db->join('owners o', 'l.ownerid = o.id', 'left');
		$this->db->where('p.year', $year);
		log_message('debug', 'players_modal->leaders->position: '.$position);
		switch ($position) {
			case 'qb':
				$this->db->where('p.position', 'QB');
				break;
			case 'rb':
				$this->db->where('p.position', 'RB');
				break;
			case 'wr':
				$this->db->where_in('p.position', array('WR','TE'));
				break;
			case 'pk':
				$this->db->where('p.position', 'K');
				break;
			case 'df':
				$this->db->where_in('p.position', array('DB','DL','LB','CB','DE','DT','S'));
				break;
		}
		$this->db->order_by('totpts', 'DESC');
		$this->db->limit($limit);
		$query = $this->db->get('players p');
		//log_message('debug', $this->db->last_query());
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			$rank = 0;
			$last_points = 0;
			foreach ($query->result_array() as $player) {
				$player_stats = $this->results($player['id'], $year);
				$leader = $player_stats['stats'];
				if ($leader['total_pts'] != $last_points) {
					$rank += 1;
					$last_points = $leader['total_pts'];
				}
				$leader['id'] = $player['id'];
				$leader['name'] = $player['name'];
				$leader['rank'] = $rank;
				$leader['position'] = $player['position'];
				$leader['team'] = $player['teamid'];
				$leader['owner'] = $player['teamname'];
				$leader['owner_short'] = $player['shortname'];
				$leader['owner_slug'] = $player['slug'];
				switch ($leader['position']) {
					case 'QB':
						$leader['yards'] = $leader['pass_yds'];
						break;
					case 'RB':
						$leader['yards'] = $leader['rush_yds'];
						break;
					case 'WR':
					case 'TE':
						$leader['yards'] = $leader['rec_yds'];
						break;
					default:
						$leader['yards'] = '';
						break;
				}
				//log_message('debug', print_r($leader, true));
				$leaders[] = $leader;
			}
		}
		return $leaders;
	}

	function top($year = 2015, $week = 1, $sweek = 1, $position = '', $limit = 40) {
		$this->db->cache_on();
		$where = '';
		$sql = 'SELECT p.id, p.name, p.teamid, p.position, l.ownerid'."\n";
		$sql .= ',(SELECT SUM(s.totpts) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS totpts'."\n";
		if ($position != '') {
			$sql .= ',(SELECT SUM(s.passtd+s.rushtd+s.rectd+s.fumtd) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS tds'."\n";
			$sql .= ',(SELECT SUM(s.kicktd+s.puntrettd) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS rettd'."\n";
			$sql .= ',(SELECT SUM(s.twoptrunconv+s.twoptpassconv+s.twoptrecvconv) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS twoptconv'."\n";
		}
		if ($position == 'QB') {
			$sql .= ',(SELECT SUM(s.passyds) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS passyds'."\n";
			$sql .= ',(SELECT SUM(s.passatt) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS passatt'."\n";
			$sql .= ',(SELECT SUM(s.passcomp) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS passcomp'."\n";
			$sql .= ',(SELECT SUM(s.rushyds) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS rushyds'."\n";
			$sql .= ',(SELECT SUM(s.rushes) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS rushes'."\n";
			$where = 'p.position=\'QB\'';
			$order_by = 'ORDER BY totpts DESC, tds DESC, passyds DESC, p.teamid DESC, p.position ASC';
		} elseif ($position == 'RB') {
			$sql .= ',(SELECT SUM(s.rushyds) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS rushyds'."\n";
			$sql .= ',(SELECT SUM(s.rushes) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS rushes'."\n";
			$sql .= ',(SELECT SUM(s.recyds) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS recyds'."\n";
			$sql .= ',(SELECT SUM(s.receptions) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS receptions'."\n";
			$where = 'p.position=\'RB\'';
			$order_by = 'ORDER BY totpts DESC, tds DESC, rushyds DESC, recyds DESC, p.teamid DESC, p.position ASC';
		} elseif ($position == 'WR') {
			$sql .= ',(SELECT SUM(s.recyds) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS recyds'."\n";
			$sql .= ',(SELECT SUM(s.receptions) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS receptions'."\n";
			$where = 'p.position IN (\'WR\',\'TE\')';
			$order_by = 'ORDER BY totpts DESC, tds DESC, recyds DESC, p.teamid DESC, p.position ASC';
		} elseif ($position == 'PK') {
			$sql .= ',(SELECT SUM(s.fgmadelt40) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS fgmadelt40'."\n";
			$sql .= ',(SELECT SUM(s.fgmadegt40) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS fgmadegt40'."\n";
			$sql .= ',(SELECT SUM(s.fgmadegt50) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS fgmadegt50'."\n";
			$sql .= ',(SELECT SUM(s.fgmadegt60) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS fgmadegt60'."\n";
			$where = 'p.position=\'K\'';
			$order_by = 'ORDER BY totpts DESC, fgmadegt50 DESC, fgmadegt40 DESC, fgmadelt40 DESC, p.teamid DESC, p.position ASC';
		} elseif ($position == 'DF') {
			$sql .= ',(SELECT SUM(s.interceptions) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS interceptions'."\n";
			$sql .= ',(SELECT SUM(s.defsacks) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS defsacks'."\n";
			$sql .= ',(SELECT SUM(s.safeties) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS safeties'."\n";
			$sql .= ',(SELECT SUM(s.inttd+s.otrrettd+s.fumtd) FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week<='.$this->db->escape($week).') AS deftd'."\n";
			$where = 'p.position IN (\'DB\',\'DL\',\'LB\',\'CB\',\'DE\',\'DT\',\'S\')';
			$order_by = 'ORDER BY totpts DESC, tds DESC, defsacks DESC, interceptions DESC, deftd DESC, p.teamid DESC, p.position ASC';
		} else {
			$order_by = 'ORDER BY totpts DESC, p.teamid DESC, p.position ASC';
		}
		$sql .= ',(SELECT s.position FROM player_stats s WHERE s.playerid=p.id AND s.year='.$this->db->escape($year).' AND s.week='.$this->db->escape($sweek).' AND s.week<='.$this->db->escape($week).') AS sposition'."\n";
		$sql .= 'FROM players p'."\n";
		$sql .= 'LEFT JOIN lineup l ON p.id=l.playerid'."\n";
		$sql .= 'AND p.year=l.year'."\n";
		$sql .= 'AND l.week='.$this->db->escape($week)."\n";
		$sql .= 'WHERE p.year='.$this->db->escape($year)."\n";
		if ($where != '') $sql .= 'AND '.$where."\n";
		$sql .= $order_by."\n";
		$sql .= 'LIMIT '.$limit."\n";
		$query = $this->db->query($sql);
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}
}
?>