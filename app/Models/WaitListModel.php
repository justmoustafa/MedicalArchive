<?php

namespace App\Models;

use CodeIgniter\Model;

class WaitListModel extends Model
{
    protected $table      = 'waitList';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = \CodeIgniter\Entity\Entity::class;
    protected $useSoftDeletes = false;

		protected $allowedFields = ['id','patientId' , 'doctorId', 'hospitalId', 'departmentId', 'receptionistId', 'date', 'confirmEntrance'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

		protected $validationRules    = [
			'hospitalId' =>'required',
			'patientId' =>'required',
			'departmentId' =>'required',
			'receptionistsId' =>'required',
			'date' =>'required|valid_date',
			'confirmEntrance' =>'required'
		];
		protected $validationMessages = [
			'required' => '{filed} is required'
		];
    protected $skipValidation     = true;
}
