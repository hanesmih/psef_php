<?php
$idIzin = $_SESSION["ssoIdIzin"] ?? "";
?>
<!-- Template for add -->
<script id="add-data" type="text/x-handlebars-template">
  <h4 class="card-title">Tambah Permohonan</h4>
    <form class="m-t-30 needs-validation" id="add-data-new" onsubmit="savePermohonan(event)" novalidate>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nomor Permohonan</label>
                    <input type="text" class="form-control" placeholder="-" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Alamat Domain Web</label>
                    <input type="text" class="form-control" name="domain" placeholder="Masukan Alamat Domain Web." required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nama Sistem</label>
                    <input type="text" class="form-control" name="systemName" placeholder="Masukan Nama Sistem." required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nama Apoteker</label>
                    <input type="text" class="form-control" name="apotekerName" placeholder="Masukan Nama Apoteker." required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Email Apoteker</label>
                    <input type="email" class="form-control" name="apotekerEmail" placeholder="Masukan Email Apoteker." required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nomor Telepon Apoteker</label>
                    <input type="text" class="form-control" name="apotekerPhone" placeholder="Masukan Nomor Telepon Apoteker." required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>NIK Apoteker</label>
                    <input type="text" class="form-control" name="apotekerNik" placeholder="Masukan NIK Apoteker." required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nomor STRA</label>
                    <input type="text" class="form-control" name="straNumber" placeholder="Masukan Nomor STRA." required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Kedaluwarsa STRA</label>
                    <input type="date" class="form-control" name="straExpiry" required>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-4">
              <div class="form-group">
                  <label>Tenaga ahli di bidang sistem elektronik dan/atau teknologi informasi</label>
                  <input type="text" class="form-control" name="tenagaAhliName" placeholder="Masukan Nama Tenaga Ahli." required>
              </div>
          </div>
          <div class="col-md-4">
              <div class="form-group">
                  <label>OSS Id Izin</label>
                  <input type="text" value="<?php echo $idIzin; ?>" class="form-control" name="idIzin" placeholder="Id Izin OSS" required readonly>
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
            <input type="file" class="form-control" id="straUrl" required>
            <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
            <input type="hidden" name="straUrl" id="v-straUrl">
        </div>
        <div class="form-group">
            <label>Surat Permohonan</label>
            <input type="file" class="form-control" id="suratPermohonanUrl" required>
            <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
            <input type="hidden" name="suratPermohonanUrl" id="v-suratPermohonanUrl">
        </div>
        <div class="form-group">
            <label>Dokumen Proses Bisnis</label>
            <input type="file" class="form-control" id="prosesBisnisUrl" required>
            <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
            <input type="hidden" name="prosesBisnisUrl" id="v-prosesBisnisUrl">
        </div>
        <div class="form-group">
            <label>Dokumen Application Programmer Interface Sistem PSEF</label>
            <input type="file" class="form-control" id="dokumenApiUrl" required>
            <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
            <input type="hidden" name="dokumenApiUrl" id="v-dokumenApiUrl">
        </div>
        <div class="form-group">
            <label>Dokumen PSE Kominfo</label>
            <input type="file" class="form-control" id="dokumenPseUrl" required>
            <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
            <input type="hidden" name="dokumenPseUrl" id="v-dokumenPseUrl">
        </div>
        <div class="form-group">
          <label>Dokumen Izin Usaha Berbentuk IUI/PMSE</label>
          <input type="file" class="form-control" id="izinUsahaUrl" required>
          <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
          <input type="hidden" name="izinUsahaUrl" id="v-izinUsahaUrl">
        </div>
        <div class="form-group">
          <label>Surat Pernyataan Komitmen bekerjasama dengan Apotek</label>
          <input type="file" class="form-control" id="komitmenKerjasamaApotekUrl" required>
          <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
          <input type="hidden" name="komitmenKerjasamaApotekUrl" id="v-komitmenKerjasamaApotekUrl">
        </div>
        <div class="form-group">
          <label>Surat Pernyataan Keaslian Dokumen</label>
          <input type="file" class="form-control" id="pernyataanKeaslianDokumenUrl" required>
          <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
          <input type="hidden" name="pernyataanKeaslianDokumenUrl" id="v-pernyataanKeaslianDokumenUrl">
        </div>

        <!-- <div class="form-group">
            <label>SPPL</label>
            <input type="file" class="form-control" id="spplUrl" required>
            <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
            <input type="hidden" name="spplUrl" id="v-spplUrl">
        </div>
        <div class="form-group">
            <label>Izin Lokasi</label>
            <input type="file" class="form-control" id="izinLokasiUrl" required>
            <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
            <input type="hidden" name="izinLokasiUrl" id="v-izinLokasiUrl">
        </div>
        <div class="form-group">
            <label>IMB</label>
            <input type="file" class="form-control" id="imbUrl" required>
            <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
            <input type="hidden" name="imbUrl" id="v-imbUrl">
        </div> -->
        <!-- <div class="form-group">
            <label>Pembayaran PNBP</label>
            <input type="file" class="form-control" id="pembayaranPnbpUrl" required>
            <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
            <input type="hidden" name="pembayaranPnbpUrl" id="v-pembayaranPnbpUrl">
        </div>  -->
        <input type="hidden" name="data" id="data">
        <input type="hidden" name="data_rs" id="data_rs">
        <input type="hidden" name="data_klinik" id="data_klinik">

        <div class="row">
            <div class="col-5 align-self-center">
            </div>
            <div class="col-7 align-self-center">
              <div class="d-flex no-block justify-content-end align-items-center">
                <div class="btn-open-modal d-none" data-toggle="modal" data-target="#myModal"></div>
                <button type="button" class="btn-trigger-modal btn waves-effect waves-light btn-info mb-2" >Tambah Apotek</button>
              </div>
            </div>
        </div>

        <div class="table-responsive" id="table-apotek">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nama Apotek</th>
                        <th>No SIA</th>
                        <th>Nama Apoteker</th>
                        <th>No STRA</th>
                        <th>No SIPA</th>
                        <th>Alamat</th>
                        <th>Provinsi</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                    <tbody class="detail-item">
                    </tbody>
            </table>
        </div>

        <!-- <div class="row">
            <div class="col-5 align-self-center">
            </div>
            <div class="col-7 align-self-center">
              <div class="d-flex no-block justify-content-end align-items-center">
                <div class="btn-open-modal-klinik d-none" data-toggle="modal" data-target="#myModalKlinik"></div>
                <button type="button" class="btn-trigger-modal-klinik btn waves-effect waves-light btn-info mb-2" >Tambah Klinik</button>
              </div>
            </div>
        </div> -->

        <!-- <div class="table-responsive" id="table-klinik">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nama Klinik</th>
                        <th>Nama Apoteker</th>
                        <th>No STRA</th>
                        <th>No SIPA</th>
                        <th>Alamat</th>
                        <th>Provinsi</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                    <tbody class="detail-item-klinik">
                    </tbody>
            </table>
        </div> -->

        <div class="row">
            <div class="col-5 align-self-center">
            </div>
            <div class="col-7 align-self-center">
              <div class="d-flex no-block justify-content-end align-items-center">
                <div class="btn-open-modal-rs d-none" data-toggle="modal" data-target="#myModalRs"></div>
                <button type="button" class="btn-trigger-modal-rs btn waves-effect waves-light btn-info mb-2" >Tambah Rumah Sakit</button>
              </div>
            </div>
        </div>

        <div class="table-responsive" id="table-rs">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nama Rumah Sakit</th>
                        <th>Nama Apoteker</th>
                        <th>No STRA</th>
                        <th>No SIPA</th>
                        <th>Alamat</th>
                        <th>Provinsi</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                    <tbody class="detail-item-rs">
                    </tbody>
            </table>
        </div>

<?php include('permohonan_check_agree.php'); ?>

      <button type="submit" class="btn btn-primary">Kirim</button>
      <button type="button" class="btn btn-danger" onclick="routing('rumusan_user')">Batal</button>
    </form>
</script>