<!-- ===========================================
FILE: app/Views/admin/wisata/create.php
=========================================== -->
<?= $this->include('layout/admin_header') ?>
<?= $this->include('layout/admin_sidebar') ?>

<div class="main-content">
    <?= $this->include('layout/admin_navbar') ?>
    
    <div class="content-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4><i class="fas fa-plus"></i> Tambah Wisata</h4>
            <a href="<?= base_url('admin/wisata') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <h5><i class="fas fa-exclamation-triangle"></i> Error!</h5>
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
        
        <form action="<?= base_url('admin/wisata/store') ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Informasi Wisata</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Wisata <span class="text-danger">*</span></label>
                                <input type="text" name="nama_wisata" class="form-control" value="<?= old('nama_wisata') ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Deskripsi Singkat <span class="text-danger">*</span></label>
                                <textarea name="deskripsi" class="form-control" rows="3" required><?= old('deskripsi') ?></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Deskripsi Lengkap</label>
                                <textarea name="deskripsi_lengkap" class="form-control" rows="5"><?= old('deskripsi_lengkap') ?></textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Lokasi <span class="text-danger">*</span></label>
                                    <input type="text" name="lokasi" class="form-control" value="<?= old('lokasi') ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Koordinat</label>
                                    <input type="text" name="koordinat" class="form-control" placeholder="-7.123, 112.456" value="<?= old('koordinat') ?>">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" class="form-control" rows="2"><?= old('alamat_lengkap') ?></textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Harga Tiket <span class="text-danger">*</span></label>
                                    <input type="number" name="harga_tiket" class="form-control" value="<?= old('harga_tiket') ?>" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Jam Operasional</label>
                                    <input type="text" name="jam_operasional" class="form-control" placeholder="08:00 - 17:00" value="<?= old('jam_operasional') ?>">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kontak</label>
                                    <input type="text" name="kontak" class="form-control" placeholder="081234567890" value="<?= old('kontak') ?>">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Fasilitas</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="fasilitas[]" value="Parkir">
                                            <label class="form-check-label">Parkir</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="fasilitas[]" value="Toilet">
                                            <label class="form-check-label">Toilet</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="fasilitas[]" value="Mushola">
                                            <label class="form-check-label">Mushola</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="fasilitas[]" value="Warung Makan">
                                            <label class="form-check-label">Warung Makan</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="fasilitas[]" value="Wifi">
                                            <label class="form-check-label">Wifi</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="fasilitas[]" value="Area Foto">
                                            <label class="form-check-label">Area Foto</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Pengaturan</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select name="kategori" class="form-select" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="alam" <?= old('kategori') == 'alam' ? 'selected' : '' ?>>Alam</option>
                                    <option value="budaya" <?= old('kategori') == 'budaya' ? 'selected' : '' ?>>Budaya</option>
                                    <option value="kuliner" <?= old('kategori') == 'kuliner' ? 'selected' : '' ?>>Kuliner</option>
                                    <option value="edukasi" <?= old('kategori') == 'edukasi' ? 'selected' : '' ?>>Edukasi</option>
                                    <option value="religi" <?= old('kategori') == 'religi' ? 'selected' : '' ?>>Religi</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="aktif" <?= old('status') == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                    <option value="nonaktif" <?= old('status') == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Thumbnail <span class="text-danger">*</span></label>
                                <input type="file" name="thumbnail" class="form-control" accept="image/*" required>
                                <small class="text-muted">Max: 2MB, Format: JPG, PNG</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('admin/wisata') ?>" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->include('layout/admin_footer') ?>