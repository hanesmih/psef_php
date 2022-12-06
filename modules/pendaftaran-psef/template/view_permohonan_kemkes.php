<!-- Progress Bar -->
<div class="col-sm-12">
  <div class="box" style="border: none; box-shadow: none">
    <div class="box-body" id="stepbar">
    </div>
  </div>
</div>

<!-- Data Pemohon -->
<h4 class="card-title" style="font-weight: bold;">
  Data Pemohon
</h4>

<hr class="m-t-0">

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label class="control-label">Nomor Telepon Pemohon</label>
      <input value="{{data_pemohon.phone}}" type="text" class="form-control" disabled>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label class="control-label">Email</label>
      <input value="{{data_pemohon.email}}" type="text" class="form-control" disabled>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label class="control-label">Nama Perusahaan</label>
      <input value="{{data_pemohon.companyName}}" type="text" class="form-control" disabled>
    </div>
  </div>
</div>

<div class="form-group">
  <label>Alamat</label>
  <textarea class="form-control" rows="4" disabled>{{data_pemohon.address}}</textarea>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label class="control-label">NIB</label>
      <input value="{{data_pemohon.nib}}" type="text" class="form-control" name="nib" id="nib" disabled>
      <small class="form-text text-muted">
        <div id="cek_nib" style="color:white;"></div>
      </small>
    </div>
  </div>
</div>

<!-- NIB View -->
<div id="nib_view">
</div>

<input type="hidden" id="status_nib">

<!-- Data Permohonan -->
<h4 class="card-title" style="font-weight: bold;">
  Data Permohonan
</h4>

<hr class="m-t-0">
