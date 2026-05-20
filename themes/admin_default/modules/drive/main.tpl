<!-- BEGIN: main -->
<div class="panel panel-default">
    <div class="panel-body">
        <!-- BEGIN: disconnected -->
        <div class="alert alert-danger">
            <strong>Not Connected!</strong><br />
            {ERROR_MESSAGE}<br />
            Please go to <a href="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&{NV_NAME_VARIABLE}={MODULE_NAME}&{NV_OP_VARIABLE}=config">Configuration</a> to set up the API.
        </div>
        <!-- END: disconnected -->

        <!-- BEGIN: connected -->
        <div class="alert alert-success">
            <strong>Connected to Google Drive!</strong>
        </div>
        <table class="table table-striped table-bordered">
            <tbody>
                <tr>
                    <td>Total Limit</td>
                    <td>{QUOTA.limit}</td>
                </tr>
                <tr>
                    <td>Total Usage</td>
                    <td>{QUOTA.usage}</td>
                </tr>
                <tr>
                    <td>Drive Usage</td>
                    <td>{QUOTA.usageInDrive}</td>
                </tr>
                <tr>
                    <td>Trash Usage</td>
                    <td>{QUOTA.usageInDriveTrash}</td>
                </tr>
            </tbody>
        </table>

        <div class="text-center">
            <a href="{SYNC_URL}" class="btn btn-primary">Sync Now</a>
        </div>
        <!-- END: connected -->
    </div>
</div>
<!-- END: main -->
