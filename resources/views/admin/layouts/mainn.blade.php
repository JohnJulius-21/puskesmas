<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Admin - Puskesmas</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('template/assets/img/favicon/favicon.ico') }}" />

    <link rel="stylesheet" href="{{ asset('template/assets/datatables/datatables.min.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    {{-- <link href="{{ asset('template/css/sb-admin-2.css') }}" rel="stylesheet"> --}}
    <!-- Icons. Uncomment required icon fonts -->
    {{-- <link href="{{ asset('template/css/sb-admin-2.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('template/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('template/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <!-- Helpers -->
    <script src="{{ asset('template/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('template/assets/js/config.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}

  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="/data_pasien" class="app-brand-link">
              <span class="app-brand-text demo menu-text fw-bolder ms-2 stylish-text" style="text-transform: uppercase;">Puskesmas</span>
          </a>
          
          
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
        </div>
        
        <!-- CSS Styles for Stylish Text -->
        <style>
            .stylish-text {
                font-family: 'Poppins', sans-serif; /* Modern font choice */
                font-size: 28px; /* Slightly larger font size */
                color: #333; /* Darker color for better readability */
                text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1); /* Lighter shadow for subtle effect */
                letter-spacing: 1.5px; /* Adjusting letter spacing for clarity */
                transition: transform 0.3s ease, color 0.3s ease; /* Smooth hover effects */
            }
        
            .stylish-text:hover {
                color: #555; /* Slightly darker color on hover */
                transform: scale(1.03); /* Minimal zoom-in effect on hover */
            }
            <style>
    .custom-btn-color {
        background-color: #FFFFFF; /* Tomato color */
        color: white;
    }

    .custom-riwayat-btn {
        background-color: #f5f5f9; /* Custom background color */
        color: black; /* Adjust text color to make sure it contrasts well */
        border: 1px solid #ccc; /* Optional border to enhance visibility */
    }
    <style>
    .custom-purple-btn {
        background-color: purple; /* Set the background to purple */
        color: white; /* Ensure the text color contrasts with the background */
        border: 1px solid #ccc; /* Optional border for visibility */
    }
    .custom-purple-btn {
        color: #800080; /* Purple text color */
        border: 2px solid #800080; /* Purple border */
        background-color: transparent; /* Transparent background */
    }

    .custom-purple-btn:hover {
        background-color: #800080; /* Purple background on hover */
        color: white; /* White text on hover */
    }

    .custom-purple-btn i {
        color: #800080; /* Purple icon color */
    }

    .custom-purple-btn:hover i {
        color: white; /* White icon on hover */
    }
    .custom-white-btn {
        background-color: white;
        color: blue;
        border: 2px solid blue;
    }

    .custom-white-btn:hover {
        background-color: #f0f0f0; /* Slight hover effect */
        color: darkblue; /* Change text color on hover */
        border-color: darkblue; /* Change border color on hover */
    }

    .custom-white-btn .fas {
        color: blue; /* Icon color */
    }

    .custom-white-btn:hover .fas {
        color: darkblue; /* Icon color on hover */
    }
</style>

</style>
        </style>
        
        

          <div class="menu-inner-shadow"></div>
          <li class="menu-item {{ Request::is('pemeriksaan*') ? 'active' : '' }}">
            <a href="{{ route('pemeriksaan') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book-add"></i>
                <div data-i18n="Analytics">Konsultasi</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('resep*') ? 'active' : '' }}">
          <a href="{{ route('resep') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-book"></i>
              <div data-i18n="Analytics">Resep</div>
          </a>
      </li>
        <ul class="menu-inner py-1">
          <li class="menu-item {{ Request::is('data_pasien*') ? 'active' : '' }}">
              <a href="/data_pasien" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-user"></i>
                  <div data-i18n="Analytics">Data Pasien</div>
              </a>
          </li>

          <li class="menu-item {{ Request::is('data_obat*') ? 'active' : '' }}">
            <a href="{{ url('data_obat') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bong"></i>
                <div data-i18n="Analytics">Data Obat</div>
            </a>
        </li>

       
            <li class="menu-item {{ Request::is('add_doctor_dokter*') ? 'active' : '' }}">
                <a href="/add_doctor_dokter" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-plus-medical"></i>
                    <div data-i18n="Analytics">Dokter</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('riwayat_antrian') ? 'active' : '' }}">
              <a href="{{ route('riwayat_antrian') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-history"></i>
                <div data-i18n="Analytics">Riwayat Konsultasi</div>
              </a>
            </li>
      
       
       
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>
            
            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow border" href="javascript:void(0);" data-bs-toggle="dropdown">
                      Hello! Welcome {{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : 'Guest' }}

                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li>
                        <!-- Trigger untuk membuka modal logout -->
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logout-modal">
                          <i class="bx bx-power-off me-2"></i>
                          <span class="align-middle">Log Out</span>
                      </a>
                      
                      </li>
                    </ul>
                </li>
              </ul>
            </div>
            <!-- Modal Logout -->
    
          </nav>
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container">
                <main>
                    @yield('container')
                </main>
            </div>

            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                      document.write(new Date().getFullYear());
                  </script>
                  71190479 - Joshua Penta Sohilait a.k.a Flipz Ganteng
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

    </div>
    <div id="logout-modal" class="modal fade" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true" style="display: none; z-index: 2050; position: fixed; top: 50%; left: 50%; width: 29%; height: 39%; transform: translate(-50%, -50%); overflow: hidden; outline: 0; background: none; box-shadow: none; border: none;">
      <div class="modal-dialog" style="z-index: 2050; border: none; box-shadow: none; padding: 0;">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <p>Apakah Anda yakin ingin logout?</p>
              </div>
              <div class="modal-footer">
                  <form action="{{ route('adminLogout') }}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-danger">Logout</button>
                  </form>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              </div>
          </div>
      </div>
  </div>
  
    
  


    <!-- datatables JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
    <script src="{{ asset('template/assets/datatables/datatables.min.js') }}"></script>
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('template/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('template/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('template/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('template/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('template/assets/js/dashboards-analytics.js') }}"></script>
    

    

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}

  </body>
</html>
