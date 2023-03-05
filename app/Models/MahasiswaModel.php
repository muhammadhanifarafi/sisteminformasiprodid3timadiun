<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table            = 'sipema_mahasiswa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields    = ['id_mahasiswa', 'nim', 'nama_mahasiswa', 'kelas', 'ttl', 'no_telp', 'angkatan', 'alamat', 'status'];

    public function uploadExcel($file)
    {
      $this->load->library('excel');
    
      $objPHPExcel = PHPExcel_IOFactory::load($file);
    
      $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
    
      foreach ($cell_collection as $cell) {
          $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
          $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
          $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
    
          if ($row == 1) {
              $header[$row][$column] = $data_value;
          } else {
              $arr_data[$row][$column] = $data_value;
          }
      }
    
      $data = [];
      foreach ($arr_data as $row) {
          $fakultas = $row['A'];
          $prodi = $row['B'];
          $tahun_akademik = $row['C'];
          $kode_mata_kuliah = $row['D'];
          $kelas = $row['E'];
          $dosen = $row['F'];
          $nim = $row['G'];
          $nama = $row['H'];
          $nilai_uts = $row['I'];
          $nilai_uas = $row['J'];
    
          $data[] = [
              'fakultas' => $fakultas,
              'prodi' => $prodi,
              'tahun_akademik' => $tahun_akademik,
              'kode_mata_kuliah' => $kode_mata_kuliah,
              'kelas' => $kelas,
              'dosen' => $dosen,
              'nim' => $nim,
              'nama' => $nama,
              'nilai_uts' => $nilai_uts,
              'nilai_uas' => $nilai_uas
          ];
      }
    
      return $data;
    }
    
    public function saveDataExcel($data)
    {
      $this->db->trans_start();
      $this->db->insert_batch('mahasiswa', $data);
      $this->db->trans_complete();
    }
    
}