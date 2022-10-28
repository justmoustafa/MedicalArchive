<?php

namespace App\Models;

use CodeIgniter\Model;

class WaitingListModel extends Model
{
    protected $table      = 'WaitList';
    protected $primaryKey = '';

    protected $useAutoIncrement = false;

    protected $returnType     = \CodeIgniter\Entity\Entity::class;
    protected $useSoftDeletes = false;

		protected $allowedFields = ['patientId', 'hospitalId', 'departmentId', 'receptionistsId', 'date', 'confirmEntrance'];

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
