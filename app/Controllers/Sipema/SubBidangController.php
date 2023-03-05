<?php

namespace App\Controllers\Sipema;

use App\Models\Sipema\BidangModel;
use App\Models\Sipema\SubBidangModel;
use App\Controllers\BaseController;

class SubBidangController extends BaseController
{
    public function __construct()
    {
        $validation =  \Config\Services::validation();
        $this->subbidang = new SubBidangModel();
        $this->bidang = new BidangModel();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Data Sub Bidang',
            'subbidangandbidang' => $this->subbidang->getSubBidangandBidang(),
            'activePage' => 'sub-bidang'
        ];
        return view('sipema/subbidang/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Data Sub Bidang',
            'bidang' => $this->bidang->findAll(),
            'activePage' => 'sub-bidang'
        ];
        
        return view('sipema/subbidang/tambah', $data);
    }

    public function simpan()
    {
        $rules = [
            'nama_sub_bidang' => 'required',
            'id_bidang' => 'required',
        ];
        
        if ($this->validate($rules)) {
            $this->subbidang->save([
                'nama_sub_bidang' => $this->request->getVar('nama_sub_bidang'),
                'id_bidang' => $this->request->getVar('id_bidang')
            ]);
            session()->setFlashdata('success', 'Data Sub Bidang berhasil ditambahkan');
            return redirect()->to(base_url('sub-bidang'));
        }else{
            $this->validation->setErrorDelimiters('<div class="alert alert-danger">', '</div>');
            return view('sipema/subbidang/tambah', [
                'title' => 'Tambah Data Sub Bidang',
                'validation' => $validation,
                'activePage' => 'sub-bidang'
            ]);
        }
    }
    
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Sub Bidang',
            'subbidang' => $this->subbidang->find($id),
            'activePage' => 'sub-bidang'
        ];
        return view('sub_bidang/edit', $data);
    }
    
    public function update($id = null)
    {
        // Validasi form
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'nama_sub_bidang' => 'required',
            ];

            $errors = [
                'nama_sub_bidang' => [
                    'required' => 'Nama Sub Bidang harus diisi'
                ],
            ];

            if (!$this->validate($rules, $errors)) {
                // Tampilkan pesan error
                $validation = \Config\Services::validation();
                $this->session->setFlashdata('errors', $validation->getErrors());
                return redirect()->to('/sub-bidang/update/' . $id)->withInput();
            } else {
                $this->subbidang->update($id, [
                    'nama_sub_bidang' => $this->request->getVar('nama_sub_bidang'),
                ]);
                // Set message success
                session()->setFlashdata('message', 'Data Sub Bidang berhasil diupdate');

                // Redirect ke halaman bidang
                return redirect()->to(base_url('sub-bidang'));
            }
        }
    }
    
    public function hapus($id)
    {
        $data = $this->subbidang->find($id);
        $this->subbidang->delete($id);
        session()->setFlashdata('status', 'Data Sub Bidang berhasil dihapus');
        return redirect()->to(base_url('sub-bidang'))->with('status_icon', 'success')->with('status_text', 'Data Berhasil dihapus');
    }
}