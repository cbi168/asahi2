@extends('layouts.frontend')

@section('title', '聯絡我們 - 朝日形象網站')

@push('styles')
<!-- jQuery Validation Plugin -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
@endpush

@section('content')
<!-- Hero 區塊：漸層背景 -->
<section class="contact-hero gradient-bg d-flex align-items-center" data-aos="fade-down">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center text-white">
                <h1 class="display-4 fw-bold mb-3">聯絡我們</h1>
                <p class="lead mb-0">我們隨時準備為您服務</p>
            </div>
        </div>
    </div>
</section>

<!-- 聯絡表單與資訊區塊 -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row">
                    <!-- 聯絡表單 -->
                    <div class="col-lg-8 mb-4" data-aos="fade-right">
                        <div class="card card-tech shadow-tech h-100">
                            <div class="card-body p-4 p-md-5">
                                <h2 class="h3 fw-bold mb-4 text-primary">
                                    <i class="bi bi-envelope me-2"></i>填寫表單
                                </h2>

                                <!-- 成功訊息 -->
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <!-- 錯誤訊息 -->
                                @if(session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <form id="contactForm" method="POST" action="{{ route('contact.submit') }}">
                                    @csrf

                                    <!-- 姓名 -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">
                                            姓名 <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                               class="form-control"
                                               id="name"
                                               name="name"
                                               value="{{ old('name') }}"
                                               placeholder="請填寫您的姓名"
                                               required>
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">
                                            Email <span class="text-danger">*</span>
                                        </label>
                                        <input type="email"
                                               class="form-control"
                                               id="email"
                                               name="email"
                                               value="{{ old('email') }}"
                                               placeholder="請填寫您的 Email"
                                               required>
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <!-- 電話 -->
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">
                                            電話 <span class="text-muted">(選填)</span>
                                        </label>
                                        <input type="tel"
                                               class="form-control"
                                               id="phone"
                                               name="phone"
                                               value="{{ old('phone') }}"
                                               placeholder="請填寫您的電話號碼">
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <!-- 主旨 -->
                                    <div class="mb-3">
                                        <label for="subject" class="form-label">
                                            主旨 <span class="text-muted">(選填)</span>
                                        </label>
                                        <input type="text"
                                               class="form-control"
                                               id="subject"
                                               name="subject"
                                               value="{{ old('subject') }}"
                                               placeholder="請填寫訊息主旨">
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <!-- 訊息內容 -->
                                    <div class="mb-4">
                                        <label for="message" class="form-label">
                                            訊息內容 <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control"
                                                  id="message"
                                                  name="message"
                                                  rows="6"
                                                  placeholder="請填寫您的訊息內容"
                                                  required>{{ old('message') }}</textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <!-- 提交按鈕 -->
                                    <div class="d-grid">
                                        <button type="submit"
                                                class="btn btn-gradient btn-lg py-3"
                                                id="submitBtn">
                                            <i class="bi bi-send me-2"></i>
                                            <span>送出訊息</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- 聯絡資訊 -->
                    <div class="col-lg-4 mb-4" data-aos="fade-left">
                        <div class="card card-tech shadow-tech h-100">
                            <div class="card-body p-4">
                                <h2 class="h3 fw-bold mb-4 text-primary">
                                    <i class="bi bi-info-circle me-2"></i>聯絡資訊
                                </h2>

                                <!-- 地址 -->
                                <div class="contact-info-item mb-4">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="contact-icon me-3">
                                            <i class="bi bi-geo-alt-fill text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="h6 fw-bold mb-1">公司地址</h5>
                                            <p class="mb-0 text-muted">
                                                台北市信義區信義路五段7號
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- 電話 -->
                                <div class="contact-info-item mb-4">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="contact-icon me-3">
                                            <i class="bi bi-telephone-fill text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="h6 fw-bold mb-1">聯絡電話</h5>
                                            <p class="mb-0 text-muted">
                                                <a href="tel:+886-2-1234-5678" class="text-decoration-none text-muted">
                                                    (02) 1234-5678
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="contact-info-item mb-4">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="contact-icon me-3">
                                            <i class="bi bi-envelope-fill text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="h6 fw-bold mb-1">Email</h5>
                                            <p class="mb-0 text-muted">
                                                <a href="mailto:info@asahi-tech.com.tw" class="text-decoration-none text-muted">
                                                    info@asahi-tech.com.tw
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- 營業時間 -->
                                <div class="contact-info-item">
                                    <div class="d-flex align-items-start">
                                        <div class="contact-icon me-3">
                                            <i class="bi bi-clock-fill text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="h6 fw-bold mb-1">營業時間</h5>
                                            <p class="mb-0 text-muted">
                                                週一至週五 9:00 - 18:00
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // 表單驗證
    $('#contactForm').validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            email: {
                required: true,
                email: true,
                maxlength: 255
            },
            phone: {
                maxlength: 20
            },
            subject: {
                maxlength: 255
            },
            message: {
                required: true
            }
        },
        messages: {
            name: {
                required: '請填寫您的姓名',
                maxlength: '姓名長度不能超過 255 個字元'
            },
            email: {
                required: '請填寫您的 Email',
                email: '請填寫有效的 Email 位址',
                maxlength: 'Email 長度不能超過 255 個字元'
            },
            phone: {
                maxlength: '電話長度不能超過 20 個字元'
            },
            subject: {
                maxlength: '主旨長度不能超過 255 個字元'
            },
            message: {
                required: '請填寫訊息內容'
            }
        },
        errorElement: 'div',
        errorClass: 'invalid-feedback d-block',
        highlight: function(element) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        },
        submitHandler: function(form) {
            // 防止重複提交
            const submitBtn = $('#submitBtn');
            submitBtn.prop('disabled', true);
            submitBtn.html('<i class="bi bi-hourglass-split me-2"></i><span>送出中...</span>');

            form.submit();
        }
    });
});
</script>
@endpush

<style>
.contact-hero {
    min-height: 400px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.contact-info-item {
    position: relative;
}

.contact-icon {
    font-size: 1.5rem;
    min-width: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.contact-info-item a:hover {
    color: #667eea !important;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.form-control.is-valid {
    background-image: none;
}

.form-control.is-invalid {
    background-image: none;
}

.btn-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-gradient:hover {
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
}

.btn-gradient:disabled {
    background: linear-gradient(135deg, #ccc 0%, #999 100%);
    cursor: not-allowed;
    transform: none;
}

@media (max-width: 768px) {
    .contact-hero {
        min-height: 300px;
    }

    .contact-hero .display-4 {
        font-size: 2rem;
    }

    .contact-info-item {
        margin-bottom: 1.5rem;
    }
}
</style>
