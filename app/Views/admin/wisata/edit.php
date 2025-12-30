<?= $this->include('layout/admin_header') ?>
<?= $this->include('layout/admin_sidebar') ?>

<div class="main-content">
    <?= $this->include('layout/admin_navbar') ?>
    
    <div class="content-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4><i class="fas fa-edit"></i> Edit Wisata</h4>
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
        
        <?php $fasilitas = !empty($wisata['fasilitas']) ? json_decode($wisata['fasilitas'], true) : []; ?>
        
        <form action="<?= base_url('admin/wisata/update/' . $wisata['id']) ?>" method="POST" enctype="multipart/form-data">
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
                                <input type="text" name="nama_wisata" class="form-control" 
                                       value="<?= old('nama_wisata', esc($wisata['nama_wisata'])) ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Deskripsi Singkat <span class="text-danger">*</span></label>
                                <textarea name="deskripsi" class="form-control" rows="3" required><?= old('deskripsi', esc($wisata['deskripsi'])) ?></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Deskripsi Lengkap</label>
                                <textarea name="deskripsi_lengkap" class="form-control" rows="5"><?= old('deskripsi_lengkap', esc($wisata['deskripsi_lengkap'])) ?></textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Lokasi <span class="text-danger">*</span></label>
                                    <input type="text" name="lokasi" class="form-control" 
                                           value="<?= old('lokasi', esc($wisata['lokasi'])) ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Koordinat</label>
                                    <input type="text" name="koordinat" class="form-control" placeholder="-7.123, 112.456" 
                                           value="<?= old('koordinat', esc($wisata['koordinat'])) ?>">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" class="form-control" rows="2"><?= old('alamat_lengkap', esc($wisata['alamat_lengkap'])) ?></textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Harga Tiket <span class="text-danger">*</span></label>
                                    <input type="number" name="harga_tiket" class="form-control" 
                                           value="<?= old('harga_tiket', esc($wisata['harga_tiket'])) ?>" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Jam Operasional</label>
                                    <input type="text" name="jam_operasional" class="form-control" placeholder="08:00 - 17:00" 
                                           value="<?= old('jam_operasional', esc($wisata['jam_operasional'])) ?>">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kontak</label>
                                    <input type="text" name="kontak" class="form-control" placeholder="081234567890" 
                                           value="<?= old('kontak', esc($wisata['kontak'])) ?>">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Fasilitas</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="fasilitas[]" value="Parkir" 
                                                   <?= in_array('Parkir', $fasilitas) ? 'checked' : '' ?>>
                                            <label class="form-check-label">Parkir</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="fasilitas[]" value="Toilet" 
                                                   <?= in_array('Toilet', $fasilitas) ? 'checked' : '' ?>>
                                            <label class="form-check-label">Toilet</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="fasilitas[]" value="Mushola" 
                                                   <?= in_array('Mushola', $fasilitas) ? 'checked' : '' ?>>
                                            <label class="form-check-label">Mushola</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="fasilitas[]" value="Warung Makan" 
                                                   <?= in_array('Warung Makan', $fasilitas) ? 'checked' : '' ?>>
                                            <label class="form-check-label">Warung Makan</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="fasilitas[]" value="Wifi" 
                                                   <?= in_array('Wifi', $fasilitas) ? 'checked' : '' ?>>
                                            <label class="form-check-label">Wifi</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="fasilitas[]" value="Area Foto" 
                                                   <?= in_array('Area Foto', $fasilitas) ? 'checked' : '' ?>>
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
                                <?php $kategori = old('kategori', $wisata['kategori']); ?>
                                <select name="kategori" class="form-select" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="alam" <?= $kategori === 'alam' ? 'selected' : '' ?>>Alam</option>
                                    <option value="budaya" <?= $kategori === 'budaya' ? 'selected' : '' ?>>Budaya</option>
                                    <option value="kuliner" <?= $kategori === 'kuliner' ? 'selected' : '' ?>>Kuliner</option>
                                    <option value="edukasi" <?= $kategori === 'edukasi' ? 'selected' : '' ?>>Edukasi</option>
                                    <option value="religi" <?= $kategori === 'religi' ? 'selected' : '' ?>>Religi</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <?php $status = old('status', $wisata['status']); ?>
                                <select name="status" class="form-select">
                                    <option value="aktif" <?= $status === 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                    <option value="nonaktif" <?= $status === 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Thumbnail</label>
                                <?php if (!empty($wisata['thumbnail'])): ?>
                                    <div class="mb-2">
                                        <img src="<?= base_url('uploads/wisata/' . $wisata['thumbnail']) ?>" 
                                             alt="Thumbnail" class="img-thumbnail" 
                                             style="width: 100%; height: 180px; object-fit: cover;">
                                    </div>
                                <?php endif; ?>
                                <input type="file" name="thumbnail" class="form-control" accept="image/*">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah thumbnail. Max: 2MB</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save"></i> Update
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