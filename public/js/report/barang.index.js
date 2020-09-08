$(window).load(function () {

    dataChartBarang = dataBarang.sort(function(a,b) {
                      return b.stok - a.stok;
                    });
    loadPieChart();
    $('#sortChart').on('change', function(){

      $("canvas#pieChart").remove();
      $("div#chartDiv").append('<canvas id="pieChart" width="200px" height="150px"></canvas>');

        if($(this).val() == 'tertinggi'){
            dataChartBarang = dataBarang.sort(function(a,b) {
                            return b.stok - a.stok;
                          });

        }else{
            dataChartBarang = dataBarang.sort(function(a,b) {
                                return a.stok - b.stok;
                            });
        }

        loadPieChart();
    });

    var table = $('#dt_barang').DataTable();
    var tt = new $.fn.dataTable.TableTools(table);
    $('.dataTables_filter input').attr("placeholder", "Search...");

    dataTableTotal();

    table.on('search.dt', function () {
          dataTableTotal();
    });

    $('#dt_barang_paginate').click(function () {
      $('.tag').tooltip();
      dataTableTotal();
    });

    $('#dt_barang_length').on('change', function () {
      $('.tag').tooltip();
      dataTableTotal();
    });



    function getColors(length){
      let pallet = ["#0074D9", "#FF4136", "#2ECC40", "#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"];
      let colors = [];

      for(let i = 0; i < length; i++) {
        colors.push(pallet[i % pallet.length]);
      }

      return colors;
    }

    // function sum total harga
    function dataTableTotal()
    {
        let startPage = table.page.info().start;
        let endPage = table.page.info().end;
        let totalHarga = 0;
        let totalData = parseInt(table.page.info().end - table.page.info().start);

        for (let i = startPage; i < endPage; i++) {
            row = table.rows(i).data();
            // Karena kolom 5 menyesuaikan dengan kolom didatatable, untuk 0 adalah data dari dalam datatable
            totalHarga += convertRupiahToNumber(row[0][4]) * row[0][3];
        }

        $('#totalPage').html(totalData);
        $('#totalHarga').html(convertNumberToRupiah(totalHarga));
    }


    function loadPieChart()
    {
        dataChartBarang = dataChartBarang.slice(0,5); //Ambil 5 data terakhir
        let stok = dataChartBarang.map(a => a.stok);
        let barang = dataChartBarang.map(a => a.b_nama);
        data = {
          datasets: [{
              data: stok,
              backgroundColor: getColors(stok.length)
          }],



          // These labels appear in the legend and in the tooltips when hovering different arcs
          labels: barang
        };
        var options = {
              tooltips: {
                 callbacks: {
                   label: function(tooltipItem, data) {
                     var dataset = data.datasets[tooltipItem.datasetIndex];
                     var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                     var total = meta.total;
                     var currentValue = dataset.data[tooltipItem.index];
                     var percentage = parseFloat((currentValue/total*100).toFixed(1));
                     return currentValue + ' (' + percentage + '%)';
                   },
                   title: function(tooltipItem, data) {
                     return data.labels[tooltipItem[0].index];
                   }
                 }
               },
         };


        var pieChartId = document.getElementById('pieChart').getContext('2d');
        var myPieChart = new Chart(pieChartId, {
            type: 'pie',
            data: data,
            options: options
        });
    }

});
