<?= $this->extend('backend/layouts/main'); ?>

<?= $this->section('css'); ?>
<link href="<?= base_url('assets/vendor/select2/css/select2.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/datatables/css/jquery.dataTables.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/bootstrap-daterangepicker/daterangepicker.css'); ?>" rel="stylesheet">

<?= $this->endSection(); ?>


<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <form action="<?= route_to('laporan::create') ?>" method="POST">
                            <?= csrf_field() ?>
                            <table class="w-100">
                                <tr>
                                    <td>Jenis Laporan</td>
                                    <td>:</td>
                                    <td>
                                        <select class="form-control" name="jenis_laporan" id="">
                                            <option value="nasabah">Nasabah</option>
                                            <option value="nasabah">Karyawan</option>
                                            <option value="transaksi">Transaksi</option>
                                            <option value="pembayaran">Pembayaran</option>
                                            <option value="barang-gadai">Barang Gadai</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Periode Waktu</td>
                                    <td>:</td>
                                    <td>
                                        <input class="form-control input-daterange-datepicker" name="periode_waktu" type="text">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Format</td>
                                    <td>:</td>
                                    <td>
                                        <select class="form-control" name="format" id="">
                                            <option value="pdf">PDF</option>
                                            <option value="excel">Excel</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <button type="submit" class="btn btn-primary w-100 mt-3">Cetak Laporan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script src="<?= base_url('assets/vendor/select2/js/select2.full.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/datatables/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/moment/moment.min.js') ?>?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap-daterangepicker/daterangepicker.js') ?>?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.input-daterange-datepicker').daterangepicker({
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-danger',
            cancelClass: 'btn-inverse'
        });
    });
</script>
<?= $this->endSection(); ?>