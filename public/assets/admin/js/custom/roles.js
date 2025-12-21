generateTable(
    'user_roles',
    'user_id', appconfig.apibaseurl + '/get-user-roles',
    [
        'id',
        'name',
        'action'
    ],
    'edit');