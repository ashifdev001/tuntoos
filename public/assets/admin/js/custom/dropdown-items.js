$(function () {
    $("#aboutUsForm").validate({
        errorClass: "text-danger",
        rules: {
            title: { required: true },
        },
        submitHandler: function (form) {
            let btnLoader = $(form).find('button[type="submit"]');
            startButtonLoader(btnLoader);
            const formData = new FormData(form);
            const url = appconfig.apibaseurl + "/dropdown-items";
            makeFormApiCall(
                url,
                'POST',
                formData,
                true,
                function (res) {
                    stopButtonLoader(btnLoader);
                    $('form')[0].reset();
                    toastr.success(res.message || 'Dropdown Items saved successfully!');
                    if (typeof datatables !== 'undefined' && datatables['dropdownItemsTbl']) {
                        datatables['dropdownItemsTbl'].clear().draw();
                    }
                },
                function (err) {
                    stopButtonLoader(btnLoader);
                    toastr.error('Error: ' + (err.message || 'Something went wrong.'));
                },
                false
            );
        }
    });

    generateTable(
        "dropdownItemsTbl",
        "search",
        appconfig.apibaseurl + "/dropdown-items",
        ["id", "title", "created_at"],
        `<div class="btn-group">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-cog" aria-hidden="true"></i>
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item delete_dropdown"  href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
        </div>
    </div>`,
        (data) => {
            return {
                ...data,
            };
        }
    );

    $(document).on("click", ".delete_dropdown", function () {
        deleteData($(this), appconfig.apibaseurl + "/dropdown-items/");
    });
});