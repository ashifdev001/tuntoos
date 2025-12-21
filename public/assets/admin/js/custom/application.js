$(function () {
    generateTable(
        "jobAppTable",
        "search",
        appconfig.apibaseurl + "/job-applications",
        ["id", "job","name",  "email","phone","gender",  'resume', "message", "created_at"],
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
                name: data?.firstName + ' ' + data?.lastName,
                resume: data?.resume_url ? `<a href="${data?.resume_url}" target="_blank">View Resume</a>` : 'N/A',
                job: data?.job?.title
            };
        }
    );

    $(document).on("click", ".delete_enquiry", function () {
        deleteData($(this), appconfig.apibaseurl + "/job-applications/");
    });
});
