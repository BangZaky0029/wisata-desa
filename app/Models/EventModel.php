<?php
namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table            = 'event';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_event', 'slug', 'deskripsi', 'tanggal_mulai', 'tanggal_selesai',
        'waktu', 'lokasi', 'penyelenggara', 'poster', 'harga_tiket',
        'kuota_peserta', 'kontak', 'kategori', 'status', 'views', 'created_by'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama_event'    => 'required|min_length[3]|max_length[255]',
        'deskripsi'     => 'required',
        'tanggal_mulai' => 'required|valid_date',
        'lokasi'        => 'required',
    ];

    protected $allowCallbacks = true;
    protected $beforeInsert   = ['generateSlug'];
    protected $beforeUpdate   = ['generateSlug'];

    protected function generateSlug(array $data)
    {
        if (isset($data['data']['nama_event'])) {
            $data['data']['slug'] = url_title($data['data']['nama_event'], '-', true) . '-' . time();
        }
        return $data;
    }

    public function getUpcoming()
    {
        return $this->where('tanggal_mulai >=', date('Y-m-d'))
                    ->where('status', 'aktif')
                    ->orderBy('tanggal_mulai', 'ASC')
                    ->findAll();
    }
}