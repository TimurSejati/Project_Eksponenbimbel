<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMateri extends Model
{
    protected $table      = 'materi';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'judul_materi', 'slug', 'prolog_materi', 'kategori_id', 'kelas_id', 'gambar', 'file'];
}
