<?php

namespace App\Controllers;

use App\Libraries\PatientLibrary;
use App\Libraries\ExaminationLibrary;
use App\Libraries\DoctorLibrary;
use App\Libraries\PrescriptionLibrary;
use App\Libraries\PharmacistLibrary;


class PharmacistController extends BaseController 
{

    public function __construct(private PharmacistLibrary $pharmacistLib, private PatientLibrary $patientLib, private ExaminationLibrary $examLib, private DoctorLibrary $doctorLib, private PrescriptionLibrary $prescriptionLib )
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
                return view('pharmacistLogin', [
                    'validation' => $this->validator,
                ]);
            }
				$userExists = $this->pharmacistLib->retrieve($loginData['id']);	
				if( $userExists ){
					$userData = $this->pharmacistLib->getEntity()->toArray();

					if( $userData['password'] == $loginData['password'] ){
						$session = session();
						$session->set(['id' => $userData['pharmacistId']]);
						$session->set(['userName' => $userData['firstName'].' '.$userData['lastName']]);
						return redirect()->to(base_url('pharmacist'));
					}else{
                           $data['wrongPassword'] = 'Password is incorrect';
							return view('pharmacistLogin',$data);
                        }
				}else {
                       $data['userNotExist'] = 'There is no such pharmacist exist';
						return view('pharmacistLogin',$data);
				}
		}
		return view('pharmacistLogin');
	}

	public function registeration()
	{
			helper(['form']);

		if( $this->request->getMethod() == 'post'){
			    $validation = \Config\Services::validation();
				$registerationData = $this->request->getPost();
			   
				$validationRules = [
                    'pharmacistId' =>[
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
						return view('pharmacistRegisteration', [
							'validation' => $this->validator]);
				}else{
					if(! $this->pharmacistLib->isExist($registerationData['pharmacistId']))
					{
						$idImage = $this->request->getFile('idImage');
						$personalPhoto = $this->request->getFile('personalPhoto');
						$professionLicense= $this->request->getFile('professionLicense');
						if ($idImage->isValid()) {
							if($personalPhoto->isValid()){
									if($professionLicense->isValid()){
												$idImage->store('pharmacists/idImages','idImage'.$registerationData['pharmacistId']);
												$personalPhoto->store('pharmacists/personalPhotos','personalPhoto'.$registerationData['pharmacistId']);
												$professionLicense->store('pharmacists/professionLicense','professionLicense'.$registerationData['pharmacistId']);
												$registerationData['idImage'] = 'idImage' . $registerationData['pharmacistId'];
												$registerationData['personalPhoto'] = 'personalPhoto' . $registerationData['pharmacistId'];
												$this->pharmacistLib->fillEntity($registerationData);
												$insertResult = $this->pharmacistLib->insert();
												return redirect()->to(base_url('pharmacistLogin'));
									}else{
												return view('pharmacistRegisteration',['inValidProfessoinLicense' => 'this image is invalid'] );
									}
							}else{
								return view('pharmacistRegisteration',['inValidPersonalPhoto' => 'this image is invalid'] );
							}
						}else{
							return view('pharmacistRegisteration',['inValidIdImage' => 'this image is invalid'] );
						}
					}
					else
					{
						return view('pharmacistRegisteration',['failed' => 'Registeration attempt failed, this user already exists'] );
					}
				}

		}else{

		return view('pharmacistRegisteration');
		}
	}	


	public function pharmacist(){

			if(session()->get('id') !== null){
				if($this->pharmacistLib->isExist(session()->get('id'))){
						if( $this->request->getMethod() == 'post'){
								$formData= $this->request->getPost();
								$examExists = $this->examLib->retrieve($formData['examId']);
								if($examExists){
										$exam = $this->examLib->getEntity();
										$this->patientLib->retrieve( $exam->patientId);
										$this->doctorLib->retrieve( $exam->doctorId );
										$prescriptions =  $this->prescriptionLib->retrieveWhere('examId', $exam->examId );

										$data[$exam->examId] = [
												'doctorName' => $this->doctorLib->getEntity()->firstName.' '.$this->doctorLib->getEntity()->lastName,
												'patientName' => $this->patientLib->getEntity()->firstName.' '.$this->patientLib->getEntity()->lastName,
												'patientAge' => $this->patientLib->getEntity()->age,
												'date' => $exam->examDate,
												'prescriptions' =>[] 
											];
										foreach( $prescriptions as $prescription){
												$data[$exam->examId]['prescriptions']+= [
															$prescription->prescriptionId => [
																		'prescriptionName' => $prescription->name ,
																		'prescriptionDose' => $prescription->dose,
																		'prescriptionNotes' => $prescription->notes
														]
													];
												
									}
								return view('pharmacist',['data' => $data]);
								}
								return view('pharmacist', ['error' => 'there is no such exam ID']);
						}else{
							return view('pharmacist');
							}
				}
					return 'there is not such pharmacist id';
			}
			return 'you have to login first';
 }
}
