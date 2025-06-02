@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Top tour bán chạy nhất</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.statistics') }}">Thống kê</a></li>
                        <li class="breadcrumb-item active">Top tour</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách tour bán chạy nhất</h3>

                        </div>
                        <div class="card-body">
                            <div class="mb-4" style="height: 400px;">
                                <canvas id="top-tours-chart"></canvas>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="top-tours-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Mã Tour</th>
                                            <th>Tour</th>
                                            <th>Giá người lớn</th>
                                            <th>Số đơn đặt</th>
                                            <th>Tổng doanh thu</th>
                                            {{-- <th>Thao tác</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($topTours as $index => $tour)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $tour->id }}</td>
                                                <td>{{ $tour->title }}</td>
                                                <td>{{ number_format($tour->price_adult, 0, ',', '.') }} VNĐ</td>
                                                <td>{{ $tour->booking_count }}</td>
                                                <td>{{ number_format($tour->total_revenue, 0, ',', '.') }} VNĐ</td>
                                                {{-- <td>
                                                    <a href="{{ route('tours.index', $tour->id) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i> Xem
                                                    </a>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tableexport@5.2.0/dist/js/tableexport.min.js"></script>
    <script>
        $(function() {
            // Dữ liệu từ server
            var topTours = @json($topTours);

            // Chuẩn bị dữ liệu cho biểu đồ
            var tourNames = [];
            var bookingCounts = [];
            var revenues = [];
            var backgroundColors = [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 159, 64, 0.7)',
                'rgba(199, 199, 199, 0.7)',
                'rgba(83, 102, 255, 0.7)',
                'rgba(40, 159, 64, 0.7)',
                'rgba(210, 199, 199, 0.7)',
                'rgba(78, 88, 140, 0.7)',
                'rgba(210, 105, 30, 0.7)',
                'rgba(128, 0, 128, 0.7)',
                'rgba(0, 128, 128, 0.7)',
                'rgba(128, 128, 0, 0.7)',
                'rgba(165, 42, 42, 0.7)',
                'rgba(0, 0, 128, 0.7)',
                'rgba(128, 128, 128, 0.7)',
                'rgba(0, 100, 0, 0.7)',
                'rgba(139, 0, 139, 0.7)'
            ];
            var borderColors = backgroundColors.map(color => color.replace('0.7', '1'));

            // Fill dữ liệu
            topTours.forEach(function(tour, index) {
                tourNames.push(tour.title);
                bookingCounts.push(tour.booking_count);
                revenues.push(tour.total_revenue);
            });

            // Biểu đồ so sánh top tours
            var ctx1 = document.getElementById('top-tours-chart').getContext('2d');
            var topToursChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: tourNames,
                    datasets: [{
                        label: 'Doanh thu (VNĐ)',
                        data: revenues,
                        backgroundColor: backgroundColors,
                        borderColor: borderColors,
                        borderWidth: 1,
                        yAxisID: 'y'
                    }, {
                        label: 'Số đơn đặt',
                        data: bookingCounts,
                        type: 'line',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        fill: false,
                        yAxisID: 'y1'
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Doanh thu (VNĐ)'
                            },
                            beginAtZero: true
                        },
                        y1: {
                            type: 'linear',
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Số đơn đặt'
                            },
                            beginAtZero: true,
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.datasetIndex === 0) {
                                        label += new Intl.NumberFormat('vi-VN').format(context.parsed
                                            .y) + ' VNĐ';
                                    } else {
                                        label += context.parsed.y + ' đơn';
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });

            // Biểu đồ tỉ lệ doanh thu
            var ctx2 = document.getElementById('revenue-distribution-chart').getContext('2d');
            var revenueDistributionChart = new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: tourNames,
                    datasets: [{
                        data: revenues,
                        backgroundColor: backgroundColors,
                        borderColor: borderColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    var value = context.raw;
                                    var total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    var percentage = Math.round((value / total) * 100);
                                    label += new Intl.NumberFormat('vi-VN').format(value) + ' VNĐ (' +
                                        percentage + '%)';
                                    return label;
                                }
                            }
                        }
                    }
                }
            });

            // Biểu đồ tỉ lệ booking
            var ctx3 = document.getElementById('booking-distribution-chart').getContext('2d');
            var bookingDistributionChart = new Chart(ctx3, {
                type: 'pie',
                data: {
                    labels: tourNames,
                    datasets: [{
                        data: bookingCounts,
                        backgroundColor: backgroundColors,
                        borderColor: borderColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    var value = context.raw;
                                    var total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    var percentage = Math.round((value / total) * 100);
                                    label += value + ' đơn (' + percentage + '%)';
                                    return label;
                                }
                            }
                        }
                    }
                }
            });

            // Export Excel
            $('#btnExport').click(function() {
                var table = TableExport(document.getElementById('top-tours-table'), {
                    headers: true,
                    footers: true,
                    formats: ['xlsx'],
                    filename: 'top-tours-ban-chay',
                    bootstrap: true,
                    position: 'bottom',
                    ignoreRows: null,
                    ignoreCols: null,
                    trimWhitespace: true,
                    RTL: false,
                    sheetname: 'Top Tours'
                });

                var exportData = table.getExportData();
                var xlsxData = exportData['top-tours-table']['xlsx'];
                table.export2file(xlsxData.data, xlsxData.mimeType, xlsxData.filename, xlsxData
                    .fileExtension);
            });
        });
    </script>
@endsection
