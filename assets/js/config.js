const url = "/";
const url_api = "https://localhost:5003/psefapiodata/api/v1/";
const url_api_x = "https://localhost:5003/psefapiodata/api/v0.1/";
const url_api_ia = "https://usermanagement-simyanfar.kemkes.go.id/api/";
const url_api_php = "/call-api";
const url_api_integrasi_php = "/call-api-integrasi";

var timer;
var monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"];

function routing(key) {
  var location = {
    "dashboard": "/modules/dashboard/page/dashboard.php",
    "welcome": "/modules/login/welcome.php",
    "welcome_admin": "/modules/login/welcome_admin.php",
    "detail_nib": "/modules/nib/detail_nib.php",
    "provinsi": "/modules/administrasi/provinsi.php",
    "spanduk": "/modules/administrasi/spanduk.php",
    "berita": "/modules/administrasi/berita.php",
    "unduhan": "/modules/administrasi/unduhan.php",
    "kabkota": "/modules/administrasi/kabkota.php",
    "kecamatan": "/modules/administrasi/kecamatan.php",
    "deskel": "/modules/administrasi/deskel.php",
    "pemohon_user": "/modules/pemohon/user/pemohon_user.php",
    "pemohon_verif": "/modules/pemohon/verifikator/pemohon_verif.php",
    "pemohon_kasi": "/modules/pemohon/kasi/pemohon_kasi.php",
    "pemohon_dirjen": "/modules/pemohon/dirjen/pemohon_dirjen.php",
    "pemohon_diryanfar": "/modules/pemohon/diryanfar/pemohon_diryanfar.php",
    "pemohon_kasubdit": "/modules/pemohon/kasubdit/pemohon_kasubdit.php",
    "pemohon_admin": "/modules/pemohon/admin/pemohon_admin.php",
    "pemohon_validator": "/modules/pemohon/validator/pemohon_validator.php",
    "perizinan_user": "/modules/perizinan/user/perizinan_user.php",
    "perizinan_verif": "/modules/perizinan/verifikator/perizinan_verif.php",
    "perizinan_kasi": "/modules/perizinan/kasi/perizinan_kasi.php",
    "perizinan_dirjen": "/modules/perizinan/dirjen/perizinan_dirjen.php",
    "perizinan_diryanfar": "/modules/perizinan/diryanfar/perizinan_diryanfar.php",
    "perizinan_kasubdit": "/modules/perizinan/kasubdit/perizinan_kasubdit.php",
    "perizinan_admin": "/modules/perizinan/admin/perizinan_admin.php",
    "perizinan_validator": "/modules/perizinan/validator/perizinan_validator.php",
    "rumusan_user": "/modules/pendaftaran-psef/user/rumusan_user.php",
    "proses_user": "/modules/pendaftaran-psef/user/proses_user.php",
    "dikembalikan_user": "/modules/pendaftaran-psef/user/dikembalikan_user.php",
    "selesai_user": "/modules/pendaftaran-psef/user/selesai_user.php",
    "ditolak_user": "/modules/pendaftaran-psef/user/ditolak_user.php",
    "baru_admin": "/modules/pendaftaran-psef/admin/baru_admin.php",
    "proses_admin": "/modules/pendaftaran-psef/admin/proses_admin.php",
    "disetujui_diryanfar": "/modules/pendaftaran-psef/admin/disetujui_diryanfar.php",
    "disetujui_dirjen": "/modules/pendaftaran-psef/admin/disetujui_dirjen.php",
    "selesai_admin": "/modules/pendaftaran-psef/admin/selesai_admin.php",
    "ditolak_admin": "/modules/pendaftaran-psef/admin/ditolak_admin.php",
    "semua_admin": "/modules/pendaftaran-psef/admin/semua_admin.php",
    "pending_verif": "/modules/pendaftaran-psef/verifikator/pending_verif.php",
    "semua_verif": "/modules/pendaftaran-psef/verifikator/semua_verif.php",
    "pending_validator": "/modules/pendaftaran-psef/validator/pending_validator.php",
    "done_validator": "/modules/pendaftaran-psef/validator/done_validator.php",
    "semua_validator": "/modules/pendaftaran-psef/validator/semua_validator.php",
    "rumusan_kasi": "/modules/pendaftaran-psef/kasi/rumusan_kasi.php",
    "pending_kasi": "/modules/pendaftaran-psef/kasi/pending_kasi.php",
    "semua_kasi": "/modules/pendaftaran-psef/kasi/semua_kasi.php",
    "pending_kasubdit": "/modules/pendaftaran-psef/kasubdit/pending_kasubdit.php",
    "semua_kasubdit": "/modules/pendaftaran-psef/kasubdit/semua_kasubdit.php",
    "pending_diryanfar": "/modules/pendaftaran-psef/diryanfar/pending_diryanfar.php",
    "semua_diryanfar": "/modules/pendaftaran-psef/diryanfar/semua_diryanfar.php",
    "pending_dirjen": "/modules/pendaftaran-psef/dirjen/pending_dirjen.php",
    "semua_dirjen": "/modules/pendaftaran-psef/dirjen/semua_dirjen.php",
    "transaksi": "/modules/transaksi/transaksi.php",
    "laporan": "/modules/laporan/laporan_admin.php",
    "laporan_user": "/modules/laporan/displayLaporan.php",
    "pendaftaran_api": "/modules/integrasi-api/user/pendaftaran_api.php",
    "integrasi_api_admin": "/modules/integrasi-api/admin/integrasi_api_admin.php",
  };

  $('.preloader').show();
  $("#content").load(location[key], function (responseTxt, statusTxt, xhr) {
    $('.preloader').hide();
  });
}

function myTimer() {
  var zero_config_lengths = $("select[name='zero_config_length']");
  var i = zero_config_lengths.length;

  if (i >= 1) {
    zero_config_lengths.on('change', function () {
      setCookie('page_size', this.value, 360);
      myStopFunction();
    });
  }
}

function myStopFunction() {
  clearInterval(timer);
}

(function ($) {
  $.fn.serializeFormJSON = function () {

    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
      if (o[this.name]) {
        if (!o[this.name].push) {
          o[this.name] = [o[this.name]];
        }
        o[this.name].push(this.value || '');
      } else {
        o[this.name] = this.value || '';
      }
    });
    return o;
  };
})(jQuery);

function toTitleCase(str) {
  return str.replace(/\w\S*/g, function (txt) {
    return trans = txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
  });
}

function slugify(text) {
  return text.toString().toLowerCase()
    .replace(/\s+/g, '-')           // Replace spaces with -
    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
    .replace(/^-+/, '')             // Trim - from start of text
    .replace(/-+$/, '');            // Trim - from end of text
}


$(document).on('keydown', function (e) {
  var key = e.charCode || e.keyCode;
  if (key == 222 || key == 192) {
    e.preventDefault();
  }
});

/*jQuery.ajaxSetup({
  beforeSend: function() {
     $('.preloader').show();
  },
  complete: function(){
     $('.preloader').hide();
  },
  success: function() {}
});*/
