<?php
require_once("modules/template/pageDisplay.php");

function displayContent()
{
}

function displayLaporanScript()
{
  require_once("user/laporan_user.php");
?>
  <script>
    jQuery(function() {
    });
  </script>
<?php
}

displayPage("displayContent", "displayLaporanScript", "Laporan");
