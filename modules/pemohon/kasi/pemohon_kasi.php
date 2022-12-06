<?php
require_once("../template/displayPemohon.php");
?>

<script>
    var accesstoken = <?php echo json_encode($_COOKIE['accesstoken']); ?>; 
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
                  datax.push(json.foffset+i+1);
                  datax.push(json.data[i].email);
                  datax.push(json.data[i].phone);
                  datax.push(json.data[i].companyName);
                  datax.push(json.data[i].address);

                  var actions = '<td><button onclick="view_data(\''+json.data[i].id+'\')" type="button" class="btn btn-xs btn-block waves-effect waves-light btn-info">Lihat Detail Data</button></td>';
                  datax.push(actions);

                  data.push(datax);
                }
                return JSON.parse(JSON.stringify(data));

              },

              "data": function ( d ) {
                var order_name = []

                order_name.push('name');
                order_name.push('name');
                order_name.push('email');
                order_name.push('phone');
                order_name.push('address');
                order_name.push('id');

                var data={};

                data.fpage = (parseInt(d.start)+parseInt(d.length))/parseInt(d.length);
                data.frows = d.length;
                data.fsearch = d.search['value'];
                data.forder = order_name[d.order[0]['column']];
                data.fsort = d.order[0]['dir'];
                data.fmodul = 'Pemohon';
                data.flsearch = 'name,email,phone,address';
                data.ftots = 4;
                return data;
              }
            }
        });
    });

    function viewRouting() {
      routing('pemohon_kasi');
    }

    function view_data(id){
        $.ajax({
            url: url_api_x+"Pemohon("+id+")",
            type: 'GET',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+accesstoken+'');
            },
            dataType: 'json',
            success: function (data, textStatus, xhr) {
                view_data_detail(data)
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log('Error in Operation');
            }
        });

       
    }
    function view_data_detail(data) {
        let source = $("#view-data").html();
        let template = Handlebars.compile(source);
        let nib = data.nib

        $('#load-data').html(template(data));

        loadAndDisplayOssData(nib, url_api_x, accesstoken);
    }
</script>
