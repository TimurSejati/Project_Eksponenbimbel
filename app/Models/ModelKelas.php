<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKelas extends Model
{
    protected $table      = 'kelas';
    protected $primaryKey = 'id';

    protected $allowedFields = ['kategori_id', 'kelas'];
}
