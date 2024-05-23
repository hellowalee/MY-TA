<!DOCTYPE html>
<html lang="zxx">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Finance</title>
    <link rel="icon" href="https://demo.dashboardpack.com/finance-html/img/logo.png" type="image/png">

    <link rel="stylesheet" href="https://demo.dashboardpack.com/finance-html/css/bootstrap1.min.css" />

    <link rel="stylesheet" href="https://demo.dashboardpack.com/finance-html/vendors/themefy_icon/themify-icons.css" />

    <link rel="stylesheet"
        href="https://demo.dashboardpack.com/finance-html/vendors/swiper_slider/css/swiper.min.css" />

    <link rel="stylesheet" href="https://demo.dashboardpack.com/finance-html/vendors/select2/css/select2.min.css" />

    <link rel="stylesheet" href="https://demo.dashboardpack.com/finance-html/vendors/niceselect/css/nice-select.css" />

    <link rel="stylesheet"
        href="https://demo.dashboardpack.com/finance-html/vendors/owl_carousel/css/owl.carousel.css" />

    <link rel="stylesheet" href="https://demo.dashboardpack.com/finance-html/vendors/gijgo/gijgo.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://demo.dashboardpack.com/finance-html/vendors/tagsinput/tagsinput.css" />

    <link rel="stylesheet"
        href="https://demo.dashboardpack.com/finance-html/vendors/datatable/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://demo.dashboardpack.com/finance-html/vendors/datatable/css/responsive.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://demo.dashboardpack.com/finance-html/vendors/datatable/css/buttons.dataTables.min.css" />

    <link rel="stylesheet" href="https://demo.dashboardpack.com/finance-html/vendors/text_editor/summernote-bs4.css" />

    <link rel="stylesheet" href="https://demo.dashboardpack.com/finance-html/vendors/morris/morris.css">

    <link rel="stylesheet"
        href="https://demo.dashboardpack.com/finance-html/vendors/material_icon/material-icons.css" />

    <link rel="stylesheet" href="https://demo.dashboardpack.com/finance-html/css/metisMenu.css">

    <link rel="stylesheet" href="https://demo.dashboardpack.com/finance-html/css/style1.css" />
    <link rel="stylesheet" href="https://demo.dashboardpack.com/finance-html/css/colors/default.css" id="colorSkinCSS">
</head>

<body class="crm_body_bg">



    <nav class="sidebar">
        <div class="logo d-flex justify-content-between">
            <a href="https://demo.dashboardpack.com/finance-html/index.html"><img
                    src="https://demo.dashboardpack.com/finance-html/img/logo.png" alt></a>
            <div class="sidebar_close_icon d-lg-none">
                <i class="ti-close"></i>
            </div>
        </div>
        <ul id="sidebar_menu">
            <li class="mm-active">
                <a class="has-arrow1" href="/admin/dashboard" aria-expanded="false">
                    <img src="https://demo.dashboardpack.com/finance-html/img/menu-icon/1.svg" alt>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class>
                <a class="has-arrow1" href="/admin/asset/list/all" aria-expanded="false">
                    <img src="https://demo.dashboardpack.com/finance-html/img/menu-icon/2.svg" alt>
                    <span>Manajemen Aset </span>
                </a>
                <ul>
                    <li><a href="/admin/asset/list/Tanah">Tanah</a></li>
                    <li><a href="/admin/asset/list/Bangunan">Bangunan</a></li>
                </ul>
            </li>
        </ul>
    </nav>


    <section class="main_content dashboard_part">

        <div class="container-fluid g-0">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="header_iner d-flex justify-content-between align-items-center">
                        <div class="sidebar_icon d-lg-none">
                            <i class="ti-menu"></i>
                        </div>
                        <div class="serach_field-area">
                            <div class="search_inner">
                                <form action="#">
                                    <div class="search_field">
                                        <input type="text" placeholder="Search here...">
                                    </div>
                                    <button type="submit"> <img
                                            src="https://demo.dashboardpack.com/finance-html/img/icon/icon_search.svg"
                                            alt> </button>
                                </form>
                            </div>
                        </div>
                        <div class="header_right d-flex justify-content-between align-items-center">
                            <div class="header_notification_warp d-flex align-items-center">
                                <li>
                                    <a href="#"> <img
                                            src="https://demo.dashboardpack.com/finance-html/img/icon/bell.svg" alt>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"> <img
                                            src="https://demo.dashboardpack.com/finance-html/img/icon/msg.svg" alt>
                                    </a>
                                </li>
                            </div>
                            <div class="profile_info">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRh2monDpyJhELbQ02nKN41VyHERpD0SRRB9SsyNr0Ehw&s"
                                    alt="#">
                                    <div class="profile_info_iner">
                                        <p>Welcome 
                                            @if (Auth::user()->isAdmin == '1')
                                                Admin 
                                            @else
                                                User
                                            @endif
                                            !!!
                                        </p>
                                        <h5>{{ Auth::user()->email }}</h5>
                                        <div class="profile_info_details">
                                            <a href="#">My Profile <i class="ti-user"></i></a>
                                            <a href="#">Settings <i class="ti-settings"></i></a>
                                            <a href="/session/logout">Log Out <i class="ti-shift-left"></i></a>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main_content_iner ">
            @yield('main')
        </div>

        <div class="footer_part">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="footer_iner text-center">
                            <p>2020 © Influence - Designed by<a href="#">
                                    Dashboard</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script src="https://demo.dashboardpack.com/finance-html/js/jquery1-3.4.1.min.js"></script>

    <script src="https://demo.dashboardpack.com/finance-html/js/popper1.min.js"></script>

    <script src="https://demo.dashboardpack.com/finance-html/js/bootstrap1.min.js"></script>

    <script src="https://demo.dashboardpack.com/finance-html/js/metisMenu.js"></script>

    <script src="https://demo.dashboardpack.com/finance-html/vendors/count_up/jquery.waypoints.min.js"></script>

    <script src="https://demo.dashboardpack.com/finance-html/vendors/chartlist/Chart.min.js"></script>

    <script src="https://demo.dashboardpack.com/finance-html/vendors/count_up/jquery.counterup.min.js"></script>

    <script src="https://demo.dashboardpack.com/finance-html/vendors/swiper_slider/js/swiper.min.js"></script>

    <script src="https://demo.dashboardpack.com/finance-html/vendors/niceselect/js/jquery.nice-select.min.js"></script>

    <script src="https://demo.dashboardpack.com/finance-html/vendors/owl_carousel/js/owl.carousel.min.js"></script>

    <script src="https://demo.dashboardpack.com/finance-html/vendors/gijgo/gijgo.min.js"></script>

    <script src="https://demo.dashboardpack.com/finance-html/vendors/datatable/js/jquery.dataTables.min.js"></script>
    <script src="https://demo.dashboardpack.com/finance-html/vendors/datatable/js/dataTables.responsive.min.js"></script>
    <script src="https://demo.dashboardpack.com/finance-html/vendors/datatable/js/dataTables.buttons.min.js"></script>
    <script src="https://demo.dashboardpack.com/finance-html/vendors/datatable/js/buttons.flash.min.js"></script>
    <script src="https://demo.dashboardpack.com/finance-html/vendors/datatable/js/jszip.min.js"></script>
    <script src="https://demo.dashboardpack.com/finance-html/vendors/datatable/js/pdfmake.min.js"></script>
    <script src="https://demo.dashboardpack.com/finance-html/vendors/datatable/js/vfs_fonts.js"></script>
    <script src="https://demo.dashboardpack.com/finance-html/vendors/datatable/js/buttons.html5.min.js"></script>
    <script src="https://demo.dashboardpack.com/finance-html/vendors/datatable/js/buttons.print.min.js"></script>
    <script src="https://demo.dashboardpack.com/finance-html/js/chart.min.js"></script>

    <script src="https://demo.dashboardpack.com/finance-html/vendors/progressbar/jquery.barfiller.js"></script>

    <script src="https://demo.dashboardpack.com/finance-html/vendors/tagsinput/tagsinput.js"></script>

    <script src="https://demo.dashboardpack.com/finance-html/vendors/text_editor/summernote-bs4.js"></script>
    <script src="https://demo.dashboardpack.com/finance-html/vendors/apex_chart/apexcharts.js"></script>

    <script src="https://demo.dashboardpack.com/finance-html/js/custom.js"></script>

    <script src="https://demo.dashboardpack.com/finance-html/js/active_chart.js"></script>
    <script src="https://demo.dashboardpack.com/finance-html/vendors/apex_chart/radial_active.js"></script>
    <script src="https://demo.dashboardpack.com/finance-html/vendors/apex_chart/stackbar.js"></script>
    <script src="https://demo.dashboardpack.com/finance-html/vendors/apex_chart/area_chart.js"></script>

    <script src="https://demo.dashboardpack.com/finance-html/vendors/apex_chart/bar_active_1.js"></script>
    <script src="https://demo.dashboardpack.com/finance-html/vendors/chartjs/chartjs_active.js"></script>

</body>

</html>
