<footer class="footer" role="contentinfo">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <h3>About
                    {{ CompanyHelper::get() && CompanyHelper::get()['nickname'] ? CompanyHelper::get()['nickname'] : '#' }}
                </h3>
                <p>{{ CompanyHelper::description() ?? '...' }}</p>
                <p class="social">
                    @if (FooterHelper::socialMedia()->count())
                        @foreach (FooterHelper::socialMedia() as $item)
                            <a href="{{ $item->url }}" target="_blank"><span class="{{ $item->icon }}"></span></a>
                        @endforeach
                    @endif
                </p>
            </div>
            <div class="col-md-7 ms-auto">
                <div class="row site-section pt-0">
                    <div class="col-md-8 mb-4 mb-md-0 ms-auto">
                        <h3>Navigation</h3>
                        <ul class="list-unstyled">
                            @if (FooterHelper::navigation()->count())
                                @foreach (FooterHelper::navigation() as $item)
                                    <li><a href="{{ $item->url }}" target="_blank">{{ $item->name }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center text-center">
            <div class="col-md-7">
                <p class="copyright">&copy; Copyright Company. All Rights Reserved</p>
                <div class="credits">
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>
            </div>
        </div>

    </div>
</footer>
