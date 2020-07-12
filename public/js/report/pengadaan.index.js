$(document).ready(function () {
    var table = $('#dt_pengadaan').DataTable();
    var tt = new $.fn.dataTable.TableTools(table);
    $('.dataTables_filter input').attr("placeholder", "Search...");

    // function sum total harga
    let startPage = table.page.info().start;
    let endPage = table.page.info().end;
    let totalHarga = 0;
    // console.log(table.page.info().start);
    for (let i = startPage; i < endPage; i++) {
        row = table.rows(i).data();
        // Karena kolom 5 menyesuaikan dengan kolom didatatable, untuk 0 adalah data dari dalam datatable
        totalHarga += convertRupiahToNumber(row[0][6]) * row[0][5];
    }
    $('#totalPage').html(table.page.info().recordsDisplay);
    $('#totalHarga').html(convertNumberToRupiah(totalHarga));

});
