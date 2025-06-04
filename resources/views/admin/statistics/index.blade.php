@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Thống kê doanh thu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Thống kê</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-bill-wave"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Tổng doanh thu</span>
                            <span class="info-box-number">{{ number_format($totalRevenue, 0, ',', '.') }} VNĐ</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Tổng đơn đặt tour</span>
                            <span class="info-box-number">{{ number_format($totalBookings, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-calendar-check"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Đơn đặt tour tháng này</span>
                            <span class="info-box-number">{{ number_format($currentMonthBookings, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-clock"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Đơn đang chờ xử lý</span>
                            <span class="info-box-number">{{ number_format($pendingBookings, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Doanh thu theo tháng ({{ $currentYear }})</h3>
                                <a href="{{ route('admin.statistics.yearly') }}">Xem chi tiết</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="position-relative mb-4" style="height: 400px;">
                                <canvas id="monthly-revenue-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Top 5 tour bán chạy nhất</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.statistics.top-tours') }}" class="btn btn-tool btn-sm">
                                    <i class="fas fa-bars"></i> Xem thêm
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                        <tr>
                                            <th>Tour</th>
                                            <th>Số lần đặt</th>
                                            <th>Giá người lớn</th>
                                            <th>Doanh thu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($topTours) > 0)
                                            @foreach ($topTours as $tour)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('tours.edit', $tour->id) }}"
                                                            title="Xem tour">{{ $tour->title }}</a>
                                                    </td>
                                                    <td>{{ $tour->booking_count }}</td>
                                                    <td>{{ number_format($tour->price_adult, 0, ',', '.') }} VNĐ</td>
                                                    <td>{{ number_format($tour->total_revenue, 0, ',', '.') }} VNĐ</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">Chưa có dữ liệu thống kê</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Thống kê theo khoảng thời gian</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    <form action="{{ route('admin.statistics.date-range') }}" method="GET">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Từ ngày:</label>
                                                    <input type="date" class="form-control" name="start_date"
                                                        value="{{ date('Y-m-d', strtotime('-30 days')) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Đến ngày:</label>
                                                    <input type="date" class="form-control" name="end_date"
                                                        value="{{ date('Y-m-d') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group" style="margin-top: 32px;">
                                                    <button type="submit" class="btn btn-primary">Xem thống kê</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
    <script>
        $(function() {
            // Biểu đồ doanh thu theo tháng
            var monthlyData = @json($monthlyRevenue);
            console.log('Monthly data:', monthlyData); // Kiểm tra dữ liệu từ controller

            var months = [];
            var revenues = [];
            var bookingCounts = [];

            // Đảm bảo đủ 12 tháng, kể cả tháng không có doanh thu
            for (var i = 1; i <= 12; i++) {
                var found = false;
                for (var j = 0; j < monthlyData.length; j++) {
                    if (parseInt(monthlyData[j].month) === i) {
                        months.push('Tháng ' + i);
                        revenues.push(parseInt(monthlyData[j].revenue));
                        bookingCounts.push(parseInt(monthlyData[j].booking_count));
                        found = true;
                        break;
                    }
                }

                if (!found) {
                    months.push('Tháng ' + i);
                    revenues.push(0);
                    bookingCounts.push(0);
                }
            }

            var ctx = document.getElementById('monthly-revenue-chart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Doanh thu (VNĐ)',
                        data: revenues,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        yAxisID: 'y'
                    }, {
                        label: 'Đơn đặt tour',
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
                                text: 'Số đơn đặt tour'
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
        });
    </script>
@endsection
