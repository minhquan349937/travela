@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $category->title }}</li>
        </ol>
    </nav>

    <h2 class="mb-4">{{ $category->title }}</h2>

    <!-- Hiển thị danh mục con -->
    @if($subcategories->count() > 0)
        <h3 class="mb-3">Danh mục con</h3>
        <div class="row mb-5">
            @foreach($subcategories as $subcat)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($subcat->image)
                        <img src="{{ asset('uploads/categories/'.$subcat->image) }}" class="card-img-top" alt="{{ $subcat->title }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $subcat->title }}</h5>
                        @if($subcat->description)
                            <p class="card-text">{{ Str::limit($subcat->description, 100) }}</p>
                        @endif
                        <div class="mt-auto">
                            <a href="{{ route('tours.by_category', $subcat->id) }}" class="btn btn-primary">Xem các tour</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    <!-- Hiển thị danh sách tour -->
    @if($tours->count() > 0)
        <h3 class="mb-3">Danh sách tour</h3>
        <div class="row">
            @foreach($tours as $tour)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($tour->image)
                        <img src="{{ asset('uploads/tours/'.$tour->image) }}" class="card-img-top" alt="{{ $tour->title }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $tour->title }}</h5>
                        <p class="card-text">{{ Str::limit($tour->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <p class="mb-0"><strong>Giá người lớn:</strong> {{ number_format($tour->price_adult) }}đ</p>
                                <p class="mb-0"><strong>Giá trẻ em:</strong> {{ number_format($tour->price_children) }}đ</p>
                                <p class="mb-0"><strong>Trạng thái:</strong> 
                                    <span class="badge bg-success">Đã xử lý</span>
                                </p>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="{{ route('tour', $tour->slug) }}" class="btn btn-primary mb-2">Chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <p>Không có tour nào trong danh mục này.</p>
    @endif
</div>
@endsection

@section('styles')
<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.update-status').click(function() {
        var button = $(this);
        var tourId = button.data('tour-id');
        
        $.ajax({
            url: '/tour/' + tourId + '/update-status',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if(response.success) {
                    // Cập nhật giao diện
                    $('#status-' + tourId).text('Đã xử lý');
                    button.remove(); // Xóa nút sau khi cập nhật
                    
                    // Hiển thị thông báo thành công
                    alert('Cập nhật trạng thái thành công!');
                }
            },
            error: function() {
                alert('Có lỗi xảy ra khi cập nhật trạng thái!');
            }
        });
    });
});
</script>
@endsection 