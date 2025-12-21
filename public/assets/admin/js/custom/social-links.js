$(document).ready(function () {
    const socialLinkId = $('#socialLinkId').val();
    const baseUrl = `${appconfig.apibaseurl}/social-links`;

    // Form validation
    $("#socialLinkForm").validate({
        errorClass: "text-danger",
        rules: {
            branch_id: { required: true },
            name: { required: true, maxlength: 191 },
            link: { required: true, url: true },
            icon: { maxlength: 191 } // Just a plain string, not HTML class
        },
        submitHandler: function (form) {
            const formData = new FormData(form);

            const url = socialLinkId > 0
                ? `${baseUrl}/${socialLinkId}`
                : baseUrl;

            makeFormApiCall(
                url,
                'POST',
                formData,
                true,
                () => {
                    toastr.success('Social link saved successfully!');
                    setTimeout(() => {
                        window.location.href = `${appconfig.siteutl}/admin/social-links`;
                    }, 1000);
                },
                (err) => {
                    toastr.error('Error: ' + (err.message || 'Something went wrong.'));
                },
                false
            );
        }
    });

    if ($("#socialLinkForm").length) {
        $.ajax({
            type: "GET",
            headers: {
                "Content-type": "application/json; charset=UTF-8",
                Authorization: "Bearer " + localStorage.getItem("authToken"),
            },
            url: `${appconfig.apibaseurl}/branches`,
            success: function (res) {
                if (res.success && res.data.data.length > 0) {
                    const branches = res.data.data;
                    branchHtml='<option value="">-- Select Branch --</option>';
                    branches.forEach(branch => {
                        branchHtml += (
                            `<option value="${branch.id}">${branch.name}</option>`
                        );
                    });
                    $("#branch_id").html(branchHtml);
                }
            },
            error: console.error
        });
    }

    // Prefill on edit
    if (socialLinkId > 0) {
        $.ajax({
            type: "GET",
            headers: {
                "Content-type": "application/json; charset=UTF-8",
                Authorization: "Bearer " + localStorage.getItem("authToken"),
            },
            url: `${baseUrl}/${socialLinkId}`,
            success: function (res) {
                if (res.success) {
                    const s = res.data;
                    $("#branch_id").val(s.branch_id);
                    $("#social_name").val(s.name);
                    $("#social_icon").val(s.icon); // just a string
                    $("#social_link").val(s.link);
                }
            },
            error: console.error
        });
    }

    // Table list
    if ($("#socialLinksTable").length > 0) {
        generateTable(
            "socialLinksTable",
            "name",
            baseUrl,
            ["id", "branchName", "name", "icon", "link"],
            `<div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item social_edit"   href="#"><i class="fas fa-edit"></i> Edit</a>
                    <a class="dropdown-item social_delete" href="#"><i class="fa fa-trash"></i> Delete</a>
                </div>
            </div>`,
            (row) => ({
                ...row,
                branchName: row.branch ? row.branch.name : 'N/A',
                icon: row.icon || '-', // display plain text
                link: row.link
                    ? `<a href="${row.link}" target="_blank">${row.link}</a>`
                    : '-'
            })
        );
    }

    // Edit handler
    $(document).on("click", ".social_edit", function () {
        editData($(this), `${appconfig.siteutl}/admin/social-links`);
    });

    // Delete handler
    $(document).on("click", ".social_delete", function () {
        deleteData($(this), `${baseUrl}/`);
    });
});
