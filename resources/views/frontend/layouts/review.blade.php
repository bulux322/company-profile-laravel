<section class="section border-top border-bottom">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-md-4">
                <h2 class="section-heading">Review From Our Users</h2>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-md-7">
                <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        @if (ReviewHelper::get()->count())
                            @foreach (ReviewHelper::get() as $item)
                                <div class="swiper-slide">
                                    <div class="review text-center">
                                        <p class="stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span
                                                    class="bi bi-star-fill {{ $i > $item->star ? 'muted' : '' }}"></span>
                                            @endfor
                                        </p>
                                        <h3>{{ $item->subject }}</h3>
                                        <blockquote>
                                            <p>{{ $item->message }}</p>
                                        </blockquote>
                                        <p class="review-user">
                                            <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('assets/img/default.png') }}"
                                                alt="Image" class="img-fluid rounded-circle mb-3"
                                                style="object-fit: contain; width: 100px; height: 100px;">
                                            <span class="d-block">
                                                <span class="text-white">{{ $item->name }}</span>, &mdash;
                                                {{ CompanyHelper::get() && CompanyHelper::get()['nickname'] ? CompanyHelper::get()['nickname'] : '#' }}
                                                User
                                            </span>
                                        </p>
                                    </div>
                                </div><!-- End testimonial item -->
                            @endforeach
                        @else
                            <div class="swiper-slide">
                                <div class="review text-center">
                                    <p class="stars">
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill muted"></span>
                                    </p>
                                    <h3>Excellent App!</h3>
                                    <blockquote>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius ea
                                            delectus pariatur, numquam
                                            aperiam dolore nam optio dolorem facilis itaque voluptatum recusandae
                                            deleniti minus animi,
                                            provident voluptates consectetur maiores quos.</p>
                                    </blockquote>
                                    <p class="review-user">
                                        <img src="{{ asset('assets/frontend/assets/img/person_1.jpg') }}" alt="Image"
                                            class="img-fluid rounded-circle mb-3">
                                        <span class="d-block">
                                            <span class="text-white">Jean Doe</span>, &mdash; App User
                                        </span>
                                    </p>

                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="review text-center">
                                    <p class="stars">
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill muted"></span>
                                    </p>
                                    <h3>This App is easy to use!</h3>
                                    <blockquote>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius ea
                                            delectus pariatur, numquam
                                            aperiam dolore nam optio dolorem facilis itaque voluptatum recusandae
                                            deleniti minus animi,
                                            provident voluptates consectetur maiores quos.</p>
                                    </blockquote>
                                    <p class="review-user">
                                        <img src="{{ asset('assets/frontend/assets/img/person_2.jpg') }}" alt="Image"
                                            class="img-fluid rounded-circle mb-3">
                                        <span class="d-block">
                                            <span class="text-white">Johan Smith</span>, &mdash; App User
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="review text-center">
                                    <p class="stars">
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill muted"></span>
                                    </p>
                                    <h3>Awesome functionality!</h3>
                                    <blockquote>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius ea
                                            delectus pariatur, numquam
                                            aperiam dolore nam optio dolorem facilis itaque voluptatum recusandae
                                            deleniti minus animi,
                                            provident voluptates consectetur maiores quos.</p>
                                    </blockquote>
                                    <p class="review-user">
                                        <img src="{{ asset('assets/frontend/assets/img/person_3.jpg') }}" alt="Image"
                                            class="img-fluid rounded-circle mb-3">
                                        <span class="d-block">
                                            <span class="text-white">Jean Thunberg</span>, &mdash; App User
                                        </span>
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>
