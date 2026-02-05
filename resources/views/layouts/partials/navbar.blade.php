<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        @if(isset($siteSettings) && $siteSettings->logo_path)
            <img src="{{ asset('storage/' . $siteSettings->logo_path) }}" alt="SNS Events" style="height: 70px;">
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
          @if(isset($navbarItems))
              @foreach($navbarItems as $item)
                @php
                    $isActive = false;
                    if ($item->type === 'route' && $item->route_name) {
                        $isActive = request()->routeIs($item->route_name . '*');
                    } else if ($item->url) {
                         $isActive = request()->is(ltrim($item->url, '/'));
                    }
                @endphp
                
                @if($item->children->count() > 0)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          {{ $item->label }}
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($item->children as $child)
                                <li>
                                    <a class="dropdown-item" href="{{ $child->type === 'route' ? route($child->route_name) : url($child->url) }}">
                                        {{ $child->label }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ $isActive ? 'active' : '' }}" href="{{ $item->type === 'route' ? route($item->route_name) : url($item->url) }}">
                            {{ $item->label }}
                        </a>
                    </li>
                @endif
              @endforeach
          @else
              <!-- Fallback if variable is missing (e.g. error in provider) -->
              <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('services.index') }}">Services</a></li>
          @endif
        </ul>
      </div>
    </div>
</nav>
