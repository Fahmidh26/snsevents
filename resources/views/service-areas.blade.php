<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $seo->title ?? 'Areas We Serve - SNS Events' }}</title>
    <meta name="description" content="{{ $seo->meta_description ?? 'Explore the locations we serve across Texas.' }}" />
    <meta name="keywords" content="{{ $seo->meta_keywords ?? 'service areas, texas event locations' }}" />
    
    <!-- Favicon -->
    @if(isset($siteSettings) && $siteSettings->favicon_path)
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $siteSettings->favicon_path) }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/' . $siteSettings->favicon_path) }}">
    @endif

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}" />
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap"
      rel="stylesheet"
    />

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    <style>
      :root {
        /* Enhanced Premium Color Palette */
        --primary-color: #c9a227;
        --secondary-color: #0f0f0f;
        --accent-color: #d4af37;
        --surface-white: #ffffff;
        --text-dark: #1a1a1a;
        --text-light: #666666;
        
        --primary-gradient: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 50%, #e0c158 100%);
        --light-bg: #fafafa;
        
        --shadow-xs: 0 1px 3px rgba(0,0,0,0.04);
        --shadow-sm: 0 2px 8px rgba(0,0,0,0.06);
        --shadow-md: 0 8px 24px rgba(0,0,0,0.08);
        --shadow-lg: 0 15px 40px rgba(0,0,0,0.12);
      }

      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: "Poppins", sans-serif;
        color: var(--text-dark);
        overflow-x: hidden;
        background-color: var(--light-bg);
      }

      h1, h2, h3, h4, h5, h6 {
        font-family: "Playfair Display", serif;
      }

      /* Navbar */
      .navbar {
        background: rgba(10, 10, 10, 0.95);
        backdrop-filter: blur(12px);
        padding: 10px 0;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      }
      
      .navbar-brand {
        font-family: "Playfair Display", serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color) !important;
        text-transform: uppercase;
        letter-spacing: 2px;
      }

      /* Page Hero */
      .page-hero {
        position: relative;
        height: 40vh;
        min-height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.5)), url('{{ $pageSettings->hero_image_path ? asset('storage/' . $pageSettings->hero_image_path) : "https://images.unsplash.com/photo-1519167758481-83f29da8c8f0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" }}') no-repeat center center/cover;
        color: #fff;
        text-align: center;
        margin-top: 76px;
        background-attachment: fixed;
      }
      
      .page-hero-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        padding: 0 20px;
      }
      
      .page-hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 15px;
        text-shadow: 0 4px 15px rgba(0,0,0,0.3);
        letter-spacing: 2px;
      }
      
      .page-hero p {
        font-size: 1.2rem;
        font-weight: 300;
        letter-spacing: 1px;
        opacity: 0.9;
      }

      /* Map & List Layout */
      .content-wrapper {
        position: relative;
        padding: 60px 0 80px 0;
        z-index: 10;
      }

      .listing-container {
        background: #fff;
        border-radius: 20px;
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        min-height: 800px;
        display: flex;
        flex-direction: column;
      }

      @media (min-width: 992px) {
        .listing-row {
            display: flex;
            height: 800px; /* Fixed height for sticky desktop view */
        }
        
        .list-column {
            width: 40%;
            overflow-y: auto;
            border-right: 1px solid rgba(0,0,0,0.05);
            /* Custom Scrollbar */
            scrollbar-width: thin;
            scrollbar-color: rgba(201, 162, 39, 0.3) transparent;
        }

        .list-column::-webkit-scrollbar {
            width: 6px;
        }
        
        .list-column::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .list-column::-webkit-scrollbar-thumb {
            background-color: rgba(201, 162, 39, 0.3);
            border-radius: 20px;
        }

        .map-column {
            width: 60%;
            height: 100%;
        }
      }

      @media (max-width: 991px) {
        .listing-row {
            flex-direction: column-reverse;
            height: auto;
        }
        .list-column {
            width: 100%;
            max-height: 500px;
            overflow-y: auto;
        }
        .map-column {
            width: 100%;
            height: 400px;
        }
      }

      /* List Items */
      .location-item {
        padding: 25px 30px;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        cursor: pointer;
        transition: all 0.3s ease;
        background: #fff;
        position: relative;
      }

      .location-item:hover {
        background: color-mix(in srgb, var(--primary-color) 3%, white);
        padding-left: 35px;
      }

      .location-item.active-location {
        background: color-mix(in srgb, var(--primary-color) 8%, white);
        border-left: 4px solid var(--primary-color);
        padding-left: 30px; /* Adjust for border */
      }

      .location-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 8px;
      }

      .location-header h3 {
        font-size: 1.25rem;
        color: var(--secondary-color);
        margin: 0;
        font-weight: 600;
      }

      .location-meta {
        font-size: 0.9rem;
        color: var(--text-light);
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 12px;
      }

      .location-meta i {
        color: var(--primary-color);
        width: 16px;
      }

      .location-desc {
        font-size: 0.9rem;
        color: var(--text-light);
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
      }

      .btn-map-link {
        font-size: 0.85rem;
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-top: 10px;
        transition: transform 0.2s ease;
      }
      
      .btn-map-link:hover {
        transform: translateX(3px);
        color: var(--accent-color);
      }

      /* Map Styles */
      #map {
        width: 100%;
        height: 100%;
        z-index: 1;
      }

      /* Custom Marker */
      .custom-div-icon {
        background: transparent;
        border: none;
      }
      
      .pin-marker {
        width: 36px;
        height: 36px;
        background-color: var(--primary-color);
        border-radius: 50% 50% 50% 0;
        transform: rotate(-45deg);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        position: relative;
        transition: all 0.3s ease;
        border: 2px solid #fff;
      }
      
      .pin-marker::after {
        content: '';
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #fff;
        transform: rotate(45deg);
      }
      
      .pin-marker.active-pin {
        background-color: var(--secondary-color);
        transform: scale(1.2) rotate(-45deg);
        z-index: 1000 !important;
      }

      /* Contact Section */
      .contact-banner {
        text-align: center;
        margin-top: 60px;
        padding: 60px;
        background: #fff;
        border-radius: 20px;
        box-shadow: var(--shadow-sm);
        border-top: 5px solid var(--primary-color);
      }
      
      .btn-contact-custom {
          background: var(--primary-gradient);
          color: #fff;
          padding: 16px 45px;
          border: none;
          border-radius: 50px;
          font-weight: 700;
          text-decoration: none;
          display: inline-block;
          transition: all 0.3s ease;
          box-shadow: 0 4px 15px rgba(201, 162, 39, 0.4);
          text-transform: uppercase;
          letter-spacing: 1px;
          font-size: 0.95rem;
      }
      .btn-contact-custom:hover {
          transform: translateY(-3px);
          box-shadow: 0 8px 25px rgba(201, 162, 39, 0.6);
          color: #fff;
          background: var(--accent-color);
      }
    </style>
  </head>
  <body>

    <!-- Navbar -->
    @include('layouts.partials.navbar')

    <!-- Page Hero -->
    <section class="page-hero">
        <div class="page-hero-content" data-aos="fade-up">
            <h1>{{ $pageSettings->heading ?? 'Areas We Serve' }}</h1>
            <p>{{ $pageSettings->subheading ?? 'Bringing The Magic To Your Neighborhood' }}</p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container content-wrapper">
        
        <!-- Header Text -->
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="mb-3" style="color: var(--secondary-color);">Serving Texas with Excellence</h2>
            <p class="text-muted" style="max-width: 700px; margin: 0 auto; font-size: 1.1rem;">
                SNS Events is proud to bring premium event planning and decoration services to major cities and distinct communities across Texas. Select a location to view details.
            </p>
        </div>

        <!-- Interactive Map and List -->
        <div class="listing-container" data-aos="fade-up">
            <div class="listing-row">
                <!-- List Column -->
                <div class="list-column">
                    @forelse($serviceAreas as $index => $area)
                    <div class="location-item" 
                         data-index="{{ $index }}"
                         onclick="focusOnLocation({{ $index }})">
                        
                        <div class="location-header">
                            <h3>{{ $area->name }}</h3>
                            <i class="fas fa-chevron-right text-muted opacity-50"></i>
                        </div>
                        
                        <div class="location-meta">
                            <span><i class="fas fa-map-marker-alt"></i> {{ $area->city }}, {{ $area->state }}</span>
                            @if($area->zip_code)
                            <span><i class="fas fa-envelope"></i> {{ $area->zip_code }}</span>
                            @endif
                        </div>
                        
                        <div class="location-desc">
                            {{ $area->description ?? "Expert event decoration services in {$area->name}. We bring premium quality and elegant designs to your special events." }}
                        </div>

                        @if($area->map_url)
                        <a href="{{ $area->map_url }}" target="_blank" class="btn-map-link" onclick="event.stopPropagation()">
                            View on Google Maps <i class="fas fa-external-link-alt"></i>
                        </a>
                        @endif
                    </div>
                    @empty
                    <div class="p-5 text-center">
                        <p class="text-muted">No specific service areas listed yet, but we serve all major Texas cities.</p>
                    </div>
                    @endforelse
                </div>

                <!-- Map Column -->
                <div class="map-column">
                    <div id="map"></div>
                </div>
            </div>
        </div>
        
        <!-- CTA -->
        <div class="contact-banner" data-aos="fade-up">
            <h3 class="h2 mb-3">Don't see your city?</h3>
            <p class="mb-4 text-muted" style="font-size: 1.1rem;">We often travel to surrounding areas and can accommodate destination events throughout Texas and beyond.</p>
            <a href="{{ url('/#contact') }}" class="btn-contact-custom">Contact Us To Discuss</a>
        </div>

    </div>

    <!-- Footer -->
    @include('layouts.partials.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
      AOS.init({ duration: 1000, once: true });

      // --- Map Logic ---
      @php
        $locationsData = $serviceAreas->map(function($area) {
            return [
                'name' => $area->name,
                'city' => $area->city,
                'state' => $area->state,
                'description' => \Illuminate\Support\Str::limit($area->description ?? "Premium event services in {$area->name}.", 100)
            ];
        });
      @endphp
      const locations = @json($locationsData);

      let map;
      let markers = [];
      // Cache for coordinates to avoid hammering Nominatim
      const cityCache = {
            'dallas': [32.7767, -96.7970],
            'houston': [29.7604, -95.3698],
            'austin': [30.2672, -97.7431],
            'san antonio': [29.4241, -98.4936],
            'fort worth': [32.7555, -97.3308],
            'el paso': [31.7619, -106.4850],
            'arlington': [32.7357, -97.1081],
            'corpus christi': [27.8006, -97.3964],
            'plano': [33.0198, -96.6989],
            'laredo': [27.5036, -99.5076],
            'lubbock': [33.5779, -101.8552],
            'garland': [32.9126, -96.6389],
            'irving': [32.8140, -96.9489],
            'amarillo': [35.2220, -101.8313],
            'grand prairie': [32.7460, -96.9978],
            'mckinney': [33.1972, -96.6398],
            'frisco': [33.1507, -96.8236],
            'pasadena': [29.6911, -95.2091],
            'mesquite': [32.7668, -96.5992],
            'killeen': [31.1171, -97.7278],
            'mcallen': [26.2034, -98.2300],
            'waco': [31.5493, -97.1467],
            'carrollton': [32.9756, -96.8900],
            'denton': [33.2148, -97.1331],
            'midland': [31.9973, -102.0779],
            'abilene': [32.4487, -99.7331],
            'beaumont': [30.0802, -94.1266],
            'round rock': [30.5083, -97.6789],
            'odessa': [31.8457, -102.3676],
            'wichita falls': [33.9137, -98.4934],
            'richardson': [32.9483, -96.7299],
            'lewisville': [33.0198, -96.9925],
            'tyler': [32.3513, -95.3011],
            'pearland': [29.5640, -95.2863],
            'college station': [30.6280, -96.3344],
            'san angelo': [31.4638, -100.4370],
            'allen': [33.1032, -96.6706],
            'league city': [29.5075, -95.0949],
            'sugar land': [29.6197, -95.6349],
            'longview': [32.5007, -94.7405],
            'mission': [26.2159, -98.3253],
            'edinburg': [26.3017, -98.1633],
            'bryan': [30.6744, -96.3700],
            'baytown': [29.7355, -94.9774],
            'pharr': [26.1948, -98.1836],
            'temple': [31.0982, -97.3428],
            'missouri city': [29.5891, -95.5397],
            'flower mound': [33.0146, -97.0970],
            'north richland hills': [32.8343, -97.2289],
            'harlingen': [26.1906, -97.6961],
            'victoria': [28.8051, -97.0036],
            'new braunfels': [29.7005, -98.1245],
            'conroe': [30.3119, -95.4560],
            'cedar park': [30.5052, -97.8203],
            'mansfield': [32.5632, -97.1417],
            'georgetown': [30.6333, -97.6772],
            'san marcos': [29.8833, -97.9414],
            'rowlett': [32.9029, -96.5639],
            'pflugerville': [30.4394, -97.6200],
            'port arthur': [29.8850, -93.9268],
            'euless': [32.8343, -97.0817],
            'desoto': [32.5896, -96.8569],
            'grapevine': [32.9343, -97.0781],
            'weatherford': [32.7593, -97.7972],
            'hurst': [32.8235, -97.1706],
            'keller': [32.9342, -97.2293],
            'white settlement': [32.7623, -97.4512],
            'bedford': [32.8440, -97.1431],
            'colleyville': [32.8809, -97.1550],
            'southlake': [32.9412, -97.1341],
            'coppell': [32.9618, -97.0061],
            'azle': [32.8951, -97.5459],
            'saginaw': [32.8579, -97.3614],
            'benbrook': [32.6732, -97.4606],
            'burleson': [32.5421, -97.3208],
            'cleburne': [32.3479, -97.3867],
            'granbury': [32.4421, -97.7942],
            'waxahachie': [32.3865, -96.8483],
            'midlothian': [32.4824, -96.9942],
            'red oak': [32.5251, -96.8064],
            'ennis': [32.3274, -96.6297],
            'corsicana': [32.0954, -96.4689],
            'stephenville': [32.2207, -98.2023],
            'brownwood': [31.7093, -98.9912],
            'mineral wells': [32.8085, -98.1128],
            'gainesville': [33.6279, -97.1417],
            'sherman': [33.6357, -96.6089],
            'denison': [33.7557, -96.5367],
            'paris': [33.6609, -95.5555],
            'greenville': [33.1384, -96.1108],
            'rockwall': [32.9312, -96.4597],
            'forney': [32.7476, -96.4730],
            'terrell': [32.7360, -96.2753],
            'kaufman': [32.5832, -96.3128],
            'athens': [32.2046, -95.8550],
            'palestine': [31.7621, -95.6308],
            'jacksonville': [31.9621, -95.2707],
            'marshall': [32.5449, -94.3674],
            'texarkana': [33.4251, -94.0477],
            'lufkin': [31.3382, -94.7291],
            'nacogdoches': [31.6035, -94.6555],
            'huntsville': [30.7235, -95.5516],
            'spring': [30.0799, -95.4172],
            'the woodlands': [30.1658, -95.4613],
            'katy': [29.7858, -95.8245],
            'fresno': [29.5294, -95.4549],
            'richmond': [29.5822, -95.7608],
            'rosenberg': [29.5568, -95.8098],
            'angleton': [29.1691, -95.4319],
            'lake jackson': [29.0339, -95.4344],
            'alvin': [29.4238, -95.2449],
            'galveston': [29.3013, -94.7977],
            'texas city': [29.3838, -94.9027],
            'friendswood': [29.5294, -95.2010],
            'deer park': [29.7052, -95.1238],
            'la porte': [29.6658, -95.0194],
            'channelview': [29.7761, -95.1147],
            'humble': [29.9988, -95.2622],
            'kingwood': [30.0480, -95.1866]
      };

      document.addEventListener('DOMContentLoaded', function() {
        initMap();
      });

      function createCustomIcon(isActive = false) {
        return L.divIcon({
          className: 'custom-div-icon',
          html: `<div class="pin-marker ${isActive ? 'active-pin' : ''}"></div>`,
          iconSize: [36, 42],
          iconAnchor: [18, 42],
          popupAnchor: [0, -42]
        });
      }

      const delay = ms => new Promise(res => setTimeout(res, ms));

      async function initMap() {
        map = L.map('map', { scrollWheelZoom: false }).setView([31.9686, -99.9018], 6);

        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; OpenStreetMap &copy; CARTO',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(map);

        // Process locations
        for (let i = 0; i < locations.length; i++) {
            const loc = locations[i];
            const normalizedCity = loc.city.toLowerCase().trim();
            let coords = null;

            if (cityCache[normalizedCity]) {
                coords = cityCache[normalizedCity];
            } else {
                 // Skip Geocoding for now in this version to avoid limits/errors on load
                 // Or simplistic fallback if not in cache? 
                 // We will skip plotting markers for unknown cities to stay safe, 
                 // or maybe we could try one day. For now, rely on cache.
                 console.log("City not in cache:", normalizedCity);
                 continue;
            }

            if (coords) {
                const marker = L.marker(coords, {
                    icon: createCustomIcon()
                }).addTo(map);

                marker.bindPopup(`
                    <div style="font-family: 'Poppins', sans-serif; text-align: center;">
                        <h5 style="margin: 0 0 5px; color: #0f0f0f; font-weight: 600;">${loc.name}</h5>
                        <p style="margin: 0; color: #666; font-size: 0.85rem;">${loc.city}, ${loc.state}</p>
                    </div>
                `);

                markers[i] = { leafletMarker: marker, coords: coords };

                marker.on('click', () => {
                    focusOnLocation(i);
                });
            }
        }

        // Fit bounds if markers exist
        const validMarkers = markers.filter(m => m && m.leafletMarker).map(m => m.leafletMarker);
        if (validMarkers.length > 0) {
            const group = new L.featureGroup(validMarkers);
            map.fitBounds(group.getBounds(), { padding: [50, 50] });
        }
      }

      function focusOnLocation(index) {
        // Update list styling
        document.querySelectorAll('.location-item').forEach(item => item.classList.remove('active-location'));
        const listItem = document.querySelector(`.location-item[data-index="${index}"]`);
        if (listItem) {
            listItem.classList.add('active-location');
            listItem.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        // Map interaction
        if (markers[index]) {
            // Reset icons
            markers.forEach(m => {
                if (m && m.leafletMarker) m.leafletMarker.setIcon(createCustomIcon(false));
            });

            // Highlight target
            const m = markers[index];
            m.leafletMarker.setIcon(createCustomIcon(true));
            m.leafletMarker.openPopup();
            map.flyTo(m.coords, 14, { animate: true, duration: 1.5 });
        }
      }
    </script>
  </body>
</html>
