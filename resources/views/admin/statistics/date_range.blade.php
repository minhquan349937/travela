@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Thống kê doanh thu theo khoảng thời gian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.statistics') }}">Thống kê</a></li>
                        <li class="breadcrumb-item active">Khoảng thời gian</li>
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
                            <h3 class="card-title">Chọn khoảng thời gian</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.statistics.date-range') }}" method="GET">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Từ ngày:</label>
                                            <input type="date" class="form-control" name="start_date"
                                                value="{{ $startDate->format('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Đến ngày:</label>
                                            <input type="date" class="form-control" name="end_date"
                                                value="{{ $endDate->format('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" style="margin-top: 32px;">
                                            <button type="submit" class="btn btn-primary">Xem thống kê</button>
                                            <button type="button" class="btn btn-info ml-2" id="btnExport">Xuất
                                                Excel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Kết quả thống kê từ {{ $startDate->format('d/m/Y') }} đến
                                {{ $endDate->format('d/m/Y') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info"><i class="fas fa-money-bill"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Tổng doanh thu</span>
                                            <span class="info-box-number">{{ number_format($totalRevenue, 0, ',', '.') }}
                                                VNĐ</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success"><i class="fas fa-shopping-cart"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Tổng số đơn đặt</span>
                                            <span
                                                class="info-box-number">{{ number_format($bookingCount, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-warning"><i class="fas fa-chart-line"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Doanh thu trung bình/ngày</span>
                                            @php
                                                $avgRevenue = $bookingCount > 0 ? $totalRevenue / $bookingCount : 0;
                                            @endphp
                                            <span class="info-box-number">{{ number_format($avgRevenue, 0, ',', '.') }}
                                                VNĐ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div style="height: 400px;">
                                <canvas id="revenue-chart"></canvas>
                            </div>

                            <div class="mt-4">
                                <h5>Chi tiết doanh thu theo ngày</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="revenue-table">
                                        <thead>
                                            <tr>
                                                <th>Ngày</th>
                                                <th>Số đơn đặt</th>
                                                <th>Doanh thu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dailyRevenue as $item)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                                                    <td>{{ $item->booking_count }}</td>
                                                    <td>{{ number_format($item->revenue, 0, ',', '.') }} VNĐ</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Tổng cộng</th>
                                                <th>{{ number_format($bookingCount, 0, ',', '.') }}</th>
                                                <th>{{ number_format($totalRevenue, 0, ',', '.') }} VNĐ</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
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
            // Biểu đồ doanh thu
            var dailyData = @json($dailyRevenue);

            var labels = [];
            var revenues = [];
            var bookingCounts = [];

            for (var i = 0; i < dailyData.length; i++) {
                var date = new Date(dailyData[i].date);
                labels.push(date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear());
                revenues.push(dailyData[i].revenue);
                bookingCounts.push(dailyData[i].booking_count);
            }

            var ctx = document.getElementById('revenue-chart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Doanh thu (VNĐ)',
                        data: revenues,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        yAxisID: 'y'
                    }, {
                        label: 'Số đơn đặt',
                        data: bookingCounts,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
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

            // Export Excel
            $('#btnExport').click(function() {
                var table = TableExport(document.getElementById('revenue-table'), {
                    headers: true,
                    footers: true,
                    formats: ['xlsx'],
                    filename: 'thong-ke-doanh-thu-' + new Date().toISOString().slice(0, 10),
                    bootstrap: true,
                    position: 'bottom',
                    ignoreRows: null,
                    ignoreCols: null,
                    trimWhitespace: true,
                    RTL: false,
                    sheetname: 'Doanh thu'
                });

                var exportData = table.getExportData();
                var xlsxData = exportData['revenue-table']['xlsx'];
                table.export2file(xlsxData.data, xlsxData.mimeType, xlsxData.filename, xlsxData
                    .fileExtension);
            });
        });
    </script>
@endsection
