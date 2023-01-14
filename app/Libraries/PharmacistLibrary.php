<?php

namespace App\Libraries;

use App\Models\PharmacistModel;

use CodeIgniter\Entity\Entity;

class PharmacistLibrary  
{

    public function __construct(private PharmacistModel $Model, private Entity $Entity )
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
    public function isExist($userId):bool
	{
        if($this->Model->find($userId))
        {
			return true;
        }
        return false;
    }


	public function findWhere($columnName, $value)
	{
		return $this->Model->where($columnName, $value)->findAll();
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
