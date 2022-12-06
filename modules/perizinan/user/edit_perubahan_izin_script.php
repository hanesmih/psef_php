<script>
  function uploadHandler(isEdit) {
    let uploadUrl = `${url_api_x}UploadUserFile`;

    setUploadHandler("straUrl", isEdit, uploadUrl, accesstoken);
  }

  function edit_data_izin(id) {
    $.ajax({
      url: url_api_x + "PerubahanIzin(" + id + ")",
      type: 'GET',
      beforeSend: function (xhr) {
        xhr.setRequestHeader('Authorization', 'Bearer ' + accesstoken + '');
      },
      dataType: 'json',
      success: function (data, textStatus, xhr) {
        edit_izin(data)
      },
      error: function (xhr, textStatus, errorThrown) {
        console.log('Error in Operation');
      }
    });
  }

  function edit_izin(data) {
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
    data.typeId = 3;
    data.perizinanId = parseInt(data.perizinanId)
    data.pemohonId = parseInt(data.pemohonId)
    data.permohonanId = parseInt(data.permohonanId)
    data.id = (data.id == NaN || data.id == 0) ? null : parseInt(data.id)
    let url = `${url_api_x}PermohonanCurrentUser/PostPerubahanIzin`;
    let request = submitFormData(url, "POST", accesstoken, JSON.stringify(data), ".preloader");
    
    request.done(
      function (data, textStatus, xhr) {
        displayRequestSuccessToastr(xhr, "Ubah Perizinan", "Perizinan berhasil diubah", "Permohonan gagal disimpan");
        viewRouting();
      }
    );
    request.fail(
      function (xhr, textStatus, errorThrown) {
        displayRequestErrorToastr(xhr, "Ubah Perizinan", "Perizinan gagal diubah");
      }
    );
  }

  function ajukan_perubahan_izin(id) {
    let data = {
      'permohonanId': parseInt(id),
      'reason': ''
    }
    swal({
      title: 'Ajukan Perubahan',
      text: "Apakah anda yakin ingin mengajukan perubahan izin ini?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: "Batal",
      confirmButtonText: 'Ya, Ajukan !'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: url_api_x + 'PermohonanCurrentUser/AjukanPerubahanIzin',
          type: 'POST',
          beforeSend: function (xhr) {
            $('.preloader').show();
            xhr.setRequestHeader('Authorization', 'Bearer ' + accesstoken + '');
          },
          data: JSON.stringify(data),
          contentType: 'application/json',
          success: function (data, textStatus, xhr) {
            $('.preloader').hide();
            if (xhr.status == '204') {
              swal(
                'Berhasil!',
                'Perubahan Izin di Ajukan',
                'success'
              );

              viewRouting();
            } else {
              swal({
                type: 'error',
                title: 'Oops...',
                text: 'Perubahan Izin Gagal di Ajukan'
              });
            }
          },
          error: function (xhr, textStatus, errorThrown) {
            $('.preloader').hide();
            console.log('Error in Operation');
          }
        });
      }
    })
  }
</script>
