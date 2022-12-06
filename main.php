<?php
  $role = $_SESSION["role"];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php
include("modules/template/header.php");
include("modules/template/menu.php");
include("modules/template/pageScripts.php");

global $settingData;
displayHeader();
?>

<body>
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->
  <div class="preloader" style="opacity: 0.5;filter: alpha(opacity=50);">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <div id="main-wrapper">
    <div style="position: fixed;z-index: 9;width:100%">
      <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
          <div class="navbar-header">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a href="/dashboard" class="navbar-brand">
              <!-- Logo icon -->
              <b class="logo-icon">
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                <img src="/assets/internal/logo-kemkes.png" alt="homepage" class="dark-logo" height="50px" />
                <!-- Light Logo icon -->
                <img src="/assets/internal/logo-kemkes.png" alt="homepage" class="light-logo" height="50px" />
              </b>
              <!--End Logo icon -->
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
              data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
              aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
          </div>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left mr-auto">
              <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light"
                  href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a>
              </li>
              <!-- ============================================================== -->
              <!-- Search -->
              <!-- ============================================================== -->
              <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i
                    class="ti-search"></i></a>
                <form class="app-search position-absolute">
                  <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i
                      class="ti-close"></i></a>
                </form>
              </li>
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">

              <li class="nav-item" id="company_data" style="color: white;margin: auto;"></li>

              <?php displayMenuUserInfo($_SESSION["email"], $settingData); ?>

              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
            </ul>
          </div>
        </nav>
      </header>

      <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
          <!-- Sidebar navigation-->
          <nav class="sidebar-nav">
            <ul id="sidebarnav">
              <!-- User Profile-->
              <?php
                displayMenuAdmin($role);
                displayMenuPemohon($role);
                displayMenuPermohonan($role);
                displayMenuPerizinan($role);
                displayMenuTransaksi($role);
                displayMenuLaporan($role);
                displayMenuPengaturan($role);
                ?>
            </ul>
          </nav>
          <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
      </aside>
    </div>

    <div id="content">
    </div>

    <footer class="footer text-center">
    </footer>
  </div>
  <aside class="customizer">
    <a href="javascript:void(0)" class="service-panel-toggle"><i class="fa fa-spin fa-cog"></i></a>
    <div class="customizer-body">
      <div class="tab-content" id="pills-tabContent">
        <!-- Tab 1 -->
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
          <div class="p-15 border-bottom">
            <!-- Sidebar -->
            <h5 class="font-medium m-b-10 m-t-10">Layout Settings</h5>
            <div class="custom-control custom-checkbox m-t-10">
              <input type="checkbox" onclick="setCookie('Theme', this.checked, 360)" class="custom-control-input"
                name="theme-view" id="theme-view">
              <label class="custom-control-label" for="theme-view">Dark Theme</label>
            </div>

            <div class="custom-control custom-checkbox m-t-10">
              <input type="checkbox" onclick="setCookie('SidebarPosition', this.checked, 360)"
                class="custom-control-input" name="sidebar-position" id="sidebar-position">
              <label class="custom-control-label" for="sidebar-position">Fixed Sidebar</label>
            </div>
            <div class="custom-control custom-checkbox m-t-10">
              <input type="checkbox" onclick="setCookie('HeaderPosition', this.checked, 360)"
                class="custom-control-input" name="header-position" id="header-position">
              <label class="custom-control-label" for="header-position">Fixed Header</label>
            </div>
            <div class="custom-control custom-checkbox m-t-10">
              <input type="checkbox" onclick="setCookie('BoxedLayout', this.checked, 360)" class="custom-control-input"
                name="boxed-layout" id="boxed-layout">
              <label class="custom-control-label" for="boxed-layout">Boxed Layout</label>
            </div>
          </div>
          <div class="p-15 border-bottom">
            <!-- Logo BG -->
            <h5 class="font-medium m-b-10 m-t-10">Logo Backgrounds</h5>
            <ul class="theme-color">
              <li class="theme-item"><a href="javascript:setCookie('logo_skin1', 'skin1', 360)" id="logo_skin1"
                  class="theme-link" data-logobg="skin1"></a></li>
              <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin2"></a></li>
              <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin3"></a></li>
              <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin4"></a></li>
              <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin5"></a></li>
              <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin6"></a></li>
            </ul>
            <!-- Logo BG -->
          </div>
          <div class="p-15 border-bottom">
            <!-- Navbar BG -->
            <h5 class="font-medium m-b-10 m-t-10">Navbar Backgrounds</h5>
            <ul class="theme-color">
              <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin1"></a></li>
              <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin2"></a></li>
              <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin3"></a></li>
              <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin4"></a></li>
              <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin5"></a></li>
              <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin6"></a></li>
            </ul>
            <!-- Navbar BG -->
          </div>
          <div class="p-15 border-bottom">
            <!-- Logo BG -->
            <h5 class="font-medium m-b-10 m-t-10">Sidebar Backgrounds</h5>
            <ul class="theme-color">
              <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin1"></a></li>
              <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin2"></a></li>
              <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin3"></a></li>
              <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin4"></a></li>
              <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin5"></a></li>
              <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin6"></a></li>
            </ul>
            <!-- Logo BG -->
          </div>
        </div>
        <!-- End Tab 1 -->
      </div>
    </div>
  </aside>
  <div class="chat-windows"></div>

  <?php displayPageScripts(false); ?>

  <script>
    //=============================================//
    //    File export                              //
    //=============================================//
    $('#file_export').DataTable({
      dom: 'Bfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });
    $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-cyan text-white mr-1');
  </script>
  <script>
    function setCookie(cname, cvalue, exdays) {
      var d = new Date();
      d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
      var expires = "expires=" + d.toUTCString();
      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function setCookie(cname, cvalue, exdays) {
      var d = new Date();
      d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
      var expires = "expires=" + d.toUTCString();
      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function checkCookie(cname) {
      var vcname = getCookie(cname);
      if (vcname != "") {
        return true;
      } else {
        return false;
      }
    }

    function getCookie(cname) {
      var name = cname + "=";
      var decodedCookie = decodeURIComponent(document.cookie);
      var ca = decodedCookie.split(';');
      for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return "";
    }

    function delCookie(cname) {
      var expires = "Wed; 01 Jan 1970";
      document.cookie = cname + "=;" + expires + ";path=/";
    }

    function unset_sess() {
      window.location = 'logout.php';
    }
  </script>

  <script type="text/javascript">
    const role = "<?php echo $role; ?>";

    $(document).ready(function () {
      var accesstoken = <?php echo json_encode($_COOKIE['accesstoken']); ?>;

      $.ajax({
        url: url_api_x + "PermohonanType",
        type: 'GET',
        beforeSend: function (xhr) {
          xhr.setRequestHeader('Authorization', 'Bearer ' + accesstoken + '');
        },
        dataType: 'json',
        success: function (data, textStatus, xhr) {

        },
        error: function (xhr, textStatus, errorThrown) { }
      });

      var local_nib = localStorage.getItem("nib");
      $(document).keydown(function (e) {
        keyboardShortcut({
          debug: false,
          selector: e,
          key: 'f',
          ctrl: true,
          shift: true
        }, function () {
          $(".form-control-sm").focus()
        })
      })
      $(document).keydown(function (e) {
        keyboardShortcut({
          debug: false,
          selector: e,
          key: 'a',
          ctrl: true,
          shift: true,
        }, function () {
          $(".btn-add-data").click()
        })
      })
      if (checkCookie('Theme')) {
        if (getCookie('Theme') == "true") {
          $("#theme-view").click();
        }
      }
      if (checkCookie('SidebarPosition')) {
        if (getCookie('SidebarPosition') == "true") {
          $("#sidebar-position").click();
        }
      }
      if (checkCookie('HeaderPosition')) {
        if (getCookie('HeaderPosition') == "true") {
          $("#header-position").click();
        }
      }
      if (checkCookie('BoxedLayout')) {
        if (getCookie('BoxedLayout') == "true") {
          $("#boxed-layout").click();
        }
      }

      switch (role) {
        case "Psef.Admin":
          // routing('pemohon_admin');
          routing('welcome_admin');
          break;
        case "psef.bpom":
          // routing('pemohon_admin');
          routing('perizinan_user');
          break;
        default:
          routing('welcome');
      }
    });
  </script>
</body>

</html>