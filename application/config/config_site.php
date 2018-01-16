<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
// DEVELOPMENT
if (strpos($_SERVER['SERVER_NAME'], 'extrapoints.net') === false) {
	$config['debug_mode']					= false;
} else {
	$config['debug_mode']					= false;
}

// GENERAL
$config['site_root']						= $_SERVER['DOCUMENT_ROOT'];
$config['site_name']						= 'Extra Points';
$config['domain_name']						= 'extrapoints.net';
$config['google_uacct'] 					= 'UA-2407197-1';
$config['scripts']							= array(
												'/app/lib/jquery.min.js',
												'/app/lib/angular.js',
												'/app/lib/angular-route.js',
												'/app/lib/angular-resource.js',
												'/app/lib/angular-animate.js',
												'/app/lib/angular-cookies.js',
												//'/app/lib/angular-touch.js',
												'/app/lib/jquery.dataTables.js',
												'/app/lib/dataTables.bootstrap.js',
												'/app/lib/angular-datatables.js',
												'/app/lib/angular-datatables.bootstrap.js',
												'/app/lib/bootstrap.js',
												'/app/lib/ui-bootstrap.js',
												'/app/lib/ui-bootstrap-tpls.js',
												'/app/lib/tinymce.js',
												'/app/lib/angular-ui-tinymce.js',
												'/app/lib/underscore.js',
												'/app/lib/moment.min.js',
												//'/app/lib/lib.js',
												//'/app/js/extpts.js',
												'/app/js/app.js',
												'/app/js/services/extptsapi.js',
												'/app/js/filters.js',
												'/app/js/controllers/nav.js',
												'/app/js/controllers/home.js',
												'/app/js/controllers/scores.js',
												'/app/js/controllers/stats.js',
												'/app/js/controllers/players.js',
												'/app/js/controllers/draft.js',
												'/app/js/controllers/headtohead.js',
												'/app/js/controllers/team.js',
												'/app/js/controllers/rosters.js',
												'/app/js/controllers/trades.js',
												'/app/js/controllers/waiver.js',
												'/app/js/controllers/schedule.js',
												'/app/js/controllers/lineup.js',
												'/app/js/controllers/player-modal.js'
											);
$config['stylesheets']						= array(
												//'/app/css/animate.css',
												//'/app/css/font-awesome.css',
												//'/app/css/extpts.bootstrap.css',
												//'/app/css/dataTables.bootstrap.css'
												'/app/css/ep.css',
											);
$config['commissioner_email']				= 'commish@extrapoints.net';
$config['requires_login_msg']				= 'You must be logged in to access that page';
$config['google_calendar_feed']				= 'http://www.google.com/calendar/feeds/gebvjblcvvj7rrqv0bt3lei28k%40group.calendar.google.com/public/basic?orderby=starttime&sortorder=a&ctz=America/New_York&start-min='.date(DATE_ATOM, strtotime('+4 hours'));
$config['google_calendar_url']				= 'http://www.google.com/calendar/render?cid=http%3A%2F%2Fwww.google.com%2Fcalendar%2Ffeeds%2Fgebvjblcvvj7rrqv0bt3lei28k%40group.calendar.google.com%2Fpublic%2Fbasic';
$config['google_calendar_cache_file']		= $config['site_root'].'/application/cache/calendar.xml';
$config['google_calendar_cache_time']		= 60*60*1; // 1 hour
$config['weather_api_key']					= '0079eaa2db737a34cb56d5e5fefdce4f';

// SETTINGS
$config['admin_username']					= 'dhess';
$config['cookie_expiration_time']			= 60*60*24*21; // 21 days
$config['email_fields']						= array('email','email1','email2');
$config['positions']						= array('QB','RB','WR','PK','DF','TX');
$config['num_starters']						= array(1, 2, 2, 1, 3, 0);
$config['career_years']						= array(2017,2016,2015,2014,2013,2012,2011,2010,2009,2008,2007,2006,2005,2004,2003,2002,2001,2000,1999,1998,1997,1996);
$config['data_years']						= array(2017,2016,2015,2014,2013,2012,2011,2010,2009,2008,2007,2006,2005);
$config['draft_years']						= array(2017,2016,2015,2014,2013,2012,2011,2010,2009,2008,2007,2006,2005,2004,2003,2002,2001,2000,1999,1998,1997);
$config['pos_prefixes']						= array('A','B','C','D','E','F');
$config['num_roster_pos']					= array(2, 4, 4, 2, 4, 2);
$config['starter_verbs']					= array('was', 'were', 'were', 'was', 'were', 'were');
$config['talk_cats']						= array('c','s','t');
$config['talk_cat_names']					= array('commish','smack','trades');
$config['trade_types']						= array('p','t','b');
$config['trade_type_names']					= array('Permanent','Temporary','Trade Back');
$config['taxi_squad_start_week']			= 14;
//$config['default_year']					= (date('n') <= 8) ? date('Y') - 1 : date('Y');
$config['default_year']						= 2017;
$config['draft_day']						= '2017-09-06 16:30:00';
$config['draft_pick_year']					= 2016;
$config['now']								= date('Y-m-d H:i:s');
//$config['now']								= '2015-10-04 16:23:55';
$config['time_diff']						= 0;
$config['timezone']							= new DateTimeZone('America/New_York');
$config['talk_items_per_page']				= 5;

// DIRECTORIES
$config['app_dir']							= '/app';
$config['image_dir']						= $config['app_dir'].'/img';
$config['javascript_dir']					= $config['app_dir'].'/js';
$config['css_dir']							= $config['app_dir'].'/css';
$config['lib_dir']							= $config['app_dir'].'/lib';

// FOLDERs
$config['app_path']							= $config['site_root'].$config['app_dir'];
$config['image_path']						= $config['site_root'].$config['image_dir'];
$config['javascript_path']					= $config['site_root'].$config['javascript_dir'];
$config['css_path']							= $config['site_root'].$config['css_dir'];
$config['lib_path']							= $config['site_root'].$config['lib_dir'];

// STATS

$config['stats_map'] = array(
	'total_pts' => 'totpts',
	'pass_atts' => 'passatt',
	'pass_comp' => 'passcomp',
	'pass_yds' => 'passyds',
	'rush_atts' => 'rushes',
	'rush_yds' => 'rushyds',
	'rec_yds' => 'recyds',
	'receptions' => 'receptions',
	'pass_td' => 'passtd',
	'rush_td' => 'rushtd',
	'rec_td' => 'rectd',
	'kick_td' => 'kicktd',
	'punt_td' => 'puntrettd',
	'other_td' => 'otrrettd',
	'int_td' => 'inttd',
	'fum_td' => 'fumtd',
	'punt_td' => 'puntrettd',
	'other_td' => 'otrrettd',
	'twopt_pass' => '2ptpassconv',
	'twopt_run' => '2ptrunconv',
	'twopt_rec' => '2ptrecvconv',
	'fg_atts' => 'fgatts',
	'fg_made' => 'fgmade',
	'fg_made_lt40' => 'fgmadelt40',
	'fg_made_gt40' => 'fgmadegt40',
	'fg_made_gt50' => 'fgmadegt50',
	'fg_made_gt60' => 'fgmadegt60',
	'interceptions' => 'interceptions',
	'sacks' => 'defsacks'
);