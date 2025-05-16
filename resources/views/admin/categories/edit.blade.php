@extends('layouts.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Update Category</h3>
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
        <form method= "POST" action="{{ route('categories.update', [$category->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input class="form-control" id="exampleInputEmail1" value="{{ $category->title }}"
                        placeholder="Enter Title" name="title">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Description</label>
                    <input class="form-control" name="description" value="{{ $category->description }}"
                        id="exampleInputPassword1" placeholder="description">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File images</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name= "image" class="form-control-file" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>

                        </div>
                        <img height="100" width="100"src="{{ asset('uploads/categories/' . $category->image) }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">thuộc danh mục</label>
                    <select class="form-control" name="category_parent">
                        <option value="0">Chọn danh mục</option>
                        @foreach ($categories as $key => $cat)
                            <option {{ $cat->id == $category->category_parent ? 'selected' : '' }}
                                value="{{ $cat->id }}">
                                @php
                                    $str = '';
                                    for ($i = 0; $i < $cat->level; $i++) {
                                        echo $str;
                                        $str .= '--';
                                    }
                                @endphp

                                {{ $cat->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-check">
                    <input type="checkbox" value="1" {{ $category->status == 1 ? 'checked' : '' }} name="status"
                        class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Status</label>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
