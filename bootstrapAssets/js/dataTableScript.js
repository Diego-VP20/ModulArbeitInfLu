$(document).ready(function () {
    $('#userTable').DataTable({
        "pagingType": "simple_numbers",
        "info": false,
        "lengthChange": false


    })
    $('.dataTables_length').addClass('bs-select');
});