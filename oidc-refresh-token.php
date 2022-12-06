<?php
session_start();
require("vendor/autoload.php");
include("configReader.php");

$settingData = readConfig();
$oidc = new Jumbojett\OpenIDConnectClient(
  $settingData->identity->identityServerUrl,
  $settingData->identity->clientId
);

$oidc->setRedirectURL($settingData->identity->tokenRefreshRedirectUrl);

foreach ($settingData->identity->scopes as $scope) {
  $oidc->addScope($scope);
}

$_SESSION["data"] = $oidc->refreshToken($_SESSION["refreshToken"]);
$_SESSION["accessToken"] = $oidc->getAccessToken();
$_SESSION["refreshToken"] = $oidc->getRefreshToken();
$_SESSION["tokenExpired"] = $oidc->getVerifiedClaims("exp");
$_SESSION["status"] = "Access token refreshed";

header("Location: oidc-info.php");
