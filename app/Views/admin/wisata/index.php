<!-- ===========================================
FILE: app/Views/admin/wisata/index.php
=========================================== -->
<?= $this->include('layout/admin_header') ?>
<?= $this->include('layout/admin_sidebar') ?>

<div class="main-content">
    <?= $this->include('layout/admin_navbar') ?>
    
    <div class="content-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4><i class="fas fa-map-marked-alt"></i> Data Wisata</h4>
            <a href="<?= base_url('admin/wisata/create') ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Wisata
            </a>
        </div>
        
        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
        
        <div class="card">
            <div class="card-header bg-white">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 class="mb-0">Daftar Wisata</h5>
                    </div>
                    <div class="col-md-6">
                        <form action="" method="get" class="d-flex gap-2">
                            <input type="text" name="keyword" class="form-control" placeholder="Cari wisata..." value="<?= $keyword ?? '' ?>">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Thumbnail</th>
                                <th>Nama Wisata</th>
                                <th>Lokasi</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($wisata)): ?>
                                <?php 
                                $no = 1 + (($pager->getCurrentPage() - 1) * $pager->getPerPage());
                                foreach ($wisata as $w): 
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <?php if ($w['thumbnail']): ?>
                                        <img src="<?= base_url('uploads/wisata/' . $w['thumbnail']) ?>" 
                                             alt="<?= esc($w['nama_wisata']) ?>" 
                                             class="img-thumbnail" 
                                             style="width: 80px; height: 60px; object-fit: cover;">
                                        <?php else: ?>
                                        <div class="bg-secondary text-white text-center" style="width: 80px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-image"></i>
                                        </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <strong><?= esc($w['nama_wisata']) ?></strong><br>
                                        <small class="text-muted">
                                            <i class="fas fa-eye"></i> <?= $w['views'] ?> views
                                        </small>
                                    </td>
                                    <td><?= esc($w['lokasi']) ?></td>
                                    <td><span class="badge bg-info"><?= ucfirst($w['kategori']) ?></span></td>
                                    <td>Rp <?= number_format($w['harga_tiket'], 0, ',', '.') ?></td>
                                    <td>
                                        <?php if ($w['status'] === 'aktif'): ?>
                                        <span class="badge bg-success">Aktif</span>
                                        <?php else: ?>
                                        <span class="badge bg-secondary">Nonaktif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?= base_url('admin/wisata/edit/' . $w['id']) ?>" 
                                               class="btn btn-sm btn-warning" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?= base_url('admin/wisata/delete/' . $w['id']) ?>" 
                                               class="btn btn-sm btn-danger" 
                                               title="Hapus"
                                               onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fa-3x mb-3"></i><br>
                                        Belum ada data wisata
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <?= $pager->links('default', 'bootstrap_pagination') ?>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layout/admin_footer') ?>