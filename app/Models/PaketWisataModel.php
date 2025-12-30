<?php
namespace App\Models;

use CodeIgniter\Model;

class PaketWisataModel extends Model
{
    protected $table            = 'paket_wisata';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_paket', 'slug', 'deskripsi', 'harga', 'durasi', 'minimal_peserta',
        'maksimal_peserta', 'include', 'exclude', 'itinerary', 'thumbnail',
        'kontak', 'status', 'views', 'created_by'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama_paket' => 'required|min_length[3]|max_length[255]',
        'deskripsi'  => 'required',
        'harga'      => 'required|decimal',
        'durasi'     => 'required',
    ];

    protected $allowCallbacks = true;
    protected $beforeInsert   = ['generateSlug'];
    protected $beforeUpdate   = ['generateSlug'];

    protected function generateSlug(array $data)
    {
        if (isset($data['data']['nama_paket'])) {
            $data['data']['slug'] = url_title($data['data']['nama_paket'], '-', true) . '-' . time();
        }
        return $data;
    }
}