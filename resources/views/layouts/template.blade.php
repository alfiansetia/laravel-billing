<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $comp->name }} - {{ $title }} </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}" />
    <link href="{{ asset('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/js/loader.js') }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/font-icons/fontawesome-free/css/all.min.css') }}">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('plugins/sweetalerts/promise-polyfill.js') }}"></script>
    <link href="{{ asset('plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    @stack('css')
</head>

<body class="sidebar-noneoverflow">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">

            <ul class="navbar-nav theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/img/logo') }}/{{ $comp->logo }}" class="navbar-logo" alt="logo">
                    </a>
                </li>
                <li class="nav-item theme-text ml-1">
                    <a href="{{ route('dashboard') }}" class="nav-link"> {{ $comp->name }} </a>
                </li>
                <li class="nav-item toggle-sidebar">
                    <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
                        <i data-feather="list"></i>
                    </a>
                </li>
            </ul>

            <ul class="navbar-item flex-row navbar-dropdown ml-auto">
                <li class="nav-item dropdown message-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="messageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="message-circle"></i>
                        <span class="badge badge-primary"></span>
                    </a>
                    <div class="dropdown-menu p-0 position-absolute" aria-labelledby="messageDropdown">
                        <div class="">
                            <a class="dropdown-item">
                                <div class="">

                                    <div class="media">
                                        <div class="user-img">
                                            <div class="avatar avatar-xl">
                                                <span class="avatar-title rounded-circle">KY</span>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="">
                                                <h5 class="usr-name">Kara Young</h5>
                                                <p class="msg-title">ACCOUNT UPDATE</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </a>
                            <a class="dropdown-item">
                                <div class="">
                                    <div class="media">
                                        <div class="user-img">
                                            <div class="avatar avatar-xl">
                                                <span class="avatar-title rounded-circle">DA</span>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="">
                                                <h5 class="usr-name">Daisy Anderson</h5>
                                                <p class="msg-title">ACCOUNT UPDATE</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item">
                                <div class="">

                                    <div class="media">
                                        <div class="user-img">
                                            <div class="avatar avatar-xl">
                                                <span class="avatar-title rounded-circle">OG</span>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="">
                                                <h5 class="usr-name">Oscar Garner</h5>
                                                <p class="msg-title">ACCOUNT UPDATE</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown notification-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="bell"></i>
                        <span class="badge badge-success"></span>
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="notificationDropdown">
                        <div class="notification-scroll">

                            <div class="dropdown-item">
                                <div class="media server-log">
                                    <i data-feather="server"></i>

                                    <div class="media-body">
                                        <div class="data-info">
                                            <h6 class="">Server Rebooted</h6>
                                            <p class="">45 min ago</p>
                                        </div>

                                        <div class="icon-status">
                                            <i data-feather="x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-item">
                                <div class="media ">
                                    <i data-feather="heart"></i>
                                    <div class="media-body">
                                        <div class="data-info">
                                            <h6 class="">Licence Expiring Soon</h6>
                                            <p class="">8 hrs ago</p>
                                        </div>

                                        <div class="icon-status">
                                            <i data-feather="x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-item">
                                <div class="media file-upload">
                                    <i data-feather="file-text"></i>
                                    <div class="media-body">
                                        <div class="data-info">
                                            <h6 class="">Kelly Portfolio.pdf</h6>
                                            <p class="">670 kb</p>
                                        </div>

                                        <div class="icon-status">
                                            <i data-feather="check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="settings"></i>
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="user-profile-section">
                            <div class="media mx-auto">
                                <img src="{{ asset('assets/img/profile') }}/{{ $user->foto == '' ? 'default.png' : $user->foto }}" class="img-fluid mr-2" alt="{{ $user->name }}">
                                <div class="media-body">
                                    <h5>{{ $user->name }}</h5>
                                    <p>{{ $user->roles[0]->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            <a href="{{ route('user.profile') }}">
                                <i data-feather="user"></i>
                                <span>My Profile</span>
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="javascript:void(0);">
                                <i data-feather="inbox"></i>
                                <span>My Inbox</span>
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="javascript:void(0);" onclick="logout_()">
                                <i data-feather="log-out"></i>
                                <span>Log Out</span>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">

            <nav id="sidebar">
                <div class="profile-info">
                    <figure class="user-cover-image"></figure>
                    <div class="user-info">
                        <img src="{{ asset('assets/img/profile') }}/{{ $user->foto == '' ? 'default.png' : $user->foto }}" alt="{{ $user->name }}">
                        <h6 class="">{{ $user->name }}</h6>
                        <p class="">{{ $user->roles[0]->name }}</p>
                    </div>
                </div>
                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu {{ $title== 'Dashboard' ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="home"></i>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu menu-heading">
                        <div class="heading">
                            <i data-feather="minus"></i>
                            <span>SERVICE</span>
                        </div>
                    </li>
                    <li class="menu {{ $title== 'Data Bank' ? 'active' : '' }}">
                        <a href="#bankNav" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="settings"></i>
                                <span>Bank</span>
                            </div>
                            <div>
                                <i data-feather="chevron-right"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ $title== 'Data Bank' ? 'show' : '' }}" id="bankNav" data-parent="#accordionExample">
                            <li class="{{ $title == 'Data Bank' ? 'active' : '' }}">
                                <a href="{{ route('bank.index') }}"> Data </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu menu-heading">
                        <div class="heading">
                            <i data-feather="minus"></i>
                            <span>SETTINGS</span>
                        </div>
                    </li>
                    <li class="menu {{ $title== 'Data User' ? 'active' : '' }}">
                        <a href="#userNav" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="users"></i>
                                <span>Users</span>
                            </div>
                            <div>
                                <i data-feather="chevron-right"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ $title== 'Data User' ? 'show' : '' }}" id="userNav" data-parent="#accordionExample">
                            <li class="{{ $title == 'Data User' ? 'active' : '' }}">
                                <a href="{{ route('user.index') }}"> Data </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu {{ $title== 'Setting Profile' || $title== 'Setting Company' ? 'active' : '' }}">
                        <a href="#settingNav" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="settings"></i>
                                <span>Settings</span>
                            </div>
                            <div>
                                <i data-feather="chevron-right"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ $title== 'Setting Profile' || $title== 'Setting Company' ? 'show' : '' }}" id="settingNav" data-parent="#accordionExample">
                            <li class="{{ $title == 'Setting Profile' ? 'active' : '' }}">
                                <a href="{{ route('user.profile') }}"> Profile </a>
                            </li>
                            <li class="{{ $title == 'Setting Company' ? 'active' : '' }}">
                                <a href="{{ route('comp.index') }}"> Company </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

        </div>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->

        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                @yield('content')

            </div>
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © 2021 <a target="_blank" href="https://designreset.com">DesignReset</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg></p>
                </div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->


    </div>
    <form action="{{ route('logout') }}" method="POST" id="form_logout">
        @csrf
    </form>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            App.init();
            $('body').tooltip({
                selector: '[data-toggle="tooltip"]'
            });
        });
    </script>
    <script src="{{ asset('plugins/highlight/highlight.pack.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/scrollspyNav.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->


    <script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalerts/custom-sweetalert.js') }}"></script>
    <script src="{{ asset('plugins/font-icons/feather/feather.min.js') }}"></script>
    <script type="text/javascript">
        feather.replace();

        function logout_() {
            swal({
                title: 'Are you sure?',
                text: "You will be logout!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Yes!',
                confirmButtonAriaLabel: 'Thumbs up, Yes!',
                cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
                cancelButtonAriaLabel: 'Thumbs down',
                padding: '2em',
                animation: false,
                customClass: 'animated tada',
            }).then(function(result) {
                if (result.value) {
                    $('#form_logout').submit();
                }
            })
        }
    </script>

    @stack('js')
</body>

</html>