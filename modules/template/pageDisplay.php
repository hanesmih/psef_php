<?php
require_once("header.php");
require_once("menu.php");
require_once("pageScripts.php");

function displayPage(callable $contentFunction, $scriptFunction, string $pageTitle)
{
  global $settingData;
  $role = $_SESSION["role"] ?? "";
?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <?php displayHeader($pageTitle); ?>

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
              <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                <i class="ti-menu ti-close"></i>
              </a>

              <!-- ============================================================== -->
              <!-- Logo -->
              <!-- ============================================================== -->
              <a href="/dashboard" class="navbar-brand">
                <b class="logo-icon">
                  <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                  <img src="/assets/internal/logo-kemkes.png" alt="homepage" class="dark-logo" height="50px" />
                  <img src="/assets/internal/logo-kemkes.png" alt="homepage" class="light-logo" height="50px" />
                </b>
              </a>

              <!-- ============================================================== -->
              <!-- Toggle which is visible on mobile only -->
              <!-- ============================================================== -->
              <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="ti-more"></i>
              </a>
            </div>

            <div class="navbar-collapse collapse" id="navbarSupportedContent">
              <ul class="navbar-nav float-left mr-auto">
                <li class="nav-item d-none d-md-block">
                  <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                    <i class="mdi mdi-menu font-24"></i>
                  </a>
                </li>
              </ul>

              <ul class="navbar-nav float-right">
                <?php displayMenuUserInfo($_SESSION["email"] ?? "", $settingData); ?>
              </ul>
            </div>
          </nav>
        </header>

        <aside class="left-sidebar">
          <div class="scroll-sidebar">
            <nav class="sidebar-nav">
              <ul id="sidebarnav">
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
          </div>
        </aside>
      </div>

      <div id="content">
        <?php $contentFunction(); ?>
      </div>

      <footer class="footer text-center">
      </footer>
    </div>

    <?php
    displayPageScripts(false);

    if (is_callable($scriptFunction)) {
      $scriptFunction();
    }
    ?>
  </body>

  </html>
<?php
}

function displayError(string $title, $response)
{
?>
  <div class="container-fluid">
    <div class="card text-center text-white bg-danger m-3">
      <h3 class="card-title mt-4"><?php echo $title; ?></h3>
      <div class="card-body">
        Error code: <?php echo $response->result; ?>
      </div>
    </div>
  </div>
<?php
}
