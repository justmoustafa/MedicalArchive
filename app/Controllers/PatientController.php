<?php

namespace App\Controllers;

use App\Libraries\UserLibrary;

class PatientController extends BaseController 
{

    public function __construct(private UserLibrary $userLib)
    {
    }

    public function index()
    {
$this->userLib->retrieve(1);
echo '<pre>';
		var_dump($this->userLib->getEntity());
echo '</pre>';
	}
    
}

