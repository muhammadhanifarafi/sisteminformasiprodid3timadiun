<?php

namespace App\Models\Sipema;

use CodeIgniter\Model;

class BidangModel extends Model
{
    protected $table            = 'sipema_bidang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['id', 'nama_bidang'];
}