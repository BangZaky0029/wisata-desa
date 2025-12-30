<?php
// ===========================================
// FILE: app/Controllers/Admin/Event.php
// Pattern sama seperti Wisata, disesuaikan untuk Event
// ===========================================

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EventModel;

class Event extends BaseController
{
    protected $eventModel;

    public function __construct()
    {
        $this->eventModel = new EventModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $data = [
            'title' => 'Data Event',
            'events' => $this->eventModel->orderBy('tanggal_mulai', 'DESC')->paginate(10),
            'pager' => $this->eventModel->pager,
        ];
        return view('admin/event/index', $data);
    }

    public function create()
    {
        return view('admin/event/create', ['title' => 'Tambah Event']);
    }

    public function store()
    {
        $rules = [
            'nama_event' => 'required',
            'deskripsi' => 'required',
            'tanggal_mulai' => 'required|valid_date',
            'lokasi' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $poster = $this->request->getFile('poster');
        $posterName = $poster && $poster->isValid() ? $poster->getRandomName() : null;
        if ($posterName) {
            $poster->move(WRITEPATH . '../public/uploads/event', $posterName);
        }

        $data = [
            'nama_event' => $this->request->getPost('nama_event'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
            'waktu' => $this->request->getPost('waktu'),
            'lokasi' => $this->request->getPost('lokasi'),
            'penyelenggara' => $this->request->getPost('penyelenggara'),
            'poster' => $posterName,
            'harga_tiket' => $this->request->getPost('harga_tiket') ?? 0,
            'kuota_peserta' => $this->request->getPost('kuota_peserta'),
            'kontak' => $this->request->getPost('kontak'),
            'kategori' => $this->request->getPost('kategori') ?? 'festival',
            'status' => $this->request->getPost('status') ?? 'aktif',
            'created_by' => session()->get('user_id'),
        ];

        if ($this->eventModel->insert($data)) {
            return redirect()->to('/admin/event')->with('success', 'Event berhasil ditambahkan');
        }
        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan event');
    }

    public function edit($id)
    {
        $event = $this->eventModel->find($id);
        if (!$event) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('admin/event/edit', ['title' => 'Edit Event', 'event' => $event]);
    }

    public function update($id)
    {
        $event = $this->eventModel->find($id);
        if (!$event) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $poster = $this->request->getFile('poster');
        $posterName = $event['poster'];
        
        if ($poster && $poster->isValid()) {
            if ($event['poster'] && file_exists(WRITEPATH . '../public/uploads/event/' . $event['poster'])) {
                unlink(WRITEPATH . '../public/uploads/event/' . $event['poster']);
            }
            $posterName = $poster->getRandomName();
            $poster->move(WRITEPATH . '../public/uploads/event', $posterName);
        }

        $data = [
            'nama_event' => $this->request->getPost('nama_event'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
            'waktu' => $this->request->getPost('waktu'),
            'lokasi' => $this->request->getPost('lokasi'),
            'penyelenggara' => $this->request->getPost('penyelenggara'),
            'poster' => $posterName,
            'harga_tiket' => $this->request->getPost('harga_tiket'),
            'kuota_peserta' => $this->request->getPost('kuota_peserta'),
            'kontak' => $this->request->getPost('kontak'),
            'kategori' => $this->request->getPost('kategori'),
            'status' => $this->request->getPost('status'),
        ];

        if ($this->eventModel->update($id, $data)) {
            return redirect()->to('/admin/event')->with('success', 'Event berhasil diperbarui');
        }
        return redirect()->back()->with('error', 'Gagal memperbarui event');
    }

    public function delete($id)
    {
        $event = $this->eventModel->find($id);
        if ($event && $event['poster']) {
            @unlink(WRITEPATH . '../public/uploads/event/' . $event['poster']);
        }
        
        if ($this->eventModel->delete($id)) {
            return redirect()->to('/admin/event')->with('success', 'Event berhasil dihapus');
        }
        return redirect()->to('/admin/event')->with('error', 'Gagal menghapus event');
    }
}
