<?php

namespace App\Models;

use CodeIgniter\Model;

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

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function getByKategori($kategori)
    {
        return $this->where(['kategori' => $kategori, 'status' => 'aktif'])
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    public function getByStatus($status = 'aktif')
    {
        return $this->where('status', $status)
                    ->orderBy('views', 'DESC')
                    ->findAll();
    }
}
?>