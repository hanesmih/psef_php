<?php

// if($role == "Psef.Verifikator" && $statusId == "2"){
//     echo "<button onclick=\"verifikasi_setujui('{{data_permohonan.id}}')\" class=\"btn btn-rounded btn-success\" id=\"btnSetujui\">
//         <i class=\"fa fa-share mr-2\"></i>
//         Teruskan
//     </button>";
// }

// if($role == "Psef.Supervisor"){
//     echo "<button onclick=\"kasi_setujui('{{data_permohonan.id}}')\" class=\"btn btn-rounded btn-success\" id=\"btnSetujuiKasi\">
//         <i class=\"fa fa-share mr-2\"></i>
//         Teruskan
//     </button>";
// }

// if($role == "Psef.Kasubdit"){
//     echo "<button onclick=\"kasubdit_setujui('{permohonanId}')\" class=\"btn btn-rounded btn-success\">
//         <i class=\"fa fa-share mr-2\"></i>
//         Teruskan
//     </button>";
// }

?>

<div id="groupApproval">

</div>

<script>
    $(function() {
        let role = "<?php echo $_SESSION["role"]; ?>";
        $("#groupApproval").empty();

        if(role == "Psef.Verifikator" && "{{data_permohonan.statusId}}" == 2){
            $("#groupApproval").append(`<button onclick="process_lanjut('{{data_permohonan.id}}', 'PerubahanIzin/VerifikatorSetujui')" class="btn btn-rounded btn-success">
            <i class="fa fa-share mr-2"></i>
            Teruskan
            </button>`);
        } 
        else if(role == "Psef.Supervisor" && "{{data_permohonan.statusId}}" == 3){
            $("#groupApproval").append(`<button onclick="process_lanjut('{{data_permohonan.id}}', 'PerubahanIzin/KepalaSeksiSetujui')" class="btn btn-rounded btn-success">
            <i class="fa fa-share mr-2"></i>
            Teruskan
            </button>`);
        }
        else if(role == "Psef.Timja" && "{{data_permohonan.statusId}}" == 5){
            $("#groupApproval").append(`<button onclick="process_lanjut('{{data_permohonan.id}}', 'PerubahanIzin/KepalaSubDirektoratSetujui')" class="btn btn-rounded btn-success">
            <i class="fa fa-share mr-2"></i>
            Teruskan
            </button>`);
        }
        else if(role == "Psef.Dirpenyanfar" && "{{data_permohonan.statusId}}" == 7){
            $("#groupApproval").append(`<button onclick="process_lanjut('{{data_permohonan.id}}', 'PerubahanIzin/DirekturPelayananFarmasiSetujui')" class="btn btn-rounded btn-success">
            <i class="fa fa-share mr-2"></i>
            Teruskan
            </button>`);
        }
        else if(role == "Psef.Dirjen" && "{{data_permohonan.statusId}}" == 9){
            $("#groupApproval").append(`<button onclick="process_data('{{data_permohonan.id}}')" class="btn btn-rounded btn-success">
            <i class="fa fa-share mr-2"></i>
            Teruskan
            </button>`);
        }
    });

    function process_lanjut(id, path){
        perubahanIzinSetujui(id, url_api_x + path, accesstoken);
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
            `${url_api_x}PerubahanIzin/DirekturJenderalSelesaikan`,
            accesstoken,
            viewRouting,
            ".preloader");
        });
    }
</script>