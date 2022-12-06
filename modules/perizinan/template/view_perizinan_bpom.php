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

    <hr class="m-t-0">

    <h4 class="card-title" style="font-weight: bold;">
      Data Permohonan
    </h4>

    <hr class="m-t-0">

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">Alamat Domain Web</label>
                <input type="text" class="form-control" value="{{data_permohonan.domain}}" disabled>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">Dokumen Proses Bisnis</label>
                <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
                    <a href="<?php echo $fileUrl; ?>{{data_permohonan.prosesBisnisUrl}}" target="_blank">{{data_permohonan.name_prosesBisnisUrl}}</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">Dokumen Application Programmer Interface Sistem PSEF</label>
                <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
                    <a href="<?php echo $fileUrl; ?>{{data_permohonan.dokumenApiUrl}}" target="_blank">{{data_permohonan.name_dokumenApiUrl}}</a>
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-danger" onclick="viewRouting()">
      Kembali
    </button>
  </form>
</script>
