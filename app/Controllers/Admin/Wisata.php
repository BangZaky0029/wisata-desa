<?php
// ===========================================
// FILE: app/Controllers/Admin/Wisata.php
// ===========================================

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WisataModel;

class Wisata extends BaseController
{
    protected $wisataModel;
    protected $session;

    public function __construct()
    {
        $this->wisataModel = new WisataModel();
        $this->session = session();
        helper(['form', 'url', 'text']);
    }

    // READ - List semua wisata
    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        
        if ($keyword) {
            $wisata = $this->wisataModel->like('nama_wisata', $keyword)
                                        ->orLike('lokasi', $keyword)
                                        ->orderBy('created_at', 'DESC')
                                        ->paginate(10);
        } else {
            $wisata = $this->wisataModel->orderBy('created_at', 'DESC')->paginate(10);
        }

        $data = [
            'title' => 'Data Wisata',
            'wisata' => $wisata,
            'pager' => $this->wisataModel->pager,
            'keyword' => $keyword,
        ];

        return view('admin/wisata/index', $data);
    }

    // CREATE - Form tambah wisata
    public function create()
    {
        $data = [
            'title' => 'Tambah Wisata',
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/wisata/create', $data);
    }

    // CREATE - Proses simpan wisata
    public function store()
    {
        $rules = [
            'nama_wisata' => 'required|min_length[3]|max_length[255]',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'harga_tiket' => 'required|decimal',
            'kategori' => 'required|in_list[alam,budaya,kuliner,edukasi,religi]',
            'thumbnail' => 'uploaded[thumbnail]|max_size[thumbnail,2048]|is_image[thumbnail]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle upload thumbnail
        $thumbnail = $this->request->getFile('thumbnail');
        $thumbnailName = null;
        
        if ($thumbnail && $thumbnail->isValid() && !$thumbnail->hasMoved()) {
            $thumbnailName = $thumbnail->getRandomName();
            $thumbnail->move(WRITEPATH . '../public/uploads/wisata', $thumbnailName);
        }

        // Handle fasilitas (JSON)
        $fasilitas = $this->request->getPost('fasilitas');
        $fasilitasJson = $fasilitas ? json_encode(array_filter($fasilitas)) : null;

        $data = [
            'nama_wisata' => $this->request->getPost('nama_wisata'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'deskripsi_lengkap' => $this->request->getPost('deskripsi_lengkap'),
            'lokasi' => $this->request->getPost('lokasi'),
            'alamat_lengkap' => $this->request->getPost('alamat_lengkap'),
            'koordinat' => $this->request->getPost('koordinat'),
            'harga_tiket' => $this->request->getPost('harga_tiket'),
            'jam_operasional' => $this->request->getPost('jam_operasional'),
            'kategori' => $this->request->getPost('kategori'),
            'thumbnail' => $thumbnailName,
            'fasilitas' => $fasilitasJson,
            'kontak' => $this->request->getPost('kontak'),
            'status' => $this->request->getPost('status') ?? 'aktif',
            'created_by' => session()->get('user_id'),
        ];

        if ($this->wisataModel->insert($data)) {
            return redirect()->to('/admin/wisata')->with('success', 'Data wisata berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data wisata');
        }
    }

    // READ - Detail wisata
    public function show($id)
    {
        $wisata = $this->wisataModel->find($id);

        if (!$wisata) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Wisata tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Wisata',
            'wisata' => $wisata,
        ];

        return view('admin/wisata/show', $data);
    }

    // UPDATE - Form edit wisata
    public function edit($id)
    {
        $wisata = $this->wisataModel->find($id);

        if (!$wisata) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Wisata tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Wisata',
            'wisata' => $wisata,
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/wisata/edit', $data);
    }

    // UPDATE - Proses update wisata
    public function update($id)
    {
        $wisata = $this->wisataModel->find($id);

        if (!$wisata) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Wisata tidak ditemukan');
        }

        $rules = [
            'nama_wisata' => 'required|min_length[3]|max_length[255]',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'harga_tiket' => 'required|decimal',
            'kategori' => 'required|in_list[alam,budaya,kuliner,edukasi,religi]',
            'thumbnail' => 'max_size[thumbnail,2048]|is_image[thumbnail]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle upload thumbnail baru
        $thumbnail = $this->request->getFile('thumbnail');
        $thumbnailName = $wisata['thumbnail']; // Keep old thumbnail
        
        if ($thumbnail && $thumbnail->isValid() && !$thumbnail->hasMoved()) {
            // Hapus thumbnail lama
            if ($wisata['thumbnail'] && file_exists(WRITEPATH . '../public/uploads/wisata/' . $wisata['thumbnail'])) {
                unlink(WRITEPATH . '../public/uploads/wisata/' . $wisata['thumbnail']);
            }
            
            $thumbnailName = $thumbnail->getRandomName();
            $thumbnail->move(WRITEPATH . '../public/uploads/wisata', $thumbnailName);
        }

        // Handle fasilitas (JSON)
        $fasilitas = $this->request->getPost('fasilitas');
        $fasilitasJson = $fasilitas ? json_encode(array_filter($fasilitas)) : null;

        $data = [
            'nama_wisata' => $this->request->getPost('nama_wisata'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'deskripsi_lengkap' => $this->request->getPost('deskripsi_lengkap'),
            'lokasi' => $this->request->getPost('lokasi'),
            'alamat_lengkap' => $this->request->getPost('alamat_lengkap'),
            'koordinat' => $this->request->getPost('koordinat'),
            'harga_tiket' => $this->request->getPost('harga_tiket'),
            'jam_operasional' => $this->request->getPost('jam_operasional'),
            'kategori' => $this->request->getPost('kategori'),
            'thumbnail' => $thumbnailName,
            'fasilitas' => $fasilitasJson,
            'kontak' => $this->request->getPost('kontak'),
            'status' => $this->request->getPost('status'),
        ];

        if ($this->wisataModel->update($id, $data)) {
            return redirect()->to('/admin/wisata')->with('success', 'Data wisata berhasil diperbarui');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data wisata');
        }
    }

    // DELETE - Hapus wisata
    public function delete($id)
    {
        $wisata = $this->wisataModel->find($id);

        if (!$wisata) {
            return redirect()->to('/admin/wisata')->with('error', 'Wisata tidak ditemukan');
        }

        // Hapus thumbnail
        if ($wisata['thumbnail'] && file_exists(WRITEPATH . '../public/uploads/wisata/' . $wisata['thumbnail'])) {
            unlink(WRITEPATH . '../public/uploads/wisata/' . $wisata['thumbnail']);
        }

        if ($this->wisataModel->delete($id)) {
            return redirect()->to('/admin/wisata')->with('success', 'Data wisata berhasil dihapus');
        } else {
            return redirect()->to('/admin/wisata')->with('error', 'Gagal menghapus data wisata');
        }
    }

    // Toggle Status (Aktif/Nonaktif)
    public function toggleStatus($id)
    {
        $wisata = $this->wisataModel->find($id);

        if (!$wisata) {
            return $this->response->setJSON(['success' => false, 'message' => 'Wisata tidak ditemukan']);
        }

        $newStatus = $wisata['status'] === 'aktif' ? 'nonaktif' : 'aktif';
        
        if ($this->wisataModel->update($id, ['status' => $newStatus])) {
            return $this->response->setJSON(['success' => true, 'message' => 'Status berhasil diubah', 'status' => $newStatus]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengubah status']);
        }
    }
}