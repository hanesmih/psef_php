<?php
$pageTitle = 'Permohonan (Ditolak)';
include('template.php');
?>

<script>
   var arr_detail_add = [];
   var arr_detail_add_x = [];
   var id_detail_add = 0;
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
               return permohonanFromJson(json, true);
            },
            "data": function(d) {
               return permohonanAjaxRequest(d, 'PermohonanCurrentUser/Ditolak');
            }
         }
      });
   });

   function viewRouting() {
      routing('ditolak_user');
   }
</script>
