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
					if( $this->request->getMethod() == 'post'){
							$formData= $this->request->getPost();
							$patientExists = $this->patientLib->retrieve($formData['patientId']);	
							if( $patientExists ){
								$patientData = $this->patientLib->getEntity();
								$waitListData['patientId'] = $patientData->patientId;
								$waitListData['date'] = date('Y-m-d H:i:s');
								
							    $this->receptionistLib->retrieve(session()->get('id'));	
								$receptionistData = $this->receptionistLib->getEntity();
								$waitListData['receptionistId'] = $receptionistData->receptionistId;

							    $departmentData = $this->departmentLib->findWhere('name', $formData['department']);	
								$waitListData['hospitalId'] = $receptionistData->hospitalId;
								$waitListData['departmentId'] = $departmentData[0]->departmentId;
							    $depHos = $this->depHosLib->findWhere('hospitalId' ,$receptionistData->hospitalId);	
								foreach($depHos as $id){
									
								}

							    $this->doctorLib->retrieve($formData['patientId']);	
								$doctorData = $this->doctorLib->getEntity();
								
								$this->hospitalLib->retrieve($receptionistData->receptionistId);	
								$hospitalData = $this->hospitalLib->getEntity();

/*								$tableData[$waitListData['patientId']] =[
										'patientName'=> $patientData->firstName.' '.$patientData->lastName,
										'departmentName' => $doctorData->name,
										'doctorName' => $this->doctorData->firstName.' '.$patientData->lastName,
								];
*/
								$this->waitListLib->fillEntity($waitListData);
								$this->waitListLib->insert();
							}
							return view('receptionist');
					}else{
							return view('receptionist');
						}
				}
				return 'there is not such receptionist id';
		}
		return 'you have login first';
	}
}
