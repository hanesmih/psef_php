<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Spanduk</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Administrasi</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Spanduk</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <button onclick="routing('spanduk')" type="button" class="btn waves-effect waves-light btn-rounded btn-primary"><i class="fas fa-redo"></i> Refresh Page</button>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body" id="load-data">
                    <div class="row">
                        <div class="col-5 align-self-center">
                            <h4 class="page-title">Master Data Spanduk</h4>
                        </div>
                        <div class="col-7 align-self-center">
                            <div class="d-flex no-block justify-content-end align-items-center">
                                <button onclick="add_data()" type="button" class="btn waves-effect waves-light btn-info btn-add-data">Tambah Data Spanduk</button>
                            </div>
                        </div>
                    </div><br>
                    <div class="table-responsive" id="table-data-here">
                        <!-- Table content goes here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Template show data -->
<script id="table-data" type="text/x-handlebars-template">
    <table id="zero_config" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Image</th>
                <th width="15%">Tindakan</th>
            </tr>
        </thead>
        <tbody>
            {{#value}}
            <tr id="row_{{id}}">
                <td><span>{{idx}}</span></td>
                <td>
                    <img src="{{url}}" width="80%">
                </td>
                <td>
                    <button onclick="edit_data('{{id}}')" type="button" class="btn waves-effect waves-light btn-primary">Ubah</button>
                    <button onclick="delete_data('{{id}}')" type="button" class="btn waves-effect waves-light btn-danger">Hapus</button>
                </td>
            </tr>
            {{/value}}
        </tbody>
    </table>
</script>

<!-- Template for add -->
<script id="add-data" type="text/x-handlebars-template">
    <h4 class="card-title">Tambah Spanduk</h4>
    <form class="m-t-30" id="add-data-new" onsubmit="data_save(event)">
        <div class="form-group">
            <label>Image</label>
            <input type="file" class="form-control" id="url" required>
            <input type="hidden" name="url" id="v-url">
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
        <button type="button" class="btn btn-danger" onclick="routing('spanduk')">Batal</button>
    </form>
</script>

<!-- Template for edit -->
<script id="edit-data" type="text/x-handlebars-template">
    <h4 class="card-title">Ubah Data Spanduk</h4>
    <form class="m-t-30" id="data-update" onsubmit="update_data(event)">
        <div class="form-group">
            <label>Image</label>
            <div id="close-url" style="padding-bottom:20px;">
                <img src="{{url}}">
            </div>
            <input type="file" class="form-control" id="url">
            <input type="hidden" name="url" id="v-url" value="{{url}}">
        </div>
        <input type="hidden" name="id" value="{{id}}">
        <button type="submit" class="btn btn-primary">Kirim</button>
        <button type="button" class="btn btn-danger" onclick="routing('spanduk')">Batal</button>
    </form>
</script>

<script>
    var accesstoken = <?php echo json_encode($_COOKIE['accesstoken']); ?>; 
    $(document).ready(function() { 
        $.ajax({
            url: url_api+'HomepageBanner',
            type: 'GET',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
            },
            dataType: 'json',
            success: function (data, textStatus, xhr) {
                data_spanduk(data)
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log('Error in Operation');
            }
        });
    });
    function data_spanduk(data){
        let source = $("#table-data").html();
        let template = Handlebars.compile(source);
        $.each(data.value, function(i, v) {
          data.value[i]['idx'] = i+1
        });
        let dw = data;
       
        $('#table-data-here').append(template(dw));
        $('#zero_config').DataTable({
        });
    }
    function add_data() {
        let source = $("#add-data").html();
        let template = Handlebars.compile(source);
        
        $('#load-data').html(template());
        $('#url').change(function() { 
           upload_url()
        });
    }
    function data_save(e) {
        e.preventDefault();
        var data = $('#add-data-new').serializeFormJSON();
        console.log(data)
        $.ajax({
            url: url_api+'HomepageBanner',
            type: 'POST',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
            },
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function (data, textStatus, xhr) {
                console.log(data)
                if (xhr.status == '201') {
                    routing('spanduk');
                    toastr.success("Tambah Spanduk", 'Berhasil!');
                }else{
                    toastr.error("Tambah Spanduk", 'Gagal!');
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log('Error in Operation');
            }
        });
    }
    function edit_data(id) {
        $.ajax({
            url: url_api+"HomepageBanner("+id+")",
            type: 'GET',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
            },
            dataType: 'json',
            success: function (data, textStatus, xhr) {
                edit(data)
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log('Error in Operation');
            }
        });
    }
    function edit(data) {
        let source = $("#edit-data").html();
        let template = Handlebars.compile(source);

        $('#load-data').html(template(data));

        $('#url').change(function() { 
           upload_url('edit')
        });
    }
    function upload_url(data){
        var formData = new FormData();
        formData.append('file', $('#url')[0].files[0]);
        var data_upload =  $('#url')[0].files[0];
        const  fileType = data_upload['type'];
        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];

        if (validImageTypes.includes(fileType)) {
            if(data_upload.size<1100000 && data_upload.size>0){
                $.ajax({
                    url: url_api_x+'UploadBanner',
                    type: 'POST',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (datax, textStatus, xhr) {
                        $('#v-url').val(datax.value)
                        if(data=='edit'){
                            $('#close-url').html('<img src="'+datax.value+'">')
                            $("#url").prop('required',true);
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        if(data=='edit'){
                            $("#url").prop('required',true);
                        }
                        $("#url").val('');
                        $('#close-url').html('')
                        $('#v-url').val('')
                        swal({
                            type: 'error',
                            title: 'Maaf !',
                            text: 'Pastikan File yang anda upload sesuai dengan ketentuan!',
                        })
                    }
                });
            }else{
                if(data=='edit'){
                    $("#url").prop('required',true);
                }
                $("#url").val('');
                $('#close-url').html('')
                $('#v-url').val('')
                swal({
                    type: 'error',
                    title: 'Maaf !',
                    text: 'Pastikan Ukuran file yang anda masukkan maksimal 1MB',
                }) 
            }
        }else{
            if(data=='edit'){
                $("#url").prop('required',true);
            }
            $("#url").val('');
            $('#close-url').html('')
            $('#v-url').val('')
            swal({
                type: 'error',
                title: 'Maaf !',
                text: 'Ekstension file yang diperbolehkan: .gif, .jpg, .jpeg, .png',
            })
        }
    }
    function update_data(e) {
        e.preventDefault();
        var data = $('#data-update').serializeFormJSON();
        let id_spanduk = data.id
        $.ajax({
            url: url_api+'HomepageBanner('+id_spanduk+')',
            type: 'PATCH',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
            },
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function (data, textStatus, xhr) {
                if (xhr.status == '204') {
                    routing('spanduk');
                    toastr.success("Memperbarui Spanduk", 'Berhasil!');
                }else{
                    toastr.error("Memperbarui Spanduk", 'Gagal!');
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log('Error in Operation');
            }
        });
    }
    function delete_data(id){
        swal({
            title: 'Hapus Spanduk',
            text: "Apakah Anda yakin menghapus spanduk ini ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: "Batal",
            confirmButtonText: 'Ya, Hapus !'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url_api+'HomepageBanner('+id+')',
                    type: 'DELETE',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
                    },
                    dataType: 'json',
                    success: function (data, textStatus, xhr) {
                        if (xhr.status == '204') {
                            swal(
                                'Berhasil!',
                                'Hapus Spanduk',
                                'success'
                            )
                            routing('spanduk')
                        }else{
                            swal({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Gagal Delete Spanduk'
                            })
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.log('Error in Operation');
                    }
                });
            }
        })
    }
</script>
