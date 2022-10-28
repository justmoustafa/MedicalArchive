<?php

namespace App\Controllers;

use App\Libraries\UserLibrary;

class UserController extends BaseController 
{

    public function __construct(private UserLibrary $userLib)
    {
    }

    public function index()
    {
        echo "hello, world";
    }
    
}

