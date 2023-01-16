<?php

namespace App\Controllers;

use App\Libraries\PatientLibrary;
use App\Libraries\ExaminationLibrary;
use App\Libraries\HospitalLibrary;
use App\Libraries\DoctorLibrary;
use App\Libraries\DepartmentLibrary;
use App\Libraries\WaitListLibrary;
use App\Libraries\PrescriptionLibrary;


class DoctorController extends BaseController 
{

    public function __construct(private PatientLibrary $patientLib, private WaitListLibrary $waitListLib ,private ExaminationLibrary $examLib, private HospitalLibrary $hospitalLib, private DoctorLibrary $doctorLib, private DepartmentLibrary $departmentLib, private PrescriptionLibrary $prescriptionLib )
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
                return view('doctorLogin', [
                    'validation' => $this->validator,
                ]);
            }
				$userExists = $this->doctorLib->retrieve($loginData['id']);	
				if( $userExists ){
					$userData = $this->doctorLib->getEntity()->toArray();

					if( $userData['password'] == $loginData['password'] ){
						session_unset();
						$session = session();
						$session->set(['id' => $userData['doctorId']]);
						$session->set(['userName' => $userData['firstName'].' '.$userData['lastName']]);
						return redirect()->to(base_url('doctor'));
					}else{
                           $data['wrongPassword'] = 'Password is incorrect';
							return view('doctorLogin',$data);
                        }
				}else {
                       $data['userNotExist'] = 'There is no such user';
						return view('doctorLogin',$data);
				}
		}
		return view('doctorLogin');
	}

	public function registeration()
	{
			helper(['form']);

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

	public function doctor(){
			if(session()->get('id') !== null){
				if($this->doctorLib->isExist(session()->get('id'))){
						if( $this->request->getMethod() == 'post'){
								$formData= $this->request->getPost();
								$this->waitListLib->retrieve($formData['waitListId']);
								$wlEntity = $this->waitListLib->getEntity();
								$examTable['hospitalId'] = $wlEntity->hospitalId;  
								$examTable['departmentId'] = $wlEntity->departmentId;  
								$examTable['patientId'] = $wlEntity->patientId;  
								$examTable['doctorId'] = session()->get('id');  
								$examTable['examDate'] = date('Y-m-d H:i:s');
								$examId = $this->examLib->getLastInsertionID();
								$examTable['examId'] = $examId + 1;
								$this->examLib->fillEntity($examTable);
								$this->examLib->insert();
								$examId = $this->examLib->getLastInsertionID();
								return $examId;
								/*
								 * in examinations table make primary key auto increament
								 * */
						}
						$this->doctorLib->retrieve(session()->get('id'));
	
						$exams = $this->waitListLib->findWhere('departmentId',$this->doctorLib->getEntity()->departmentId);
						$doctorTable = [];
						foreach($exams as $exam){
							if($exam->confirmEntrance == 1){
									$this->patientLib->retrieve($exam->patientId);
									$exam->patientId = [
										'patientName' => $this->patientLib->getEntity()->firstName." ".$this->patientLib->getEntity()->lastName,
										'patientAge' => $this->patientLib->getEntity()->age,
										'waitListId' => $exam->id
									];
									array_push($doctorTable, $exam->patientId);
							}
						}
						
						return view('doctor',['doctorTable' => $doctorTable]);
				}
				return 'there is no such doctor id';
			}
			return 'you have to login first';
		}
}
