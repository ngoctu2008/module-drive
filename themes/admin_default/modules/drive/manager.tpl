<!-- BEGIN: main -->
<!-- BEGIN: error -->
<div class="alert alert-danger">{ERROR}</div>
<!-- END: error -->

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Size</th>
                <th>Last Modified</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- BEGIN: folder_loop -->
            <tr>
                <td><i class="fa fa-folder-o text-warning"></i> {FOLDER.name}</td>
                <td>Folder</td>
                <td>-</td>
                <td>{FOLDER.modified_time_str}</td>
                <td>
                    <form action="{FORM_ACTION}" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this folder?');">
                        {CHECKSS}
                        <input type="hidden" name="delete_id" value="{FOLDER.folder_id}">
                        <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</button>
                    </form>
                </td>
            </tr>
            <!-- END: folder_loop -->

            <!-- BEGIN: file_loop -->
            <tr>
                <td><i class="fa fa-file-o"></i> {FILE.name}</td>
                <td>File</td>
                <td>{FILE.size_str}</td>
                <td>{FILE.modified_time_str}</td>
                <td>
                    <form action="{FORM_ACTION}" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this file?');">
                        {CHECKSS}
                        <input type="hidden" name="delete_id" value="{FILE.file_id}">
                        <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</button>
                    </form>
                </td>
            </tr>
            <!-- END: file_loop -->
        </tbody>
    </table>
</div>

<!-- Upload form placeholder -->
<div class="panel panel-default" style="margin-top: 20px;">
    <div class="panel-heading">Upload File</div>
    <div class="panel-body">
        <p>To implement plupload UI chunking frontend, use standard NukeViet plupload template here.</p>
    </div>
</div>
<!-- END: main -->
