$(document).ready(function () {

    const achievementId = $('#achievementId').val();
    const base          = appconfig.apibaseurl + '/achievements';

    $('#achievementForm').validate({
        errorClass: 'text-danger',
        rules: {
            title:    { required: true },
            countTxt: { required: true }
        },
        submitHandler: function (form) {
            let btnLoader = $(form).find('button[type="submit"]');
             startButtonLoader(btnLoader);
            const formData = new FormData(form);
            const url      = (achievementId > 0) ? `${base}/${achievementId}` : base;

            makeFormApiCall(
                url,
                'POST',
                formData,
                true,
                () => {
                     stopButtonLoader(btnLoader);
                    toastr.success('Achievement saved successfully!');
                    setTimeout(() => {
                        window.location.href = appconfig.siteutl + '/admin/achievements';
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

    if (achievementId > 0) {
        $.ajax({
            type: 'GET',
            headers: {
                'Content-type': 'application/json; charset=UTF-8',
                Authorization: 'Bearer ' + localStorage.getItem('authToken')
            },
            url: `${base}/${achievementId}`,
            success: function (res) {
                if (res.success) {
                    $('#achievement_title').val(res.data.title);
                    $('#achievement_countTxt').val(res.data.countTxt);
                }
            },
            error: console.error
        });
    }

   
    if ($('#achievementsTable').length > 0) {
        generateTable(
            'achievementsTable',          // table ID
            'title',                      // default sort column
            base,                         // endpoint
            ['id', 'title', 'countTxt'],
            /* action buttons */
            `<div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item achievement_edit"   href="#"><i class="fas fa-edit"></i> Edit</a>
                    <a class="dropdown-item achievement_delete" href="#"><i class="fa fa-trash"></i> Delete</a>
                </div>
            </div>`,
            (row) => row
        );
          $(document).on("submit", "#updateAchievementHeading", function (e) {
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
                        if (el.key === "achievements_heading") {
                            $("#heading").val(el.value);
                        } else if (el.key === "achievements_description") {
                            $("#description").val(el.value);
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

    $(document).on('click', '.achievement_edit', function () {
        editData($(this), appconfig.siteutl + '/admin/achievements');
    });

    $(document).on('click', '.achievement_delete', function () {
        deleteData($(this), base + '/');
    });
});
