<?php

/**
 * @Project NUKEVIET 4.x
 * @Author jules <jules@example.com>
 * @Copyright (C) 2024. All rights reserved
 * @License: Not free read
 * @Createdate
 */

if (!defined('NV_IS_CRON')) {
    die('Stop!!!');
}

// Hàm xử lý đồng bộ dữ liệu với Google Drive qua Cronjob
function cron_sync_drive() {
    global $db, $db_config, $module_name, $module_data, $module_config, $lang;

    // Nếu cronjob gọi trực tiếp, module_name có thể không chuẩn xác tùy cấu hình cron.
    // Lấy thông tin từ mảng arguments nếu có thể, hoặc fallback
    $m_name = isset($module_name) ? $module_name : 'drive';
    $m_data = isset($module_data) ? $module_data : 'drive';

    require_once NV_ROOTDIR . '/modules/' . $m_name . '/global.functions.php';

    $service = nv_drive_get_service($m_data);
    if (!$service) {
        return false;
    }

    $config = $module_config[$m_name] ?? [];
    $root_folder_id = $config['root_folder_id'] ?? '';

    if (empty($root_folder_id)) {
        return false;
    }

    try {
        $optParams = array(
            'pageSize' => 1000,
            'fields' => 'nextPageToken, files(id, name, mimeType, size, parents, thumbnailLink, webViewLink, createdTime, modifiedTime)',
            'q' => "'" . $root_folder_id . "' in parents and trashed = false"
        );
        $results = $service->files->listFiles($optParams);

        if (count($results->getFiles()) > 0) {
            foreach ($results->getFiles() as $file) {

                $id = $file->getId();
                $name = $file->getName();
                $mimeType = $file->getMimeType();
                $cTime = strtotime($file->getCreatedTime());
                $mTime = strtotime($file->getModifiedTime());
                $parentId = isset($file->getParents()[0]) ? $file->getParents()[0] : '';

                if ($mimeType == 'application/vnd.google-apps.folder') {
                    $sql = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $m_data . "_folders
                            (folder_id, parent_id, name, created_time, modified_time)
                            VALUES (:folder_id, :parent_id, :name, :created_time, :modified_time)
                            ON DUPLICATE KEY UPDATE
                            parent_id = VALUES(parent_id), name = VALUES(name), modified_time = VALUES(modified_time)";
                    $sth = $db->prepare($sql);
                    $sth->execute([
                        ':folder_id' => $id,
                        ':parent_id' => $parentId,
                        ':name' => $name,
                        ':created_time' => $cTime,
                        ':modified_time' => $mTime
                    ]);
                } else {
                    $size = $file->getSize() ? $file->getSize() : 0;
                    $thumbnail = $file->getThumbnailLink() ? $file->getThumbnailLink() : '';
                    $webView = $file->getWebViewLink() ? $file->getWebViewLink() : '';

                    $sql = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $m_data . "_files
                            (file_id, folder_id, name, mime_type, size, thumbnail_link, web_view_link, created_time, modified_time)
                            VALUES (:file_id, :folder_id, :name, :mime_type, :size, :thumbnail_link, :web_view_link, :created_time, :modified_time)
                            ON DUPLICATE KEY UPDATE
                            folder_id = VALUES(folder_id), name = VALUES(name), mime_type = VALUES(mime_type),
                            size = VALUES(size), thumbnail_link = VALUES(thumbnail_link), web_view_link = VALUES(web_view_link),
                            modified_time = VALUES(modified_time)";
                    $sth = $db->prepare($sql);
                    $sth->execute([
                        ':file_id' => $id,
                        ':folder_id' => $parentId,
                        ':name' => $name,
                        ':mime_type' => $mimeType,
                        ':size' => $size,
                        ':thumbnail_link' => $thumbnail,
                        ':web_view_link' => $webView,
                        ':created_time' => $cTime,
                        ':modified_time' => $mTime
                    ]);
                }
            }
        }
        return true;
    } catch (Exception $e) {
        return false;
    }
}

cron_sync_drive();
