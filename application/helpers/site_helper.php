<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function make_password($length = 9, $strength = 0) {
	$vowels = 'aeuy';
	$consonants = 'bdghjmnpqrstvz';
	if ($strength & 1) {
		$consonants .= 'BDGHJLMNPQRSTVWXZ';
	}
	if ($strength & 2) {
		$vowels .= "AEUY";
	}
	if ($strength & 4) {
		$consonants .= '23456789';
	}
	if ($strength & 8) {
		$consonants .= '@#$%';
	}
	$password = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
	return $password;
}

function ep_site_url($uri = '') {
	$uri = preg_replace("/^\//", '', $uri);
	return base_url().'/'.$uri;
}

function lineup_pos_from_player_pos($position = 'QB') {
	switch ($position) {
		case 'TE':
			$pos = 'WR';
			break;
		case 'K':
			$pos = 'PK';
			break;
		case 'CB':
		case 'DB':
		case 'DE':
		case 'DL':
		case 'DT':
		case 'LB':
		case 'S':
			$pos = 'DF';
			break;
		case 'FB':
			$pos = 'RB';
			break;
		default:
			$pos = $position;
			break;
	}
	return $pos;
}

function unserialize_data($data) {
	$data = @unserialize(strip_slashes($data));
	if (is_array($data)) {
		foreach ($data as $key => $val) {
			$data[$key] = str_replace('{{slash}}', '\\', $val);
		}
		return $data;
	}
	return str_replace('{{slash}}', '\\', $data);
}

function encode_content($content) {
	return htmlspecialchars($content, ENT_QUOTES);
}

function decode_content($content) {
	return htmlspecialchars_decode($content);
}

function date_age_in_days($date_str = '') {
	$CI =& get_instance();
	$test_date = strtotime($date_str);
	$now = strtotime($CI->config->item('now'));
	$age = $now - $test_date;
	return floor($age/(60*60*24));
}

function date3339($timestamp = 0) {
	$CI =& get_instance();
	if (!$timestamp) $timestamp = strtotime($CI->config->item('now'));
	$date = date('Y-m-d\TH:i:s', $timestamp);
	$matches = array();
	if (preg_match('/^([\-+])(\d{2})(\d{2})$/', date('O', $timestamp), $matches)) {
		$date .= $matches[1].$matches[2].':'.$matches[3];
	} else {
		$date .= 'Z';
	}
	return $date;
}

function sort_players_by_points($player1, $player2) {
	$player1_cmp = str_pad($player1['starter_points'], 3, '0', STR_PAD_LEFT).str_pad($player1['starts'], 2, '0', STR_PAD_LEFT);
	$player2_cmp = str_pad($player2['starter_points'], 3, '0', STR_PAD_LEFT).str_pad($player2['starts'], 2, '0', STR_PAD_LEFT);
	return strcmp($player1_cmp, $player2_cmp);
}

function sort_teams_by_points($team1, $team2) {
	$team1_cmp = str_pad($team1['points'], 5, '0', STR_PAD_LEFT).str_pad($team1['wins'], 3, '0', STR_PAD_LEFT);
	$team2_cmp = str_pad($team2['points'], 5, '0', STR_PAD_LEFT).str_pad($team2['wins'], 3, '0', STR_PAD_LEFT);
	return strcmp($team2_cmp, $team1_cmp);
}
?>
