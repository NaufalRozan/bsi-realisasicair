@extends('layouts.navbar')

@section('content')

<head>

<link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<div class="container">
    <form id="my-form" action="{{ route('grafik') }}" method="GET">
        <div class="form-group">
            <label for="month"></label>
            <div class="row">
                <div class="col-md-6">
                    <select name="month" id="month" class="form-select">
                        <option value="">Semua Bulan</option>
                        <option value="01" {{ $month == '01' ? 'selected' : '' }}>January</option>
                        <option value="02" {{ $month == '02' ? 'selected' : '' }}>February</option>
                        <option value="03" {{ $month == '03' ? 'selected' : '' }}>March</option>
                        <option value="04" {{ $month == '04' ? 'selected' : '' }}>April</option>
                        <option value="05" {{ $month == '05' ? 'selected' : '' }}>May</option>
                        <option value="06" {{ $month == '06' ? 'selected' : '' }}>June</option>
                        <option value="07" {{ $month == '07' ? 'selected' : '' }}>July</option>
                        <option value="08" {{ $month == '08' ? 'selected' : '' }}>August</option>
                        <option value="09" {{ $month == '09' ? 'selected' : '' }}>September</option>
                        <option value="10" {{ $month == '10' ? 'selected' : '' }}>October</option>
                        <option value="11" {{ $month == '11' ? 'selected' : '' }}>November</option>
                        <option value="12" {{ $month == '12' ? 'selected' : '' }}>December</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <select name="year" id="year" class="form-select">
                        <option value="">Semua Tahun</option>
                        @for ($i = date('Y'); $i >= 2010; $i--)
                        <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="blue-button">Tampilkan</button>
    </form>
    <br>
    <h2>Grafik Berdasarkan Nama Marketing</h2>
    <div id="grafik"></div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        // encode chart data to JSON format
        var categories = <?= json_encode($categories) ?>;
        var total = <?= json_encode($total) ?>;
        var target = <?= json_encode($target) ?>;

        // get the selected month and year from the form
        var month = document.getElementById('month').value;
        var year = document.getElementById('year').value;

        Highcharts.chart('grafik', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Laporan'
            },
            subtitle: {
                text: 'CBRM'
            },
            xAxis: {
                categories: categories,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Cair'
                },
                labels: {
                    formatter: function() {
                        return 'Rp. ' + Highcharts.numberFormat(this.value, 0, '.', ',');
                    }
                }
            },
            tooltip: {
                pointFormatter: function() {
                    return '<span style="color:' + this.color + '">\u25CF</span> ' + this.series.name + ': <b>Rp. ' + Highcharts.numberFormat(this.y, 0, '.', ',') + '</b><br/>'
                },
                shared: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Realisasi Cair',
                data: total,
                color: '#48a39e'
            }, {
                name: 'Target',
                data: target,
                color: '#F2AB3B'
            }]
        });
    </script>

    <h2>Grafik Berdasarkan Outlet</h2>
    <div id="grafik2"></div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        // encode chart data to JSON format
        var categories2 = <?= json_encode($categories2) ?>;
        var total2 = <?= json_encode($total2) ?>;
        var target2 = <?= json_encode($target2) ?>;

        // get the selected month and year from the form
        var month = document.getElementById('month').value;
        var year = document.getElementById('year').value;

        Highcharts.chart('grafik2', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Laporan'
            },
            subtitle: {
                text: 'CBRM'
            },
            xAxis: {
                categories: categories2,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Cair'
                },
                labels: {
                    formatter: function() {
                        return 'Rp. ' + Highcharts.numberFormat(this.value, 0, '.', ',');
                    }
                }
            },
            tooltip: {
                pointFormatter: function() {
                    return '<span style="color:' + this.color + '">\u25CF</span> ' + this.series.name + ': <b>Rp. ' + Highcharts.numberFormat(this.y, 0, '.', ',') + '</b><br/>'
                },
                shared: true
            },

            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Realisasi Cair',
                data: total2,
                color: '#48a39e'
            }, {
                name: 'Target',
                data: target2,
                color: '#F2AB3B'
            }]
        });
    </script>
</div>
@include('layouts.footer')
@endsection