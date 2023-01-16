<?php

namespace App\Libraries;

use App\Models\NurseModel;

use CodeIgniter\Entity\Entity;

class NurseLibrary  
{

    public function __construct(private NurseModel $Model, private Entity $Entity )
    {
    }

    public function index()
    {
    }
    public function insert():bool
    {
        return $this->Model->save($this->Entity);
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
    public function isExist($userId)
	{
     return  $this->Model->find($userId);
    }


	public function findWhere($columnName, $value)
	{
		return $this->Model->where($columnName, $value)->findAll();
	}
	
	public function update($userId)
    {
        return $this->Model->save($this->Entity); 
    }

    public function delete($userId):bool
    {
        if($this->Model->find($userId))
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
	 public function fillEntity($data)
    {
        return $this->Entity->fill($data);
    }

}
