<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?= doctype('html5') ?>
<html lang="en" ng-app="exPtsApp">
<head>
<title><?php if ($pg_title != '') echo $pg_title.' &rsaquo; '; ?><?= $this->config->item('site_name') ?> &rsaquo; Richmond's Premier Fantasy Football League</title>
<base href="/">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Richmond Virginia's premier Fantasy Football League since 1991">
<?= $stylesheets ?>
<link rel="Shortcut Icon" type="image/x-icon" href="/favicon.ico" />
<link rel="stylesheet" href="/app/css/print.css" type="text/css" media="print" />
</head>
<body>
<nav id="navigation" class="navbar navbar-default navbar-fixed-top" ng-controller="epNavCtrl">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<i class="fa fa-bars"></i>
				<i class="fa fa-times"></i>
			</button>
			<a class="navbar-brand" href="<?= site_url() ?>">Extra Points</a>
		</div>
		<div id="main-nav" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="<?= site_url('lineup') ?>" title="Lineup">Lineup</a></li>
				<li><a href="<?= site_url('rosters/'.$year.'/week'.sprintf("%02d",$roster_week)) ?>" title="<?= $year ?> Rosters">Rosters</a></li>
				<li><a href="<?= site_url('scores/'.$year.'/week'.sprintf("%02d",$scores_week)) ?>" title="<?= $year ?> Scores Week <?= $scores_week ?>">Scores</a></li>
				<li><a href="<?= site_url('headtohead/'.$year) ?>" title="<?= $year ?> Head To Head"><span class="hidden-sm">Head To Head</span><span class="visible-sm-inline">H2H</span></a></li>
				<li class="dropdown">
					<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Teams">Teams <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php foreach ($owners as $o) : ?>
							<li><a href="<?= site_url('team/'.$o['slug'].'/'.$year) ?>" title="<?= $o['teamname'] ?>"><?= $o['teamname'] ?></a></li>
						<?php endforeach; ?>
					</ul>
				</li>
				<li><a href="<?= site_url('playoffs/'.$year) ?>" title="<?= $year ?> Playoffs">Playoffs</a></li>
				<li class="dropdown">
					<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Stats <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?= site_url('players/'.$year.'/all') ?>" title="<?= $year ?> Top Players">Top Players</a></li>
						<li><a href="<?= site_url('statistics/'.$year.'/points') ?>">Total Points</a></li>
						<li><a href="<?= site_url('statistics/'.$year.'/average') ?>">Average Points Per Game</a></li>
						<li><a href="<?= site_url('statistics/'.$year.'/efficiency') ?>">Efficiency</a></li>
						<li><a href="<?= site_url('statistics/'.$year.'/possible') ?>">Most Possible Points</a></li>
						<li><a href="<?= site_url('statistics/'.$year.'/projected') ?>">Projected Finish</a></li>
						<li><a href="<?= site_url('statistics/'.$year.'/chart') ?>">Points Chart</a></li>
						<li><a href="<?= site_url('statistics/'.$year.'/qb-rank') ?>">QB Rankings</a></li>
						<li><a href="<?= site_url('statistics/'.$year.'/rb-rank') ?>">RB Rankings</a></li>
						<li><a href="<?= site_url('statistics/'.$year.'/wr-rank') ?>">WR Rankings</a></li>
						<li><a href="<?= site_url('statistics/'.$year.'/pk-rank') ?>">PK Rankings</a></li>
						<li><a href="<?= site_url('statistics/'.$year.'/df-rank') ?>">DF Rankings</a></li>
						<li><a href="<?= site_url('career') ?>" title="Career Stats">Career</a></li>
						<li><a href="<?= site_url('nfl-schedule/'.$schedule_year) ?>" title="<?= $schedule_year ?> NFL Schedule">NFL Schedule</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Trans<span class="hidden-sm">actions</span> <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?= site_url('draft/'.$this->config->item('draft_pick_year')) ?>" title="<?= $this->config->item('default_year') ?> Draft">Draft</a></li>
						<li><a href="<?= site_url('trades/'.$year) ?>" title="<?= $year ?> Trades">Trades</a></li>
						<li><a href="<?= site_url('waiver/'.$year) ?>" title="<?= $year ?> Waiver">Waiver</a></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true" ng-show="loggedIn"></i> Account <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li ng-show="!loggedIn"><a href="#" ng-click="login()">Login</a></li>
						<li ng-show="loggedIn"><a href="#" ng-click="logout()">Logout</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
<?= $content ?>
<?= $scripts ?>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-2407197-1', 'auto');
</script>
</body>
</html>