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

$lang_module['main'] = 'Bảng điều khiển';
$lang_module['config'] = 'Cấu hình';
$lang_module['manager'] = 'Quản lý File';
$lang_module['save'] = 'Lưu cấu hình';
$lang_module['save_success'] = 'Lưu cấu hình thành công.';
$lang_module['error_invalid_json'] = 'Chuỗi JSON không hợp lệ.';
$lang_module['error_not_connected'] = 'Không thể kết nối đến Google Drive. Vui lòng kiểm tra lại cấu hình JSON.';
$lang_module['not_connected'] = 'Chưa kết nối!';
$lang_module['please_go_to'] = 'Vui lòng truy cập';
$lang_module['to_setup_api'] = 'để cài đặt API.';
$lang_module['connected_success'] = 'Đã kết nối với Google Drive!';
$lang_module['total_limit'] = 'Tổng dung lượng';
$lang_module['total_usage'] = 'Đã sử dụng';
$lang_module['drive_usage'] = 'Sử dụng Drive';
$lang_module['trash_usage'] = 'Sử dụng Thùng rác';
$lang_module['sync_now'] = 'Đồng bộ ngay';
$lang_module['name'] = 'Tên';
$lang_module['type'] = 'Loại';
$lang_module['size'] = 'Kích thước';
$lang_module['last_modified'] = 'Cập nhật lần cuối';
$lang_module['actions'] = 'Thao tác';
$lang_module['folder'] = 'Thư mục';
$lang_module['file'] = 'Tệp tin';
$lang_module['delete'] = 'Xóa';
$lang_module['confirm_del_folder'] = 'Bạn có chắc chắn muốn xóa thư mục này không?';
$lang_module['confirm_del_file'] = 'Bạn có chắc chắn muốn xóa tệp tin này không?';
$lang_module['upload_file'] = 'Tải lên Tệp tin';
$lang_module['upload_desc'] = 'Để triển khai giao diện plupload chia nhỏ file ở frontend, sử dụng template plupload chuẩn của NukeViet tại đây.';
$lang_module['service_account_json'] = 'Service Account JSON';
$lang_module['service_account_desc'] = 'Dán cấu hình JSON đã tải xuống từ Google Cloud Console.';
$lang_module['root_folder_id'] = 'Root Folder ID (Thư mục gốc)';
$lang_module['root_folder_desc'] = 'ID của thư mục trên Google Drive mà bạn muốn đồng bộ.';
