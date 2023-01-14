<?php

namespace App\Controllers;

use App\Libraries\UserLibrary;

class MasterController extends BaseController 
{

    public function __construct()
    {
			$this->request = service('request');
    }

    public function index()
    {
		return view('index');
	}
  
	public function logout(){
			session()->destroy();
			return redirect()->to(base_url('/'));
	}   
}

