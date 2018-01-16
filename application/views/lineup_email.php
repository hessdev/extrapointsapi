<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<html>
<body>
<?php if (!empty($team) && !empty($week) && !empty($year)) : ?>
<h1 style="font: normal bold 16px arial,sans-serif;"><?= $team['teamname'] ?> &rsaquo; <?= $year ?> Week <?= $week ?> Lineup</h1>
<p style="font: normal bold 12px arial,sans-serif; color: #666;"><b>Date:</b> <?= date('n/j/y g:ia', strtotime($this->config->item('now'))) ?></p>
<?php endif; ?>
<?php if (!empty($data)) : ?>
<table width="300" cellpadding="3" cellspacing="0" border="1" style="border: 1px solid #000; border-collapse: collapse;">
	<thead>
		<tr>
			<th width="15%" style="text-align:left;font: normal bold 13px arial,sans-serif; background-color: #1F1F1F; color: #FF9F2F; border: 1px solid #000;">Pos</th>
			<th width="85%" style="text-align:left;font: normal bold 13px arial,sans-serif; background-color: #1F1F1F; color: #FF9F2F; border: 1px solid #000;">Player</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($data as $pos => $plyr) : ?>
		<tr>
			<td style="font: normal bold 12px arial,sans-serif; border: 1px solid #000;"><?= $pos ?></td>
			<td style="font: normal normal 12px arial,sans-serif; border: 1px solid #000;"><?= $plyr ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>
<?php if (!empty($team) && !empty($week) && !empty($year)) : ?>
<p style="font: normal bold 11px arial,sans-serif;">
	<a href="<?= site_url('lineup') ?>">Set Lineup</a> |
	<a href="<?= site_url('rosters/'.$year.'/week'.sprintf("%02d",$week)) ?>">View Rosters</a>
</p>
<?php endif; ?>
<p style="font: italic normal 11px arial,sans-serif;">
	<b>User Agent:</b> <?= $_SERVER['HTTP_USER_AGENT'] ?><br/>
	<b>IP Address:</b> <?= $_SERVER['REMOTE_ADDR'] ?>
</p>
</body>
</html>