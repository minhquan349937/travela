@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tour đã đặt của số điện thoại: {{ $phone }}</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên tour</th>
                        <th>Ngày đi</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                        <th>Ghi chú</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $key => $booking)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $booking->tour_title }}</td>
                            <td>{{ $booking->date_departure }}</td>
                            <td>
                                Người lớn: {{ $booking->adult }}<br>
                                Trẻ em: {{ $booking->children }}
                            </td>
                            <td>{{ number_format($booking->total_price) }} VNĐ</td>
                            <td>{{ $booking->note }}</td>
                            <td>
                                @if ($booking->status == 1)
                                    <span class="badge badge-success">Đã xác nhận</span>
                                @else
                                    <span class="badge badge-warning">Chờ xác nhận</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
