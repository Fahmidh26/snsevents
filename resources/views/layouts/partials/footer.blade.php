@php
    $siteSettings = \App\Models\SiteSetting::current();
@endphp
<style>
    .footer {
        background: #1a1a1a;
        color: #fff;
        padding: 60px 0 20px;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
        margin-bottom: 40px;
    }

    .footer-section h3 {
        font-size: 1.5rem;
        margin-bottom: 20px;
        color: #d4af37;
        font-family: "Playfair Display", serif;
    }

    .footer-section p {
        color: rgba(255, 255, 255, 0.7);
        line-height: 1.8;
    }

    .footer-links {
        list-style: none;
        padding: 0;
    }

    .footer-links li {
        margin-bottom: 12px;
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-links a:hover {
        color: #d4af37;
    }

    .social-links {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }

    .social-links a {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .social-links a:hover {
        background: #d4af37;
        transform: translateY(-3px);
    }

    .footer-bottom {
        text-align: center;
        padding-top: 30px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.7);
    }
    
    .btn-submit {
        background: #d4af37;
        color: #fff;
        padding: 12px 25px;
        border: none;
        border-radius: 5px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        background: #c9a961;
        transform: translateY(-2px);
    }
</style>
<footer class="footer" id="contact">
    <div class="container">
    <div class="footer-grid">
        <!-- Brand Section -->
        <div class="footer-section brand-section">
        <h3>{{ $siteSettings->site_title }}</h3>
        <p>{{ $siteSettings->footer_description ?? 'Creating unforgettable moments since 2010. based in Texas, we transform your vision into reality.' }}</p>
        <div class="social-links">
            @if($siteSettings->facebook_url)
            <a href="{{ $siteSettings->facebook_url }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
            @endif
            @if($siteSettings->instagram_url)
            <a href="{{ $siteSettings->instagram_url }}" target="_blank"><i class="fab fa-instagram"></i></a>
            @endif
            @if($siteSettings->twitter_url)
            <a href="{{ $siteSettings->twitter_url }}" target="_blank"><i class="fab fa-twitter"></i></a>
            @endif
            @if($siteSettings->linkedin_url)
            <a href="{{ $siteSettings->linkedin_url }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
            @endif
        </div>
        </div>

        <div class="footer-section">
        <h3>Quick Links</h3>
        <ul class="footer-links">
            <li><a href="{{ url('/#home') }}">Home</a></li>
            <li><a href="{{ url('/#about') }}">About Us</a></li>
            <li><a href="{{ url('/#ceo') }}">Vision</a></li>
            <li><a href="{{ url('/#services') }}">Services</a></li>
            <li><a href="{{ url('/#pricing') }}">Packages</a></li>
            <li><a href="{{ url('/#gallery') }}">Gallery</a></li>
            <li><a href="{{ url('/#contact') }}">Contact</a></li>
        </ul>
        </div>

        <div class="footer-section">
        <h3>Event Types</h3>
        <ul class="footer-links">
            <li><a href="{{ url('/#services') }}">Weddings</a></li>
            <li><a href="{{ url('/#services') }}">Corporate Events</a></li>
            <li><a href="{{ url('/#services') }}">Birthdays</a></li>
            <li><a href="{{ url('/#services') }}">Holud Ceremonies</a></li>
            <li><a href="{{ url('/#services') }}">Marriage Proposals</a></li>
            <li><a href="{{ url('/#services') }}">Receptions</a></li>
            <li><a href="{{ url('/#services') }}">Graduations</a></li>
            <li><a href="{{ url('/#services') }}">Anniversaries</a></li>
        </ul>
        </div>

        <div class="footer-section">
        <h3>Newsletter</h3>
        <p>
            Subscribe to our newsletter for event planning tips and exclusive
            offers!
        </p>
        <form style="margin-top: 20px">
            <input
            type="email"
            placeholder="Your email"
            style="
                width: 100%;
                padding: 12px;
                border: none;
                border-radius: 5px;
                margin-bottom: 10px;
            "
            />
            <button type="submit" class="btn-submit" style="width: 100%">
            Subscribe
            </button>
        </form>
        </div>
    </div>

    <div class="footer-bottom">
        <p>
        {{ $siteSettings->footer_text ?? '&copy; ' . date('Y') . ' SNS Events. All rights reserved.' }} |
        <a href="{{ route('privacy-policy') }}" style="color: inherit">Privacy Policy</a> |
        <a href="{{ route('terms-and-conditions') }}" style="color: inherit">Terms of Service</a>
        </p>
    </div>
    </div>
</footer>
