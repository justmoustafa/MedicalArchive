<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'admin';
		protected $primaryKey = 'adminId';

		protected $useAutoIncrement = false;

    protected $returnType     = \CodeIgniter\Entity\Entity::class;
    protected $useSoftDeletes = false;

		protected $allowedFields = ['adminId', 'firstName', 'lastName', 'email', 'phone', 'dateOfBirth', 'address'
			
			                          , 'image', 'idImage', 'password','position'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

		protected $validationRules    = [
			'firstName' => 'required|max_length[32]',
			'lastName' => 'required|max_length[32]',
			'patientId' => 'required|max_length[16]',
			'phone' => 'required|max_length[16]',
			'email' => 'required|max_length[255]|valid_email',
			'dateOfBirth' => 'required|valid_date',
			'address' => 'required|max_length[255',
			'image' => 'required|max_length[255]',
			'idImage' => 'required|max_length[255]',
			'position' =>'required',
			'password' => 'required|max_length[255]|min_length[8]',
			
		];
		protected $validationMessages = [
			'min_length' => 'Your password is too short. You want to get hacked?',
			'max_length' => 'maximum length for {filed} is 255',
			'required' => '{filed} is required'
		];
    protected $skipValidation     = true;

}
