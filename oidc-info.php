<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<?php

$now = new DateTime();

if ($now->format('U') > $_SESSION["tokenExpired"]) {
  $_SESSION["status"] = "Access token expired";
}

?>

<body class="bg-dark text-white">
  <div class="container my-3">
    <p>
      Status: <?php echo $_SESSION["status"]; ?>
    </p>

    <p>
      Access Token: <?php echo $_SESSION["accessToken"]; ?>
    </p>

    <p>
      Refresh Token: <?php echo $_SESSION["refreshToken"]; ?>
    </p>

    <p>
      Role: <?php echo $_SESSION["role"]; ?>
    </p>

    <p>
      Data: <?php echo var_dump($_SESSION["data"]); ?>
    </p>
  </div>
</body>

</html>
