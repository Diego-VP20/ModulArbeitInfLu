$(document).ready(function () {
    $('#userTable').DataTable({
        "pagingType": "simple_numbers",
        "info": false,
        "lengthChange": false,
        "pageLength": 7,
        "order": [[ 5, 'desc' ], [ 6, 'asc' ]],
        "columnDefs": [
            { "searchable": false, "targets": [0,1,4,5,6] },
            { "visible": false, "targets": [2,3] }
        ]

    })
    $('.dataTables_length').addClass('bs-select');
});