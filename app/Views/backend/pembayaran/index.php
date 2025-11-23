<?= $this->extend('backend/layouts/main'); ?>

<?= $this->section('css'); ?>
<link href="<?= base_url('assets/vendor/select2/css/select2.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/datatables/css/jquery.dataTables.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.min.css'); ?>" rel="stylesheet">
<style>
    .select2-container {
        z-index: 9999;
    }

    .select2-container--default .select2-selection--single {
        border-radius: 0.35rem 0 0 0.35rem !important;
        height: 100% !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: auto !important;
    }

    #scanModal {
        z-index: 1056;
    }

    #reader video {
        transform: scaleX(-1);
        -webkit-transform: scaleX(-1);
    }
</style>
<?= $this->endSection(); ?>


<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target=".modal-insert">Tambah Pembayaran</button>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Pembayaran</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-pembayaran" class="display nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nasabah</th>
                                <th>Tanggal Bayar</th>
                                <th>Total Bayar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Kode</th>
                                <th>Nasabah</th>
                                <th>Tanggal Bayar</th>
                                <th>Total Bayar</th>
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
<?= $this->include('backend/pembayaran/_insert'); ?>
<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script src="<?= base_url('assets/vendor/select2/js/select2.full.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/datatables/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        let html5QrCode;
        $('.select-transaksi-container :input').prop('disabled', false);
        $("#single-select").select2({
            containerCssClass: 'd-flex align-items-center',
            ajax: {
                url: '<?= route_to('TransaksiController::getTransaksi') ?>',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(data) {

                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: `${item.kode} (${item.nama_lengkap})`,
                            price: item.nominal
                        }))
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });
        $('.select2.select2-container').addClass('form-control p-0 <?= validation_show_error('transaksi_id') ? 'is-invalid' : ''; ?>');

        $('input[name="total_bayar"]').mask("#.##0", {
            reverse: true
        });

        $('input[name="total_bayar"]').val($('select[name="transaksi_id"] option:selected').attr('price')).trigger('input')

        var table = $('#table-pembayaran').DataTable({
            processing: true,
            serverSide: true,
            language: {
                paginate: {
                    next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                    previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                }
            },
            ajax: '<?= route_to('PembayaranController::datatable'); ?>',
            columns: [{
                    data: 'kode',
                },
                {
                    data: 'nasabah',
                },
                {
                    data: 'tanggal_bayar',
                },
                {
                    data: 'total_bayar',
                },
                {
                    data: 'id',
                    searchable: false,
                    "render": function(data, type, row) {
                        const uriShow = '<?= route_to('PembayaranController::show', ':id'); ?>'.replace(':id', data);
                        return `
                        <div class="d-flex">
                            <a href="${uriShow}" class="btn btn-secondary shadow btn-xs sharp me-1">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>`
                    }
                }
            ]
        });

        $('#btnScanQR').on('click', function(e) {
            e.preventDefault();
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
                        $('#single-select').select2('open');
                        $('.select2-search__field').val(decodedText).trigger('keyup');
                    });
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

        $('#single-select').on('select2:select', function(e) {

            const price = e.params.data.price;
            $('input[name="total_bayar"]').val(price).trigger('input')
        });

    });
</script>
<?= $this->endSection(); ?>