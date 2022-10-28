<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartmentModel extends Model
{
    protected $table      = 'departments';
    protected $primaryKey = 'departmentId';

    protected $useAutoIncrement = false;

    protected $returnType     = \CodeIgniter\Entity\Entity::class;
    protected $useSoftDeletes = false;

		protected $allowedFields = ['hospitalId', 'departmentId', 'name'];
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

		protected $validationRules    = [
			'hospitalId' =>'required',
			'departmentId' =>'required',
			'name' =>'required',
		];
		protected $validationMessages = [
			'required' => '{filed} is required'
		];
    protected $skipValidation     = true;
}
