<?php
// ===========================================
// FILE: app/Controllers/Home.php
// Frontend Homepage Controller
// ===========================================

namespace App\Controllers;

use App\Models\WisataModel;
use App\Models\EventModel;
use App\Models\UmkmModel;
use App\Models\GaleriModel;

class Home extends BaseController
{
    protected $wisataModel;
    protected $eventModel;
    protected $umkmModel;
    protected $galeriModel;

    public function __construct()
    {
        $this->wisataModel = new WisataModel();
        $this->eventModel = new EventModel();
        $this->umkmModel = new UmkmModel();
        $this->galeriModel = new GaleriModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Beranda - Desa Wisata',
            'wisata_unggulan' => $this->wisataModel->where('status', 'aktif')
                                                   ->orderBy('rating', 'DESC')
                                                   ->limit(6)
                                                   ->findAll(),
            'event_terbaru' => $this->eventModel->getUpcoming(),
            'umkm_populer' => $this->umkmModel->where('status', 'aktif')
                                              ->orderBy('views', 'DESC')
                                              ->limit(6)
                                              ->findAll(),
            'galeri' => $this->galeriModel->where('status', 'aktif')
                                          ->orderBy('created_at', 'DESC')
                                          ->limit(8)
                                          ->findAll(),
        ];

        return view('frontend/home', $data);
    }

    public function tentang()
    {
        $data = [
            'title' => 'Tentang Kami - Desa Wisata',
        ];

        return view('frontend/tentang', $data);
    }

    public function kontak()
    {
        $data = [
            'title' => 'Kontak - Desa Wisata',
        ];

        return view('frontend/kontak', $data);
    }
}