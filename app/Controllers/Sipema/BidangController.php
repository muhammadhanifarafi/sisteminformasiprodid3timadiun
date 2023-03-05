<?php

namespace App\Controllers\Sipema;

use App\Models\Sipema\BidangModel;
use App\Controllers\BaseController;

class BidangController extends BaseController
{
    public function __construct()
    {
        $this->bidang = new BidangModel();
        \Config\Services::validation();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Data bidang',
            'bidang' => $this->bidang->findAll(),
            'activePage' => 'bidang'
        ];
        return view('sipema/bidang/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Data bidang',
            'activePage' => 'bidang'
        ];
        
        return view('sipema/bidang/tambah', $data);
    }

    public function simpan()
    {
        $validation =  \Config\Services::validation();
        $nama_bidang = $this->request->getVar('nama_bidang');
        
        $rules = [
            'nama_bidang' => [
                'label' => "Nama Bidang",
                'rules' => "required",
                'errors' => [
                    'required' => "{field} harus diisi",
                    'is_unique' => "{field} yang dimasukan Sudah ada"
                ]
            ],
        ];
        
        if($this->validate($rules) == FALSE) {
            $this->validation->setTemplate('<div class="alert alert-danger">', '</div>');
            return view('bidang/tambah', [
                'title' => 'Tambah Data bidang',
                'activePage' => 'bidang',
                'validation' => $validation
            ]);
        } else {
            $data = [
                'nama_bidang' => $nama_bidang,
            ];
            $this->bidang->insert($data);
            session()->setFlashdata('success', 'Data bidang berhasil ditambahkan');
            return redirect()->to('bidang')->with('status_icon', 'success')->with('status_text', 'Data Berhasil ditambah');
        }
    }
    
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data bidang',
            'bidang' => $this->bidang->find($id),
            'activePage' => 'bidang'
        ];
        return view('sipema/bidang/edit', $data);
    }

    public function update($id = null)
    {
        // Validasi form
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'nama_bidang' => 'required',
            ];

            $errors = [
                'nama_bidang' => [
                    'required' => 'Nama Bidang harus diisi'
                ],
            ];

            if (!$this->validate($rules, $errors)) {
                // Tampilkan pesan error
                $validation = \Config\Services::validation();
                $this->session->setFlashdata('errors', $validation->getErrors());
                return redirect()->to('/bidang/update/' . $id)->withInput();
            } else {
                $this->bidang->update($id, [
                    'nama_bidang' => $this->request->getVar('nama_bidang'),
                ]);
                // Set message success
                session()->setFlashdata('message', 'Data Bidang berhasil diupdate');

                // Redirect ke halaman bidang
                return redirect()->to(base_url('bidang'));
            }
        }
    }

    public function hapus($id)
    {
        $data = $this->bidang->find($id);
        $this->bidang->delete($id);
        session()->setFlashdata('status', 'Data Bidang berhasil dihapus');
        return redirect()->to(base_url('bidang'))->with('status_icon', 'success')->with('status_text', 'Data Berhasil dihapus');
    }
}