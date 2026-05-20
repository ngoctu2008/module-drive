<?php

/**
 * @Project NUKEVIET 4.x
 * @Author jules <jules@example.com>
 * @Copyright (C) 2024. All rights reserved
 * @License: Not free read
 * @Createdate
 */

if (!defined('NV_ADMIN')) {
    die('Stop!!!');
}

$submenu['config'] = $lang_module['config'];
$submenu['manager'] = $lang_module['manager'];

$allow_func = ['main', 'config', 'manager', 'upload', 'sync'];
