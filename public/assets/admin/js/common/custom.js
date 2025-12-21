/* let blockUI = new KTBlockUI(document.querySelector("#kt_body"), {
    message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Loading...</div>',
    overlayClass: "bg-light bg-gradient bg-opacity-25",
}); */



function getQueryStringParams() {
    var search = location.search.substring(1);
    return JSON.parse('{"' + decodeURI(search).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}');
}

function setMenuActive() {
    $('.menu-item').each(function(){
        $(this).removeClass('sidebar-item');
    });
    $('.sidebar-link').each(function(){
        $(this).removeClass('active');
        if($(this).attr('href') == window.location.href) {
            $(this).addClass('active');
            $(this).closest('sidebar-item').addClass('selected');
        }
    });
}

function getUrlSegment(segmentnum) {
    urlWithoutQueryArr = window.location.href.split("?");
    urlHrefSegmentArr = urlWithoutQueryArr[0].split("://");
    urlSegmentArr = urlHrefSegmentArr[1].split("/");
    return urlSegmentArr[segmentnum];
}

function setPageHeading(heading, subheading) {
    $('#page-heading').html(heading);
    $('#page-subheading').html(subheading);
}

function removeFormErrors() {
    $('.form-err').remove();
}

function showFormErrors(form, errors) {
    removeFormErrors();
    $.each( errors, function( key, value ) {
        form.find('input[name="'+key+'"]').after(`<span class="form-err text-danger">${value[0]}</span>`);
    });
}

function checkJson(text) {
    try {
        let jsonData = JSON.parse(text);
        if(typeof(jsonData) == "object") {
            return true;
        }
        return false;
    } catch (e) {
        return false;
    }
}

function makeJsonApiCall(url, type, data, async, successCb, errorCb, returnRes) {
    

    let response = {
        status: false,
        responseJSON: {}
    };

    $.ajax({
        url: url,
        headers: {
            "Content-type": "application/json; charset=UTF-8",
            "Authorization": "Bearer " + localStorage.getItem('authToken'),
            "accept": "application/json"
        },
        data: data,
        type: type,
        async: async,
        success: (res) => {
            successCb(res);
            response = {
                ...response,
                status: true,
                responseJSON: res
            }
        },
        error: (err) => {
            if(err.status == 401) {
                logout();
            }
            errorCb(err.responseJSON);
            response = {
                ...response,
                responseJSON: err.responseJSON
            }
        }
    });

    if(returnRes) {
        return response;
    }
}

function makeFormApiCall(url, type, data, async, successCb, errorCb, returnRes) {

    let response = {
        status: false,
        responseJSON: {}
    };

    $.ajax({
        url: url,
        headers: {
            "Authorization": "Bearer " + localStorage.getItem('authToken'),
            "accept": "application/json"
        },
        contentType: false,
        processData: false,
        data: data,
        type: type,
        async: async,
        success: (res) => {
            successCb(res);
            response = {
                ...response,
                status: true,
                responseJSON: res
            }
        },
        error: (err) => {
            if(err.status == 401) {
                logout();
            }
            errorCb(err.responseJSON);
            response = {
                ...response,
                responseJSON: err.responseJSON
            }
        }
    });

    if(returnRes) {
        return response;
    }
}

function subPage(el,url){
    let id = el.closest('.datatablerow-id').attr('data-id');
    window.location.href = url+'/'+id;
}

 function CreateSubPage(id,url){
    window.location.href = url+'/'+id;
 }

 function startButtonLoader(btn) {
    btn.buttonLoader('start');
    btn.prop('disabled', true);
 }

 function stopButtonLoader(btn) {
    if(btn != null) {
        btn.prop('disabled', false);
        btn.buttonLoader('stop');
    }
 }