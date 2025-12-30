<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GaleriModel;

class Galeri extends BaseController
{
    protected $galeriModel;

    public function __construct()
    {
        $this->galeriModel = new GaleriModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $data = [
            'title' => 'Galeri',
            'galeri' => $this->galeriModel->orderBy('created_at', 'DESC')->paginate(12),
            'pager' => $this->galeriModel->pager,
        ];
        return view('admin/galeri/index', $data);
    }

    // Store, Edit, Update, Delete mengikuti pattern yang sama
    // ... (implementasi lengkap akan sama seperti controller lainnya)
}