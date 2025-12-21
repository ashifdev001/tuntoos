$(document).ready(function () {
    const scriptId = $('#scriptId').val();
    const base = appconfig.apibaseurl + '/tracking-scripts';

    $('#trackingScriptForm').validate({
        errorClass: 'text-danger',
        rules: {
            page: { required: true },
            script: { required: true }
        },
        submitHandler: function (form) {
            let btnLoader = $(form).find('button[type="submit"]');
             startButtonLoader(btnLoader);
            const formData = new FormData(form);
            const url = (scriptId > 0) ? `${base}/${scriptId}` : base;

            makeFormApiCall(
                url,
                'POST',
                formData,
                true,
                () => {
                     stopButtonLoader(btnLoader);
                    toastr.success('Record saved successfully!');
                    setTimeout(() => {
                        window.location.href = appconfig.siteutl + '/admin/tracking-scripts';
                    }, 1000);
                },
                (err) => {
                     stopButtonLoader(btnLoader);
                    toastr.error('Error: ' + (err.message || 'Something went wrong.'));
                },
                false
            );
        }
    });

    if (scriptId > 0) {
        $.ajax({
            type: 'GET',
            headers: {
                'Content-type': 'application/json; charset=UTF-8',
                Authorization: 'Bearer ' + localStorage.getItem('authToken')
            },
            url: `${base}/${scriptId}`,
            success: function (res) {
                if (res.success) {
                    $('#page').val(res.data.page).change();
                    $('#script').val(res.data.script);
                }
            },
            error: console.error
        });
    }

    if ($('#scTab').length > 0) {
        generateTable(
            'scTab',                // table ID
            'page',                      // default sort
            base,                         // endpoint
            ['id', 'page', 'script'],
            `<div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item edit_tracking_scripts"   href="#"><i class="fas fa-edit"></i> Edit</a>
                    <a class="dropdown-item delete_tracking_scripts" href="#"><i class="fa fa-trash"></i> Delete</a>
                </div>
            </div>`,
            (row) => ({
                ...row,
                script: `<textarea  class="form-control" readonly rows="2">${row.script}</textarea>`
            })
        );
    }

    $(document).on('click', '.edit_tracking_scripts', function () {
        editData($(this), appconfig.siteutl + '/admin/tracking-scripts');
    });

    $(document).on('click', '.delete_tracking_scripts', function () {
        deleteData($(this), base + '/');
    });
});
