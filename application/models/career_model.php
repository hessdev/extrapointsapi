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
class Career_model extends CI_Model {

	function Career_model() {
		parent::__construct();
	}

	function data($start_year = 1996, $end_year = 2016) {
		$career = array();
		$career_stats = array();
		$max_year = 1996;
		$min_year = $this->config->item('default_year');
		$this->db->cache_on();
		$this->db->select('c.*, o.id as ownerid, o.slug, o.teamname, o.shortname, o.firstname, o.lastname');
		$this->db->join('owners o', 'o.id = c.ownerid');
		$this->db->where('c.year >= ', $start_year);
		$this->db->where('c.year <= ', $end_year);
		$this->db->order_by('c.year', 'DESC');
		$query = $this->db->get('career_stats c');
		//log_message('debug', 'career_model->data: '.$this->db->last_query());
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$team_id = $row['ownerid'];
				if (!array_key_exists($team_id, $career_stats)) {
					$career_stats[$team_id] = array(
						'id' => $team_id,
						'name' => $row['teamname'],
						'owner' => $row['firstname'].' '.$row['lastname'],
						'short_name' => $row['shortname'],
						'slug' => $row['slug'],
						'games' => 0,
						'points' => 0,
						'wins' => 0,
						'losses' => 0,
						'ties' => 0,
						'divwins' => 0,
						'divlosses' => 0,
						'divties' => 0,
						'bestscore' => 0,
						'worstscore' => 100,
						'bestyear' => 0,
						'worstyear' => 1000,
					);
				}
				$career_stats[$team_id]['points'] += $row['points'];
				$career_stats[$team_id]['games'] += $row['games'];
				$career_stats[$team_id]['wins'] += $row['wins'];
				$career_stats[$team_id]['losses'] += $row['losses'];
				$career_stats[$team_id]['ties'] += $row['ties'];
				$career_stats[$team_id]['divwins'] += $row['divwins'];
				$career_stats[$team_id]['divlosses'] += $row['divlosses'];
				$career_stats[$team_id]['divties'] += $row['divties'];
				if ($row['points'] > $career_stats[$team_id]['bestyear']) {
					$career_stats[$team_id]['bestyear'] = $row['points'];
				}
				if ($row['points'] < $career_stats[$team_id]['worstyear']) {
					$career_stats[$team_id]['worstyear'] = $row['points'];
				}
				if ($row['bestscore'] > $career_stats[$team_id]['bestscore']) {
					$career_stats[$team_id]['bestscore'] = $row['bestscore'];
				}
				if ($row['worstscore'] < $career_stats[$team_id]['worstscore']) {
					$career_stats[$team_id]['worstscore'] = $row['worstscore'];
				}
				if ($row['year'] < $min_year) $min_year = $row['year'];
				if ($row['year'] > $max_year) $max_year = $row['year'];
			}
		}
		if (!empty($career_stats)) {
			foreach ($career_stats as $team_id => $team) {
				$career[] = $team;
			}
		}
		usort($career, "sort_teams_by_points");
		return array($career, $min_year, $max_year);
	}

	function head_to_head($start_year = 1996, $end_year = 2016) {
		$max_year = $this->max_year();
		$career_stats = array();
		$this->db->cache_on();
		// TESTING
		//$max_year = 2007;
		$sql = 'SELECT DISTINCT c.ownerid, o.teamname, o.slug'."\n";
		$sql .= ',(SELECT SUM(cs.games) FROM career_stats cs WHERE cs.ownerid=c.ownerid AND cs.year>='.$this->db->escape($start_year).' AND cs.year<='.$this->db->escape($end_year).') AS games'."\n";
		$sql .= ',(SELECT SUM(cs.wins) FROM career_stats cs WHERE cs.ownerid=c.ownerid AND cs.year>='.$this->db->escape($start_year).' AND cs.year<='.$this->db->escape($end_year).') AS wins'."\n";
		$sql .= ',(SELECT SUM(cs.losses) FROM career_stats cs WHERE cs.ownerid=c.ownerid AND cs.year>='.$this->db->escape($start_year).' AND cs.year<='.$this->db->escape($end_year).') AS losses'."\n";
		$sql .= ',(SELECT SUM(cs.ties) FROM career_stats cs WHERE cs.ownerid=c.ownerid AND cs.year>='.$this->db->escape($start_year).' AND cs.year<='.$this->db->escape($end_year).') AS ties'."\n";
		$sql .= ',(SELECT SUM(cs.divwins) FROM career_stats cs WHERE cs.ownerid=c.ownerid AND cs.year>='.$this->db->escape($start_year).' AND cs.year<='.$this->db->escape($end_year).') AS divwins'."\n";
		$sql .= ',(SELECT SUM(cs.divlosses) FROM career_stats cs WHERE cs.ownerid=c.ownerid AND cs.year>='.$this->db->escape($start_year).' AND cs.year<='.$this->db->escape($end_year).') AS divlosses'."\n";
		$sql .= ',(SELECT SUM(cs.divties) FROM career_stats cs WHERE cs.ownerid=c.ownerid AND cs.year>='.$this->db->escape($start_year).' AND cs.year<='.$this->db->escape($end_year).') AS divties'."\n";
		$sql .= 'FROM career_stats c, owners o'."\n";
		$sql .= 'WHERE c.ownerid=o.id'."\n";
		$sql .= 'ORDER BY wins DESC, losses ASC, ties DESC, divwins DESC, divlosses ASC, divties DESC';
		log_message('debug', 'Career H2H: '.$sql);
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) $career_stats = $query->result_array();
		//echo '<h1>Career Stats</h1>'."\n";
		//echo '<pre>'."\n";
		//print_r($career_stats);
		//echo '</pre>'."\n";
		$query->free_result();
		if ($end_year > $max_year) {
			//echo '// GETTING FULL DATA'."\n";
			$sql = 'SELECT o.id AS ownerid, o.division, oto.division as oppdivision, s.week'."\n";
			$sql .= ',(SELECT SUM(ps.totpts) AS ytdtotal FROM lineup l LEFT JOIN player_stats ps ON l.playerid=ps.playerid AND l.year=ps.year AND l.week=ps.week WHERE l.week=s.week AND l.year='.$this->db->escape($end_year).' AND l.position IN (\'AQB1\',\'BRB1\',\'BRB2\',\'CWR1\',\'CWR2\',\'DPK1\',\'EDF1\',\'EDF2\',\'EDF3\') AND l.ownerid=o.id) AS totpts_team'."\n";
			$sql .= ',(SELECT SUM(ps.totpts) AS ytdtotal FROM lineup l LEFT JOIN player_stats ps ON l.playerid=ps.playerid AND l.year=ps.year AND l.week=ps.week WHERE l.week=s.week AND l.year='.$this->db->escape($end_year).' AND l.position IN (\'AQB1\',\'BRB1\',\'BRB2\',\'CWR1\',\'CWR2\',\'DPK1\',\'EDF1\',\'EDF2\',\'EDF3\') AND l.ownerid=osot.ownerid) AS totpts_oppteam'."\n";
			$sql .= 'FROM owners o, schedule s, owner_schedule os, owner_schedule osot, owners oto'."\n";
			$sql .= 'WHERE o.id=os.ownerid'."\n";
			$sql .= 'AND os.scheduleid=s.scheduleid'."\n";
			$sql .= 'AND s.oppid=osot.scheduleid'."\n";
			$sql .= 'AND osot.year='.$this->db->escape($end_year)."\n";
			$sql .= 'AND os.year='.$this->db->escape($end_year)."\n";
			$sql .= 'AND osot.ownerid=oto.id'."\n";
			$sql .= 'ORDER BY os.scheduleid ASC, s.week ASC';
			log_message('debug', 'Career H2H: '.$sql);
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$current_year_stats = array();
				foreach ($query->result_array() as $row) {
					$owner_id = $row['ownerid'];
					if (!isset($current_year_stats[$owner_id])) $current_year_stats[$owner_id] = array();
					if (!isset($current_year_stats[$owner_id]['wins'])) $current_year_stats[$owner_id]['wins'] = 0;
					if (!isset($current_year_stats[$owner_id]['losses'])) $current_year_stats[$owner_id]['losses'] = 0;
					if (!isset($current_year_stats[$owner_id]['ties'])) $current_year_stats[$owner_id]['ties'] = 0;
					if (!isset($current_year_stats[$owner_id]['divwins'])) $current_year_stats[$owner_id]['divwins'] = 0;
					if (!isset($current_year_stats[$owner_id]['divlosses'])) $current_year_stats[$owner_id]['divlosses'] = 0;
					if (!isset($current_year_stats[$owner_id]['divties'])) $current_year_stats[$owner_id]['divties'] = 0;
					if (is_numeric($row['totpts_team']) && is_numeric($row['totpts_oppteam'])) {
						if ($row['totpts_team'] > $row['totpts_oppteam']) {
							$current_year_stats[$owner_id]['wins']++;
							if ($row['division'] == $row['oppdivision']) $current_year_stats[$owner_id]['divwins']++;
						} elseif ($row['totpts_team'] < $row['totpts_oppteam']) {
							$current_year_stats[$owner_id]['losses']++;
							if ($row['division'] == $row['oppdivision']) $current_year_stats[$owner_id]['divlosses']++;
						} elseif ($row['totpts_team'] == $row['totpts_oppteam']) {
							$current_year_stats[$owner_id]['ties']++;
							if ($row['division'] == $row['oppdivision']) $current_year_stats[$owner_id]['divties']++;
						}
						if (!isset($current_year_stats[$owner_id]['games'])) {
							$current_year_stats[$owner_id]['games'] = 1;
						} else {
							$current_year_stats[$owner_id]['games']++;
						}
					}
				}
				$query->free_result();
				//echo '<h1>Current Year STats</h1>'."\n";
				//echo '<pre>'."\n";
				//print_r($current_year_stats);
				//echo '</pre>'."\n";
				if (!empty($current_year_stats) && !empty($career_stats)) {
					foreach($career_stats as $i => $c) {
						$owner_id = $c['ownerid'];
						if (isset($current_year_stats[$owner_id])) {
							$career_stats[$i]['wins'] += $current_year_stats[$owner_id]['wins'];
							$career_stats[$i]['losses'] += $current_year_stats[$owner_id]['losses'];
							$career_stats[$i]['ties'] += $current_year_stats[$owner_id]['ties'];
							$career_stats[$i]['divwins'] += $current_year_stats[$owner_id]['divwins'];
							$career_stats[$i]['divlosses'] += $current_year_stats[$owner_id]['divlosses'];
							$career_stats[$i]['divties'] += $current_year_stats[$owner_id]['divties'];
							$career_stats[$i]['games'] += $current_year_stats[$owner_id]['games'];
						}
					}
				}
			}
		}
		$this->db->cache_off();
		return $career_stats;
	}

	function history($owner_id = 0) {
		//$this->db->cache_on();
		$this->db->select('s.*, os.teamname as team');
		if (!empty($owner_id)) $this->db->where('s.ownerid', $owner_id);
		$this->db->join('owner_schedule os', 's.ownerid = os.ownerid AND s.year = os.year');
		$this->db->order_by('s.year', 'DESC');
		$query = $this->db->get('career_stats s');
		//log_message('debug', 'history: '.$this->db->last_query());
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function max_year() {
		$this->db->cache_on();
		$this->db->select_max('year', 'max_year');
		$query = $this->db->get('career_stats');
		$row = $query->row_array();
		$this->db->cache_off();
		return $row['max_year'];
	}

	function points($start_year = 1996, $end_year = 2016) {
		$max_year = $this->max_year();
		$career_points = array();
		$this->db->cache_on();
		// TESTING
		//$max_year = 2007;
		$sql = 'SELECT DISTINCT c.ownerid, o.teamname, o.slug'."\n";
		$sql .= ',(SELECT SUM(cs.points) FROM career_stats cs WHERE cs.ownerid=c.ownerid AND cs.year>='.$this->db->escape($start_year).' AND cs.year<='.$this->db->escape($end_year).') AS points'."\n";
		$sql .= ',(SELECT SUM(cs.games) FROM career_stats cs WHERE cs.ownerid=c.ownerid AND cs.year>='.$this->db->escape($start_year).' AND cs.year<='.$this->db->escape($end_year).') AS games'."\n";
		$sql .= ',(SELECT MAX(cs.bestscore) FROM career_stats cs WHERE cs.ownerid=c.ownerid AND cs.year>='.$this->db->escape($start_year).' AND cs.year<='.$this->db->escape($end_year).') AS bestgame'."\n";
		$sql .= ',(SELECT MIN(cs.worstscore) FROM career_stats cs WHERE cs.ownerid=c.ownerid AND cs.year>='.$this->db->escape($start_year).' AND cs.year<='.$this->db->escape($end_year).') AS worstgame'."\n";
		$sql .= ',(SELECT MAX(cs.points) FROM career_stats cs WHERE cs.ownerid=c.ownerid AND cs.year>='.$this->db->escape($start_year).' AND cs.year<='.$this->db->escape($end_year).') AS bestyear'."\n";
		$sql .= ',(SELECT MIN(cs.points) FROM career_stats cs WHERE cs.ownerid=c.ownerid AND cs.year>='.$this->db->escape($start_year).' AND cs.year<='.$this->db->escape($end_year).') AS worstyear'."\n";
		$sql .= 'FROM career_stats c, owners o'."\n";
		$sql .= 'WHERE c.ownerid=o.id'."\n";
		$sql .= 'ORDER BY points DESC';
		log_message('debug', 'Career points: '.$sql);
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) $career_points = $query->result_array();
		//echo '<h1>Career Points</h1>'."\n";
		//echo '<pre>'."\n";
		//print_r($career_points);
		//echo '</pre>'."\n";
		$query->free_result();
		if ($end_year > $max_year) {
			//echo '// GETTING FULL DATA'."\n";
			$sql = 'SELECT o.id AS ownerid, s.week'."\n";
			$sql .= ',(SELECT SUM(ps.totpts) AS ytdtotal FROM lineup l LEFT JOIN player_stats ps ON l.playerid=ps.playerid AND l.year=ps.year AND l.week=ps.week WHERE l.week=s.week AND l.year='.$this->db->escape($end_year).' AND l.position IN (\'AQB1\',\'BRB1\',\'BRB2\',\'CWR1\',\'CWR2\',\'DPK1\',\'EDF1\',\'EDF2\',\'EDF3\') AND l.ownerid=o.id ) AS totpts'."\n";
			$sql .= 'FROM owners o, schedule s, owner_schedule os'."\n";
			$sql .= 'WHERE o.id=os.ownerid'."\n";
			$sql .= 'AND os.scheduleid=s.scheduleid'."\n";
			$sql .= 'AND os.year='.$this->db->escape($end_year)."\n";
			$sql .= 'ORDER BY os.scheduleid ASC, s.week ASC';
			log_message('debug', 'Career points: '.$sql);
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$current_year_stats = array();
				$max_week = 0;
				foreach ($query->result_array() as $row) {
					if (is_numeric($row['totpts'])) {
						$owner_id = $row['ownerid'];
						if (!isset($current_year_stats[$owner_id])) $current_year_stats[$owner_id] = array();
						if (!isset($current_year_stats[$owner_id]['points'])) {
							$current_year_stats[$owner_id]['points'] = $row['totpts'];
						} else {
							$current_year_stats[$owner_id]['points'] += $row['totpts'];
						}
						if (!isset($current_year_stats[$owner_id]['games'])) {
							$current_year_stats[$owner_id]['games'] = 1;
						} else {
							$current_year_stats[$owner_id]['games']++;
						}
						if (!isset($current_year_stats[$owner_id]['bestgame'])) {
							$current_year_stats[$owner_id]['bestgame'] = $row['totpts'];
						} else {
							if ($row['totpts'] > $current_year_stats[$owner_id]['bestgame']) $current_year_stats[$owner_id]['bestgame'] = $row['totpts'];
						}
						if (!isset($current_year_stats[$owner_id]['worstgame'])) {
							$current_year_stats[$owner_id]['worstgame'] = $row['totpts'];
						} else {
							if ($row['totpts'] < $current_year_stats[$owner_id]['worstgame']) $current_year_stats[$owner_id]['worstgame'] = $row['totpts'];
						}
						if ($row['week'] > $max_week) $max_week = $row['week'];
					}
				}
				$query->free_result();
				//echo '<h1>Current Year Points</h1>'."\n";
				//echo '<pre>'."\n";
				//print_r($current_year_stats);
				//echo '</pre>'."\n";
				if (!empty($current_year_stats) && !empty($career_points)) {
					foreach($career_points as $i => $c) {
						$owner_id = $c['ownerid'];
						if (isset($current_year_stats[$owner_id])) {
							$career_points[$i]['points'] += $current_year_stats[$owner_id]['points'];
							$career_points[$i]['games'] += $current_year_stats[$owner_id]['games'];
							if ($current_year_stats[$owner_id]['bestgame'] > $c['bestgame']) $career_points[$i]['bestgame'] = $current_year_stats[$owner_id]['bestgame'];
							if ($current_year_stats[$owner_id]['worstgame'] < $c['worstgame']) $career_points[$i]['worstgame'] = $current_year_stats[$owner_id]['worstgame'];
							if ($current_year_stats[$owner_id]['points'] > $c['bestyear']) $career_points[$i]['bestyear'] = $current_year_stats[$owner_id]['points'];
							if ($max_week >= 17) {
								if ($current_year_stats[$owner_id]['points'] < $c['worstyear']) $career_points[$i]['worstyear'] = $current_year_stats[$owner_id]['points'];
							}
						}
					}
				}
			}
		}
		$this->db->cache_off();
		return $career_points;
	}

	function headtohead_champions() {
		$this->db->cache_on(); // CACHE THIS
		$this->db->select('s.*, os.*, o.slug');
		$this->db->join('owner_schedule os', 's.ownerid = os.ownerid AND s.year = os.year');
		$this->db->join('owners o', 's.ownerid = o.id');
		$this->db->where('s.headtoheadchamp', 1);
		$this->db->order_by('s.year', 'DESC');
		$query = $this->db->get('career_stats s');
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function playoff_champions() {
		$this->db->cache_on();
		$this->db->select('s.*, os.*, o.slug');
		$this->db->join('owner_schedule os', 's.ownerid = os.ownerid AND s.year = os.year');
		$this->db->join('owners o', 's.ownerid = o.id');
		$this->db->where('s.playoffchamp', 1);
		$this->db->order_by('s.year', 'DESC');
		$query = $this->db->get('career_stats s');
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function points_champions() {
		$this->db->cache_on();
		$this->db->select('s.*, os.*, o.slug');
		$this->db->join('owner_schedule os', 's.ownerid = os.ownerid AND s.year = os.year');
		$this->db->join('owners o', 's.ownerid = o.id');
		$this->db->where('s.pointschamp', 1);
		$this->db->order_by('s.year', 'DESC');
		$query = $this->db->get('career_stats s');
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function toilet_champions() {
		$this->db->cache_on();
		$this->db->select('s.*, os.*, o.slug');
		$this->db->join('owner_schedule os', 's.ownerid = os.ownerid AND s.year = os.year');
		$this->db->join('owners o', 's.ownerid = o.id');
		$this->db->where('s.toiletchamp', 1);
		$this->db->order_by('s.year', 'DESC');
		$query = $this->db->get('career_stats s');
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

}
?>