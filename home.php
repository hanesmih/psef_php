<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php
require_once('analytics.php');
require_once('modules/template/header.php');
require_once('modules/template/pageScripts.php');

global $settingData;
displayHeader();
?>

<body>
  <div class="main-wrapper" style="background: #eef5f9;">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
      <div class="row">

        <nav class="col navbar navbar-dark bg-dark d-xs-block d-lg-none">
          <img src="/assets/internal/logo-kemkes.png" alt="logo" class="light-logo" height="50px" />

          <button class="navbar-toggler mr-2" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
          </button>

          <?php displayMobileMenu($settingData); ?>
        </nav>

        <div class="page-wrapper col-12 col-lg-8 d-block">
          <div class="form-horizontal">
            <div class="card-body">
              <div id="_the_view_" class="col-md-12">
                <div class="box box-info bg-white">
                  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" id="homePageBanner">
                      <?php displayBanner($settingData); ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>

                  <hr />

                  <div class="jumbotron text-center" style="background-image: url(../assets/images/bg2.jpg);">
                    <h1>Selamat Datang di Sistem PSEF</h1>
                    <hr />
                    <h2>Penyelenggara Sistem Elektronik Farmasi (PSEF)</h2>
                  </div>

                  <div class="card">
                    <h4 class="card-header bg-dark text-white">TENTANG PENDAFTARAN PSEF</h4>
                    <p class="card-body text-justify" style="font-size: 1.25em;">
                      Pendaftaran Penyelenggara Sistem Elektronik Farmasi (PSEF) merupakan persyaratan untuk
                      Penyelenggara Sistem Elektronik (PSE) yang memfasilitasi pelayanan kefarmasian.<br />
                      Pelaku usaha yang dapat mendaftarkan diri sebagai PSEF adalah pelaku usaha berbadan hukum, dan telah
                      atau akan bekerjasama dengan pelaksana pekerjaan kefarmasian sesuai dengan ketentuan yang berlaku.<br />
                      Pemberi pelayanan kefarmasian yang difasilitasi oleh PSEF harus berupa apotek yang resmi dan berizin.
                    </p>
                  </div>

                  <div class="card">
                    <h4 class="card-header bg-purple text-white">PERSYARATAN PENDAFTARAN</h4>

                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">
                        <i class="fa fa-check-square mr-2"></i>Data pemohon
                      </li>
                      <li class="list-group-item">
                        <i class="fa fa-check-square mr-2"></i>Memiliki NIB
                      </li>
                      <li class="list-group-item">
                        <i class="fa fa-check-square mr-2"></i>Memiliki Tanda Daftar Penyelenggara Sistem Elektronik (PSE)
                      </li>
                      <li class="list-group-item">
                        <i class="fa fa-check-square mr-2"></i>Memiliki Izin Usaha Berbentuk IUI/PMSE
                      </li>
                      <li class="list-group-item">
                        <i class="fa fa-check-square mr-2"></i>Memiliki Apoteker Penanggungjawab
                      </li>
                      <li class="list-group-item">
                        <i class="fa fa-check-square mr-2"></i>Mengisi Data Permohonan
                      </li>
                      <li class="list-group-item">
                        <i class="fa fa-check-square mr-2"></i>Membuat Surat Permohonan
                      </li>
                      <li class="list-group-item">
                        <i class="fa fa-check-square mr-2"></i>Membuat Dokumentasi API
                      </li>
                      <li class="list-group-item">
                        <i class="fa fa-check-square mr-2"></i>Membuat Dokumen Proses Bisnis Aplikasi
                      </li>
                      <li class="list-group-item">
                        <i class="fa fa-check-square mr-2"></i>Membuat Surat Pernyataan Komitmen bekerjasama dengan Apotek
                      </li>
                      <li class="list-group-item">
                        <i class="fa fa-check-square mr-2"></i>Memiliki daftar apotek jaringan yang bekerjasama
                      </li>
                    </ul>

                    <?php displayUnduhan($settingData); ?>

                    <!-- <div class="mt-2">
                      <a target="_blank" href="/assets/doc/Checklist%20Perizinan%20PSEF%20untuk%20Pemohon.xlsx" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start text-primary">
                        <h5>Checklist Perizinan PSEF Untuk Pemohon</h5><i class="fa fa-download"></i>
                      </a>
                      <a target="_blank" href="/assets/doc/Contoh%20Surat%20Pernyataan.docx" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start text-primary">
                        <h5>Contoh Surat Pernyataan</h5><i class="fa fa-download"></i>
                      </a>
                      <a target="_blank" href="/assets/doc/Surat%20Komitmen%20Bekerja%20Sama%20dengan%20Apotek.docx" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start text-primary">
                        <h5>Surat Komitmen Bekerja Sama dengan Apotek</h5><i class="fa fa-download"></i>
                      </a>
                      <a target="_blank" href="/assets/doc/Surat%20Permohonan%20Dit%20PPF.docx" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start text-primary">
                        <h5>Surat Permohonan</h5><i class="fa fa-download"></i>
                      </a>
                    </div> -->
                  </div>

                  <div class="card">
                    <h4 class="card-header bg-success text-white">TANDA DAFTAR PSEF YANG TERBIT</h4>

                    <table class="tablesaw tablesaw-stack" data-tablesaw-mode="stack">
                      <thead class="text-center bg-light text-cyan">
                        <tr>
                          <th>Tanda Daftar PSEF</th>
                          <th>Nama Perusahaan</th>
                          <th>Domain</th>
                          <th>Tanggal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php displayPerizinan($settingData); ?>
                      </tbody>
                    </table>
                  </div>

                  <div class="card">
                    <h4 class="card-header bg-secondary text-white">BERITA</h4>
                    <div class="row mt-2" id="homePageNews">
                    </div>
                  </div>

                  <!-- <div class="card">
                    <h4 class="card-header bg-cyan text-white">UNDUHAN</h4>
                    <div class="card-body" id="home-unduhan">
                      <?php //displayUnduhan($settingData); ?>
                    </div>
                  </div> -->

                  <div class="card">
                    <h4 class="card-header bg-orange text-white">STATISTIK PENGUNJUNG</h4>
                    <div class="card-body" id="home-statistik">
                      <?php
retrieveAnalytics();
?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="auth-box on-sidebar text-white col-lg-4 d-none d-lg-block">
          <div id="loginform">
            <?php displayDesktopLoginLink($settingData); ?>

            <div class="form-group mt-4">
              <h3 class="text-center">Kontak Kami</h3>
              <hr class="white-line my-1" />
              <div>
                <i class="fa fa-envelope mr-2" aria-hidden="true"></i>admin-psef@kemkes.go.id
              </div>
              <div>
                <i class="fa fa-map-marker mr-2" aria-hidden="true"></i>Gedung adhyatma lt. 8 ruang 809 Jl. H.R Rasuna Said Blok X5 Kav. 4-9 Jakarta
              </div>
              <div class="text-center mt-2 pt-2">
                Sertifikat Elektronik Dijamin oleh:
                <img src="/assets/internal/logo-bsre.png" alt="logo" width="50%" />
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <?php displayPageScripts(true); ?>

  <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ==============================================================
    // Login and Recover Password
    // ==============================================================
    $('#to-recover').on("click", function() {
      $("#loginform").slideUp();
    });
  </script>
  <script>
    $(document).ready(function() {
      $.ajax({
        url: "<?php echo "{$settingData->apiServerUrl}/api/v1/HomepageNews"; ?>",
        type: 'GET',
        dataType: 'json',
        success: function(data, textStatus, xhr) {
          $.each(data.value, function(index, value) {
            displayHomeNewsItem("<?php echo $settingData->resourceUrl; ?>", value, index);
          });
        },
        error: function(xhr, textStatus, errorThrown) {
          console.log('Error in Operation');
        }
      });

      <?php
displayOssSsoToaster();
?>
    });
  </script>
</body>

</html>

<?php
function getDataFromApi($settingData, string $apiUrl)
{
  // $fileContent = file_get_contents("{$settingData->apiServerUrl}{$apiUrl}");
  $arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
  );

  $fileContent = file_get_contents("{$settingData->apiServerUrl}{$apiUrl}", false, stream_context_create($arrContextOptions));

  if ($fileContent === false) {
    return false;
  }

  return json_decode($fileContent, false);
}

function displayBanner($settingData)
{
  $apiResponse = getDataFromApi($settingData, "/api/v1/HomepageBanner");

  if ($apiResponse === false) {
    return;
  }

  $index = 0;

  foreach ($apiResponse->value as $row) {
    $active = $index == 0 ? "active" : "";
?>
    <div class="carousel-item <?php echo $active; ?>">
      <img class="d-block w-100" src="<?php echo "{$settingData->resourceUrl}{$row->url}"; ?>" alt="Banner Image">
    </div>
  <?php
    $index++;
  }
}

function displayPerizinan($settingData)
{
  $apiResponse = getDataFromApi($settingData, "/api/v0.1/Perizinan/HalamanMuka");

  if ($apiResponse === false) {
    return;
  }

  foreach ($apiResponse->value as $row) {
    $issuedDate = DateTime::createFromFormat("Y-m-d\TH:i:sP", $row->issuedAt);
?>
    <tr>
      <td><?php echo $row->perizinanNumber; ?></td>
      <td><?php echo $row->companyName; ?></td>
      <td><?php echo $row->domain; ?></td>
      <td><?php echo $issuedDate->format("d-m-Y"); ?></td>
    </tr>
  <?php
  }
}

function displayUnduhan($settingData)
{
  $apiResponse = getDataFromApi($settingData, "/api/v1/HomepageUnduhan");

  if ($apiResponse === false) {
    return;
  }

?>
  <div class="mt-2">
</div>
<?php
  foreach ($apiResponse->value as $row) {
?>
  <a target="_blank" href="<?php echo "{$settingData->resourceUrl}{$row->url}"; ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start text-primary">
    <h5><?php echo $row->title; ?></h5><i class="fa fa-download"></i>
  </a>
  <?php
  }
  ?>
  </div>
  <?php
}

function displayMobileMenu($settingData)
{
?>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mx-5">
      <?php
  if (isset($_SESSION["ssoSuccess"]) && $_SESSION["ssoSuccess"] == true) {
?>
        <li class="nav-item mt-5 mb-3">
          <a href="/login" class="btn btn-rounded btn-block btn-info">
            Masuk
          </a>
        </li>
      <?php
  }
?>
    </ul>
  </div>
<?php
}

function displayOssSsoToaster()
{
  if (!isset($_SESSION["ssoSuccess"])) {
    return;
  }
  
  echo "displayOssSsoToastr({$_SESSION["ssoStatusCode"]}, '{$_SESSION["ssoReason"]}');";
}

function displayDesktopLoginLink($settingData)
{
?>
  <div class="logo mb-3">
    <img src="/assets/internal/logo-psef-white.png" alt="logo" width="60%" />
  </div>

  <?php
  if (!isset($_SESSION["ssoSuccess"]) || $_SESSION["ssoSuccess"] == false) {
    return;
  }
?>

  <a href="/login" class="btn btn-block btn-lg btn-rounded btn-primary mt-3">Masuk</a>

<?php
}
