<?php
require_once("../../template/common_script.php");
?>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Pemohon</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Pemohon</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <button onclick="routing('pemohon_user')" type="button" class="btn waves-effect waves-light btn-rounded btn-primary"><i class="fas fa-redo"></i> Segarkan Halaman</button>
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
                            <h4 class="page-title">Data Pemohon</h4>
                        </div>
                        <div class="col-7 align-self-center">
                            <div class="d-flex no-block justify-content-end align-items-center">
                                <button onclick="add_data()" type="button" class="btn waves-effect waves-light btn-info btn-add-data" style="display:none;">Tambah Data Pemohon</button>
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
                <th>Nomor Telepon</th>
                <th>Alamat</th>
                <th>NIB</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            {{#value}}
                <tr>
                    <td>{{phone}}</td>
                    <td>{{address}}</td>
                    <td>{{nib}}</td>
                    <td>
                        <button onclick="edit_data('{{id}}')" type="button" class="btn waves-effect waves-light btn-primary">Ubah</button>
                    </td>
                </tr>
            {{/value}}
        </tbody>
    </table>
</script>

<!-- Template for add -->
<script id="add-data" type="text/x-handlebars-template">
    <h4 class="card-title">Tambah Pemohon</h4>
    <form class="m-t-30" id="add-data-new" onsubmit="data_save(event)">
        <div class="form-group">
            <label>Nomor Telepon</label>
            <input type="text" class="form-control" name="phone" placeholder="Masukan Nomor Telepon." required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <input type="text" class="form-control" name="address" placeholder="Masukan Alamat." required>
        </div>
        <div class="form-group">
            <label>NIB</label>
            <input type="text" class="form-control" id="nib" name="nib" placeholder="Masukan NIB." required>
            <small class="form-text text-muted"><div id="cek_nib" style="color:white;" ></div></small>
        </div>
        <div id="nib_view"></div>
        <input type="hidden" id="status_nib">
        <button type="submit" class="btn btn-primary">Kirim</button>
        <button type="button" class="btn btn-danger" onclick="routing('pemohon_user')">Batal</button>
    </form>
</script>

<!-- Template for edit -->
<script id="edit-data" type="text/x-handlebars-template">
    <h4 class="card-title">Ubah Data Pemohon</h4>
    <form class="m-t-30" id="data-update" onsubmit="update_data(event)">
        <div class="form-group">
            <label>Nomor Telepon</label>
            <input value="{{phone}}" type="text" class="form-control" name="phone" placeholder="Masukan Nomor Telepon." required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <input value="{{address}}" type="text" class="form-control" name="address" placeholder="Masukan Alamat." required>
        </div>
        <div class="form-group">
            <label>NIB</label>
            <input value="{{nib}}" type="text" class="form-control" name="nib" placeholder="Masukan NIB." id="nib" required>
            <small class="form-text text-muted"><div id="cek_nib" style="color:white;" ></div></small>
        </div>
        <div id="nib_view"></div>
        <input type="hidden" id="status_nib">
        <input type="hidden" name="id" value="{{id}}" type="number">
        <button type="submit" class="btn btn-primary">Kirim</button>
        <button type="button" class="btn btn-danger" onclick="routing('pemohon_user')">Batal</button>
    </form>
</script>

<script>
    var accesstoken = <?php echo json_encode($_COOKIE['accesstoken']); ?>; 
    $(document).ready(function() { 
        $.ajax({
            url: url_api_x+'Pemohon/CurrentUser',
            type: 'GET',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
            },
            dataType: 'json',
            success: function (data, textStatus, xhr) {
                $('.btn-add-data').remove()
                data_pemohon_user(data)
            },
            error: function (xhr, textStatus, errorThrown) {
                $('.btn-add-data').css("display","block")
                let data=''
                data_pemohon_user(data)
            }
        });
    });
    function data_pemohon_user(data){
        let source = $("#table-data").html();
        let template = Handlebars.compile(source);

        let datax = [];
        if(data!=''){
            datax.value=data;
        }
        let dw = datax;
       
        $('#table-data-here').append(template(dw));
        $('#zero_config').DataTable({
        });
    }
    function add_data() {
        let source = $("#add-data").html();
        let template = Handlebars.compile(source);
        
        $('#load-data').html(template());
        $("#nib").blur(function() {
            cek_nib()
        });
    }
    function data_save(e) {
        e.preventDefault();
        var data = $('#add-data-new').serializeFormJSON();
        let status_nib = $('#status_nib').val()
        if(status_nib==0){
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#nib").offset().top
            }, 2000);
            $("#nib").focus();
        }else{
            $.ajax({
                url: url_api_x+'Pemohon/CurrentUser',
                type: 'POST',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
                },
                data: JSON.stringify(data),
                contentType: 'application/json',
                success: function (data, textStatus, xhr) {
                    if (xhr.status == '201') {
                        routing('pemohon_user');
                        toastr.success("Tambah Pemohon", 'Berhasil!');
                    }else{
                        toastr.error("Tambah Pemohon", 'Gagal!');
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('Error in Operation');
                }
            });
        }
        
    }
    function edit_data(id) {
        $.ajax({
            url: url_api_x+"Pemohon/CurrentUser",
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
        data.straExpiry = moment(data.straExpiry).format("YYYY-MM-DD");

        $('#load-data').html(template(data));
        
        $("#nib").blur(function() {
            cek_nib()
        });

        cek_nib();
    }
    function update_data(e) {
        e.preventDefault();
        var data = $('#data-update').serializeFormJSON();
        let intId = parseInt(data.id)
        data.id = intId
        data.userId = sid
        let status_nib = $('#status_nib').val()
        if(status_nib==0){
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#nib").offset().top
            }, 2000);
            $("#nib").focus();
        }else{
            $.ajax({
                url: url_api_x+'Pemohon/CurrentUser',
                type: 'PATCH',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
                },
                data: JSON.stringify(data),
                contentType: 'application/json',
                success: function (data, textStatus, xhr) {
                    if (xhr.status == '204' || xhr.status == '200') {
                        routing('pemohon_user');
                        toastr.success("Memperbarui Pemohon", 'Berhasil!');
                    }else{
                        toastr.error("Memperbarui Pemohon", 'Gagal!');
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('Error in Operation');
                }
            });
        }
    }
    function cek_nib(){
        $('#nib_view').html('');
        let nib = $('#nib').val();

        loadAndDisplayOssData(nib, url_api_x, accesstoken);
    }
</script>
