<?php
function displayMenuPemohon($role)
{
  if (strtolower($role) == "psef.bpom") {
    return;
  }

  $route = "";
  $href = "javascript:void(0)";

  switch ($role) {
    case "Psef.Verifikator":
      $route = "routing('pemohon_verif')";
      break;
    case "Psef.Supervisor":
      $route = "routing('pemohon_kasi')";
      break;
    case "Psef.Timja":
      $route = "routing('pemohon_kasubdit')";
      break;
    case "Psef.Dirpenyanfar":
      $route = "routing('pemohon_diryanfar')";
      break;
    case "Psef.Dirjen":
      $route = "routing('pemohon_dirjen')";
      break;
    case "Psef.ValidatorSertifikat":
      $route = "routing('pemohon_validator')";
      break;
    case "Psef.Admin":
      $route = "routing('pemohon_admin')";
      break;
    default:
      $href = "/pemohon-user";
      break;
  }
?>
<li class="sidebar-item">
  <a onclick="<?php echo $route; ?>" class="sidebar-link two-column" href="<?php echo $href; ?>" aria-expanded="false">
    <i class="mdi mdi-account-circle"></i>Pemohon
  </a>
</li>
<?php
}

function displayMenuPermohonan($role)
{
  if (strtolower($role) == "psef.bpom") {
    return;
  }
?>
<li class="sidebar-item">
  <a class="sidebar-link has-arrow" href="javascript:void()" aria-expanded="false">
    <i class="fa fa-share"></i>Pendaftaran PSEF
  </a>

  <?php
  // if ($role == "Psef.Admin") {
  //   displayMenuPermohonanAdmin();
  // }

  if (is_null($role) || $role == "") {
    displayMenuPermohonanUser();
  } else {
    displayMenuPermohonanAdmin($role);
  }

  // if ($role == "Psef.ValidatorSertifikat") {
  //   displayMenuPermohonanValidator();
  // }

  // if ($role == "Psef.Verifikator") {
  //   displayMenuPermohonanPendingSemua("pending_verif", "semua_verif");
  // }

  // if ($role == "Psef.Supervisor") {
  //   displayMenuPermohonanPendingSemua("pending_kasi", "semua_kasi");
  // }

  // if ($role == "Psef.Timja") {
  //   displayMenuPermohonanPendingSemua("pending_kasubdit", "semua_kasubdit");
  // }

  // if ($role == "Psef.Dirpenyanfar") {
  //   displayMenuPermohonanPendingSemua("pending_diryanfar", "semua_diryanfar");
  // }

  // if ($role == "Psef.Dirjen") {
  //   displayMenuPermohonanPendingSemua("pending_dirjen", "semua_dirjen");
  // }
?>

</li>
<?php
}

function displayMenuPermohonanAdmin($role)
{
  $href = "javascript:void(0)";
?>
<ul aria-expanded="false" class="collapse first-level">
  <?php
  if ($role == "Psef.Dirpenyanfar") {
    displaySidebarMenuItem("routing('pending_diryanfar')", $href, "Tertunda", "fa fa-exclamation-circle");
  }
  if ($role == "Psef.Dirjen") {
    displaySidebarMenuItem("routing('pending_dirjen)", $href, "Tertunda", "fa fa-exclamation-circle");
  }
  displaySidebarMenuItem("routing('baru_admin')", $href, "Permohonan Baru", "mdi mdi-file-outline");
  displaySidebarMenuItem("routing('pending_verif')", $href, "Dalam Proses Verifikator", "mdi mdi-timer-sand");
  displaySidebarMenuItem("routing('pending_kasi')", $href, "Dalam Proses Supervisi", "mdi mdi-timer-sand");
  displaySidebarMenuItem("routing('pending_kasubdit')", $href, "Dalam Proses KaTimja", "mdi mdi-timer-sand");
  displaySidebarMenuItem("routing('pending_dirjen')", $href, "Disetujui Direktur", "mdi mdi-check-circle");
  displaySidebarMenuItem("routing('disetujui_dirjen')", $href, "Disetujui Dirjen", "mdi mdi-check-circle");
  // displaySidebarMenuItem("routing('selesai_admin')", $href, "Selesai", "mdi mdi-check-circle");
  // displaySidebarMenuItem("routing('ditolak_admin')", $href, "Ditolak", "mdi mdi-close-circle");
?>
</ul>
<?php
}

function displayMenuPermohonanUser()
{
?>
<ul aria-expanded="false" class="collapse first-level">
  <?php
  displaySidebarMenuItem("", "/permohonan-user/rumusan", "Rumusan", "mdi mdi-file-outline");
  displaySidebarMenuItem("", "/permohonan-user/dalam-proses", "Dalam Proses", "mdi mdi-timer-sand");
  displaySidebarMenuItem("", "/permohonan-user/dikembalikan", "Dikembalikan", "mdi mdi-keyboard-return");
  displaySidebarMenuItem("", "/permohonan-user/selesai", "Selesai", "mdi mdi-check-circle");
  displaySidebarMenuItem("", "/permohonan-user/ditolak", "Ditolak", "mdi mdi-close-circle");
?>
</ul>
<?php
}

function displayMenuPermohonanValidator()
{
  $href = "javascript:void(0)";
?>
<ul aria-expanded="false" class="collapse first-level">
  <?php
  displaySidebarMenuItem("routing('pending_validator')", $href, "Tertunda", "fa fa-exclamation-circle");
  displaySidebarMenuItem("routing('done_validator')", $href, "Selesai", "fa fa-check-circle");
  displaySidebarMenuItem("routing('semua_validator')", $href, "Semua", "mdi mdi-file-multiple");
?>
</ul>
<?php
}

function displayMenuPermohonanPendingSemua(string $pendingRoute, string $allRoute)
{
  $href = "javascript:void(0)";
?>
<ul aria-expanded="false" class="collapse first-level">
  <?php
  displaySidebarMenuItem("routing('{$pendingRoute}')", $href, "Tertunda", "fa fa-exclamation-circle");
  displaySidebarMenuItem("routing('{$allRoute}')", $href, "Semua", "mdi mdi-file-multiple");
?>
</ul>
<?php
}

function displayMenuPermohonanSemua(string $allRoute)
{
  $href = "javascript:void(0)";
?>
<ul aria-expanded="false" class="collapse first-level">
  <?php
  displaySidebarMenuItem("routing('rumusan_$allRoute')", $href, "Rumusan", "mdi mdi-file-outline");
  displaySidebarMenuItem("routing('pending_$allRoute')", $href, "Tertunda", "fa fa-exclamation-circle");
  displaySidebarMenuItem("routing('semua_$allRoute')", $href, "Semua", "mdi mdi-file-multiple");
?>
</ul>
<?php
}

function displayMenuPerizinan($role)
{
  $route = "";
  $href = "javascript:void(0)";

  switch ($role) {
    case "Psef.Verifikator":
    case "Psef.Supervisor":
    case "Psef.Timja":
    case "Psef.Dirpenyanfar":
    case "Psef.Dirjen":
    case "Psef.ValidatorSertifikat":
    case "psef.bpom":
    case "Psef.Admin":
      $route = "routing('perizinan_user')";
      break;
    default:
      $href = "/tanda-daftar";
      break;
  }
?>
<li class="sidebar-item">
  <a onclick="<?php echo $route; ?>" class="sidebar-link two-column" href="<?php echo $href; ?>" aria-expanded="false">
    <i class="fa fa-id-card"></i>Tanda Terdaftar
  </a>
</li>
<?php
}

function displayMenuLaporan($role)
{
  if($role == "psef.bpom"){
    return;
  }
  
  $route = "";
  $href = "javascript:void(0)";

  switch($role){
    case "Psef.Verifikator":
      case "Psef.Supervisor":
      case "Psef.Timja":
      case "Psef.Dirpenyanfar":
      case "Psef.Dirjen":
      case "Psef.ValidatorSertifikat":
      case "Psef.Admin":
        $route = "routing('laporan')";
        break;
      default:
        $href = "/laporan";
        break;
  }
?>
<li class="sidebar-item">
  <a onclick="<?php echo $route; ?>" class="sidebar-link two-column" href="<?php echo $href; ?>" aria-expanded="false">
    <i class="fa fa-book"></i>Laporan
  </a>
</li>
<?php
}

function displayMenuPengaturan($role)
{
  $route = "";
  $href = "javascript:void(0)";
  switch($role){
    case "Psef.Verifikator":
      case "Psef.Supervisor":
      case "Psef.Timja":
      case "Psef.Dirpenyanfar":
      case "Psef.Dirjen":
      case "psef.bpom":
      case "Psef.ValidatorSertifikat":
      case "Psef.Admin":
        $route = "routing('integrasi_api_admin')";
        break;
      default:
        $href = "/integrasi-api";
        break;
  }
  
?>
<li class="sidebar-item">
  <a onclick="<?php echo $route; ?>" class="sidebar-link two-column" href="<?php echo $href; ?>" aria-expanded="false">
    <i class="fas fa-cogs"></i> Integrasi API
  </a>
</li>
<?php
}

function displayMenuTransaksi($role)
{
  if (strtolower($role) == "psef.bpom") {
    return;
  }

  if (is_null($role) || $role == "") {
    return;
  }
?>
<li class="sidebar-item">
  <a onclick="routing('transaksi')" class="sidebar-link two-column" href="javascript:void()" aria-expanded="false">
    <i class="fa fa-list-ul"></i>Data Transaksi
  </a>
</li>
<?php
}

function displayMenuAdmin($role)
{
  if (is_null($role) || $role != "Psef.Admin") {
    return;
  }

  $href = "javascript:void(0)";
?>
<li class="sidebar-item">
  <a class="sidebar-link two-column has-arrow" href="javascript:void(0)" aria-expanded="false">
    <i class="fa fa-cogs"></i>Administrasi
  </a>

  <ul aria-expanded="false" class="collapse first-level">
    <?php
  displaySidebarMenuItem("routing('provinsi')", $href, "Provinsi", "mdi mdi-adjust");
  displaySidebarMenuItem("routing('spanduk')", $href, "Spanduk", "mdi mdi-adjust");
  displaySidebarMenuItem("routing('berita')", $href, "Berita", "mdi mdi-adjust");
  displaySidebarMenuItem("routing('unduhan')", $href, "Unduhan", "mdi mdi-adjust");
?>
  </ul>
</li>
<?php
}

function displayMenuUserInfo(string $email, $settingData)
{
?>
<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle text-orange" href="" data-toggle="dropdown" aria-haspopup="true"
    aria-expanded="false">
    <i class="fas fa-user-circle h1 mt-3"></i>
  </a>

  <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
    <span class="with-arrow">
      <span class="bg-primary">
      </span>
    </span>

    <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
      <i class="fa fa-user"></i>

      <div class="m-l-10">
        <h4 class="mb-0">
        </h4>

        <p class="mb-0">
          <?php echo $email; ?>
        </p>
      </div>
    </div>

    <a class="dropdown-item" href="<?php echo $settingData->identity->identityServerUrl; ?>/Manage" target="_blank">
      <i class="far fa-id-card mr-2"></i>Profil Saya
    </a>

    <a class="dropdown-item" href="<?php echo $settingData->identity->identityServerUrl; ?>/Manage/ChangePassword"
      target="_blank">
      <i class="fa fa-key mr-2"></i>Ganti Kata Sandi
    </a>

    <a class="dropdown-item" href="/logout">
      <i class="fas fa-sign-out-alt mr-2"></i>Keluar
    </a>
  </div>
</li>
<?php
}

function displaySidebarMenuItem(string $route, string $href, string $caption, string $iconClass)
{
?>
<li class="sidebar-item">
  <a onclick="<?php echo $route; ?>" href="<?php echo $href; ?>" class="sidebar-link">
    <i class="<?php echo $iconClass; ?>"></i>
    <?php echo $caption; ?>
  </a>
</li>
<?php
}