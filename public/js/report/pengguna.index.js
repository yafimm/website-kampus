$(document).ready(function () {
    var table = $('#dt_pengguna').DataTable();
    var tt = new $.fn.dataTable.TableTools(table);
    $('.dataTables_filter input').attr("placeholder", "Search...");
});
