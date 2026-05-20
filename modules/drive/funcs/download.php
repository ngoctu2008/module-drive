<?php

/**
 * @Project NUKEVIET 4.x
 * @Author jules <jules@example.com>
 * @Copyright (C) 2024. All rights reserved
 * @License: Not free read
 * @Createdate
 */

if (!defined('NV_IS_MOD_DRIVE')) {
    die('Stop!!!');
}

$file_id = $nv_Request->get_string('id', 'get', '');

if (empty($file_id)) {
    nv_info_die($lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content']);
}

// Lấy thông tin file và kiểm tra quyền qua folder
$sql = "SELECT t1.*, t2.groups_download FROM " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_files t1
        LEFT JOIN " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_folders t2 ON t1.folder_id = t2.folder_id
        WHERE t1.file_id = :file_id";
$sth = $db->prepare($sql);
$sth->bindParam(':file_id', $file_id);
$sth->execute();
$file_info = $sth->fetch();

if (empty($file_info)) {
    nv_info_die($lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content']);
}

// Kiểm tra quyền download
$required_group = $file_info['groups_download'] ?? '6';
$has_permission = true;

if ($required_group != '0' && $required_group != '6') {
    if (empty($user_info)) {
        $has_permission = false;
    } else {
        $user_groups = explode(',', $user_info['in_groups']);
        if (!in_array($required_group, $user_groups)) {
            $has_permission = false;
        }
    }
}

if (!$has_permission) {
    nv_info_die($lang_global['error_info'], $lang_global['error_info'], "You do not have permission to download this file.");
}

// Gọi API để tải file (proxy)
$service = nv_drive_get_service($module_data);
if (!$service) {
    nv_info_die($lang_global['error_info'], $lang_global['error_info'], "Service Unavailable.");
}

try {
    $response = $service->files->get($file_id, array('alt' => 'media'));

    header('Content-Type: ' . $file_info['mime_type']);
    header('Content-Disposition: attachment; filename="' . $file_info['name'] . '"');
    header('Content-Length: ' . $file_info['size']);
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Expires: 0');

    echo $response->getBody()->getContents();
    exit;
} catch (Exception $e) {
    nv_info_die($lang_global['error_info'], $lang_global['error_info'], "Error downloading file.");
}
