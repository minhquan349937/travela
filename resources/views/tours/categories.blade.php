@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Danh mục Tour</h2>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">Danh mục cấp 1</div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($level1Categories as $level1)
                            <a href="{{ route('tours.by_category', $level1->id) }}" class="list-group-item list-group-item-action level-1" 
                               data-id="{{ $level1->id }}">{{ $level1->title }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">Danh mục cấp 2</div>
                <div class="card-body">
                    <div class="list-group" id="level-2-categories">
                        <p class="text-center">Vui lòng chọn danh mục cấp 1</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">Danh mục cấp 3</div>
                <div class="card-body">
                    <div class="list-group" id="level-3-categories">
                        <p class="text-center">Vui lòng chọn danh mục cấp 1 hoặc cấp 2</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // When a level 1 category is clicked
        $(document).on('click', '.level-1', function(e) {
            e.preventDefault();
            const categoryId = $(this).data('id');
            
            // Highlight the selected category
            $('.level-1').removeClass('active');
            $(this).addClass('active');
            
            // Load level 2 categories
            $.ajax({
                url: '/tours/categories/2/' + categoryId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    let html = '';
                    
                    if (data.length === 0) {
                        html = '<p class="text-center">Không có danh mục</p>';
                    } else {
                        $.each(data, function(index, category) {
                            html += '<a href="/tours/category/' + category.id + '" class="list-group-item list-group-item-action level-2" ' +
                                   'data-id="' + category.id + '">' + category.title + '</a>';
                        });
                    }
                    
                    $('#level-2-categories').html(html);
                    
                    // Also load level 3 categories for this level 1
                    loadLevel3Categories(categoryId);
                },
                error: function() {
                    $('#level-2-categories').html('<p class="text-center text-danger">Lỗi tải dữ liệu</p>');
                }
            });
            
            // Navigate to category page
            window.location.href = '/tours/category/' + categoryId;
        });
        
        // When a level 2 category is clicked
        $(document).on('click', '.level-2', function(e) {
            e.preventDefault();
            const categoryId = $(this).data('id');
            
            // Highlight the selected category
            $('.level-2').removeClass('active');
            $(this).addClass('active');
            
            // Load level 3 categories
            loadLevel3Categories(categoryId);
            
            // Navigate to category page
            window.location.href = '/tours/category/' + categoryId;
        });
        
        function loadLevel3Categories(parentId) {
            $.ajax({
                url: '/tours/categories/3/' + parentId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    let html = '';
                    
                    if (data.length === 0) {
                        html = '<p class="text-center">Không có danh mục</p>';
                    } else {
                        $.each(data, function(index, category) {
                            html += '<a href="/tours/category/' + category.id + '" class="list-group-item list-group-item-action level-3" ' +
                                   'data-id="' + category.id + '">' + category.title + '</a>';
                        });
                    }
                    
                    $('#level-3-categories').html(html);
                },
                error: function() {
                    $('#level-3-categories').html('<p class="text-center text-danger">Lỗi tải dữ liệu</p>');
                }
            });
        }
    });
</script>
@endsection 