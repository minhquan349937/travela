@extends('layout')
@section('content')
    <div class="container box-list-tour top-30">
        <!-- Phần tour nổi bật -->
        <div class="row">
            <div class="col-md-12 col-xs-12 bx-title-lst-tour text-center">
                <div class="w100 fl title-tour1">
                    <h2 style="color: #ffc700;font-size: 30px;"><img
                            src="https://vietnamtravel.net.vn/assets/desktop/images/icon_mb.png" alt="icon"
                            style="width: 80px;">TOUR NỔI BẬT</h2>
                </div>
            </div>
            <div class="col-md-12 col-xs-12 bx-content-lst-tour">
                <div class="row">
                    @if (isset($featuredTours) && $featuredTours->count() > 0)
                        @foreach ($featuredTours as $tour)
                            @if ($tour->status == 1)
                                <div class="col-md-4 col-xs-12 lst-tour-item">
                                    <div class="w100 fl bx-wap-pr-item">
                                        <!-- Badge tour nổi bật -->
                                        <div class="featured-badge">
                                            <span>HOT</span>
                                        </div>
                                        <div class="clearfix box-wap-imgpr">
                                            <a href="{{ route('chi-tiet-tour', [$tour->slug]) }}">
                                                <img src="{{ asset('uploads/tours/' . $tour->image) }}" class="img-default"
                                                    alt="{{ $tour->title }}" style="margin-bottom: 6px;">
                                            </a>
                                        </div>
                                        <div class="clear"></div>
                                        <h4>
                                            <a href="{{ route('chi-tiet-tour', [$tour->slug]) }}">
                                                {{ $tour->title }}
                                            </a>
                                        </h4>
                                        <div class="text-muted" style="margin-bottom: 8px;">
                                            <small>Danh mục: {{ $tour->category->title }}</small>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="group-calendar w100 fl">
                                            <div class="col-md-6 col-xs-7 date-start">
                                                <i class="fa fa-calendar"></i>
                                                {{ $tour->departure_date ?? 'Hàng ngày' }}
                                            </div>
                                            <div class="col-md-6 col-xs-5 date-range">
                                                <span class="lst-icon1"><i class="fa fa-clock-o"></i></span>
                                                <span>{{ $tour->tour_time ?? '3 Ngày' }}</span>
                                            </div>
                                        </div>
                                        <div class="group-localtion w100 fl">
                                            <div class="col-md-6 col-xs-7 map-maker">
                                                <span class="lst-icon1"><i class="fa fa-map-marker"></i></span>
                                                <span>{{ $tour->tour_form ?? 'Khởi hành 63 tỉnh/TP' }}</span>
                                            </div>
                                            <div class="col-md-6 col-xs-5 numner-sit">
                                                <span class="lst-icon1"><i class="fa fa-users"></i></span>
                                                <span>Số chỗ: {{ $tour->quantity ?? 10 }}</span>
                                            </div>
                                        </div>
                                        <div class="note-attack">
                                            <i class="fa fa-bell" aria-hidden="true"></i>
                                            {{ $tour->note ?? 'Khuyến mãi 200K cho nhóm khách 5 người trở lên' }}
                                        </div>
                                        <div class="group-book w100 fl">
                                            <span class="price-sell">{{ number_format($tour->price_adult, 0, ',', '.') }}
                                                VNĐ</span>
                                            <a href="{{ route('chi-tiet-tour', [$tour->slug]) }}"
                                                class="link-book btn_view_tour0">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        <!-- Nút xem thêm tour nổi bật -->
                        {{-- <div class="col-md-12">
                            <div class="view-more-tours text-center" style="margin: 20px 0 30px;">
                                <a href="{{ route('tour', ['tour-noi-bat']) }}" class="btn-view-more">
                                    <span>Xem thêm</span>
                                    <i class="fa fa-angle-double-right"></i>
                                </a>
                            </div>
                        </div> --}}
                    @else
                        <div class="col-md-12">
                            <p class="text-center">Không có tour nổi bật nào.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Phần danh mục tour hiện tại -->
        @foreach ($category_parent as $key => $cate_parent)
            <div class="row">
                <div class="col-md-12 col-xs-12 bx-title-lst-tour text-center">
                    <div class="w100 fl title-tour1">
                        <h2 style="color: #ffc700;font-size: 30px;"><img
                                src="https://vietnamtravel.net.vn/assets/desktop/images/icon_mb.png" alt="icon"
                                style="width: 80px;">{{ $cate_parent->title }}</h2>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 bx-content-lst-tour">
                    <div class="row">
                        @if (isset($categoryTours[$cate_parent->id]) && $categoryTours[$cate_parent->id]->count() > 0)
                            @foreach ($categoryTours[$cate_parent->id] as $tour)
                                @if ($tour->status == 1)
                                    <div class="col-md-4 col-xs-12 lst-tour-item">
                                        <div class="w100 fl bx-wap-pr-item">
                                            <div class="clearfix box-wap-imgpr">
                                                <a href="{{ route('chi-tiet-tour', [$tour->slug]) }}">
                                                    <img src="{{ asset('uploads/tours/' . $tour->image) }}"
                                                        class="img-default" alt="{{ $tour->title }}"
                                                        style="margin-bottom: 6px;">
                                                </a>
                                            </div>
                                            <div class="clear"></div>
                                            <h4>
                                                <a href="{{ route('chi-tiet-tour', [$tour->slug]) }}">
                                                    {{ $tour->title }}
                                                </a>
                                            </h4>
                                            <div class="text-muted" style="margin-bottom: 8px;">
                                                <small>Danh mục: {{ $tour->category->title }}</small>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="group-calendar w100 fl">
                                                <div class="col-md-6 col-xs-7 date-start">
                                                    <i class="fa fa-calendar"></i>
                                                    {{ $tour->departure_date ?? 'Hàng ngày' }}
                                                </div>
                                                <div class="col-md-6 col-xs-5 date-range">
                                                    <span class="lst-icon1"><i class="fa fa-clock-o"></i></span>
                                                    <span>{{ $tour->tour_time ?? '3 Ngày' }}</span>
                                                </div>
                                            </div>
                                            <div class="group-localtion w100 fl">
                                                <div class="col-md-6 col-xs-7 map-maker">
                                                    <span class="lst-icon1"><i class="fa fa-map-marker"></i></span>
                                                    <span>{{ $tour->tour_form ?? 'Khởi hành 63 tỉnh/TP' }}</span>
                                                </div>
                                                <div class="col-md-6 col-xs-5 numner-sit">
                                                    <span class="lst-icon1"><i class="fa fa-users"></i></span>
                                                    <span>Số chỗ: {{ $tour->quantity ?? 10 }}</span>
                                                </div>
                                            </div>
                                            <div class="note-attack">
                                                <i class="fa fa-bell" aria-hidden="true"></i>
                                                {{ $tour->note }}
                                            </div>
                                            <div class="group-book w100 fl">
                                                <span
                                                    class="price-sell">{{ number_format($tour->price_adult, 0, ',', '.') }}
                                                    VNĐ</span>
                                                <a href="{{ route('chi-tiet-tour', [$tour->slug]) }}"
                                                    class="link-book btn_view_tour0">Xem chi tiết</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            @if ($cate_parent->getAllTours()->count() > 9)
                                <div class="col-md-12">
                                    <div class="view-more-tours text-center" style="margin: 20px 0 30px;">
                                        <a href="{{ route('tour', [$cate_parent->slug]) }}" class="btn-view-more">
                                            <span>Xem thêm</span>
                                            <i class="fa fa-angle-double-right"></i>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="col-md-12">
                                <p class="text-center">Không có tour nào trong danh mục này.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

<style>
    .btn-view-more {
        display: inline-block;
        padding: 10px 25px;
        background: #0071c2;
        color: #fff;
        font-weight: 500;
        border-radius: 4px;
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: 16px;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .btn-view-more:hover {
        background: #ffc700;
        color: #333;
        text-decoration: none;
    }

    .btn-view-more:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: 0.5s;
    }

    .btn-view-more:hover:before {
        left: 100%;
    }

    .btn-view-more i {
        margin-left: 8px;
        transition: transform 0.3s ease;
    }

    .btn-view-more:hover i {
        transform: translateX(5px);
    }

    /* CSS cho Tour Nổi Bật */
    .featured-tour-item {
        position: relative;
        border: 1px solid #ddd;
        transition: all 0.3s ease;
        margin-bottom: 30px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        overflow: hidden;
    }

    .featured-tour-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        border-color: #0071c2;
    }

    .featured-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 10;
    }

    .featured-badge span {
        display: inline-block;
        background: linear-gradient(45deg, #ff3547, #ff9800);
        color: white;
        font-weight: bold;
        padding: 5px 12px;
        border-radius: 3px;
        font-size: 14px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .featured-tours .box-wap-imgpr {
        position: relative;
        overflow: hidden;
        height: 200px;
    }

    .featured-tours .box-wap-imgpr img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .featured-tours .box-wap-imgpr:hover img {
        transform: scale(1.05);
    }

    .featured-tours h4 {
        height: 40px;
        overflow: hidden;
        margin-top: 10px;
    }

    .featured-tours h4 a {
        color: #333;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .featured-tours h4 a:hover {
        color: #0071c2;
    }

    .featured-tours .note-attack {
        background-color: #fef9e7;
        border-left: 3px solid #ffc700;
        padding: 8px;
        margin-bottom: 10px;
        font-size: 12px;
    }

    .featured-tours .price-sell {
        color: #e74c3c;
        font-weight: 700;
        font-size: 18px;
    }

    .featured-tours .link-book {
        background: #0071c2;
        color: white;
        padding: 6px 12px;
        border-radius: 3px;
        float: right;
        transition: all 0.3s ease;
    }

    .featured-tours .link-book:hover {
        background: #ffc700;
        color: #333;
    }

    @media (max-width: 767px) {
        .featured-tours .col-md-3 {
            width: 100%;
            margin-bottom: 15px;
        }
    }

    /* CSS cho badge "HOT" của tour nổi bật */
    .featured-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 10;
    }

    .featured-badge span {
        display: inline-block;
        background: linear-gradient(45deg, #ff3547, #ff9800);
        color: white;
        font-weight: bold;
        padding: 5px 12px;
        border-radius: 3px;
        font-size: 14px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .bx-wap-pr-item {
        position: relative;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .bx-wap-pr-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        border-color: #0071c2;
    }
</style>
