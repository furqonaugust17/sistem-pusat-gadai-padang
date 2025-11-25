<?= $this->extend('home/layouts/main'); ?>
<?= $this->section('css'); ?>

<style>
    .features .nav-tabs-section {
        border: 0;
        background-color: color-mix(in srgb, var(--gohub-gray-1000), transparent 96%);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50px;
        padding: 6px;
        width: auto;
    }

    .features .nav-item-section {
        margin: 0;
        padding: 0 5px 0 0;
    }

    .features .nav-item-section:last-child {
        padding-right: 0;
    }

    .features .nav-link-section {
        background-color: none;
        color: var(--heading-color);
        padding: 10px 30px;
        transition: 0.3s;
        border-radius: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        height: 100%;
        border: 0;
        margin: 0;
    }

    @media (max-width: 468px) {
        .features .nav-link-section {
            padding: 8px 20px;
        }
    }

    .features .nav-link-section i {
        padding-right: 15px;
        font-size: 48px;
    }

    .features .nav-link-section h4 {
        font-size: 14px;
        font-weight: 500;
        margin: 0;
    }

    .features .nav-link-section:hover {
        border-color: color-mix(in srgb, var(--gohub-gray-1000), transparent 80%);
    }

    .features .nav-link-section:hover h4 {
        color: var(--gohub-primary);
    }

    .features .nav-link-section.active {
        background-color: var(--gohub-primary);
        border-color: var(--gohub-primary);
    }

    .features .nav-link-section.active h4 {
        color: var(--gohub-white);
    }

    .features .tab-content {
        margin-top: 30px;
    }

    .features .tab-pane h3 {
        color: var(--heading-color);
        font-weight: 700;
        font-size: 32px;
        position: relative;
        margin-bottom: 20px;
        padding-bottom: 20px;
    }

    .features .tab-pane h3:after {
        content: "";
        position: absolute;
        display: block;
        width: 60px;
        height: 3px;
        background: var(--gohub-primary);
        left: 0;
        bottom: 0;
    }

    .features .tab-pane ul {
        list-style: none;
        padding: 0;
    }

    .features .tab-pane ul li {
        padding-top: 10px;
    }

    .features .tab-pane ul i {
        font-size: 20px;
        padding-right: 4px;
        color: var(--gohub-primary);
    }

    .features .tab-pane p:last-child {
        margin-bottom: 0;
    }
</style>

<?= $this->endSection(); ?>


<?= $this->section('content'); ?>

<section class="py-7 py-lg-8">
    <div class="container">
        <h1 class="text-center mb-3">List Barang Lelang</h1>
        <div class="features">
            <div class="d-flex flex-column justify-content-center align-items-center gap-2">
                <ul class="nav nav-tabs-section">
                    <li class="nav-item-section">
                        <a class="nav-link-section active"
                            data-category="kendaraan">
                            <h4>Kendaraan</h4>
                        </a>
                    </li>
                    <li class="nav-item-section">
                        <a class="nav-link-section"
                            data-category="elektronik">
                            <h4>Elektronik</h4>
                        </a>
                    </li>
                    <li class="nav-item-section">
                        <a class="nav-link-section"
                            data-category="lainnya">
                            <h4>Lainnya</h4>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="tab-content mt-4">
                <div id="auction-content">
                </div>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection(); ?>


<?= $this->section('script'); ?>
<script src="<?= base_url('assets/vendor/global/global.min.js') ?>"></script>
<script>
    $(document).ready(function() {

        function loadData(category) {
            $("#auction-content").html(`
            <div class="text-center py-5">
                <div class="spinner-border"></div>
                <p class="mt-3">Memuat ${category}...</p>
            </div>
        `);

            $.ajax({
                url: "/barang-gadai/lelang/list",
                type: "GET",
                data: {
                    category: category
                },
                success: function(response) {
                    $("#auction-content").empty()
                    const data = response.data
                    if (!data.length) {
                        $("#auction-content").append(`
                            <p class='text-center py-4 text-muted'>
                            Tidak ada barang lelang pada kategori ini.
                            </p>
                        `)
                        return;
                    }

                    $("#auction-content").append(`<div class="row justify-content-center"></div>`)
                    $.each(data, (index, value) => {
                        const urlLink = '<?= route_to('Home::detailBarangLelang', ':id'); ?>'.replace(':id', value.id)
                        const urlImage = '<?= base_url(':gambar'); ?>'.replace(':gambar', value.foto)
                        const nama = value.nama_barang
                        const nilai = new Intl.NumberFormat("id-ID", {
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0,
                            style: "currency",
                            currency: "IDR"
                        }).format(value.nilai_taksiran)
                        $("#auction-content .row").append(`
                             <div class="col-md-4 mb-4">
                             <a href="${urlLink}">
                                <div class="card shadow border-0 h-100">
                                    <img src="${urlImage}" class="card-img-top p-lg-4 p-3">
                                    <div class="card-body px-lg-4 py-lg-2 px-3 py-1">
                                        <h4 class="card-title mb-0">${nama}</h4>
                                        <p class="fw-bold text-primary">Mulai ${nilai}</p>
                                    </div>
                                </div>
                             </a>
                            </div>
                        `)
                    });
                },
                error: function() {
                    $("#auction-content").html(`
                    <div class="text-danger text-center py-5">
                        Gagal memuat data ${category}.
                    </div>
                `);
                }
            });
        }

        $(".nav-link-section").on("click", function() {
            $(".nav-link-section").removeClass("active");
            $(this).addClass("active");

            let category = $(this).data("category");

            loadData(category);
        });

        loadData("kendaraan");
    });
</script>

<?= $this->endSection(); ?>