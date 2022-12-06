<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"]);
require_once("configReader.php");
$settingData = readConfig();
$fileUrl = $settingData->resourceUrl;
$role = $_SESSION["role"];
?>
<!-- Template for edit -->
<script id="edit-data" type="text/x-handlebars-template">
   <h4 class="card-title">Ubah Data Perizinan</h4>
   <?php 
    if($role != ""){
        include('../../pendaftaran-psef/template/view_permohonan_kemkes.php');
    }
   ?>
    <form class="m-t-30 needs-validation" id="data-update" onsubmit="update_data(event)" novalidate>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nomor Permohonan</label>
                    <input type="text" value= "{{data_permohonan.permohonanNumber}}" class="form-control" name="permohonanNumber" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Alamat Domain Web</label>
                     <input type="text" value= "{{data_permohonan.domain}}" class="form-control" name="domain" placeholder="Masukan Alamat Domain Web." <?php if($role == "") { echo "required"; } else { echo "readonly";} ?>>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nama Sistem</label>
                    <input type="text" value= "{{data_permohonan.systemName}}" class="form-control" name="systemName" placeholder="Masukan Nama Sistem." <?php if($role == "") { echo "required"; } else { echo "readonly";} ?>>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nama Apoteker</label>
                    <input type="text" value= "{{data_permohonan.apotekerName}}" class="form-control" name="apotekerName" placeholder="Masukan Nama Apoteker." <?php if($role == "") { echo "required"; } else { echo "readonly";} ?>>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Email Apoteker</label>
                    <input type="email" value= "{{data_permohonan.apotekerEmail}}" class="form-control" name="apotekerEmail" placeholder="Masukan Email Apoteker." <?php if($role == "") { echo "required"; } else { echo "readonly";} ?>>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nomor Telepon Apoteker</label>
                    <input type="text" value= "{{data_permohonan.apotekerPhone}}" class="form-control" name="apotekerPhone" placeholder="Masukan Nomor Telepon Apoteker." <?php if($role == "") { echo "required"; } else { echo "readonly";} ?>>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>NIK Apoteker</label>
                    <input type="text" value= "{{data_permohonan.apotekerNik}}" class="form-control" name="apotekerNik" placeholder="Masukan NIK Apoteker." <?php if($role == "") { echo "required"; } else { echo "readonly";} ?>>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nomor STRA</label>
                    <input type="text" value= "{{data_permohonan.straNumber}}" class="form-control" name="straNumber" placeholder="Masukan Nomor STRA." <?php if($role == "") { echo "required"; } else { echo "readonly";} ?>>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Kedaluwarsa STRA</label>
                    <input type="date" value= "{{data_permohonan.straExpiry}}" class="form-control" name="straExpiry" <?php if($role == "") { echo "required"; } else { echo "readonly";} ?>>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-4">
              <div class="form-group">
                  <label>Nama Tenaga Ahli</label>
                  <input type="text" value= "{{data_permohonan.tenagaAhliName}}" class="form-control" name="tenagaAhliName" placeholder="Masukan Nama Tenaga Ahli." readonly>
              </div>
          </div>
          <div class="col-md-4">
              <div class="form-group">
                  <label>OSS Id Izin</label>
                  <input type="text" value="{{data_permohonan.idIzin}}" class="form-control" name="idIzin" placeholder="Id Izin OSS." readonly>
              </div>
          </div>
        </div>

        <?php 
            require_once('../../template/view_dokumen_perubahan_izin.php');
        ?>
        <?php 
            if($role != "" || ("{{data_permohonan.statusId}}" != 14 || "{{data_permohonan.statusId}}" != 15)) {
            ?>
                <div class="form-group">
                    <label>Salinan STRA</label>
                    <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
                        <a href="<?php echo $fileUrl; ?>{{data_permohonan.straUrl}}" target="_blank" id="close-straUrl">{{data_permohonan.name_straUrl}}</a>
                    </div>
                    <input type="file" class="form-control" id="straUrl">
                    <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
                    <input type="hidden" name="straUrl" id="v-straUrl">
                </div>

                <input type="hidden" name="pemohonId" id="pemohonId" value="{{data_permohonan.pemohonId}}">
                <input type="hidden" name="perizinanId" id="perizinanId" value="{{data_permohonan.perizinanId}}">
                <input type="hidden" name="permohonanId" id="permohonanId" value="{{data_permohonan.permohonanId}}">
                <input type="hidden" name="providerName" id="providerName" value="{{data_permohonan.providerName}}">
                <input type="hidden" name="imbUrl"> 
                <input type="hidden" name="spplUrl"> 
                <input type="hidden" name="izinLokasiUrl"> 
                <input type="hidden" name="id" value="{{data_permohonan.id}}">

                <?php include('permohonan_check_agree.php'); ?>

                <button type="submit" class="btn btn-primary">Kirim</button>

                <button type="button" class="btn btn-danger" onclick="viewRouting()">Batal</button>

            <?php
            }
            ?>
    </form>

    <?php include('perubahan_setujui.php'); ?>

</script>