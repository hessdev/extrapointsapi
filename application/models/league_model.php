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
class League_model extends CI_Model {

	function League_model() {
		parent::__construct();
	}

	function calendar() {
		$using_cache = false;
		$cache_file_exists = false;
		$feed_loaded = false;
		//echo '<!-- FEED URL: '.$this->config->item('google_calendar_feed').' -->'."\n";
		if (file_exists($this->config->item('google_calendar_cache_file'))) {
			$cache_file_exists = true;
			$expr_date = filemtime($this->config->item('google_calendar_cache_file')) + $this->config->item('google_calendar_cache_time');
			//echo '<!-- EXPR: '.date('Y-m-d H:i:s', $expr_date).' -->'."\n";
			//echo '<!-- NOW: '.date('Y-m-d H:i:s', time()).' -->'."\n";
			if (time() >= $expr_date) {
				// '<!-- FEED -->'."\n";
				$calendar = $this->config->item('google_calendar_feed');
			} else {
				//echo '<!-- CACHE -->'."\n";
				$calendar = $this->config->item('google_calendar_cache_file');
				$using_cache = true;
			}
		} else {
			//echo '<!-- FEED -->'."\n";
			$calendar = $this->config->item('google_calendar_feed');
		}
		$feed = array();
		$doc = new DOMDocument();
		if ($doc->load($calendar)) {
			foreach ($doc->getElementsByTagName('entry') as $node) {
				$when = $node->getElementsByTagName('summary')->item(0)->nodeValue;
				$when = substr($when, 0, strpos($when, ' to'));
				$when = preg_replace("/When\: /", '', $when);
				$item = array (
					'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
					'when' => $when,
				);
				array_push($feed, $item);
			}
			$feed_loaded = true;
			if (!$using_cache) $doc->save($this->config->item('google_calendar_cache_file'));
		}
		if (!$using_cache && $cache_file_exists && !$feed_loaded) {
			//echo '<!-- FEED FAILED USE CACHE: '.$this->config->item('google_calendar_feed').' -->'."\n";
			if ($doc->load($this->config->item('google_calendar_cache_file'))) {
				foreach ($doc->getElementsByTagName('entry') as $node) {
					$when = $node->getElementsByTagName('summary')->item(0)->nodeValue;
					$when = substr($when, 0, strpos($when, ' to'));
					$when = preg_replace("/When\: /", '', $when);
					$item = array (
						'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
						'when' => $when,
					);
					array_push($feed, $item);
				}
				$feed_loaded = true;
			}
		} elseif (!$feed_loaded) {
			$feed[0] =  array(
				'title' => 'No events found',
				'when' => ''
			);
		}
		return $feed;
	}

	function draft($year = 2016, $owner_slug = '') {
		$this->load->model('Players_model', 'player', TRUE);
		$draft_owners = $this->draft_owners($year);
		$draft = array();
		//$this->db->cache_on();
		$this->db->select('d.pick, d.ownerid, os.teamname, os.shortname, o.slug ,d.playername, d.pos, d.playerid, p.position, p.height, p.weight, p.college, p.teamid, p.born, p.img', FALSE);
		$this->db->join('owners o', 'd.ownerid = o.id');
		$this->db->join('owner_schedule os', 'd.ownerid = os.ownerid AND os.year = '.$year);
		$this->db->join('players p', 'p.id = d.playerid AND p.year = '.$year, 'left');
		$this->db->where('d.year', $year);
		if (!empty($owner_slug)) $this->db->where('o.slug', $owner_slug);
		$this->db->order_by('d.pick','ASC');
		$query = $this->db->get('draft d');
		log_message('debug', $this->db->last_query());
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			$pick_num = 0;
			$num_teams = (!empty($owner_slug)) ? 1 : count($draft_owners);
			//log_message('debug', 'num_teams: '.$num_teams);
			foreach ($query->result_array() as $pick) {
				$round = intval($pick_num / $num_teams) + 1;
				$index = $round - 1;
				//log_message('debug', 'pick(pick_num: '.$pick_num.' index['.$index.']): '.print_r($pick, true));
				if (!array_key_exists($index, $draft)) {
					$draft[$index] = array(
						'round' => $round,
						'picks' => array()
					);
				}

				$draft[$index]['picks'][] = array(
					'id' => $pick['playerid'],
					'player_name' => $pick['playername'],
					'player_team' => $pick['teamid'],
					'player_college' => $pick['college'],
					'player_weight' => $pick['weight'],
					'player_height' => $pick['height'],
					'player_born' => $pick['born'],
					'player_img' => $pick['img'],
					'points' => $this->player->get_total_points($pick['playerid'], $year),
					'pick' => $pick['pick'],
					'position' => $pick['pos'],
					'team' => array(
						'id' => $pick['ownerid'],
						'name' => $pick['teamname'],
						'slug' => $pick['slug'],
						'short_name' => $pick['shortname']
					)
				);
				$pick_num += 1;
			}
		}
		return $draft;
	}

	function draft_owners($year = 2015) {
		$this->db->cache_on();
		$this->db->select('ownerid');
		$this->db->distinct();
		$this->db->where('year', $year);
		$query = $this->db->get('draft');
		$this->db->cache_off();
		//log_message('debug', $this->db->last_query());
		return $query->result_array();
	}

	function feed($feed_id = 0) {
		$this->db->cache_on();
		$this->db->where('feed_id', $feed_id);
		$this->db->where('feed_status', 'active');
		$query = $this->db->get('feeds');
		$this->db->cache_off();
		if ($query->num_rows() == 1) {
			$feed_data = $query->row_array();
			$feed = array();
			$doc = new DOMDocument();
			if ($doc->load($feed_data['feed_url'])) {
				foreach ($doc->getElementsByTagName('item') as $node) {
					$title = (!empty($node->getElementsByTagName('title')->item(0)->nodeValue)) ? $node->getElementsByTagName('title')->item(0)->nodeValue : '';
					if ($title != '') {
						$desc = (!empty($node->getElementsByTagName('description')->item(0)->nodeValue)) ? $node->getElementsByTagName('description')->item(0)->nodeValue : '';
						$link = (!empty($node->getElementsByTagName('link')->item(0)->nodeValue)) ? $node->getElementsByTagName('link')->item(0)->nodeValue : '#';
						$pub_date = (!empty($node->getElementsByTagName('pubDate')->item(0)->nodeValue)) ? $node->getElementsByTagName('pubDate')->item(0)->nodeValue : $this->config->item('now');
						$item = array (
							'title' => $title,
							'desc' => $desc,
							'link' => $link,
							'date' => $pub_date
						);
						array_push($feed, $item);
					}
				}
				foreach ($doc->getElementsByTagName('entry') as $node) {
					$title = (!empty($node->getElementsByTagName('title')->item(0)->nodeValue)) ? $node->getElementsByTagName('title')->item(0)->nodeValue : '';
					if ($title != '') {
						$desc = (!empty($node->getElementsByTagName('summary')->item(0)->nodeValue)) ? $node->getElementsByTagName('summary')->item(0)->nodeValue : '';
						$link = $node->getElementsByTagName('link')->item(0)->getAttribute('href');
						$pub_date = (!empty($node->getElementsByTagName('published')->item(0)->nodeValue)) ? $node->getElementsByTagName('published')->item(0)->nodeValue : $this->config->item('now');
						$item = array (
							'title' => $title,
							'desc' => $desc,
							'link' => $link,
							'date' => $pub_date
						);
						array_push($feed, $item);
					}
				}
			} else {
				$feed[0] =  array(
					'title' => 'No items found',
					'desc' => 'This feed did not contain any data.',
					'link' => $feed_data['feed_url'],
					'date' => $this->config->item('now')
				);
			}
			return array('attrs' => $feed_data, 'items' => $feed);
		} else {
			return array();
		}
	}

	function feeds() {
		$this->db->cache_on();
		$this->db->where('feed_status', 'active');
		$this->db->order_by('feed_order','ASC');
		$query = $this->db->get('feeds');
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function images() {
		$images = array();
		$this->load->helper('file');
		foreach(get_filenames($this->config->item('bonehead_folder')) as $img) {
			if (preg_match("/gif|jpg|png$/i", $img) && !preg_match("/ /i", $img)) {
				$images[$img] =  $this->config->item('bonehead_dir').'/'.$img;
			}
		}
		asort($images);
		return $images;
	}

	function nfl_schedule($year = 2016) {
		$schedule = array();
		$tmp_schedule = array();
		//$this->db->cache_on();
		$this->db->select('s.week, s.gametype, t.stadium, t.city, t.state, t.zip, t.surface, t.type, t.capacity, t.team AS hometeam, a.team AS awayteam, a.name as awayteamname, t.teamid AS hometeamid, t.name as hometeamname, a.teamid AS awayteamid, DATE_ADD(s.gamedate, INTERVAL '.$this->config->item('time_diff').' HOUR) As gameday, DATE_ADD(s.gamedate, INTERVAL '.$this->config->item('time_diff').' HOUR) AS gametime', FALSE);
		$this->db->join('nfl_teams t', 't.teamid = s.teamid');
		$this->db->join('nfl_teams a', 'a.teamid = oppteamid');
		$this->db->where('s.year', $year);
		$this->db->where_in('s.gametype', array('H','B'));
		$this->db->order_by('s.week, s.gamedate, s.oppteamid', 'ASC');
		$query = $this->db->get('nfl_schedule s');
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			$last_week = 0;
			$last_day = 0;
			foreach ($query->result_array() as $game) {
				$week = $game['week'];
				$game_date = new DateTime($game['gameday'], $this->config->item('timezone'));
				$game_day_key = $game_date->format('Y-m-d');
				if ($week != $last_week) {
					$tmp_schedule[$week] = array(
						'byes' => array()
					);
					$last_week = $week;
				}
				if (!array_key_exists($game_day_key, $tmp_schedule[$week])) {
					$tmp_schedule[$week][$game_day_key] = array();
				}
				if ($game['gametype'] == 'H') {
					$tmp_schedule[$week][$game_day_key][] = array(
						'home_team' => array(
							'id' => $game['hometeamid'],
							'city' => $game['hometeam'],
							'name' => $game['hometeamname']
						),
						'away_team' => array(
							'id' => $game['awayteamid'],
							'city' => $game['awayteam'],
							'name' => $game['awayteamname']
						),
						'location' => array(
							'stadium' => $game['stadium'],
							'capacity' => $game['capacity'],
							'surface' => $game['surface'],
							'type' => $game['type'],
							'city' => $game['city'],
							'state' => $game['state'],
							'zip' => $game['zip']
						),
						'date' => $game_date->format(DATE_ATOM)
					);
				} else {
					$tmp_schedule[$week]['byes'][] = array(
						'id' => $game['hometeamid'],
						'city' => $game['hometeam'],
						'city' => $game['hometeam']
					);
				}
			}
		}
		if (!empty($tmp_schedule)) {
			foreach($tmp_schedule as $week => $data) {
				$week_data = array(
					'week' => $week,
					'byes' => $data['byes'],
					'days' => array()
				);
				foreach($data as $day => $games) {
					if ($day != 'byes') {
						$date = new DateTime($day, $this->config->item('timezone'));
						$day_data = array(
							'date' => $date->format('l, F j'),
							'games' => array()
						);
						foreach ($games as $game) {
							$day_data['games'][] = $game;
						}
						$week_data['days'][] = $day_data;
					}
				}
				$schedule[] = $week_data;
			}
		}
		return $schedule;
	}

	function get_schedule_max_year() {
		$this->db->cache_on();
		$this->db->select_max('year', 'max_year');
		$query = $this->db->get('nfl_schedule');
		$row = $query->row_array();
		$this->db->cache_off();
		return $row['max_year'];
	}

	function trades($year = 2010, $owner_id = '') {
		$this->db->cache_on();
		$this->db->select('t.id, DATE_ADD(t.tradedate, INTERVAL '.$this->config->item('time_diff').' HOUR) AS tradedate, os1.teamname AS team1, t.ownerid1, o1.slug as slug1, os2.teamname AS team2, t.ownerid2, o2.slug as slug2, t.playerid1, t.playerid2, p1.name AS player1, p1.position as player1pos, p2.name AS player2, p2.position as player2pos, t.type, t.comment, t.week, t.week+3 AS tradebackweek', FALSE);
		$this->db->join('owner_schedule os1', 't.ownerid1 = os1.ownerid AND os1.year = t.year');
		$this->db->join('owner_schedule os2', 't.ownerid2 = os2.ownerid AND os2.year = t.year');
		$this->db->join('owners o1', 't.ownerid1 = o1.id');
		$this->db->join('owners o2', 't.ownerid2 = o2.id');
		$this->db->join('players p1', 't.playerid1 = p1.id');
		$this->db->join('players p2', 't.playerid2 = p2.id');
		$this->db->where('t.year', $year);
		if ($owner_id != '') {
			$this->db->where('(t.ownerid1='.$owner_id.' OR t.ownerid2='.$owner_id.')');
		}
		$this->db->order_by('t.tradedate', 'ASC');
		$this->db->order_by('t.type','ASC');
		$query = $this->db->get('trades t');
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function transactions($year = 2015, $owner_id = 0) {
		$trade_list = array();
		$waiver_list = array();
		$trades = $this->trades($year, $owner_id);
		if (!empty($trades)) {
			$group = 0;
			$last_trade_date = '';
			$last_owner_id1 = 0;
			$last_owner_id2 = 0;
			foreach($trades as $t) {
				$trade_types = $this->config->item('trade_types');
				$trade_type_names = $this->config->item('trade_type_names');
				$trade_date = (empty($t['tradedate'])) ? new DateTime('1970-01-01 00:00:00', $this->config->item('timezone')) : new DateTime($t['tradedate'], $this->config->item('timezone'));
				if ($last_trade_date != substr($t['tradedate'], 0, 10) || ($last_owner_id1 != $t['ownerid1'] || $last_owner_id2 != $t['ownerid2'])) {
					$group += 1;
				}
				$trade = array(
					'date' => $trade_date->format(DATE_ATOM),
					'year' => $year,
					'week' => $t['week'],
					'type' => $trade_type_names[array_search($t['type'], $trade_types)],
					'trade_back' => ($t['type'] == 't' && $t['tradebackweek'] <= 17) ? 'W'.$t['tradebackweek'] : '',
					'comment' => $t['comment'],
					'group' => $group,
					'item1' => array(
						'player' => array(
							'id' => $t['playerid1'],
							'name' => $t['player1'],
							'position' => $t['player1pos']
						),
						'team' => array(
							'id' => $t['ownerid1'],
							'name' => $t['team1'],
							'slug' => $t['slug1']
						)
					),
					'item2' => array(
						'player' => array(
							'id' => $t['playerid2'],
							'name' => $t['player2'],
							'position' => $t['player2pos']
						),
						'team' => array(
							'id' => $t['ownerid2'],
							'name' => $t['team2'],
							'slug' => $t['slug2']
						)
					)
				);
				$trade_list[] = $trade;
				$last_trade_date = substr($t['tradedate'], 0, 10);
				$last_owner_id1 = $t['ownerid1'];
				$last_owner_id2 = $t['ownerid2'];
			}
		}
		$waiver = $this->waiver($year, $owner_id);
		if (!empty($waiver)) {
			foreach($waiver as $w) {
				$waiver_date = (empty($w['waiverdate'])) ? new DateTime('1970-01-01 00:00:00', $this->config->item('timezone')) : new DateTime($w['waiverdate'], $this->config->item('timezone'));
				$waiver = array(
					'date' => $waiver_date->format(DATE_ATOM),
					'pick' => $w['pick'],
					'team' => array(
						'id' => $w['owner_id'],
						'name' => $w['teamname'],
						'slug' => $w['slug']
					),
					'add' => array(
						'id' => $w['addplayerid'],
						'name' => $w['addplayer'],
						'position' => $w['addplayerpos'],
						'team' => $w['addplayerteam']
					),
					'drop' => array(
						'id' => $w['dropplayerid'],
						'name' => $w['dropplayer'],
						'position' => $w['dropplayerpos'],
						'team' => $w['dropplayerteam']
					)
				);
				$waiver_list[] = $waiver;
			}
		}
		return array(
			'trades' => $trade_list,
			'waiver' => $waiver_list
		);
	}

	function waiver($year = 2015, $owner_id = '') {
		//$this->db->cache_on();
		$this->db->select('w.id, DATE_ADD(w.waiverdate, INTERVAL '.$this->config->item('time_diff').' HOUR) AS waiverdate, s.teamname, o.id as owner_id, o.slug, w.ownerid, w.addplayerid, w.dropplayerid, ap.name AS addplayer, ap.position as addplayerpos, ap.teamid as addplayerteam, dp.name AS dropplayer, dp.position as dropplayerpos, dp.teamid as dropplayerteam, w.pick', FALSE);
		$this->db->join('owners o', 'w.ownerid = o.id');
		$this->db->join('owner_schedule s', 'w.ownerid = s.ownerid AND w.year = s.year');
		$this->db->join('players ap', 'w.addplayerid = ap.id', 'LEFT');
		$this->db->join('players dp', 'w.dropplayerid = dp.id', 'LEFT');
		$this->db->where('w.year', $year);
		if ($owner_id != '') $this->db->where('w.ownerid', $owner_id);
		$this->db->order_by('w.waiverdate', 'DESC');
		$this->db->order_by('w.pick','ASC');
		$query = $this->db->get('waiver w');
		log_message('debug', $this->db->last_query());
		$this->db->cache_off();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

}