<?php
session_start();
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"]);
require_once("configReader.php");
require_once('../template/template.php');
$settingData = readConfig();
$fileUrl = $settingData->resourceUrl;
$apiUrl = $settingData->apiServerUrl;
?>

<script>
    var accesstoken = <?php echo json_encode($_COOKIE['accesstoken']); ?>;

    $(document).ready(function() {
      loadDataTablePerizinan(
        url_api_php,
        "<?php echo $apiUrl; ?>",
        "<?php echo $fileUrl; ?>",
        accesstoken,
        "#zero_config",
        ".preloader",
        "<?php echo $_SESSION["role"]; ?>"
        );
    });

    function viewRouting() {
      routing('perizinan_user');
    }

    function view_data(id,id_izin){
      loadAndDisplayPerizinan(id, id_izin, url_api_x, accesstoken);
    }

    function ubah_perubahanizin_data(id,id_izin){
      loadAndDisplayPerubahanIzin(id, id_izin, url_api_x, accesstoken);
    }
</script>
