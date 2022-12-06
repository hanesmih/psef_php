<?php
require_once("apiCall.php");

global $settingData;
$currentDate = new DateTime();
$ssoAccessToken = $_GET["access-token"];
$ssoRefreshToken = $_GET["refresh-token"];
$ssoKodeIzin = $_GET["kd_izin"];
$ssoIdIzin = $_GET["id_izin"];
$redirectTo = $_SERVER["SERVER_NAME"];
$from = $_SERVER["REMOTE_ADDR"];
$query = $_SERVER["QUERY_STRING"];

$_SESSION["ssoAccessToken"] = $ssoAccessToken;
$_SESSION["ssoRefreshToken"] = $ssoRefreshToken;
$_SESSION["ssoKodeIzin"] = $ssoKodeIzin;
$_SESSION["ssoIdIzin"] = $ssoIdIzin;

file_put_contents("oss-sso-receive-token.log", "{$currentDate->format('Y-m-d H:i:s')} - Query string: {$query}\n", FILE_APPEND);
file_put_contents("oss-sso-receive-token.log", "from: {$from} access token: {$ssoAccessToken} - refresh token: {$ssoRefreshToken} - kode izin: {$ssoKodeIzin} - id izin: {$ssoIdIzin}\n", FILE_APPEND);

$location =
  "Location: {$settingData->identity->identityServerUrl}/Oss" .
  "?accessToken={$ssoAccessToken}" .
  "&refreshToken={$ssoRefreshToken}" .
  "&kodeIzin={$ssoKodeIzin}" .
  "&idIzin={$ssoIdIzin}" .
  "&redirectTo={$redirectTo}";

header($location);
