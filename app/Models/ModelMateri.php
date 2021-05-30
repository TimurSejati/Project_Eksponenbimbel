<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMateri extends Model
{
    protected $table = 'materi';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'judul_materi', 'slug', 'prolog_materi', 'artikel_materi', 'kategori_id', 'kelas_id', 'gambar', 'file'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function search($keyword)
    {
        return $this->table('materi')->like('judul_materi', $keyword)->get()->getResult();
    }
}
