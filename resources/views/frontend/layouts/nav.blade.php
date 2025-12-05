<nav id="navbar" class="navbar">
    <ul>
        <li><a class="{{ Request::is('home*') ? 'active' : '' }}" href="{{ route('frontend.home.index') }}">Home</a></li>
        <li><a class="{{ Request::is('feature*') ? 'active' : '' }}"
                href="{{ route('frontend.feature.index') }}">Features</a></li>
        <li><a class="{{ Request::is('pricing*') ? 'active' : '' }}"
                href="{{ route('frontend.pricingindex') }}">Pricing</a></li>
        <li><a class="{{ Request::is('blog*') ? 'active' : '' }}" href="{{ route('frontend.blog.index') }}">Blog</a></li>
        <!-- dropdown menu -->
        <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="#">Drop Down 1</a></li>                
                <li><a href="#">Drop Down 2</a></li>
                <li><a href="#">Drop Down 3</a></li>
                <li><a href="#">Drop Down 4</a></li>
                <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i
                            class="bi bi-chevron-right"></i></a>
                    <ul>
                        <li><a href="#">Deep Drop Down 1</a></li>
                        <li><a href="#">Deep Drop Down 2</a></li>
                        <li><a href="#">Deep Drop Down 3</a></li>
                        <li><a href="#">Deep Drop Down 4</a></li>
                        <li><a href="#">Deep Drop Down 5</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><a class="{{ Request::is('contact-us*') ? 'active' : '' }}"
                href="{{ route('frontend.contact-us.index') }}">Contact Us</a></li>
    </ul>
    <i class="bi bi-list mobile-nav-toggle"></i>
</nav>
