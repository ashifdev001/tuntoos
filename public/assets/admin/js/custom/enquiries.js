$(function () {
    generateTable(
        "enquiries",
        "search",
        appconfig.apibaseurl + "/enquiries",
        ["id", "name", "email", "phone", "enq_for","state","city","subject", "message", "created_at"],
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
            };
        }
    );

    $(document).on("click", ".delete_enquiry", function () {
        deleteData($(this), appconfig.apibaseurl + "/enquiries/delete/");
    });
});
