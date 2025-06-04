@extends('layouts.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Danh sách Tour</h3>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- /.card-header -->
        <!-- form start -->
        <div class="table table-responsive">
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Gallery</th>
                        <th scope="col">Lịch trình</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Giá người lớn</th>
                        <th scope="col">Giá trẻ em</th>
                        <th scope="col">Số lượng chỗ</th>
                        <th scope="col">Phương tiện</th>
                        <th scope="col">Ngày đi</th>
                        <!-- <th scope="col">Ngày về</th> -->
                        <th scope="col">Mã tour</th>
                        <th scope="col">Nơi đi</th>
                        <th scope="col">Nơi về</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Ghi chú</th>
                        <th scope="col">Ngày cập nhật</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tours as $key => $tour)
                        <tr>
                            <th scope="row">{{ $key }}</th>
                            <td scope="row"> <a href="{{ route('gallery.edit', [$tour->id]) }}"> Thêm ảnh</a>
                            </td>
                            <td scope="row"> <a href="{{ route('schedule.edit', [$tour->id]) }}"> Thêm/Sửa lịch trình</a>
                            </td>
                            <td>{{ $tour->title }}</td>
                            <td>{{ $tour->category->title }}</td>
                            <td>{{ $tour->description }}</td>
                            <td><img height="100" width="100"src="{{ asset('uploads/tours/' . $tour->image) }}"></td>
                            <td>{{ number_format($tour->price_adult, 0, ',', '.') }}VNĐ
                            </td>
                            <td>{{ number_format($tour->price_children, 0, ',', '.') }}VNĐ
                            <td>{{ $tour->quantity }}</td>
                            <td>{{ $tour->vehicle }}</td>
                            <td>
                                @php
                                    // Convert the string into an array by splitting on commas
                                    $departureDates = explode(', ', $tour->departure_date);
                                @endphp

                                @if (!empty($departureDates))
                                    @foreach ($departureDates as $date)
                                        <span class="badge rounded-pill bg-primary">{{ trim($date, '" ') }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">No departure dates available</span>
                                @endif
                            </td>
                            <!-- <td>{{ $tour->return_date }}</td> -->
                            <td>{{ $tour->tour_code }}</td>
                            <td>{{ $tour->tour_form }}</td>
                            <td>{{ $tour->tour_to }}</td>
                            <td>{{ $tour->tour_time }}</td>
                            <td>{{ $tour->note }}</td>
                            <td>{{ $tour->updated_at }}</td>

                            <td>
                                @if ($tour->status == 1)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('tours.edit', [$tour->id]) }}" class="btn btn-warning">Sửa</a>
                                <form onsubmit=" return comfirm('Bạn có muốn xóa không?');"
                                    action="{{ route('tours.destroy', [$tour->id]) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <!-- Modal thêm giá -->
    <div class="modal fade" id="themgia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm giá cho tour</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tourprice.store') }}" method="POST">
                        @csrf

                        <table class="table">
                            <thead>
                                <tr>
                                    {{-- <th scope="col">Ngày khởi hành</th> --}}
                                    <th scope="col">Giá người lớn</th>
                                    <th scope="col">Giá trẻ em</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    {{-- <td>
                                        <select name="tour_date" id="tour-date-select" class="form-control">

                                        </select>
                                    </td> --}}
                                    <td><input type="text" required name="adult" class="form-control"></td>
                                    <td><input type="text" required name="children" class="form-control"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div id="tour-details">
                            <!-- Data will be loaded here -->
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Cập nhật giá</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
