$(document).ready(function () {

    /* -------------------------------------------------------------
     * 1.  SET‑UP
     * ----------------------------------------------------------- */
    const sgId = $('#satisfactionId').val();      // hidden <input> in the form
    const base = appconfig.apibaseurl + '/satisfaction-guaranteed';
    const table = '#satisfactionGuaranteed';                // <table id="satisfactionGuaranteed">
    $('#icon').on('change', function () {
        const file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = e => $('#preview-img').attr('src', e.target.result).show();
            reader.readAsDataURL(file);
        }
    });

    /* -------------------------------------------------------------
     * 2.  FORM VALIDATION + SUBMIT
     * ----------------------------------------------------------- */
    $('#satisfactionForm').validate({
        errorClass: 'text-danger',
        rules: {
            title: { required: true },
            description: { required: true },
            icon: { required: true },

        },
        submitHandler: function (form) {
            let btnLoader = $(form).find('button[type="submit"]');
            startButtonLoader(btnLoader);
            const formData = new FormData(form);
            const url = sgId > 0 ? `${base}/${sgId}` : base;

            makeFormApiCall(
                url,
                'POST',
                formData,
                true,
                function () {
                    stopButtonLoader(btnLoader);
                    toastr.success('Item saved successfully!');
                    setTimeout(() => window.location.href = appconfig.siteutl + '/admin/satisfaction-guaranteed', 1000);
                },
                function (err) {
                    stopButtonLoader(btnLoader);
                    toastr.error('Error: ' + (err.message || 'Something went wrong.'));
                },
                false
            );
        }
    });

    /* -------------------------------------------------------------
     * 3.  LOAD EXISTING RECORD FOR EDIT
     * ----------------------------------------------------------- */
    if (sgId > 0) {
        $.ajax({
            type: 'GET',
            headers: {
                'Content-type': 'application/json; charset=UTF-8',
                Authorization: 'Bearer ' + localStorage.getItem('authToken')
            },
            url: `${base}/${sgId}`,
            success: function (res) {
                if (res.success) {
                    $('#satisfaction_title').val(res.data.title);
                    $('#satisfaction_description').val(res.data.description);
                    if (res.data.icon) {
                        $('#preview-img').attr('src', res.data.icon).show();
                    }
                    $('#satisfaction_link').val(res.data.link);
                }
            },
            error: console.error
        });
    }

    /* -------------------------------------------------------------
     * 4.  TABLE GENERATION
     * ----------------------------------------------------------- */
    if ($(table).length > 0) {
        generateTable(
            'satisfactionGuaranteed',
            'title',                       // default sort column
            base,
            ['id', 'title', 'description', 'icon', 'link'],
            `<div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item sg_edit"   href="#"><i class="fas fa-edit"></i> Edit</a>
                    <a class="dropdown-item sg_delete" href="#"><i class="fa fa-trash"></i> Delete</a>
                </div>
            </div>`,
            (row) => ({
                ...row,
                icon: `<img src="${row.icon_url}" style="width:80px;height:80px;object-fit:cover;" class="img-thumbnail"/>`,
                link: row.link ? `<a href="${row.link}" target="_blank">${row.link}</a>` : ""
            })
        );

        $(document).on("submit", "#updateHeading", function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const url = `${appconfig.apibaseurl}/settings/save`;
            if (!$("#heading").val().trim()) {
                toastr.error('Heading is required.');
                return false;
            }
            if (!$("#description").val().trim()) {
                toastr.error('description is required.');
                return false;
            }
            makeFormApiCall(
                url,
                'POST',
                formData,
                true,
                function (res) {
                    toastr.success('Heading updated successfully!');
                },
                function (err) {
                    toastr.error('Error: ' + (err.message || 'Something went wrong.'));
                },
                false
            );
        });

        makeJsonApiCall(
            appconfig.apibaseurl + "/settings/general",
            "GET",
            null,
            true,
            function (res) {
                if (res && res.data) {
                    const data = res.data;
                    $.each(data, function (index, el) {
                        if (el.key === "testimonials_heading") {
                            $("#heading").val(el.value);
                        } else if (el.key === "testimonials_description") {
                            $("#description").val(el.value);
                        }else if (el.key === "testimonials_video_link") {
                            $("#testimonials_video_link").val(el.value);
                        }
                    });
                }
            },
            function (err) {
                toastr.error("Failed to load general settings.");
            },
            false
        );
    }

    /* -------------------------------------------------------------
     * 5.  ACTION HANDLERS
     * ----------------------------------------------------------- */
    $(document).on('click', '.sg_edit', function () {
        editData($(this), appconfig.siteutl + '/admin/satisfaction-guaranteed');
    });

    $(document).on('click', '.sg_delete', function () {
        deleteData($(this), base + '/');
    });
});
