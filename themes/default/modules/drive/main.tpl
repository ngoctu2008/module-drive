<!-- BEGIN: main -->
<div class="panel panel-default">
    <div class="panel-heading">{LANG.drive_title}</div>
    <div class="panel-body">
        <ul class="list-group">
            <!-- BEGIN: folder_loop -->
            <li class="list-group-item">
                <i class="fa fa-folder-o text-warning"></i>
                <a href="{FOLDER.link}">{FOLDER.name}</a>
            </li>
            <!-- END: folder_loop -->

            <!-- BEGIN: file_loop -->
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><i class="fa fa-file-o"></i> {FILE.name} <small class="text-muted">({FILE.size_str})</small></span>
                <a href="{FILE.download_link}" class="btn btn-xs btn-primary"><i class="fa fa-download"></i> Download</a>
            </li>
            <!-- END: file_loop -->
        </ul>
    </div>
</div>
<!-- END: main -->
