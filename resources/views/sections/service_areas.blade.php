<section id="service-areas" class="service-areas-section">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    
    <style>
        .service-areas-section {
            padding: 100px 0;
            background: var(--surface-white);
            position: relative;
            overflow: hidden;
        }

        .service-areas-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 0% 0%, rgba(201, 162, 39, 0.03) 0%, transparent 40%),
                        radial-gradient(circle at 100% 100%, rgba(201, 162, 39, 0.03) 0%, transparent 40%);
            pointer-events: none;
        }

        .section-header {
            margin-bottom: 50px;
        }
        
        .locations-wrapper {
            max-height: 600px;
            overflow-y: auto;
            padding-right: 15px;
            /* Scrollbar styling */
            scrollbar-width: thin;
            scrollbar-color: rgba(201, 162, 39, 0.3) transparent;
        }
        
        .locations-wrapper::-webkit-scrollbar {
            width: 6px;
        }
        
        .locations-wrapper::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .locations-wrapper::-webkit-scrollbar-thumb {
            background-color: rgba(201, 162, 39, 0.3);
            border-radius: 20px;
        }

        .location-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 16px;
        }
        
        .location-item {
            background: #ffffff;
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 12px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            text-decoration: none !important;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .location-item.active-location {
            border-color: var(--primary-color);
            background: color-mix(in srgb, var(--primary-color) 5%, white);
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            transform: translateX(5px);
        }

        .location-item:hover {
            transform: translateX(5px);
            border-color: rgba(201, 162, 39, 0.4);
        }

        .location-content {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .location-icon-wrapper {
            width: 40px;
            height: 40px;
            background: rgba(201, 162, 39, 0.06);
            color: var(--primary-color);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }
        
        .location-item.active-location .location-icon-wrapper,
        .location-item:hover .location-icon-wrapper {
            background: var(--primary-gradient);
            color: #fff;
        }

        .location-details h4 {
            font-size: 0.95rem;
            margin: 0;
            font-weight: 600;
            color: var(--secondary-color);
        }
        
        .location-details span {
            font-size: 0.8rem;
            color: var(--text-light);
            display: block;
            margin-top: 2px;
        }
        
        .map-container-wrapper {
            position: sticky;
            top: 100px;
            height: 600px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            border: 1px solid rgba(0,0,0,0.05);
            background: #fff;
            z-index: 10;
        }
        
        #service-area-map {
            width: 100%;
            height: 100%;
            background: #f8f9fa; /* Placeholder color before map loads */
            z-index: 1;
        }
        
        /* Custom Marker Styles */
        .custom-div-icon {
            background: transparent;
            border: none;
        }
        
        .pin-marker {
            width: 30px;
            height: 30px;
            background-color: var(--primary-color);
            border-radius: 50% 50% 50% 0;
            transform: rotate(-45deg);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            position: relative;
            transition: all 0.3s ease;
            border: 2px solid #fff;
        }
        
        .pin-marker::after {
            content: '';
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #fff;
            transform: rotate(45deg);
        }
        
        .pin-marker.active-pin {
            background-color: var(--secondary-color);
            transform: scale(1.2) rotate(-45deg);
            z-index: 1000 !important;
        }
        

        @media (max-width: 991px) {
            .map-container-wrapper {
                height: 400px;
                margin-top: 30px;
                position: relative;
                top: 0;
            }
            .locations-wrapper {
                max-height: 400px;
                margin-bottom: 20px;
            }
        }
    </style>

  <div class="container">
    <div class="section-title" data-aos="fade-up">
      <h2>Areas We Serve</h2>
      <p>Bringing Our Services to Your Neighborhood</p>
    </div>


    <div class="row">
        <!-- Locations List -->
        <div class="col-lg-5" data-aos="fade-right" data-aos-duration="700">
            <div class="locations-wrapper">
                <div class="location-grid">
                    @forelse($serviceAreas as $index => $area)
                    <div class="location-item" 
                         data-city="{{ $area->city }}"
                         data-state="{{ $area->state }}"
                         data-index="{{ $index }}"
                         onclick="focusOnLocation({{ $index }})">
                        
                        <div class="location-content">
                            <div class="location-icon-wrapper">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="location-details">
                                <h4>{{ $area->name }}</h4>
                                <span>{{ $area->city }}{{ $area->zip_code ? ', '.$area->zip_code : '' }}</span>
                            </div>
                        </div>
                        
                        <div class="location-arrow text-muted opacity-50">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <p>We serve all major cities in Texas.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Leaflet Map -->
        <div class="col-lg-7" data-aos="fade-left" data-aos-duration="700">
            <div class="map-container-wrapper">
                <div id="service-area-map"></div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5" data-aos="fade-up">
        <a href="{{ route('service-areas') }}" class="btn-view-all">
            View Full Directory <i class="fas fa-arrow-right ms-2"></i>
        </a>
    </div>
  </div>


  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  <script>
    // Pass PHP data to JS
    @php
        $locationsData = $serviceAreas->map(function($area) {
            return [
                'name' => $area->name,
                'city' => $area->city,
                'state' => $area->state,
                'full_address' => $area->city . ', ' . $area->state . ' US'
            ];
        });
    @endphp
    const locations = @json($locationsData);

    let map;
    let markers = [];
    
    document.addEventListener('DOMContentLoaded', function() {
        initMap();
    });

    function initMap() {
        // Initialize map centered on Texas initially
        map = L.map('service-area-map', {
            scrollWheelZoom: false 
        }).setView([31.9686, -99.9018], 6); // Center of Texas

        // Add OpenStreetMap Tile Layer
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(map);

        // Geocode and plot markers
        // Common Texas Cities Coordinate Cache to avoid network hits
        // We use a normalized key (lowercase) for better matching
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

        // Custom Icon Function
        function createCustomIcon(isActive = false) {
             return L.divIcon({
                className: 'custom-div-icon',
                html: `<div class="pin-marker ${isActive ? 'active-pin' : ''}"></div>`,
                iconSize: [30, 42],
                iconAnchor: [15, 42]
            });
        }
        
        // Helper to delay execution (rate limiting)
        const delay = ms => new Promise(res => setTimeout(res, ms));

        async function processLocations() {
             for (let i = 0; i < locations.length; i++) {
                const loc = locations[i];
                const normalizedCity = loc.city.toLowerCase().trim();
                let coords = null;
                
                // 1. Try Cache
                if (cityCache[normalizedCity]) {
                    coords = cityCache[normalizedCity];
                } 
                // 2. Fallback: Fetch from Nominatim
                else {
                    try {
                        // Rate limit to be polite
                        await delay(500 * (i % 3)); // Stagger calls slightly
                        const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(loc.city + ', Texas, USA')}&limit=1`);
                        const data = await response.json();
                        if (data && data.length > 0) {
                            coords = [parseFloat(data[0].lat), parseFloat(data[0].lon)];
                            // Cache it for this session
                            cityCache[normalizedCity] = coords;
                        }
                    } catch (e) {
                         console.warn('Geocoding skipped/failed for:', loc.city); 
                    }
                }

                 if (coords) {
                    const marker = L.marker(coords, {
                        icon: createCustomIcon()
                    }).addTo(map);
                    
                    // Add popup
                    marker.bindPopup(`<b>${loc.name}</b><br>${loc.city}, ${loc.state}`);
                    
                    // Attach reference to our array so we can access it later
                    markers[i] = { leafletMarker: marker, coords: coords };
                    
                    // Add click handler to marker
                    marker.on('click', () => {
                       focusOnLocation(i); 
                    });
                }
            }
            
            // After attempting all, fit bounds
            const validMarkers = markers.filter(m => m && m.leafletMarker).map(m => m.leafletMarker);
            if (validMarkers.length > 0) {
                const group = new L.featureGroup(validMarkers);
                map.fitBounds(group.getBounds(), { padding: [50, 50] });
            }
        }
        
        // Run processing
        processLocations();
    }

    function focusOnLocation(index) {
        // Highlight List Item
        document.querySelectorAll('.location-item').forEach(item => {
            item.classList.remove('active-location');
        });
        const listItem = document.querySelector(`.location-item[data-index="${index}"]`);
        if(listItem) {
            listItem.classList.add('active-location');
            // Scroll list to show the active item
            listItem.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
        
        // Highlight Map Marker
        if (markers[index]) {
            // Reset all markers icons
            markers.forEach(m => {
                if(m && m.leafletMarker) {
                     m.leafletMarker.setIcon(createCustomIcon(false));
                }
            });
            
            // Highlight specific marker
            const m = markers[index];
            if(m && m.leafletMarker) {
                m.leafletMarker.setIcon(createCustomIcon(true));
                m.leafletMarker.openPopup();
                map.flyTo(m.coords, 14, { // Tighter zoom
                    animate: true,
                    duration: 1.5
                });
            }
        }
    }
  </script>
</section>
