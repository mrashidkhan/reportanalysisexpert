<!-- about section -->

  @if (isset($current_view_name) && $current_view_name === 'aboutus')
    <section class="about_section layout_padding">
@else
    <section class="about_section layout_margin-bottom">
@endif
    <div class="container  ">
      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="{{ asset('asset/images/about-img.jpg') }}" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                About <span>Us</span>
              </h2>
            </div>
            <p>
              We provide expert medical report analysis by qualified specialists, helping doctors interpret complex pathology, radiology, and diagnostic reports with precision. Simply upload your patient’s reports, and our team delivers clear, actionable insights—all at an affordable cost. No AI, no automated tools—just reliable, human expertise to support your clinical decisions.
            </p>
            <div class="btn-box">
         @if (isset($current_view_name) && $current_view_name === 'aboutus')
    <a href="{{ route('contactus') }}">
            Contact Us
          </a>
@else
    <a href="{{ route('aboutus') }}">
            About Us
          </a>
@endif

        </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->
