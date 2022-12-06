<?php
// set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"]);
// require_once("configReader.php");
// $settingData = readConfig();
// $fileUrl = $settingData->resourceUrl;
// $apiUrl = $settingData->apiServerUrl;
// $userRole = $_SESSION["role"];
?>
<!-- Template for view -->
<script id="view-data" type="text/x-handlebars-template">
    <h4 class="card-title">
        Detail Data Apotek
    </h4>

    <hr class="m-t-0">

    <div class="table-responsive" id="table-apotek">
        <table id="zero_config" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Apotek</th>
                    <th>No Izin Apotek</th>
                    <th>Lokasi Apotek</th>
                    <th>Lokasi Apotek URL</th>
                    <th>Nama Apoteker</th>
                    <th>No SIP Apoteker</th>
                    <th>Jadwal Praktik Apoteker</th>
                </tr>
            </thead>

            <tbody class="detail-item">
                <!-- Isi detail-item -->
                
            </tbody>
        </table>
    </div>
</script>