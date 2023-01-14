<?php

namespace App\Libraries;

use App\Models\ExaminationModel;

use CodeIgniter\Entity\Entity;

class ExaminationLibrary  
{

    public function __construct(private ExaminationModel $Model, private Entity $Entity )
    {
    }

    public function index()
    {
    }
    public function insert():bool
    {
        return $this->Model->save($this->Entity);
    }

	public function retrieveWhere($columnName, $value)
	{
		return $this->Model->where($columnName, $value)->findAll();
	}

    public function retrieve($userId):bool
    {
        if($this->Model->find($userId))
        {
            $this->Entity = $this->Model->find($userId);
			return true;
        }

        return false;
    }

    public function update($userId):bool
    {
        if($this->Model->find($userId)=== $this->Entity)
        {
            return $this->Model->update($userId, $this->Entity); 
        }
        return false;
    }

    public function delete($userId):bool
    {
        if($this->Model->find($userId) != null)
        {
            return  $this->Model->delete($userId);
        }
        return false;
    }

    public function getEntity():Entity
    {
        return $this->Entity;
    }

    public function setEntity(Entity $entity):bool
    {
        return $this->Entity = $entity;
    }
}
