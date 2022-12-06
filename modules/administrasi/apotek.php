<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Apotek</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Administrasi</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Apotek</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <button onclick="routing('apotek')" type="button" class="btn waves-effect waves-light btn-rounded btn-primary"><i class="fas fa-redo"></i> Refresh Page</button>
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
                            <h4 class="page-title">Master Data Apotek</h4>
                        </div>
                        <div class="col-7 align-self-center">
                            <div class="d-flex no-block justify-content-end align-items-center">
                                <button onclick="add_data()" type="button" class="btn waves-effect waves-light btn-info btn-add-data">Add Data</button>
                            </div>
                        </div>
                    </div><br>
                    <div class="table-responsive" id="table-apotek">
                        <!-- Table warehouse content goes here -->
                        <table id="zero_config" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Name</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Template for add -->
<script id="add-data-adjusment" type="text/x-handlebars-template">
    <h4 class="card-title">Add New Apotek</h4>
    <form class="m-t-30" id="inv-data-add" onsubmit="data_save(event)">
        <div class="form-group">
            <label>Nama Apotek</label>
            <input type="text" class="form-control" id="apotek" name="apotek" placeholder="Masukkan Nama Apotek." required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-danger" onclick="routing('apotek')">Cancel</button>
    </form>
</script>

<!-- Template for edit -->
<script id="edit-data" type="text/x-handlebars-template">
    <h4 class="card-title">Edit Data Apotek</h4>
    <form class="m-t-30" id="data-update" onsubmit="update_data(event)">
        
        <form class="m-t-30" id="inv-data-add" onsubmit="data_save(event)">
        <div class="form-group">
            <label>Apotek</label>
            <input value="{{Name}}" type="text" class="form-control" id="userid" name="userid" placeholder="Enter username." required>
        </div>
        <input type="hidden" name="id" value="{{Id}}">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-danger" onclick="routing('apotek')">Cancel</button>
    </form>
</script>


<script>
    $(document).ready(function() {  
        $('#zero_config').on('xhr.dt', function ( e, settings, json, xhr ) {
            json.data = json.rows;
            json.recordsTotal = json.recordsFiltered = json.total;
        }).DataTable({
            "processing": true,
            "serverSide": true,
            "scrollY": '100vh',
            "scrollX": true,
            "ajax": {
              "url": url_api_php,
              "type": "POST",
              "dataSrc": function ( json ) {
                var data=[];
                for ( var i=0, ien=json.data.length; i<ien ; i++ ) {
                  var datax = [];
                  var startbal_amount =  $.number(json.data[i].startbal_amount,0); 
                  let offset_data = json.foffset
                  let id_num = i+1+offset_data
                  datax.push(id_num);
                  datax.push(json.data[i].Name);

                  var actions = '<td><button onclick="detail_req_item(\''+json.data[i].Name+'\')" type="button" class="btn btn-xs waves-effect waves-light btn-info">Detail</button><p></p><button onclick="cek_cancel_req(\''+json.data[i].Name+'\')" type="button" class="btn btn-xs waves-effect waves-light btn-warning">Cancel</button><p></p></td>';
                  var actions = '<td><button onclick="edit_data(\''+json.data[i].Name+'\')" type="button" class="btn waves-effect waves-light btn-primary">Edit</button><button onclick="cek_delete_data(\''+json.data[i].Name+'\')" type="button" class="btn waves-effect waves-light btn-danger">Delete</button>';
                  datax.push(actions);

                  data.push(datax);
                }
                return JSON.parse(JSON.stringify(data));

              },

              "data": function ( d ) {
                var order_name = []

                order_name.push('Name');

                var data={};

                data.fpage = (parseInt(d.start)+parseInt(d.length))/parseInt(d.length);
                data.frows = d.length;
                data.fsearch = d.search['value'];
                data.forder = order_name[d.order[0]['column']];
                data.fsort = d.order[0]['dir'];
                data.fmodul = 'PsefApotek'
                return data;
              }
            }
        });
    });

    function cek_cp_data(data){
        if(data_auth_menu_user['User-list-Change-Password']){
            $('#responsive-modal-'+data+'').modal('show')
        }else{
            swal({
                type: 'error',
                title: 'Disabled',
                text: 'Please Contact Administrator !!!'
            })
        }
       
    }
   
    function add_data() {
        let source = $("#add-data-adjusment").html();
        let template = Handlebars.compile(source);
        

        $('#load-data').html(template());
       
    }
    function data_save(e) {
        e.preventDefault();
        var data = $('#inv-data-add').serializeFormJSON();
        $.ajax({
            url: url_api+'usradd.php?token='+token+'&uid='+username,
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function (data, textStatus, xhr) {
                if (data.Crud == true) {
                    routing_menu('User-list-List-Data');
                    toastr.success(data.CrudMsg, 'Success!');
                }else{
                    toastr.error(data.ErrMsg, 'Error!');
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log('Error in Operation');
            }
        });
    }

    function edit_data(id) {
        $.ajax({
            url: url_api+"PsefApotek?$filter=Name eq '"+id+"'",
            type: 'GET',
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

        $('#load-data').html(template(data.value[0]));
    }
    function update_data(e) {
        e.preventDefault();
        var data = $('#data-update').serializeFormJSON();

        $.ajax({
            url: url_api+'usrupdate.php?token='+token+'&uid='+username,
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function (data, textStatus, xhr) {
                if (data.Crud == true) {
                    routing_menu('User-list-List-Data');
                    toastr.success(data.CrudMsg, 'Success!');
                }else{
                    toastr.error(data.ErrMsg, 'Error!');
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log('Error in Operation');
            }
        });
    }
    function change_password(e, id){

      e.preventDefault();
      var data = $('#form-modal-'+id).serializeFormJSON();
      $.ajax({
          url: url_api+'usrchangepass.php?token='+token+'&uid='+username,
          type: 'POST',
          data: data,
          dataType: 'json',
          success: function (data, textStatus, xhr) {
            if (data.Crud == true) {
                toastr.success(data.CrudMsg, 'Success!');
                $('.close-modal1').click();

            }else{
                toastr.error(data.ErrMsg, 'Error!');
            }
          },
          error: function (xhr, textStatus, errorThrown) {
              console.log('Error in Operation');
          }
      });
    }
    function cek_delete_data(data){
        if(data_auth_menu_user['User-list-Delete']){
            delete_data(data);
        }
        else{
            swal({
                type: 'error',
                title: 'Disabled',
                text: 'Please Contact Administrator !!!'
            })
        }
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
                    url: url_api+'usrremove.php?token='+token+'&uid='+username,
                    type: 'POST',
                    data: {fuserid: id},
                    dataType: 'json',
                    success: function (data, textStatus, xhr) {
                        if(data.Crud === true){
                            swal(
                                'Deleted!',
                                data.CrudMsg,
                                'success'
                            )
                            $('#row_'+id).remove()
                        }else{
                            swal({
                                type: 'error',
                                title: 'Oops...',
                                text: data.ErrMsg
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
