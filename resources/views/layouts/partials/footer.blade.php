@php
    $siteSettings = \App\Models\SiteSetting::current();
@endphp
<style>
    .footer {
        background: #1a1a1a;
        color: #fff;
        padding: 40px 0 20px; /* Reduced padding */
        font-size: 0.9rem; /* Smaller global font size */
    }

    .footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Reduced min-width */
        gap: 30px; /* Reduced gap */
        margin-bottom: 30px; /* Reduced margin */
    }

    .footer-section h3 {
        font-size: 1.1rem; /* Reduced heading size */
        margin-bottom: 15px;
        color: #d4af37;
        font-family: "Playfair Display", serif;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .footer-section p {
        color: rgba(255, 255, 255, 0.6);
        line-height: 1.6;
        font-size: 0.85rem;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 8px; /* Reduced spacing */
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
        transition: color 0.3s ease;
        font-size: 0.85rem;
    }

    .footer-links a:hover {
        color: #d4af37;
    }

    .social-links {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .social-links a {
        width: 32px; /* Smaller icons */
        height: 32px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: 0.8rem;
    }

    .social-links a:hover {
        background: #d4af37;
        transform: translateY(-2px);
    }

    .footer-bottom {
        text-align: center;
        padding-top: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.8rem;
    }
    
    .btn-submit {
        background: #d4af37;
        color: #fff;
        padding: 10px 20px; /* Smaller button */
        border: none;
        border-radius: 4px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.8rem;
    }

    .btn-submit:hover {
        background: #c9a961;
        transform: translateY(-2px);
    }

    #show-more-btn {
        display: inline-block;
        margin-top: 5px;
        font-size: 0.8rem;
        color: #d4af37;
        cursor: pointer;
        text-decoration: none;
    }
    
    #show-more-btn:hover {
        text-decoration: underline;
    }
</style>
<footer class="footer" id="contact">
    <div class="container">
    <div class="footer-grid">
        <!-- Brand Section -->
        <div class="footer-section brand-section">
        <h3>{{ $siteSettings->site_title ?? 'SNS Events' }}</h3>
        <p>{{ $siteSettings->footer_description ?? 'Creating unforgettable moments since 2010. Based in Texas, we transform your vision into reality.' }}</p>
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
            <li><a href="{{ url('/#services') }}">Services</a></li>
            <li><a href="{{ url('/#pricing') }}">Packages</a></li>
            <li><a href="{{ url('/#gallery') }}">Gallery</a></li>
        </ul>
        </div>

        <div class="footer-section">
        <h3>Services</h3>
        <ul class="footer-links" id="services-list">
            <li><a href="{{ url('/#services') }}">Weddings</a></li>
            <li><a href="{{ url('/#services') }}">Corporate Events</a></li>
            <li><a href="{{ url('/#services') }}">Birthdays</a></li>
            <li><a href="{{ url('/#services') }}">Holud Ceremonies</a></li>
            <li class="more-service" style="display: none;"><a href="{{ url('/#services') }}">Marriage Proposals</a></li>
            <li class="more-service" style="display: none;"><a href="{{ url('/#services') }}">Receptions</a></li>
            <li class="more-service" style="display: none;"><a href="{{ url('/#services') }}">Graduations</a></li>
            <li class="more-service" style="display: none;"><a href="{{ url('/#services') }}">Anniversaries</a></li>
        </ul>
        <a href="javascript:void(0)" onclick="toggleServices()" id="show-more-btn">Show More <i class="fas fa-chevron-down"></i></a>
        </div>

        <div class="footer-section">
        <h3>Newsletter</h3>
        <p style="margin-bottom: 15px;">
            Subscribe to our newsletter for exclusive offers!
        </p>
        <form>
            <input
            type="email"
            placeholder="Your email"
            style="
                width: 100%;
                padding: 10px;
                border: none;
                border-radius: 4px;
                margin-bottom: 8px;
                background: rgba(255,255,255,0.1);
                color: white;
                font-size: 0.85rem;
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

<script>
    function toggleServices() {
        const moreServices = document.querySelectorAll('.more-service');
        const btn = document.getElementById('show-more-btn');
        const isHidden = moreServices[0].style.display === 'none';
        
        moreServices.forEach(item => {
            item.style.display = isHidden ? 'block' : 'none';
        });
        
        if (isHidden) {
            btn.innerHTML = 'Show Less <i class="fas fa-chevron-up"></i>';
        } else {
            btn.innerHTML = 'Show More <i class="fas fa-chevron-down"></i>';
        }
    }
</script>
