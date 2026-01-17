<?= $this->extend('backend/layouts/main'); ?>

<?= $this->section('css'); ?>
<link href="<?= base_url('assets/vendor/datatables/css/jquery.dataTables.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.min.css'); ?>" rel="stylesheet">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target=".modal-insert">Tambah Nasabah</button>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Nasabah</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-nasabah" class="display nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>No Telepon</th>
                                <th>Email</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama</th>
                                <th>No Telepon</th>
                                <th>Email</th>
                                <th>Jenis Kelamin</th>
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
<?= $this->include('backend/nasabah/_insert'); ?>
<?= $this->include('backend/nasabah/_update'); ?>
<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script src="<?= base_url('assets/vendor/datatables/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/jquery.mask.min.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        const optionPhoneMask = {
            placeholder: '628123456789'
        };
        $('.telp').mask('6280000000000', optionPhoneMask)

        var table = $('#table-nasabah').DataTable({
            processing: true,
            serverSide: true,
            language: {
                paginate: {
                    next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                    previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                }
            },
            ajax: '<?= route_to('nasabah::index'); ?>',
            columns: [{
                    data: "nama",

                },
                {
                    data: "no_telp"
                },
                {
                    data: "email"
                },
                {
                    data: "jenis_kelamin",
                    "render": function(data, type, row) {
                        return row.jenis_kelamin.charAt(0).toUpperCase() + row.jenis_kelamin.slice(1);
                    }
                },
                {
                    data: "alamat"
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
        const uriShow = '<?= route_to('NasabahController::show', ':id'); ?>'.replace(':id', id);
        const uriUpdate = '<?= route_to('NasabahController::update', ':id'); ?>'.replace(':id', id);
        $.ajax({
            url: uriShow,
            type: 'GET',
            success: function(response) {
                if (response != null) {

                    const {
                        nama_lengkap,
                        panggilan,
                        tempat_lahir,
                        tanggal_lahir,
                        jenis_kelamin,
                        alamat_ktp,
                        alamat_domisili,
                        no_telp1,
                        no_telp2,
                        no_wa,
                        email,
                        pekerjaan,
                    } = response
                    $('#form-update').attr('action', uriUpdate);
                    $('#nama_lengkap').val(nama_lengkap);
                    $('#panggilan').val(panggilan);
                    $('#tempat_lahir').val(tempat_lahir);
                    $('#tanggal_lahir').val(tanggal_lahir);
                    $('#alamat_ktp').html(alamat_ktp);
                    $('#alamat_domisili').html(alamat_domisili);
                    $(`#jenis_kelamin option[value="${jenis_kelamin}"]`).attr('selected', true);
                    $('#no_telp1').val(no_telp1);
                    $('#no_wa').val(no_wa);
                    $('#no_telp2').val(no_telp2);
                    $('#email').val(email);
                    $('#pekerjaan').val(pekerjaan);
                    $('#modal-update').modal('show');
                } else {
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
                    url: `<?= route_to('NasabahController::delete', ':id'); ?>`.replace(':id', id),
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
                        $('#table-nasabah').DataTable().ajax.reload()
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