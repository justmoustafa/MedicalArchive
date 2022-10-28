<?php

namespace App\Models;

use CodeIgniter\Model;

class DoctorModel extends Model
{
    protected $table      = 'doctors';
    protected $primaryKey = 'doctorId';

    protected $useAutoIncrement = false;

    protected $returnType     = \CodeIgniter\Entity\Entity::class;

    protected $useSoftDeletes = false;

		protected $allowedFields = ['firstName', 'lastName', 'email', 'phone', 'dateOfBirth', 'address', 'doctorId'
			
			                          , 'image', 'idImage', 'password','specialization','goodStanding','professionLicense','departmentId','hospitalId'];

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
			'specialization' =>'required',
			'professionLicense' =>'required',
			'departmentId' =>'required',
			'hospitalId' =>'required',
			'goodStanding' =>'required',
			'password' => 'required|max_length[255]|min_length[8]',
			
		];
		protected $validationMessages = [
			'min_length' => 'Your password is too short. You want to get hacked?',
			'max_length' => 'maximum length for {filed} is 255',
			'required' => '{filed} is required'
		];
    protected $skipValidation     = true;
}
