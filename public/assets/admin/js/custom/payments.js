$(function () {
    generateTable(
        "payments",
        "search",
        appconfig.apibaseurl + "/payments",
        [
            "id",
            "first_name",
            "last_name",
            "email",
            "phone",
            "fees",
            "status",
            "created_at",
        ],
        `<div class="btn-group">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-cog" aria-hidden="true"></i>
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item delete_payment"  href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
        </div>
    </div>`,
        (data) => {
            return {
                ...data,
            };
        }
    );

    $(document).on("click", ".delete_payment", function () {
        deleteData($(this), appconfig.apibaseurl + "/payment/delete/");
    });
});
