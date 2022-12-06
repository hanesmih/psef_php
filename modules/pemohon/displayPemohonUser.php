<?php
require_once("apiCall.php");
require_once("modules/template/pageDisplay.php");

global $pemohonFound;
global $isSso;

function displayContent()
{
  global $settingData;
  $pemohonResponse = callGetApi(
    "{$settingData->apiServerUrl}/api/v0.1/Pemohon/CurrentUserInfo",
    $_SESSION["accessToken"]
  );

  global $pemohonFound;
  global $isSso;

  $pemohonFound = $pemohonResponse->success === true && is_object($pemohonResponse->result);
  $isSso = isset($_SESSION["ssoSuccess"]);

  if (!$pemohonFound && $pemohonResponse->result != 404) {
    displayError("Terdapat masalah dalam menampilkan data Pemohon", $pemohonResponse);
    return;
  }

  $phone = "";
  $address = "";
  $nib = "";

  if (!$pemohonFound && $isSso) {
    $postData = [
      "token" => $_SESSION["ssoAccessToken"]
    ];
    $userInfoResponse = callPostApi(
      "{$settingData->identity->identityServerUrl}/Oss/UserInfo",
      "",
      json_encode($postData)
    );

    if ($userInfoResponse->success === false) {
      displayError("Terdapat masalah dalam mengambil data user dari OSS", $userInfoResponse);
      return;
    }

    $phone = $userInfoResponse->result->telp;
    $address = is_null($userInfoResponse->result->alamat) ? "" : $userInfoResponse->result->alamat;
    $nib = $userInfoResponse->result->dataNib[0];

    $postData = [
      "userId" => "",
      "phone" => $phone,
      "address" => $address,
      "nib" => $nib
    ];
    $savePemohonResponse = callPostApi(
      "{$settingData->apiServerUrl}/api/v0.1/Pemohon/CurrentUser",
      $_SESSION["accessToken"],
      json_encode($postData)
    );

    if ($savePemohonResponse->success === false) {
      displayError("Terdapat masalah dalam menyimpan data Pemohon", $savePemohonResponse);
      return;
    }
  }

  if ($pemohonFound) {
    $phone = $pemohonResponse->result->phone;
    $address = $pemohonResponse->result->address;
    $nib = $pemohonResponse->result->nib;
  }
?>
  <div class="container-fluid">
    <div class="card m-3 p-4">
      <h4 class="card-title">Data Pemohon</h4>
      <form class="mt-3" id="data-update" onsubmit="updatePemohon(event)">
        <div class="form-group">
          <label>Nomor Telepon</label>
          <input value="<?php echo $phone; ?>" type="tel" class="form-control" name="phone" placeholder="Masukan Nomor Telepon." required>
        </div>

        <div class="form-group">
          <label>Alamat</label>
          <input value="<?php echo $address; ?>" type="text" class="form-control" name="address" placeholder="Masukan Alamat." required>
        </div>

        <div class="form-group">
          <label>NIB</label>
          <input value="<?php echo $nib; ?>" type="tel" class="form-control" name="nib" placeholder="Masukan NIB." id="input-nib" required>

          <small class="form-text text-muted">
            <div id="status-nib" style="color:white;"></div>
          </small>
        </div>

        <div id="view-nib"></div>

        <input value="<?php echo $_SESSION["userId"]; ?>" type="hidden" name="userId">
        <button id="save-pemohon" type="submit" class="btn btn-primary">Simpan</button>
      </form>
    </div>
  </div>
<?php
}

function displayPemohonUserScript()
{
  global $settingData;
  global $pemohonFound;
  global $isSso;

  $type = $pemohonFound || $isSso ? "PATCH" : "POST";
?>
  <script>
    jQuery(function() {
      $("#input-nib").blur(function() {
        cekNib();
      });

      cekNib();
      setSaveButtonStateOnInputChanged("#data-update", "#save-pemohon");
      setPhoneNumberInputFilter(document.querySelector("input[name='phone']"));
      setNumberOnlyInputFilter(document.querySelector("input[name='nib']"));
    });

    function cekNib() {
      loadAndDisplayNib(
        $("#input-nib").val(),
        "<?php echo $settingData->apiServerUrl; ?>",
        "<?php echo $_SESSION["accessToken"]; ?>",
        "#input-nib",
        "#status-nib",
        "#view-nib",
        ".preloader");
    }

    function updatePemohon(event) {
      event.preventDefault();

      let request = submitFormDataWithToastr(
        "<?php echo $settingData->apiServerUrl; ?>/api/v0.1/Pemohon/CurrentUser",
        "<?php echo $type; ?>",
        "<?php echo $_SESSION["accessToken"]; ?>",
        JSON.stringify(getFormData("#data-update")),
        "Perubahan Data Pemohon",
        "Data Pemohon Berhasil Disimpan",
        "Data Pemohon Gagal Disimpan",
        ".preloader");
      request.done(
        function(data, textStatus, xhr) {
          setSaveButtonStateOnInputChanged("#data-update", "#save-pemohon");
        }
      );
    }
  </script>
<?php
}

displayPage("displayContent", "displayPemohonUserScript", "Sistem PSEF - Data Pemohon");
