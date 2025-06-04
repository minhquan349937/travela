@extends('layout')
@section('content')
    <div class="container">
        <div class="about-header">
            <h1>CÔNG TY DU LỊCH VIỆT NAM TRAVEL</h1>
            <p class="subtitle">Đồng hành cùng trải nghiệm của bạn</p>
        </div>

        <div class="row about-intro">
            <div class="col-md-6">
                <div class="intro-content">
                    <h2>Về Chúng Tôi</h2>
                    <p>Với hơn 10 năm kinh nghiệm trong lĩnh vực du lịch, Việt Nam Travel tự hào là đơn vị tiên phong trong
                        việc mang đến những trải nghiệm du lịch độc đáo và chất lượng.</p>
                    <ul class="achievement-list">
                        <li><i class="fa fa-check-circle"></i> Top 10 công ty du lịch uy tín nhất Việt Nam</li>
                        <li><i class="fa fa-check-circle"></i> Phục vụ hơn 100,000+ khách hàng mỗi năm</li>
                        <li><i class="fa fa-check-circle"></i> Đối tác của các hãng hàng không hàng đầu</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('frontend/imgs/about-img.jpg') }}" alt="About Us" class="img-fluid rounded shadow">
            </div>
        </div>

        <div class="row services-section">
            <div class="col-12 text-center">
                <h2>Dịch Vụ Của Chúng Tôi</h2>
                <p class="section-description">Đa dạng lựa chọn cho mọi nhu cầu du lịch của bạn</p>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <i class="fas fa-plane-departure"></i>
                    <h3>Tour Trong Nước</h3>
                    <p>Khám phá vẻ đẹp Việt Nam với các tour được thiết kế độc đáo</p>
                    <ul>
                        <li>Tour miền Bắc</li>
                        <li>Tour miền Trung</li>
                        <li>Tour miền Nam</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <i class="fas fa-globe-americas"></i>
                    <h3>Tour Quốc Tế</h3>
                    <p>Trải nghiệm văn hóa đa dạng với các tour quốc tế hấp dẫn</p>
                    <ul>
                        <li>Châu Á</li>
                        <li>Châu Âu</li>
                        <li>Châu Mỹ</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <i class="fas fa-hotel"></i>
                    <h3>Dịch Vụ Cao Cấp</h3>
                    <p>Đặt phòng khách sạn và các dịch vụ du lịch cao cấp</p>
                    <ul>
                        <li>Khách sạn 5 sao</li>
                        <li>Xe sang đưa đón</li>
                        <li>Hướng dẫn viên chuyên nghiệp</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="contact-section">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-info">
                        <h2>Liên Hệ Với Chúng Tôi</h2>
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <p>83 Nguyễn Thị Minh Khai, Quận Hải Châu, Thành phố Đà Nẵng</p>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-phone"></i>
                            <p>Hotline: 0383041692</p>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-envelope"></i>
                            <p>Email: contact@vietnamtravel.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="working-hours">
                        <h2>Giờ Làm Việc</h2>
                        <ul>
                            <li><span>Thứ 2 - Thứ 6:</span> 8:00 - 17:30</li>
                            <li><span>Thứ 7:</span> 8:00 - 12:00</li>
                            <li><span>Chủ nhật:</span> Nghỉ</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .about-header {
            text-align: center;
            padding: 60px 0;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('frontend/imgs/banner.jpg') }}');
            background-size: cover;
            color: white;
            margin-bottom: 50px;
        }

        .about-header h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .subtitle {
            font-size: 1.2rem;
            font-style: italic;
        }

        .about-intro {
            margin-bottom: 60px;
        }

        .intro-content {
            padding: 30px;
        }

        .achievement-list {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        .achievement-list li {
            margin-bottom: 15px;
            color: #555;
        }

        .achievement-list i {
            color: #28a745;
            margin-right: 10px;
        }

        .services-section {
            padding: 60px 0;
            background: #f8f9fa;
        }

        .section-description {
            color: #666;
            margin-bottom: 40px;
        }

        .service-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-10px);
        }

        .service-card i {
            font-size: 3rem;
            color: #007bff;
            margin-bottom: 20px;
        }

        .service-card h3 {
            color: #333;
            margin-bottom: 15px;
        }

        .service-card ul {
            list-style: none;
            padding: 0;
            margin-top: 15px;
        }

        .service-card ul li {
            color: #666;
            margin-bottom: 8px;
        }

        .contact-section {
            padding: 60px 0;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .info-item i {
            font-size: 1.5rem;
            color: #007bff;
            margin-right: 15px;
            width: 30px;
        }

        .working-hours {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
        }

        .working-hours ul {
            list-style: none;
            padding: 0;
        }

        .working-hours li {
            margin-bottom: 15px;
            color: #555;
        }

        .working-hours span {
            font-weight: bold;
            margin-right: 10px;
        }
    </style>
@endsection
