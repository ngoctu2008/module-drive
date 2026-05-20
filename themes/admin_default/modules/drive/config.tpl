<!-- BEGIN: main -->
<div class="panel panel-default">
    <div class="panel-body">
        <!-- BEGIN: error -->
        <div class="alert alert-danger">{ERROR}</div>
        <!-- END: error -->
        <!-- BEGIN: saved -->
        <div class="alert alert-success">{LANG.save_success}</div>
        <!-- END: saved -->

        <form action="{FORM_ACTION}" method="post">
            <div class="form-group">
                <label>Service Account JSON</label>
                <textarea name="service_account_json" class="form-control" rows="8">{DATA.service_account_json}</textarea>
                <span class="help-block">Paste the JSON configuration downloaded from Google Cloud Console.</span>
            </div>
            <div class="form-group">
                <label>Root Folder ID</label>
                <input type="text" name="root_folder_id" value="{DATA.root_folder_id}" class="form-control" />
                <span class="help-block">The ID of the folder on Google Drive you want to sync.</span>
            </div>
            <input type="hidden" name="checkss" value="{CHECKSS}" />
            <div class="text-center">
                <button type="submit" name="savesetting" value="1" class="btn btn-primary">{LANG.save}</button>
            </div>
        </form>
    </div>
</div>
<!-- END: main -->
