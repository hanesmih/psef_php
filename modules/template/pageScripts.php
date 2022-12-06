<?php
function displayPageScripts(bool $isHome)
{
  global $settingData;
  $cacheBuster = $settingData->isDevelopment ? "?v=" . rand() : "";
?>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha512-pgGHFWjBtbKHTTDW5buGZ9mU0nGfxNavf5kWK/Od2ugA//9FuMHAunkAiMe5jeL/5WW1r0UxwKi6D5LpMOJD3w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.min.js" integrity="sha512-P2W2rr8ikUPfa31PLBo5bcBQrsa+TNj8jiKadtaIrHQGMo6hQM6RdPjQYxlNguwHz8AwSQ28VkBK6kHBLgd/8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tablesaw/3.1.2/tablesaw.jquery.min.js" integrity="sha512-/Un6gjn0IXHJtR9j8VBYmN3ZoAVNMTQTufizEkeImLkb67lxsJcXv/cFswbOig2v5ykbGxX6zngh4u8ff7FJ0Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tablesaw/3.1.2/tablesaw-init.min.js" integrity="sha512-w/1hLca9Fyn6iwnkMxUU55d/OlcA65RnP4v6kJ8NssnzHeHnJBeOzuHEkJ67zpt0ksiH1LQn8FKYZc/TT1O/aQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="/assets/js/config.js<?php echo $cacheBuster; ?>"></script>
  <script src="/modules/scripts/psef.js<?php echo $cacheBuster; ?>"></script>
  
  <?php
  if ($isHome) {
    return;
  }
?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js" integrity="sha512-J+763o/bd3r9iW+gFEqTaeyi+uAphmzkE/zU8FxY6iAvD3nQKXa+ZAWkBI9QS9QkYEKddQoiy0I5GDxKf/ORBA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.13/tinymce.min.js" integrity="sha512-14mUAc7bPPk/ppYTQKsuQ9hLwjXh/d6mX2y7QKQ3MtjddJysxmIzGcnzR53PJ2/0tvFT5IUfkQqh7QeLd5iH9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" integrity="sha512-nnzkI2u2Dy6HMnzMIkh7CPd1KX445z38XIu4jG1jGw7x5tSL3VBjE44dY4ihMU1ijAQV930SPM12cCFrB18sVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="/assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <script src="/assets/libs/select2/dist/js/select2.full.min.js"></script>
  <script src="/assets/extra-libs/DataTables/datatables.min.js"></script>

  <!-- slimscrollbar scrollbar JavaScript -->
  <script src="/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
  <script src="/assets/extra-libs/sparkline/sparkline.js"></script>

  <!-- apps -->
  <script src="/dist/js/app.js"></script>
  <script src="/dist/js/app.init.horizontal-fullwidth.js"></script>
  <script src="/dist/js/app-style-switcher.horizontal.js"></script>
  <!--Wave Effects -->
  <script src="/dist/js/waves.js"></script>
  <!--Menu sidebar -->
  <script src="/dist/js/sidebarmenu.js"></script>
  <!--Custom JavaScript -->
  <script src="/dist/js/custom.js"></script>

  <script src="/assets/js/stepbar.js"></script>
  <script src="/assets/js/print.min.js"></script>
  <script src="/assets/js/jquery.number.min.js"></script>
  <script src="/assets/js/keyboardShortcut.js"></script>
  <script src="/assets/js/async.min.js"></script>
  <script src="/assets/js/jquery.form.min.js" defer></script>
  <!-- <script src="assets/js/jquery.easyui.min.js"></script> -->

  <!-- start - This is for export functionality only -->
  <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
  <!-- Handlebars -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0/handlebars.js"></script>

  <script>
    let apiv1Url = "<?php echo $settingData->apiServerUrl; ?>/api/v1/";
    let apiv01Url = "<?php echo $settingData->apiServerUrl; ?>/api/v0.1/";
  </script>
<?php
}
