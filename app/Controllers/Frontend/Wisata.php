<?php

// ===========================================
// FILE: app/Controllers/Frontend/Wisata.php
// ===========================================

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\WisataModel;

class Wisata extends BaseController
{
    protected $wisataModel;

    public function __construct()
    {
        $this->wisataModel = new WisataModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $kategori = $this->request->getGet('kategori');

        $builder = $this->wisataModel->where('status', 'aktif');

        if ($keyword) {
            $builder->like('nama_wisata', $keyword)
                   ->orLike('deskripsi', $keyword);
        }

        if ($kategori) {
            $builder->where('kategori', $kategori);
        }

        $data = [
            'title' => 'Destinasi Wisata - Desa Wisata',
            'wisata' => $builder->orderBy('created_at', 'DESC')->paginate(12),
            'pager' => $this->wisataModel->pager,
            'keyword' => $keyword,
            'kategori' => $kategori,
        ];

        return view('frontend/wisata/index', $data);
    }

    public function detail($slug)
    {
        $wisata = $this->wisataModel->where('slug', $slug)
                                    ->where('status', 'aktif')
                                    ->first();

        if (!$wisata) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Wisata tidak ditemukan');
        }

        // Increment views
        $this->wisataModel->update($wisata['id'], [
            'views' => $wisata['views'] + 1
        ]);

        // Get related wisata
        $related = $this->wisataModel->where('kategori', $wisata['kategori'])
                                     ->where('id !=', $wisata['id'])
                                     ->where('status', 'aktif')
                                     ->limit(4)
                                     ->findAll();

        $data = [
            'title' => $wisata['nama_wisata'] . ' - Desa Wisata',
            'wisata' => $wisata,
            'related' => $related,
        ];

        return view('frontend/wisata/detail', $data);
    }
}
