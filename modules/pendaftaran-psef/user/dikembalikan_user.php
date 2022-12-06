<?php
$extraActions = 'ajukan';
$pageTitle = 'Permohonan (Dikembalikan)';

include('template.php');
include('../template/edit_permohonan.php');
include('../template/add_apotek.html');
include('../template/edit_apotek.html');
include('../template/view_apotek.html');
include('../template/modal_apotek.html');


include('../template/add_rumah_sakit.html');
include('../template/edit_rumah_sakit.html');
include('../template/view_rumah_sakit.html');
include('../template/modal_rumah_sakit.html');

include('apotek_script.html');
include('rumah_sakit_script.html');
include('edit_permohonan_script.php');
?>

<script>
  var arr_detail_add = [];
  var arr_detail_add_x = [];
  var arr_detail_add_klinik = [];
  var arr_detail_add_klinik_x = [];
  var arr_detail_add_rs = [];
  var arr_detail_add_rs_x = [];
  var id_detail_add = 0;
  var id_detail_add_klinik = 0;
  var id_detail_add_rs = 0;
  var cc;

  $(document).ready(function() {
    $('#zero_config').on('xhr.dt', function(e, settings, json, xhr) {
      json.data = json.rows;
      json.recordsTotal = json.recordsFiltered = json.total;
    }).DataTable({
      "processing": true,
      "columnDefs": [{
        "targets": [4],
        "orderable": false,
      }],
      "serverSide": true,
      "scrollY": '100vh',
      "scrollX": true,
      "ajax": {
        "url": url_api_php,
        "type": "POST",
        "dataSrc": function(json) {
          return permohonanFromJson(json, false, true);
        },
        "data": function(d) {
          return permohonanAjaxRequest(d, 'PermohonanCurrentUser/Dikembalikan');
        }
      }
    });
  });

  function viewRouting() {
    routing('dikembalikan_user');
  }
</script>
