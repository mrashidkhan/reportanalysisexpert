<!-- contact section -->
@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

<section class="contact_section layout_padding">
  <div class="container">
    <div class="heading_container">
      <h2>
        Get In Touch
      </h2>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form_container contact-form">
          <form action="{{ route('contact.submit') }}" method="POST" id="contactForm">
            @csrf
            <div class="form-row">
              <div class="col-lg-6">
                <div>
                  <input type="text" name="name" placeholder="Your Name" required />
                  @error('name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div>
                  <input type="text" name="phone" placeholder="Phone Number" required />
                  @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>
            <div>
              <input type="email" name="email" placeholder="Email" required />
              @error('email')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div>
              <textarea name="contactmessage" class="message-box" placeholder="Message" rows="7" required style="width: 100%; background-color:#EEEEEE;"></textarea>
              @error('message')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="btn_box">
              <button type="submit">
                SEND
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="map_container">
          <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3620.341576002038!2d67.04130917401152!3d24.852180845591455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33dd56ed93975%3A0x57ca3a148a05acb6!2sJinnah%20Postgraduate%20Medical%20Center%20(JPMC)!5e0!3m2!1sen!2s!4v1748956125818!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end contact section -->


