<?= $this->extend('backend/layouts/main'); ?>

<?= $this->section('css'); ?>
<link href="<?= base_url('assets/vendor/select2/css/select2.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/datatables/css/jquery.dataTables.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.min.css'); ?>" rel="stylesheet">
<?= $this->endSection(); ?>


<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <form action="<?= route_to('laporan::create'); ?>" method="POST">
                            <?= csrf_field(); ?>
                            <table class="w-100">
                                <tr>
                                    <td>Format</td>
                                    <td>:</td>
                                    <td>
                                        <select class="form-control" name="format" id="">
                                            <option value="sql">SQL</option>
                                            <option value="csv">CSV</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <button type="submit" class="btn btn-primary w-100 mt-3">Backup Data</button>
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
<script type="text/javascript">
    $(document).ready(function() {});
</script>
<?= $this->endSection(); ?>