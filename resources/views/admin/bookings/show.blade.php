@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tour đã đặt</h3>

                </div>

                <div class="table table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>

                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Giá tour</th>
                                <th scope="col">Phương tiện</th>
                                <th scope="col">Mã tour</th>
                                <th scope="col">Image</th>
                                <th scope="col">Ngày khởi hành</th>
                                <th scope="col">Nơi đi</th>
                                <th scope="col">Nơi đến</th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr>


                                <td>{{ $tour->title }}</td>

                                <td>{{ number_format($tour->price_adult, 0, ',', '.') }}vnd</td>

                                <td>{{ $tour->vehicle }}</td>
                                <td>{{ $tour->tour_code }}</td>
                                <td><img height="120" width="120" src="{{ asset('uploads/tours/' . $tour->image) }}">
                                <td>
                                    @php
                                        // Convert the string into an array by splitting on commas
                                        $departureDates = explode(', ', $tour->departure_date);
                                    @endphp

                                    @if (!empty($departureDates))
                                        @foreach ($departureDates as $date)
                                            <span class="badge rounded-pill bg-primary">{{ trim($date, '"') }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">No departure dates available</span>
                                    @endif
                                </td>
                                <td>{{ $tour->tour_from }}</td>
                                <td>{{ $tour->tour_to }}</td>
                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">

            <h4>Thông tin đặt tour</h4>
            <table class="table table-striped">
                <thead>
                    <tr>

                        <th scope="col">Tour ID</th>
                        <th scope="col">Ngày khởi hành</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Ghi chú</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">tổng tiền tour</th>
                        <th scope="col">Người lớn</th>
                        <th scope="col">Trẻ em</th>
                        <th scope="col">Ngày đặt</th>
                        <th scope="col">Ngày cập nhật</th>
                        <th scope="col">Tình trạng</th>


                    </tr>
                </thead>
                <tbody>

                    <tr>

                        <td>{{ $booking->tour_id }}</td>

                        <td> <span class="badge rounded-pill bg-primary">{{ trim($booking->date_departure, '"') }}</span>
                        </td>
                        <td>{{ $booking->fullname }}</td>
                        <td>{{ $booking->email }}</td>
                        <td>{{ $booking->note }}</td>
                        <td>{{ $booking->phone }}</td>
                        <td>{{ number_format($booking->total_price, 0, ',', '.') }}vnd</td>
                        <td>{{ $booking->adult }}</td>
                        <td>{{ $booking->children }}</td>
                        <td>{{ $booking->created_at }}</td>
                        <td>{{ $booking->updated_at }}</td>
                        <td class="booking-status-text">
                            @if ($booking->status == 0)
                                <span class="text text-warning">Đang chờ thanh toán</span>
                            @else
                                <span class="text text-success">Đã thanh toán</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <select class="form-control booking-status-select"
                                    style="width:auto;display:inline-block;margin-right:8px;">
                                    <option value="0" {{ $booking->status == 0 ? 'selected' : '' }}>Chưa thanh toán
                                    </option>
                                    <option value="1" {{ $booking->status == 1 ? 'selected' : '' }}>Đã thanh toán
                                    </option>
                                </select>
                                <button type="button" class="btn btn-primary btn-confirm-status"
                                    data-url="{{ route('booking.update-status', ['id' => $booking->id]) }}">
                                    Xác nhận
                                </button>
                            </div>
                        </td>
                    </tr>


                </tbody>
            </table>
        </div>

        <div class="mb-3">
            <a href="{{ route('booking.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Quay lại
            </a>
        </div>

    </div>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    @push('scripts')
        <script>
            $(document).on('click', '.btn-confirm-status', function() {
                var btn = $(this);
                var select = btn.closest('td').find('.booking-status-select');
                var status = select.val();
                var url = btn.data('url');
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        var statusTd = btn.closest('tr').find('.booking-status-text span');
                        if (status === "1") {
                            statusTd.removeClass('text-warning').addClass('text-success').text('Đã xử lý');
                        } else {
                            statusTd.removeClass('text-success').addClass('text-warning').text('Đang chờ');
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
