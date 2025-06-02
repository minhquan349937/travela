@extends('layouts.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tạo lịch trình</h3>

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
        <form method="POST" action="{{ route('schedule.store') }}" enctype="multipart/form-data"
            onsubmit="return validateForm()">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputPassword1">Lịch trình cho tour</label>
                    <select class="form-control" name="tour_id">
                        <option value="{{ $tour->id }}">{{ $tour->title }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Lịch trình</label>
                    <textarea class="form-control" name="lichtrinh" id="lichtrinh" placeholder="....">{{ old('lichtrinh') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Chính sách</label>
                    <textarea class="form-control" name="chinhsach" id="chinhsach" placeholder="....">{{ old('chinhsach') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Bao gồm</label>
                    <textarea class="form-control" name="baogom" id="baogom" placeholder="....">{{ old('baogom') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Không bao gồm</label>
                    <textarea class="form-control" name="khongbaogom" id="khongbaogom" placeholder="....">{{ old('khongbaogom') }}</textarea>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>


@endsection
