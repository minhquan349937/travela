@extends('layout')
@section('content')
    <style>
        .contact-section {
            padding: 50px 0;
        }

        .contact-section h2 {
            color: #333;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }

        .contact-section h2:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            height: 3px;
            background: #FFC700;
        }

        .contact-info {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 5px;
            margin-bottom: 30px;
        }

        .contact-info i {
            color: #FFC700;
            font-size: 24px;
            margin-right: 10px;
            vertical-align: middle;
        }

        .contact-info p {
            margin-bottom: 15px;
        }

        .contact-form .form-control {
            border-radius: 5px;
            margin-bottom: 20px;
            height: 45px;
        }

        .contact-form textarea.form-control {
            height: 150px;
        }

        .contact-form button {
            background-color: #FFC700;
            border: none;
            padding: 12px 30px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .contact-form button:hover {
            background-color: #e6b400;
        }

        .map-container {
            overflow: hidden;
            position: relative;
            height: 400px;
            border-radius: 5px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100% !important;
            height: 100% !important;
            border: 0;
        }

        .office-info {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .office-info h4 {
            color: #333;
            font-weight: bold;
            margin-bottom: 15px;
            border-bottom: 2px solid #FFC700;
            padding-bottom: 10px;
        }
    </style>

    <!-- Banner đầu trang -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">Trang chủ</a></li>
                <li class="active">Liên hệ</li>
            </ul>
        </div>
    </div>

    <!-- Thông tin liên hệ -->
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h2>Liên hệ với chúng tôi</h2>
                    <div class="contact-info">
                        <p><i class="fa fa-map-marker"></i> <strong>Trụ sở chính:</strong> Biệt thự số 8, dãy M2, khu đô thị
                            mới Dương Nội, Hà Đông, Hà Nội</p>
                        <p><i class="fa fa-phone"></i> <strong>Hotline:</strong> 0383 041 692 - Mr.Quoc</p>
                        <p><i class="fa fa-envelope"></i> <strong>Email:</strong> Quocphan370@gmail.com</p>
                        <p><i class="fa fa-clock-o"></i> <strong>Giờ làm việc:</strong> 8:00 - 17:30, Thứ Hai - Thứ Bảy</p>
                    </div>

                    {{-- <h2>Gửi yêu cầu tư vấn</h2>
                <div class="contact-form">
                    <form action="#" method="post" id="contact-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Họ và tên *" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email *" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone" placeholder="Số điện thoại *" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="subject" placeholder="Tiêu đề">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" placeholder="Nội dung tin nhắn *" required></textarea>
                        </div>
                        <button type="submit" class="btn">Gửi yêu cầu</button>
                    </form>
                </div> --}}
                </div>

                <div class="col-md-5">
                    <h2>Bản đồ</h2>
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.1957565648156!2d105.75532007596683!3d20.981869489411247!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3134532b2211b0a9%3A0xab3c62125224f8bd!2zxJDDtCBUaOG7iyBNaeG7hXUgROawgG5nIE7hu5lpIE3hu5tpLCBExrDGoW5nIE7hu5lpLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1685868341912!5m2!1svi!2s"
                            allowfullscreen="" loading="lazy"></iframe>
                    </div>

                    <h2 class="mt-4">Văn phòng chi nhánh</h2>
                    <!-- Chi nhánh Đà Nẵng -->
                    <div class="office-info">
                        <h4>Văn phòng Đà Nẵng</h4>
                        <p><i class="fa fa-map-marker"></i> 83 Nguyễn Thị Minh Khai, Quận Hải Châu, Thành phố Đà Nẵng</p>
                        <p><i class="fa fa-phone"></i> 0904 577 548</p>
                        <p><i class="fa fa-envelope"></i> ceodangnang.vietnamtravel@gmail.com</p>
                    </div>

                    <!-- Chi nhánh TP. HCM -->
                    <div class="office-info">
                        <h4>Văn phòng TP. Hồ Chí Minh</h4>
                        <p><i class="fa fa-map-marker"></i> 18E Đường Cộng Hòa (Republic Plaza), Phường 4, Quận Tân Bình, Hồ
                            Chí Minh</p>
                        <p><i class="fa fa-phone"></i> 098 444 1944 / 028 3880 8086</p>
                        <p><i class="fa fa-envelope"></i> ceosaigon.vietnamtravel@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Liên hệ -->
    {{-- <section class="contact-section" style="background-color: #f5f5f5;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Câu hỏi thường gặp</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Làm thế nào để đặt
                                        tour?</a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in">
                                <div class="panel-body">Quý khách có thể đặt tour trực tuyến trên website, gọi điện đến
                                    hotline 0913 073 026, hoặc đến trực tiếp văn phòng của chúng tôi để được tư vấn và hỗ
                                    trợ đặt tour.</div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Tôi có thể thanh
                                        toán bằng những phương thức nào?</a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">Chúng tôi chấp nhận thanh toán bằng tiền mặt tại văn phòng, chuyển
                                    khoản ngân hàng, thẻ tín dụng/ghi nợ và các ví điện tử phổ biến.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel-group" id="accordion2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion2" href="#collapse3">Làm sao để hủy
                                        hoặc thay đổi tour đã đặt?</a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">Quý khách vui lòng liên hệ với chúng tôi qua hotline hoặc email càng
                                    sớm càng tốt. Việc hủy hoặc thay đổi tour sẽ tuân theo chính sách hủy tour của công ty.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion2" href="#collapse4">Tôi có cần visa
                                        khi đi tour nước ngoài không?</a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">Tùy vào quốc gia mà quý khách tham quan, yêu cầu về visa sẽ khác
                                    nhau. Khi quý khách đặt tour, nhân viên tư vấn của chúng tôi sẽ cung cấp thông tin chi
                                    tiết về thủ tục visa cần thiết.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Xử lý form liên hệ
            const contactForm = document.getElementById('contact-form');
            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    alert(
                        'Cảm ơn bạn đã gửi yêu cầu! Chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất.'
                        );
                    contactForm.reset();
                });
            }
        });
    </script>
@endsection
