<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')


</head>



<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin Puskesmas </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/home">
                    <i class="fas fa-clinic-medical"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/data_pasien">
                    <i class="fas fa-head-side-cough"></i>
                    <span>Data Pasien</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{url('add_doctor_dokter')}}">
                    <i class="fas fa-user-md"></i>
                    <span>Dokter</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{url('data_obat')}}">
                    <i class="fas fa-bong"></i>
                    <span>Data Obat</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            @if(Route::has('login'))

                            @auth

                            <x-app-layout>
                            </x-app-layout>




                            @else

                        <li class="nav-item">
                            <a class="btn btn-primary ml-lg-3" href="{{route('login')}}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary ml-lg-3" href="{{route('register')}}">Register</a>
                        </li>

                        @endauth

                        @endif
                        </li>
                    </ul>

                </nav>
                <div class="d-sm-flex align-items-center justify-content-between mb-5">
                    <div class="ml-auto">
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                        </a>
                    </div>
                </div>

                <div class="card shadow mb-4 col-md-6 mx-auto mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah </h6>
                    </div>


                    <div class="card-body">
                        <form id="addDoctorForm" action="{{ route('dokter.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div class="form-group">
                                <label for="name">Nama:</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>

                            <div class="form-group">
                                <label for="spesialis">Spesialis:</label>
                                <select name="spesialis">
                                    <option>--Pilih--</option>
                                    <option value="Umum">Umum</option>
                                    <option value="Gigi dan Mulut">Gigi dan Mulut</option>
                                    <option value="Kehamilan dan Anak">Kehamilan dan Anak</option>
                                    <option value="Gigi">Gigi</option>
                                    <option value="Lab">Lab</option>
                                    <option value="Gizi">Gizi</option>
                                    <option value="Psikologi">Psikologi</option>
                                    <option value="Radiologi">Radiologi</option>
                                    <option value="Fisioterapi">Fisioterapi</option>
                                    <option value="Apoteker">Apoteker</option>
                                </select>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                        <!-- Add more status options as needed -->
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="no_telp">Nomor Telepon:</label>
                                    <input type="tel" class="form-control" id="no_telp" name="no_telp">
                                </div>


                                <div class="form-group">
                                    <label for="foto">Foto:</label>
                                    <input type="file" class="form-control-file  @error('foto') is-invalid @enderror" id="foto" name="foto" accept=".jpg, .jpeg, .png" value="">
                                    @error('foto')
                                    <p>{{$message}}</p>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary btn-primary-hover">Tambah Dokter </button>



                        </form>

                    </div>
                </div>

                <div class="container-fluid">


                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Dokter</h6>
                                </div>

                                <style>
                                    label {
                                        display: block;
                                        /* Make labels block elements to stack them vertically */
                                        margin-bottom: 5px;
                                        /* Add some bottom margin for spacing */
                                        font-weight: bold;
                                        /* Make the label text bold */
                                        color: #333;
                                        /* Set label text color */
                                    }

                                    input[type="text"],
                                    select,
                                    button,
                                    input[type="file"] {
                                        width: 100%;
                                        /* Make the form elements fill their container */
                                        padding: 8px;
                                        /* Add some padding for better appearance */
                                        box-sizing: border-box;
                                        /* Include padding and border in the element's total width and height */
                                        border: 1px solid #ccc;
                                        /* Add a border to the form elements */
                                        border-radius: 4px;
                                        /* Add border-radius for rounded corners */
                                        margin-bottom: 10px;
                                        /* Add some bottom margin for spacing */
                                    }

                                    /* Add some styles to the button */
                                    button.btn-primary {
                                        background-color: #4e73df;
                                        color: #ffffff;
                                        border: none;
                                        padding: 10px 20px;
                                        border-radius: 5px;
                                        cursor: pointer;
                                    }

                                    /* Hover effect for the button */
                                    button.btn-primary:hover {
                                        background-color: #0056b3;
                                    }








                                    input[type="file"] {
                                        border: none;
                                        /* Remove border for file input */
                                        margin-bottom: 20px;
                                        /* Add more bottom margin for file input */
                                    }
                                </style>

                                <!-- Your form elements with styles applied -->
                                <style>
                                    label {
                                        display: block;
                                        margin-bottom: 5px;
                                        font-weight: bold;
                                        color: #333;
                                    }

                                    input[type="text"],
                                    input[type="tel"],
                                    select,
                                    button,
                                    input[type="file"] {
                                        width: 100%;
                                        padding: 8px;
                                        box-sizing: border-box;
                                        border: 1px solid #ccc;
                                        border-radius: 4px;
                                        margin-bottom: 10px;
                                    }

                                    button {
                                        background-color: #4e73df;
                                        color: #ffffff;
                                        border: none;
                                        padding: 10px 20px;
                                        border-radius: 5px;
                                        cursor: pointer;
                                    }

                                    input[type="file"] {
                                        border: none;
                                        margin-bottom: 20px;
                                    }
                                </style>

                                <!-- Add some styles to the button -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Spesialis</th>
                                            <th scope="col">No.HP</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Gambar</th>

                                        </tr>
                                    </thead>
                                    <tbody id="doctorTableBody">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Flipz Skripsi&copy; 2023</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.script')
</body>

</html>