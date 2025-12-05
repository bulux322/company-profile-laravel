<section class="section">
    <div class="container">

        <div class="row justify-content-center text-center mb-5">
            <div class="col-md-5" data-aos="fade-up">
                <h2 class="section-heading">About Us</h2>
                <p class="mb-5">
                    {{ CompanyHelper::description() ?? '...' }}
                </p>
            </div>
        </div>

        <div class="row">
            @if ($about->count())
                @foreach ($about as $item)
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 - 100 }}">
                        <div class="feature-1 text-center">
                            <div class="wrap-icon icon-1">
                                <i class="{{ $item->icon }}"></i>
                            </div>
                            <h3 class="mb-3">{{ $item->title }}</h3>
                            <p>{{ $item->subtitle }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="">
                    <div class="feature-1 text-center">
                        <div class="wrap-icon icon-1">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3 class="mb-3">Explore Your Team</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem, optio.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-1 text-center">
                        <div class="wrap-icon icon-1">
                            <i class="bi bi-brightness-high"></i>
                        </div>
                        <h3 class="mb-3">Digital Whiteboard</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem, optio.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-1 text-center">
                        <div class="wrap-icon icon-1">
                            <i class="bi bi-bar-chart"></i>
                        </div>
                        <h3 class="mb-3">Design To Development</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem, optio.</p>
                    </div>
                </div>
            @endif
        </div>

    </div>
</section>
