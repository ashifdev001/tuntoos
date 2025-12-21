let addMoreCount = 1;
function initializeSummernote(selector) {
    $(selector).summernote({
        height: 150,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture']],
            ['view', ['codeview']]
        ]
    });
}
$(document).ready(function () {
    initializeSummernote('.summernote');

    $('#addMoreBtn').click(function () {
        const index = addMoreCount++;
        const html = `
        <div class="row addMoreItem mb-3">
            <div class="col-md-12 my-4 d-flex align-items-center justify-content-between">
                <input type="text" name="items[${index}][title]" class="form-control" placeholder="Title">
                <button type="button" class="btn btn-danger removeItem">&times;</button>
            </div>
            <div class="col-md-12">
                <textarea name="items[${index}][description]" class="form-control summernote" placeholder="Description"></textarea>
            </div>

        </div>`;
        $('#addMoreWrapper').append(html);
        initializeSummernote(`textarea[name="items[${index}][description]"]`);
    });

    $(document).on('click', '.removeItem', function () {
        $(this).closest('.addMoreItem').remove();
    });
});

$(document).ready(function () {

    /* --------------------------------------------------
     *  CONFIG
     * -------------------------------------------------- */
    const serviceId = $('#serviceId').val() || 0;                 // hidden <input>
    const base = `${appconfig.apibaseurl}/services`;

    /* --------------------------------------------------
     *  FORM VALIDATION & SUBMIT
     * -------------------------------------------------- */
    $('#serviceForm').validate({
        errorClass: 'text-danger',
        rules: {
              name: {
    required: true,
    maxlength: 30
},
            slug: { required: true },
            description: { required: true },
            category_id: { required: true },
            image: { ...(serviceId ? {} : { required: true }) },
            cover_image: { ...(serviceId ? {} : { required: true }) },
        },
        submitHandler: function (form) {
            let btnLoader = $(form).find('button[type="submit"]');
             startButtonLoader(btnLoader);
            const formData = new FormData(form);
            const url = serviceId > 0 ? `${base}/${serviceId}` : base;
            $('.summernote').each(function () {
                formData.append($(this)[0].name, $(this).summernote('code'));
            });
            makeFormApiCall(
                url,
                'POST',
                formData,
                true,
                () => {
                     stopButtonLoader(btnLoader);
                    toastr.success('Service saved successfully!');
                    setTimeout(() => {
                        window.location.href = `${appconfig.siteutl}/admin/services`;
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

    if ($('#serviceForm').length > 0) {
        makeJsonApiCall(
            appconfig.apibaseurl + "/service-categories",
            "GET",
            null,
            true,
            function (res) {
                if (res && res.data.data) {
                    const data = res.data.data;
                    $.each(data, function (index, el) {
                        $('#service_category').append(
                            `<option value="${el.id}">${el.title}</option>`
                        );
                    });
                }
            },
            function (err) {
                toastr.error("Failed to load general settings.");
            },
            false
        );
    }

    /* --------------------------------------------------
     *  EDIT MODE → PREFILL FORM
     * -------------------------------------------------- */
    if (serviceId > 0) {
        $.ajax({
            type: 'GET',
            headers: {
                'Content-type': 'application/json; charset=UTF-8',
                Authorization: 'Bearer ' + localStorage.getItem('authToken')
            },
            url: `${base}/${serviceId}`,
            success: function (res) {
                if (res.success) {
                    const s = res.data;
                    $('#service_name').val(s.name);
                    $('#service_description').val(s.description);
                    $('#slug').val(s.slug);
                    $("#meta_title").val(s.meta_title);
                    $("#meta_description").val(s.meta_description)

                    if (s.items && Array.isArray(s.items)) {
                        s.items.forEach((item, index) => {
                            const titleSelector = `input[name="items[${index}][title]"]`;
                            const descSelector = `textarea[name="items[${index}][description]"]`;

                            const $titleEl = $(titleSelector);
                            const $descEl = $(descSelector);

                            if ($titleEl.length > 0 && $descEl.length > 0) {
                                $titleEl.val(item.title || '');
                                $descEl.summernote('code', item.description || '');
                            } else {
                                const html = `
                <div class="row addMoreItem mb-3">
                    <div class="col-md-12 my-4 d-flex align-items-center justify-content-between">
                        <input type="text" name="items[${index}][title]" class="form-control" placeholder="Title" value="${item.title || ''}">
                        <button type="button" class="btn btn-danger removeItem">&times;</button>
                    </div>
                    <div class="col-md-12">
                        <textarea name="items[${index}][description]" class="form-control summernote" placeholder="Description">${item.description || ''}</textarea>
                    </div>
                </div>`;
                                $('#addMoreWrapper').append(html);
                                initializeSummernote(`textarea[name="items[${index}][description]"]`);
                            }

                            addMoreCount = index + 1;
                        });
                    }

                    $('#service_category').val(s.category_id).change();
                    if (s.image_url) {
                        $('#preview-img').attr('src', s.image_url).show();
                    }
                    if (s.cover_image_url) {
                        $('#preview-cover-img').attr('src', s.cover_image_url).show();
                    }
                }
            },
            error: console.error
        });
    }

    /* --------------------------------------------------
     *  IMAGE PREVIEW
     * -------------------------------------------------- */
    $('#service_image').on('change', function () {
        const file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = e => $('#preview-img').attr('src', e.target.result).show();
            reader.readAsDataURL(file);
        }
    });

    $('#cover_image').on('change', function () {
        const file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = e => $('#preview-cover-img').attr('src', e.target.result).show();
            reader.readAsDataURL(file);
        }
    });

    /* --------------------------------------------------
     *  SERVICES LIST (DataTable)
     * -------------------------------------------------- */
    if ($('#servicesTable').length > 0) {
        generateTable(
            'servicesTable',
            'name',
            base,
            ['id', 'name', 'slug', 'category', 'description', 'image'],
            /* action menu */
            `<div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item service_edit"   href="#"><i class="fas fa-edit"></i> Edit</a>
                    <a class="dropdown-item service_delete" href="#"><i class="fa fa-trash"></i> Delete</a>
                </div>
            </div>`,
            /* row transformer */
            (s) => ({
                ...s,
                category: s.category?.title || '',
                image: s.image_url
                    ? `<img src="${s.image_url}" style="width:80px;height:80px;object-fit:cover;" class="img-thumbnail">`
                    : ''
            })
        );

         $(document).on("submit", "#updateServiceMeta", function (e) {
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
                        if (el.key === "service_heading") {
                            $("#heading").val(el.value);
                        } else if (el.key === "service_description") {
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

    /* --------------------------------------------------
     *  ACTION HANDLERS
     * -------------------------------------------------- */
    $(document).on('click', '.service_edit', function () {
        editData($(this), `${appconfig.siteutl}/admin/services`);
    });

    $(document).on('click', '.service_delete', function () {
        deleteData($(this), `${base}/`);
    });
});
