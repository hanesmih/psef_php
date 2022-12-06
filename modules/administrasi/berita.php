<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Berita</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Administrasi</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Berita</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <button onclick="routing('berita')" type="button" class="btn waves-effect waves-light btn-rounded btn-primary"><i class="fas fa-redo"></i> Refresh Page</button>
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
                            <h4 class="page-title">Master Data Berita</h4>
                        </div>
                        <div class="col-7 align-self-center">
                            <div class="d-flex no-block justify-content-end align-items-center">
                                <button onclick="add_data()" type="button" class="btn waves-effect waves-light btn-info btn-add-data">Tambah Data Berita</button>
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
                <th>Judul</th>
                <th>URL Tautan</th>
                <th>Image</th>
                <th  width="9%">Tanggal</th>
                <th width="15%">Tindakan</th>
            </tr>
        </thead>
        <tbody>
            {{#value}}
            <tr id="row_{{id}}">
                <td>{{idx}}</td>
                <td>{{title}}</td>
                <td>{{linkUrl}}</td>
                <td><img src="{{imageUrl}}" width="400px"></td>
                <td>{{publishedAt}}</td>
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
    <h4 class="card-title">Tambah Berita</h4>
    <form class="m-t-30" id="add-data-new" onsubmit="data_save(event)">
        <div class="form-group">
            <label>Judul Berita</label>
            <input type="text" class="form-control" name="title" placeholder="Masukkan Judul Berita." required>
        </div>
        <div class="form-group">
            <label>URL Tautan</label>
            <input type="text" class="form-control" name="linkUrl" placeholder="Masukkan URL Tautan." required>
        </div>
        <div class="form-group">
            <label>Isi Berita</label>
            <div id="isi_berita" style="height: 150px;">
            </div>
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" class="form-control" id="imageUrl" required>
            <input type="hidden" name="imageUrl" id="v-imageUrl">
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
        <button type="button" class="btn btn-danger" onclick="routing('berita')">Batal</button>
    </form>
</script>

<!-- Template for edit -->
<script id="edit-data" type="text/x-handlebars-template">
    <h4 class="card-title">Ubah Data Berita</h4>
    <form class="m-t-30" id="data-update" onsubmit="update_data(event)">
        <div class="form-group">
            <label>Judul Berita</label>
            <input value="{{title}}" type="text" class="form-control" name="title" placeholder="Masukkan Judul Berita." required>
        </div>
        <div class="form-group">
            <label>URL Tautan</label>
            <input value="{{linkUrl}}" type="text" class="form-control" name="linkUrl" placeholder="Masukkan URL Tautan." required>
        </div>
        <div class="form-group">
            <label>Isi Berita</label>
            <div id="isi_berita" style="height: 150px;">
            </div>
        </div>
        <div class="form-group">
            <label>Image</label>
            <div id="close-imageUrl" style="padding-bottom:20px;">
                <img src="{{imageUrl}}">
            </div>
            <input type="file" class="form-control" id="imageUrl">
            <input type="hidden" name="imageUrl" id="v-imageUrl" value="{{imageUrl}}">
        </div>
        <input type="hidden" name="id" value="{{id}}">
        <button type="submit" class="btn btn-primary">Kirim</button>
        <button type="button" class="btn btn-danger" onclick="routing('berita')">Batal</button>
    </form>
</script>

<script>
    var quill;
    var accesstoken = <?php echo json_encode($_COOKIE['accesstoken']); ?>; 
    $(document).ready(function() { 
        $.ajax({
            url: url_api+'HomepageNews',
            type: 'GET',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
            },
            dataType: 'json',
            success: function (data, textStatus, xhr) {
                data_berita(data)
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log('Error in Operation');
            }
        });
    });
    function data_berita(data){
        let source = $("#table-data").html();
        let template = Handlebars.compile(source);
        $.each(data.value, function(i, v) {
          data.value[i]['idx'] = i+1
          data.value[i]['publishedAt'] = moment(v.publishedAt).format("YYYY-MM-DD");
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
        $('#imageUrl').change(function() { 
           upload_image_url()
        });

        quill = new Quill('#isi_berita', {
            theme: 'snow'
        });
    }
    function data_save(e) {
        e.preventDefault();
        var data = $('#add-data-new').serializeFormJSON();
        var data_quill = quill.getContents();
        data.content = JSON.stringify(data_quill)
        $.ajax({
            url: url_api+'HomepageNews',
            type: 'POST',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
            },
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function (data, textStatus, xhr) {
                console.log(data)
                if (xhr.status == '201') {
                    routing('berita');
                    toastr.success("Tambah Berita", 'Berhasil!');
                }else{
                    toastr.error("Tambah Berita", 'Gagal!');
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log('Error in Operation');
            }
        });
    }
    function edit_data(id) {
        $.ajax({
            url: url_api+"HomepageNews("+id+")",
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
        data.content = JSON.parse(data.content)
        console.log(data)

        $('#load-data').html(template(data));

        $('#imageUrl').change(function() { 
            upload_image_url('edit')
        });

        quill = new Quill('#isi_berita', {
            theme: 'snow'
        });
        quill.setContents(data.content)
    }
    function upload_image_url(data){
        var formData = new FormData();
        formData.append('file', $('#imageUrl')[0].files[0]);
        var data_upload =  $('#imageUrl')[0].files[0];
        const  fileType = data_upload['type'];
        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];

        if (validImageTypes.includes(fileType)) {
            if(data_upload.size<1100000 && data_upload.size>0){
                $.ajax({
                    url: url_api_x+'UploadNewsImage',
                    type: 'POST',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (datax, textStatus, xhr) {
                        $('#v-imageUrl').val(datax.value)
                        if(data=='edit'){
                            $('#close-imageUrl').html('<img src="'+datax.value+'">')
                            $("#imageUrl").prop('required',true);
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        if(data=='edit'){
                            $("#imageUrl").prop('required',true);
                        }
                        $("#imageUrl").val('');
                        $('#close-imageUrl').html('')
                        $('#v-imageUrl').val('')
                        swal({
                            type: 'error',
                            title: 'Maaf !',
                            text: 'Pastikan File yang anda upload sesuai dengan ketentuan!',
                        })
                    }
                });
            }else{
                if(data=='edit'){
                    $("#imageUrl").prop('required',true);
                }
                $("#imageUrl").val('');
                $('#close-imageUrl').html('')
                $('#v-imageUrl').val('')
                swal({
                    type: 'error',
                    title: 'Maaf !',
                    text: 'Pastikan Ukuran file yang anda masukkan maksimal 1MB',
                }) 
            }
        }else{
            if(data=='edit'){
                $("#imageUrl").prop('required',true);
            }
            $("#imageUrl").val('');
            $('#close-imageUrl').html('')
            $('#v-imageUrl').val('')
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
        var data_quill = quill.getContents();
        data.content = JSON.stringify(data_quill)
        let id_berita = data.id
        $.ajax({
            url: url_api+'HomepageNews('+id_berita+')',
            type: 'PATCH',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
            },
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function (data, textStatus, xhr) {
                if (xhr.status == '204') {
                    routing('berita');
                    toastr.success("Memperbarui Berita", 'Berhasil!');
                }else{
                    toastr.error("Memperbarui Berita", 'Gagal!');
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log('Error in Operation');
            }
        });
    }
    function delete_data(id){
        swal({
            title: 'Hapus Berita',
            text: "Apakah Anda yakin menghapus berita ini ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: "Batal",
            confirmButtonText: 'Ya, Hapus !'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url_api+'HomepageNews('+id+')',
                    type: 'DELETE',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
                    },
                    dataType: 'json',
                    success: function (data, textStatus, xhr) {
                        if (xhr.status == '204') {
                            swal(
                                'Berhasil!',
                                'Hapus Berhasil',
                                'success'
                            )
                            routing('berita')
                        }else{
                            swal({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Gagal Delete Berhasil'
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
