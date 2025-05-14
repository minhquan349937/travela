@extends('layouts.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">List Tour</h3>
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
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Vehicle</th>
                        <th scope="col">Departure_date</th>
                        <th scope="col">Return_date</th>
                        <th scope="col">Tour_code</th>
                        <th scope="col">Tour_form</th>
                        <th scope="col">Tour_to</th>
                        <th scope="col">Tour_time</th>
                        <th scope="col">Updated_at</th>
                        <th scope="col">Status</th>
                        <th scope="col">Manager</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tours as $key => $tour)
                        <tr>
                            <th scope="row">{{ $key }}</th>
                            <td scope="row"> <a href="{{ route('gallery.edit', [$tour->id]) }}"> Thêm ảnh</a>
                            </td>
                            <td>{{ $tour->title }}</td>
                            <td>{{ $tour->category->title }}</td>
                            <td>{{ $tour->description }}</td>
                            <td><img height="100" width="100"src="{{ asset('uploads/tours/' . $tour->image) }}"></td>
                            <td>{{ number_format($tour->price, 0, ',', '.') }}</td>
                            <td>{{ $tour->quantity }}</td>
                            <td>{{ $tour->vehicle }}</td>
                            <td>{{ $tour->departure_date }}</td>
                            <td>{{ $tour->return_date }}</td>
                            <td>{{ $tour->tour_code }}</td>
                            <td>{{ $tour->tour_form }}</td>
                            <td>{{ $tour->tour_to }}</td>
                            <td>{{ $tour->tour_time }}</td>
                            <td>{{ $tour->created_at }}</td>

                            <td>
                                @if ($tour->status == 1)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('tours.edit', [$tour->id]) }}" class="btn btn-warning">Edit</a>
                                <form onsubmit=" return comfirm('Bạn có muốn xóa không?');"
                                    action="{{ route('tours.destroy', [$tour->id]) }}" method="POST"
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

    </div>
@endsection
