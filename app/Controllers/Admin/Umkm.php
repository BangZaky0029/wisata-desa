<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UmkmModel;

class Umkm extends BaseController
{
    protected $umkmModel;

    public function __construct()
    {
        $this->umkmModel = new UmkmModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $data = [
            'title' => 'Data UMKM',
            'umkm' => $this->umkmModel->orderBy('created_at', 'DESC')->paginate(10),
            'pager' => $this->umkmModel->pager,
        ];
        return view('admin/umkm/index', $data);
    }

    public function create()
    {
        return view('admin/umkm/create', ['title' => 'Tambah UMKM']);
    }

    public function store()
    {
        $rules = [
            'nama_umkm' => 'required',
            'produk' => 'required',
            'kategori' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $foto = $this->request->getFile('foto');
        $fotoName = $foto && $foto->isValid() ? $foto->getRandomName() : null;
        if ($fotoName) {
            $foto->move(WRITEPATH . '../public/uploads/umkm', $fotoName);
        }

        $data = [
            'nama_umkm' => $this->request->getPost('nama_umkm'),
            'pemilik' => $this->request->getPost('pemilik'),
            'kategori' => $this->request->getPost('kategori'),
            'produk' => $this->request->getPost('produk'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga_mulai' => $this->request->getPost('harga_mulai'),
            'foto' => $fotoName,
            'alamat' => $this->request->getPost('alamat'),
            'kontak' => $this->request->getPost('kontak'),
            'whatsapp' => $this->request->getPost('whatsapp'),
            'instagram' => $this->request->getPost('instagram'),
            'jam_operasional' => $this->request->getPost('jam_operasional'),
            'status' => $this->request->getPost('status') ?? 'aktif',
            'created_by' => session()->get('user_id'),
        ];

        if ($this->umkmModel->insert($data)) {
            return redirect()->to('/admin/umkm')->with('success', 'UMKM berhasil ditambahkan');
        }
        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan UMKM');
    }

    public function edit($id)
    {
        $umkm = $this->umkmModel->find($id);
        if (!$umkm) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('admin/umkm/edit', ['title' => 'Edit UMKM', 'umkm' => $umkm]);
    }

    public function update($id)
    {
        $umkm = $this->umkmModel->find($id);
        if (!$umkm) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $foto = $this->request->getFile('foto');
        $fotoName = $umkm['foto'];
        
        if ($foto && $foto->isValid()) {
            if ($umkm['foto'] && file_exists(WRITEPATH . '../public/uploads/umkm/' . $umkm['foto'])) {
                unlink(WRITEPATH . '../public/uploads/umkm/' . $umkm['foto']);
            }
            $fotoName = $foto->getRandomName();
            $foto->move(WRITEPATH . '../public/uploads/umkm', $fotoName);
        }

        $data = [
            'nama_umkm' => $this->request->getPost('nama_umkm'),
            'pemilik' => $this->request->getPost('pemilik'),
            'kategori' => $this->request->getPost('kategori'),
            'produk' => $this->request->getPost('produk'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga_mulai' => $this->request->getPost('harga_mulai'),
            'foto' => $fotoName,
            'alamat' => $this->request->getPost('alamat'),
            'kontak' => $this->request->getPost('kontak'),
            'whatsapp' => $this->request->getPost('whatsapp'),
            'instagram' => $this->request->getPost('instagram'),
            'jam_operasional' => $this->request->getPost('jam_operasional'),
            'status' => $this->request->getPost('status'),
        ];

        if ($this->umkmModel->update($id, $data)) {
            return redirect()->to('/admin/umkm')->with('success', 'UMKM berhasil diperbarui');
        }
        return redirect()->back()->with('error', 'Gagal memperbarui UMKM');
    }

    public function delete($id)
    {
        $umkm = $this->umkmModel->find($id);
        if ($umkm && $umkm['foto']) {
            @unlink(WRITEPATH . '../public/uploads/umkm/' . $umkm['foto']);
        }
        
        if ($this->umkmModel->delete($id)) {
            return redirect()->to('/admin/umkm')->with('success', 'UMKM berhasil dihapus');
        }
        return redirect()->to('/admin/umkm')->with('error', 'Gagal menghapus UMKM');
    }
}