<!-- doctor section -->

{{-- <section class="doctor_section layout_padding"> --}}


<section class="doctor_section layout_padding">

    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our Doctors
            </h2>
            <p class="col-md-10 mx-auto px-0">
                Our team of expert doctors brings years of specialized experience to provide accurate and insightful
                medical report analysis. They combine deep medical knowledge with the latest technology to deliver
                reliable interpretations that support informed healthcare decisions.


            </p>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-4 mx-auto">
                <div class="box">
                    <div class="img-box">
                        <img src="{{ asset('asset/images/drmushtaq.png') }}" alt="">
                    </div>
                    <div class="detail-box">
                        <div class="social_box">
                            <a href="#">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-youtube" aria-hidden="true"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-linkedin" aria-hidden="true"></i>
                            </a>
                        </div>
                        <h5>
                            Doctor Mushtaq A Shah
                        </h5>
                        <h6 class="">
                            Doctor
                        </h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 mx-auto">
                <div class="box">
                    <div class="img-box">
                        <img src="{{ asset('asset/images/d2.jpg') }}" alt="">
                    </div>
                    <div class="detail-box">
                        <div class="social_box">
                            <a href="#">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-youtube" aria-hidden="true"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-linkedin" aria-hidden="true"></i>
                            </a>
                        </div>
                        <h5>
                            Adam View
                        </h5>
                        <h6 class="">
                            Doctor
                        </h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 mx-auto">
                <div class="box">
                    <div class="img-box">
                        <img src="{{ asset('asset/images/d3.jpg') }}" alt="">
                    </div>
                    <div class="detail-box">
                        <div class="social_box">
                            <a href="#">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-youtube" aria-hidden="true"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-linkedin" aria-hidden="true"></i>
                            </a>
                        </div>
                        <h5>
                            Mia Mike
                        </h5>
                        <h6 class="">
                            Doctor
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-box">
            @if (isset($current_view_name) && $current_view_name === 'doctors')
                <a href="{{ route('contactus') }}">
                    Contact Us
                </a>
            @else
                <a href="{{ route('doctors') }}">
                    View All
                </a>
            @endif

        </div>
    </div>
</section>

<!-- end doctor section -->
