$(document).ready(function () {
    /* --------------------------------------------------
     *  SETUP & VALIDATION
     * -------------------------------------------------- */
    const jobId = $('#jobId').val();   // hidden input in your Blade form

    $("#jobForm").validate({
        errorClass: "text-danger",
        rules: {
            title:       { required: true },
            description:    { required: true },
        },
        submitHandler: function (form) {
            let btnLoader = $(form).find('button[type="submit"]');
             startButtonLoader(btnLoader);
            const formData = new FormData(form);

            const url = jobId > 0
                ? `${appconfig.apibaseurl}/jobs/${jobId}`
                : `${appconfig.apibaseurl}/jobs`;

            makeFormApiCall(
                url,
                'POST',            // or PUT on the server when _method=PUT
                formData,
                true,              // show loader
                function (res) {
                     stopButtonLoader(btnLoader);
                    toastr.success('Job saved successfully!');
                    setTimeout(() => {
                        window.location.href = appconfig.siteutl + "/admin/jobs";
                    }, 1000);
                },
                function (err) {
                     stopButtonLoader(btnLoader);
                    toastr.error('Error: ' + (err.message || 'Something went wrong.'));
                },
                false               // don’t stringify FormData
            );
        }
    });

    /* --------------------------------------------------
     *  EDIT MODE → PREFILL FORM
     * -------------------------------------------------- */
    if (jobId > 0) {
        $.ajax({
            type: "GET",
            headers: {
                "Content-type": "application/json; charset=UTF-8",
                Authorization: "Bearer " + localStorage.getItem("authToken"),
            },
            url: `${appconfig.apibaseurl}/jobs/${jobId}`,
            success: function (response) {
                if (response.success) {
                    const b = response.data;
                    $("#title").val(b.title);
                    $("#description").val(b.description);
                    
                }
            },
            error: function (error) {
                console.error(error);
            },
        });
    }

    /* --------------------------------------------------
     *  BRANCH LIST (DataTable)
     * -------------------------------------------------- */
    if ($("#jobsTable").length > 0) {
        generateTable(
            "jobsTable",                    // table id
            "title",                        // default sort column
            `${appconfig.apibaseurl}/jobs`,
            ["id", "title", "description","created_at"],
            /* action buttons */
            `<div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item job_edit"    href="#"><i class="fas fa-edit"></i> Edit</a>
                    <a class="dropdown-item job_delete"  href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                </div>
            </div>`,
            /* row transformer */
            (b) => ({
                ...b
            })
        );
    }

    /* --------------------------------------------------
     *  ACTION HANDLERS
     * -------------------------------------------------- */
    $(document).on("click", ".job_edit", function () {
        editData($(this), appconfig.siteutl + "/admin/jobs");
    });

    $(document).on("click", ".job_delete", function () {
        deleteData($(this), appconfig.apibaseurl + "/jobs/");
    });
});
