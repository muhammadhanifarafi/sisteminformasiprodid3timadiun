<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MahasiswaModel;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->mahasiswa = new MahasiswaModel();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Data Mahasiswa',
            'mahasiswa' => $this->mahasiswa->findAll()
        ];
        return view('mahasiswa/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Data Mahasiswa'
        ];
        
        return view('mahasiswa/tambah', $data);
    }

    public function simpan()
    {
        $validation =  \Config\Services::validation();
        $nama = $this->request->getVar('nama');
        $nim = $this->request->getVar('nim');
        $kelas = $this->request->getVar('kelas');
        $ttl = $this->request->getVar('ttl');
        $no_telp = $this->request->getVar('no_telp');
        $angkatan = $this->request->getVar('angkatan');
        $alamat = $this->request->getVar('alamat');
        $status = $this->request->getVar('status');
        
        $data = [
            'nama' => $nama,
            'nim' => $nim,
            'kelas' => $kelas,
            'ttl' => $ttl,
            'no_telp' => $no_telp,
            'angkatan' => $angkatan,
            'alamat' => $alamat,
            'status' => $status
        ];
        
        if($validation->run($data, 'mahasiswa') == FALSE) {
            $validation->setErrorDelimiters('<div class="alert alert-danger">', '</div>');
            return view('mahasiswa/tambah', [
                'title' => 'Tambah Data Mahasiswa',
                'validation' => $validation
            ]);
        } else {
            $data = [
                'nama' => $nama,
                'nim' => $nim,
                'kelas' => $kelas,
                'ttl' => $ttl,
                'no_telp' => $no_telp,
                'angkatan' => $angkatan,
                'alamat' => $alamat,
                'status' => $status
            ];
            $this->MahasiswaModel->insert($data);
            session()->setFlashdata('success', 'Data mahasiswa berhasil ditambahkan');
            return redirect()->to('mahasiswa');
        }
    }
    
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Mahasiswa',
            'mahasiswa' => $this->mahasiswaModel->find($id)
        ];
        return view('mahasiswa/edit', $data);
    }

    public function update($id = null)
    {
        // Validasi form
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'nim' => 'required|min_length[10]|max_length[10]',
                'nama' => 'required',
                'kelas' => 'required',
                'ttl' => 'required',
                'no_telp' => 'required',
                'angkatan' => 'required',
                'alamat' => 'required',
                'status' => 'required'
            ];

            $errors = [
                'nim' => [
                    'required' => 'NIM harus diisi',
                    'min_length' => 'NIM minimal 10 karakter',
                    'max_length' => 'NIM maksimal 10 karakter'
                ],
                'nama' => [
                    'required' => 'Nama harus diisi'
                ],
                'kelas' => [
                    'required' => 'Kelas harus diisi'
                ],
                'ttl' => [
                    'required' => 'Tempat tanggal lahir harus diisi'
                ],
                'no_telp' => [
                    'required' => 'Nomor telepon harus diisi'
                ],
                'angkatan' => [
                    'required' => 'Angkatan harus diisi'
                ],
                'alamat' => [
                    'required' => 'Alamat harus diisi'
                ],
                'status' => [
                    'required' => 'Status harus diisi'
                ]
            ];

            if (!$this->validate($rules, $errors)) {
                // Tampilkan pesan error
                $validation = \Config\Services::validation();
                $this->session->setFlashdata('errors', $validation->getErrors());
                return redirect()->to('/mahasiswa/edit/' . $id)->withInput();
            } else {
                $this->mahasiswaModel->update($id, [
                    'nim' => $this->request->getVar('nim'),
                    'nama' => $this->request->getVar('nama'),
                    'kelas' => $this->request->getVar('kelas'),
                    'ttl' => $this->request->getVar('ttl'),
                    'no_telp' => $this->request->getVar('no_telp'),
                    'angkatan' => $this->request->getVar('angkatan'),
                    'alamat' => $this->request->getVar('alamat'),
                    'status' => $this->request->getVar('status')
                ]);
                // Set message success
                session()->setFlashdata('message', 'Data mahasiswa berhasil diupdate');

                // Redirect ke halaman mahasiswa
                return redirect()->to(base_url('mahasiswa'));
            }
        }
    }

    public function import_data_mahasiswa()
    {
        $validation =  \Config\Services::validation();

        if ($this->request->getMethod() == 'post') {
            $file = $this->request->getFile('file');

            // Validate file uploaded
            $validation->setRules([
                'file' => [
                    'label' => 'File',
                    'rules' => 'uploaded[file]|ext_in[file,xls,xlsx]|max_size[file,1024]'
                ],
            ]);
            if (! $validation->run($this->request->getPost(), '', true)) {
                return redirect()->back()->withInput()->with('validation', $validation);
            }

            try {
                $spreadsheet = IOFactory::load($file->getTempName());
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();

                $header = array_shift($rows);
                foreach ($rows as $row) {
                    $data = [
                        'fakultas' => $row[0],
                        'program_studi' => $row[1],
                        'tahun_akademik' => $row[2],
                        'kode_mata_kuliah' => $row[3],
                        'kelas' => $row[4],
                        'dosen' => $row[5],
                        'nim' => $row[6],
                        'nama_mahasiswa' => $row[7],
                        'nilai_uts' => $row[8],
                        'nilai_uas' => $row[9]
                    ];

                    $this->mahasiswa->insert($data);
                }
                return redirect()->to('mahasiswa')->with('success', 'Data Mahasiswa berhasil diimport.');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
        }
        return view('mahasiswa/upload');
    }

    public function hapus($id)
    {
        $data = $this->mahasiswa->find($id);
        $this->mahasiswa->delete($id);
        session()->setFlashdata('status', 'Data Mahasiswa berhasil dihapus');
        return redirect()->to(base_url('mahasiswa'))->with('status_icon', 'success')->with('status_text', 'Data Berhasil dihapus');
    }
}