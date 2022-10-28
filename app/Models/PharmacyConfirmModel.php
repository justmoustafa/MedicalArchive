<?php

namespace App\Models;

use CodeIgniter\Model;

class PharmacyConfirmModel extends Model
{
    protected $table      = 'PharmacyConfirm';
    protected $primaryKey = 'confirmationId';

    protected $useAutoIncrement = false;

    protected $returnType     = \CodeIgniter\Entity\Entity::class;
    protected $useSoftDeletes = false;

		protected $allowedFields = ['pharmacistsId', 'confirmDate', 'note', 'examId'];
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

		protected $validationRules    = [
			'pharmacistsId' =>'required',
			'confirmDate' =>'required|valid_date',
			'examId' =>'required',
		];
		protected $validationMessages = [
			'required' => '{filed} is required'
		];
    protected $skipValidation     = true;
}
