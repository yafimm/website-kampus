$(document).ready(function () {
    dataChartInventaris = dataInventaris.sort(function(a,b) {
                      return b.total - a.total;
                    });
    loadPieChart();
    $('#sortChart').on('change', function(){

      $("canvas#pieChart").remove();
      $("div#chartDiv").append('<canvas id="pieChart" width="200px" height="150px"></canvas>');

        if($(this).val() == 'tertinggi'){
            dataChartInventaris = dataInventaris.sort(function(a,b) {
                            return b.total - a.total;
                          });

        }else{
            dataChartInventaris = dataInventaris.sort(function(a,b) {
                                return a.total - b.total;
                            });
        }

        loadPieChart();
    });

    var table = $('#dt_inventaris').DataTable();
    var tt = new $.fn.dataTable.TableTools(table);
    $('.dataTables_filter input').attr("placeholder", "Search...");

    dataTableTotal();

    table.on('search.dt', function () {
          dataTableTotal();
    });

    $('#dt_inventaris_paginate').click(function () {
      $('.tag').tooltip();
      dataTableTotal();
    });

    $('#dt_inventaris_length').on('change', function () {
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
    function dataTableTotal(){
      let startPage = table.page.info().start;
      let endPage = table.page.info().end;
      let totalHarga = 0;
      let totalData = parseInt(table.page.info().end - table.page.info().start);
      // console.log(table.page.info().start);
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
        dataChartInventaris = dataChartInventaris.slice(0,5); //Ambil 5 data terakhir
        let total = dataChartInventaris.map(a => a.total);
        let inventaris = dataChartInventaris.map(a => a.i_nama);
        data = {
          datasets: [{
              data: total,
              backgroundColor: getColors(total.length)
          }],



          // These labels appear in the legend and in the tooltips when hovering different arcs
          labels: inventaris
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
                     return convertNumberToRupiah(currentValue) + ' (' + percentage + '%)';
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
