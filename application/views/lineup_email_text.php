<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!empty($team) && !empty($week) && !empty($year)) {
	echo $team['teamname'].': '.$year.' Week '.$week.' Lineup'."\n";
	echo 'Date: '.date('n/j/y g:ia', strtotime($this->config->item('now')))."\n";
	echo "-----------------------------------------\n";
}
if (!empty($data)) {
	foreach ($data as $pos => $plyr) {
		echo $pos.': '.$plyr."\n";
	}
}
if (!empty($team) && !empty($week) && !empty($year)) {
	echo "-----------------------------------------\n";
}
echo 'UA: '.$_SERVER['HTTP_USER_AGENT']."\n";
echo 'IP: '.$_SERVER['REMOTE_ADDR']."\n";