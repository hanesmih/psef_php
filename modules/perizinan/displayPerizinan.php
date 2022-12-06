<?php
require_once("apiCall.php");
require_once("modules/template/pageDisplay.php");

function displayContent()
{
}

function displayPerizinanScript()
{
  $route = "routing('perizinan_user')";
?>
  <script>
    jQuery(function() {
      <?php echo $route; ?>;
    });
  </script>
<?php
}

displayPage("displayContent", "displayPerizinanScript", "Sistem PSEF - Data Tanda Daftar");
