<?php 
if($role != "" || ("{{data_permohonan.statusId}}" != 14 || "{{data_permohonan.statusId}}" != 15)) {
?>
    <div class="form-group">
        <label>Salinan STRA</label>
        <div class="border p-10" style="background-color: #e9ecef;padding: .375rem .75rem;">
            <a href="<?php echo $fileUrl; ?>{{data_permohonan.straUrl}}" target="_blank" id="close-straUrl">{{data_permohonan.name_straUrl}}</a>
        </div>
        <input type="file" class="form-control" id="straUrl">
        <small class="form-text text-muted">*Berkas yang anda upload wajib PDF & size file maksimal 5 MB</small>
        <input type="hidden" name="straUrl" id="v-straUrl">
    </div>

    <input type="hidden" name="pemohonId" id="pemohonId" value="{{data_permohonan.pemohonId}}">
    <input type="hidden" name="perizinanId" id="perizinanId" value="{{data_permohonan.perizinanId}}">
    <input type="hidden" name="permohonanId" id="permohonanId" value="{{data_permohonan.permohonanId}}">
    <input type="hidden" name="providerName" id="providerName" value="{{data_permohonan.providerName}}">
    <input type="hidden" name="imbUrl"> 
    <input type="hidden" name="spplUrl"> 
    <input type="hidden" name="izinLokasiUrl"> 
    <input type="hidden" name="id" value="{{data_permohonan.id}}">

    <?php include('permohonan_check_agree.php'); ?>

    <button type="submit" class="btn btn-primary">Kirim</button>

    <button type="button" class="btn btn-danger" onclick="viewRouting()">Batal</button>

<?php
}
?>