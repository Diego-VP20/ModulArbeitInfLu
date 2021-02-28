$(document).ready(function () {
    $('#userTable').DataTable({
        "pagingType": "simple_numbers",
        "info": false,
        "lengthChange": false,
        "pageLength": 5

    })
    $('.dataTables_length').addClass('bs-select');
});