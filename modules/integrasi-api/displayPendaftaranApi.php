<?php
require_once("apiCall.php");
require_once("modules/template/pageDisplay.php");

function displayContent()
{
}

function displayPendaftaranApiScript()
{
  require_once("user/pendaftaran_api.php");
?>
  <script>
    jQuery(function() {
    });
  </script>
<?php
}

displayPage("displayContent", "displayPendaftaranApiScript", "Pendaftaran Api");
