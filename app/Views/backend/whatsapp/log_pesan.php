<?= $this->extend('backend/layouts/main'); ?>

<?= $this->section('css'); ?>
<link href="<?= base_url('assets/vendor/datatables/css/jquery.dataTables.min.css'); ?>" rel="stylesheet">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Log Pesan</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-log-pesan" class="display nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Lengkap</th>
                                <th>No WhatsApp</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Lengkap</th>
                                <th>No WhatsApp</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>


<?= $this->section('javascript'); ?>
<script src="<?= base_url('assets/vendor/datatables/js/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {

        var table = $('#table-log-pesan').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [4, 'desc']
            ],
            language: {
                paginate: {
                    next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                    previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                }
            },
            ajax: '<?= route_to('WhatsappController::logPesan'); ?>',
            columns: [{
                    data: 'kode',
                },
                {
                    data: 'nama_lengkap',
                },
                {
                    data: 'no_wa',
                },
                {
                    data: 'status',
                },
                {
                    data: 'created_at',
                }
            ]
        });

    });
</script>
<?= $this->endSection(); ?>