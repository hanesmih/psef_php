<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"]);
require_once("configReader.php");
$settingData = readConfig();
$fileUrl = $settingData->resourceUrl;
$apiUrl = $settingData->apiServerUrl;
$userRole = $_SESSION["role"];
?>
<!-- Template for view -->
<script id="view-data" type="text/x-handlebars-template">
  <h4 class="card-title">
    Detail Data Sertifikat PSEF
  </h4>

  <form class="m-t-30">
    <div class="col-sm-12">
      <div class="box" style="border: none; box-shadow: none">
        <div class="box-body" id="stepbar"></div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Tanggal Terbit</label>
          <input value="{{data_izin.issuedAt}}" type="text" class="form-control" disabled>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Tanggal Berakhir</label>
          <input value="{{data_izin.expiredAt}}" type="text" class="form-control" disabled>
        </div>
      </div>
    </div>

    <h4 class="card-title" style="font-weight: bold;">
      Data Pemohon
    </h4>

    <hr class="m-t-0">

    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label class="control-label">Nomor Telepon Pemohon</label>
          <input value="{{data_pemohon.phone}}" type="text" class="form-control" disabled>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="control-label">Email</label>
          <input value="{{data_pemohon.email}}" type="text" class="form-control" disabled>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="control-label">Nama Perusahaan</label>
          <input value="{{data_pemohon.companyName}}" type="text" class="form-control" disabled>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label>Alamat</label>
      <textarea class="form-control" rows="4" disabled>{{data_pemohon.address}}</textarea>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label class="control-label">
            NIB
          </label>

          <input value="{{data_pemohon.nib}}" type="text" class="form-control" name="nib" id="nib" disabled>

          <small class="form-text text-muted">
            <div id="cek_nib" style="color:white;" ></div>
          </small>
        </div>
      </div>
    </div>

    <div id="nib_view"></div>
    <input type="hidden" id="status_nib">

    <h4 class="card-title" style="font-weight: bold;">
      Data Permohonan
    </h4>

    <hr class="m-t-0">

    <?php
      require_once('../../template/view_data_permohonan.php');
      require_once('../../template/view_dokumen.php');
      require_once('../../template/table_apotek.php');
      require_once('../../template/table_klinik.php');
      require_once('../../template/table_rumah_sakit.php');

    ?>

    <button type="button" class="btn btn-danger" onclick="viewRouting()">
      Kembali
    </button>

    <button
      onclick="window.open('<?php echo $fileUrl; ?>{{data_izin.tandaDaftarUrl}}')"
      target="_blank"
      type="button"
      class="btn btn-success"
    >
      Unduh Tanda Daftar
    </button>
    <button
      onclick="downloadOSSIzin({{data_izin.id}}, '<?php echo $apiUrl; ?>', '<?php echo $fileUrl; ?>', '<?php echo $_SESSION["accessToken"]; ?>', '.preloader')"
      type="button"
      class="btn btn-secondary"
    >
      Unduh Izin OSS
    </button>
  </form>
</script>
