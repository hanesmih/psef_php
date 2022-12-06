<?php
function readConfig()
{
  $fileContent = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/appsettings.json");
  return json_decode($fileContent, false);
}
