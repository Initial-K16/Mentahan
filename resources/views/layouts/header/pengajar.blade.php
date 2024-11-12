<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LearnAcces - Dashboard</title>
    <link rel="shortcut icon" href="{{ asset('img/logo/siu.png') }}" type="image/x-icon">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <style>
        .nav-item .nav-link.active {
            background-color: #f8f9fc;
            color: #4e73df !important;
            font-weight: 600;
            position: relative;
        }

        .nav-item .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: #4e73df;
        }

        .nav-item .nav-link.active i {
            color: #4e73df;
        }

        .nav-item .nav-link:hover {
            background-color: #f8f9fc;
            color: #4e73df !important;
            transition: all 0.3s ease;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon" style="display: flex; justify-content: center; align-items: center; width: 160px; height: 100px;">
                    <img src="{{ asset('img/logo/auah.svg') }}" class="logo" style="max-width: 100%; max-height: 100%; height: auto;">
                </div>
            </a>
            <hr class="sidebar-divider my-0">

            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pengajar.pengajar-dashboard') }}" id="menu-dashboard" data-route="dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Features
            </div>

            <!-- Data Upload -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('upload.index') }}" id="menu-upload" data-route="upload">
                    <i class="far fa-fw fa-window-maximize"></i>
                    <span>Upload Materi/Tugas</span>
                </a>
            </li>

            <!-- Data Materi -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('materi.index') }}" id="menu-materi" data-route="materi">
                    <i class="fab fa-fw fa-wpforms"></i>
                    <span>Kelola Materi</span>
                </a>
            </li>

            <!-- Data Tugas -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('tugas.index') }}" id="menu-tugas" data-route="tugas">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Kelola Tugas</span>
                </a>
            </li>

            <!-- Data Tugas Murid -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pengajar.tugas.tugas-murid') }}" id="menu-tugas-murid" data-route="tugas-murid">
                    <i class="fas fa-fw fa-palette"></i>
                    <span>Submit Tugas Murid</span>
                </a>
            </li>
            <hr class="sidebar-divider">
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars" style="color: white;"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle"
                                    src="{{ Auth::user()->profile_photo ? asset('storage/profile_photos/' . Auth::user()->profile_photo) : asset('default-profile.png') }}"
                                    style="max-width: 60px">
                                <span class="ml-2 d-none d-lg-inline text-white small">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('pengajar.profile.index') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End TopBar -->

                <!-- Container -->
                <div class="container-fluid" id="container-wrapper">
                    @yield('content')
                </div>
                <!-- End Container -->
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <script>document.write(new Date().getFullYear());</script>
                            - LearnAcces
                        </span>
                    </div>
                </div>
            </footer>
            <!-- End Footer -->
        </div>
    </div>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Apakah Anda yakin ingin keluar?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary">Keluar</button>
                </form>
            </div>
        </div>
    </div>
  </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/ruang-admin.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var path = window.location.pathname;
            console.log('Current path:', path);
        
            function setActiveMenu(menuId) {
                // Remove 'active' class from all menu items
                document.querySelectorAll('.nav-item .nav-link').forEach(function(el) {
                    el.classList.remove('active');
                });
        
                // Add 'active' class to the specified menu item
                var menuElement = document.getElementById(menuId);
                if (menuElement) {
                    menuElement.classList.add('active');
                    console.log('Activated menu:', menuId);
                } else {
                    console.error('Menu element not found:', menuId);
                }
            }
        
            // Check for exact matches first
            if (path.endsWith('/dashboard')) {
                setActiveMenu('menu-dashboard');
            } else if (path.endsWith('/upload')) {
                setActiveMenu('menu-upload');
            } else if (path.endsWith('/materi')) {
                setActiveMenu('menu-materi');
            } else if (path.includes('/pengajar/pengumpulan-tugas')) {
                setActiveMenu('menu-tugas-murid');
            } else if (path.includes('/tugas')) {
                setActiveMenu('menu-tugas');
            } else {
                // If no exact match, try matching based on data-route
                var menuItems = document.querySelectorAll('.nav-item .nav-link');
                var matchFound = false;
                menuItems.forEach(function(item) {
                    var route = item.getAttribute('data-route');
                    if (route && path.includes(route)) {
                        setActiveMenu(item.id);
                        matchFound = true;
                    }
                });
        
                if (!matchFound) {
                    console.log('No matching menu found for path:', path);
                }
            }
        });
        </script>
</body>
</html>