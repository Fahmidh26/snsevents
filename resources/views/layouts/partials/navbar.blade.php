<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        @if(isset($siteSettings) && $siteSettings->logo_path)
            <img src="{{ asset('storage/' . $siteSettings->logo_path) }}" alt="SNS Events" style="height: 36px;">
        @else
            SNS Events
        @endif
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav" 
        aria-expanded="false" 
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/#home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/#about') }}">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('events.*') ? 'active' : '' }}" href="{{ route('events.index') }}">Events</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('custom-package') ? 'active' : '' }}" href="{{ route('custom-package') }}">Custom Package</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/#gallery') }}">Gallery</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/#testimonials') }}">Testimonials</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/#faq') }}">FAQ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/#contact') }}">Contact</a>
          </li>
        </ul>
      </div>
    </div>
</nav>
