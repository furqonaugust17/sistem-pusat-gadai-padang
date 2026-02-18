<?= $this->extend('backend/layouts/main'); ?>

<?= $this->section('css'); ?>
<link href="<?= base_url('assets/vendor/select2/css/select2.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/datatables/css/jquery.dataTables.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.min.css'); ?>" rel="stylesheet">
<?= $this->endSection(); ?>


<?= $this->section('content'); ?>
<div class="row">
    <div class="col-xl-3 col-sm-6">
        <div class="card card-coin">
            <div class="card-body text-center">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-12">
                        <i class="fas fa-users fs-1"></i>
                    </div>
                    <div class="col-lg-8 col-12">
                        <div class="row flex-column">
                            <span class="text-lg-start text-center fs-3">Karyawan</span>
                            <span class="text-lg-start text-center fs-2 fw-bold"><?= $karyawan; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card card-coin">
            <div class="card-body text-center">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-12">
                        <i class="fas fa-users fs-1"></i>
                    </div>
                    <div class="col-lg-8 col-12">
                        <div class="row flex-column">
                            <span class="text-lg-start text-center fs-3">Nasabah</span>
                            <span class="text-lg-start text-center fs-2 fw-bold"><?= $nasabah; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card card-coin">
            <div class="card-body text-center">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-12">
                        <i class="fas fa-warehouse fs-1"></i>
                    </div>
                    <div class="col-lg-8 col-12">
                        <div class="row flex-column">
                            <span class="text-lg-start text-center fs-3">Barang</span>
                            <span class="text-lg-start text-center fs-2 fw-bold"><?= $barangGadai; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card card-coin">
            <div class="card-body text-center">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-12">
                        <i class="fas fa-book-open fs-1"></i>
                    </div>
                    <div class="col-lg-8 col-12">
                        <div class="row flex-column">
                            <span class="text-lg-start text-center fs-3">Transaksi</span>
                            <span class="text-lg-start text-center fs-2 fw-bold"><?= $transaksi; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body pb-2 px-3">
                <div id="transaksiChart" class="market-line"></div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script src="<?= base_url('assets/vendor/chart.js/Chart.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/apexchart/apexchart.js') ?>"></script>
<script src="<?= base_url('assets/js/dashboard/dashboard-1.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {});
</script>
<?= $this->endSection(); ?>