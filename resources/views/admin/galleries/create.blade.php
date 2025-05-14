@extends('layouts.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Gallery</h3>
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
        <form method= "POST" action="{{ route('gallery.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputPassword1">Tour</label>
                    <select class="form-control" name="tour_id" id="exampleFormControlSelect1">
                        <option value="{{ $tour->id }}">{{ $tour->title }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input class="form-control" id="exampleInputEmail1" placeholder="Enter Title" name="title">
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">File images</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" required name= "image[]" multiple class="form-control-file"
                                id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>

    </div>
@endsection
