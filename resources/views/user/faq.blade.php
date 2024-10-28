@extends('layouts.dashboard-user')

@section('contents')
<body style="margin: 0; padding: 0; font-family: Poppins, sans-serif; background-color: #f0f0f0;">
    <section id="hero" class="hero d-flex" style="min-height: 100vh; margin-bottom: 0px; position: relative; background: url('{{ asset('assets/img/bg.jpeg') }}') center center/cover no-repeat;">
        <div class="overlay" style="background-color: rgba(157, 200, 148, 0.8); position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div>
        <div class="container" style="position: relative; z-index: 2;">
            <div class="d-flex justify-content-center" style="width: 100%; padding: 80px 0;">
                <div class="container" data-aos="fade-up" style="max-width: 1200px;">

                    <button type="button" class="btn-close" aria-label="Close" onclick="window.location.href='/homeuser'"></button>
                    <h1 style="text-align: center; font-size: 1.7rem; font-weight: bold;">Frequently Asked Questions (FAQ)</h1>
                    <hr/>

                    <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-lg-10">
                            <div class="accordion accordion-flush" id="faqlist">
                                @foreach($faqs as $index => $faq)
                                <!-- accordion untuk menampung pertanyaan dan jawaban -->
                                <div class="accordion-item">
                                    <h3 class="accordion-header" id="faq-heading-{{ $index }}">
                                        <button class="accordion-button collapsed" style="font-size: 16px;" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq-content-{{ $index }}" aria-expanded="false"
                                            aria-controls="faq-content-{{ $index }}">
                                            <i class="bi bi-question-circle question-icon"></i>
                                            <strong>{{ $faq->pertanyaan }}</strong>
                                        </button>
                                    </h3>
                                    <div id="faq-content-{{ $index }}" class="accordion-collapse collapse" aria-labelledby="faq-heading-{{ $index }}"
                                        data-bs-parent="#faqlist">
                                        <!-- untuk menampilkan jawaban -->
                                        <div class="accordion-body" style="font-size: 16px;">
                                            {{ $faq->jawaban }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</body>
@endsection
