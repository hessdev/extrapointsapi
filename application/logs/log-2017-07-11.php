<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

DEBUG - 2017-07-11 11:03:05 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 11:03:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 11:03:05 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 11:03:06 --> Started Userauth
DEBUG - 2017-07-11 11:03:06 --> Total execution time: 0.0780
DEBUG - 2017-07-11 11:03:06 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 11:03:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 11:03:06 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 11:03:06 --> Started Userauth
DEBUG - 2017-07-11 11:03:06 --> Total execution time: 0.0400
DEBUG - 2017-07-11 11:03:06 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 11:03:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 11:03:06 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 11:03:06 --> Started Userauth
DEBUG - 2017-07-11 11:03:06 --> Total execution time: 0.5561
DEBUG - 2017-07-11 11:03:06 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 11:03:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 11:03:06 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 11:03:06 --> Started Userauth
DEBUG - 2017-07-11 11:03:06 --> talk(): 854
DEBUG - 2017-07-11 11:03:06 --> Total execution time: 0.1051
DEBUG - 2017-07-11 11:03:13 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 11:03:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 11:03:13 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 11:03:13 --> Started Userauth
DEBUG - 2017-07-11 11:03:13 --> Total execution time: 0.0375
DEBUG - 2017-07-11 11:03:13 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 11:03:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 11:03:13 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 11:03:13 --> Started Userauth
DEBUG - 2017-07-11 11:03:13 --> SELECT d.pick, d.ownerid, os.teamname, os.shortname, o.slug, d.playername, d.pos, d.playerid, p.position, p.height, p.weight, p.college, p.teamid, p.born, p.img
FROM `draft` `d`
JOIN `owners` `o` ON `d`.`ownerid` = `o`.`id`
JOIN `owner_schedule` `os` ON `d`.`ownerid` = `os`.`ownerid` AND `os`.`year` = 2016
LEFT JOIN `players` `p` ON `p`.`id` = `d`.`playerid` AND `p`.`year` = 2016
WHERE `d`.`year` = '2016'
ORDER BY `d`.`pick` ASC
DEBUG - 2017-07-11 11:03:13 --> Total execution time: 0.2861
DEBUG - 2017-07-11 11:04:16 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 11:04:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 11:04:16 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 11:04:16 --> Started Userauth
DEBUG - 2017-07-11 11:04:16 --> Total execution time: 0.0263
DEBUG - 2017-07-11 11:04:16 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 11:04:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 11:04:16 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 11:04:16 --> Started Userauth
DEBUG - 2017-07-11 11:04:16 --> players_modal->leaders->position: all
DEBUG - 2017-07-11 11:04:17 --> Total execution time: 0.5096
DEBUG - 2017-07-11 11:04:23 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 11:04:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 11:04:23 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 11:04:23 --> Started Userauth
DEBUG - 2017-07-11 11:04:23 --> Total execution time: 0.0371
DEBUG - 2017-07-11 11:04:23 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 11:04:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 11:04:23 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 11:04:23 --> Started Userauth
DEBUG - 2017-07-11 11:04:23 --> players_modal->leaders->position: rb
DEBUG - 2017-07-11 11:04:23 --> Total execution time: 0.2561
DEBUG - 2017-07-11 11:04:48 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 11:04:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 11:04:48 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 11:04:48 --> Started Userauth
DEBUG - 2017-07-11 11:04:48 --> Total execution time: 0.0399
DEBUG - 2017-07-11 11:05:31 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 11:05:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 11:05:31 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 11:05:31 --> Started Userauth
DEBUG - 2017-07-11 11:05:31 --> Total execution time: 0.0275
DEBUG - 2017-07-11 11:05:59 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 11:05:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 11:05:59 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 11:05:59 --> Started Userauth
DEBUG - 2017-07-11 11:05:59 --> Total execution time: 0.0240
DEBUG - 2017-07-11 15:43:33 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:43:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:43:34 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:43:34 --> Started Userauth
DEBUG - 2017-07-11 15:43:34 --> Total execution time: 0.0516
DEBUG - 2017-07-11 15:43:34 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:43:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:43:34 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:43:34 --> Started Userauth
DEBUG - 2017-07-11 15:43:34 --> Total execution time: 0.0426
DEBUG - 2017-07-11 15:43:34 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:43:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:43:34 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:43:34 --> Started Userauth
DEBUG - 2017-07-11 15:43:34 --> Total execution time: 0.4100
DEBUG - 2017-07-11 15:43:34 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:43:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:43:34 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:43:34 --> Started Userauth
DEBUG - 2017-07-11 15:43:34 --> talk(): 854
DEBUG - 2017-07-11 15:43:34 --> Total execution time: 0.1258
DEBUG - 2017-07-11 15:43:41 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:43:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:43:41 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:43:41 --> Started Userauth
DEBUG - 2017-07-11 15:43:41 --> Total execution time: 0.0333
DEBUG - 2017-07-11 15:43:41 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:43:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:43:41 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:43:41 --> Started Userauth
DEBUG - 2017-07-11 15:43:41 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 15:43:41 --> Total execution time: 0.0325
DEBUG - 2017-07-11 15:43:48 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:43:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:43:48 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:43:48 --> Started Userauth
DEBUG - 2017-07-11 15:43:48 --> Total execution time: 0.0327
DEBUG - 2017-07-11 15:43:48 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:43:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:43:48 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:43:48 --> Started Userauth
DEBUG - 2017-07-11 15:43:48 --> players_modal->leaders->position: all
DEBUG - 2017-07-11 15:43:48 --> Total execution time: 0.3650
DEBUG - 2017-07-11 15:43:51 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:43:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:43:51 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:43:51 --> Started Userauth
DEBUG - 2017-07-11 15:43:51 --> Total execution time: 0.0375
DEBUG - 2017-07-11 15:43:51 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:43:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:43:51 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:43:51 --> Started Userauth
DEBUG - 2017-07-11 15:43:51 --> Total execution time: 0.0211
DEBUG - 2017-07-11 15:43:51 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:43:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:43:51 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:43:51 --> Started Userauth
DEBUG - 2017-07-11 15:43:51 --> players_modal->leaders->position: all
DEBUG - 2017-07-11 15:43:51 --> Total execution time: 0.2114
DEBUG - 2017-07-11 15:43:57 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:43:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:43:57 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:43:57 --> Started Userauth
DEBUG - 2017-07-11 15:43:57 --> Total execution time: 0.0258
DEBUG - 2017-07-11 15:43:57 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:43:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:43:57 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:43:57 --> Started Userauth
DEBUG - 2017-07-11 15:43:57 --> Total execution time: 0.2937
DEBUG - 2017-07-11 15:44:03 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:44:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:44:03 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:44:03 --> Started Userauth
DEBUG - 2017-07-11 15:44:03 --> Total execution time: 0.0279
DEBUG - 2017-07-11 15:44:03 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:44:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:44:03 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:44:03 --> Started Userauth
DEBUG - 2017-07-11 15:44:03 --> Total execution time: 0.0300
DEBUG - 2017-07-11 15:44:07 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:44:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:44:07 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:44:07 --> Started Userauth
DEBUG - 2017-07-11 15:44:07 --> Total execution time: 0.0249
DEBUG - 2017-07-11 15:44:07 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:44:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:44:07 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:44:07 --> Started Userauth
DEBUG - 2017-07-11 15:44:07 --> SELECT d.pick, d.ownerid, os.teamname, os.shortname, o.slug, d.playername, d.pos, d.playerid, p.position, p.height, p.weight, p.college, p.teamid, p.born, p.img
FROM `draft` `d`
JOIN `owners` `o` ON `d`.`ownerid` = `o`.`id`
JOIN `owner_schedule` `os` ON `d`.`ownerid` = `os`.`ownerid` AND `os`.`year` = 2016
LEFT JOIN `players` `p` ON `p`.`id` = `d`.`playerid` AND `p`.`year` = 2016
WHERE `d`.`year` = '2016'
ORDER BY `d`.`pick` ASC
DEBUG - 2017-07-11 15:44:08 --> Total execution time: 0.1558
DEBUG - 2017-07-11 15:44:10 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:44:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:44:10 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:44:10 --> Started Userauth
DEBUG - 2017-07-11 15:44:10 --> Total execution time: 0.0236
DEBUG - 2017-07-11 15:44:10 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:44:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:44:10 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:44:10 --> Started Userauth
DEBUG - 2017-07-11 15:44:10 --> SELECT w.id, DATE_ADD(w.waiverdate, INTERVAL 0 HOUR) AS waiverdate, s.teamname, o.id as owner_id, o.slug, w.ownerid, w.addplayerid, w.dropplayerid, ap.name AS addplayer, ap.position as addplayerpos, ap.teamid as addplayerteam, dp.name AS dropplayer, dp.position as dropplayerpos, dp.teamid as dropplayerteam, w.pick
FROM `waiver` `w`
JOIN `owners` `o` ON `w`.`ownerid` = `o`.`id`
JOIN `owner_schedule` `s` ON `w`.`ownerid` = `s`.`ownerid` AND `w`.`year` = `s`.`year`
LEFT JOIN `players` `ap` ON `w`.`addplayerid` = `ap`.`id`
LEFT JOIN `players` `dp` ON `w`.`dropplayerid` = `dp`.`id`
WHERE `w`.`year` = '2016'
ORDER BY `w`.`waiverdate` DESC, `w`.`pick` ASC
DEBUG - 2017-07-11 15:44:10 --> Total execution time: 0.0445
DEBUG - 2017-07-11 15:44:19 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:44:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:44:19 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:44:19 --> Started Userauth
DEBUG - 2017-07-11 15:44:19 --> Total execution time: 0.0254
DEBUG - 2017-07-11 15:44:19 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:44:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:44:19 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:44:19 --> Started Userauth
DEBUG - 2017-07-11 15:44:19 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 15:44:19 --> Total execution time: 0.0291
DEBUG - 2017-07-11 15:45:34 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:45:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:45:34 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:45:34 --> Started Userauth
DEBUG - 2017-07-11 15:45:34 --> Total execution time: 0.0244
DEBUG - 2017-07-11 15:45:34 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:45:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:45:34 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:45:34 --> Started Userauth
DEBUG - 2017-07-11 15:45:34 --> Total execution time: 0.0190
DEBUG - 2017-07-11 15:45:34 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:45:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:45:34 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:45:34 --> Started Userauth
DEBUG - 2017-07-11 15:45:34 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 15:45:34 --> Total execution time: 0.0255
DEBUG - 2017-07-11 15:46:29 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:46:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:46:29 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:46:29 --> Started Userauth
DEBUG - 2017-07-11 15:46:29 --> Total execution time: 0.0271
DEBUG - 2017-07-11 15:46:29 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:46:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:46:29 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:46:30 --> Started Userauth
DEBUG - 2017-07-11 15:46:30 --> Total execution time: 0.0210
DEBUG - 2017-07-11 15:46:30 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:46:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:46:30 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:46:30 --> Started Userauth
DEBUG - 2017-07-11 15:46:30 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 15:46:30 --> Total execution time: 0.0251
DEBUG - 2017-07-11 15:46:47 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:46:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:46:47 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:46:47 --> Started Userauth
DEBUG - 2017-07-11 15:46:47 --> Total execution time: 0.0274
DEBUG - 2017-07-11 15:46:57 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:46:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:46:57 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:46:57 --> Started Userauth
DEBUG - 2017-07-11 15:46:57 --> Total execution time: 0.0257
DEBUG - 2017-07-11 15:46:57 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:46:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:46:57 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:46:57 --> Started Userauth
DEBUG - 2017-07-11 15:46:57 --> Total execution time: 0.0189
DEBUG - 2017-07-11 15:46:57 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:46:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:46:57 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:46:57 --> Started Userauth
DEBUG - 2017-07-11 15:46:57 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 15:46:57 --> Total execution time: 0.0256
DEBUG - 2017-07-11 15:47:51 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:47:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:47:51 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:47:51 --> Started Userauth
DEBUG - 2017-07-11 15:47:51 --> Total execution time: 0.0245
DEBUG - 2017-07-11 15:47:51 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:47:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:47:51 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:47:51 --> Started Userauth
DEBUG - 2017-07-11 15:47:51 --> Total execution time: 0.0202
DEBUG - 2017-07-11 15:47:51 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:47:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:47:51 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:47:51 --> Started Userauth
DEBUG - 2017-07-11 15:47:51 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 15:47:51 --> Total execution time: 0.0277
DEBUG - 2017-07-11 15:48:55 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:48:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:48:55 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:48:55 --> Started Userauth
DEBUG - 2017-07-11 15:48:55 --> Total execution time: 0.0249
DEBUG - 2017-07-11 15:48:55 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:48:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:48:55 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:48:55 --> Started Userauth
DEBUG - 2017-07-11 15:48:55 --> Total execution time: 0.0195
DEBUG - 2017-07-11 15:48:55 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:48:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:48:55 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:48:55 --> Started Userauth
DEBUG - 2017-07-11 15:48:55 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 15:48:55 --> Total execution time: 0.0303
DEBUG - 2017-07-11 15:50:40 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:50:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:50:40 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:50:40 --> Started Userauth
DEBUG - 2017-07-11 15:50:40 --> Total execution time: 0.0266
DEBUG - 2017-07-11 15:50:40 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:50:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:50:40 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:50:40 --> Started Userauth
DEBUG - 2017-07-11 15:50:40 --> Total execution time: 0.0198
DEBUG - 2017-07-11 15:50:40 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:50:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:50:40 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:50:40 --> Started Userauth
DEBUG - 2017-07-11 15:50:40 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 15:50:40 --> Total execution time: 0.0535
DEBUG - 2017-07-11 15:52:11 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:52:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:52:11 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:52:11 --> Started Userauth
DEBUG - 2017-07-11 15:52:11 --> Total execution time: 0.0299
DEBUG - 2017-07-11 15:52:11 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:52:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:52:11 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:52:11 --> Started Userauth
DEBUG - 2017-07-11 15:52:11 --> Total execution time: 0.0316
DEBUG - 2017-07-11 15:52:11 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 15:52:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 15:52:11 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 15:52:11 --> Started Userauth
DEBUG - 2017-07-11 15:52:11 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 15:52:11 --> Total execution time: 0.0360
DEBUG - 2017-07-11 16:00:31 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:00:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:00:31 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:00:31 --> Started Userauth
DEBUG - 2017-07-11 16:00:31 --> Total execution time: 0.0283
DEBUG - 2017-07-11 16:00:31 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:00:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:00:31 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:00:31 --> Started Userauth
DEBUG - 2017-07-11 16:00:31 --> Total execution time: 0.0195
DEBUG - 2017-07-11 16:00:31 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:00:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:00:31 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:00:32 --> Started Userauth
DEBUG - 2017-07-11 16:00:32 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:00:32 --> Total execution time: 0.0291
DEBUG - 2017-07-11 16:00:54 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:00:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:00:54 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:00:54 --> Started Userauth
DEBUG - 2017-07-11 16:00:54 --> Total execution time: 0.0277
DEBUG - 2017-07-11 16:00:54 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:00:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:00:54 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:00:54 --> Started Userauth
DEBUG - 2017-07-11 16:00:54 --> Total execution time: 0.0194
DEBUG - 2017-07-11 16:00:54 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:00:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:00:54 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:00:54 --> Started Userauth
DEBUG - 2017-07-11 16:00:54 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:00:54 --> Total execution time: 0.0316
DEBUG - 2017-07-11 16:02:02 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:02:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:02:02 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:02:02 --> Started Userauth
DEBUG - 2017-07-11 16:02:02 --> Total execution time: 0.0262
DEBUG - 2017-07-11 16:02:02 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:02:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:02:02 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:02:02 --> Started Userauth
DEBUG - 2017-07-11 16:02:02 --> Total execution time: 0.0187
DEBUG - 2017-07-11 16:02:02 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:02:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:02:02 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:02:02 --> Started Userauth
DEBUG - 2017-07-11 16:02:02 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:02:02 --> Total execution time: 0.0302
DEBUG - 2017-07-11 16:02:43 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:02:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:02:43 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:02:43 --> Started Userauth
DEBUG - 2017-07-11 16:02:43 --> Total execution time: 0.0259
DEBUG - 2017-07-11 16:02:43 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:02:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:02:43 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:02:44 --> Started Userauth
DEBUG - 2017-07-11 16:02:44 --> Total execution time: 0.0201
DEBUG - 2017-07-11 16:02:44 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:02:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:02:44 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:02:44 --> Started Userauth
DEBUG - 2017-07-11 16:02:44 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:02:44 --> Total execution time: 0.0285
DEBUG - 2017-07-11 16:02:51 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:02:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:02:51 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:02:51 --> Started Userauth
DEBUG - 2017-07-11 16:02:51 --> Total execution time: 0.0283
DEBUG - 2017-07-11 16:02:51 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:02:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:02:51 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:02:51 --> Started Userauth
DEBUG - 2017-07-11 16:02:51 --> Total execution time: 0.0204
DEBUG - 2017-07-11 16:02:51 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:02:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:02:51 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:02:51 --> Started Userauth
DEBUG - 2017-07-11 16:02:51 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:02:51 --> Total execution time: 0.0288
DEBUG - 2017-07-11 16:11:15 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:11:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:11:15 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:11:15 --> Started Userauth
DEBUG - 2017-07-11 16:11:15 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:11:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:11:15 --> Total execution time: 0.0408
DEBUG - 2017-07-11 16:11:15 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:11:15 --> Started Userauth
DEBUG - 2017-07-11 16:11:15 --> Total execution time: 0.0206
DEBUG - 2017-07-11 16:11:15 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:11:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:11:15 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:11:15 --> Started Userauth
DEBUG - 2017-07-11 16:11:15 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:11:15 --> Total execution time: 0.0287
DEBUG - 2017-07-11 16:15:14 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:15:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:15:14 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:15:14 --> Started Userauth
DEBUG - 2017-07-11 16:15:14 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:15:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:15:14 --> Total execution time: 0.0345
DEBUG - 2017-07-11 16:15:14 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:15:14 --> Started Userauth
DEBUG - 2017-07-11 16:15:14 --> Total execution time: 0.0212
DEBUG - 2017-07-11 16:15:15 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:15:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:15:15 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:15:15 --> Started Userauth
DEBUG - 2017-07-11 16:15:15 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:15:15 --> Total execution time: 0.0311
DEBUG - 2017-07-11 16:16:15 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:16:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:16:15 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:16:15 --> Started Userauth
DEBUG - 2017-07-11 16:16:15 --> Total execution time: 0.0242
DEBUG - 2017-07-11 16:16:15 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:16:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:16:15 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:16:15 --> Started Userauth
DEBUG - 2017-07-11 16:16:15 --> Total execution time: 0.0213
DEBUG - 2017-07-11 16:16:16 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:16:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:16:16 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:16:16 --> Started Userauth
DEBUG - 2017-07-11 16:16:16 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:16:16 --> Total execution time: 0.0260
DEBUG - 2017-07-11 16:17:16 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:17:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:17:16 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:17:16 --> Started Userauth
DEBUG - 2017-07-11 16:17:16 --> Total execution time: 0.0242
DEBUG - 2017-07-11 16:17:16 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:17:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:17:16 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:17:16 --> Started Userauth
DEBUG - 2017-07-11 16:17:16 --> Total execution time: 0.0278
DEBUG - 2017-07-11 16:17:16 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:17:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:17:16 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:17:16 --> Started Userauth
DEBUG - 2017-07-11 16:17:17 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:17:17 --> Total execution time: 0.0271
DEBUG - 2017-07-11 16:17:56 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:17:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:17:56 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:17:56 --> Started Userauth
DEBUG - 2017-07-11 16:17:56 --> Total execution time: 0.0267
DEBUG - 2017-07-11 16:17:56 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:17:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:17:56 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:17:56 --> Started Userauth
DEBUG - 2017-07-11 16:17:56 --> Total execution time: 0.0214
DEBUG - 2017-07-11 16:17:56 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:17:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:17:56 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:17:56 --> Started Userauth
DEBUG - 2017-07-11 16:17:56 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:17:56 --> Total execution time: 0.0319
DEBUG - 2017-07-11 16:20:38 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:20:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:20:38 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:20:38 --> Started Userauth
DEBUG - 2017-07-11 16:20:38 --> Total execution time: 0.0247
DEBUG - 2017-07-11 16:20:38 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:20:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:20:38 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:20:38 --> Started Userauth
DEBUG - 2017-07-11 16:20:38 --> Total execution time: 0.0214
DEBUG - 2017-07-11 16:20:38 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:20:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:20:38 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:20:38 --> Started Userauth
DEBUG - 2017-07-11 16:20:38 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:20:38 --> Total execution time: 0.0337
DEBUG - 2017-07-11 16:22:20 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:22:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:22:20 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:22:20 --> Started Userauth
DEBUG - 2017-07-11 16:22:20 --> Total execution time: 0.0251
DEBUG - 2017-07-11 16:22:20 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:22:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:22:20 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:22:20 --> Started Userauth
DEBUG - 2017-07-11 16:22:20 --> Total execution time: 0.0221
DEBUG - 2017-07-11 16:22:20 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:22:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:22:20 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:22:20 --> Started Userauth
DEBUG - 2017-07-11 16:22:20 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:22:20 --> Total execution time: 0.0323
DEBUG - 2017-07-11 16:22:58 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:22:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:22:58 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:22:58 --> Started Userauth
DEBUG - 2017-07-11 16:22:58 --> Total execution time: 0.0246
DEBUG - 2017-07-11 16:22:58 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:22:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:22:58 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:22:58 --> Started Userauth
DEBUG - 2017-07-11 16:22:58 --> Total execution time: 0.0199
DEBUG - 2017-07-11 16:22:58 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:22:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:22:58 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:22:58 --> Started Userauth
DEBUG - 2017-07-11 16:22:58 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:22:58 --> Total execution time: 0.0330
DEBUG - 2017-07-11 16:23:50 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:23:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:23:50 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:23:50 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:23:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:23:50 --> Started Userauth
DEBUG - 2017-07-11 16:23:50 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:23:50 --> Total execution time: 0.0413
DEBUG - 2017-07-11 16:23:50 --> Started Userauth
DEBUG - 2017-07-11 16:23:50 --> Total execution time: 0.0218
DEBUG - 2017-07-11 16:23:50 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:23:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:23:50 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:23:50 --> Started Userauth
DEBUG - 2017-07-11 16:23:50 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:23:50 --> Total execution time: 0.0343
DEBUG - 2017-07-11 16:37:13 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:37:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:37:13 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:37:13 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:37:13 --> Started Userauth
DEBUG - 2017-07-11 16:37:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:37:13 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:37:13 --> Total execution time: 0.0381
DEBUG - 2017-07-11 16:37:13 --> Started Userauth
DEBUG - 2017-07-11 16:37:13 --> Total execution time: 0.0203
DEBUG - 2017-07-11 16:37:13 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:37:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:37:13 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:37:13 --> Started Userauth
DEBUG - 2017-07-11 16:37:13 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:37:13 --> Total execution time: 0.0384
DEBUG - 2017-07-11 16:37:36 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:37:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:37:36 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:37:36 --> Started Userauth
DEBUG - 2017-07-11 16:37:36 --> Total execution time: 0.0259
DEBUG - 2017-07-11 16:37:37 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:37:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:37:37 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:37:37 --> Started Userauth
DEBUG - 2017-07-11 16:37:37 --> Total execution time: 0.0241
DEBUG - 2017-07-11 16:37:37 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:37:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:37:37 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:37:37 --> Started Userauth
DEBUG - 2017-07-11 16:37:37 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:37:37 --> Total execution time: 0.0296
DEBUG - 2017-07-11 16:38:12 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:38:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:38:12 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:38:12 --> Started Userauth
DEBUG - 2017-07-11 16:38:12 --> Total execution time: 0.0253
DEBUG - 2017-07-11 16:38:13 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:38:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:38:13 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:38:13 --> Started Userauth
DEBUG - 2017-07-11 16:38:13 --> Total execution time: 0.0239
DEBUG - 2017-07-11 16:38:13 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:38:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:38:13 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:38:13 --> Started Userauth
DEBUG - 2017-07-11 16:38:13 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:38:13 --> Total execution time: 0.0267
DEBUG - 2017-07-11 16:38:46 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:38:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:38:46 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:38:46 --> Started Userauth
DEBUG - 2017-07-11 16:38:46 --> Total execution time: 0.0291
DEBUG - 2017-07-11 16:38:47 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:38:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:38:47 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:38:47 --> Started Userauth
DEBUG - 2017-07-11 16:38:47 --> Total execution time: 0.0254
DEBUG - 2017-07-11 16:38:47 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:38:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:38:47 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:38:47 --> Started Userauth
DEBUG - 2017-07-11 16:38:47 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:38:47 --> Total execution time: 0.0295
DEBUG - 2017-07-11 16:39:16 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:39:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:39:16 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:39:16 --> Started Userauth
DEBUG - 2017-07-11 16:39:16 --> Total execution time: 0.0261
DEBUG - 2017-07-11 16:39:17 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:39:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:39:17 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:39:17 --> Started Userauth
DEBUG - 2017-07-11 16:39:17 --> Total execution time: 0.0251
DEBUG - 2017-07-11 16:39:17 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:39:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:39:17 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:39:17 --> Started Userauth
DEBUG - 2017-07-11 16:39:17 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:39:17 --> Total execution time: 0.0267
DEBUG - 2017-07-11 16:41:06 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:41:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:41:06 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:41:06 --> Started Userauth
DEBUG - 2017-07-11 16:41:06 --> Total execution time: 0.0296
DEBUG - 2017-07-11 16:41:06 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:41:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:41:06 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:41:06 --> Started Userauth
DEBUG - 2017-07-11 16:41:06 --> Total execution time: 0.0263
DEBUG - 2017-07-11 16:41:06 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:41:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:41:06 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:41:06 --> Started Userauth
DEBUG - 2017-07-11 16:41:06 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:41:06 --> Total execution time: 0.0309
DEBUG - 2017-07-11 16:42:32 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:42:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:42:32 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:42:32 --> Started Userauth
DEBUG - 2017-07-11 16:42:32 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:42:32 --> Total execution time: 0.0282
DEBUG - 2017-07-11 16:42:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:42:32 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:42:32 --> Started Userauth
DEBUG - 2017-07-11 16:42:32 --> Total execution time: 0.0214
DEBUG - 2017-07-11 16:42:32 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:42:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:42:32 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:42:32 --> Started Userauth
DEBUG - 2017-07-11 16:42:32 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:42:32 --> Total execution time: 0.0336
DEBUG - 2017-07-11 16:44:19 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:44:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:44:19 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:44:19 --> Started Userauth
DEBUG - 2017-07-11 16:44:19 --> Total execution time: 0.0250
DEBUG - 2017-07-11 16:44:19 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:44:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:44:20 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:44:20 --> Started Userauth
DEBUG - 2017-07-11 16:44:20 --> Total execution time: 0.0221
DEBUG - 2017-07-11 16:44:20 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:44:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:44:20 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:44:20 --> Started Userauth
DEBUG - 2017-07-11 16:44:20 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:44:20 --> Total execution time: 0.0332
DEBUG - 2017-07-11 16:47:11 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:47:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:47:11 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:47:11 --> Started Userauth
DEBUG - 2017-07-11 16:47:11 --> Total execution time: 0.0254
DEBUG - 2017-07-11 16:47:11 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:47:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:47:11 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:47:11 --> Started Userauth
DEBUG - 2017-07-11 16:47:11 --> Total execution time: 0.0196
DEBUG - 2017-07-11 16:47:12 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:47:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:47:12 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:47:12 --> Started Userauth
DEBUG - 2017-07-11 16:47:12 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:47:12 --> Total execution time: 0.0311
DEBUG - 2017-07-11 16:47:59 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:47:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:47:59 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:47:59 --> Started Userauth
DEBUG - 2017-07-11 16:47:59 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:47:59 --> Total execution time: 0.0292
DEBUG - 2017-07-11 16:47:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:47:59 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:47:59 --> Started Userauth
DEBUG - 2017-07-11 16:47:59 --> Total execution time: 0.0203
DEBUG - 2017-07-11 16:47:59 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:47:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:47:59 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:47:59 --> Started Userauth
DEBUG - 2017-07-11 16:47:59 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:47:59 --> Total execution time: 0.0352
DEBUG - 2017-07-11 16:49:07 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:49:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:49:07 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:49:07 --> Started Userauth
DEBUG - 2017-07-11 16:49:07 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:49:07 --> Total execution time: 0.0297
DEBUG - 2017-07-11 16:49:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:49:07 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:49:07 --> Started Userauth
DEBUG - 2017-07-11 16:49:07 --> Total execution time: 0.0217
DEBUG - 2017-07-11 16:49:07 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:49:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:49:07 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:49:07 --> Started Userauth
DEBUG - 2017-07-11 16:49:07 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:49:07 --> Total execution time: 0.0384
DEBUG - 2017-07-11 16:49:30 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:49:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:49:30 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:49:30 --> Started Userauth
DEBUG - 2017-07-11 16:49:30 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:49:30 --> Total execution time: 0.0296
DEBUG - 2017-07-11 16:49:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:49:30 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:49:30 --> Started Userauth
DEBUG - 2017-07-11 16:49:30 --> Total execution time: 0.0210
DEBUG - 2017-07-11 16:49:30 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:49:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:49:30 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:49:30 --> Started Userauth
DEBUG - 2017-07-11 16:49:30 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:49:30 --> Total execution time: 0.0340
DEBUG - 2017-07-11 16:49:43 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:49:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:49:43 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:49:43 --> Started Userauth
DEBUG - 2017-07-11 16:49:43 --> Total execution time: 0.0253
DEBUG - 2017-07-11 16:49:43 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:49:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:49:43 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:49:43 --> Started Userauth
DEBUG - 2017-07-11 16:49:43 --> Total execution time: 0.0204
DEBUG - 2017-07-11 16:49:44 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:49:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:49:44 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:49:44 --> Started Userauth
DEBUG - 2017-07-11 16:49:44 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:49:44 --> Total execution time: 0.0348
DEBUG - 2017-07-11 16:50:19 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:50:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:50:19 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:50:19 --> Started Userauth
DEBUG - 2017-07-11 16:50:19 --> Total execution time: 0.0271
DEBUG - 2017-07-11 16:50:19 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:50:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:50:19 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:50:19 --> Started Userauth
DEBUG - 2017-07-11 16:50:19 --> Total execution time: 0.0209
DEBUG - 2017-07-11 16:50:19 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:50:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:50:19 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:50:19 --> Started Userauth
DEBUG - 2017-07-11 16:50:19 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:50:19 --> Total execution time: 0.0298
DEBUG - 2017-07-11 16:50:53 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:50:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:50:53 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:50:53 --> Started Userauth
DEBUG - 2017-07-11 16:50:53 --> Total execution time: 0.0261
DEBUG - 2017-07-11 16:50:53 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:50:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:50:53 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:50:53 --> Started Userauth
DEBUG - 2017-07-11 16:50:53 --> Total execution time: 0.0227
DEBUG - 2017-07-11 16:50:53 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:50:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:50:53 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:50:53 --> Started Userauth
DEBUG - 2017-07-11 16:50:53 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:50:53 --> Total execution time: 0.0305
DEBUG - 2017-07-11 16:51:12 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:51:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:51:12 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:51:12 --> Started Userauth
DEBUG - 2017-07-11 16:51:12 --> Total execution time: 0.0251
DEBUG - 2017-07-11 16:51:12 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:51:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:51:12 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:51:13 --> Started Userauth
DEBUG - 2017-07-11 16:51:13 --> Total execution time: 0.0220
DEBUG - 2017-07-11 16:51:13 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:51:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:51:13 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:51:13 --> Started Userauth
DEBUG - 2017-07-11 16:51:13 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:51:13 --> Total execution time: 0.0354
DEBUG - 2017-07-11 16:51:30 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:51:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:51:30 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:51:30 --> Started Userauth
DEBUG - 2017-07-11 16:51:30 --> Total execution time: 0.0253
DEBUG - 2017-07-11 16:51:30 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:51:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:51:30 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:51:30 --> Started Userauth
DEBUG - 2017-07-11 16:51:30 --> Total execution time: 0.0195
DEBUG - 2017-07-11 16:51:30 --> UTF-8 Support Enabled
DEBUG - 2017-07-11 16:51:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2017-07-11 16:51:30 --> Config file loaded: /private/var/www/extptsapi/application/config/config_site.php
DEBUG - 2017-07-11 16:51:30 --> Started Userauth
DEBUG - 2017-07-11 16:51:30 --> career range start(1996) end(2016)
DEBUG - 2017-07-11 16:51:30 --> Total execution time: 0.0277
