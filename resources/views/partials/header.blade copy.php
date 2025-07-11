 @if (isset($current_view_name) && $current_view_name === 'index')
    <body>
@else
    <body class="sub_page">
@endif
<body>

<div class="hero_area">

    <div class="hero_bg_box">
      <img src="{{ asset('asset/images/hero-bg.png') }}" alt="">
    </div>

    <!-- header section starts -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.html">
            {{-- <span>
              Orthoc
            </span> --}}
            <button type="button" class="btn">
  <img src="{{ asset('asset/images/orthoc.jpg') }}" alt="Orthoc" style="height: 100px; width: 100px; vertical-align: middle; margin-right: 8px;">
  {{-- <span>Orthoc</span> --}}
</button>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link" href="about.html"> About</a>
              </li> --}}
              <li class="nav-item">
                <a class="nav-link" href="{{ route('aboutus') }}">About Us</a>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('departments') }}">Departments</a>
              </li> --}}
              {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('doctors') }}">Doctors</a>
              </li> --}}
              <!-- <li class="nav-item">
                <a class="nav-link" href="{{ route('reports.upload') }}">Reports Upload</a>
              </li> -->
              <li class="nav-item">
                <a class="nav-link" href="{{ route('contactus') }}">Contact Us</a>
              </li>
              <form class="form-inline">
                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
              </form>
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
