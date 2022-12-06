<!-- Template for view -->
<script id="view-billing" type="text/x-handlebars-template">
  <h4 class="card-title">
    Info Billing PNBP
  </h4>

  <form class="m-t-30">
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">Kode Billing PNBP</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">: </label>
                <label class="control-label">{{kodeBillingSimponi}}</label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">Total Nominal Pembayaran</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">: </label>
                <label class="control-label">Rp. 1.000.000,-</label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">Batas Pembayaran</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">: </label>
                <label class="control-label">{{tglJamExpiredBilling}}</label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">Bank Transfer</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">: </label>
                <label class="control-label">{{bankPersepsi}}</label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">Channel Pembayaran</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">: </label>
                <label class="control-label">{{channelPembayaranID}}</label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">Tanggal Pembayaran</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">: </label>
                <label class="control-label">{{tglJamPembayaran}}</label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">Status Bayar</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">: </label>
                <label class="control-label">{{statusBayar}}</label>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-rounded btn-outline-danger mr-3" onclick="viewRouting()">
      <i class="fa fa-arrow-left mr-2"></i>Back
    </button>

    
  </form>
</script>
