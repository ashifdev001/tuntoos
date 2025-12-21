$(function () {
    generateTable(
        "appointments",
        "search",
        appconfig.apibaseurl + "/appointments",
        ["id", "name", "type", "service", "phone", "message", "created_at"],
        `<div class="btn-group">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-cog" aria-hidden="true"></i>
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item delete_enquiry"  href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
        </div>
    </div>`,
        (data) => {
            return {
                ...data,
                service: data?.service_cat?.title
            };
        }
    );

    $(document).on("click", ".delete_enquiry", function () {
        deleteData($(this), appconfig.apibaseurl + "/appointments/");
    });
});
