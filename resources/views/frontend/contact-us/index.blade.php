@extends('frontend.layouts.main')

@push('hero')
    <section class="hero-section inner-page">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-md-7 text-center hero-text">
                            <h1 data-aos="fade-up" data-aos-delay="">Get in touch</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endpush

@section('content')
    <section class="section">
        <div class="container">
            <div class="row mb-5 align-items-end">
                <div class="col-md-6" data-aos="fade-up">
                    <h2>Contact Form</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 ms-auto order-2" data-aos="fade-up">
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="bi bi-geo-alt me-2 fs-4" aria-hidden="true"></i>
                            <div>
                                <strong class="d-block mb-1">Address</strong>
                                <span>{{ $company && $company->address ? $company->address : '203 Fake St. Mountain View, San Francisco, California, USA' }}</span>
                            </div>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="bi bi-phone me-2 fs-4" aria-hidden="true"></i>
                            <div>
                                <strong class="d-block mb-1">Phone</strong>
                                <span>{{ $company && $company->phone_number ? $company->phone_number : '+1 232 3235 324' }}</span>
                            </div>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="bi bi-envelope me-2 fs-4" aria-hidden="true"></i>
                            <div>
                                <strong class="d-block mb-1">Email</strong>
                                <span>{{ $company && $company->email ? $company->email : 'youremail@domain.com' }}</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="col-md-6 mb-5 mb-md-0" data-aos="fade-up">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <label for="name">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="col-md-12 form-group mt-3">
                                <label for="name">Subject</label>
                                <input type="text" class="form-control" name="subject" id="subject" required>
                            </div>
                            <div class="col-md-12 form-group mt-3">
                                <label for="name">Message</label>
                                <textarea class="form-control" name="message" required></textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>

                            <div class="col-md-6 form-group">
                                {{-- <input type="submit" class="btn btn-primary d-block w-100" value="Send Message"> --}}
                                <button type="button" class="btn btn-primary d-block w-100"
                                    onclick="return alert('This function is not ready yet!')">Send Message</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection
