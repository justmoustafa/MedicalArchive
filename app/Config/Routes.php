<?php

namespace Config;
use App\Libraries\Container;
use App\Controllers\MasterController;
use App\Controllers\AdminController;
use App\Controllers\PatientController;
use App\Controllers\ReceptionistController;
use App\Controllers\PharmacistController;
use App\Controllers\NurseController;
use App\Controllers\DoctorController;
use App\Models\PatientModel;
use App\Models\AdminModel;
use App\Models\NurseModel;
use App\Models\ReceptionistModel;
use App\Models\ApprovingModel;
use App\Models\WaitListModel;
use App\Models\PharmacistModel;
use App\Models\ExaminationModel;
use App\Models\DoctorModel;
use App\Models\DepartmentModel;
use App\Models\DepartmentHospitalModel;
use App\Models\PrescriptionModel;
use App\Models\HospitalModel;
use CodeIgniter\Entity\Entity;
use App\Libraries\PatientLibrary;
use App\Libraries\AdminLibrary;
use App\Libraries\ReceptionistLibrary;
use App\Libraries\ExaminationLibrary;
use App\Libraries\HospitalLibrary;
use App\Libraries\DoctorLibrary;
use App\Libraries\DepartmentLibrary;
use App\Libraries\DepartmentHospitalLibrary;
use App\Libraries\PrescriptionLibrary;
use App\Libraries\PharmacistLibrary;
use App\Libraries\WaitListLibrary;
use App\Libraries\ApprovingLibrary;
// Create a new instance of our RouteCollection class.
$routes = Services::routes();

$container = new Container();
// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */



//routes for APIs
$routes->resource('PatientAPI');
$routes->resource('AdminAPI',['websafe' => 1]);
$routes->resource('DoctorAPI',['websafe' => 1]);
$routes->resource('ReceptionistAPI',['websafe' => 1]);
$routes->resource('HospitalAPI',['websafe' => 1]);

$routes->resource('DepartmentAPI',['websafe' => 1]);
$routes->resource('DoctorHospitalAPI',['websafe' => 1]);
$routes->resource('ExaminationAPI',['websafe' => 1]);
$routes->resource('NurseAPI',['websafe' => 1]);
$routes->resource('NurseHospitalAPI',['websafe' => 1]);

$routes->resource('PharmacistAPI',['websafe' => 1]);
$routes->resource('PharmacistConfirmAPI',['websafe' => 1]);
$routes->resource('PharmacistHospitalAPI',['websafe' => 1]);
$routes->resource('ReceptionistHospitalAPI',['websafe' => 1]);
$routes->resource('WaitListAPI',['websafe' => 1]);

$routes->get('/', static function()use($container)
{
    $container->set(Model::class, HospitalModel::class); 
    $container->set(Entity::class, Entity::class); 
    $master= $container->get(MasterController::class);
	
    return $master->index(); 
});

$routes->match(['post','get'],'admin', static function()use($container)
{
    $container->set(DoctorModel::class, DoctorModel::class); 
    $container->set(DepartmentModel::class, DepartmentModel::class); 
    $container->set(AdminModel::class, AdminModel::class); 
    $container->set(ReceptionistModel::class, ReceptionistModel::class); 
	$container->set(ApprovingModel::class, ApprovingModel::class); 
    $container->set(NurseModel::class, NurseModel::class); 
    $container->set(PharmacistModel::class, PharmacistModel::class); 
    
    $container->set(Entity::class, Entity::class); 
	
    $admin= $container->get(AdminController::class);
   return $admin->admin(); 
});


$routes->match(['post','get'],'adminLogin', static function()use($container)
{
    $container->set(DoctorModel::class, DoctorModel::class); 
    $container->set(DepartmentModel::class, DepartmentModel::class); 
    $container->set(AdminModel::class, AdminModel::class); 
    $container->set(ReceptionistModel::class, ReceptionistModel::class); 
	$container->set(ApprovingModel::class, ApprovingModel::class); 
    $container->set(NurseModel::class, NurseModel::class); 
    $container->set(PharmacistModel::class, PharmacistModel::class); 
    
    $container->set(Entity::class, Entity::class); 
	
    $admin= $container->get(AdminController::class);
   return $admin->login(); 
});



$routes->get('patient', static function()use($container)
{
    $container->set(PatientModel::class, PatientModel::class); 
    $container->set(ExaminationModel::class, ExaminationModel::class); 
    $container->set(HospitalModel::class, HospitalModel::class); 
    $container->set(DoctorModel::class, DoctorModel::class); 
    $container->set(DepartmentModel::class, DepartmentModel::class); 
    $container->set(PrescriptionModel::class, PrescriptionModel::class); 

    $container->set(Entity::class, Entity::class); 
	
    $master= $container->get(PatientController::class);
   return $master->patient(); 
});

$routes->match(['post','get'],'patientLogin', static function()use($container)
{
    $container->set(PatientModel::class, PatientModel::class); 
    $container->set(ExaminationModel::class, ExaminationModel::class); 
    $container->set(HospitalModel::class, HospitalModel::class); 
    $container->set(DoctorModel::class, DoctorModel::class); 
    $container->set(DepartmentModel::class, DepartmentModel::class); 
    $container->set(PrescriptionModel::class, PrescriptionModel::class); 

    $container->set(Entity::class, Entity::class); 
	
    $master= $container->get(PatientController::class);
   return $master->login(); 
});

$routes->match(['post','get'],'patientRegisteration', static function()use($container)
{
    $container->set(PatientModel::class, PatientModel::class); 
    $container->set(ExaminationModel::class, ExaminationModel::class); 
    $container->set(HospitalModel::class, HospitalModel::class); 
    $container->set(DoctorModel::class, DoctorModel::class); 
    $container->set(DepartmentModel::class, DepartmentModel::class); 
    $container->set(PrescriptionModel::class, PrescriptionModel::class); 
    $container->set(Entity::class, Entity::class); 
	
    $patient= $container->get(PatientController::class);
   return $patient->registeration(); 
});

$routes->match(['post','get'],'receptionistLogin', static function()use($container)
{
    $container->set(PatientModel::class, PatientModel::class); 
    $container->set(ApprovingModel::class, ApprovingModel::class); 
    $container->set(DoctorModel::class, DoctorModel::class); 
    $container->set(ReceptionistModel::class, ReceptionistModel::class); 
    $container->set(WaitListModel::class, WaitListModel::class); 
    $container->set(HospitalModel::class, HospitalModel::class); 
    $container->set(DepartmentModel::class, DepartmentModel::class); 
    $container->set(DepartmentHospitalModel::class, DepartmentHospitalModel::class); 
    $container->set(PrescriptionModel::class, PrescriptionModel::class); 
    $container->set(Entity::class, Entity::class); 
	
    $receptionist= $container->get(ReceptionistController::class);
   return $receptionist->login(); 
});

$routes->post('deleteFromReception', static function()use($container)
{
    $container->set(PatientModel::class, PatientModel::class); 
    $container->set(DoctorModel::class, DoctorModel::class); 
    $container->set(ReceptionistModel::class, ReceptionistModel::class); 
    $container->set(WaitListModel::class, WaitListModel::class); 
    $container->set(HospitalModel::class, HospitalModel::class); 
    $container->set(DepartmentModel::class, DepartmentModel::class); 
    $container->set(DepartmentHospitalModel::class, DepartmentHospitalModel::class); 
    $container->set(PrescriptionModel::class, PrescriptionModel::class); 
    $container->set(Entity::class, Entity::class); 
	
    $receptionist= $container->get(ReceptionistController::class);
   return $receptionist->deleteFromReception(); 
});

$routes->match(['post','get'],'receptionistRegisteration', static function()use($container)
{
    $container->set(PatientModel::class, PatientModel::class); 
    $container->set(ApprovingModel::class, ApprovingModel::class); 
    $container->set(DoctorModel::class, DoctorModel::class); 
    $container->set(ReceptionistModel::class, ReceptionistModel::class); 
    $container->set(WaitListModel::class, WaitListModel::class); 
    $container->set(HospitalModel::class, HospitalModel::class); 
    $container->set(DepartmentModel::class, DepartmentModel::class); 
    $container->set(DepartmentHospitalModel::class, DepartmentHospitalModel::class); 
    $container->set(PrescriptionModel::class, PrescriptionModel::class); 
    $container->set(Entity::class, Entity::class); 
	
    $receptionist= $container->get(ReceptionistController::class);
   return $receptionist->registeration(); 
});


$routes->match(['post','get'],'receptionist', static function()use($container)
{
    $container->set(PatientModel::class, PatientModel::class); 
    $container->set(ApprovingModel::class, ApprovingModel::class); 
    $container->set(DoctorModel::class, DoctorModel::class); 
    $container->set(ReceptionistModel::class, ReceptionistModel::class); 
    $container->set(WaitListModel::class, WaitListModel::class); 
    $container->set(HospitalModel::class, HospitalModel::class); 
    $container->set(DepartmentModel::class, DepartmentModel::class); 
    $container->set(DepartmentHospitalModel::class, DepartmentHospitalModel::class); 
    $container->set(PrescriptionModel::class, PrescriptionModel::class); 
    $container->set(Entity::class, Entity::class); 
	
    $master= $container->get(ReceptionistController::class);
   return $master->receptionist(); 
});


$routes->match(['post','get'], 'pharmacistRegisteration', static function()use($container)
{
    $container->set(PatientModel::class, PatientModel::class); 
    $container->set(ApprovingModel::class, ApprovingModel::class); 
    $container->set(PharmacistModel::class, PharmacistModel::class); 
    $container->set(ExaminationModel::class, ExaminationModel::class); 
    $container->set(HospitalModel::class, HospitalModel::class); 
    $container->set(DoctorModel::class, DoctorModel::class); 
    $container->set(DepartmentModel::class, DepartmentModel::class); 
    $container->set(PrescriptionModel::class, PrescriptionModel::class); 
    $container->set(Entity::class, Entity::class); 
	
    $pharmacist= $container->get(PharmacistController::class);
   return $pharmacist->registeration(); 
});



$routes->match(['post','get'], 'pharmacist', static function()use($container)
{
    $container->set(PharmacistModel::class, PharmacistModel::class); 
    $container->set(ApprovingModel::class, ApprovingModel::class); 
    $container->set(PatientModel::class, PatientModel::class); 
    $container->set(ExaminationModel::class, ExaminationModel::class); 
    $container->set(HospitalModel::class, HospitalModel::class); 
    $container->set(DoctorModel::class, DoctorModel::class); 
    $container->set(PharmacistModel::class, PharmacistModel::class); 
    $container->set(PrescriptionModel::class, PrescriptionModel::class); 
    $container->set(Entity::class, Entity::class); 
	
    $master= $container->get(PharmacistController::class);
   return $master->pharmacist(); 
});

$routes->match(['post','get'], 'pharmacistLogin', static function()use($container)
{
    $container->set(PatientModel::class, PatientModel::class); 
    $container->set(ApprovingModel::class, ApprovingModel::class); 
    $container->set(PharmacistModel::class, PharmacistModel::class); 
    $container->set(ExaminationModel::class, ExaminationModel::class); 
    $container->set(HospitalModel::class, HospitalModel::class); 
    $container->set(DoctorModel::class, DoctorModel::class); 
    $container->set(DepartmentModel::class, DepartmentModel::class); 
    $container->set(PrescriptionModel::class, PrescriptionModel::class); 
    $container->set(Entity::class, Entity::class); 
	
    $pharmacist= $container->get(PharmacistController::class);
   return $pharmacist->login(); 
});

$routes->match(['post','get'], 'nurseRegisteration', static function()use($container)
{
    $container->set(PatientModel::class, PatientModel::class); 
    $container->set(ApprovingModel::class, ApprovingModel::class); 
    $container->set(NurseModel::class, NurseModel::class); 
    $container->set(WaitListModel::class, WaitListModel::class); 
    $container->set(HospitalModel::class, HospitalModel::class); 
    $container->set(DoctorModel::class, DoctorModel::class); 
    $container->set(DepartmentModel::class, DepartmentModel::class); 
    $container->set(Entity::class, Entity::class); 
	
    $nurse = $container->get(NurseController::class);
   return $nurse->registeration(); 
});


$routes->match(['post','get'], 'nurseLogin', static function()use($container)
{
    $container->set(NurseModel::class, NurseModel::class); 
    $container->set(ApprovingModel::class, ApprovingModel::class); 
    $container->set(PatientModel::class, PatientModel::class); 
    $container->set(HospitalModel::class, HospitalModel::class); 
    $container->set(DoctorModel::class, DoctorModel::class); 
    $container->set(DepartmentModel::class, DepartmentModel::class); 
    $container->set(WaitListModel::class, WaitListModel::class); 
    $container->set(Entity::class, Entity::class); 
	
    $nurse = $container->get(NurseController::class);
   return $nurse->login(); 
});

$routes->match(['post','get'], 'nurse', static function()use($container)
{
    $container->set(NurseModel::class, NurseModel::class); 
    $container->set(ApprovingModel::class, ApprovingModel::class); 
    $container->set(PatientModel::class, PatientModel::class); 
    $container->set(HospitalModel::class, HospitalModel::class); 
    $container->set(DoctorModel::class, DoctorModel::class); 
    $container->set(DepartmentModel::class, DepartmentModel::class); 
    $container->set(WaitListModel::class, WaitListModel::class); 
    $container->set(Entity::class, Entity::class); 
	
    $master= $container->get(NurseController::class);
   return $master->nurse(); 
});

$routes->match(['post','get'], 'doctorRegisteration', static function()use($container)
{
    $container->set(PatientModel::class, PatientModel::class); 
    $container->set(ApprovingModel::class, ApprovingModel::class); 
    $container->set(ExaminationModel::class, ExaminationModel::class); 
    $container->set(WaitListModel::class, WaitListModel::class); 
    $container->set(HospitalModel::class, HospitalModel::class); 
    $container->set(DoctorModel::class, DoctorModel::class); 
    $container->set(DepartmentModel::class, DepartmentModel::class); 
    $container->set(PrescriptionModel::class, PrescriptionModel::class); 
    $container->set(Entity::class, Entity::class); 
	
    $doctor = $container->get(DoctorController::class);
   return $doctor->registeration(); 
});


$routes->match(['post','get'], 'doctor', static function()use($container)
{
    $container->set(PatientModel::class, PatientModel::class); 
    $container->set(ApprovingModel::class, ApprovingModel::class); 
    $container->set(ExaminationModel::class, ExaminationModel::class); 
    $container->set(WaitListModel::class, WaitListModel::class); 
    $container->set(HospitalModel::class, HospitalModel::class); 
    $container->set(DoctorModel::class, DoctorModel::class); 
    $container->set(DepartmentModel::class, DepartmentModel::class); 
    $container->set(PrescriptionModel::class, PrescriptionModel::class); 
    $container->set(Entity::class, Entity::class); 
	
    $doctor = $container->get(DoctorController::class);
   return $doctor->doctor(); 
});


$routes->match(['post','get'], 'doctorLogin', static function()use($container)
{
    $container->set(PatientModel::class, PatientModel::class); 
    $container->set(ApprovingModel::class, ApprovingModel::class); 
    $container->set(ExaminationModel::class, ExaminationModel::class); 
    $container->set(HospitalModel::class, HospitalModel::class); 
    $container->set(DoctorModel::class, DoctorModel::class); 
    $container->set(DepartmentModel::class, DepartmentModel::class); 
    $container->set(PrescriptionModel::class, PrescriptionModel::class); 
    $container->set(WaitListModel::class, WaitListModel::class); 
    $container->set(Entity::class, Entity::class); 
	
    $doctor = $container->get(DoctorController::class);
   return $doctor->login(); 
});



$routes->get('logOut','MasterController::logout');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
