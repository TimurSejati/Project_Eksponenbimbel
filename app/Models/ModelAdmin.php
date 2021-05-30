<?php

namespace App\Models;

use CodeIgniter\Model;


class ModelAdmin extends Model
{
    protected $table      = 'admin';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nama', 'username', 'password'];


    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function get_data_login($username, $table)
    {
        $builder = $this->db->table($table);
        $builder->where('username', $username);
        $get = $builder->get()->getRow();
        return $get;
    }
}
