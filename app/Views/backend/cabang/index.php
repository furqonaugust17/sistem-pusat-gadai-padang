<?= $this->extend('backend/layouts/main'); ?>

<?= $this->section('css'); ?>
<link href="<?= base_url('assets/vendor/datatables/css/jquery.dataTables.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.min.css'); ?>" rel="stylesheet">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target=".modal-insert">Tambah Cabang</button>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Cabang</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-cabang" class="display nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
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
<?= $this->include('backend/cabang/_insert'); ?>
<?= $this->include('backend/cabang/_update'); ?>
<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script src="<?= base_url('assets/vendor/datatables/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.min.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#table-cabang').DataTable({
            processing: true,
            serverSide: true,
            language: {
                paginate: {
                    next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                    previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                }
            },
            ajax: '<?= route_to('cabang::index'); ?>',
            columns: [{
                    data: 'nama_cabang',
                },
                {
                    data: 'alamat_cabang',
                },
                {
                    data: 'id',
                    searchable: false,
                    "render": function(data, type, row) {
                        return `<div class="d-flex">
                                        <button type="button" class="btn btn-primary shadow btn-xs sharp me-1" onclick="editData('${data}')"><i class="fas fa-pencil-alt"></i></button>
                                        <button type="button" class="btn btn-danger shadow btn-xs sharp" onclick="deleteData('${data}')"><i class="fa fa-trash"></i></button>
                                    </div>`
                    }
                }
            ]

        });
    });

    function editData(id) {
        const uriShow = '<?= route_to('CabangController::show', ':id'); ?>'.replace(':id', id);
        const uriUpdate = '<?= route_to('CabangController::update', ':id'); ?>'.replace(':id', id);
        $.ajax({
            url: uriShow,
            type: 'GET',
            success: function(response) {
                if (response != null) {
                    const {
                        nama_cabang,
                        alamat_cabang,
                        link_google_maps,
                    } = response
                    $('#form-update').attr('action', uriUpdate);
                    $('#nama_cabang').val(nama_cabang);
                    $('#alamat_cabang').val(alamat_cabang);
                    $('#link_google_maps').val(link_google_maps);
                    $('#modal-update').modal('show');
                } else {
                    $('#table-cabang').DataTable().ajax.reload()
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

    function deleteData(id) {
        Swal.fire({
            title: "Anda Yakin?",
            text: "Data akan terhapus pada sistem!!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: `<?= route_to('CabangController::delete', ':id'); ?>`.replace(':id', id),
                    type: 'DELETE',
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
                        $('#table-cabang').DataTable().ajax.reload()
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
        });
    }
</script>
<?= $this->endSection(); ?>