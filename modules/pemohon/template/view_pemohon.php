<!-- Template for view -->
<script id="view-data" type="text/x-handlebars-template">
  <h4 class="card-title">
    Detail Data Pemohon
  </h4>

  <form class="m-t-30">
    <div class="form-group">
      <label>Nomor Telepon</label>
      <input value="{{phone}}" type="text" class="form-control" disabled>
    </div>

    <div class="form-group">
      <label>Email</label>
      <input value="{{email}}" type="text" class="form-control" disabled>
    </div>

    <div class="form-group">
      <label>Alamat</label>
      <input value="{{address}}" type="text" class="form-control" disabled>
    </div>

    <div class="form-group">
      <label>Nama Perusahaan</label>
      <input value="{{companyName}}" type="text" class="form-control" disabled>
    </div>

    <div class="form-group">
      <label>NIB</label>
      <input value="{{nib}}" type="text" class="form-control" name="nib" id="nib" disabled>
      <small class="form-text text-muted">
        <div id="cek_nib" style="color:white;"></div>
      </small>
    </div>

    <div id="nib_view"></div>

    <input type="hidden" id="status_nib">
    <button type="button" class="btn btn-danger" onclick="viewRouting()">Kembali</button>
  </form>
</script>
