<!-- department section -->

  {{-- <section class="department_section layout_padding"> --}}
    @if (isset($current_view_name) && $current_view_name === 'departments')
    <section class="department_section layout_padding">
@else
    <section class="department_section layout_margin-bottom">
@endif
    <div class="department_container">
      <div class="container ">
        <div class="heading_container heading_center">
          <h2>
            Precision You Can Trust
          </h2>
          <p>
            Expert Medical Report Analysis for Accurate Healthcare Insights.
          </p>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="box ">
              <div class="img-box">
                <img src="{{ asset('asset/images/s3.png') }}" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Blood Test
                </h5>
                <p>
                  Precise blood test interpretation for better health insights.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="box ">
              <div class="img-box">
                <img src="{{ asset('asset/images/s1.png') }}" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Ultra Sound
                </h5>
                <p>
                  Quick and clear ultrasound imaging for accurate diagnosis.
                </p>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="box ">
              <div class="img-box">
                <img src="{{ asset('asset/images/s2.png') }}" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  MRI
                </h5>
                <p>
                  Our experts deliver accurate MRI interpretations you can trust.
                </p>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="box ">
              <div class="img-box">
                <img src="{{ asset('asset/images/s4.png') }}" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  X-Ray
                </h5>
                <p>
                  Our experts offer precise and reliable X-ray analysis.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="btn-box">
         @if (isset($current_view_name) && $current_view_name === 'departments')
    <a href="{{ route('contactus') }}">
            Contact Us
          </a>
@else
    <a href="{{ route('departments') }}">
            View All
          </a>
@endif

        </div>
      </div>
    </div>
  </section>

  <!-- end department section -->
