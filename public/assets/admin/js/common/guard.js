function ifAuthanticate() {
    let authToken = localStorage.getItem('authToken');
    if (authToken != null) {
        location.href = appconfig.siteutl + '/admin/dashboard';
    }
}


function ifNotAuthanticate() {
    let authToken = localStorage.getItem('authToken');
    if (authToken == null) {
        localStorage.removeItem("authToken");
        location.href = appconfig.siteutl + '/admin/login';
    }
}