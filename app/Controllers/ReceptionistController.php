<?php

namespace App\Controllers;

use App\Libraries\PatientLibrary;
use App\Libraries\ReceptionistLibrary;
use App\Libraries\WaitListLibrary;
use App\Libraries\HospitalLibrary;
use App\Libraries\DepartmentLibrary;
use App\Libraries\DepartmentHospitalLibrary;
use App\Libraries\DoctorLibrary;


class ReceptionistController extends BaseController 
{

    public function __construct(private ReceptionistLibrary $receptionistLib, private DepartmentHospitalLibrary $depHosLib ,private DoctorLibrary $doctorLib, private PatientLibrary $patientLib, private HospitalLibrary $hospitalLib, private DepartmentLibrary $departmentLib, private WaitListLibrary $waitListLib)
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
                return view('receptionistLogin', [
                    'validation' => $this->validator,
                ]);
            }
				$userExists = $this->receptionistLib->retrieve($loginData['id']);	
				if( $userExists ){
					$userData = $this->receptionistLib->getEntity()->toArray();

					if( $userData['password'] == $loginData['password'] ){
						$session = session();
						$session->set(['id' => $userData['receptionistId']]);
						$session->set(['userName' => $userData['firstName'].' '.$userData['lastName']]);
						return redirect()->to(base_url('receptionist'));
					}else{
                           $data['wrongPassword'] = 'Password is incorrect';
							return view('receptionistLogin',$data);
                        }
				}else {
                       $data['userNotExist'] = 'There is no such user';
						return view('receptionistLogin',$data);
				}
		}
		return view('receptionistLogin');
	}

	public function registeration()
	{
		if( $this->request->getMethod() == 'post'){
			    $validation = \Config\Services::validation();
				$registerationData = $this->request->getPost();
			   
				$validationRules = [
                    'patientId' =>[
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
						return view('patientRegisteration', [
							'validation' => $this->validator]);
				}else{
					if(! $this->patientLib->isExist($registerationData['patientId']))
					{
						$idImage = $this->request->getFile('idImage');
						$personalPhoto = $this->request->getFile('personalPhoto');
						if ($idImage->isValid()) {
							if($personalPhoto->isValid()){
								$idImage->store('./patients/idImages','idImage'.$registerationData['patientId']);
								$personalPhoto->store('patients/personalPhotos','personalPhoto'.$registerationData['patientId']);
								$registerationData['idImage'] = 'idImage' . $registerationData['patientId'];
								$registerationData['personalPhoto'] = 'personalPhoto' . $registerationData['patientId'];
								$this->patientLib->fillEntity($registerationData);
								$insertResult = $this->patientLib->insert();
								return redirect()->to(base_url('patientLogin'));
							}else{
								return view('patientRegisteration',['inValidPersonalPhoto' => 'this image is invalid'] );
							}
						}else{
							return view('patientRegisteration',['inValidIdImage' => 'this image is invalid'] );
						}
					}
					else
					{
						return view('patientRegisteration',['failed' => 'Registeration attempt failed, this user already exists'] );
					}
				}

		}else{

		return view('patientRegisteration');
		}
	}	

	public function receptionist(){
		if(session()->get('id') !== null){
				if($this->receptionistLib->isExist(session()->get('id'))){
					$this->receptionistLib->retrieve(session()->get('id'));	
					$receptionistData = $this->receptionistLib->getEntity();

					if( $this->request->getMethod() == 'post'){
							$formData= $this->request->getPost();
							$patientExists = $this->patientLib->retrieve($formData['patientId']);	

							if( $patientExists ){
								$patientData = $this->patientLib->getEntity();
								$waitListData['patientId'] = $patientData->patientId;
								$waitListData['date'] = date('Y-m-d H:i:s');
								
							   	$waitListData['receptionistId'] = $receptionistData->receptionistId;
							    $departmentsData = $this->departmentLib->findWhere('name', $formData['department']);	

								$waitListData['hospitalId'] = $receptionistData->hospitalId;
								$waitListData['departmentId'] = $departmentsData[0]->departmentId;
							    

								$doctors= $this->doctorLib->findWhere('departmentId',$waitListData['departmentId']); 

								$doctorId = null;
								foreach($doctors as $d){
										if($formData['doctor'] == $d->firstName.' '.$d->lastName)
												$doctorId = $d->doctorId;
								}
								$waitListData['doctorId'] = $doctorId;
								$waitListData['confirmEntrance'] = 0;
								
								$this->hospitalLib->retrieve($receptionistData->receptionistId);	
								$hospitalData = $this->hospitalLib->getEntity();


								$this->waitListLib->fillEntity($waitListData);
								$this->waitListLib->insert();
								
								return redirect()->to(base_url('receptionist'))->with('success', 'success');
							}
								return redirect()->to(base_url('receptionist'))->with('userNotExist' , 'there is no such patient ID');
					}else{
							
								$receptWaitList = $this->waitListLib->findWhere('receptionistId', session()->get('id'));

								$receptionistTable = [];

								foreach($receptWaitList as $r){
									if($r->confirmEntrance !== 1){
										$this->patientLib->retrieve($r->patientId);
										$this->doctorLib->retrieve($r->doctorId);
										$this->departmentLib->retrieve($r->departmentId);
										$patientId = [
											'patientName' => $this->patientLib->getEntity()->firstName." ".$this->patientLib->getEntity()->lastName,
								      		'departmentName' => $this->departmentLib->getEntity()->name,

											'doctorName' => $this->doctorLib->getEntity()->firstName." ".$this->doctorLib->getEntity()->lastName,
											'waitListId' => $r->id,

										];
										array_push($receptionistTable,$patientId );
								}
						}
								$depHos = $this->depHosLib->findWhere('hospitalId' ,$receptionistData->hospitalId);	
								$departmentsNames = [];	
								foreach($depHos as $dh){
										$this->departmentLib->retrieve($dh->departmentId);
										$dep = $this->departmentLib->getEntity();
										array_push($departmentsNames,$dep->name );
								}
								$depDoctors = [];

								if($this->request->isAJAX()){
										$ajaxData = $this->request->getVar();
										$departmentsData = $this->departmentLib->findWhere('name',$ajaxData['department']);
										
										$doctors= $this->doctorLib->findWhere('departmentId',$departmentsData[0]->departmentId); 


										foreach($doctors as $d){
												array_push($depDoctors,$d->firstName.' '.$d->lastName );
										}
										return json_encode($depDoctors);

								}
								
								return view('receptionist',['departmentsNames' =>$departmentsNames, 'receptionistTable'=> $receptionistTable] );
						}
				}
				return 'there is not such receptionist id';
		}
		return 'you have login first';
	}
	public function deleteFromReception(){
			if(session()->get('id') !== null){
				if($this->receptionistLib->isExist(session()->get('id'))){
					if($this->request->isAJAX()){
						$ajaxData = $this->request->getVar();
						if($this->waitListLib->delete($ajaxData['waitListId'])){
								$data = array('response' => 'success');
						
						}else{
								$data = array('response' => 'failure');
						}
						return json_encode($data);

					}
			
				}
			}	
	}
}
