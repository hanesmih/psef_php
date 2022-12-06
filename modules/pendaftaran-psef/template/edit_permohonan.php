<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"]);
require_once("configReader.php");
$settingData = readConfig();
$fileUrl = $settingData->resourceUrl;
?>
<!-- Template for edit -->
<script id="edit-data" type="text/x-handlebars-template">
   <h4 class="card-title">Ubah Data Permohonan</h4>
    <form class="m-t-30 needs-validation" id="data-update" onsubmit="update_data(event)" novalidate>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nomor Permohonan</label>
                    <input type="text" value= "{{permohonanNumber}}" class="form-control" name="permohonanNumber" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Alamat Domain Web</label>
                     <input type="text" value= "{{domain}}" class="form-control" name="domain" placeholder="Masukan Alamat Domain Web." required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nama Sistem</label>
                    <input type="text" value= "{{systemName}}" class="form-control" name="systemName" placeholder="Masukan Nama Sistem." required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nama Apoteker</label>
                    <input type="text" value= "{{apotekerName}}" class="form-control" name="apotekerName" placeholder="Masukan Nama Apoteker." required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Email Apoteker</label>
                    <input type="email" value= "{{apotekerEmail}}" class="form-control" name="apotekerEmail" placeholder="Masukan Email Apoteker." required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nomor Telepon Apoteker</label>
                    <input type="text" value= "{{apotekerPhone}}" class="form-control" name="apotekerPhone" placeholder="Masukan Nomor Telepon Apoteker." required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>NIK Apoteker</label>
                    <input type="text" value= "{{apotekerNik}}" class="form-control" name="apotekerNik" placeholder="Masukan NIK Apoteker." required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nomor STRA</label>
                    <input type="text" value= "{{straNumber}}" class="form-control" name="straNumber" placeholder="Masukan Nomor STRA." required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Kedaluwarsa STRA</label>
                    <input type="date" value= "{{straExpiry}}" class="form-control" name="straExpiry" required>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-4">
              <div class="form-group">
                  <label>Tenaga ahli di bidang sistem elektronik dan/atau teknologi informasi</label>
                  <input type="text" value= "{{tenagaAhliName}}" class="form-control" name="tenagaAhliName" placeholder="Masukan Nama Tenaga Ahli." required>
              </div>
          </div>
          <div class="col-md-4">
              <div class="form-group">
                  <label>OSS Id Izin</label>
                  <input type="text" value="{{idIzin}}" class="form-control" name="idIzin" placeholder="Id Izin OSS." readonly>
              </div>
          </div>
          <div class="col-md-4">
              <div class="form-group">
                  <label>Nomor Billing PNBP</label>
                  <input type="text" value="{{nomorBillingPnbp}}" class="form-control" name="nomorBillingPnbp" placeholder="Masukan Nomor Billing PNBP." readonly>
              </div>
          </div>
        </div>

<?php include('permohonan_contoh_surat.php'); ?>

        <div class="form-group">
            <label>Salinan STRA</label>
            <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
                <a href="<?php echo $fileUrl; ?>{{straUrl}}" target="_blank" id="close-straUrl">{{name_straUrl}}</a>
            </div>
            <input type="file" class="form-control" id="straUrl">
            <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
            <input type="hidden" name="straUrl" id="v-straUrl">
        </div>
        <div class="form-group">
            <label>Surat Permohonan</label>
            <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
                <a href="<?php echo $fileUrl; ?>{{suratPermohonanUrl}}" target="_blank" id="close-suratPermohonanUrl">{{name_suratPermohonanUrl}}</a>
            </div>
            <input type="file" class="form-control" id="suratPermohonanUrl">
            <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
            <input type="hidden" name="suratPermohonanUrl" id="v-suratPermohonanUrl">
        </div>
        <div class="form-group">
            <label>Dokumen Proses Bisnis</label>
            <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
                <a href="<?php echo $fileUrl; ?>{{prosesBisnisUrl}}" target="_blank" id="close-prosesBisnisUrl">{{name_prosesBisnisUrl}}</a>
            </div>
            <input type="file" class="form-control" id="prosesBisnisUrl">
            <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
            <input type="hidden" name="prosesBisnisUrl" id="v-prosesBisnisUrl">
        </div>
        <div class="form-group">
            <label>Dokumen Application Programmer Interface Sistem PSEF</label>
            <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
                <a href="<?php echo $fileUrl; ?>{{dokumenApiUrl}}" target="_blank" id="close-dokumenApiUrl">{{name_dokumenApiUrl}}</a>
            </div>
            <input type="file" class="form-control" id="dokumenApiUrl">
            <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
            <input type="hidden" name="dokumenApiUrl" id="v-dokumenApiUrl">
        </div>
        <div class="form-group">
            <label>Dokumen PSE Kominfo</label>
            <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
                <a href="<?php echo $fileUrl; ?>{{dokumenPseUrl}}" target="_blank" id="close-dokumenPseUrl">{{name_dokumenPseUrl}}</a>
            </div>
            <input type="file" class="form-control" id="dokumenPseUrl">
            <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
            <input type="hidden" name="dokumenPseUrl" id="v-dokumenPseUrl">
        </div>
        <div class="form-group">
          <label>Dokumen Izin Usaha Berbentuk IUI/PMSE</label>
          <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
              <a href="<?php echo $fileUrl; ?>{{izinUsahaUrl}}" target="_blank" id="close-izinUsahaUrl">{{name_izinUsahaUrl}}</a>
          </div>
          <input type="file" class="form-control" id="izinUsahaUrl">
          <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
          <input type="hidden" name="izinUsahaUrl" id="v-izinUsahaUrl">
        </div>
        <div class="form-group">
          <label>Surat Pernyataan Komitmen bekerjasama dengan Apotek</label>
          <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
              <a href="<?php echo $fileUrl; ?>{{komitmenKerjasamaApotekUrl}}" target="_blank" id="close-komitmenKerjasamaApotekUrl">{{name_komitmenKerjasamaApotekUrl}}</a>
          </div>
          <input type="file" class="form-control" id="komitmenKerjasamaApotekUrl">
          <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
          <input type="hidden" name="komitmenKerjasamaApotekUrl" id="v-komitmenKerjasamaApotekUrl">
        </div>
        <div class="form-group">
          <label>Surat Pernyataan Keaslian Dokumen</label>
          <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
              <a href="<?php echo $fileUrl; ?>{{pernyataanKeaslianDokumenUrl}}" target="_blank" id="close-pernyataanKeaslianDokumenUrl">{{name_pernyataanKeaslianDokumenUrl}}</a>
          </div>
          <input type="file" class="form-control" id="pernyataanKeaslianDokumenUrl">
          <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
          <input type="hidden" name="pernyataanKeaslianDokumenUrl" id="v-pernyataanKeaslianDokumenUrl">
        </div>

        <!-- <div class="form-group">
            <label>SPPL</label>
            <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
                <a href="<?php echo $fileUrl; ?>{{spplUrl}}" target="_blank" id="close-spplUrl">{{name_spplUrl}}</a>
            </div>
            <input type="file" class="form-control" id="spplUrl">
            <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
            <input type="hidden" name="spplUrl" id="v-spplUrl">
        </div>
        <div class="form-group">
            <label>Izin Lokasi</label>
            <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
                <a href="<?php echo $fileUrl; ?>{{izinLokasiUrl}}" target="_blank" id="close-izinLokasiUrl">{{name_izinLokasiUrl}}</a>
            </div>
            <input type="file" class="form-control" id="izinLokasiUrl">
            <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
            <input type="hidden" name="izinLokasiUrl" id="v-izinLokasiUrl">
        </div>
        <div class="form-group">
            <label>IMB</label>
            <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
                <a href="<?php echo $fileUrl; ?>{{imbUrl}}" target="_blank" id="close-imbUrl">{{name_imbUrl}}</a>
            </div>
            <input type="file" class="form-control" id="imbUrl">
            <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
            <input type="hidden" name="imbUrl" id="v-imbUrl">
        </div> -->
        <!-- <div class="form-group">
            <label>Pembayaran PNBP</label>
            <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
                <a href="<?php echo $fileUrl; ?>{{pembayaranPnbpUrl}}" target="_blank" id="close-pembayaranPnbpUrl">{{name_pembayaranPnbpUrl}}</a>
            </div>
            <input type="file" class="form-control" id="pembayaranPnbpUrl" required>
            <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
            <input type="hidden" name="pembayaranPnbpUrl" id="v-pembayaranPnbpUrl">
        </div>  -->

        <input type="hidden" name="pemohonId" id="pemohonId" value="{{pemohonId}}">
        <input type="hidden" name="id" value="{{id}}">

<?php include('permohonan_check_agree.php'); ?>

        <button type="submit" class="btn btn-primary">Kirim</button>
        <button type="button" class="btn btn-danger" onclick="viewRouting()">Batal</button>
    </form>
</script>