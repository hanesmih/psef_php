<h4 class="card-title" style="font-weight: bold;">
    Jenis Perizinan
</h4>

<hr class="m-t-0">

<div class="col-12 col-md-12">
    <ul>
        <li>Baru</li>
        <li>
            <label>Perubahan</label>
            <form class="m-t-30" id="perubahan-izin">
              <div class="row">
                  <div class="col-md-2">
                      <input type="date" class="form-control" name="tglPerubahanIzin" id="tglPerubahanIzin" required>
                  </div>
                  <div class="col-md-3">
                      <button type="submit" class="btn btn-primary">Ubah</button>
                  </div>
              </div>
            </form>
        </li>
    </ul>
</div>

<script>
    $(document).on('submit', 'form', function(e){
        e.preventDefault();
        
        let id = {{data_izin.id}};
        let tglPerubahanIzin = $("#tglPerubahanIzin").val();
        let data = {id:id, "tanggalPerubahanIzin" : tglPerubahanIzin};
        perubahanTanggalIzin(data, url_api_x + 'Perizinan/PerubahanTanggalIzin', accesstoken);
    });

</script>