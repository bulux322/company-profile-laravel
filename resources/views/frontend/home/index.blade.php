@push('styles')
<style>
.hero-section {
    background: linear-gradient(to right, rgba(39, 70, 133, 0.8) 40%, rgba(61, 179, 197, 0.8) 100%),
                url('{{ $hero && $hero->background_image ? asset('storage/' . $hero->background_image) : asset('assets/frontend/assets/img/hero-bg.jpg') }}');
    background-size: cover;
    background-position: center;
}
</style>
@endpush
@extends('frontend.layouts.main')

@push('hero')
    <section class="hero-section" id="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 hero-text-image">
                    <div class="row">
                        <div class="col-lg-8 text-center text-lg-start">
                            <h1 data-aos="fade-right">
                                {{ $hero && $hero->title ? $hero->title : 'Selamat Datang di Company Profile' }}
                            </h1>
                            <p class="mb-5" data-aos="fade-right" data-aos-delay="100">
                                {{ $hero && $hero->subtitle ? $hero->subtitle : 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.' }}
                            </p>
                            <p data-aos="fade-right" data-aos-delay="200" data-aos-offset="-500"><a href="{{ route('frontend.feature.index') }}"
                                    class="btn btn-outline-white">Get started</a></p>
                        </div>
                        <div class="col-lg-4 text-center text-lg-end">
                            <img src="{{ $hero && $hero->image ? asset('storage/' . $hero->image) : asset('assets/frontend/assets/img/headlinepic.png') }}"
                                alt="Hero Image" data-aos="fade-right"
                                style="object-fit: contain; width: 500px; height: 200px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endpush

@section('content')
    <!-- ======= about Section ======= -->
    @include('frontend.home.about')

    <!-- ======= highlight Section ======= -->     
    @include('frontend.home.highlight')

    <!-- ======= Testimonials Section ======= -->
    @include('frontend.layouts.review')
    
@endsection
