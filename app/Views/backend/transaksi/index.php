<?= $this->extend('backend/layouts/main'); ?>

<?= $this->section('css'); ?>
<style>
    .select2-container {
        z-index: 9999;
    }

    #reader video {
        width: 400px !important;
        transform: scaleX(-1);
        -webkit-transform: scaleX(-1);
    }
</style>
<link href="<?= base_url('assets/vendor/select2/css/select2.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/datatables/css/jquery.dataTables.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css'); ?>" rel="stylesheet">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target=".modal-insert">Tambah Transaksi</button>
        <button id="btnScanQR" class="btn btn-primary mb-4">
            <i class="bi bi-qr-code-scan"></i> Scan QR Code
        </button>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Transaksi</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-transaksi" class="display nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Kode Transaksi</th>
                                <th>Nasabah</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Jatuh Tempo</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Kode</th>
                                <th>Kode Transaksi</th>
                                <th>Nasabah</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Jatuh Tempo</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="scanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Scan QR Code Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div id="reader" style="width: 100%; max-width: 400px; margin:auto;"></div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('modal'); ?>
<?= $this->include('backend/transaksi/_insert'); ?>
<?= $this->include('backend/transaksi/_modalPerpanjang'); ?>
<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script src="<?= base_url('assets/vendor/select2/js/select2.full.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/datatables/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js'); ?>"></script>
<script src="<?= base_url('assets/js/jquery.mask.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/html5-qrcode.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        let html5QrCode;
        $('.create-nasabah-container :input').prop('disabled', true);
        $('.select-nasabah-container :input').prop('disabled', false);
        $("#single-select").select2();

        const optionPhoneMask = {
            placeholder: '628123456789'
        };

        $('.telp').mask('6280000000000', optionPhoneMask)

        $('.money').mask("#.##0", {
            reverse: true
        });

        $('.plat').mask('SS 0000 SSS', {
            'translation': {
                S: {
                    pattern: /[A-Za-z]/
                },
                0: {
                    pattern: /[0-9]/
                }
            },
            placeholder: "BA 1234 XX"
        });

        $('.tahun').mask('0000', {
            placeholder: "2020"
        });

        var table = $('#table-transaksi').DataTable({
            processing: true,
            serverSide: true,
            language: {
                paginate: {
                    next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                    previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                }
            },
            ajax: '<?= route_to('TransaksiController::datatable'); ?>',
            columns: [{
                    data: "kode",
                },
                {
                    data: "kode_trans"
                },
                {
                    data: "nasabah"
                },
                {
                    data: "nominal"
                },
                {
                    data: "status",
                },
                {
                    data: "jatuh_tempo"
                },
                {
                    data: 'id',
                    searchable: false,
                    render: function(data, type, row) {

                        const uriShow = '<?= route_to('TransaksiController::show', ':id'); ?>'.replace(':id', data);
                        const uriPrint = '<?= route_to('TransaksiController::createReport', ':id'); ?>'.replace(':id', data);

                        const canUpdate = row.status && row.status.includes('Jatuh Tempo');
                        const isGadai = row.status.includes('Gadai');
                        return `
        <div class="btn-group" role="group">
            <button 
                type="button" 
                class="btn btn-primary btn-xs dropdown-toggle"
                data-bs-toggle="dropdown"
                data-bs-boundary="viewport"
                data-bs-display="static"
                aria-expanded="false"
            >Aksi</button>

            <div class="dropdown-menu dropdown-menu-end">
                <a href="${uriShow}" class="dropdown-item">
                    <i class="fas fa-eye me-2"></i> Lihat Detail
                </a>

                ${
                    canUpdate 
                    ? `<button 
                            type="button" 
                            class="dropdown-item"
                            onclick="event.stopPropagation(); updateStatus('${data}')"
                       >
                            <i class="fas fa-pencil-alt me-2"></i> Update Status Lelang
                       </button>`
                    : ''
                }

                <button type="submit" class="dropdown-item text-start" onclick="event.stopPropagation(); sendNotification('${data}')">
                    <i class="fas fa-paper-plane me-2"></i> Kirim Notifikasi
                </button>
                ${isGadai ? `
                <button type="button" class="dropdown-item text-start" onclick="event.stopPropagation(); extendTempo('${data}')">
                    <i class="far fa-clock me-2"></i> Perpanjang
                </button>
                ` : ''}
                <div class="dropdown-divider"></div>
                <form action="${uriPrint}" method="POST" target="_blank">
                    <button type="submit" class="dropdown-item text-start">
                        <i class="fas fa-print me-2"></i> Cetak
                    </button>
                </form>

            </div>
        </div>
        `;
                    }
                }
            ],
            createdRow: function(row, data, dataIndex) {
                if (isInReminderRange(data.jatuh_tempo, 0, 2) && !data.status.includes('Lunas')) {
                    $(row).addClass('table-danger');
                }
            }

        });
        $('#site_state').on('change', function() {
            const isChecked = $(this).is(':checked');
            if (!isChecked) {
                $('.create-nasabah-container').hide();
                $('.select-nasabah-container').show();
                $('.create-nasabah-container :input').prop('disabled', true);
                $('.select-nasabah-container :input').prop('disabled', false);
                return;
            }

            $('.create-nasabah-container').show();
            $('.select-nasabah-container').hide();
            $('.create-nasabah-container').removeClass('d-none');
            $('.create-nasabah-container :input').prop('disabled', false);
            $('.select-nasabah-container :input').prop('disabled', true);
        });

        $('#tipe_barang').on('change', function() {
            const value = $(this).val();

            if (value == 'Lainnya') {
                $('.detail-section').hide();
                return;
            }

            $('.detail-section').show();
            if (value == 'Kendaraan') {
                $('.kendaraan-section').show();
                return;
            }

            $('.kendaraan-section').hide();
        });

        $('#btnScanQR').on('click', function() {
            $('#scanModal').modal('show');
            if (!html5QrCode) {
                html5QrCode = new Html5Qrcode("reader");
            }

            html5QrCode.start({
                    facingMode: "environment"
                }, {
                    fps: 10,
                    qrbox: 250
                },
                function onScanSuccess(decodedText) {
                    html5QrCode.stop().then(() => {
                        $('#scanModal').modal('hide');
                        table.search(decodedText);
                        table.draw();
                    });
                    html5QrCode = null;
                },
            ).catch(err => {
                Swal.fire({
                    title: "Error",
                    text: "Gagal mengakses kamera. silahkan muat ulang halaman",
                    type: "error",
                    confirmButtonText: "Ok",
                    confirmButtonColor: "#eb8153",
                }).then((result) => {
                    if (result.value) {
                        $('#scanModal').modal('hide');
                    }
                });
            });
        })

        $('#scanModal').on('hidden.bs.modal', function(e) {
            if (html5QrCode) {
                html5QrCode.stop().then(() => {
                    html5QrCode = null;
                });
            }
        });

        $('select[name="tujuan"]').on('change', function() {
            const value = $(this).val();

            if (value == 'lain-lain') {
                $('#detail_tujuan').show();
                $('#detail_tujuan').attr('disabled', false);
                return
            }
            $('#detail_tujuan').hide();
            $('#detail_tujuan').attr('disabled', true);
            return
        })

    });

    function isInReminderRange(reservasiTanggalStr, dariHari, sampaiHari) {
        const today = new Date();
        const reservasiDate = new Date(reservasiTanggalStr);

        if (isNaN(reservasiDate)) {
            return false;
        }

        today.setHours(0, 0, 0, 0);
        reservasiDate.setHours(0, 0, 0, 0);

        const dayDiff = (reservasiDate - today) / (1000 * 60 * 60 * 24);
        return dayDiff >= dariHari && dayDiff <= sampaiHari;
    }

    function updateStatus(id) {
        Swal.fire({
            title: "Anda Yakin?",
            text: "Status data ini akan diubah menjadi lelang. dan tidak bisa dikembalikan.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ubah",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?= route_to('TransaksiController::updateStatus', ':id') ?>'.replace(':id', id),
                    method: 'PUT',
                    data: {
                        '<?= csrf_token(); ?>': $('meta[name="<?= csrf_header(); ?>"]').attr('content')
                    },
                    success: function(response) {
                        toastr.success(response.message, {
                            closeButton: false,
                            debug: false,
                            newestOnTop: false,
                            progressBar: true,
                            positionClass: "toast-top-right",
                            preventDuplicates: false,
                            onclick: null,
                            showDuration: 300,
                            hideDuration: 1000,
                            timeOut: 500,
                            extendedTimeOut: 1000,
                            showEasing: "swing",
                            hideEasing: "linear",
                            showMethod: "fadeIn",
                            hideMethod: "fadeOut"
                        })
                        $('#table-transaksi').DataTable().ajax.reload()
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: "Error",
                            text: xhr.responseJSON.message,
                            type: "error",
                            confirmButtonText: "Ok",
                        });
                    },
                    complete: function(xhr, status, error) {
                        $('meta[name="<?= csrf_header(); ?>"]').attr('content', xhr.responseJSON.data.csrf);
                        $(`input[name="<?= csrf_token(); ?>"]`).each(function() {
                            $(this).val(xhr.responseJSON.data.csrf);
                        });
                    }
                })
            }
        })
    }

    function sendNotification(id) {
        Swal.fire({
            title: "Anda Yakin?",
            text: "Notifikasi akan dikirimkan kepada nasabah",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ubah",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?= route_to('TransaksiController::sendNotification', ':id') ?>'.replace(':id', id),
                    method: 'POST',
                    data: {
                        '<?= csrf_token(); ?>': $('meta[name="<?= csrf_header(); ?>"]').attr('content')
                    },
                    success: function(response) {
                        toastr.success(response.message, {
                            closeButton: false,
                            debug: false,
                            newestOnTop: false,
                            progressBar: true,
                            positionClass: "toast-top-right",
                            preventDuplicates: false,
                            onclick: null,
                            showDuration: 300,
                            hideDuration: 1000,
                            timeOut: 500,
                            extendedTimeOut: 1000,
                            showEasing: "swing",
                            hideEasing: "linear",
                            showMethod: "fadeIn",
                            hideMethod: "fadeOut"
                        })
                        $('#table-transaksi').DataTable().ajax.reload()
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: "Error",
                            text: xhr.responseJSON.message,
                            type: "error",
                            confirmButtonText: "Ok",
                        });
                    },
                    complete: function(xhr, status, error) {
                        $('meta[name="<?= csrf_header(); ?>"]').attr('content', xhr.responseJSON.data.csrf);
                        $(`input[name="<?= csrf_token(); ?>"]`).each(function() {
                            $(this).val(xhr.responseJSON.data.csrf);
                        });
                    }
                })
            }
        })
    }

    function extendTempo(id) {
        const uriShow = '<?= route_to('TransaksiController::show', ':id'); ?>'.replace(':id', id);
        const uriSave = '<?= route_to('TransaksiController::extendTempo', ':id'); ?>'.replace(':id', id);
        $.ajax({
            url: uriShow,
            type: 'GET',
            success: function(response) {
                if (response != null) {
                    const {
                        kode,
                        nama_lengkap,
                        no_wa
                    } = response;
                    $('#kode_transaksi').val(kode);
                    $('#nama_nasabah').val(nama_lengkap);
                    $('#no_telepon').val(no_wa);
                    $('#modal-perpanjang form').attr('action', uriSave);
                    $('#modal-perpanjang').modal('show');
                } else {
                    $('#table-transaksi').DataTable().ajax.reload()
                    Swal.fire({
                        title: "Error",
                        text: "Data Tidak Ditemukan",
                        type: "error",
                        confirmButtonText: "Ok",
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: "Error",
                    text: xhr.responseJSON.message,
                    type: "error",
                    confirmButtonText: "Ok",
                });
            },
        });
    }

    $('#modal-perpanjang form').submit(function(e) {

        var form = $(this);

        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $('#modal-perpanjang form').attr('action'),
            data: form.serialize(),
            dataType: "JSON",
            success: function(response) {
                toastr.success(response.message, {
                    closeButton: false,
                    debug: false,
                    newestOnTop: false,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    preventDuplicates: false,
                    onclick: null,
                    showDuration: 300,
                    hideDuration: 1000,
                    timeOut: 500,
                    extendedTimeOut: 1000,
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut"
                })
                $('#modal-perpanjang').modal('hide');
                $('#table-transaksi').DataTable().ajax.reload()
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: "Error",
                    text: xhr.responseJSON.message,
                    type: "error",
                    confirmButtonText: "Ok",
                });
            },
            complete: function(xhr, status, error) {
                $('meta[name="<?= csrf_header(); ?>"]').attr('content', xhr.responseJSON.data.csrf);
                $(`input[name="<?= csrf_token(); ?>"]`).each(function() {
                    $(this).val(xhr.responseJSON.data.csrf);
                });
            }
        });

    });
</script>
<?= $this->endSection(); ?>