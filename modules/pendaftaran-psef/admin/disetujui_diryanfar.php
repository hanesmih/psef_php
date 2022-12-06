<?php
$isKemkesView = true;
$showRekamJejak = true;
$extraActions = 'setujui';

$pageTitle = 'Permohonan (Disetujui Direktur Pelayanan Farmasi)';
include('../template/template_kemkes.php');
?>

<script>
    var accesstoken = <?php echo json_encode($_COOKIE['accesstoken']); ?>; 
    $(document).ready(function() { 
        $('#zero_config').on('xhr.dt', function ( e, settings, json, xhr ) {
          console.log(json);
            json.data = json.rows;
            json.recordsTotal = json.recordsFiltered = json.total;
        }).DataTable({
            "processing": true,
            "columnDefs": [ {
                "targets": [4],
                "orderable": false,
            } ],
            "serverSide": true,
            "scrollY": '100vh',
            "scrollX": true,
            "ajax": {
            "url": url_api_php,
            "type": "POST",
            "dataSrc": function ( json ) {
              let data = [];

              for (let i = 0; i < json.data.length; i++) {
                let info =
                    `<p>${json.data[i].statusName}</p>`;
                let action = `<button onclick="view_data('${json.data[i].id}')" class="btn btn-xs btn-block btn-info">Lihat Detail Data</button>`;

                data.push(dataTablePermohonanPemohonRow(json.data[i], info, action));
              }

              return data;
            },

            "data": function ( d ) {
              return configurePermohonanRequest(d, 'Permohonan/DirekturPelayananFarmasiDisetujui');
            }
            }
        });
    });

    function viewRouting() {
      routing('disetujui_diryanfar');
    }

    function view_data(id){
      loadAndDisplayPermohonan(id, url_api_x, accesstoken);
    }

    function detail_nib(nib){
        localStorage.setItem("nib", nib);
        window.open(url);
    }

</script>
