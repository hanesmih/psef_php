<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Desa/Kelurahan</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Administrasi</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Desa/Kelurahan</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <button onclick="routing('deskel')" type="button" class="btn waves-effect waves-light btn-rounded btn-primary"><i class="fas fa-redo"></i> Refresh Page</button>
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
                            <h4 class="page-title">Master Data Desa/Kelurahan</h4>
                        </div>
                        <div class="col-7 align-self-center">
                            <div class="d-flex no-block justify-content-end align-items-center">
                                <button onclick="add_data()" type="button" class="btn waves-effect waves-light btn-info btn-add-data">Add Data</button>
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
                <th>Nama</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            {{#value}}
            <tr id="row_{{id}}">
                <td><span>{{idx}}</span></td>
                <td>{{name}}</td>
                <td>
                    <button onclick="edit_data('{{id}}')" type="button" class="btn waves-effect waves-light btn-primary">Edit</button>
                    <button onclick="delete_data('{{id}}')" type="button" class="btn waves-effect waves-light btn-danger">Delete</button>
                </td>
            </tr>
            {{/value}}
        </tbody>
    </table>
</script>

<!-- Template for add -->
<script id="add-data" type="text/x-handlebars-template">
    <h4 class="card-title">Add New Desa/Kelurahan</h4>
    <form class="m-t-30" id="add-data-new" onsubmit="data_save(event)">
        <div class="form-group">
            <label>Nama Desa/Kelurahan</label>
            <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Desa/Kelurahan." required>
        </div>
        <div class="form-group">
            <label>Kecamatan</label>
            <select name="kecamatanId" id="kecamatanId" class="form-control" required>
                <option value="" selected disabled>-- Choose Kecamatan --</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-danger" onclick="routing('deskel')">Cancel</button>
    </form>
</script>

<!-- Template for edit -->
<script id="edit-data" type="text/x-handlebars-template">
    <h4 class="card-title">Edit Data Desa/Kelurahan</h4>
    <form class="m-t-30" id="data-update" onsubmit="update_data(event)">
        <div class="form-group">
            <label>Nama Desa/Kelurahan</label>
            <input value="{{name}}" type="text" class="form-control" name="name" placeholder="Masukkan Nama Desa/Kelurahan." required>
        </div>
        <div class="form-group">
            <label>Kecamatan</label>
            <select name="kecamatanId" id="kecamatanId" class="form-control" required>
                <option value="" selected disabled>-- Choose Kecamatan --</option>
            </select>
        </div>
        <input type="hidden" name="id" value="{{id}}">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-danger" onclick="routing('deskel')">Cancel</button>
    </form>
</script>

<script>
    var accesstoken = <?php echo json_encode($_COOKIE['accesstoken']); ?>; 
    $(document).ready(function() { 
        $.ajax({
            url: url_api+'DesaKelurahan',
            type: 'GET',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
            },
            dataType: 'json',
            success: function (data, textStatus, xhr) {
                data_deskel(data)
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log('Error in Operation');
            }
        });
    });
    function data_deskel(data){
        let source = $("#table-data").html();
        let template = Handlebars.compile(source);
        $.each(data.value, function(i, v) {
          data.value[i]['idx'] = i+1
        });
        let dw = data;
       
        $('#table-data-here').append(template(dw));
        $('#zero_config').DataTable({
            "scrollY": '100vh',
            "scrollX": true,
        });
    }
    function add_data() {
        let source = $("#add-data").html();
        let template = Handlebars.compile(source);
        
        $('#load-data').html(template());

        $.ajax({
            url: url_api+'Kecamatan',
            type: 'GET',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
            },
            dataType: 'json',
            success: function (data, textStatus, xhr) {
                $.each(data.value, function(i, v) {
                    $('select[name="kecamatanId"]').append("<option value='" + v.id + "'>" + v.name + "</option>")
                });
                $('#kecamatanId').select2()
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log('Error in Operation');
            }
        });

    }
    function data_save(e) {
        e.preventDefault();
        var data = $('#add-data-new').serializeFormJSON();
        $.ajax({
            url: url_api+'DesaKelurahan',
            type: 'POST',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
            },
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function (data, textStatus, xhr) {
                if (xhr.status == '201') {
                    routing('deskel');
                    toastr.success("Add Desa/Kelurahan", 'Success!');
                }else{
                    toastr.error("Gagal Add Desa/Kelurahan", 'Error!');
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log('Error in Operation');
            }
        });
    }
    function edit_data(id) {
        $.ajax({
            url: url_api+"DesaKelurahan("+id+")",
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

        $.ajax({
            url: url_api+'Kecamatan',
            type: 'GET',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
            },
            dataType: 'json',
            success: function (datax, textStatus, xhr) {
                $.each(datax.value, function(i, v) {
                    $('select[name="kecamatanId"]').append("<option value='" + v.id + "'>" + v.name + "</option>")
                });
                $('#kecamatanId').select2()
                $("#kecamatanId option").removeAttr('selected');
                $('#kecamatanId').val(data.kecamatanId).trigger('change');
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log('Error in Operation');
            }
        });
    }
    function update_data(e) {
        e.preventDefault();
        var data = $('#data-update').serializeFormJSON();
        let id_deskel = data.id
        data.id = parseInt(data.id)
        $.ajax({
            url: url_api+'DesaKelurahan('+id_deskel+')',
            type: 'PATCH',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
            },
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function (data, textStatus, xhr) {
                if (xhr.status == '204') {
                    routing('deskel');
                    toastr.success("Update Desa/Kelurahan", 'Success!');
                }else{
                    toastr.error("Gagal Update Desa/Kelurahan", 'Error!');
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log('Error in Operation');
            }
        });
    }
    function delete_data(id){
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url_api+'DesaKelurahan('+id+')',
                    type: 'DELETE',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
                    },
                    dataType: 'json',
                    success: function (data, textStatus, xhr) {
                        if (xhr.status == '204') {
                            swal(
                                'Deleted!',
                                'Delete Desa/Kelurahan',
                                'success'
                            )
                            routing('deskel')
                        }else{
                            swal({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Gagal Delete Desa/Kelurahan'
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
