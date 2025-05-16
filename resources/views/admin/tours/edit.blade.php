@extends('layouts.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Update Tour</h3>
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
        <form method= "POST" action="{{ route('tours.update', [$tour->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên tour</label>
                    <input class="form-control" value="{{ $tour->title }}" id="exampleInputEmail1"
                        placeholder="Enter Title" name="title">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Số chỗ trống</label>
                    <input class="form-control" value="{{ $tour->quantity }}" name="quantity" id="exampleInputPassword1"
                        placeholder="quantity">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mô tả</label>
                    <input class="form-control" value="{{ $tour->description }}" name="description"
                        id="exampleInputPassword1" placeholder="description">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Giá Tour</label>
                    <input class="form-control" value="{{ $tour->price }}" name="price" id="exampleInputPassword1"
                        placeholder="price">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Phương tiện</label>
                    <input class="form-control" value="{{ $tour->vehicle }}" name="vehicle" id="exampleInputPassword1"
                        placeholder="Vehicle">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Ngày đi</label>
                    <input class="form-control" value="{{ $tour->departure_date }}" name="departure_date"
                        id="departure_dates" placeholder="Ngày đi">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Ngày về</label>
                    <input class="form-control" value="{{ $tour->return_date }}" name="return_date" id="return_date"
                        placeholder="Ngày về">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nơi đi</label>
                    <input class="form-control" value="{{ $tour->tour_form }}" name="tour_form" id="exampleInputPassword1"
                        placeholder="tour_form">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nơi đến</label>
                    <input class="form-control" value="{{ $tour->tour_to }}" name="tour_to" id="exampleInputPassword1"
                        placeholder="tour_to">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Thời gian</label>
                    <input class="form-control" value="{{ $tour->tour_time }}" name="tour_time" id="exampleInputPassword1"
                        placeholder="tour_time">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Category Tour</label>
                    <select class="form-control" name="category_id" id="exampleFormControlSelect1">
                        @foreach ($categories as $category)
                            <option {{ $category->id == $tour->category_id ? 'selected' : '' }}
                                value="{{ $category->id }}">
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Ảnh</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name= "image" class="form-control-file" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <img height="100" width="100"src="{{ asset('uploads/tours/' . $tour->image) }}">
                    </div>
                </div>
                <div class="form-check">
                    <input type="checkbox" value="1" {{ $tour->status == 1 ? 'checked' : '' }} name="status"
                        class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Trạng thái</label>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
            </div>
        </form>
    </div>
@endsection
