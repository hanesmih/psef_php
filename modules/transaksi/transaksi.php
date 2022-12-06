<?php
include('../template/breadcrumb.php');

$pageTitle = 'Transaksi PSEF';
pageBreadcrumb('Home', $pageTitle);
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body" id="load-data">
          <div class="row">
            <div class="col-5 align-self-center">
              <h4 class="page-title">
                Data <?php echo $pageTitle; ?>
              </h4>
            </div>
          </div>

          <div class="table-responsive" id="table-data-here">
            <table id="zero_config" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>Tanggal Transaksi</th>
                  <th>Kode Obat Internal</th>
                  <th>Kode Obat</th>
                  <th>Nama Obat</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
