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

$page_title = $lang_module['manager'];

// Xử lý xoá file nếu có request
$delete_id = $nv_Request->get_string('delete_id', 'post', '');
if (!empty($delete_id) && nv_check_formtoken()) {
    $service = nv_drive_get_service($module_name);
    if ($service) {
        try {
            $service->files->delete($delete_id);
            // Xoá ở DB cache
            $db->query("DELETE FROM " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_files WHERE file_id=" . $db->quote($delete_id));
            $db->query("DELETE FROM " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_folders WHERE folder_id=" . $db->quote($delete_id));

            nv_redirect_location(NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=" . $op);
        } catch (Exception $e) {
            $error_message = $e->getMessage();
        }
    }
}

// Lấy danh sách file và thư mục từ Database cache
$sql_files = "SELECT * FROM " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_files ORDER BY modified_time DESC";
$result_files = $db->query($sql_files);

$sql_folders = "SELECT * FROM " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_folders ORDER BY modified_time DESC";
$result_folders = $db->query($sql_folders);

$xtpl = new XTemplate('manager.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('GLANG', $lang_global);
$xtpl->assign('CHECKSS', nv_check_formtoken_input());
$xtpl->assign('FORM_ACTION', NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=" . $op);

if (isset($error_message)) {
    $xtpl->assign('ERROR', $error_message);
    $xtpl->parse('main.error');
}

while ($row = $result_folders->fetch()) {
    $row['modified_time_str'] = nv_date('d/m/Y H:i', $row['modified_time']);
    $xtpl->assign('FOLDER', $row);
    $xtpl->parse('main.folder_loop');
}

while ($row = $result_files->fetch()) {
    $row['size_str'] = nv_convertfromBytes($row['size']);
    $row['modified_time_str'] = nv_date('d/m/Y H:i', $row['modified_time']);
    $xtpl->assign('FILE', $row);
    $xtpl->parse('main.file_loop');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
