<?= $this->extend('home/layouts/main'); ?>
<?= $this->section('css'); ?>
<link href="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.min.css'); ?>" rel="stylesheet">
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
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="py-7 py-lg-8">
    <div class="container">
        <h1 class="text-center mb-3">Cek Transaksi Anda</h1>
        <div class="row justify-content-center">
            <div class="col-lg-6 col-12">
                <div class="input-group h-100">
                    <input class="form-control w-100" type="text" name="kode" id="no-transaksi">
                </div>
            </div>
            <div class="col-lg-4 col-12 ps-lg-0 pt-lg-0 pt-3 d-flex justify-content-lg-start justify-content-center gap-3">
                <button class="btn btn-primary w-lg-auto w-100" id="search"><i class="fas fa-search"></i></button>
                <button class="btn btn-primary w-lg-auto w-100" id="camera"><i class="fas fa-camera"></i></button>
            </div>
            <div class="col-12" style="min-height: 350px;">
                <div id="transaksi-container" style="display: none;">
                </div>
            </div>
        </div>
    </div>
</section>
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

<?= $this->section('script'); ?>
<script src="<?= base_url('assets/vendor/global/global.min.js') ?>"></script>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script src="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.min.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        let html5QrCode;

        $('#search').on('click', function() {
            const kode = $('#no-transaksi').val()
            getTransaksi(kode)
        })

        $('#camera').on('click', function() {
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
                        $('#no-transaksi').val(decodedText);
                        getTransaksi(decodedText)
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
        });

        $('#scanModal').on('hidden.bs.modal', function(e) {
            if (html5QrCode) {
                html5QrCode.stop().then(() => {
                    html5QrCode = null;
                });
            }
        });
    });

    function getTransaksi(kode) {
        $.ajax({
            url: '<?= route_to('CekTransaksiController::getTransaksi'); ?>',
            method: 'POST',
            data: {
                '<?= csrf_token(); ?>': $('meta[name="<?= csrf_header(); ?>"]').attr('content'),
                kode
            },
            beforeSend: function() {
                $('#transaksi-container').empty()
            },
            success: function(response) {
                const data = response.data
                $('#transaksi-container').show();
                $('#transaksi-container').append(`
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h4 class="card-title">Transaksi</h4>
                                    <table>
                                        <tr>
                                            <th>Kode</th>
                                            <th>:</th>
                                            <td id="kode"></td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <th>:</th>
                                            <td id="nama"></td>
                                        </tr>
                                        <tr>
                                            <th>Nominal</th>
                                            <th>:</th>
                                            <td id="nominal"></td>
                                        </tr>
                                        <tr>
                                            <th>Jatuh Tempo</th>
                                            <th>:</th>
                                            <td id="jatuh_tempo"></td>
                                        </tr>
                                        <tr>
                                            <th>Nama Darurat</th>
                                            <th>:</th>
                                            <td id="nama_darurat"></td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Darurat</th>
                                            <th>:</th>
                                            <td id="nomor_darurat"></td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <th>:</th>
                                            <td id="status"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h4 class="card-title">Barang</h4>
                                    <div class="row justify-content-center" id="image-container">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
                $("#kode").html(data.kode)
                $("#nama").html(data.nama_lengkap)
                $("#nominal").html(
                    new Intl.NumberFormat("id-ID", {
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0,
                        style: "currency",
                        currency: "IDR"
                    }).format(data.nominal)
                )
                $("#jatuh_tempo").html(data.jatuh_tempo)
                $("#nama_darurat").html(data.nama_kontak_darurat)
                $("#nomor_darurat").html(data.no_kontak_darurat)
                $("#status").html(data.status)

                $.each(data.files, (index, value) => {
                    $('#image-container').append(`
                    <div class="col-6">
                        <img class="img-fluid" src="${value.file_path}" alt="">
                    </div>
                    `)
                })
            },
            error: function(error) {
                const responseJSON = error.responseJSON;
                $('#transaksi-container').show();
                $('#transaksi-container').append(`
                    <h4 class="text-center mt-2">${responseJSON.message}</h4>
                `);
            },
            complete: function(data) {
                const {
                    csrf
                } = data.responseJSON;
                console.log(csrf)
                $('meta[name="<?= csrf_header(); ?>"]').attr('content', csrf)
            }
        })
    }
</script>
<?= $this->endSection(); ?>