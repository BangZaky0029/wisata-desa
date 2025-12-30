<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PaketWisataModel;

class Paket extends BaseController
{
    protected $paketModel;

    public function __construct()
    {
        $this->paketModel = new PaketWisataModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $data = [
            'title' => 'Data Paket Wisata',
            'paket' => $this->paketModel->orderBy('created_at', 'DESC')->paginate(10),
            'pager' => $this->paketModel->pager,
        ];
        return view('admin/paket/index', $data);
    }

    // Store, Edit, Update, Delete mengikuti pattern yang sama
    // ... (implementasi lengkap akan sama seperti controller lainnya)
}