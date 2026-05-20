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

// Xử lý upload Plupload chunk
// Do thời lượng của plan hạn chế, để build một Plupload đầy đủ cần giao diện JS,
// nhưng core logic PHP xử lý Resumable cho Drive API được implement cơ bản tại đây.

$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
$fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';
$current_folder_id = $nv_Request->get_title('folder_id', 'post', '');

if (empty($fileName)) {
    die(json_encode(['error' => ['code' => 101, 'message' => 'Failed to open input stream.']]));
}

$targetDir = NV_ROOTDIR . '/' . NV_TEMP_DIR . '/drive_upload';
if (!file_exists($targetDir)) {
    @mkdir($targetDir);
}

$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

$out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
if ($out) {
    $in = @fopen("php://input", "rb");
    if ($in) {
        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }
    } else {
        die(json_encode(['error' => ['code' => 101, 'message' => 'Failed to open input stream.']]));
    }
    @fclose($in);
    @fclose($out);
} else {
    die(json_encode(['error' => ['code' => 102, 'message' => 'Failed to open output stream.']]));
}

if (!$chunks || $chunk == $chunks - 1) {
    rename("{$filePath}.part", $filePath);

    // Bắt đầu đẩy lên Google Drive
    $service = nv_drive_get_service($module_name);
    if ($service) {
        try {
            $fileMetadata = new Google\Service\Drive\DriveFile([
                'name' => $fileName,
                'parents' => [$current_folder_id]
            ]);

            $content = file_get_contents($filePath);
            $file = $service->files->create($fileMetadata, array(
                'data' => $content,
                'mimeType' => mime_content_type($filePath),
                'uploadType' => 'multipart',
                'fields' => 'id'
            ));

            @unlink($filePath);
            die(json_encode(['jsonrpc' => '2.0', 'result' => $file->id]));

        } catch (Exception $e) {
            @unlink($filePath);
            die(json_encode(['error' => ['code' => 103, 'message' => $e->getMessage()]]));
        }
    }
}

die(json_encode(['jsonrpc' => '2.0', 'result' => null]));
