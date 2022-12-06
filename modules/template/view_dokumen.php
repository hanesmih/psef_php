<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"]);
require_once("configReader.php");
$settingData = readConfig();
$fileUrl = $settingData->resourceUrl;
?>
<!-- Dokumen Penunjang -->
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label class="control-label">Salinan STRA</label>
      <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
        <a href="<?php echo $fileUrl; ?>{{data_permohonan.straUrl}}" target="_blank">{{data_permohonan.name_straUrl}}</a>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label class="control-label">Surat Permohonan</label>
      <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
        <a href="<?php echo $fileUrl; ?>{{data_permohonan.suratPermohonanUrl}}" target="_blank">{{data_permohonan.name_suratPermohonanUrl}}</a>
      </div>
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
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label class="control-label">Dokumen Application Programmer Interface Sistem PSEF</label>
      <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
        <a href="<?php echo $fileUrl; ?>{{data_permohonan.dokumenApiUrl}}" target="_blank">{{data_permohonan.name_dokumenApiUrl}}</a>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label class="control-label">Dokumen PSE Kominfo</label>
      <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
        <a href="<?php echo $fileUrl; ?>{{data_permohonan.dokumenPseUrl}}" target="_blank">{{data_permohonan.name_dokumenPseUrl}}</a>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label class="control-label">Dokumen Izin Usaha Berbentuk IUI/PMSE</label>
      <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
        <a href="<?php echo $fileUrl; ?>{{data_permohonan.izinUsahaUrl}}" target="_blank">{{data_permohonan.name_izinUsahaUrl}}</a>
      </div>
    </div>
  </div>
  <!-- <div class="col-md-4">
    <div class="form-group">
      <label class="control-label">SPPL</label>
      <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
        <a href="<?php echo $fileUrl; ?>{{data_permohonan.spplUrl}}" target="_blank">{{data_permohonan.name_spplUrl}}</a>
      </div>
    </div>
  </div> -->
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label class="control-label">Surat Pernyataan Komitmen bekerjasama dengan Apotek</label>
      <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
        <a href="<?php echo $fileUrl; ?>{{data_permohonan.komitmenKerjasamaApotekUrl}}" target="_blank">{{data_permohonan.name_komitmenKerjasamaApotekUrl}}</a>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label class="control-label">Surat Pernyataan Keaslian Dokumen</label>
      <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
        <a href="<?php echo $fileUrl; ?>{{data_permohonan.pernyataanKeaslianDokumenUrl}}" target="_blank">{{data_permohonan.name_pernyataanKeaslianDokumenUrl}}</a>
      </div>
    </div>
  </div>
  <!-- <div class="col-md-4">
    <div class="form-group">
      <label class="control-label">Pembayaran PNBP</label>
      <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
        <a href="<?php echo $fileUrl; ?>{{data_permohonan.pembayaranPnbpUrl}}" target="_blank">{{data_permohonan.name_pembayaranPnbpUrl}}</a>
      </div>
    </div>
  </div> -->
</div>

<!--<div class="row">
<div class="col-md-4">
    <div class="form-group">
      <label class="control-label">Izin Lokasi</label>
      <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
        <a href="<?php echo $fileUrl; ?>{{data_permohonan.izinLokasiUrl}}" target="_blank">{{data_permohonan.name_izinLokasiUrl}}</a>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label class="control-label">IMB</label>
      <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
        <a href="<?php echo $fileUrl; ?>{{data_permohonan.imbUrl}}" target="_blank">{{data_permohonan.name_imbUrl}}</a>
      </div>
    </div>
  </div>
</div> 
 -->