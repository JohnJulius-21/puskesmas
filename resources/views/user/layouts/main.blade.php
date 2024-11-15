<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Puskesmas ...</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('stylepasien/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('stylepasien/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('stylepasien/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('stylepasien/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('stylepasien/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('stylepasien/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('stylepasien/assets/css/main.css') }}" rel="stylesheet">
    <style>
        /* Default styling for both buttons */
        .cta-btn {
            color: white;
            padding: 5px 20px;
            border-radius: 999px; /* Keep the existing border radius */
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            width: 100%; /* Full width of the parent container */
            max-width: 150px; /* Optional: limit the maximum width */
        }
    
        /* Login button styles */
        .login-btn {
            background-color: #2CA6FF !important; /* Default color for login button */
            border: 2px solid transparent; /* Default border, transparent to match background */
        }
    
        .login-btn:hover {
            background-color: #268FDB !important; /* Hover color for login button */
            border: 2px solid #fff; /* White border on hover */
        }
    
        /* Sign Up button styles */
        .signup-btn {
            background-color: #FFFFFF !important; /* Default color for sign-up button */
            color: #2CA6FF !important; /* Text color for sign-up */
            margin-left: 0;
            border: 2px solid #2CA6FF; /* Blue border for sign-up button */
        }
    
        .signup-btn:hover {
            background-color: #268FDB !important; /* Hover color for sign-up button */
            color: white !important; /* Change text color on hover */
            border: 2px solid transparent; /* Transparent border on hover */
        }
    
        /* Header and Footer color */
        header.header,
        footer.footer {
            background-color: #FFFFFF !important; /* Set header background to white */
        }
    
        header.header {
        height: 70px; /* Set a height for the header */
        margin-bottom: 20px; /* Adjust this value as needed */
        z-index: 1000; /* Lower z-index for the header */
    }

    
        header.header.sticky-top {
            background-color: #FFFFFF !important; /* Ensure sticky header background is white */
            z-index: 9999; /* Ensure it stays on top of other elements */
            position: fixed; /* Keep it fixed at the top */
            width: 100%; /* Ensure it spans the full width */
        }
    
        body {
            background-color: white !important; /* Ensure the background color is white */
            padding-top: 0px; /* Adjust this value based on header height */
        }
    
        .branding {
            background-color: white !important; /* White background for the logo and button area */
        }
    
        .navmenu {
            background-color: white !important; /* White background for the navigation menu */
        }
    
        .btn-success {
            background-color: green;
            color: white;
        }
    
        .btn-danger {
            background-color: red;
            color: white;
        }
    
        /* Optionally, add custom styles for the buttons */
        .btn-alerting {
            background-color: #ffcc00; /* yellow */
            color: black;
        }
    
        .stepper {
            display: flex;
            justify-content: space-between; /* Distribute steps evenly */
            margin: 20px 0; /* Space around stepper */
        }
    
        .step {
            flex: 1; /* Make each step take equal width */
            text-align: center; /* Center-align text */
            position: relative; /* For positioning the circle */
        }
    
        .circle {
            width: 30px; /* Circle width */
            height: 30px; /* Circle height */
            border-radius: 50%; /* Make it a circle */
            border: 2px solid #007bff; /* Circle border color */
            display: flex; /* Center text within the circle */
            align-items: center; /* Vertically center */
            justify-content: center; /* Horizontally center */
            color: #007bff; /* Circle text color */
            font-weight: bold; /* Bold text */
            margin: 0 auto; /* Center the circle */
            background-color: #f9f9f9; /* Light background */
            transition: background-color 0.3s; /* Smooth background change */
        }
    
        .step.active .circle {
            background-color: #007bff; /* Active step background */
            color: white; /* Active step text color */
        }
    
        .step:not(:last-child)::after {
            content: ''; /* Create the connector line */
            position: absolute;
            top: 50%; /* Center vertically */
            right: -50%; /* Position it to the right of the step */
            width: 50px; /* Line width */
            height: 2px; /* Line thickness */
            background-color: #ccc; /* Line color */
            z-index: -1; /* Send the line behind the circles */
            
        }
        .modal {
    z-index: 10000 !important; /* Ensure modal appears above the header */
}
.modal-dialog {
    margin-top: 80px; /* Adjust this value based on your header height */
}
main {
            margin-top: 0; /* Bring the hero close to the header */
        }
        .navmenu ul {
    list-style: none; /* Remove default list styling */
    padding: 0; /* Remove padding */
    margin: 0; /* Remove margin */
}

.navmenu li {
    position: relative; /* Necessary for positioning dropdowns */
}

.dropdown-menu {
    display: none; /* Hide dropdown by default */
    position: absolute; /* Position below the dropdown item */
    background-color: white; /* Background for dropdown */
    border: 1px solid #ccc; /* Optional border */
    z-index: 10000; /* Ensure it's on top of everything, including the header */
}


.dropdown:hover .dropdown-menu,
.dropdown.active .dropdown-menu {
    display: block; /* Show the dropdown on hover or when active */
}
@media (max-width: 992px) {
    header.header {
        z-index: 1000; /* Lower z-index for the header */
    }

    .dropdown-menu {
        display: none; /* Hide dropdown by default */
        position: absolute; /* Position below the dropdown item */
        background-color: white; /* Background for dropdown */
        border: 1px solid #ccc; /* Optional border */
        z-index: 10001; /* Higher z-index for the dropdown menu */
        left: 0; /* Align dropdown to the left edge */
        right: 0; /* Align dropdown to the right edge */
    }

    .dropdown.active .dropdown-menu {
        display: block; /* Show dropdown when active */
    }
    @media (max-width: 992px) {
        .dropdown.active .dropdown-menu {
            display: block; /* Show dropdown when active */
        }
    }
}



    </style>
    
 
    
    
</head>

<body class="index-page">

    <header id="header" class="header sticky-top" style="background-color: #FFFFFF;">
    <div class="branding d-flex align-items-center">
        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="{{route('beranda')}}" class="logo d-flex align-items-center me-auto">
                <h1 class="sitename">Puskesmas</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('beranda') }}" class="{{ Request::is('beranda') ? 'active' : '' }}">Beranda</a></li>
                    <li><a href="{{ route('konsultasi') }}" class="{{ Request::is('konsultasi') ? 'active' : '' }}">Konsultasi</a></li>
                    @auth
                        <li class="dropdown {{ Request::is('konsultasiShow') ? 'active' : '' }}">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span>Halo, {{ auth()->user()->name }}</span>
                                <i class="bi bi-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('konsultasiShow') ? 'active' : '' }}" href="{{ route('konsultasiShow') }}">Konsultasi Saya</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('riwayat-konsultasi') ? 'active' : '' }}" href="{{ route('riwayatKonsultasi') }}">Riwayat Konsultasi</a>
                                </li>
                                <li>
                                    <form id="logoutForm" action="{{ route('user.logout') }}" method="post">
                                        @csrf
                                        <button class="logout-btn" type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <div class="button-container d-flex">
                            <a class="cta-btn login-btn" href="{{ route('login') }}">Login</a>
                            <a class="cta-btn signup-btn" href="{{ route('register') }}">Sign Up</a>
                        </div>
                    @endauth
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list" onclick="toggleNav()"></i>
            </nav>
            
            
        </div>
    </div>
</header>


    
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah anda ingin keluar?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form id="logoutForm" action="{{ route('user.logout') }}" method="post">
                        @csrf
                        <button class="btn btn-danger" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Begin Page Content -->
    <main style="margin-top: 80px;">
        @yield('container')
    </main>

    <footer id="footer" class="footer light-background">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">Puskesmas</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Jl. Raya Abepura Kotaraja.</p>
                        <p> Distrik Jayapura Selatan.</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>(add here, i kinda forgot lol)</span></p>
                        <p><strong>Email:</strong> <span>(add here, i kinda forgot lol)</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                    </div>
                </div>


                <div class="col-lg-4 col-md-6 footer-info">
                    <h4>About Us</h4>
                    <p>Puskesmas (Community Health Center) provides various health services for the community. We strive
                        to deliver the best care possible.</p>
                </div>
            </div>
        </div>
     
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Flipz Ganteng Skripsi&copy; 2024</span>
                </div>
            </div>
        </footer>
    </footer>

    <!-- Vendor JS Files -->
    <script src="{{ asset('stylepasien/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('stylepasien/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('stylepasien/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('stylepasien/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('stylepasien/assets/js/main.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('stylepasien/assets/js/main.js') }}"></script>
    <script>
        function toggleNav() {
    const navMenu = document.querySelector('#navmenu');
    navMenu.classList.toggle('active'); // Toggle the active class to show/hide the menu
}

// Add event listeners to dropdowns for toggling on click
document.querySelectorAll('.dropdown-toggle').forEach(item => {
    item.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        const parentLi = this.parentElement;
        parentLi.classList.toggle('active'); // Toggle active class for dropdown
        const dropdownMenu = parentLi.querySelector('.dropdown-menu');
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block'; // Show/hide the dropdown
    });
});

// Close dropdowns if clicking outside
document.addEventListener('click', function(event) {
    const isDropdown = event.target.closest('.dropdown');
    if (!isDropdown) {
        document.querySelectorAll('.dropdown').forEach(dropdown => {
            dropdown.classList.remove('active');
            dropdown.querySelector('.dropdown-menu').style.display = 'none'; // Hide dropdown
        });
    }
});


    </script>
</body>

</html>