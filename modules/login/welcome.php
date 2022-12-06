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
              <!-- <div class="col-lg-12 col-md-6">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><span class="text-dark display-5"><i class="mdi mdi-account-circle"></i></span></div>
                                            <div><span>Total Pemohon</span>
                                                <h3 class="font-medium m-b-0" id="total_pemohon"></h3>
                                            </div>
                                        </div>
                                    </div> -->
              <div class="col-lg-12 col-md-12">
                <div class="d-flex align-items-center">
                  <div id="piechart_3d"></div>
                </div>
              </div>
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
                <div class="d-flex align-items-center" onclick="directPage()" style="cursor: pointer;">
                  <div class="m-r-10"><span class="text-cyan display-5"><i class="fa fa-share"></i></span></div>
                  <div><span>Total Permohonan</span>
                    <h3 class="font-medium m-b-0" id="total_permohonan"></h3>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-6">
                <div class="d-flex align-items-center" onclick="processPage()" style="cursor: pointer;">
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
              <!-- <div class="col-lg-12 col-md-6">
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10"><span class="text-warning display-5"><i class="mdi mdi-alert"></i></span></div>
                                            <div><span>Total Permohonan Tertunda</span>
                                                <h3 class="font-medium m-b-0" id="total_permohonan_pending"></h3>
                                            </div>
                                        </div>
                                    </div> -->

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
    <?php
if ($_SESSION["role"] != "Psef.Admin") {
?>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body border-top">
            <h4>Aktivitas Terbaru</h4>
            <div class="table-responsive" id="table-data-here">
              <table id="zero_config_ra" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th>Domain</th>
                    <th>Aktifitas</th>
                    <th>Tanggal</th>
                  </tr>
                </thead>
                <tbody class="detail-item-ra">
                  <!-- Isi detail-item -->
                </tbody>
              </table>
              <!-- Table content goes here -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
}
?>
  </div>

  <!-- Google Charts -->
  <script type="text/javascript" src="/assets/libs/gstatic/loader.js"></script>
  <script>
    var accesstoken = <?php echo json_encode($_COOKIE['accesstoken']); ?>;
    google.charts.load("current", { packages: ["corechart"] });


    $(document).ready(function () {
      switch (role) {
        case 'Psef.Verifikator':
          cek_pending_permohonan('VerifikatorPendingTotal', 'pending_verif', 'Verifikator');
          break;

        case 'Psef.Supervisor':
          cek_pending_permohonan('KepalaSeksiPendingTotal', 'pending_kasi', 'KepalaSeksi');
          break;

        case 'Psef.Timja':
          cek_pending_permohonan('KepalaSubDirektoratPendingTotal', 'pending_kasubdit', 'KepalaSubDirektorat');
          break;

        case 'Psef.Dirpenyanfar':
          cek_pending_permohonan('DirekturPelayananFarmasiPendingTotal', 'pending_diryanfar', 'DirekturPelayananFarmasi');
          break;

        case 'Psef.Dirjen':
          cek_pending_permohonan('DirekturJenderalPendingTotal', 'pending_dirjen', 'DirekturJenderal');
          break;

        case 'Psef.ValidatorSertifikat':
          cek_pending_permohonan('ValidatorSertifikatPendingTotal', 'pending_validator', 'ValidatorSertifikat');
          break;

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

          $.each(data.aktifitas, function (index, value) {
            let data_date_ac = moment(value.date).format("YYYY-MM-DD");
            let id_permohonan_ac = '';
            if (value.item === null) {
              id_permohonan_ac = ''
            } else {
              id_permohonan_ac = value.item
            }
            $(".detail-item-ra").append(`<tr>
                                            <td>${id_permohonan_ac}</td>
                                            <td>${value.action}</td>
                                            <td>${data_date_ac}</td>
                                        </tr>`)
          });
          $('#zero_config_ra').DataTable({
            "order": [
              [2, "desc"]
            ]
          })
        },
        error: function (xhr, textStatus, errorThrown) { }
      });

      if (role == "Psef.Admin") return;

      $.ajax({
        url: url_api_x + 'Permohonan/' + url_cek,
        type: 'GET',
        beforeSend: function (xhr) {
          xhr.setRequestHeader('Authorization', 'Bearer ' + accesstoken + '');
        },
        dataType: 'json',
        success: function (data, textStatus, xhr) {
          if (data.value > 0) {
            swal({
              title: "Ada " + data.value + " Permohonan yang belum di Lihat",
              text: "Apakah anda ingin melihatnya ?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: "Batal",
              confirmButtonText: 'Ya, Saya ingin melihatnya!'
            }).then((result) => {
              if (result.value) {
                routing(url_pending)
              }
            })
          }

        },
        error: function (xhr, textStatus, errorThrown) { }
      });
    }

    function directPage(){
      if(role == "Psef.Verifikator"){
        return routing('semua_verif');
      }
      if(role == "Psef.Supervisor"){
        return routing('semua_kasi');
      }
      if(role == "Psef.Timja"){
        return routing('semua_kasubdit');
      }
      if(role == "Psef.Dirpenyanfar"){
        return routing('semua_diryanfar');
      }
      if(role == "Psef.Dirjen"){
        return routing('semua_dirjen');
      }
    }

    function processPage(){
      if(role == "Psef.Verifikator"){
        return routing('pending_verif');
      }
      if(role == "Psef.Supervisor"){
        return routing('pending_kasi');
      }
      if(role == "Psef.Timja"){
        return routing('pending_kasubdit');
      }
      if(role == "Psef.Dirpenyanfar"){
        return routing('pending_diryanfar');
      }
      if(role == "Psef.Dirjen"){
        return routing('pending_dirjen');
      }
    }
  </script>