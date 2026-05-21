<?php

/**
 * @Project NUKEVIET 4.x
 * @Author jules <jules@example.com>
 * @Copyright (C) 2024. All rights reserved
 * @License: Not free read
 * @Createdate
 */

if (!defined('NV_ADMIN') or !defined('NV_MAINFILE')) {
    die('Stop!!!');
}

$lang_translator['author'] = 'jules';
$lang_translator['createdate'] = '';
$lang_translator['copyright'] = '@Copyright (C) 2024. All rights reserved';
$lang_translator['info'] = '';
$lang_translator['langtype'] = 'lang_module';

$lang_module['main'] = 'Dashboard';
$lang_module['config'] = 'Configuration';
$lang_module['manager'] = 'Drive Manager';
$lang_module['save'] = 'Save';
$lang_module['save_success'] = 'Configuration saved successfully.';
$lang_module['error_invalid_json'] = 'Invalid JSON format.';
$lang_module['error_not_connected'] = 'Could not connect to Google Drive. Please check your JSON configuration.';
$lang_module['not_connected'] = 'Not Connected!';
$lang_module['please_go_to'] = 'Please go to';
$lang_module['to_setup_api'] = 'to set up the API.';
$lang_module['connected_success'] = 'Connected to Google Drive!';
$lang_module['total_limit'] = 'Total Limit';
$lang_module['total_usage'] = 'Total Usage';
$lang_module['drive_usage'] = 'Drive Usage';
$lang_module['trash_usage'] = 'Trash Usage';
$lang_module['sync_now'] = 'Sync Now';
$lang_module['name'] = 'Name';
$lang_module['type'] = 'Type';
$lang_module['size'] = 'Size';
$lang_module['last_modified'] = 'Last Modified';
$lang_module['actions'] = 'Actions';
$lang_module['folder'] = 'Folder';
$lang_module['file'] = 'File';
$lang_module['delete'] = 'Delete';
$lang_module['confirm_del_folder'] = 'Are you sure you want to delete this folder?';
$lang_module['confirm_del_file'] = 'Are you sure you want to delete this file?';
$lang_module['upload_file'] = 'Upload File';
$lang_module['upload_desc'] = 'To implement plupload UI chunking frontend, use standard NukeViet plupload template here.';
$lang_module['service_account_json'] = 'Service Account JSON';
$lang_module['service_account_desc'] = 'Paste the JSON configuration downloaded from Google Cloud Console.';
$lang_module['root_folder_id'] = 'Root Folder ID';
$lang_module['root_folder_desc'] = 'The ID of the folder on Google Drive you want to sync.';
