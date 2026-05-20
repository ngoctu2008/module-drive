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

$page_title = $lang_module['config'];

$error = '';
$saved = false;

// Initialize config defaults
$current_config = $module_config[$module_name] ?? [
    'service_account_json' => '',
    'root_folder_id' => ''
];

if ($nv_Request->isset_request('savesetting', 'post')) {
    if (!nv_check_formtoken()) {
        $error = $lang_global['securitycode_incorrect'];
    } else {
        $service_account_json = $nv_Request->get_string('service_account_json', 'post', '');
        $root_folder_id = $nv_Request->get_title('root_folder_id', 'post', '');

        // Validation (basic JSON format check)
        if (!empty($service_account_json) && json_decode($service_account_json) === null) {
            $error = $lang_module['error_invalid_json'];
        } else {
            nv_set_config($module_name, 'service_account_json', $service_account_json);
            nv_set_config($module_name, 'root_folder_id', $root_folder_id);

            $nv_Cache->delMod($module_name);
            $saved = true;

            // Reload config
            $current_config['service_account_json'] = $service_account_json;
            $current_config['root_folder_id'] = $root_folder_id;
        }
    }
}

$xtpl = new XTemplate('config.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('GLANG', $lang_global);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);

if (!empty($error)) {
    $xtpl->assign('ERROR', $error);
    $xtpl->parse('main.error');
}
if ($saved) {
    $xtpl->parse('main.saved');
}

$xtpl->assign('DATA', [
    'service_account_json' => nv_htmlspecialchars($current_config['service_account_json']),
    'root_folder_id' => nv_htmlspecialchars($current_config['root_folder_id'])
]);

$xtpl->assign('FORM_ACTION', NV_BASE_ADMINURL . '?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op);
$xtpl->assign('CHECKSS', nv_check_formtoken_input());

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
