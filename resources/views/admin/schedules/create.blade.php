@extends('layouts.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? 'Tạo lịch trình' }}</h3>
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
        <form method="POST" action="{{ route('schedule.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputPassword1">Lịch trình cho tour</label>
                    <select class="form-control" name="tour_id" readonly>
                        <option value="{{ $tour->id }}">{{ $tour->title }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Lịch trình</label>
                    <textarea class="form-control" name="lichtrinh" id="lichtrinh" placeholder="Nhập lịch trình tour...">{{ $schedule->lichtrinh ?? old('lichtrinh') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Bao gồm</label>
                    <textarea class="form-control" name="baogom" id="baogom" placeholder="Nhập những gì tour bao gồm...">{{ $schedule->baogom ?? old('baogom') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Không bao gồm</label>
                    <textarea class="form-control" name="khongbaogom" id="khongbaogom" placeholder="Nhập những gì tour không bao gồm...">{{ $schedule->khongbaogom ?? old('khongbaogom') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Chính sách</label>
                    <textarea class="form-control" name="chinhsach" id="chinhsach" placeholder="Nhập chính sách tour...">{{ $schedule->chinhsach ?? old('chinhsach') }}</textarea>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ $schedule ? 'Cập nhật' : 'Thêm mới' }}</button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="//cdn.ckeditor.com/4.21.0/full/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('lichtrinh');
            CKEDITOR.replace('baogom');
            CKEDITOR.replace('khongbaogom');
            CKEDITOR.replace('chinhsach');
        </script>
    @endpush

@endsection
