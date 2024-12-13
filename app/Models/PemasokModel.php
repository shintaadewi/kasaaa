<?php

namespace App\Models;

use CodeIgniter\Model;

class PemasokModel extends Model
{
    protected $table = 'pemasok';
    protected $primaryKey = 'id_pemasok';
    protected $allowedFields = ['nama_pemasok', 'kontak', 'alamat'];
}
