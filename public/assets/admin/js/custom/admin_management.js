// $('#admin_management thead tr').clone(true).addClass('filters').appendTo( '#admin_management thead' );
//     var table = $('#admin_management').DataTable( {
//         orderCellsTop: true,
//         fixedHeader: true,
//         initComplete: function() {
//             var api = this.api();
//             api.columns().eq(0).each(function(colIdx) {
//                 var cell = $('.filters th').eq($(api.column(colIdx).header()).index());
//                 var title = $(cell).text();
//                 $(cell).html( '<input type="text" class="form-control" placeholder="'+title+'" />' );
//                 $('input', $('.filters th').eq($(api.column(colIdx).header()).index()) )
//                     .off('keyup change')
//                     .on('keyup change', function (e) {
//                         e.stopPropagation();
//                         $(this).attr('title', $(this).val());
//                         var regexr = '({search})';
//                         var cursorPosition = this.selectionStart;
//                         api.column(colIdx)
//                             .search((this.value != "") ? regexr.replace('{search}', '((('+this.value+')))') : "", this.value != "", this.value == "")
//                             .draw();
//                         $(this).focus()[0].setSelectionRange(cursorPosition, cursorPosition);
//                     });
//             });
//         }
// } );

generateTable(
    'admin_management',
    'user_id', appconfig.apibaseurl + '/user-list',
    [
        'id',
        'image',
        'name',
        'email',
        'phone',
        'created_at',
        'action'
    ],
    'edit');

// Edit User

// Delete User
