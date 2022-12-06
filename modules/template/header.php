<?php
function displayHeader(string $title = 'Selamat Datang di Sistem PSEF')
{
?>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/internal/logo.png">
    <title><?php print $title; ?></title>
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-205037947-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());

      gtag('config', 'UA-205037947-1');
    </script>
    
    <!-- Custom CSS -->
    <link href="/dist/css/style.css" rel="stylesheet">
    <link href="/assets/custom.css" rel="stylesheet">

    <!-- Sweet alert -->
    <link href="/assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- select2 -->
    <link href="/assets/libs/select2/dist/css/select2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.snow.min.css" integrity="sha512-/FHUK/LsH78K9XTqsR9hbzr21J8B8RwHR/r8Jv9fzry6NVAOVIGFKQCNINsbhK7a1xubVu2r5QZcz2T9cKpubw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.snow.min.css" integrity="sha512-/FHUK/LsH78K9XTqsR9hbzr21J8B8RwHR/r8Jv9fzry6NVAOVIGFKQCNINsbhK7a1xubVu2r5QZcz2T9cKpubw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css" integrity="sha512-Z4xQriqw+HPtU3LkEew7O1zcKQqOzF4TVwQH4ptokxpokTTCpZy1XxI9oEvjtonXbP8PRfPSMAs4vfO2FAjuWA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/6.2.95/css/materialdesignicons.min.css" integrity="sha512-tYefTUoWKpCvU14EKu/b/VxnSaT3+1ZBlL0BhTPSYCiqsMTbGylad3l6HCr9i4vpsDgJIFke+LQBq3MCXko6Qw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tablesaw/3.1.2/tablesaw.min.css" integrity="sha512-FW7xwIsGt3iCswNR3o4kcXqkKDvN8Q7obwdxFODRT+L6XkRtScLElfvobA7bjiC2iTgG/sRaBUqdrhqx0RTauw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="/assets/extra-libs/DataTables/datatables.min.css" />

    <!-- easyui -->
    <!-- <link rel="stylesheet" type="text/css" href="assets/libs/easyui/easyui.css">
    <link rel="stylesheet" type="text/css" href="assets/libs/easyui/icon.css"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

<?php
}
