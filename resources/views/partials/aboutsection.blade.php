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
                    Our service provides patients with simplified summaries and analyses of their medical lab reports.
                </p>
                <p>
                    This is because most patients find it difficult to understand the complex medical terms and
                    technical language used in lab reports. By offering clear and easy-to-understand explanations, we
                    enable patients to confidently discuss their condition with their doctors based on their reports.
                </p>
                <p>
                    This helps them better understand their illness and communicate effectively with their physician,
                    leading to more informed decisions and improved treatment outcomes.
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
