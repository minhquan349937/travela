{{-- filepath: c:\xampp\htdocs\tour\resources\views\pages\search.blade.php --}}
@extends('layout')
@section('content')

    <div class="container box-list-tour top-30">
        <div class="row">
            <div class="col-md-12 col-xs-12 bx-title-lst-tour text-center">
                <div class="w100 fl title-tour1">
                    <h2 style="color: #ffc700;font-size: 30px;">
                        <i class="fa fa-search" aria-hidden="true"></i> Tìm kiếm tour theo từ khóa: <span
                            style="color: #ff0000;">{{ $search }}</span>
                    </h2>
                </div>
            </div>
            <div class="col-md-12 col-xs-12 bx-content-lst-tour">
                <div class="row">
                    @if ($tours->count() > 0)
                        @foreach ($tours as $key => $tour)
                            @if ($tour->status == 1)
                                <div class="col-md-4 col-xs-12 lst-tour-item">
                                    <div class="w100 fl bx-wap-pr-item">
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

                                        <div class="clear"></div>
                                        <div class="group-calendar w100 fl">
                                            <div class="col-md-6 col-xs-7 date-start">
                                                <i class="fa fa-calendar"></i>
                                                {{ trim($tour->departure_date, '"') ?? 'Hàng ngày' }}
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
                                            <span class="price-sell">{{ number_format($tour->price_adult, 0, ',', '.') }}
                                                VNĐ</span>
                                            <a href="{{ route('chi-tiet-tour', [$tour->slug]) }}"
                                                class="link-book btn_view_tour0">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="col-md-12">
                            <p class="text-center">Không có tour nào trong danh mục này.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection
