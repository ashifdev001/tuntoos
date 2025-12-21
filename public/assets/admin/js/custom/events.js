$(function () {
    const eventId = $(`#eventId`).val();
    $("#eventCreateForm").validate({
        errorClass: "text-danger",
        rules: {
            title: {
                required: true,
            },
            event_date: {
                required: true,
                date: true,
            },
            start_time: {
                required: true,
            },
            end_time: {
                required: true,
            },
            fees: {
                required: true,
            },
        },
        submitHandler: function (form, event) {
            let btnLoader = $(this);
            event.preventDefault();
            startButtonLoader(btnLoader);
            const formData = new FormData(form);
            const url =
                eventId > 0
                    ? `${appconfig.apibaseurl}/events/${eventId}`
                    : `${appconfig.apibaseurl}/events`;
            makeFormApiCall(
                url,
                "POST",
                formData,
                true,
                (response) => {
                    stopButtonLoader(btnLoader);
                    if (response.success) {
                        toastr.success(response.message);
                        setTimeout(() => {
                            window.location.href = `${appconfig.siteutl}/events`;
                        }, 1500);
                    } else {
                        console.log(response.message);
                        if (response.data.length > 0) {
                            $.each(response.data, (k, v) => {
                                $(`.${k}_err`).html(v[0] ?? "");
                            });
                        }
                        toastr.error(response.message);
                    }
                },
                (error) => {
                    stopButtonLoader(btnLoader);
                    $.each(error.data, (k, v) => {
                        $(`.${k}_err`).html(v[0] ?? "");
                    });
                    toastr.error(error.message);
                }
            );
        },
    });

    if (eventId > 0) {
        $.ajax({
            type: "GET",
            headers: {
                "Content-type": "application/json; charset=UTF-8",
                Authorization: "Bearer " + localStorage.getItem("authToken"),
            },
            url: appconfig.apibaseurl + `/events/${eventId}`,
            success: function (response) {
                if (response.success) {
                    $("#title").val(response.data.title);
                    $("#event_date").val(response.data.event_date);
                    $("#start_time").val(response.data.start_time);
                    $("#end_time").val(response.data.end_time);
                    $("#fees").val(response.data.fees);
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    generateTable(
        "events",
        "title",
        appconfig.apibaseurl + "/events",
        [
            "id",
            "title",
            "event_date",
            "event_time",
            "fees",
            "is_time_over",
            "created_at",
        ],
        `<div class="btn-group">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-cog" aria-hidden="true"></i>
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item blog_edit"  href="#"><i class="fas fa-edit"></i> Edit</a>
            <a class="dropdown-item blog_delete"  href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
        </div>
    </div>`,
        (data) => {
            return {
                ...data,
            };
        }
    );

    $(document).on("click", ".blog_edit", function () {
        editData($(this), appconfig.siteutl + "/event");
    });

    $(document).on("click", ".blog_delete", function () {
        deleteData($(this), appconfig.apibaseurl + "/events/");
    });
});
