<!-- BEGIN: main -->
<div class="panel panel-default">
    <div class="panel-body">
        <!-- BEGIN: disconnected -->
        <div class="alert alert-danger">
            <strong>{LANG.not_connected}</strong><br />
            {ERROR_MESSAGE}<br />
            {LANG.please_go_to} <a href="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&{NV_NAME_VARIABLE}={MODULE_NAME}&{NV_OP_VARIABLE}=config">{LANG.config}</a> {LANG.to_setup_api}
        </div>
        <!-- END: disconnected -->

        <!-- BEGIN: connected -->
        <div class="alert alert-success">
            <strong>{LANG.connected_success}</strong>
        </div>
        <table class="table table-striped table-bordered">
            <tbody>
                <tr>
                    <td>{LANG.total_limit}</td>
                    <td>{QUOTA.limit}</td>
                </tr>
                <tr>
                    <td>{LANG.total_usage}</td>
                    <td>{QUOTA.usage}</td>
                </tr>
                <tr>
                    <td>{LANG.drive_usage}</td>
                    <td>{QUOTA.usageInDrive}</td>
                </tr>
                <tr>
                    <td>{LANG.trash_usage}</td>
                    <td>{QUOTA.usageInDriveTrash}</td>
                </tr>
            </tbody>
        </table>

        <div class="text-center">
            <a href="{SYNC_URL}" class="btn btn-primary">{LANG.sync_now}</a>
        </div>
        <!-- END: connected -->
    </div>
</div>
<!-- END: main -->
