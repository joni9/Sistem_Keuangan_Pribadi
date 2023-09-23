
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets-dashboard/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets-dashboard/img/favicon.png">
  <title>
    Sistem Keuangan Pribadi
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="assets-dashboard/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="assets-dashboard/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets-dashboard/demo/demo.css" rel="stylesheet" />

  {{-- jquery --}}
{{-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> --}}
<script src="assets/jquery-3.7.1.min.js"></script>

  {{-- datatable local --}}
<link href="DataTables/datatables.min.css" rel="stylesheet">
<link href="DataTables/datatables.css" rel="stylesheet">
<script src="DataTables/datatables.js"></script>
<link href="DataTables/Buttons-2.4.2/css/buttons.dataTables.min.css" type="text/css" rel="stylesheet">
{{-- boostrap offline --}}
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
{{-- select2 --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
{{-- fancy box --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
{{-- sweet alert --}}
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.min.css
" rel="stylesheet">



{{-- datatble online --}}
{{-- <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.js"></script> --}}

</head>

<body class="">
  <div class="wrapper">
    <div class="sidebar">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
      <div class="sidebar-wrapper">
        <div class="logo">
          <a href="javascript:void(0)" class="simple-text logo-mini">
            CT
          </a>
          <a href="javascript:void(0)" class="simple-text logo-normal">
            Creative Tim
          </a>
        </div>
        <ul class="nav">
          <li class="{{ request()->routeIs(['dashboard']) ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="{{ request()->routeIs(['pemasukan']) ? 'active' : '' }}">
            <a href="{{ route('pemasukan') }}">
              <i class="tim-icons icon-atom"></i>
              <p>Pemasukan</p>
            </a>
          </li>
          <li li class="{{ request()->routeIs(['pengeluaran']) ? 'active' : '' }}">
            <a href="{{ route('pengeluaran') }}">
              <i class="tim-icons icon-pin"></i>
              <p>Pengeluaran</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:void(0)">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
              <li class="dropdown nav-item">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <div class="photo">
                    <img src="assets-dashboard/img/anime3.png" alt="Profile Photo">
                  </div>
                  <b class="caret d-none d-lg-block d-xl-block"></b>
                  <p class="d-lg-none">
                    Log out
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-navbar">
                  <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Profile</a></li>
                  <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Settings</a></li>
                  <li class="nav-link"><a href="{{ route('logout') }}" class="nav-item dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
              </li>
              <li class="separator d-lg-none"></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Navbar -->
      <div class="content">
        @yield('content')
      </div>
      

      <footer class="footer">
        <div class="container-fluid">
          {{-- <ul class="nav">
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                Creative Tim
              </a>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                About Us
              </a>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                Blog
              </a>
            </li>
          </ul> --}}
          <div class="copyright">
            ©2023 Develop <i class="tim-icons icon-heart-2"></i> by
            <a href="javascript:void(0)" target="_blank">Joni Evendi</a>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <div class="fixed-plugin">
    <div class="dropdown show-dropdown">
      <a href="#" data-toggle="dropdown">
        <i class="fa fa-cog fa-2x"> </i>
      </a>
      <ul class="dropdown-menu">
        <li class="header-title"> Sidebar Background</li>
        <li class="adjustments-line">
          <a href="javascript:void(0)" class="switch-trigger background-color">
            <div class="badge-colors text-center">
              <span class="badge filter badge-primary active" data-color="primary"></span>
              <span class="badge filter badge-info" data-color="blue"></span>
              <span class="badge filter badge-success" data-color="green"></span>
            </div>
            <div class="clearfix"></div>
          </a>
        </li>
        <li class="adjustments-line text-center color-change">
          <span class="color-label">LIGHT MODE</span>
          <span class="badge light-badge mr-2"></span>
          <span class="badge dark-badge ml-2"></span>
          <span class="color-label">DARK MODE</span>
        </li>
      </ul>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets-dashboard/js/core/jquery.min.js"></script>
  <script src="assets-dashboard/js/core/popper.min.js"></script>
  <script src="assets-dashboard/js/core/bootstrap.min.js"></script>
  <script src="assets-dashboard/js/plugins/perfect-scrollbar.jquery.min.js"></script>

  <!-- Chart JS -->
  <script src="assets-dashboard/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets-dashboard/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets-dashboard/js/black-dashboard.min.js?v=1.0.0"></script><!-- Black Dashboard DEMO methods, don't include it in your project! -->
  {{-- <script src="assets-dashboard/demo/demo.js"></script> --}}
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');
        $navbar = $('.navbar');
        $main_panel = $('.main-panel');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');
        sidebar_mini_active = true;
        white_color = false;

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();



        $('.fixed-plugin a').click(function(event) {
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .background-color span').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data', new_color);
          }

          if ($main_panel.length != 0) {
            $main_panel.attr('data', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data', new_color);
          }
        });

        $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            sidebar_mini_active = false;
            blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
          } else {
            $('body').addClass('sidebar-mini');
            sidebar_mini_active = true;
            blackDashboard.showSidebarMessage('Sidebar mini activated...');
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);
        });

        $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (white_color == true) {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').removeClass('white-content');
            }, 900);
            white_color = false;
          } else {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').addClass('white-content');
            }, 900);

            white_color = true;
          }


        });

        $('.light-badge').click(function() {
          $('body').addClass('white-content');
        });

        $('.dark-badge').click(function() {
          $('body').removeClass('white-content');
        });
      });
    });
  </script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "black-dashboard-free"
      });
  </script>

<script>
    $(document).ready(function () {
        // Cek apakah ada pesan sukses pada session
        var successMessage = '{{ session("success") }}';
        if (successMessage) {
            // Tampilkan Sweet Alert sukses
            Swal.fire({
                title: 'Sukses',
                text: successMessage,
                icon: 'success'
            });
        }

        // Cek apakah ada pesan error pada session
        var errorMessage = '{{ session("error") }}';
        if (errorMessage) {
            // Tampilkan Sweet Alert error
            Swal.fire({
                title: 'Error',
                text: errorMessage,
                icon: 'error'
            });
        }
        var errorMessage = '{{ session("info") }}';
        if (errorMessage) {
            // Tampilkan Sweet Alert error
            Swal.fire({
                title: 'info',
                text: errorMessage,
                icon: 'info'
            });
        }
    });
</script>

{{-- offline datatable dengan button --}}
<script src="DataTables/datatables.min.js"></script>
<script src="DataTables/Buttons-2.4.2/js/buttons.dataTables.min.js"></script>
<script src="DataTables/Buttons-2.4.2/js/buttons.html5.min.js"></script>
<script src="DataTables/Buttons-2.4.2/js/buttons.print.min.js"></script>
<script src="DataTables/Buttons-2.4.2/js/buttons.colVis.min.js"></script>
{{-- tombol exel --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.6.0/jszip.min.js"></script>

{{-- select2 --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
   {{-- fancy box image --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

{{-- sweet alert --}}
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js
"></script>

{{-- dattable online --}}
{{-- <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.js"></script> --}}
</body>

</html>