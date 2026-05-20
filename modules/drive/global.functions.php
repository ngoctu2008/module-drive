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

// Require Google API client
require_once NV_ROOTDIR . '/modules/' . $module_file . '/vendor/autoload.php';

/**
 * Initializes and returns a Google Client configured with Service Account
 */
function nv_drive_get_client($module_data)
{
    global $nv_Cache, $global_config, $module_config;

    // Get config from nv4_config
    $config = $module_config[$module_data];
    if (empty($config['service_account_json'])) {
        return false;
    }

    try {
        $client = new Google\Client();
        $client->setAuthConfig(json_decode($config['service_account_json'], true));
        $client->addScope(Google\Service\Drive::DRIVE);
        $client->setAccessType('offline');

        return $client;
    } catch (Exception $e) {
        trigger_error('Drive API Error: ' . $e->getMessage(), E_USER_WARNING);
        return false;
    }
}

/**
 * Get Google Drive Service
 */
function nv_drive_get_service($module_data) {
    $client = nv_drive_get_client($module_data);
    if (!$client) {
        return false;
    }
    return new Google\Service\Drive($client);
}
