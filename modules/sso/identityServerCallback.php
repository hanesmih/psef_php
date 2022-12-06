<?php
$_SESSION["ssoSuccess"] = $_GET["statusCode"] == 200;
$_SESSION["ssoStatusCode"] = $_GET["statusCode"];
$_SESSION["ssoReason"] = $_GET["reason"];

header("Location: /");
