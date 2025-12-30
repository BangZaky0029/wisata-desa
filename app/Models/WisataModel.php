<?php
namespace App\Models;

use CodeIgniter\Model;

class WisataModel extends Model
{
    protected $table            = 'wisata';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_wisata', 'slug', 'deskripsi', 'deskripsi_lengkap', 'lokasi',
        'alamat_lengkap', 'koordinat', 'harga_tiket', 'jam_operasional',
        'kategori', 'thumbnail', 'galeri', 'fasilitas', 'kontak', 'status',
        'views', 'rating', 'created_by'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules      = [
        'nama_wisata' => 'required|min_length[3]|max_length[255]',
        'deskripsi'   => 'required',
        'lokasi'      => 'required',
        'kategori'    => 'required|in_list[alam,budaya,kuliner,edukasi,religi]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    protected $allowCallbacks = true;
    protected $beforeInsert   = ['generateSlug'];
    protected $beforeUpdate   = ['generateSlug'];

    protected function generateSlug(array $data)
    {
        if (isset($data['data']['nama_wisata'])) {
            $data['data']['slug'] = url_title($data['data']['nama_wisata'], '-', true) . '-' . time();
        }
        return $data;
    }

    public function getActive()
    {
        return $this->where('status', 'aktif')->findAll();
    }

    public function getByKategori($kategori)
    {
        return $this->where(['kategori' => $kategori, 'status' => 'aktif'])->findAll();
    }

    public function search($keyword)
    {
        return $this->like('nama_wisata', $keyword)
                    ->orLike('deskripsi', $keyword)
                    ->orLike('lokasi', $keyword)
                    ->where('status', 'aktif')
                    ->findAll();
    }
}