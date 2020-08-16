$(document).ready(function () {
    var table = $('#dt_pengadaan').DataTable();
    var tt = new $.fn.dataTable.TableTools(table);
    $('.dataTables_filter input').attr("placeholder", "Search...");

    dataTableTotal();

    table.on('search.dt', function () {
          dataTableTotal();
    });

    $('#dt_pengadaan_paginate').click(function () {
      $('.tag').tooltip();
      dataTableTotal();
    });

    $('#dt_pengadaan_length').on('change', function () {
      $('.tag').tooltip();
      dataTableTotal();
    });

    // function sum total harga
    function dataTableTotal(){
      console.log(table.page.info());
      let startPage = table.page.info().start;
      let endPage = table.page.info().end;
      let totalHarga = 0;
      let totalData = parseInt(table.page.info().end - table.page.info().start);
      // console.log(table.page.info().start);
      for (let i = startPage; i < endPage; i++) {
          row = table.rows(i).data();
          // Karena kolom 5 menyesuaikan dengan kolom didatatable, untuk 0 adalah data dari dalam datatable
          totalHarga += convertRupiahToNumber(row[0][6]) * row[0][5];
      }

      $('#totalPage').html(totalData);
      $('#totalHarga').html(convertNumberToRupiah(totalHarga));

    }
});
