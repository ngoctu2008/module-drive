<?php

/**
 * @Project NUKEVIET 4.x
 * @Author jules <jules@example.com>
 * @Copyright (C) 2024. All rights reserved
 * @License: Not free read
 * @Createdate
 */

if (!defined('NV_MAINFILE')) {
    die('Stop!!!');
}

$sql_drop_module = [];

$sql_drop_module[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_files`";
$sql_drop_module[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_folders`";

$sql_create_module = $sql_drop_module;

$sql_create_module[] = "CREATE TABLE `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_files` (
  `file_id` varchar(255) NOT NULL,
  `folder_id` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL,
  `mime_type` varchar(255) NOT NULL,
  `size` bigint(20) unsigned NOT NULL DEFAULT '0',
  `thumbnail_link` text,
  `web_view_link` text,
  `created_time` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`file_id`),
  KEY `folder_id` (`folder_id`)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_folders` (
  `folder_id` varchar(255) NOT NULL,
  `parent_id` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL,
  `groups_view` varchar(255) NOT NULL DEFAULT '6', /* Default group ID for visitors is 6 in NukeViet */
  `groups_download` varchar(255) NOT NULL DEFAULT '6',
  `created_time` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`folder_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM";
