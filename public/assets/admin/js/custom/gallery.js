$(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const gId = $('#gId').val();
    const type = $('#type').val();

    const base = appconfig.apibaseurl + '/galleries?type=' + type;

    $('#images').on('change', function () {
        $('.preview').html('');
        if (this.files && this.files.length > 0) {
            for (let i = 0; i < this.files.length; i++) {
                const file = this.files[i];
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = $('<img>').attr('src', e.target.result)
                            .addClass('img-thumbnail mr-2 mb-2')
                            .css({ 'max-width': '100px', 'max-height': '100px' });
                        $('.preview').append(img);
                    };
                    reader.readAsDataURL(file);
                } else {
                    console.warn('File is not an image:', file.name);
                }
            }
        }
    });

    // Form validation and submission
    $('#galleryForm').validate({
        errorClass: 'text-danger',
        rules: {
            title: { required: true },
            'images[]': { ...(gId > 0 ? { required: false } : { required: true }) }
        },
        messages: {
            title: { required: 'Please enter a title.' },
            'images[]': { required: 'Please select at least one image.' }
        },
        submitHandler: function (form) {
            let btnLoader = $(form).find('button[type="submit"]');
            startButtonLoader(btnLoader);
            const formData = new FormData(form);
            const url = (gId > 0) ? `${appconfig.apibaseurl}/galleries/${gId}` : base;
            makeFormApiCall(
                url,
                'POST',
                formData,
                true,
                () => {
                    stopButtonLoader(btnLoader);
                    toastr.success('Gallery saved successfully!');
                    setTimeout(() => {
                        window.location.href = appconfig.siteutl + `/admin/${type == "gallery" ? "galleries" : "videos"}`;
                    }, 1000);
                },
                (err) => {
                    stopButtonLoader(btnLoader);
                    toastr.error('Error: ' + (err.responseJSON ? err.responseJSON.message : err.message || 'Something went wrong.'));
                    console.error('API Error:', err);
                },
                false
            );
        }
    });

    if (gId > 0) {
        $.ajax({
            type: 'GET',
            headers: {
                'Content-type': 'application/json; charset=UTF-8',
                Authorization: 'Bearer ' + localStorage.getItem('authToken')
            },
            url: `${appconfig.apibaseurl}/galleries/${gId}`,
            success: function (res) {
                if (res.success) {
                    $('#title').val(res.data.title);
                    $('#description').val(res.data.description);
                    $('.preview').html(`<img src="${res.data.image_url}" class="img-thumbnail img-size w-50" style="max-height:100px;max-width:100px" />`);
                }
            },
            error: console.error
        });
    }

    if ($('#galleryTab').length > 0) { // Changed ID from scTab to galleryTab
        generateTable(
            'galleryTab',
            'title',
            base,
            ['idx', 'title','description' ,'image'],
            `<div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
               
                <div class="dropdown-menu">
                <a class="dropdown-item edit_gallery"   href="#"><i class="fas fa-edit"></i> Edit</a>
                    <a class="dropdown-item delete_gallery" href="#"><i class="fa fa-trash"></i> Delete</a>
                </div>
            </div>`,
            (row, indx) => {
                return ({
                    ...row,
                    idx: indx + 1,
                    description: row?.description,
                    image: `<img src="${row?.image_url}" class="img-thumbnail img-size w-50" style="max-height:100px;max-width:100px" />`,
                })
            }
        );
    }

    $(document).on('click', '.delete_gallery', function () {
        deleteData($(this), appconfig.apibaseurl + '/galleries/');
    });

    $(document).on('click', '.edit_gallery', function () {
        editData($(this), appconfig.siteutl + `/admin/${type == "gallery" ? "galleries" : "videos"}`);
    });
});