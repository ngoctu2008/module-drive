<!-- BEGIN: main -->
<!-- BEGIN: error -->
<div class="alert alert-danger">{ERROR}</div>
<!-- END: error -->

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>{LANG.name}</th>
                <th>{LANG.type}</th>
                <th>{LANG.size}</th>
                <th>{LANG.last_modified}</th>
                <th>{LANG.actions}</th>
            </tr>
        </thead>
        <tbody>
            <!-- BEGIN: folder_loop -->
            <tr>
                <td><i class="fa fa-folder-o text-warning"></i> {FOLDER.name}</td>
                <td>{LANG.folder}</td>
                <td>-</td>
                <td>{FOLDER.modified_time_str}</td>
                <td>
                    <form action="{FORM_ACTION}" method="post" style="display:inline;" onsubmit="return confirm('{LANG.confirm_del_folder}');">
                        {CHECKSS}
                        <input type="hidden" name="delete_id" value="{FOLDER.folder_id}">
                        <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> {LANG.delete}</button>
                    </form>
                </td>
            </tr>
            <!-- END: folder_loop -->

            <!-- BEGIN: file_loop -->
            <tr>
                <td><i class="fa fa-file-o"></i> {FILE.name}</td>
                <td>{LANG.file}</td>
                <td>{FILE.size_str}</td>
                <td>{FILE.modified_time_str}</td>
                <td>
                    <form action="{FORM_ACTION}" method="post" style="display:inline;" onsubmit="return confirm('{LANG.confirm_del_file}');">
                        {CHECKSS}
                        <input type="hidden" name="delete_id" value="{FILE.file_id}">
                        <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> {LANG.delete}</button>
                    </form>
                </td>
            </tr>
            <!-- END: file_loop -->
        </tbody>
    </table>
</div>

<!-- Upload form placeholder -->
<div class="panel panel-default" style="margin-top: 20px;">
    <div class="panel-heading">{LANG.upload_file}</div>
    <div class="panel-body">
        <p>{LANG.upload_desc}</p>
    </div>
</div>
<!-- END: main -->
