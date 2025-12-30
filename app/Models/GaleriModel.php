<?php
// ===========================================
// FILE: app/Models/GaleriModel.php
// ===========================================

class GaleriModel extends Model
{
    protected $table            = 'galeri';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'judul', 'deskripsi', 'foto', 'tipe', 'kategori', 'video_url',
        'tags', 'status', 'views', 'created_by'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'judul' => 'required|min_length[3]|max_length[255]',
        'foto'  => 'required',
    ];

    public function getByKategori($kategori)
    {
        return $this->where(['kategori' => $kategori, 'status' => 'aktif'])->findAll();
    }
}