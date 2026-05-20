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

$module_version = [
    'name' => 'Drive',
    'modfuncs' => 'main,download',
    'change_alias' => 'main,download',
    'submenu' => 'main',
    'is_sysmod' => 0,
    'virtual' => 0,
    'version' => '4.5.08',
    'date' => date('l, d F Y H:i:s T'),
    'author' => 'jules',
    'uploads_dir' => [$module_name],
    'note' => 'Module kết nối và quản lý Google Drive'
];
