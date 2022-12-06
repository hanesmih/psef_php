<?php
require_once("apiCall.php");
require_once("modules/template/pageDisplay.php");

global $passedNib;
$passedNib = $nib;

function displayContent()
{
  global $settingData;
  global $passedNib;

  $nibResponse = callGetApi(
    "{$settingData->apiServerUrl}/api/v0.1/OssInfo/OssFullInfo?id={$passedNib}",
    $_SESSION["accessToken"]
  );

  if ($nibResponse->success === false) {
    displayError("Terdapat masalah dalam menampilkan data NIB", $nibResponse);
    return;
  }
  ?>
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-5 align-self-center">
        <h4 class="page-title">NIB</h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="/dashboard">
                  Home
                </a>
              </li>

              <li class="breadcrumb-item">
                NIB
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="card">
      <h4 class="card-title mt-4 ml-4">Detail NIB</h4>

      <form class="card-body m-t-30">
        <h4 class="card-title" style="font-weight: bold;">
          Data Perusahaan
        </h4>

        <hr class="m-t-0">

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">NIB</label>
              <input value="<?php echo $nibResponse->result->nib; ?>" type="text" class="form-control" disabled>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">OSS ID</label>
              <input value="<?php echo $nibResponse->result->ossId; ?>" type="text" class="form-control" disabled>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Tanggal Pengajuan NIB</label>
              <input value="<?php echo displayDateFromJson($nibResponse->result->tglPengajuanNib); ?>" type="text" class="form-control" disabled>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Tanggal Terbit NIB</label>
              <input value="<?php echo displayDateFromJson($nibResponse->result->tglTerbitNib); ?>" type="text" class="form-control" disabled>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Tanggal Perubahan NIB</label>
              <input value="<?php echo displayDateFromJson($nibResponse->result->tglPerubahanNib); ?>" type="text" class="form-control" disabled>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">No NPP</label>
              <input value="<?php echo $nibResponse->result->noNpp; ?>" type="text" class="form-control" disabled>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">No VA</label>
              <input value="<?php echo $nibResponse->result->noVa; ?>" type="text" class="form-control" disabled>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">No WLKP</label>
              <input value="<?php echo $nibResponse->result->noWlkp; ?>" type="text" class="form-control" disabled>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Badan Hukum</label>
              <input value="<?php echo displayStatusBadanHukum($nibResponse->result->statusBadanHukum); ?>" type="text" class="form-control" disabled>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Penanaman Modal</label>
              <input value="<?php echo displayStatusPenanamanModal($nibResponse->result->statusPenanamanModal); ?>" type="text" class="form-control" disabled>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">NPWP</label>
              <input value="<?php echo $nibResponse->result->npwpPerseroan; ?>" type="text" class="form-control" disabled>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Nama Perusahaan</label>
              <input value="<?php echo $nibResponse->result->namaPerseroan; ?>" type="text" class="form-control" disabled>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Badan Usaha</label>
              <input value="<?php echo displayJenisPerseroan($nibResponse->result->jenisPerseroan); ?>" type="text" class="form-control" disabled>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Alamat Perusahaan</label>
              <textarea class="form-control" rows="7" disabled><?php echo displayAlamatPerseroan($nibResponse->result); ?></textarea>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Jenis API</label>
              <input value="<?php echo $nibResponse->result->jenisApi; ?>" type="text" class="form-control" disabled>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Dalam Bentuk Uang</label>
              <input value="<?php echo displayNumberWithSeparator($nibResponse->result->dalamBentukUang); ?>" type="text" class="form-control text-right" disabled>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Dalam Bentuk Lain</label>
              <textarea class="form-control" rows="7" disabled><?php echo $nibResponse->result->dalamBentukLain; ?></textarea>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Total Modal Dasar</label>
              <input value="<?php echo displayNumberWithSeparator($nibResponse->result->totalModalDasar); ?>" type="text" class="form-control text-right" disabled>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Total Modal Ditempatkan</label>
              <input value="<?php echo displayNumberWithSeparator($nibResponse->result->totalModalDitempatkan); ?>" type="text" class="form-control text-right" disabled>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">No Pengesahan</label>
              <input value="<?php echo $nibResponse->result->noPengesahan; ?>" type="text" class="form-control" disabled>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Tgl Pengesahan</label>
              <input value="<?php echo displayDateFromJson($nibResponse->result->tglPengesahan); ?>" type="text" class="form-control" disabled>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">No Akta Lama</label>
              <input value="<?php echo $nibResponse->result->noAktaLama; ?>" type="text" class="form-control" disabled>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Tgl Akta Lama</label>
              <input value="<?php echo displayDateFromJson($nibResponse->result->tglAktaLama); ?>" type="text" class="form-control" disabled>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">No Pengesahan Lama</label>
              <input value="<?php echo $nibResponse->result->noPengesahanLama; ?>" type="text" class="form-control" disabled>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Tgl Pengesahan Lama</label>
              <input value="<?php echo displayDateFromJson($nibResponse->result->tglPengesahanLama); ?>" type="text" class="form-control" disabled>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Status NIB</label>
              <input value="<?php echo displayStatusNib($nibResponse->result->statusNib); ?>" type="text" class="form-control" disabled>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Tipe Dokumen</label>
              <input value="<?php echo displayTipeDokumen($nibResponse->result->tipeDokumen); ?>" type="text" class="form-control" disabled>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Jenis ID User</label>
              <input value="<?php echo displayJenisIdUserProses($nibResponse->result->jenisIdUserProses); ?>" type="text" class="form-control" disabled>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">No ID</label>
              <input value="<?php echo $nibResponse->result->noIdUserProses; ?>" type="text" class="form-control" disabled>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Nama User</label>
              <input value="<?php echo $nibResponse->result->namaUserProses; ?>" type="text" class="form-control" disabled>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">Email User</label>
              <input value="<?php echo $nibResponse->result->emailUserProses; ?>" type="text" class="form-control" disabled>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="control-label">No HP User</label>
              <input value="<?php echo $nibResponse->result->hpUserProses; ?>" type="text" class="form-control" disabled>
            </div>
          </div>
        </div>
        <br>
        <h4 class="card-title" style="font-weight: bold;">Data Proyek</h4>
        <hr class="m-t-0">
        <div class="table-responsive" id="table-proyek">
          <table id="zero_config_proyek" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th width="180px">ID PROYEK</th>
                <th>KBLI</th>
                <th>SEKTOR</th>
                <th>URAIAN USAHA</th>
                <th width="96px">JUMLAH TENAGA KERJA</th>
                <th width="290px">INVESTASI</th>
                <th>STATUS TANAH</th>
                <th>ALAMAT</th>
                <th>PRODUK</th>
              </tr>
            </thead>
            <tbody class="detail-item-proyek">
              <?php displayDataProyek($nibResponse->result->dataProyek); ?>
            </tbody>
          </table>
        </div>
        <br>
        <h4 class="card-title" style="font-weight: bold;">Data Pemegang Saham</h4>
        <hr class="m-t-0">
        <div class="table-responsive" id="table-ps">
          <table id="zero_config_ps" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>IDENTITAS PEMEGANG SAHAM</th>
                <th>ALAMAT PEMEGANG SAHAM</th>
                <th>TOTAL MODAL</th>
              </tr>
            </thead>
            <tbody class="detail-item-ps">
              <?php displayDataPemegangSaham($nibResponse->result->pemegangSaham); ?>
            </tbody>
          </table>
        </div>
        <br>
        <h4 class="card-title" style="font-weight: bold;">Data Penanggung Jawab</h4>
        <hr class="m-t-0">
        <div class="table-responsive" id="table-pj">
          <table id="zero_config_pj" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>IDENTITAS PENANGGUNG JAWAB</th>
                <th>ALAMAT PENANGGUNG JAWAB</th>
              </tr>
            </thead>
            <tbody class="detail-item-pj">
              <?php displayDataPenanggungJawab($nibResponse->result->penanggungJwb); ?>
            </tbody>
          </table>
        </div>
        <br>
        <h4 class="card-title" style="font-weight: bold;">Data LEGALITAS</h4>
        <hr class="m-t-0">
        <div class="table-responsive" id="table-legilitas">
          <table id="zero_config_legilitas" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>AKTA</th>
                <th>NOTARIS</th>
              </tr>
            </thead>
            <tbody class="detail-item-legilitas">
              <?php displayDataLegalitas($nibResponse->result->legalitas); ?>
            </tbody>
          </table>
        </div>
        <br>
        <h4 class="card-title" style="font-weight: bold;">Data RPTKA</h4>
        <hr class="m-t-0">
        <div class="table-responsive" id="table-rptka">
          <table id="zero_config_rptka" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>JENIS RPTKA</th>
                <th>NO RPTKA</th>
                <th>RPTKA AWAL</th>
                <th>RPTKA AKHIR</th>
                <th>JUMLAH TKA RPTKA</th>
                <th>JANGKA PENGGUNAAN WAKTU</th>
                <th>JANGKA WAKTU PERMOHONAN RPTKA</th>
              </tr>
            </thead>
            <tbody class="detail-item-rptka">
              <?php displayDataRptka($nibResponse->result->dataRptka); ?>
            </tbody>
          </table>
        </div>
        <br>
        <h4 class="card-title" style="font-weight: bold;">Data DNI</h4>
        <hr class="m-t-0">
        <div class="table-responsive" id="table-dni">
          <table id="zero_config_dni" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>KODE DNI</th>
              </tr>
            </thead>
            <tbody class="detail-item-dni">
              <?php displayDataDni($nibResponse->result->dataDni); ?>
            </tbody>
          </table>
        </div>
        <br>
        <h4 class="card-title" style="font-weight: bold;">Data CHECKLIST</h4>
        <hr class="m-t-0">
        <div class="table-responsive" id="table-ck">
          <table id="zero_config_ck" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>ID IZIN</th>
                <th>ID PROYEK</th>
                <th>KODE IZIN</th>
                <th>NAMA IZIN</th>
                <th>CHECKLIST OSS</th>
              </tr>
            </thead>
            <tbody class="detail-item-ck">
              <?php displayDataChecklist($nibResponse->result->dataChecklist); ?>
            </tbody>
          </table>
        </div>
      </form>
    </div>
  </div>
<?php
}

function displayNumberWithSeparator($number)
{
  return number_format($number, 0, ",", ".");
}

function displayDateFromJson($jsonDate)
{
  if (is_null($jsonDate)) {
    return "-";
  }

  $date = DateTime::createFromFormat("Y-m-d\TH:i:sP", $jsonDate);
  return $date->format("j M Y");
}

function displayStatusBadanHukum($kodeBadanHukum)
{
  switch ($kodeBadanHukum) {
    case "01":
      return "Badan Hukum";
    case "02":
      return "Bukan Badan Hukum";
    default:
      return "-";
  }
}

function displayStatusPenanamanModal($kodePenanamanModal)
{
  switch ($kodePenanamanModal) {
    case "01":
      return "Penanaman Modal Asing";
    case "02":
      return "Penanaman Modal Dalam Negeri";
    case "03":
      return "Bukan (PMA/PMDN)";
    default:
      return "-";
  }
}

function displayJenisPerseroan($kodeJenisPerseroan)
{
  switch ($kodeJenisPerseroan) {
    case "01":
      return "Perusahaan Terbatas (PT)";
    case "02":
      return "Perseroan Komanditer (CV)";
    case "04":
      return "Badan Usaha Pemerintah";
    case "05":
      return "Firma (Fa)";
    case "06":
      return "Persekutuan Perdata";
    case "07":
      return "Koperasi";
    case "10":
      return "Yayasan";
    case "16":
      return "Bentuk Usaha Tetap (BUT)";
    case "17":
      return "Perseorangan";
    case "18":
      return "Badan Layanan Umum (BLU)";
    case "19":
      return "Badan Hukum (selain PT,Yayasan dan Koperasi)";
    default:
      return "-";
  }
}

function displayStatusNib($kodeStatusNib)
{
  switch ($kodeStatusNib) {
    case "01":
      return "Aktif";
    case "02":
      return "Belum Aktif";
    case "03":
      return "Diizinkan Usaha";
    case "04":
      return "Diizinkan Beroperasi";
    case "05":
      return "Dibekukan";
    case "06":
      return "Dicabut";
    default:
      return "-";
  }
}

function displayTipeDokumen($kodeTipeDokumen)
{
  switch ($kodeTipeDokumen) {
    case "9":
      return "Original";
    case "5":
      return "Update";
    case "3":
      return "Pencabutan";
    case "4":
      return "Pembatalan";
    default:
      return "-";
  }
}

function displayJenisIdUserProses($kodeJenisIdUserProses)
{
  switch ($kodeJenisIdUserProses) {
    case "01":
      return "Kartu Tanda Penduduk (KTP)";
    case "02":
      return "Paspor";
    default:
      return "-";
  }
}

function displayJenisLegalitas($kodeJenisLegalitas)
{
  switch ($kodeJenisLegalitas) {
    case "01":
      return "Akta Pendirian";
    case "02":
      return "Akta Perubahan";
    case "06":
      return "Kontrak";
    case "07":
      return "Peraturan";
    case "09":
      return "SK Penetapan";
    case "10":
      return "Akta Likuidasi";
    case "11":
      return "Akta Merger";
    case "12":
      return "Akta Pembubaran";
    default:
      return "-";
  }
}

function displayJenisRptka($kodeJenisRptka)
{
  switch ($kodeJenisRptka) {
    case "01":
      return "Baru";
    case "02":
      return "Perubahan";
    default:
      return "-";
  }
}

function displayStatusTanah($kodeStatusTanah)
{
  switch ($kodeStatusTanah) {
    case "01":
      return "Sewa";
    case "02":
      return "Bukan Sewa";
    default:
      return "-";
  }
}

function displaySatuanLuasTanah($kodeSatuanLuasTanah)
{
  switch ($kodeSatuanLuasTanah) {
    case "01":
      return "M2";
    case "02":
      return "Ha";
    default:
      return "-";
  }
}

function displayAlamatPerseroan($apiData)
{
  return
    $apiData->alamatPerseroan .
    " RT/RW " . $apiData->rtRwPerseroan .
    ", Kel. " . $apiData->kelurahanPerseroan .
    "&#13;&#10;Kode Pos: " . $apiData->kodePosPerseroan .
    "&#13;&#10;No. Telp: " . $apiData->nomorTelponPerseroan .
    "&#13;&#10;Email : " . $apiData->emailPerusahaan;
}

function displayDataPemegangSaham(array $listDataPemegangSaham)
{
  foreach ($listDataPemegangSaham as $pemegangSaham) {
  ?>
    <tr>
      <td>
        <?php echo $pemegangSaham->namaPemegangSaham; ?>
        <br />NPWP : <?php echo $pemegangSaham->npwpPemegangSaham; ?>
        <br />KTP/PASPOR : <?php echo $pemegangSaham->noIdentitasPemegangSaham; ?>
        <br />Jabatan : <?php echo $pemegangSaham->jabatanPemegangSaham; ?>
      </td>
      <td>
        <?php echo $pemegangSaham->alamatPemegangSaham; ?>
        <br />Fax : <?php echo $pemegangSaham->faxPemegangSaham; ?>
        <br />E-mail : <?php echo $pemegangSaham->emailPemegangSaham; ?>
      </td>
      <td class="text-right">
        <?php echo displayNumberWithSeparator($pemegangSaham->totalModalPemegang); ?>
      </td>
    </tr>
  <?php
  }
}

function displayDataPenanggungJawab(array $listDataPenanggungJawab)
{
  foreach ($listDataPenanggungJawab as $penanggungJawab) {
  ?>
    <tr>
      <td>
        <?php echo $penanggungJawab->namaPenanggungJwb; ?>
        <br />NPWP : <?php echo $penanggungJawab->npwpPenanggungJwb; ?>
        <br />KTP/PASPOR : <?php echo $penanggungJawab->noIdentitasPenanggungJwb; ?>
        <br />Jabatan : <?php echo $penanggungJawab->jabatanPenanggungJwb; ?>
      </td>
      <td>
        <?php echo $penanggungJawab->alamatPenanggungJwb; ?> RT/RW <?php echo $penanggungJawab->rtRwPenanggungJwb; ?>
        <br />Telp : <?php echo $penanggungJawab->noHpPenanggungJwb; ?>
        <br />E-mail : <?php echo $penanggungJawab->emailPenanggungJwb; ?>
        <br />Negara Asal : <?php echo $penanggungJawab->negaraAsalPenanggungJwb; ?>
      </td>
    </tr>
  <?php
  }
}

function displayDataLegalitas(array $listDataLegalitas)
{
  foreach ($listDataLegalitas as $legalitas) {
  ?>
    <tr>
      <td>
        Nomor Legal : <?php echo $legalitas->noLegal; ?>
        <br />Tgl Legal : <?php echo displayDateFromJson($legalitas->tglLegal); ?>
        <br />Jenis Legal : <?php echo displayJenisLegalitas($legalitas->jenisLegal); ?>
      </td>
      <td>
        <?php echo $legalitas->namaNotaris; ?>
        <br /><?php echo $legalitas->alamatNotaris; ?>
        <br />Telp. <?php echo $legalitas->teleponNotaris; ?>
      </td>
    </tr>
<?php
  }
}

function displayDataRptka($dataRptka)
{
  ?>
  <tr>
    <td><?php echo displayJenisRptka($dataRptka->jenisRptka); ?></td>
    <td><?php echo $dataRptka->noRptka; ?></td>
    <td><?php echo $dataRptka->rptkaAwal; ?></td>
    <td><?php echo $dataRptka->rptkaAkhir; ?></td>
    <td><?php echo $dataRptka->jumlahTkaRptka; ?></td>
    <td><?php echo $dataRptka->jangkaPenggunaanWaktu; ?></td>
    <td><?php echo $dataRptka->jangkaWaktuPermohonanRptka; ?></td>
  </tr>
  <?php
}

function displayDataDni(array $listDataDni)
{
  foreach ($listDataDni as $dataDni) {
  ?>
    <tr>
      <td><?php echo $dataDni->kdDni; ?></td>
    </tr>
  <?php
  }
}

function displayDataChecklist(array $listDataChecklist)
{
  foreach ($listDataChecklist as $dataChecklist) {
  ?>
    <tr>
      <td><?php echo $dataChecklist->idIzin; ?></td>
      <td><?php echo $dataChecklist->idProyek; ?></td>
      <td><?php echo $dataChecklist->kdIzin; ?></td>
      <td><?php echo $dataChecklist->namaIzin; ?></td>
      <td><?php echo $dataChecklist->flagChecklist; ?></td>
    </tr>
  <?php
  }
}

function displayDataProyek(array $listDataProyek)
{
  foreach ($listDataProyek as $dataProyek) {
  ?>
    <tr>
      <td>
        <?php echo $dataProyek->idProyek; ?>
      </td>
      <td>
        <?php echo $dataProyek->kbli; ?>
      </td>
      <td>
        <?php echo $dataProyek->sektor; ?>
      </td>
      <td>
        <?php echo $dataProyek->dataProyekProduk[0]->jenisProduksi; ?>
      </td>
      <td>
        TKI PRIA : <?php echo $dataProyek->jumlahTkiL; ?>
        <br />TKI WANITA : <?php echo $dataProyek->jumlahTkiP; ?>
        <br />TKA PRIA : <?php echo $dataProyek->jumlahTkaL; ?>
        <br />TKA WANITA : <?php echo $dataProyek->jumlahTkaP; ?>
      </td>
      <td>
        Pembelian Pematangan Tanah : <?php echo displayNumberWithSeparator($dataProyek->pembelianPematangTanah); ?>
        <br />Bangunan Gedung : <?php echo displayNumberWithSeparator($dataProyek->bangunanGedung); ?>
        <br />Mesin Peralatan : <?php echo displayNumberWithSeparator($dataProyek->mesinPeralatan); ?>
        <br />Mesin Peralatan USD : <?php echo displayNumberWithSeparator($dataProyek->mesinPeralatanUsd); ?>
        <br />Sub Jumlah : <?php echo displayNumberWithSeparator($dataProyek->subJumlah); ?>
        <br />Modal Kerja : <?php echo displayNumberWithSeparator($dataProyek->modalKerja); ?>
        <br />Total Investasi : <?php echo displayNumberWithSeparator($dataProyek->jumlahInvestasi); ?>
      </td>
      <td>
        <?php echo displayStatusTanah($dataProyek->statusTanah); ?>
        <br />Luas Tanah : <?php echo displayNumberWithSeparator($dataProyek->luasTanah); ?> <?php echo displaySatuanLuasTanah($dataProyek->satuanLuasTanah); ?>
      </td>
      <td>
        <?php echo $dataProyek->dataLokasiProyek[0]->alamatUsaha; ?>
      </td>
      <td>
        Kapasitas : <?php echo displayNumberWithSeparator($dataProyek->dataProyekProduk[0]->kapasitas); ?>
        <br />Satuan : <?php echo $dataProyek->dataProyekProduk[0]->satuan; ?>
        <br />Merk Dagang : <?php echo $dataProyek->dataProyekProduk[0]->merkDagang; ?>
        <br />Jenis Produksi : <?php echo $dataProyek->dataProyekProduk[0]->jenisProduksi; ?>
      </td>
    </tr>
<?php
  }
}

displayPage("displayContent", "", "Sistem PSEF - Detail NIB");
