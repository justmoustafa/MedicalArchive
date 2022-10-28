<?php

namespace App\Models;

use CodeIgniter\Model;

class ExaminationModel extends Model
{
    protected $table      = 'Examination';
    protected $primaryKey = 'examId';

    protected $useAutoIncrement = false;

    protected $returnType     = \CodeIgniter\Entity\Entity::class;
    protected $useSoftDeletes = false;

		protected $allowedFields = ['examId', 'patientId', 'doctorId', 'hospitalId', 'departmentId', 'examDate', 'prescription', 'note'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

		protected $validationRules    = [
			'hospitalId' =>'required',
			'patientId' =>'required',
			'doctorId' =>'required',
			'departmentId' =>'required',
			'examDate' =>'required|valid_date',
			'prescription' =>'required'
		];
		protected $validationMessages = [
			'required' => '{filed} is required'
		];
    protected $skipValidation     = true;
}
