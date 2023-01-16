<?php

namespace App\Controllers;

use App\Libraries\PatientLibrary;
use App\Libraries\HospitalLibrary;
use App\Libraries\DoctorLibrary;
use App\Libraries\DepartmentLibrary;
use App\Libraries\NurseLibrary;
use App\Libraries\WaitListLibrary;


class NurseController extends BaseController 
{

    public function __construct(private NurseLibrary $nurseLib, private PatientLibrary $patientLib, private WaitListLibrary $waitListLib, private DoctorLibrary $doctorLib, private DepartmentLibrary $departmentLib, private HospitalLibrary $hospitalLib)
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
                return view('nurseLogin', [
                    'validation' => $this->validator,
                ]);
				}
				$userExists = $this->nurseLib->retrieve($loginData['id']);	
				if( $userExists ){
					$userData = $this->nurseLib->getEntity()->toArray();

					if( $userData['password'] == $loginData['password'] ){
						session_unset();
						$session = session();
						$session->set(['id' => $userData['nurseId']]);
						$session->set(['userName' => $userData['firstName'].' '.$userData['lastName']]);
						return redirect()->to(base_url('nurse'));
					}else{
                           $data['wrongPassword'] = 'Password is incorrect';
							return view('nurseLogin',$data);
                        }
				}else {
                       $data['userNotExist'] = 'There is no such nurse ID';
						return view('nurseLogin',$data);
				}
		}
		return view('nurseLogin');
	}

	public function registeration()
	{
			helper(['form']);

		if( $this->request->getMethod() == 'post'){
			    $validation = \Config\Services::validation();
				$registerationData = $this->request->getPost();
			   
				$validationRules = [
                    'nurseId' =>[
                        'rules' =>'required|exact_length[14]',
                        'errors' =>[
                                'required' => 'Nationl ID is required',
                                'exact_length' => 'Nationl ID must be of length 14',
                        ]
                    ],
				    'firstName' =>[
                        'rules' =>'required',
                        'errors' =>[
                                'required' => 'first name is required',
                        ]
                    ],
				    'lastName' =>[
                        'rules' =>'required',
                        'errors' =>[
                                'required' => 'last name is required',
                        ]
                    ],
				    'phone' =>[
                        'rules' =>'required',
                        'errors' =>[
                                'required' => 'phone is required',
                        ]
                    ],
					'address' =>[
                        'rules' =>'required',
                        'errors' =>[
                                'required' => 'address is required',
                        ]
					],
				    'password'=>[
                        'rules'=>'required',
                        'errors'=>[
                                'required' => 'Password is required',
                        ]
					],
					'confirmPassword'=>[
                        'rules'=>'required|matches[password]',
                        'errors'=>[
                                'required' => 'confirm Password is required',
                                'matches' => 'confirm Password must match password',
                        ]
                    ]
				];

				if (! $this->validate($validationRules)) {
						return view('nurseRegisteration', [
							'validation' => $this->validator]);
				}else{
					if(! $this->nurseLib->isExist($registerationData['nurseId']))
					{
						$idImage = $this->request->getFile('idImage');
						$personalPhoto = $this->request->getFile('personalPhoto');
						$professionLicense= $this->request->getFile('professionLicense');
						if ($idImage->isValid()) {
							if($personalPhoto->isValid()){
									if($professionLicense->isValid()){
												$idImage->store('nurses/idImages','idImage'.$registerationData['nurseId']);
												$personalPhoto->store('nurses/personalPhotos','personalPhoto'.$registerationData['nurseId']);
												$professionLicense->store('nurses/professionLicense','professionLicense'.$registerationData['nurseId']);
												$registerationData['idImage'] = 'idImage' . $registerationData['nurseId'];
												$registerationData['personalPhoto'] = 'personalPhoto' . $registerationData['nurseId'];
												$registerationData['professionLicense'] = 'professionLicense' . $registerationData['nurseId'];
												$this->nurseLib->fillEntity($registerationData);
												$insertResult = $this->nurseLib->insert();
												return redirect()->to(base_url('nurseLogin'));
									}else{
												return view('nurseRegisteration',['inValidProfessoinLicense' => 'this image is invalid'] );
									}
							}else{
								return view('nurseRegisteration',['inValidPersonalPhoto' => 'this image is invalid'] );
							}
						}else{
							return view('nurseRegisteration',['inValidIdImage' => 'this image is invalid'] );
						}
					}
					else
					{
						return view('nurseRegisteration',['failed' => 'Registeration attempt failed, this user already exists'] );
					}
				}

		}else{

		return view('nurseRegisteration');
		}
	}	


	public function nurse(){

			if(session()->get('id') !== null){
				if($this->nurseLib->isExist(session()->get('id'))){
					
								$this->nurseLib->retrieve(session()->get('id'));
								$waitList = $this->waitListLib->findWhere('departmentId',$this->nurseLib->getEntity()->departmentId );

								$nurseTable = [];

								foreach($waitList as $r){
									if($r->confirmEntrance != 1){
										$this->patientLib->retrieve($r->patientId);
										$this->doctorLib->retrieve($r->doctorId);
										$this->departmentLib->retrieve($r->departmentId);
										$r->id= [
											'patientName' => $this->patientLib->getEntity()->firstName." ".$this->patientLib->getEntity()->lastName,
								      		'departmentName' => $this->departmentLib->getEntity()->name,

											'doctorName' => $this->doctorLib->getEntity()->firstName." ".$this->doctorLib->getEntity()->lastName,
											'waitListId' => $r->id,];

										array_push($nurseTable,$r->id );
										}
								}
						if($this->request->isAJAX()){
								$ajaxData = $this->request->getVar();
								if(isset($ajaxData['waitListIdDone'])){
									$this->waitListLib->retrieve($ajaxData['waitListIdDone']);
									$waitListRow = $this->waitListLib->getEntity()->toArray();
									$waitListRow['confirmEntrance'] = '1';
									$this->waitListLib->fillEntity($waitListRow);	
									if($this->waitListLib->insert()){
										$data = array('response' => 'success');
										
									}else{
										$data = array('response' => 'failure');
									}
								return json_encode($data);
									
								}else if(isset($ajaxData['waitListIdAbsent'])){
										if(count($nurseTable) <= 5){
											$temp = $nurseTable[0];
											unset($nurseTable[0]);
											array_push($nurseTable, $temp);
											return json_encode($nurseTable);
										}	
							
								}
							}
					return view('nurse',['nurseTable' =>$nurseTable]);
				}else{
					return 'there is not such nurse id';
				}
				 }
			return 'you have to login first';
}

}
