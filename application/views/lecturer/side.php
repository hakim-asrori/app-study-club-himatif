<?php $user = $this->db->get_where('tb_users', ['email' => $this->session->userdata('email')])->row(); ?>
<body class="fix-header">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <div id="pesan"></div>
    <div id="wrapper">

        <style>
            .open .dropdown-menu {
                width: 100%;
                padding: 10px 14px 5px;
                display: flex;
                flex-direction: column;
                border-bottom-right-radius: 5px;
                border-bottom-left-radius: 5px;
            }

            .open .dropdown-menu a {
                height: 50%;
            }

            .open .dropdown-item {
                margin-bottom: 5px;
            }

            .open .dropdown-divider {
                margin-bottom: 5px;
                border-bottom: 1px solid #EAEAEA;
            }
        </style>
        <nav class="navbar navbar-default navbar-static-top m-b-0 " style="z-index: 999">
            <div class="navbar-header bg-primary">
                <div class="top-left-part">
                    <a class="logo" href="/lecturers">
                        <b style="color:black">
                            Study
                        </b>
                        <span class="text-dark">
                            Club
                        </span> 
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <a class="nav-toggler open-close waves-effect waves-light hidden-md hidden-lg" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
                    </li>
                    <li class="dropdown">
                        <a class="profile-pic dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="<?= $user->foto != 'default.jpg' ? '/assets/img/profile/'.$user->foto : '/assets/img/profile/default.jpg' ?>" alt="user-img" width="36" height="36" class="img-circle"><b class="hidden-xs"><?= $this->session->userdata('email'); ?> </b></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/profil">Profil Saya</a>
                            <a class="dropdown-item" href="/profil/password">Ubah Password</a>
                            <div class="dropdown-divider"></div>
                            <a href="#sign-out" class="btn btn-danger btn-block dropdown-item waves-effect waves-light" data-toggle="modal" data-target="#signoutModal">Sign Out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="navbar-default sidebar" role="navigation" style="z-index: 1;">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
                </div>
                <ul class="nav" id="side-menu">
                    <li style="padding: 70px 0 0;">
                        <a href="/lecturers" class="waves-effect"><i class="fa fa-fw material-icons" aria-hidden="true">home</i>Home</a>
                    </li>
                    <li style="">
                        <a href="/lecturer/materi" class="waves-effect "><i class="fa fa-fw material-icons" aria-hidden="true">drive_folder_upload</i>Upload Materi</a>
                    </li>
                    <li style="">
                        <a href="/lecturer/tugas" class="waves-effect "><i class="fa fa-fw material-icons" aria-hidden="true">backup</i>Upload Tugas</a>
                    </li>
                    <li style="">
                        <a href="/leaderboard" class="waves-effect "><i class="fa fa-fw material-icons" aria-hidden="true">emoji_events</i>Leaderboard</a>
                    </li>
                </ul>
                <div class="center p-20">
                    <a href="#sign-out" class="btn btn-danger btn-block waves-effect waves-light" data-toggle="modal" data-target="#signoutModal">LogOut</a>
                </div>
            </div>

        </div>
        <div id="page-wrapper">
            <div class="container-fluid">