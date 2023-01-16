<?php

namespace App\Controllers;

use App\Libraries\PatientLibrary;
use App\Libraries\ExaminationLibrary;
use App\Libraries\HospitalLibrary;
use App\Libraries\DoctorLibrary;
use App\Libraries\DepartmentLibrary;
use App\Libraries\PrescriptionLibrary;


class PatientController extends BaseController 
{

    public function __construct(private PatientLibrary $patientLib, private ExaminationLibrary $examLib, private HospitalLibrary $hospitalLib, private DoctorLibrary $doctorLib, private DepartmentLibrary $departmentLib, private PrescriptionLibrary $prescriptionLib )
    {
			$this->request = service('request');
    }

    public function index()
    {
		return view('index');
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
                return view('patientLogin', [
                    'validation' => $this->validator,
                ]);
            }
				$userExists = $this->patientLib->retrieve($loginData['id']);	
				if( $userExists ){
					$userData = $this->patientLib->getEntity()->toArray();

					if( $userData['password'] == $loginData['password'] ){
						$session = session();
						$session->set(['id' => $userData['patientId']]);
						$session->set(['userName' => $userData['firstName'].' '.$userData['lastName']]);
						return redirect()->to(base_url('patient'));
					}else{
                           $data['wrongPassword'] = 'Password is incorrect';
							return view('patientLogin',$data);
                        }
				}else {
                       $data['userNotExist'] = 'There is no such user';
						return view('patientLogin',$data);
				}
		}
		return view('patientLogin');
	}

	public function registeration()
	{
			helper(['form']);

		if( $this->request->getMethod() == 'post'){
			    $validation = \Config\Services::validation();
				$registerationData = $this->request->getPost();
			   	
				if( $this->approvingLib->isExist($registerationData['nurseId']) == null){	
					return view('nurseRegisteration',['registBefore' => 'This user has registered before'] );
				}


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

	public function patient(){


		$exams = $this->examLib->retrieveWhere('patientId',session()->get('id'));

		if(count($exams) > 0){
				foreach( $exams as $exam ){
						$this->hospitalLib->retrieve( $exam->hospitalId );
						$this->doctorLib->retrieve( $exam->doctorId );
						$this->departmentLib->retrieve( $exam->departmentId );
						$prescriptions =  $this->prescriptionLib->retrieveWhere('examId', $exam->examId );

						$data[$exam->examId] = [
								'hospitalName' => $this->hospitalLib->getEntity()->name,
								'doctorName' => $this->doctorLib->getEntity()->firstName.' '.$this->doctorLib->getEntity()->lastName,
								'departmentName' => $this->departmentLib->getEntity()->name,
								'date' => $exam->examDate,
								'prescriptions' =>[] 
							];
						foreach( $prescriptions as $prescription){
								$data[$exam->examId]['prescriptions']+= [
											$prescription->prescriptionId => [
														'prescriptionName' => $prescription->name ,
														'prescriptionNotes' => $prescription->notes
										]
									];
								
						}
				}
				return view('patient',['data' => $data]);
			}
				return view('index');
    
		}
}
