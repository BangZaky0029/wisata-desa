<?php
namespace App\Models;

use CodeIgniter\Model;

class UmkmModel extends Model
{
    protected $table            = 'umkm';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_umkm', 'slug', 'pemilik', 'kategori', 'produk', 'deskripsi',
        'harga_mulai', 'foto', 'galeri', 'alamat', 'kontak', 'whatsapp',
        'instagram', 'jam_operasional', 'status', 'views', 'created_by'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama_umkm' => 'required|min_length[3]|max_length[255]',
        'produk'    => 'required',
        'kategori'  => 'required|in_list[kuliner,kerajinan,fashion,pertanian,jasa]',
    ];

    protected $allowCallbacks = true;
    protected $beforeInsert   = ['generateSlug'];
    protected $beforeUpdate   = ['generateSlug'];

    protected function generateSlug(array $data)
    {
        if (isset($data['data']['nama_umkm'])) {
            $data['data']['slug'] = url_title($data['data']['nama_umkm'], '-', true) . '-' . time();
        }
        return $data;
    }

    public function getByKategori($kategori)
    {
        return $this->where(['kategori' => $kategori, 'status' => 'aktif'])->findAll();
    }
}