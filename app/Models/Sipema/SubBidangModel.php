<?php

namespace App\Models\Sipema;

use CodeIgniter\Model;

class SubBidangModel extends Model
{
    protected $table            = 'sipema_sub_bidang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['id', 'nama_sub_bidang', 'id_bidang'];

    function getSubBidangandBidang()
    {
        $builder = $this->db->table('sipema_sub_bidang');
        $builder->join('sipema_bidang', 'sipema_bidang.id_bidang = sipema_sub_bidang.id_bidang');
        $query = $builder->get();
        return $query->getResult();
    }
}