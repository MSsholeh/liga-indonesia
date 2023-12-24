<?php

namespace App\Models;

use CodeIgniter\Model;

class ClubModel extends Model
{
    protected $table      = 'clubs';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
	protected $deletedField  = 'deleted_at';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['name', 'photo', 'slug', 'created_at', 'updated_at', 'deleted_at'];
}
