<section id="mission-vision" style="padding: 80px 0; background-color: var(--light-bg);">
  <div class="container">
    @if(isset($companyProfile) && ($companyProfile->mission || $companyProfile->vision))
    <div class="section-title" data-aos="fade-up">
       <h2>Our Purpose</h2>
       <p>Driving Excellence in Every Event</p>
    </div>
    <div class="row justify-content-center">
         <div class="col-lg-10">
            <div class="vision-mission-grid" data-aos="fade-up" data-aos-delay="100">
              @if($companyProfile->mission)
              <div class="vision-card mission-card">
                <div class="vision-icon dark">
                  <i class="fas fa-bullseye"></i>
                </div>
                <h4>Our Mission</h4>
                <p>{{ $companyProfile->mission }}</p>
              </div>
              @endif

              @if($companyProfile->vision)
              <div class="vision-card">
                <div class="vision-icon gold">
                  <i class="fas fa-eye"></i>
                </div>
                <h4>Our Vision</h4>
                <p>{{ $companyProfile->vision }}</p>
              </div>
              @endif
            </div>
         </div>
    </div>
    @endif
  </div>
</section>
