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
                    <a class="navbar-brand" href="{{ route('index') }}">
                        <button type="button" class="btn">
                            <img src="{{ asset('asset/images/orthoc.jpg') }}" alt="Orthoc"
                                style="height: 100px; width: 182px; vertical-align: middle; margin-right: 8px;">
                        </button>
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('index') }}">Home <span
                                        class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('aboutus') }}">About Us</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('reports.upload') }}">Reports Upload</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contactus') }}">Contact Us</a>
                            </li>

                            @if (Auth::check())
    <li class="nav-item">
        <a class="nav-link"
            href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('patient.dashboard') }}">
            Dashboard
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>



@else
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">Login</a>
    </li>
@endif
                            {{-- <form class="form-inline">
                                <button class="btn my-2 my-sm-0 nav_search-btn" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form> --}}
                        </ul>
                    </div>
                </nav>
               @if (Auth::check())
    <style>
        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-left: auto;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .user-profile:hover {
            background: rgba(255,255,255,0.1);
        }
        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #4a5568;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }
        .user-name {
            font-weight: 500;
            color: #2d3748;
        }
        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="user-profile dropdown">
        <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
        <span class="user-name dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" > Welcome
            {{ Auth::user()->name }}
        </span>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('patient.dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
@endif
            </div>
        </header>
        <!-- end header section -->

    </div>
