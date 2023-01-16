<?php

namespace App\Controllers;

use App\Libraries\AdminLibrary;
use App\Libraries\DoctorLibrary;
use App\Libraries\DepartmentLibrary;
use App\Libraries\PharmacistLibrary;
use App\Libraries\ReceptionistLibrary;
use App\Libraries\NurseLibrary;
use App\Libraries\ApprovingLibrary;


class AdminController extends BaseController 
{

    public function __construct(private AdminLibrary $adminLib, private DoctorLibrary $doctorLib, private PharmacistLibrary $pharmacistLib, private ReceptionistLibrary $receptionistLib, private NurseLibrary $nurseLib, private ApprovingLibrary $approvingLib, private DepartmentLibrary $departmentLib)
    {
			$this->request = service('request');
    }

	public function login(){

		if( $this->request->getMethod() == 'post'){
			    $validation = \Config\Services::validation();
				$loginData = $this->request->getPost();
			   
				$validationRules = [
                    'id' =>[
                        'rules' =>'required',
                        'errors' =>[
                                'required' => 'Nationl ID is required',
                        ]
                    ],
                    'password'=>[
                        'rules'=>'required',
                        'errors'=>[
                                'required' => 'Password is required',
                        ]
                    ]
				];

				if (! $this->validate($validationRules)) {
                return view('adminLogin', [
                    'validation' => $this->validator,
                ]);
            }
				$userExists = $this->adminLib->retrieve($loginData['id']);	
				if( $userExists ){
					$userData = $this->adminLib->getEntity()->toArray();

					if( $userData['password'] == $loginData['password'] ){
						session_unset();
						$session = session();
						$session->set(['id' => $userData['adminId']]);
						$session->set(['userName' => $userData['firstName'].' '.$userData['lastName']]);
						return redirect()->to(base_url('admin'));
					}else{
                           $data['wrongPassword'] = 'Password is incorrect';
							return view('adminLogin',$data);
                        }
				}else {
                       $data['userNotExist'] = 'There is no such user';
						return view('adminLogin',$data);
				}
		}
		return view('adminLogin');
	}
	public function admin(){
			if(session()->get('id') !== null){
				if($this->adminLib->isExist(session()->get('id'))){
						if( $this->request->getMethod() == 'post'){
								if($this->request->isAJAX()){
										$ajaxData = $this->request->getVar();
										if(isset($ajaxData['approvedId'])){
											$this->approvingLib->retrieve($ajaxData['approvedId']);
											$joinRequest = $this->approvingLib->getEntity()->toArray();
											$done = false;
											switch ($joinRequest['position']) {
													case 'doctor':
														$joinRequest['doctorId'] = $joinRequest['id'];
														$this->doctorLib->fillEntity($joinRequest);
														$this->doctorLib->insert();
														$done = true;
														break;
													case 'pharmacist':
														$joinRequest['pharmacistId'] = $joinRequest['id'];
														$this->pharmacistLib->fillEntity($joinRequest);
														$this->pharmacistLib->insert();
														$done = true;
														break;
													case 'nurse':
														$joinRequest['nurseId'] = $joinRequest['id'];
														$this->nurseLib->fillEntity($joinRequest);
														$this->nurseLib->insert();
														$done = true;
														break;
													case 'receptionist':
														$joinRequest['receptionistId'] = $joinRequest['id'];
														$this->receptionistLib->fillEntity($joinRequest);
														$this->receptionistLib->insert();
														$done = true;
														break;
												}
											if($done){
												$this->approvingLib->delete($ajaxData['approvedId']);
												$data = array('response' => 'success');
												
											}else{
												$data = array('response' => 'failure');
											}
											
										}
										else if(isset($ajaxData['deletedId'])){
												$this->approvingLib->delete($ajaxData['deletedId']);
												$data = array('response' => 'success');
										
										}else{
											
												$data = array('response' => 'failure');
										}
										return json_encode($data);
									}		


						}
					$this->adminLib->retrieve(session()->get('id'));
					$joinRequests = $this->approvingLib->findWhere('hospitalId',$this->adminLib->getEntity()->hospitalId);
					$adminTable = [];
					foreach($joinRequests as $jr){
						$this->departmentLib->retrieve($jr->departmentId);
						$jr->id = [
								'position' => $jr->position,
								'name' => $jr->firstName.' '.$jr->lastName,
								'id' => $jr->id,
								'departmentName' => $this->departmentLib->getEntity()->name
						];
						array_push($adminTable, $jr->id);
					}
					return view('admin',['adminTable' => $adminTable]);
				}
				return 'there is no such admin id';
			}
			return 'you have to login first';
		}
}
