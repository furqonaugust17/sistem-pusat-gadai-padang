<?= $this->extend('backend/layouts/main'); ?>

<?= $this->section('css'); ?>
<style>
    .select2-container {
        z-index: 9999;
    }

    #reader video {
        transform: scaleX(-1);
        -webkit-transform: scaleX(-1);
        /* untuk browser lama */
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
        <!-- <button type="button" class="btn btn-primary mb-4" id="scan">Scan QR Code</button> -->
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
<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script src="<?= base_url('assets/vendor/select2/js/select2.full.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/datatables/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
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
                    "render": function(data, type, row) {
                        const uriShow = '<?= route_to('TransaksiController::show', ':id'); ?>'.replace(':id', data);
                        return `<div class="d-flex">
                        <a href="${uriShow}" class="btn btn-secondary shadow btn-xs sharp me-1">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>`
                    }
                }
            ]

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
                        $('#table-transaksi_filter input[type="search"]').val(decodedText)
                    });
                },
            ).catch(err => {
                console.error("Camera start failed:", err);
                alert("Gagal mengakses kamera: " + err);
            });
        })
    });
</script>
<?= $this->endSection(); ?>