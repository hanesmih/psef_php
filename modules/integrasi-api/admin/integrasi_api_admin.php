<?php
require_once("../template/template.php");
?>

<script>
    var accesstoken = <?php echo json_encode($_COOKIE['accesstoken']); ?>;

$(document).ready(function() {
    loadDataTablePemohonApi(
        url_api_php,
        "/PemohonApi",
        accesstoken,
        "#zero_config",
        ".preloader");
    });

    function viewRouting() {
        routing('integrasi_api_admin');
    }

    function view_data(url, token){
        loadAndDisplayPemohonApi(url, token);
    }
</script>
