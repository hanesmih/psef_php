<?php
function buttonAjukan()
{
?>
  <button type="button" class="btn btn-rounded btn-success" onclick="ajukan_permohonan('{{data_permohonan.id}}')">
    <i class="fa fa-paper-plane mr-2"></i>Ajukan Permohonan
  </button>
<?php
}

function buttonTeruskanKembalikan()
{
?>
  <button type="button" class="btn btn-rounded btn-success" onclick="process_data('{{data_permohonan.id}}')">
    <i class="fa fa-share mr-2"></i>Teruskan
  </button>

  <button type="button" class="btn btn-rounded btn-secondary" onclick="reject_data('{{data_permohonan.id}}')">
    <i class="fa fa-reply mr-2"></i>Kembalikan
  </button>
<?php
}

function buttonProsesData()
{
?>
  <button type="button" class="btn btn-rounded btn-success" onclick="process_data('{{data_permohonan.id}}')">
    <i class="fa fa-exchange mr-2"></i>Proses Data
  </button>
<?php
}
?>
