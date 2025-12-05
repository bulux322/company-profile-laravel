@extends('frontend.layouts.main')

@push('hero')
    <div class="hero-section inner-page">
        <!-- <div class="wave">

            <svg width="1920px" height="265px" viewBox="0 0 1920 265" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
                        <path
                            d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,667 L1017.15166,667 L0,667 L0,439.134243 Z"
                            id="Path"></path>
                    </g>
                </g>
            </svg>

        </div> -->

        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-md-7 text-center hero-text">
                            <h1 data-aos="fade-up" data-aos-delay="">Our Pricing</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endpush

@section('content')
    <section class="section">
        <div class="container">

            <div class="row justify-content-center text-center">
                <div class="col-md-7 mb-5">
                    <h2 class="section-heading">Choose A Product</h2>
                </div>
            </div>
            <div class="row align-items-stretch">

                @if ($pricing->count())
                    @foreach ($pricing as $item)
                        <div class="col-lg-4 my-4 mb-lg-0">
                            <div class="pricing h-100 text-center {{ $item->best ? 'popular' : '' }}">
                                @if (!$item->category)
                                    <span>&nbsp;</span>
                                @else
                                    <span class="popularity">{{ $item->category }}</span>
                                @endif
                                <h3>{{ $item->title }}</h3>
                                <ul class="list-unstyled">
                                    @if ($item->detail->count())
                                        @foreach ($item->detail as $value)
                                            <li>{{ $value->list }}</li>
                                        @endforeach
                                    @endif
                                </ul>
                                <div class="price-cta">
                                    <strong class="price">
                                        @if ($item->price > 0)
                                            @IDR($item->price)
                                            @if ($item->payment_period == \App\Models\Backend\Pricing\Pricing::MONTHLY_PAYMENT)
                                                /Month
                                            @elseif ($item->payment_period == \App\Models\Backend\Pricing\Pricing::ANNUAL_PAYMENT)
                                                /Year
                                            @endif
                                        @else
                                            Free
                                        @endif
                                    </strong>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <div class="pricing h-100 text-center">
                            <span>&nbsp;</span>
                            <h3>Basic</h3>
                            <ul class="list-unstyled">
                                <li>Create up to 5 forms</li>
                                <li>Generate 100 monthly reports</li>
                            </ul>
                            <div class="price-cta">
                                <strong class="price">Free</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <div class="pricing h-100 text-center popular">
                            <span class="popularity">Most Popular</span>
                            <h3>Professional</h3>
                            <ul class="list-unstyled">
                                <li>Create up to 20 forms</li>
                                <li>Generate 2500 monthly reports</li>
                                <li>Manage a team of up to 5 people</li>
                            </ul>
                            <div class="price-cta">
                                <strong class="price">$9.95/month</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <div class="pricing h-100 text-center">
                            <span class="popularity">Best Value</span>
                            <h3>Ultimate</h3>
                            <ul class="list-unstyled">
                                <li>Create up to 20 forms</li>
                                <li>Generate 2500 monthly reports</li>
                                <li>Manage a team of up to 5 people</li>
                            </ul>
                            <div class="price-cta">
                                <strong class="price">$199.95/month</strong>
                            </div>
                        </div>
                    </div>
                @endif


            </div>
        </div>
    </section>
@endsection
