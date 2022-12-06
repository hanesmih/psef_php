<?php
$isKemkesView = true;
$showRekamJejak = true;
$extraActions = 'setujui';

$pageTitle = 'Permohonan (Tertunda)';
include('../template/template_kemkes.php');
?>

<script>
    var accesstoken = <?php echo json_encode($_COOKIE['accesstoken']); ?>; 
    $(document).ready(function() { 
        $('#zero_config').on('xhr.dt', function ( e, settings, json, xhr ) {
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
                let info = (role == "Psef.Dirjen") ? `<p>${json.data[i].statusName}</p>` :
                    `<p>${json.data[i].statusName}</p>` +
                    `<p><hr style="display: inline;border: 7px solid ${userDaysColor(json.data[i].userLevelDays)};" />` +
                    `User Days : ${json.data[i].userLevelDays}</p>` +
                    `<p><hr style="display: inline;border: 7px solid ${totalDaysColor(json.data[i].totalDays)};" />` +
                    `Total Days : ${json.data[i].totalDays}</p>`;
                let action = (role == "Psef.Dirjen") ? `<button onclick="view_data('${json.data[i].permohonanId}')" class="btn btn-xs btn-block btn-info">Lihat Detail Data</button>` :
                  `<button onclick="view_data('${json.data[i].permohonanId}')" class="btn btn-xs btn-block btn-info">Lihat Detail Data</button>` +
                  `<button onclick="process_data('${json.data[i].permohonanId}')" class="btn btn-xs btn-block btn-success">Setujui</button>` +
                  `<button onclick="reject_data('${json.data[i].permohonanId}')" class="btn btn-xs btn-block btn-warning">Kembalikan</button>`;

                data.push(dataTablePermohonanPemohonRow(json.data[i], info, action));
              }

              return data;
            },

            "data": function ( d ) {
              return configurePermohonanRequest(d, 'Permohonan/DirekturJenderalPending');
            }
            }
        });
    });

    function viewRouting() {
      routing('pending_dirjen');
    }

    function view_data(id){
      loadAndDisplayPermohonan(id, url_api_x, accesstoken);
    }

    function detail_nib(nib){
        localStorage.setItem("nib", nib);
        window.open(url);
    }

    function reject_data(id){
      permohonanKembalikan(id, url_api_x + 'Permohonan/DirekturJenderalKembalikan', accesstoken);
    }

    function process_data(id){
      Swal
        .fire({
          title: 'Penyetujuan Permohonan',
          text: "Apakah anda yakin ingin memproses permohonan ini ?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Proses !',
          cancelButtonText: "Batal",
        })
        .then((result) => {
          if(!result.value) {
            return;
          }

          // inputPassphrase(id, `${url_api_x}Permohonan/DirekturJenderalSelesaikan`, accesstoken);
          selesaikanPermohonan(
            id,
            `${url_api_x}Permohonan/DirekturJenderalSelesaikan`,
            accesstoken,
            viewRouting,
            ".preloader");
        });
    }
</script>
