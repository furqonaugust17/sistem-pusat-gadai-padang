<div class="modal fade modal-insert" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form action="<?= route_to('transaksi::create'); ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div id="smartwizard" class="form-wizard order-create">
                        <ul class="nav nav-wizard">
                            <li><a class="nav-link" href="#data-nasabah">
                                    <span>1</span>
                                    <p>Nasabah</p>
                                </a></li>
                            <li><a class="nav-link" href="#barang-gadai">
                                    <span>2</span>
                                    <p>Barang Gadai</p>
                                </a></li>
                            <li><a class="nav-link" href="#data-transaksi">
                                    <span>3</span>
                                    <p>Transaksi</p>
                                </a></li>
                        </ul>
                        <div class="tab-content h-auto">
                            <div id="data-nasabah" class="tab-pane" role="tabpanel">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label class="text-label" for="">Buat Nasabah Baru?</label>
                                        <div class="d-inline-block me-1">Tidak</div>
                                        <div class="form-check form-switch d-inline-block">
                                            <input type="checkbox" name="create_new_nasabah" class="form-check-input" id="site_state" style="cursor: pointer;">
                                            <label for="site_state" class="form-check-label">Ya</label>
                                        </div>
                                    </div>
                                    <div class="select-nasabah-container">
                                        <div class="col-12 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Pilih Nasabah</label>
                                                <select class="form-control" name="nasabah" id="single-select">
                                                    <?php foreach ($nasabahs as $nasabah): ?>
                                                        <option value="<?= $nasabah['id']; ?>"><?= $nasabah['nama_lengkap']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="create-nasabah-container d-none">
                                        <?= $this->include('backend/transaksi/_createNasabah'); ?>
                                    </div>
                                </div>
                            </div>
                            <div id="barang-gadai" class="tab-pane" role="tabpanel">
                                <div class="data-barang-gadai-section">
                                    <?= $this->include('backend/transaksi/_dataBarangGadai'); ?>
                                </div>
                                <div class="detail-section">
                                    <?= $this->include('backend/transaksi/_detailSection'); ?>
                                </div>
                            </div>
                            <div id="data-transaksi" class="tab-pane" role="tabpanel">
                                <?= $this->include('backend/transaksi/_transaksi'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </form>
        </div>
    </div>
</div>