@extends('layouts.base_admin.base_dashboard')
@section('judul', 'Halaman Dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="mt-5">
    <h5 class="text-center mb-4">Statistik Produk per Kategori</h5>
    <div id="canvasproduk" style="width:100%; height:400px;"></div>
</div>
@endsection

@section('scripts')
<!-- Highcharts CDN -->
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        Highcharts.chart('canvasproduk', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Produk Per Kategori',
                align: 'center'
            },
            xAxis: {
                categories: {!! json_encode($label) !!}, // ✅ FIXED
                crosshair: true,
                accessibility: {
                    description: 'Kategori'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Produk'
                }
            },
            tooltip: {
                valueSuffix: ' pcs'
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Produk per Kategori',
                data: {!! json_encode($value) !!} // ✅ FIXED
            }]
        });
    });
</script>
@endsection
