@extends('layouts.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">List Category</h3>
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
        <table class="table table-striped" id="myTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Created date</th>
                    <th scope="col">Updated date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Maneger</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $key => $cate)
                    <tr>
                        <th scope="row">{{ $key }}</th>
                        <td>{{ $cate->title }}</td>
                        <td>{{ $cate->description }}</td>
                        <td><img height="100" width="100"src="{{ asset('uploads/categories/' . $cate->image) }}"></td>
                        <td>{{ $cate->slug }}</td>
                        <td>{{ $cate->created_at }}</td>
                        <td>{{ $cate->updated_at }}</td>
                        <td>
                            @if ($cate->status == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('categories.edit', [$cate->id]) }}" class="btn btn-warning">Edit</a>
                            <form onsubmit=" return comfirm('Bạn có muốn xóa không?');"
                                action="{{ route('categories.destroy', [$cate->id]) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
