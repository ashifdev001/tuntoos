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
    const cobwebId = $('#cobwebId').val() || 0;                 // hidden <input>
    const base = `${appconfig.apibaseurl}/services`;

    /* --------------------------------------------------
     *  FORM VALIDATION & SUBMIT
     * -------------------------------------------------- */
    $('#cobwebForm').validate({
        errorClass: 'text-danger',
        rules: {
           name: {
    required: true,
    maxlength: 30
},
            slug: { required: true },
            description: { required: true },
            category_id: { required: true },
            image: { ...(cobwebId ? {} : { required: true }) },
            cover_image: { ...(cobwebId ? {} : { required: true }) },
        },
        submitHandler: function (form) {
            let btnLoader = $(form).find('button[type="submit"]');
             startButtonLoader(btnLoader);
            const formData = new FormData(form);
            const url = cobwebId > 0 ? `${base}/${cobwebId}` : base;
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
                    toastr.success('cobweb saved successfully!');
                    setTimeout(() => {
                        window.location.href = `${appconfig.siteutl}/admin/cobweb`;
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

    /* --------------------------------------------------
     *  EDIT MODE → PREFILL FORM
     * -------------------------------------------------- */
    if (cobwebId > 0) {
        $.ajax({
            type: 'GET',
            headers: {
                'Content-type': 'application/json; charset=UTF-8',
                Authorization: 'Bearer ' + localStorage.getItem('authToken')
            },
            url: `${base}/${cobwebId}`,
            success: function (res) {
                if (res.success) {
                    const s = res.data;
                    $('#cobweb_name').val(s.name);
                    $('#cobweb_description').val(s.description);
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

                    $('#cobweb_category').val(s.category_id).change();
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
    $('#cobweb_image').on('change', function () {
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
     *  cobweb LIST (DataTable)
     * -------------------------------------------------- */
    if ($('#cobwebTable').length > 0) {
        generateTable(
            'cobwebTable',
            'name',
            base + '?type=cobweb',
            ['id', 'name', 'slug', 'description', 'image'],
            /* action menu */
            `<div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item cobweb_edit"   href="#"><i class="fas fa-edit"></i> Edit</a>
                    <a class="dropdown-item cobweb_delete" href="#"><i class="fa fa-trash"></i> Delete</a>
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
    }

    /* --------------------------------------------------
     *  ACTION HANDLERS
     * -------------------------------------------------- */
    $(document).on('click', '.cobweb_edit', function () {
        editData($(this), `${appconfig.siteutl}/admin/cobweb`);
    });

    $(document).on('click', '.cobweb_delete', function () {
        deleteData($(this), `${base}/`);
    });
});
