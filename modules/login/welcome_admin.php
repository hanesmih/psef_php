<?php
session_start();

if ($_SESSION["role"] == "") {
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card mt-5 py-3">
        <div class="card-header text-center">
          <h3>Selamat datang di Sistem PSEF, untuk melanjutkan silahkan pilih pada menu yang ada</h3>
          <h3 class="text-danger">PENTING: Mohon periksa dahulu Data Pemohon Anda, sebelum mengajukan Permohonan.</h3>
        </div>
      </div>
    </div>
  </div>
  <?php
  return;
}
?>

  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-5 align-self-center">
        <h4 class="page-title">Dasbor</h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb" id="list-breadcrumb">
              <li class="breadcrumb-item"><a href="javascript:void(0)">Dasbor</a></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- ============================================================== -->
  <!-- End Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <!-- Container fluid  -->
  <!-- ============================================================== -->
  <div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Sales chart -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-8 col-md-8">
        <div class="card">
          <div class="card-body border-top">
            <div class="row m-b-0">
              <!-- col -->
              <div class="col-lg-12 col-md-12">
                <div class="d-flex align-items-center">
                  <div id="piechart_3d"></div>
                </div>
              </div>

              <!-- col -->
            </div>
          </div>
        </div>
      </div>
      <div class="col-4 col-md-4">
        <div class="card" style="height: 400.8px;">
          <div class="card-body border-top">
            <div class="row m-b-0">
              <!-- col -->
              <div class="col-lg-12 col-md-6">
                <div class="d-flex align-items-center" onclick="routing('semua_admin')" style="cursor: pointer;">
                  <div class="m-r-10"><span class="text-cyan display-5"><i class="fa fa-share"></i></span></div>
                  <div><span>Total Permohonan</span>
                    <h3 class="font-medium m-b-0" id="total_permohonan"></h3>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-6">
                <div class="d-flex align-items-center" onclick="routing('proses_admin')" style="cursor: pointer;">
                  <div class="m-r-10"><span class="text-success display-5"><i class="mdi mdi-refresh"></i></span></div>
                  <div><span>Total Permohonan Dalam Proses</span>
                    <h3 class="font-medium m-b-0" id="total_permohonan_proses"></h3>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-6">
                <div class="d-flex align-items-center" onclick="routing('perizinan_user')" style="cursor: pointer;">
                  <div class="m-r-10"><span class="text-info display-5"><i class="fa fa-id-card"></i></span></div>
                  <div><span>Total Sertifikat PSEF</span>
                    <h3 class="font-medium m-b-0" id="total_perizinan"></h3>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 col-md-6">
                <div class="d-flex align-items-center" onclick="routing('ditolak_admin')" style="cursor: pointer;">
                  <div class="m-r-10"><span class="text-danger display-5"><i class="mdi mdi-close-circle"></i></span>
                  </div>
                  <div><span>Total Permohonan Ditolak</span>
                    <h3 class="font-medium m-b-0" id="total_permohonan_ditolak"></h3>
                  </div>
                </div>
              </div>
              <!-- col -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Google Charts -->
  <script type="text/javascript" src="/assets/libs/gstatic/loader.js"></script>
  <script>
    var accesstoken = <?php echo json_encode($_COOKIE['accesstoken']); ?>;
    google.charts.load("current", { packages: ["corechart"] });


    $(document).ready(function () {
      switch (role) {
        case 'Psef.Admin':
          cek_pending_permohonan('', '', 'Admin');
          break;

        default:
          break;
      }

    });

    function drawChart(datas) {
      try {
        var data = new google.visualization.arrayToDataTable([
          ['Task', 'Total'],
          // ['Total Permohonan', datas.totalPermohonan],
          ['Total Permohonan Dalam Proses', datas.totalPermohonanDalamProses],
          ['Total Sertifikat PSEF', datas.totalPerizinan],
          ['Total Permohonan Pending', datas.totalPermohonanPending],
          ['Total Permohonan Ditolak', datas.totalPermohonanDitolak]
        ]);

        var options = {
          title: 'Diagram Permohonan',
          is3D: true,
          height: 360,
          width: 820,
          // pieHole: 0.2,
          // fontSize: 10,
          backgroundColor: 'transparent',
          legend: {
            position: 'labeled'
          }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
      catch (err) {
        console.error(err.message);
      }
    }

    function cek_pending_permohonan(url_cek, url_pending, url_dashboard) {
      $.ajax({
        url: url_api_x + 'Dashboard' + url_dashboard,
        type: 'GET',
        beforeSend: function (xhr) {
          xhr.setRequestHeader('Authorization', 'Bearer ' + accesstoken + '');
        },
        dataType: 'json',
        success: function (data, textStatus, xhr) {
          //call chart
          google.charts.setOnLoadCallback(function () { drawChart(data); });

          $('#total_pemohon').html(data.totalPemohon)
          $('#total_perizinan').html(data.totalPerizinan)
          $('#total_permohonan').html(data.totalPermohonan)
          if (role != "Psef.Admin") $('#total_permohonan_pending').html(data.totalPermohonanPending);
          $('#total_permohonan_proses').html(data.totalPermohonanDalamProses)
          $('#total_permohonan_ditolak').html(data.totalPermohonanDitolak)

        },
        error: function (xhr, textStatus, errorThrown) { }
      });
    }
  </script>