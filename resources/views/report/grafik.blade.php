@extends('template.layout')
@section('content')
<main class="mt-5">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script type="text/javascript" src="{{ asset('assets/widgets/datepicker/datepicker.js') }}"></script>
    <script type="text/javascript">
        /* Datepicker bootstrap */
            $(function () {
                "use strict";
                $('#datestart').bsdatepicker({
                    format: 'dd-mm-yyyy'
                });
            });
            $(function () {
                "use strict";
                $('#dateend').bsdatepicker({
                    format: 'dd-mm-yyyy'
                });
            });

    </script>
    <!-- Bootstrap Datepicker -->
    <script type="text/javascript" src="{{ asset('assets/widgets/datepicker-ui/datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datepicker-ui/datepicker-demo.js') }}">
    </script>


    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-bootstrap.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-tabletools.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/widgets/datatable/datatable-reorder.js') }}"></script>

    <script type="text/javascript">
        /* Datatables export */

        $(document).ready(function () {
            var table = $('#dt_barang').DataTable();
            var tt = new $.fn.dataTable.TableTools(table);
            $('.dataTables_filter input').attr("placeholder", "Search...");

        });

    </script>
    <!-- Sparklines charts -->

    <script type="text/javascript" src="{{ asset('assets/widgets/charts/sparklines/sparklines.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/charts/sparklines/sparklines-demo.js') }}">
    </script>

    <!-- Flot charts -->

    <script type="text/javascript" src="{{ asset('assets/widgets/charts/flot/flot.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/charts/flot/flot-resize.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/charts/flot/flot-stack.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/charts/flot/flot-pie.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/charts/flot/flot-tooltip.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/charts/flot/flot-demo-1.js') }}"></script>

    <!-- PieGage charts -->

    <script type="text/javascript" src="{{ asset('assets/widgets/charts/piegage/piegage.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/widgets/charts/piegage/piegage-demo.js') }}"></script>

    <div id="page-title">
        <h2>Halaman Executive Dashboard</h2>
        <p>Selamat Datang {{Auth::user()->name}} | <strong>{{Auth::user()->role}}</strong></p>
    </div>

    <section class="section-chart">
        <div class="row">
            <div class="col-md-8 offset-md-2 mt-5 mb-5">
                <div class="card">
                    <div class="card-body text-center">
                        <h2>Laporan Semua data</h2>
                        <hr>
                    </div>
                    <div class="card-body">
                        <canvas id="chartAllData" width="80px" height="40px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script type="text/javascript">
    var dataTotal = {!! json_encode($dataTotal) !!};

    var labelTotal = [];
    var datasetsTotal = [];

    for (key in dataTotal) {
        labelTotal.push(key.toUpperCase().replace('_', ' '));
        datasetsTotal.push(dataTotal[key]);
    }


</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
    var chartAllData = document.getElementById('chartAllData').getContext('2d');
    var chart = new Chart(chartAllData, {
        // The type of chart we want to create
        type: 'pie',

        // The data for our dataset
        data: {
            labels: labelTotal,
            datasets: [{
                label: 'Data Semua',
                backgroundColor: ["#0074D9", "#FF4136", "#2ECC40", "#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"],
                data: datasetsTotal
            }]
        },
    });
</script>
@endsection
