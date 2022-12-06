<script>
  function edit_data_permohonan(id) {
    $.ajax({
      url: url_api_x + "PermohonanCurrentUser(" + id + ")",
      type: 'GET',
      beforeSend: function (xhr) {
        xhr.setRequestHeader('Authorization', 'Bearer ' + accesstoken + '');
      },
      dataType: 'json',
      success: function (data, textStatus, xhr) {
        edit_permohonan(data)
      },
      error: function (xhr, textStatus, errorThrown) {
        console.log('Error in Operation');
      }
    });
  }

  function edit_permohonan(data) {
    let source = $("#edit-data").html();
    let template = Handlebars.compile(source);

    transformDataPermohonan(data);
    $('#load-data').html(template(data));

    $('#v-straUrl').val(data.straUrl)
    $('#v-suratPermohonanUrl').val(data.suratPermohonanUrl)
    $('#v-prosesBisnisUrl').val(data.prosesBisnisUrl)
    $('#v-dokumenApiUrl').val(data.dokumenApiUrl)
    $('#v-dokumenPseUrl').val(data.dokumenPseUrl)
    $('#v-izinUsahaUrl').val(data.izinUsahaUrl)
    $('#v-komitmenKerjasamaApotekUrl').val(data.komitmenKerjasamaApotekUrl)
    $('#v-pernyataanKeaslianDokumenUrl').val(data.pernyataanKeaslianDokumenUrl);
    // $('#v-spplUrl').val(data.spplUrl)
    // $('#v-izinLokasiUrl').val(data.izinLokasiUrl)
    // $('#v-imbUrl').val(data.imbUrl)
    $('#v-pembayaranPnbpUrl').val(data.pembayaranPnbpUrl)

    uploadHandler(true);
  }

  function update_data(event) {
    let form = event.target;
    form.classList.add('was-validated');
    event.preventDefault();

    if (form.checkValidity() === false) {
      displayErrorToastr("Isian Permohonan", "Isian Permohonan belum lengkap, mohon cek kembali");
      event.stopPropagation();
      scrollToTop();
      return false;
    }

    let data = getFormData("#data-update");
    data.typeId = 1;
    data.pemohonId = parseInt(data.pemohonId)
    data.id = parseInt(data.id)
    let url = `${apiServerUrl}/api/v0.1/PermohonanCurrentUser(${data.id})`;
    let request = submitFormData(url, "PATCH", accesstoken, JSON.stringify(data), ".preloader");

    request.done(
      function (data, textStatus, xhr) {
        displayRequestSuccessToastr(xhr, "Simpan Permohonan", "Permohonan berhasil disimpan", "Permohonan gagal disimpan");
        viewRouting();
      }
    );
    request.fail(
      function (xhr, textStatus, errorThrown) {
        displayRequestErrorToastr(xhr, "Simpan Permohonan", "Permohonan gagal disimpan");
      }
    );
  }

  function ajukan_permohonan(id) {
    let data = {
      'permohonanId': parseInt(id)
    }
    swal({
      title: 'Ajukan Permohonan',
      text: "Apakah anda yakin ingin mengajukan permohonan ini ?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: "Batal",
      confirmButtonText: 'Ya, Ajukan !'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: url_api_x + 'PermohonanCurrentUser/Ajukan',
          type: 'POST',
          beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer ' + accesstoken + '');
          },
          data: JSON.stringify(data),
          contentType: 'application/json',
          success: function (data, textStatus, xhr) {
            if (xhr.status == '204') {
              swal(
                'Berhasil!',
                'Permohonan di Ajukan',
                'success'
              );

              viewRouting();
            } else {
              swal({
                type: 'error',
                title: 'Oops...',
                text: 'Permohonan Gagal di Ajukan'
              });
            }
          },
          error: function (xhr, textStatus, errorThrown) {
            if(xhr.status == '402'){
              swal({
                type: 'warning',
                title: 'Oops...',
                text: 'Mohon dapat melakukan pembayaran PNBP terlebih dahulu',
                showCancelButton: false,   
                confirmButtonColor: "#DD6B55",      
                closeOnConfirm: false 
              }); 
            }
            if(xhr.status == '406'){
              swal({
                type: 'warning',
                title: 'Oops...',
                text: 'Mohon dapat melengkapi data integrasi API terlebih dahulu',
                showCancelButton: false,   
                confirmButtonColor: "#DD6B55",      
                closeOnConfirm: false 
              });
            }
            console.log('Error in Operation');
          }
        });
      }
    })
  }
</script>
