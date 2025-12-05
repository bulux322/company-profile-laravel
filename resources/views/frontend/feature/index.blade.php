@extends('frontend.layouts.main')

@push('hero')
    <section class="hero-section inner-page">       
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-md-7 text-center hero-text">
                            <h1 data-aos="fade-up" data-aos-delay="">
                                {{ CompanyHelper::get() && CompanyHelper::get()['nickname'] ? CompanyHelper::get()['nickname'] : '#' }}
                                Features</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endpush

@section('content')
    @if ($feature->count())
        @foreach ($feature as $key => $item)
            <section class="section {{ $key % 2 == 0 ? 'pb-0' : '' }}">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-4 {{ $key % 2 == 0 ? 'me-auto' : 'ms-auto order-2' }}">
                            <h2 class="mb-4">{{ $item->title }}</h2>
                            <p class="mb-4">{{ $item->description }}</p>
                        </div>
                        <div class="col-md-6" data-aos="{{ $key % 2 == 0 ? 'fade-left' : 'fade-right' }}">
                            <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('assets/img/default.png') }}"
                                alt="Image" class="img-fluid" style="object-fit: contain; width: 600px; height: 600px;">
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    @else
        <section class="section pb-0">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4 me-auto">
                        <h2 class="mb-4">Seamlessly Communicate</h2>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur at reprehenderit
                            optio, laudantium eius quod, eum maxime molestiae porro omnis. Dolores aspernatur delectus
                            impedit
                            incidunt dolore mollitia esse natus beatae.</p>
                    </div>
                    <div class="col-md-6" data-aos="fade-left">
                        <img src="assets/frontend/assets/img/undraw_svg_2.svg" alt="Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4 ms-auto order-2">
                        <h2 class="mb-4">Gather Feedback</h2>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur at reprehenderit
                            optio, laudantium eius quod, eum maxime molestiae porro omnis. Dolores aspernatur delectus
                            impedit
                            incidunt dolore mollitia esse natus beatae.</p>
                    </div>
                    <div class="col-md-6" data-aos="fade-right">
                        <img src="assets/frontend/assets/img/undraw_svg_3.svg" alt="Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>

        <section class="section pb-0">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4 me-auto">
                        <h2 class="mb-4">Present Designs Inspiration</h2>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur at reprehenderit
                            optio, laudantium eius quod, eum maxime molestiae porro omnis. Dolores aspernatur delectus
                            impedit
                            incidunt dolore mollitia esse natus beatae.</p>
                    </div>
                    <div class="col-md-6" data-aos="fade-left">
                        <img src="assets/frontend/assets/img/undraw_svg_3.svg" alt="Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4 ms-auto order-2">
                        <h2 class="mb-4">Powerful App Design </h2>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur at reprehenderit
                            optio, laudantium eius quod, eum maxime molestiae porro omnis. Dolores aspernatur delectus
                            impedit
                            incidunt dolore mollitia esse natus beatae.</p>
                    </div>
                    <div class="col-md-6" data-aos="fade-right">
                        <img src="assets/frontend/assets/img/undraw_svg_4.svg" alt="Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
