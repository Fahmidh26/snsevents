@if(isset($heroSlides) && $heroSlides->count() > 0)
    <section id="hero">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner">
            @foreach($heroSlides as $key => $slide)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" style="height: 100vh;">
                @if($slide->background_video_path)
                    @if(Str::contains($slide->background_video_path, ['youtube.com', 'youtu.be']))
                        @php
                            // Extract YouTube ID
                            $videoId = '';
                            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $slide->background_video_path, $match)) {
                                $videoId = $match[1];
                            }
                        @endphp
                        @if($videoId)
                            <div class="position-absolute w-100 h-100 hero-video" style="z-index: -1; overflow: hidden;">
                                <iframe 
                                    src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=1&mute=1&controls=0&loop=1&playlist={{ $videoId }}&showinfo=0&rel=0&iv_load_policy=3&disablekb=1&modestbranding=1&playsinline=1" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                    class="youtube-bg">
                                </iframe>
                            </div>
                        @endif
                    @elseif(Str::contains($slide->background_video_path, 'player.cloudinary.com'))
                         <!-- Cloudinary Player Video -->
                        <div class="position-absolute w-100 h-100 hero-video" style="z-index: -1; overflow: hidden; background-color: #0f0f0f;">
                            {{-- Placeholder Image --}}
                            @if($slide->background_image_path)
                                <img src="{{ asset('storage/' . $slide->background_image_path) }}" class="position-absolute w-100 h-100" style="object-fit: cover; z-index: 0; opacity: 0.6;" alt="Background">
                            @endif
                            
                            {{-- Loading Animation --}}
                            <div class="position-absolute top-50 start-50 translate-middle" style="z-index: 0;">
                                <div class="spinner-border text-warning" role="status" style="width: 3rem; height: 3rem; border-width: 0.25em;">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>

                            <iframe
                                src="{{ $slide->background_video_path }}{{ Str::contains($slide->background_video_path, '?') ? '&' : '?' }}autoplay=true&muted=true&loop=true&controls=false&hide_share=true&hide_title=true"
                                style="pointer-events: none; position: relative; z-index: 1;"
                                allow="autoplay; fullscreen; encrypted-media; picture-in-picture"
                                allowfullscreen
                                frameborder="0"
                                class="youtube-bg" 
                            ></iframe>
                        </div>
                    @elseif(Str::contains($slide->background_video_path, 'dropbox.com'))
                        <!-- Dropbox Direct Video -->
                        @php
                            $dropboxUrl = $slide->background_video_path;
                            if (Str::contains($dropboxUrl, '?')) {
                                $dropboxUrl = str_replace('dl=0', 'raw=1', $dropboxUrl);
                                if (!Str::contains($dropboxUrl, 'raw=1')) {
                                    $dropboxUrl .= '&raw=1';
                                }
                            } else {
                                $dropboxUrl .= '?raw=1';
                            }
                        @endphp
                         <video 
                            id="hero-video-{{ $key }}"
                            class="position-absolute w-100 h-100 hero-video" 
                            style="object-fit: cover; z-index: -1;"
                            muted 
                            loop 
                            playsinline
                            poster="{{ $slide->background_image_path ? asset('storage/' . $slide->background_image_path) : '' }}"
                            @if($key == 0) autoplay preload="auto" @else preload="none" @endif
                        >
                            <source src="{{ $dropboxUrl }}" type="video/{{ pathinfo(parse_url($slide->background_video_path, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'mp4' }}">
                        </video>
                    @elseif(filter_var($slide->background_video_path, FILTER_VALIDATE_URL))
                         <!-- External Direct Video URL -->
                        <video 
                            id="hero-video-{{ $key }}"
                            class="position-absolute w-100 h-100 hero-video" 
                            style="object-fit: cover; z-index: -1;"
                            muted 
                            loop 
                            playsinline
                            poster="{{ $slide->background_image_path ? asset('storage/' . $slide->background_image_path) : '' }}"
                            @if($key == 0) autoplay preload="auto" @else preload="none" @endif
                        >
                            <source src="{{ $slide->background_video_path }}" type="video/{{ pathinfo(parse_url($slide->background_video_path, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'mp4' }}">
                        </video>
                    @else
                        <!-- Local Video File -->
                        <video 
                            id="hero-video-{{ $key }}"
                            class="position-absolute w-100 h-100 hero-video" 
                            style="object-fit: cover; z-index: -1;"
                            muted 
                            loop 
                            playsinline
                            poster="{{ $slide->background_image_path ? asset('storage/' . $slide->background_image_path) : '' }}"
                            @if($key == 0) autoplay preload="auto" @else preload="none" @endif
                        >
                             <source src="{{ asset('storage/' . $slide->background_video_path) }}" type="video/{{ pathinfo($slide->background_video_path, PATHINFO_EXTENSION) == 'mov' ? 'quicktime' : pathinfo($slide->background_video_path, PATHINFO_EXTENSION) }}">
                        </video>
                    @endif
                    <div class="position-absolute w-100 h-100" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)); z-index: 0;"></div>
                @else
                    <div class="position-absolute w-100 h-100" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ Str::startsWith($slide->background_image_path, 'http') ? $slide->background_image_path : ($slide->background_image_path ? asset('storage/' . $slide->background_image_path) : 'https://images.unsplash.com/photo-1519167758481-83f29da8c8f0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') }}'); background-size: cover; background-position: center; z-index: -1;"></div>
                @endif

                 <div class="d-flex align-items-center justify-content-center h-100" style="position: relative; z-index: 1;">
                      <div class="hero-content text-center text-white">
                            <h1 data-aos="fade-down">{{ $slide->heading }}</h1>
                            <p data-aos="fade-up" data-aos-delay="200">{{ $slide->subheading }}</p>
                            <button class="btn-primary-custom" data-aos="fade-up" data-aos-delay="400" onclick="document.getElementById('contact').scrollIntoView({behavior: 'smooth'})">
                                {{ $slide->button_text }}
                            </button>
                      </div>
                 </div>
            </div>
            @endforeach
        </div>
        @if($heroSlides->count() > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        @endif
    </div>
    </section>
@else
    <section id="hero" class="hero-section">
      <div class="hero-content">
        <h1 data-aos="fade-down">Creating Unforgettable Moments</h1>
        <p data-aos="fade-up" data-aos-delay="200">Where Dreams Meet Reality</p>
        <button
          class="btn-primary-custom"
          data-aos="fade-up"
          data-aos-delay="400"
          onclick="document.getElementById('contact').scrollIntoView({behavior: 'smooth'})"
        >
          Plan Your Event
        </button>
      </div>
    </section>
@endif
