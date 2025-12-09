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
                <h3 id="status">Koneksi WhatsApp terputus!</h3>
                <div class="alert alert-warning m-0">
                    <p class="m-0">pastikan anda menggunakan whatsapp untuk bisnis (bukan whastapp pribadi)</p>
                </div>
                <div id="qr-container" style="display: block">
                    <img id="qr-image" src="" alt="QR Code" />
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
<script type="module">
    import {
        io
    } from "https://cdn.socket.io/4.8.1/socket.io.esm.min.js";
    const socket = io("<?= getenv('WA_GATEWAY_BASE_URL'); ?>", {
        transports: ["websocket"]
    });

    socket.emit("check-status");

    socket.on("qr", (qr) => {
        document.getElementById("qr-image").src = qr;
    });

    socket.on("authenticated", (data) => {
        if (!data) {
            return;
        }
        document.getElementById("status").innerHTML =
            "WhatsApp sudah terhubung!";
        document.getElementById("qr-container").style.display = "none";
    });

    socket.on("disconnected", () => {
        console.log('disconnect');
        document.getElementById("status").innerText =
            "Koneksi WhatsApp terputus!";
        document.getElementById("qr-container").style.display = "block";
    });
</script>
<?= $this->endSection(); ?>