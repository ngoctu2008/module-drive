<?php

/**
 * @Project NUKEVIET 4.x
 * @Author jules <jules@example.com>
 * @Copyright (C) 2024. All rights reserved
 * @License: Not free read
 * @Createdate
 */

if (!defined('NV_IS_FILE_ADMIN')) {
    die('Stop!!!');
}

$page_title = $lang_module['main'];

$client = nv_drive_get_client($module_name);
$is_connected = $client !== false;
$quota_info = [];

if ($is_connected) {
    try {
        $service = new Google\Service\Drive($client);
        $about = $service->about->get(['fields' => 'storageQuota']);
        $quota = $about->getStorageQuota();

        $quota_info = [
            'limit' => nv_convertfromBytes($quota->getLimit()),
            'usage' => nv_convertfromBytes($quota->getUsage()),
            'usageInDrive' => nv_convertfromBytes($quota->getUsageInDrive()),
            'usageInDriveTrash' => nv_convertfromBytes($quota->getUsageInDriveTrash()),
        ];
    } catch (Exception $e) {
        $is_connected = false;
        $error_message = $e->getMessage();
    }
}

$xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('GLANG', $lang_global);

if ($is_connected) {
    $xtpl->assign('QUOTA', $quota_info);
    $xtpl->parse('main.connected');
} else {
    $xtpl->assign('ERROR_MESSAGE', $error_message ?? $lang_module['error_not_connected']);
    $xtpl->parse('main.disconnected');
}

// Sync URL
$xtpl->assign('SYNC_URL', NV_BASE_ADMINURL . '?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=sync');

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
