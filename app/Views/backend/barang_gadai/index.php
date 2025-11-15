<?= $this->extend('backend/layouts/main'); ?>

<?= $this->section('css'); ?>
<link href="<?= base_url('assets/vendor/datatables/css/jquery.dataTables.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.min.css'); ?>" rel="stylesheet">
<style>
    .text-ellipsis-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: normal;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Barang Gadai</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-barang-gadai" class="display nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Deskripsi</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Deskripsi</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('modal'); ?>
<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script src="<?= base_url('assets/vendor/datatables/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.24/dataRender/ellipsis.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        function capitalizeWords(str) {
            return str.replace(/(^\w{1})|(\s+\w{1})/g, letter => letter.toUpperCase());
        }

        var table = $('#table-barang-gadai').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            language: {
                paginate: {
                    next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                    previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                }
            },
            ajax: '<?= route_to('barang-gadai::index'); ?>',
            columns: [{
                    data: null,
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama_barang',
                    render: function(data) {
                        return capitalizeWords(data);
                    }
                },
                {
                    data: 'deskripsi',
                    render: function(data) {
                        return `<div class="text-ellipsis-3" title="${data}">${data}</div>`;
                    }
                },
                {
                    data: 'jenis',
                    render: function(data) {
                        return capitalizeWords(data);
                    }
                },
                {
                    data: 'status',
                    render: function(data) {
                        return capitalizeWords(data);
                    }
                },
                {
                    data: 'id',
                    searchable: false,
                    orderable: false,
                    render: function(data) {
                        const uriShow = '<?= route_to('BarangGadaiController::show', ':id'); ?>'.replace(':id', data);
                        const uriEdit = '<?= route_to('BarangGadaiController::edit', ':id'); ?>'.replace(':id', data);
                        return `
                    <div class="d-flex">
                        <a href="${uriShow}" class="btn btn-secondary shadow btn-xs sharp me-1">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="${uriEdit}" class="btn btn-primary shadow btn-xs sharp me-1">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    </div>`;
                    }
                }
            ],
            columnDefs: [{
                    targets: 0,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    targets: 2,
                    width: '300px'
                }
            ]
        });

    });
</script>
<?= $this->endSection(); ?>