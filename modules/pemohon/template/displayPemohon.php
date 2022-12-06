<div class="page-breadcrumb">
  <div class="row">
    <div class="col-5 align-self-center">
      <h4 class="page-title">
        Pemohon
      </h4>

      <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="javascript:void(0)">Pemohon</a>
            </li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="col-7 align-self-center">
      <div class="d-flex no-block justify-content-end align-items-center">
        <button onclick="viewRouting()" type="button" class="btn waves-effect waves-light btn-rounded btn-primary">
          <i class="fas fa-redo"></i> Segarkan Halaman
        </button>
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
              <h4 class="page-title">
                Master Data Pemohon
              </h4>
            </div>
          </div>

          <div class="table-responsive" id="table-data-here">
            <table id="zero_config" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Email Pemohon</th>
                  <th>Nomor Telepon</th>
                  <th>Nama Perusahaan</th>
                  <th>Alamat</th>
                  <th>Tindakan</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
require_once("../../template/common_script.php");
require_once("view_pemohon.php");
?>
