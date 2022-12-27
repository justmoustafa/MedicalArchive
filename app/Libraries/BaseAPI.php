<?php

namespace App\Libraries;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

abstract class BaseAPI extends ResourceController
{
    protected $modelName = '';
    protected $format    = 'json';

    public function index()
	{
		return	$this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        if(!$id == null && $this->model->find($id)) return $this->respond($this->model->find($id), 200);

        return $this->failNotFound('specified id does not exist');
    }

    public function create()
    {
        $data = $this->request->getPost();

        if($this->model->find($data['id'])) return $this->failResourceExists('this user already exists');


        $insertResult = $this->model->insert($data);

        if($this->model->errors())
        {
            return $this->fail($this->model->errors());
        }
        else if($insertResult === false)
        {
            return $this->failServerError();
        }
        return $this->respondCreated();
    }

    public function update($id = null)
    {
        $data = $this->request->getPost();

        if($this->model->find($id)) return $this->failResourceExists('this user does not exist');

        $insertResult = $this->model->update($id ,$data);

        if($this->model->errors())
        {
            return $this->fail($this->model->errors());
        }
        else if($insertResult === false)
        {
            return $this->failServerError();
        }
        return $this->respondCreated();
    }

    public function delete($id = null)
    {

        if(! $this->model->find($id)) return $this->failResourceExists('this user does not exist');

        $insertResult = $this->model->delete($id);

        if($this->model->errors())
        {
            return $this->fail($this->model->errors());
        }
        else if($insertResult === false)
        {
            return $this->failServerError();
        }
        $this->respondDeleted($data);
    }

}
