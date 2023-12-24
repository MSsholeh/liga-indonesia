<?php

namespace App\Models;

use CodeIgniter\Model;

class PlayerModel extends Model
{
    protected $table      = 'palyers';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
	protected $deletedField  = 'deleted_at';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['club_id','name', 'photo', 'birth_date', 'back_number', 'position', 'country', 'slug', 'created_at', 'updated_at', 'deleted_at'];

    public function getPlayer()
    {
         return $this->db->table('palyers')->select('palyers.*,clubs.name as club_name')->join('clubs','clubs.id=palyers.club_id')->where('palyers.deleted_at', NULL)->orderBy('palyers.created_at', 'DESC')->get()->getResultArray();
    }
}
