<?php
namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table            = 'berita';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'judul', 'slug', 'konten', 'excerpt', 'thumbnail', 'kategori',
        'tags', 'status', 'views', 'created_by', 'published_at'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'judul'  => 'required|min_length[3]|max_length[255]',
        'konten' => 'required',
    ];

    protected $allowCallbacks = true;
    protected $beforeInsert   = ['generateSlug'];
    protected $beforeUpdate   = ['generateSlug'];

    protected function generateSlug(array $data)
    {
        if (isset($data['data']['judul'])) {
            $data['data']['slug'] = url_title($data['data']['judul'], '-', true) . '-' . time();
        }
        return $data;
    }

    public function getPublished()
    {
        return $this->where('status', 'publish')->orderBy('published_at', 'DESC')->findAll();
    }
}