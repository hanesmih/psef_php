// Reference: https://stackoverflow.com/questions/469357/html-text-input-allow-only-numeric-input
function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function (event) {
        textbox.addEventListener(event, function () {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            }
            else if (Object.prototype.hasOwnProperty.call(this, 'oldValue')) {
                this.value = this.oldValue;
                if (this.oldSelectionStart !== null &&
                    this.oldSelectionEnd !== null) {
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                }
            }
            else {
                this.value = "";
            }
        });
    });
}
function setNumberOnlyInputFilter(textbox) {
    setInputFilter(textbox, function (value) {
        return /^\d*$/.test(value); // Allow digits only, using a RegExp
    });
}
function setPhoneNumberInputFilter(textbox) {
    setInputFilter(textbox, function (value) {
        return /^[+\d\s-+]*$/.test(value);
    });
}
function setSaveButtonStateOnInputChanged(formElementId, saveButtonElementId) {
    $(formElementId)
        .each(function () {
        $(this).data("serialized", $(this).serialize());
    })
        .on("change input", function () {
        $(this)
            .find(saveButtonElementId)
            .prop("disabled", $(this).serialize() == $(this).data("serialized"));
    })
        .find(saveButtonElementId)
        .prop("disabled", true);
}
function setAuthHeader(xhr, token) {
    xhr.setRequestHeader("Authorization", `Bearer ${token}`);
}
function fileUploadError(isEdit, fileInputElement, closeElement, viewElement, errorMessage) {
    if (!isEdit) {
        fileInputElement.prop("required", true);
    }
    fileInputElement.val("");
    closeElement.html("No file chosen");
    closeElement.attr("href", "#");
    viewElement.val("");
    Swal.fire({
        title: "Maaf !",
        text: errorMessage,
        icon: "error"
    });
}
function uploadFile(isEdit, url, token, fileInputElement, closeElement, viewElement) {
    let fileInput = fileInputElement[0];
    let fileName = fileInput.files?.item(0)?.name ?? "";
    let file = fileInput.files?.item(0);
    let formData = new FormData();
    formData.append('file', file);
    if (!/(.*?)\.(pdf)$/.test(fileName) && fileName != "") {
        fileUploadError(isEdit, fileInputElement, closeElement, viewElement, "Pastikan berkas yang anda upload berupa PDF");
        return;
    }
    if (file.size <= 0 || file.size > 5300000) {
        fileUploadError(isEdit, fileInputElement, closeElement, viewElement, "Pastikan berkas yang anda upload maksimal 5 MB");
        return;
    }
    $.ajax({
        url: url,
        method: "POST",
        beforeSend: function (xhr) {
            setAuthHeader(xhr, token);
        },
        data: formData,
        processData: false,
        contentType: false,
        success: function (data, textStatus, xhr) {
            viewElement.val(data.value);
            if (!isEdit) {
                closeElement.html(fileName);
                closeElement.attr("href", data.value);
                fileInputElement.prop("required", true);
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            fileUploadError(isEdit, fileInputElement, closeElement, viewElement, `Terdapat masalah dalam upload berkas - status: ${xhr.status}`);
        }
    });
}
function setUploadHandler(inputElementId, isEdit, url, token) {
    $(`#${inputElementId}`).on("change", function () {
        uploadFile(isEdit, url, token, $(`#${inputElementId}`), $(`#close-${inputElementId}`), $(`#v-${inputElementId}`));
    });
}
function setToastrOptions() {
    let options = {
        closeButton: true,
        debug: false,
        newestOnTop: false,
        progressBar: false,
        positionClass: "toast-bottom-right",
        preventDuplicates: false,
        showDuration: 0,
        hideDuration: 1000,
        timeOut: 0,
        extendedTimeOut: 0,
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
    };
    return options;
}
function displayOssSsoToastr(statusCode, message) {
    let options = setToastrOptions();
    let title = "OSS SSO";
    if (statusCode == 200) {
        toastr.success(`${message}<br /> Silahkan klik Masuk untuk melanjutkan ke dalam dasboard`, title, options);
        return;
    }
    toastr.error(message, title, options);
}
function displayHomeNewsItem(resourceUrl, news, index) {
    $("#homePageNews").append(`<div class="col-lg-6">
      <div class="card">
        <img class="card-img-top img-responsive" src="${resourceUrl}${news.imageUrl}" alt="News Image"/>
        <div class="card-body">
          <div class="d-flex no-block align-items-center m-b-15">
            <span><i class="ti-calendar"></i> ${moment(news.publishedAt).format("YYYY-MM-DD")}</span>
          </div>
          <h3 class="font-normal">${news.title}</h3>
          <p class="m-b-0 m-t-10" id="page-news-${index}"></p>
          <a href="${news.linkUrl}" class="btn btn-success btn-rounded waves-effect waves-light m-t-20" target="_blank">
            Read more
          </a>
        </div>
      </div>
    </div>`);
    let quill = new Quill(`#page-news-${index}`, {});
    quill.setContents(JSON.parse(news.content));
    quill.disable();
    $('.ql-editor').css('padding', '0');
}
function loadData(url, token, loaderElementSelector) {
    return $.ajax({
        url: url,
        method: "GET",
        beforeSend: function (xhr) {
            if (typeof loaderElementSelector !== "undefined") {
                $(loaderElementSelector).fadeIn();
            }
            setAuthHeader(xhr, token);
        },
        complete: function () {
            if (typeof loaderElementSelector !== "undefined") {
                $(loaderElementSelector).fadeOut();
            }
        },
        dataType: "json"
    });
}
function submitFormDataWithToastr(url, method, token, inputData, toastrTitle, successMessage, errorMessage, loaderElementSelector) {
    let request = submitFormData(url, method, token, inputData, loaderElementSelector);
    request.done(function (data, textStatus, xhr) {
        displayRequestSuccessToastr(xhr, toastrTitle, successMessage, errorMessage);
    });
    request.fail(function (xhr, textStatus, errorThrown) {
        displayRequestErrorToastr(xhr, toastrTitle, errorMessage);
    });
    return request;
}
function submitFormData(url, method, token, inputData, loaderElementSelector) {
    return $.ajax({
        url: url,
        method: method,
        beforeSend: function (xhr) {
            if (typeof loaderElementSelector !== "undefined") {
                $(loaderElementSelector).fadeIn();
            }
            setAuthHeader(xhr, token);
        },
        complete: function () {
            if (typeof loaderElementSelector !== "undefined") {
                $(loaderElementSelector).fadeOut();
            }
        },
        data: inputData,
        contentType: "application/json"
    });
}
function selesaikanPermohonan(permohonanId, url, token, routingFunction, loaderElementSelector) {
    let request = submitFormDataWithToastr(url, "POST", token, JSON.stringify({ permohonanId: parseInt(permohonanId), reason: "" }), "Proses Pembuatan Tanda Daftar", "Permohonan berhasil diproses", "Permohonan gagal diproses", loaderElementSelector);
    request.done(function (data, textStatus, xhr) {
        if (typeof routingFunction !== "undefined") {
            routeOnRequestSuccess(xhr, routingFunction);
        }
    });
}
function loadAndDisplayNib(nib, apiServerUrl, token, inputElementId, statusElementId, viewElementId, loaderElementSelector) {
    if (nib == undefined || nib == "") {
        return;
    }
    let options = setToastrOptions();
    let request = loadData(`${apiServerUrl}/api/v0.1/OssInfo/OssFullInfo?id=${nib}`, token, loaderElementSelector);
    request.done(function (data) {
        if (data.keterangan == 'Data NIB tidak ditemukan' ||
            data.keterangan == 'NIB harus 13 karakter.' ||
            data.keterangan == 'Api Key tidak valid') {
            $(viewElementId).html("");
            $(statusElementId).css('color', 'red');
            $(statusElementId).html('Data NIB Tidak di Temukan');
            $(inputElementId).removeClass('is-valid').addClass('is-invalid');
            return;
        }
        $(statusElementId).css('color', 'green');
        $(statusElementId).html(`
      Data NIB Dapat di Gunakan<br>
      <a href="/view-nib/${nib}" class="btn btn-primary" target="_blank">
        Periksa Detail NIB
      </a>`);
        $(inputElementId).removeClass('is-invalid').addClass('is-valid');
        $(viewElementId).html(`
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th scope="col">Nama Perusahaan</th>
            <th scope="col">NIB</th>
            <th scope="col">NPWP Perusahaan</th>
            <th scope="col">Nomor Telepon Perusahaan</th>
            <th scope="col">Alamat Perusahaan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>${data.namaPerseroan}</th>
            <th>${data.nib}</th>
            <th>${data.npwpPerseroan}</th>
            <th>${data.nomorTelponPerseroan}</th>
            <th>${data.alamatPerseroan}</th>
          </tr>
        </tbody>
      </table>`);
    });
    request.fail(function (xhr, textStatus, errorThrown) {
        toastr.error(`Gagal mengambil data NIB - status: ${xhr.status}`, "Data NIB", options);
    });
}
function dataTablePemohon(elementSelector, apiServerUrl, token) {
    jQuery(function () {
        $(elementSelector).DataTable({
            processing: true,
            serverSide: true,
            ajax: function (data, callback, settings) {
                dataTableODataProxy(`${apiServerUrl}/api/v0.1/Pemohon`, token, data, callback, settings);
            },
            columns: [
                { data: "id" },
                { data: "phone" },
                { data: "address" },
                { data: "nib" },
                { data: "companyName" },
                { data: "penanggungJawab" }
                // "userId": "string",
                // "name": "string",
                // "email": "string"
            ]
        });
    });
}
function dataTableODataProxy(url, token, data, callback, settings) {
    let select = dataTableODataSelect(data);
    let order = dataTableODataSort(data);
    let query = `${url}?$top=${data.length}&$skip=${data.start}&$select=${select}&$orderby=${order}`;
    let request = loadData(query, token);
    request.done(function (data) {
        console.debug(data);
        callback(data);
    });
    return request;
}
function dataTableODataSelect(data) {
    let select = data.columns.map(item => item.data);
    return select.join(",");
}
function dataTableODataSort(data) {
    let order = data.order.map(item => (`${data.columns[item.column].data} ${item.dir}`));
    return order.join(",");
}
function savePermohonanSub(apiUrl, token, dataPermohonan, data) {
    if (data == undefined) {
        return;
    }
    data.forEach(element => {
        element.permohonanId = dataPermohonan.id;
        delete element.iddetail;
    });
    return submitFormData(apiUrl, "POST", token, JSON.stringify(data));
}
function permohonanAction(permohonan, isViewOnly, showAlasanDikembalikan) {
    if (isViewOnly) {
        return `
      <td>
        <button onclick="permohonanCurrentUser(${permohonan.id}, false, ${showAlasanDikembalikan})" type="button" class="btn btn-xs btn-block waves-effect waves-light btn-info">
          Lihat Detail Data
        </button>
      </td>`;
    }
    return `
    <td>
      <button onclick="permohonanCurrentUser(${permohonan.id}, true, ${showAlasanDikembalikan})" type="button" class="btn btn-xs btn-block waves-effect waves-light btn-info">
        Lihat Detail Data
      </button>
      <button onclick="edit_data_permohonan(${permohonan.id})" type="button" class="btn btn-xs btn-block waves-effect waves-light btn-primary">
        Ubah Permohonan
      </button>
      <button onclick="edit_data_apotek(${permohonan.id}, ${permohonan.permohonanNumber})" type="button" class="btn btn-xs btn-block waves-effect waves-light btn-secondary">
        Ubah Apotek
      </button>
      <button onclick="edit_data_rs(${permohonan.id}, ${permohonan.permohonanNumber})" type="button" class="btn btn-xs btn-block waves-effect waves-light btn-danger">
        Ubah Rumah Sakit
      </button>
      <button onclick="ajukan_permohonan(${permohonan.id})" type="button" class="btn btn-xs btn-block waves-effect waves-light btn-success">
        Ajukan Permohonan
      </button>
    </td>`;
}
function perizinanAction(apiUrl, resourceUrl, token, perizinan, loaderElementSelector, role) {
    let element = `
        <button onclick="view_data('${perizinan.permohonanId}', '${perizinan.id}')" class="btn btn-xs btn-block btn-info">
            Lihat Detail Data
        </button>`;

    if(role.toLowerCase() == "psef.bpom"){
        return element;
    };

    if(perizinan.perubahanIzinId > 0 || role == "") {
        element += `<button onclick="ubah_perubahanizin_data('${perizinan.permohonanId}', '${perizinan.id}')" class="btn btn-xs btn-block btn-warning">
            Perubahan Izin
        </button>`;
    }
    
    if(perizinan.statusId == 15){
        element += `<button onclick="ajukan_perubahan_izin('${perizinan.permohonanId}')" class="btn btn-xs btn-block btn-danger">
        Ajukan Perubahan Izin
        </button>`;
    }

    element += `
        <a href="${resourceUrl}${perizinan.tandaDaftarUrl}" target="_blank" class="btn btn-xs btn-block btn-success">
            Unduh Tanda Daftar
        </a>
        <button onclick="downloadOSSIzin(${perizinan.id}, '${apiUrl}', '${resourceUrl}', '${token}', '${loaderElementSelector}')" class="btn btn-xs btn-block btn-primary">
            Unduh Izin OSS
        </button>`;

    return element;
}

function pemohonApiAction(data) {
    return `
    <button onclick="view_data('${data.url}', '${data.token}')" class="btn btn-xs btn-block btn-info">
      Lihat Detail Data
    </button>`;
}

function permohonanDataTableSource(json, isViewOnly, showAlasanDikembalikan = false) {
    let responseData = json.data;
    let data = [];
    for (let i = 0; i < responseData.length; i++) {
        let action = permohonanAction(responseData[i], isViewOnly, showAlasanDikembalikan);
        data.push(setDataTablePermohonanRow(responseData[i], action));
    }
    return data;
}
function perizinanDataTableSource(json, apiUrl, resourceUrl, token, loaderElementSelector, role) {
    let responseData = json.data;
    let data = [];
    for (let i = 0; i < responseData.length; i++) {
        let action = perizinanAction(apiUrl, resourceUrl, token, responseData[i], loaderElementSelector, role);
        data.push(setDataTablePerizinanRow(responseData[i], action));
    }
    return data;
}
function pemohonApiDataTableSource(json) {
    let responseData = json.data;
    let data = [];
    for (let i = 0; i < responseData.length; i++) {
        let action = pemohonApiAction(responseData[i]);
        data.push(setDataTablePemohonApiRow(responseData[i], action));
    }
    return data;
}
function loadDataTablePerizinan(phpApiUrl, apiUrl, resourceUrl, token, dataTableElementSelector, loaderElementSelector, role) {
    $(dataTableElementSelector)
        .on('xhr.dt', function (e, settings, json, xhr) {
        json.data = json.rows;
        json.recordsTotal = json.recordsFiltered = json.total;
    })
        .DataTable({
        processing: true,
        serverSide: true,
        scrollY: "100vh",
        scrollX: true,
        ajax: {
            url: phpApiUrl,
            method: "POST",
            dataSrc: function (json) {
                return perizinanDataTableSource(json, apiUrl, resourceUrl, token, loaderElementSelector, role);
            },
            data: function (requestData) {
                return configureDataTablePerizinanRequest(requestData);
            }
        }
    });
}

function loadDataTablePemohonApi(phpApiUrl, moduleName, token, dataTableElementSelector, loaderElementSelector) {
    $(dataTableElementSelector)
        .on('xhr.dt', function (e, settings, json, xhr) {
        json.data = json.rows;
        json.recordsTotal = json.recordsFiltered = json.total;
    })
        .DataTable({
        processing: true,
        serverSide: true,
        scrollY: "100vh",
        scrollX: true,
        ajax: {
            url: phpApiUrl,
            method: "POST",
            dataSrc: function (json) {
                return pemohonApiDataTableSource(json);
            },
            data: function (requestData) {
                return configurePemohonApiRequest(requestData);
            }
        }
    });
}

function setDataTablePermohonanRow(data, action) {
    let row = [
        data.permohonanNumber,
        data.domain,
        data.straNumber,
        moment(data.straExpiry).format("YYYY-MM-DD"),
        data.pemohonStatusName,
        action
    ];
    return row;
}
function setDataTablePerizinanRow(data, action) {
    let row = [
        data.perizinanNumber,
        data.domain,
        moment(data.issuedAt).format("YYYY-MM-DD"),
        moment(data.expiredAt).format("YYYY-MM-DD"),
        action
    ];
    return row;
}
function setDataTablePemohonApiRow(data, action) {
    let row = [
        data.companyName,
        data.url,
        action
    ];
    return row;
}
function configureDataTablePerizinanRequest(request) {
    let sortFields = ['perizinanNumber', 'domain', 'issuedAt', 'expiredAt'];
    return configureDataTableAjaxRequest('Perizinan', 'perizinanNumber', 1, sortFields, request);
}
function configurePemohonApiRequest(request) {
    let sortFields = ['companyName'];
    return configureDataTableAjaxRequest('PemohonApi', 'companyName', 1, sortFields, request);
}
function configureDataTableAjaxRequest(moduleName, searchedFields, numberOfSearchFields, sortFields, requestData) {
    let colNumber = requestData.order[0].column;
    let sortDirection = requestData.order[0].dir;
    let data = {
        fpage: (requestData.start + requestData.length) / requestData.length,
        frows: requestData.length,
        fsearch: requestData.search.value,
        forder: sortFields[colNumber],
        fsort: sortDirection,
        fmodul: moduleName,
        flsearch: searchedFields,
        ftots: numberOfSearchFields
    };
    return data;
}
function downloadOSSIzin(id, apiUrl, resourceUrl, token, loaderElementSelector) {
    let request = loadData(`${apiUrl}/api/v0.1/Perizinan/DownloadFileIzinOss?perizinanId=${id}`, token, loaderElementSelector);
    request.done(function (data, textStatus, xhr) {
        displayRequestSuccessToastr(xhr, "Download Izin OSS", "Download berhasil", "Download gagal");
        window.open(`${resourceUrl}${data.value}`, "_blank");
    });
    request.fail(function (xhr, textStatus, errorThrown) {
        displayRequestErrorToastr(xhr, "Download Izin OSS", "Download gagal");
    });
    return request;
}
function displayRequestSuccessToastr(xhr, toastrTitle, successMessage, errorMessage) {
    if (xhr.status == 200 || xhr.status == 201 || xhr.status == 204) {
        displaySuccessToastr(toastrTitle, successMessage);
    }
    else {
        displayRequestErrorToastr(xhr, toastrTitle, errorMessage);
    }
}
function displayRequestErrorToastr(xhr, title, message) {
    displayErrorToastr(title, `${message} - status: ${xhr.status}`);
}
function displaySuccessToastr(title, message) {
    let options = setToastrOptions();
    toastr.success(message, title, options);
}
function displayErrorToastr(title, message) {
    let options = setToastrOptions();
    toastr.error(message, title, options);
}
function routeOnRequestSuccess(xhr, routingFunction) {
    if (xhr.status == 200 || xhr.status == 201 || xhr.status == 204) {
        routingFunction();
    }
}
function getFormData(formElementSelector) {
    let formElement = document.querySelector(formElementSelector);
    return Object.fromEntries(new FormData(formElement).entries());
}
