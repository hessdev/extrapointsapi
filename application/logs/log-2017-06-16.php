<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

DEBUG - 2017-06-16 08:52:44 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 08:52:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 08:52:44 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 08:52:44 --> Started Userauth
DEBUG - 2017-06-16 08:52:44 --> Total execution time: 0.2664
DEBUG - 2017-06-16 08:52:44 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 08:52:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 08:52:44 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 08:52:44 --> Started Userauth
DEBUG - 2017-06-16 08:52:45 --> players_modal->leaders->position: pk
DEBUG - 2017-06-16 08:52:45 --> Total execution time: 0.5039
DEBUG - 2017-06-16 09:12:39 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:12:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:12:39 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:12:39 --> Started Userauth
DEBUG - 2017-06-16 09:12:39 --> Total execution time: 0.0516
DEBUG - 2017-06-16 09:12:39 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:12:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:12:39 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:12:39 --> Started Userauth
DEBUG - 2017-06-16 09:12:39 --> SELECT w.id, DATE_ADD(w.waiverdate, INTERVAL 0 HOUR) AS waiverdate, s.teamname, o.id as owner_id, o.slug, w.ownerid, w.addplayerid, w.dropplayerid, ap.name AS addplayer, ap.position as addplayerpos, ap.teamid as addplayerteam, dp.name AS dropplayer, dp.position as dropplayerpos, dp.teamid as dropplayerteam, w.pick
FROM `waiver` `w`
JOIN `owners` `o` ON `w`.`ownerid` = `o`.`id`
JOIN `owner_schedule` `s` ON `w`.`ownerid` = `s`.`ownerid` AND `w`.`year` = `s`.`year`
LEFT JOIN `players` `ap` ON `w`.`addplayerid` = `ap`.`id`
LEFT JOIN `players` `dp` ON `w`.`dropplayerid` = `dp`.`id`
WHERE `w`.`year` = '2016'
ORDER BY `w`.`waiverdate` DESC, `w`.`pick` ASC
DEBUG - 2017-06-16 09:12:39 --> Total execution time: 0.1035
DEBUG - 2017-06-16 09:12:42 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:12:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:12:42 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:12:42 --> Started Userauth
DEBUG - 2017-06-16 09:12:42 --> Total execution time: 0.0258
DEBUG - 2017-06-16 09:12:42 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:12:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:12:42 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:12:42 --> Started Userauth
DEBUG - 2017-06-16 09:12:42 --> Total execution time: 0.0365
DEBUG - 2017-06-16 09:12:42 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:12:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:12:42 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:12:42 --> Started Userauth
DEBUG - 2017-06-16 09:12:42 --> SELECT w.id, DATE_ADD(w.waiverdate, INTERVAL 0 HOUR) AS waiverdate, s.teamname, o.id as owner_id, o.slug, w.ownerid, w.addplayerid, w.dropplayerid, ap.name AS addplayer, ap.position as addplayerpos, ap.teamid as addplayerteam, dp.name AS dropplayer, dp.position as dropplayerpos, dp.teamid as dropplayerteam, w.pick
FROM `waiver` `w`
JOIN `owners` `o` ON `w`.`ownerid` = `o`.`id`
JOIN `owner_schedule` `s` ON `w`.`ownerid` = `s`.`ownerid` AND `w`.`year` = `s`.`year`
LEFT JOIN `players` `ap` ON `w`.`addplayerid` = `ap`.`id`
LEFT JOIN `players` `dp` ON `w`.`dropplayerid` = `dp`.`id`
WHERE `w`.`year` = '2016'
ORDER BY `w`.`waiverdate` DESC, `w`.`pick` ASC
DEBUG - 2017-06-16 09:12:42 --> Total execution time: 0.0457
DEBUG - 2017-06-16 09:14:57 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:14:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:14:57 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:14:57 --> Started Userauth
DEBUG - 2017-06-16 09:14:57 --> Total execution time: 0.0368
DEBUG - 2017-06-16 09:14:57 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:14:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:14:57 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:14:57 --> Started Userauth
DEBUG - 2017-06-16 09:14:57 --> SELECT w.id, DATE_ADD(w.waiverdate, INTERVAL 0 HOUR) AS waiverdate, s.teamname, o.id as owner_id, o.slug, w.ownerid, w.addplayerid, w.dropplayerid, ap.name AS addplayer, ap.position as addplayerpos, ap.teamid as addplayerteam, dp.name AS dropplayer, dp.position as dropplayerpos, dp.teamid as dropplayerteam, w.pick
FROM `waiver` `w`
JOIN `owners` `o` ON `w`.`ownerid` = `o`.`id`
JOIN `owner_schedule` `s` ON `w`.`ownerid` = `s`.`ownerid` AND `w`.`year` = `s`.`year`
LEFT JOIN `players` `ap` ON `w`.`addplayerid` = `ap`.`id`
LEFT JOIN `players` `dp` ON `w`.`dropplayerid` = `dp`.`id`
WHERE `w`.`year` = '2016'
ORDER BY `w`.`waiverdate` DESC, `w`.`pick` ASC
DEBUG - 2017-06-16 09:14:57 --> Total execution time: 0.0345
DEBUG - 2017-06-16 09:14:59 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:14:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:14:59 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:14:59 --> Started Userauth
DEBUG - 2017-06-16 09:14:59 --> Total execution time: 0.0260
DEBUG - 2017-06-16 09:15:01 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:15:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:15:01 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:15:01 --> Started Userauth
DEBUG - 2017-06-16 09:15:01 --> Total execution time: 0.0473
DEBUG - 2017-06-16 09:15:01 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:15:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:15:01 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:15:01 --> Started Userauth
DEBUG - 2017-06-16 09:15:01 --> SELECT w.id, DATE_ADD(w.waiverdate, INTERVAL 0 HOUR) AS waiverdate, s.teamname, o.id as owner_id, o.slug, w.ownerid, w.addplayerid, w.dropplayerid, ap.name AS addplayer, ap.position as addplayerpos, ap.teamid as addplayerteam, dp.name AS dropplayer, dp.position as dropplayerpos, dp.teamid as dropplayerteam, w.pick
FROM `waiver` `w`
JOIN `owners` `o` ON `w`.`ownerid` = `o`.`id`
JOIN `owner_schedule` `s` ON `w`.`ownerid` = `s`.`ownerid` AND `w`.`year` = `s`.`year`
LEFT JOIN `players` `ap` ON `w`.`addplayerid` = `ap`.`id`
LEFT JOIN `players` `dp` ON `w`.`dropplayerid` = `dp`.`id`
WHERE `w`.`year` = '2016'
ORDER BY `w`.`waiverdate` DESC, `w`.`pick` ASC
DEBUG - 2017-06-16 09:15:01 --> Total execution time: 0.0278
DEBUG - 2017-06-16 09:16:30 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:16:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:16:30 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:16:30 --> Started Userauth
DEBUG - 2017-06-16 09:16:30 --> Total execution time: 0.0317
DEBUG - 2017-06-16 09:16:30 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:16:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:16:30 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:16:30 --> Started Userauth
DEBUG - 2017-06-16 09:16:30 --> Total execution time: 0.5104
DEBUG - 2017-06-16 09:16:30 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:16:30 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:16:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:16:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:16:30 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:16:30 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:16:30 --> Started Userauth
DEBUG - 2017-06-16 09:16:30 --> Started Userauth
DEBUG - 2017-06-16 09:16:30 --> SELECT d.pick, d.ownerid, os.teamname, os.shortname, o.slug, d.playername, d.pos, d.playerid, p.position, p.height, p.weight, p.college, p.teamid, p.born, p.img
FROM `draft` `d`
JOIN `owners` `o` ON `d`.`ownerid` = `o`.`id`
JOIN `owner_schedule` `os` ON `d`.`ownerid` = `os`.`ownerid` AND `os`.`year` = 2016
LEFT JOIN `players` `p` ON `p`.`id` = `d`.`playerid` AND `p`.`year` = 2016
WHERE `d`.`year` = '2016'
AND `o`.`slug` = 'abusement-park'
ORDER BY `d`.`pick` ASC
DEBUG - 2017-06-16 09:16:30 --> SELECT w.id, DATE_ADD(w.waiverdate, INTERVAL 0 HOUR) AS waiverdate, s.teamname, o.id as owner_id, o.slug, w.ownerid, w.addplayerid, w.dropplayerid, ap.name AS addplayer, ap.position as addplayerpos, ap.teamid as addplayerteam, dp.name AS dropplayer, dp.position as dropplayerpos, dp.teamid as dropplayerteam, w.pick
FROM `waiver` `w`
JOIN `owners` `o` ON `w`.`ownerid` = `o`.`id`
JOIN `owner_schedule` `s` ON `w`.`ownerid` = `s`.`ownerid` AND `w`.`year` = `s`.`year`
LEFT JOIN `players` `ap` ON `w`.`addplayerid` = `ap`.`id`
LEFT JOIN `players` `dp` ON `w`.`dropplayerid` = `dp`.`id`
WHERE `w`.`year` = '2016'
AND `w`.`ownerid` = '1'
ORDER BY `w`.`waiverdate` DESC, `w`.`pick` ASC
DEBUG - 2017-06-16 09:16:30 --> Total execution time: 0.0668
DEBUG - 2017-06-16 09:16:30 --> Total execution time: 0.0830
DEBUG - 2017-06-16 09:16:33 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:16:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:16:33 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:16:33 --> Started Userauth
DEBUG - 2017-06-16 09:16:33 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:16:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:16:33 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:16:33 --> Total execution time: 0.0388
DEBUG - 2017-06-16 09:16:33 --> Started Userauth
DEBUG - 2017-06-16 09:16:33 --> Total execution time: 0.0226
DEBUG - 2017-06-16 09:16:33 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:16:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:16:33 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:16:33 --> Started Userauth
DEBUG - 2017-06-16 09:16:33 --> Total execution time: 0.3118
DEBUG - 2017-06-16 09:16:33 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:16:33 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:16:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:16:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:16:33 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:16:33 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:16:33 --> Started Userauth
DEBUG - 2017-06-16 09:16:33 --> Started Userauth
DEBUG - 2017-06-16 09:16:33 --> SELECT d.pick, d.ownerid, os.teamname, os.shortname, o.slug, d.playername, d.pos, d.playerid, p.position, p.height, p.weight, p.college, p.teamid, p.born, p.img
FROM `draft` `d`
JOIN `owners` `o` ON `d`.`ownerid` = `o`.`id`
JOIN `owner_schedule` `os` ON `d`.`ownerid` = `os`.`ownerid` AND `os`.`year` = 2016
LEFT JOIN `players` `p` ON `p`.`id` = `d`.`playerid` AND `p`.`year` = 2016
WHERE `d`.`year` = '2016'
AND `o`.`slug` = 'abusement-park'
ORDER BY `d`.`pick` ASC
DEBUG - 2017-06-16 09:16:33 --> SELECT w.id, DATE_ADD(w.waiverdate, INTERVAL 0 HOUR) AS waiverdate, s.teamname, o.id as owner_id, o.slug, w.ownerid, w.addplayerid, w.dropplayerid, ap.name AS addplayer, ap.position as addplayerpos, ap.teamid as addplayerteam, dp.name AS dropplayer, dp.position as dropplayerpos, dp.teamid as dropplayerteam, w.pick
FROM `waiver` `w`
JOIN `owners` `o` ON `w`.`ownerid` = `o`.`id`
JOIN `owner_schedule` `s` ON `w`.`ownerid` = `s`.`ownerid` AND `w`.`year` = `s`.`year`
LEFT JOIN `players` `ap` ON `w`.`addplayerid` = `ap`.`id`
LEFT JOIN `players` `dp` ON `w`.`dropplayerid` = `dp`.`id`
WHERE `w`.`year` = '2016'
AND `w`.`ownerid` = '1'
ORDER BY `w`.`waiverdate` DESC, `w`.`pick` ASC
DEBUG - 2017-06-16 09:16:33 --> Total execution time: 0.0280
DEBUG - 2017-06-16 09:16:33 --> Total execution time: 0.0338
DEBUG - 2017-06-16 09:18:17 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:18:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:18:17 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:18:17 --> Started Userauth
DEBUG - 2017-06-16 09:18:17 --> Total execution time: 0.0261
DEBUG - 2017-06-16 09:18:17 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:18:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:18:17 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:18:17 --> Started Userauth
DEBUG - 2017-06-16 09:18:17 --> scores_model->data(2016, 17, 0)
DEBUG - 2017-06-16 09:18:18 --> Total execution time: 0.8072
DEBUG - 2017-06-16 09:18:21 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:18:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:18:21 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:18:21 --> Started Userauth
DEBUG - 2017-06-16 09:18:21 --> Total execution time: 0.0239
DEBUG - 2017-06-16 09:18:21 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:18:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:18:21 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:18:21 --> Started Userauth
DEBUG - 2017-06-16 09:18:21 --> Total execution time: 0.0208
DEBUG - 2017-06-16 09:18:21 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:18:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:18:21 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:18:21 --> Started Userauth
DEBUG - 2017-06-16 09:18:21 --> scores_model->data(2016, 17, 0)
DEBUG - 2017-06-16 09:18:21 --> Total execution time: 0.0706
DEBUG - 2017-06-16 09:18:24 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:18:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:18:24 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:18:24 --> Started Userauth
DEBUG - 2017-06-16 09:18:24 --> Total execution time: 0.0217
DEBUG - 2017-06-16 09:19:10 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:19:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:19:10 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:19:10 --> Started Userauth
DEBUG - 2017-06-16 09:19:10 --> Total execution time: 0.0257
DEBUG - 2017-06-16 09:19:10 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:19:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:19:10 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:19:10 --> Started Userauth
DEBUG - 2017-06-16 09:19:10 --> Total execution time: 0.0262
DEBUG - 2017-06-16 09:19:13 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:19:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:19:13 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:19:13 --> Started Userauth
DEBUG - 2017-06-16 09:19:13 --> Total execution time: 0.0357
DEBUG - 2017-06-16 09:19:13 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:19:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:19:13 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:19:13 --> Started Userauth
DEBUG - 2017-06-16 09:19:13 --> Total execution time: 0.0240
DEBUG - 2017-06-16 09:19:13 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:19:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:19:13 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:19:13 --> Started Userauth
DEBUG - 2017-06-16 09:19:13 --> Total execution time: 0.0403
DEBUG - 2017-06-16 09:20:01 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:20:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:20:01 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:20:01 --> Started Userauth
DEBUG - 2017-06-16 09:20:01 --> Total execution time: 0.0281
DEBUG - 2017-06-16 09:20:01 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:20:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:20:01 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:20:01 --> Started Userauth
DEBUG - 2017-06-16 09:20:02 --> Total execution time: 0.2927
DEBUG - 2017-06-16 09:20:04 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:20:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:20:04 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:20:04 --> Started Userauth
DEBUG - 2017-06-16 09:20:04 --> Total execution time: 0.0389
DEBUG - 2017-06-16 09:20:04 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:20:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:20:04 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:20:04 --> Started Userauth
DEBUG - 2017-06-16 09:20:04 --> Total execution time: 0.0246
DEBUG - 2017-06-16 09:20:04 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:20:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:20:04 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:20:04 --> Started Userauth
DEBUG - 2017-06-16 09:20:05 --> Total execution time: 0.2928
DEBUG - 2017-06-16 09:21:38 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:21:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:21:38 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:21:38 --> Started Userauth
DEBUG - 2017-06-16 09:21:38 --> Total execution time: 0.0235
DEBUG - 2017-06-16 09:21:38 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:21:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:21:38 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:21:38 --> Started Userauth
DEBUG - 2017-06-16 09:21:38 --> players_modal->leaders->position: all
DEBUG - 2017-06-16 09:21:38 --> Total execution time: 0.3544
DEBUG - 2017-06-16 09:21:41 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:21:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:21:41 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:21:41 --> Started Userauth
DEBUG - 2017-06-16 09:21:41 --> Total execution time: 0.0399
DEBUG - 2017-06-16 09:21:41 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:21:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:21:41 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:21:41 --> Started Userauth
DEBUG - 2017-06-16 09:21:41 --> Total execution time: 0.0337
DEBUG - 2017-06-16 09:21:41 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:21:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:21:41 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:21:41 --> Started Userauth
DEBUG - 2017-06-16 09:21:41 --> players_modal->leaders->position: all
DEBUG - 2017-06-16 09:21:41 --> Total execution time: 0.2132
DEBUG - 2017-06-16 09:21:45 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:21:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:21:45 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:21:45 --> Started Userauth
DEBUG - 2017-06-16 09:21:45 --> Total execution time: 0.0230
DEBUG - 2017-06-16 09:21:59 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:21:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:21:59 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:21:59 --> Started Userauth
DEBUG - 2017-06-16 09:21:59 --> Total execution time: 0.0245
DEBUG - 2017-06-16 09:21:59 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:21:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:21:59 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:21:59 --> Started Userauth
DEBUG - 2017-06-16 09:21:59 --> Total execution time: 0.0422
DEBUG - 2017-06-16 09:21:59 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:21:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:21:59 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:21:59 --> Started Userauth
DEBUG - 2017-06-16 09:21:59 --> players_modal->leaders->position: all
DEBUG - 2017-06-16 09:21:59 --> Total execution time: 0.2104
DEBUG - 2017-06-16 09:25:56 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:25:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:25:56 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:25:56 --> Started Userauth
DEBUG - 2017-06-16 09:25:56 --> Total execution time: 0.0369
DEBUG - 2017-06-16 09:25:56 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:25:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:25:56 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:25:56 --> Started Userauth
DEBUG - 2017-06-16 09:25:56 --> Total execution time: 0.0446
DEBUG - 2017-06-16 09:25:56 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:25:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:25:56 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:25:56 --> Started Userauth
DEBUG - 2017-06-16 09:25:56 --> players_modal->leaders->position: all
DEBUG - 2017-06-16 09:25:56 --> Total execution time: 0.1969
DEBUG - 2017-06-16 09:26:31 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:26:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:26:31 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:26:31 --> Started Userauth
DEBUG - 2017-06-16 09:26:31 --> Total execution time: 0.0280
DEBUG - 2017-06-16 09:26:31 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:26:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:26:31 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:26:31 --> Started Userauth
DEBUG - 2017-06-16 09:26:32 --> Total execution time: 0.2842
DEBUG - 2017-06-16 09:26:32 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:26:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:26:32 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:26:32 --> Started Userauth
DEBUG - 2017-06-16 09:26:32 --> talk(): 854
DEBUG - 2017-06-16 09:26:32 --> Total execution time: 0.1013
DEBUG - 2017-06-16 09:26:39 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:26:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:26:39 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:26:39 --> Started Userauth
DEBUG - 2017-06-16 09:26:39 --> Total execution time: 0.0301
DEBUG - 2017-06-16 09:26:39 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:26:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:26:39 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:26:39 --> Started Userauth
DEBUG - 2017-06-16 09:26:39 --> scores_model->data(2016, 17, 0)
DEBUG - 2017-06-16 09:26:39 --> Total execution time: 0.0535
DEBUG - 2017-06-16 09:27:53 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:27:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:27:53 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:27:53 --> Started Userauth
DEBUG - 2017-06-16 09:27:53 --> Total execution time: 0.0266
DEBUG - 2017-06-16 09:27:53 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 09:27:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 09:27:53 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 09:27:53 --> Started Userauth
DEBUG - 2017-06-16 09:27:53 --> Total execution time: 0.2860
DEBUG - 2017-06-16 11:07:53 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 11:07:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 11:07:53 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 11:07:53 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 11:07:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 11:07:53 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 11:07:53 --> Started Userauth
DEBUG - 2017-06-16 11:07:53 --> Started Userauth
DEBUG - 2017-06-16 11:07:53 --> Total execution time: 0.0650
DEBUG - 2017-06-16 11:07:53 --> Total execution time: 0.0345
DEBUG - 2017-06-16 11:07:53 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 11:07:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 11:07:53 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 11:07:53 --> Started Userauth
DEBUG - 2017-06-16 11:07:54 --> Total execution time: 0.4262
DEBUG - 2017-06-16 11:07:58 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 11:07:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 11:07:58 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 11:07:58 --> Started Userauth
ERROR - 2017-06-16 11:07:58 --> Severity: Notice --> Undefined index: HTTP_ORIGIN /private/var/www/extptsapi/application/controllers/Api_controller.php 577
DEBUG - 2017-06-16 11:07:58 --> Total execution time: 0.0277
DEBUG - 2017-06-16 11:10:03 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 11:10:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 11:10:03 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 11:10:03 --> Started Userauth
DEBUG - 2017-06-16 11:10:03 --> Total execution time: 0.0246
DEBUG - 2017-06-16 11:10:29 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 11:10:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 11:10:29 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 11:10:29 --> Started Userauth
DEBUG - 2017-06-16 11:10:29 --> Total execution time: 0.0288
DEBUG - 2017-06-16 11:10:42 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 11:10:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 11:10:42 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 11:10:42 --> Started Userauth
DEBUG - 2017-06-16 11:10:42 --> Total execution time: 0.0240
DEBUG - 2017-06-16 11:10:45 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 11:10:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 11:10:45 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 11:10:45 --> Started Userauth
DEBUG - 2017-06-16 11:10:45 --> Total execution time: 0.0230
DEBUG - 2017-06-16 11:11:31 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 11:11:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 11:11:31 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 11:11:31 --> Started Userauth
DEBUG - 2017-06-16 11:11:31 --> Total execution time: 0.0169
DEBUG - 2017-06-16 11:12:11 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 11:12:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 11:12:11 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 11:12:12 --> Started Userauth
DEBUG - 2017-06-16 11:12:12 --> Total execution time: 0.0276
DEBUG - 2017-06-16 11:12:51 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 11:12:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 11:12:51 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 11:12:51 --> Started Userauth
DEBUG - 2017-06-16 11:12:51 --> Total execution time: 0.0363
DEBUG - 2017-06-16 11:13:15 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 11:13:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 11:13:15 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 11:13:15 --> Started Userauth
DEBUG - 2017-06-16 11:13:15 --> Total execution time: 0.0304
DEBUG - 2017-06-16 11:14:08 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 11:14:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 11:14:08 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 11:14:08 --> Started Userauth
DEBUG - 2017-06-16 11:14:08 --> career range start(1996) end(1996)
DEBUG - 2017-06-16 11:14:08 --> Total execution time: 0.0427
DEBUG - 2017-06-16 11:15:02 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 11:15:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 11:15:02 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 11:15:03 --> Started Userauth
DEBUG - 2017-06-16 11:15:03 --> career range start(1996) end(1996)
DEBUG - 2017-06-16 11:15:03 --> Total execution time: 0.0403
DEBUG - 2017-06-16 11:15:34 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 11:15:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 11:15:34 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 11:15:34 --> Started Userauth
DEBUG - 2017-06-16 11:15:34 --> career range start(1996) end(2016)
DEBUG - 2017-06-16 11:15:34 --> Total execution time: 0.0440
DEBUG - 2017-06-16 11:16:46 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 11:16:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 11:16:46 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 11:16:46 --> Started Userauth
DEBUG - 2017-06-16 11:16:46 --> career range start(1996) end(2016)
DEBUG - 2017-06-16 11:16:46 --> career invalid start year
DEBUG - 2017-06-16 11:16:46 --> career invalid end year
DEBUG - 2017-06-16 11:16:46 --> career invalid range
DEBUG - 2017-06-16 11:16:46 --> Total execution time: 0.0525
DEBUG - 2017-06-16 11:18:10 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 11:18:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 11:18:10 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 11:18:10 --> Started Userauth
DEBUG - 2017-06-16 11:18:10 --> career range start(1996) end(2016)
DEBUG - 2017-06-16 11:18:10 --> Total execution time: 0.0576
DEBUG - 2017-06-16 11:20:38 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 11:20:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 11:20:38 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 11:20:38 --> Started Userauth
DEBUG - 2017-06-16 11:20:38 --> career range start(1996) end(2016)
DEBUG - 2017-06-16 11:20:38 --> Total execution time: 0.0389
DEBUG - 2017-06-16 11:24:42 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 11:24:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 11:24:42 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 11:24:42 --> Started Userauth
DEBUG - 2017-06-16 11:24:46 --> Total execution time: 4.0189
DEBUG - 2017-06-16 12:50:32 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 12:50:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 12:50:32 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 12:50:32 --> Started Userauth
DEBUG - 2017-06-16 12:50:32 --> Total execution time: 0.1591
DEBUG - 2017-06-16 12:50:41 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 12:50:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 12:50:41 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 12:50:41 --> Started Userauth
DEBUG - 2017-06-16 12:50:41 --> career range start(1996) end(2016)
DEBUG - 2017-06-16 12:50:41 --> Total execution time: 0.0283
DEBUG - 2017-06-16 12:52:42 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 12:52:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 12:52:42 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 12:52:42 --> Started Userauth
DEBUG - 2017-06-16 12:52:42 --> career range start(1996) end(2016)
DEBUG - 2017-06-16 12:52:42 --> Total execution time: 0.0467
DEBUG - 2017-06-16 12:55:18 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 12:55:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 12:55:18 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 12:55:18 --> Started Userauth
ERROR - 2017-06-16 12:55:18 --> Severity: Parsing Error --> parse error /private/var/www/extptsapi/application/models/Career_model.php 67
DEBUG - 2017-06-16 12:58:47 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 12:58:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 12:58:47 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 12:58:47 --> Started Userauth
DEBUG - 2017-06-16 12:58:47 --> career range start(1996) end(2016)
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Notice --> Undefined variable: player2_cmp /private/var/www/extptsapi/application/helpers/site_helper.php 112
ERROR - 2017-06-16 12:58:47 --> Severity: Warning --> usort(): Array was modified by the user comparison function /private/var/www/extptsapi/application/models/Career_model.php 64
ERROR - 2017-06-16 12:58:47 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /private/var/www/extptsapi/system/core/Exceptions.php:272) /private/var/www/extptsapi/system/core/Common.php 573
DEBUG - 2017-06-16 12:58:47 --> Total execution time: 0.0605
DEBUG - 2017-06-16 12:59:00 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 12:59:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 12:59:00 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 12:59:00 --> Started Userauth
DEBUG - 2017-06-16 12:59:00 --> career range start(1996) end(2016)
DEBUG - 2017-06-16 12:59:00 --> Total execution time: 0.0277
DEBUG - 2017-06-16 12:59:23 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 12:59:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 12:59:23 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 12:59:23 --> Started Userauth
DEBUG - 2017-06-16 12:59:23 --> career range start(1996) end(2016)
DEBUG - 2017-06-16 12:59:23 --> Total execution time: 0.0521
DEBUG - 2017-06-16 13:00:39 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:00:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:00:39 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:00:39 --> Started Userauth
DEBUG - 2017-06-16 13:00:39 --> career range start(2010) end(2016)
DEBUG - 2017-06-16 13:00:39 --> Total execution time: 0.0409
DEBUG - 2017-06-16 13:08:07 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:08:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:08:07 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:08:07 --> Started Userauth
DEBUG - 2017-06-16 13:08:07 --> Total execution time: 0.0232
DEBUG - 2017-06-16 13:08:07 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:08:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:08:07 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:08:07 --> Started Userauth
DEBUG - 2017-06-16 13:08:08 --> Total execution time: 0.3900
DEBUG - 2017-06-16 13:08:08 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:08:08 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:08:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:08:08 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:08:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:08:08 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:08:08 --> Started Userauth
DEBUG - 2017-06-16 13:08:08 --> Started Userauth
DEBUG - 2017-06-16 13:08:08 --> SELECT w.id, DATE_ADD(w.waiverdate, INTERVAL 0 HOUR) AS waiverdate, s.teamname, o.id as owner_id, o.slug, w.ownerid, w.addplayerid, w.dropplayerid, ap.name AS addplayer, ap.position as addplayerpos, ap.teamid as addplayerteam, dp.name AS dropplayer, dp.position as dropplayerpos, dp.teamid as dropplayerteam, w.pick
FROM `waiver` `w`
JOIN `owners` `o` ON `w`.`ownerid` = `o`.`id`
JOIN `owner_schedule` `s` ON `w`.`ownerid` = `s`.`ownerid` AND `w`.`year` = `s`.`year`
LEFT JOIN `players` `ap` ON `w`.`addplayerid` = `ap`.`id`
LEFT JOIN `players` `dp` ON `w`.`dropplayerid` = `dp`.`id`
WHERE `w`.`year` = '2016'
AND `w`.`ownerid` = '2'
ORDER BY `w`.`waiverdate` DESC, `w`.`pick` ASC
DEBUG - 2017-06-16 13:08:08 --> Total execution time: 0.0233
DEBUG - 2017-06-16 13:08:08 --> SELECT d.pick, d.ownerid, os.teamname, os.shortname, o.slug, d.playername, d.pos, d.playerid, p.position, p.height, p.weight, p.college, p.teamid, p.born, p.img
FROM `draft` `d`
JOIN `owners` `o` ON `d`.`ownerid` = `o`.`id`
JOIN `owner_schedule` `os` ON `d`.`ownerid` = `os`.`ownerid` AND `os`.`year` = 2016
LEFT JOIN `players` `p` ON `p`.`id` = `d`.`playerid` AND `p`.`year` = 2016
WHERE `d`.`year` = '2016'
AND `o`.`slug` = 'driveby-snowman'
ORDER BY `d`.`pick` ASC
DEBUG - 2017-06-16 13:08:08 --> Total execution time: 0.0623
DEBUG - 2017-06-16 13:15:13 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:15:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:15:13 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:15:13 --> Started Userauth
DEBUG - 2017-06-16 13:15:13 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:15:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:15:13 --> Total execution time: 0.0362
DEBUG - 2017-06-16 13:15:13 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:15:13 --> Started Userauth
DEBUG - 2017-06-16 13:15:13 --> Total execution time: 0.0208
DEBUG - 2017-06-16 13:15:13 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:15:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:15:13 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:15:13 --> Started Userauth
DEBUG - 2017-06-16 13:15:13 --> Total execution time: 0.3128
DEBUG - 2017-06-16 13:15:13 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:15:13 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:15:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:15:13 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:15:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:15:13 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:15:13 --> Started Userauth
DEBUG - 2017-06-16 13:15:13 --> Started Userauth
DEBUG - 2017-06-16 13:15:13 --> SELECT d.pick, d.ownerid, os.teamname, os.shortname, o.slug, d.playername, d.pos, d.playerid, p.position, p.height, p.weight, p.college, p.teamid, p.born, p.img
FROM `draft` `d`
JOIN `owners` `o` ON `d`.`ownerid` = `o`.`id`
JOIN `owner_schedule` `os` ON `d`.`ownerid` = `os`.`ownerid` AND `os`.`year` = 2016
LEFT JOIN `players` `p` ON `p`.`id` = `d`.`playerid` AND `p`.`year` = 2016
WHERE `d`.`year` = '2016'
AND `o`.`slug` = 'driveby-snowman'
ORDER BY `d`.`pick` ASC
DEBUG - 2017-06-16 13:15:13 --> SELECT w.id, DATE_ADD(w.waiverdate, INTERVAL 0 HOUR) AS waiverdate, s.teamname, o.id as owner_id, o.slug, w.ownerid, w.addplayerid, w.dropplayerid, ap.name AS addplayer, ap.position as addplayerpos, ap.teamid as addplayerteam, dp.name AS dropplayer, dp.position as dropplayerpos, dp.teamid as dropplayerteam, w.pick
FROM `waiver` `w`
JOIN `owners` `o` ON `w`.`ownerid` = `o`.`id`
JOIN `owner_schedule` `s` ON `w`.`ownerid` = `s`.`ownerid` AND `w`.`year` = `s`.`year`
LEFT JOIN `players` `ap` ON `w`.`addplayerid` = `ap`.`id`
LEFT JOIN `players` `dp` ON `w`.`dropplayerid` = `dp`.`id`
WHERE `w`.`year` = '2016'
AND `w`.`ownerid` = '2'
ORDER BY `w`.`waiverdate` DESC, `w`.`pick` ASC
DEBUG - 2017-06-16 13:15:13 --> Total execution time: 0.0305
DEBUG - 2017-06-16 13:15:13 --> Total execution time: 0.0313
DEBUG - 2017-06-16 13:16:55 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:16:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:16:55 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:16:55 --> Started Userauth
DEBUG - 2017-06-16 13:16:55 --> Total execution time: 0.0313
DEBUG - 2017-06-16 13:18:14 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:18:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:18:14 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:18:14 --> Started Userauth
DEBUG - 2017-06-16 13:18:14 --> Total execution time: 0.0275
DEBUG - 2017-06-16 13:18:35 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:18:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:18:35 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:18:35 --> Started Userauth
DEBUG - 2017-06-16 13:18:35 --> Total execution time: 0.0304
DEBUG - 2017-06-16 13:18:52 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:18:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:18:53 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:18:53 --> Started Userauth
DEBUG - 2017-06-16 13:18:53 --> Total execution time: 0.0252
DEBUG - 2017-06-16 13:18:53 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:18:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:18:53 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:18:53 --> Started Userauth
DEBUG - 2017-06-16 13:18:53 --> Total execution time: 0.0229
DEBUG - 2017-06-16 13:19:54 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:19:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:19:54 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:19:54 --> Started Userauth
DEBUG - 2017-06-16 13:19:54 --> Total execution time: 0.0243
DEBUG - 2017-06-16 13:19:54 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:19:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:19:54 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:19:54 --> Started Userauth
DEBUG - 2017-06-16 13:19:54 --> Total execution time: 0.0242
DEBUG - 2017-06-16 13:20:18 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:20:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:20:18 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:20:18 --> Started Userauth
DEBUG - 2017-06-16 13:20:18 --> Total execution time: 0.0255
DEBUG - 2017-06-16 13:20:18 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:20:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:20:18 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:20:18 --> Started Userauth
DEBUG - 2017-06-16 13:20:18 --> Total execution time: 0.0244
DEBUG - 2017-06-16 13:20:57 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:20:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:20:57 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:20:57 --> Started Userauth
DEBUG - 2017-06-16 13:20:57 --> Total execution time: 0.0252
DEBUG - 2017-06-16 13:20:57 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:20:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:20:57 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:20:57 --> Started Userauth
DEBUG - 2017-06-16 13:20:57 --> Total execution time: 0.0245
DEBUG - 2017-06-16 13:21:12 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:21:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:21:12 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:21:12 --> Started Userauth
DEBUG - 2017-06-16 13:21:12 --> Total execution time: 0.0254
DEBUG - 2017-06-16 13:21:12 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:21:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:21:12 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:21:12 --> Started Userauth
DEBUG - 2017-06-16 13:21:12 --> Total execution time: 0.0225
DEBUG - 2017-06-16 13:22:37 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:22:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:22:38 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:22:38 --> Started Userauth
DEBUG - 2017-06-16 13:22:38 --> Total execution time: 0.0240
DEBUG - 2017-06-16 13:22:38 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:22:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:22:38 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:22:38 --> Started Userauth
DEBUG - 2017-06-16 13:22:38 --> Total execution time: 0.0227
DEBUG - 2017-06-16 13:23:02 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:23:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:23:02 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:23:02 --> Started Userauth
DEBUG - 2017-06-16 13:23:02 --> Total execution time: 0.0252
DEBUG - 2017-06-16 13:23:02 --> UTF-8 Support Enabled
DEBUG - 2017-06-16 13:23:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-06-16 13:23:02 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-06-16 13:23:02 --> Started Userauth
DEBUG - 2017-06-16 13:23:02 --> Total execution time: 0.0225
