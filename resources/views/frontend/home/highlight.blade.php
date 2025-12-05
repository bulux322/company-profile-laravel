@if ($highlight->count())
    @foreach ($highlight as $key => $item)
        <section class="section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4 {{ $key % 2 == 0 ? 'me-auto' : 'ms-auto order-2' }}">
                        <h2 class="mb-4">{{ $item->title }}</h2>
                        <p class="mb-4">{{ $item->description }}</p>
                    </div>
                    <div class="col-md-6" data-aos="{{ $key % 2 == 0 ? 'fade-left' : 'fade-right' }}">
                        <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('assets/img/default.png') }}"
                            alt="Highlight" class="img-fluid" style="object-fit: contain; width: 400px; height: 400px;">
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@else
    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 me-auto">
                    <h2 class="mb-4">Seamlessly Communicate</h2>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur at
                        reprehenderit optio,
                        laudantium eius quod, eum maxime molestiae porro omnis. Dolores aspernatur delectus impedit
                        incidunt
                        dolore mollitia esse natus beatae.</p>
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <img src="{{ asset('assets/frontend/assets/img/undraw_svg_2.svg') }}" alt="Highlight" class="img-fluid"
                        style="object-fit: contain; width: 600px; height: 600px;">
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 ms-auto order-2">
                    <h2 class="mb-4">Gather Feedback</h2>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur at
                        reprehenderit optio,
                        laudantium eius quod, eum maxime molestiae porro omnis. Dolores aspernatur delectus impedit
                        incidunt
                        dolore mollitia esse natus beatae.</p>
                </div>
                <div class="col-md-6" data-aos="fade-right">
                    <img src="{{ asset('assets/frontend/assets/img/undraw_svg_3.svg') }}" alt="Highlight" class="img-fluid"
                        style="object-fit: contain; width: 600px; height: 600px;">
                </div>
            </div>
        </div>
    </section>
@endif
