<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Pendaftaran API</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Pendaftaran API</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <button onclick="routing('pendaftaran_api')" type="button" class="btn waves-effect waves-light btn-rounded btn-primary"><i class="fas fa-redo"></i> Refresh Page</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card m-3 p-4">
      <h4 class="card-title">Data API</h4>
      <form class="mt-3" id="data-api" onsubmit="api_save(event)">
        <div class="form-group">
          <label>Url</label>
          <input value="" type="text" class="form-control" name="url" id="url" placeholder="Masukan Url API Anda." required>
        </div>

        <div class="form-group">
          <label>Token</label>
          <input value="" type="text" class="form-control" name="token" id="token" placeholder="Masukan Token API Anda.">
          <small class="form-text text-muted">(Optional) Jika memiliki token, pastikan diletekan pada header Authorization</small>

        </div>
        
        <button id="save-api" type="submit" class="btn btn-primary">Simpan</button>
        <a href="/api/apotek" target="_blank" style="padding-left: 20px;">Contoh Format Json</a>
      </form>
    </div>
    <input type="hidden" id="id" value="0">
  </div>


  <script>
    $(document).ready(function () {
      loadApiUser();
    });

    function loadApiUser(){
        var accesstoken = <?php echo json_encode($_COOKIE['accesstoken']); ?>; 
        $.ajax({
        url: url_api_x + 'PemohonApi/UserApi',
        type: 'GET',
        beforeSend: function (xhr) {
            $('.preloader').show();
          xhr.setRequestHeader('Authorization', 'Bearer ' + accesstoken + '');
        },
        dataType: 'json',
        success: function (data, textStatus, xhr) {
            if(data != null){
                $("#id").val(data.id);
                $("#url").val(data.url);
                $("#token").val(data.token);
            }
            $('.preloader').hide();
        },
        error: function (xhr, textStatus, errorThrown) { $('.preloader').hide();}
      });
    }

    function api_save(e) {
        e.preventDefault();
        var accesstoken = <?php echo json_encode($_COOKIE['accesstoken']); ?>; 
        var data = $('#data-api').serializeFormJSON();
        
        if(!data.url.includes("http://") && !data.url.includes("https://")){
            toastr.error("Url harus diikuti http/https", 'Alert!');
            return;
        };
        
        $.ajax({
            url: url_api_x+'PemohonApi',
            type: 'POST',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
            },
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function (data, textStatus, xhr) {
                if (xhr.status == '201') {
                    routing('pendaftaran_api');
                    toastr.success("Simpan API", 'Berhasil!');
                }
                else if (xhr.status == '204') {
                    routing('pendaftaran_api');
                    toastr.success("Update API", 'Berhasil!');
                }
                else{
                    toastr.error("Simpan API", 'Gagal!');
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log('Error in Operation');
            }
        });
    }
  </script>