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

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];

// Xử lý lấy thư mục hiện tại từ Request
$folder_id = $nv_Request->get_string('id', 'get', '');

// Hàm kiểm tra quyền
function check_permission($required_group, $user_info) {
    if ($required_group == '0' || $required_group == '6') { // 6 is Guest
        return true;
    }
    if (empty($user_info)) {
        return false;
    }
    $user_groups = explode(',', $user_info['in_groups']);
    return in_array($required_group, $user_groups);
}

// Lấy danh sách thư mục và file từ DB cache
$sql_folders = "SELECT * FROM " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_folders WHERE parent_id = :parent_id ORDER BY name ASC";
$sth_folders = $db->prepare($sql_folders);
$sth_folders->bindParam(':parent_id', $folder_id);
$sth_folders->execute();

$sql_files = "SELECT * FROM " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_files WHERE folder_id = :folder_id ORDER BY name ASC";
$sth_files = $db->prepare($sql_files);
$sth_files->bindParam(':folder_id', $folder_id);
$sth_files->execute();

$xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);

// Parse Folders
while ($row = $sth_folders->fetch()) {
    if (check_permission($row['groups_view'], $user_info)) {
        $row['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;id=' . $row['folder_id'];
        $xtpl->assign('FOLDER', $row);
        $xtpl->parse('main.folder_loop');
    }
}

// Parse Files
while ($row = $sth_files->fetch()) {
    $row['size_str'] = nv_convertfromBytes($row['size']);
    $row['download_link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=download&amp;id=' . $row['file_id'];
    $xtpl->assign('FILE', $row);
    $xtpl->parse('main.file_loop');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
