@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tour Trong Nước</h2>

    @if($tours->count() > 0)
        <div class="row">
            @foreach($tours as $tour)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if($tour->image)
                        <img src="{{ asset('storage/'.$tour->image) }}" class="card-img-top" alt="{{ $tour->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $tour->title }}</h5>
                        <p class="card-text text-truncate">{{ $tour->description }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0">Giá người lớn: {{ number_format($tour->price_adult) }}đ</p>
                                <p class="mb-0">Giá trẻ em: {{ number_format($tour->price_children) }}đ</p>
                            </div>
                            <a href="{{ route('tours.show', $tour->id) }}" class="btn btn-primary">Chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <p>Không có tour nào.</p>
    @endif
</div>
@endsection 