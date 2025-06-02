@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Thống kê doanh thu theo năm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.statistics') }}">Thống kê</a></li>
                        <li class="breadcrumb-item active">Theo năm</li>
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
                            <h3 class="card-title">Chọn năm</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.statistics.yearly') }}" method="GET" class="form-inline">
                                <div class="form-group mx-sm-3">
                                    <select class="form-control" name="year">
                                        @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                                            <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>
                                                {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Xem thống kê</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Thống kê doanh thu theo tháng trong năm {{ $year }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="height: 400px;">
                                <canvas id="revenue-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Chi tiết doanh thu theo tháng trong năm {{ $year }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="monthly-revenue-table" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tháng</th>
                                            <th>Số đơn đặt</th>
                                            <th>Doanh thu</th>
                                            <th>Doanh thu trung bình/đơn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalBookings = 0;
                                            $totalRevenue = 0;
                                        @endphp

                                        @for ($month = 1; $month <= 12; $month++)
                                            @php
                                                $monthData = $monthlyRevenue->firstWhere('month', $month);
                                                $bookingCount = $monthData ? $monthData->booking_count : 0;
                                                $revenue = $monthData ? $monthData->revenue : 0;
                                                $avgRevenue = $bookingCount > 0 ? $revenue / $bookingCount : 0;

                                                $totalBookings += $bookingCount;
                                                $totalRevenue += $revenue;
                                            @endphp
                                            <tr>
                                                <td>{{ 'Tháng ' . $month }}</td>
                                                <td>{{ number_format($bookingCount, 0, ',', '.') }}</td>
                                                <td>{{ number_format($revenue, 0, ',', '.') }} VNĐ</td>
                                                <td>{{ number_format($avgRevenue, 0, ',', '.') }} VNĐ</td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Tổng cộng</th>
                                            <th>{{ number_format($totalBookings, 0, ',', '.') }}</th>
                                            <th>{{ number_format($totalRevenue, 0, ',', '.') }} VNĐ</th>
                                            <th>{{ $totalBookings > 0 ? number_format($totalRevenue / $totalBookings, 0, ',', '.') : 0 }}
                                                VNĐ</th>
                                        </tr>
                                    </tfoot>
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
            // Prepare data for charts
            var monthNames = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
                'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
            ];
            var revenues = Array(12).fill(0);
            var bookingCounts = Array(12).fill(0);

            @foreach ($monthlyRevenue as $item)
                revenues[{{ $item->month - 1 }}] = {{ $item->revenue }};
                bookingCounts[{{ $item->month - 1 }}] = {{ $item->booking_count }};
            @endforeach

            // Monthly Revenue Chart
            var ctx1 = document.getElementById('revenue-chart').getContext('2d');
            var revenueChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: monthNames,
                    datasets: [{
                        label: 'Doanh thu (VNĐ)',
                        data: revenues,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        yAxisID: 'y'
                    }, {
                        label: 'Số đơn đặt',
                        data: bookingCounts,
                        type: 'line',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
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

            // Quarterly Chart
            var quarterlyRevenues = [
                revenues.slice(0, 3).reduce((a, b) => a + b, 0),
                revenues.slice(3, 6).reduce((a, b) => a + b, 0),
                revenues.slice(6, 9).reduce((a, b) => a + b, 0),
                revenues.slice(9, 12).reduce((a, b) => a + b, 0)
            ];

            var ctx2 = document.getElementById('quarterly-chart').getContext('2d');
            var quarterlyChart = new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: ['Quý 1', 'Quý 2', 'Quý 3', 'Quý 4'],
                    datasets: [{
                        data: quarterlyRevenues,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(75, 192, 192, 0.7)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
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

            // Comparison Chart (Normalized values for comparison)
            var maxRevenue = Math.max(...revenues);
            var maxBookings = Math.max(...bookingCounts);
            var normalizedRevenues = revenues.map(v => (maxBookings > 0 && maxRevenue > 0) ? (v / maxRevenue) *
                maxBookings : v);

            var ctx3 = document.getElementById('comparison-chart').getContext('2d');
            var comparisonChart = new Chart(ctx3, {
                type: 'radar',
                data: {
                    labels: monthNames,
                    datasets: [{
                        label: 'Số đơn đặt',
                        data: bookingCounts,
                        fill: true,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgb(255, 99, 132)',
                        pointBackgroundColor: 'rgb(255, 99, 132)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(255, 99, 132)'
                    }, {
                        label: 'Doanh thu (đã chuẩn hóa)',
                        data: normalizedRevenues,
                        fill: true,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgb(54, 162, 235)',
                        pointBackgroundColor: 'rgb(54, 162, 235)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(54, 162, 235)'
                    }]
                },
                options: {
                    elements: {
                        line: {
                            borderWidth: 3
                        }
                    },
                    scales: {
                        r: {
                            angleLines: {
                                display: true
                            },
                            suggestedMin: 0
                        }
                    }
                }
            });

            // Export Excel
            $('#btnExport').click(function() {
                var table = TableExport(document.getElementById('monthly-revenue-table'), {
                    headers: true,
                    footers: true,
                    formats: ['xlsx'],
                    filename: 'doanh-thu-theo-thang-nam-' + {{ $year }},
                    bootstrap: true,
                    position: 'bottom',
                    ignoreRows: null,
                    ignoreCols: null,
                    trimWhitespace: true,
                    RTL: false,
                    sheetname: 'Doanh thu'
                });

                var exportData = table.getExportData();
                var xlsxData = exportData['monthly-revenue-table']['xlsx'];
                table.export2file(xlsxData.data, xlsxData.mimeType, xlsxData.filename, xlsxData
                    .fileExtension);
            });
        });
    </script>
@endsection
