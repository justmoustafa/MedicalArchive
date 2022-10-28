<?php

namespace Config;
use App\Libraries\Container;
use App\Controllers\UserController;
use App\Controllers\PatientAPI;
use App\Models\PatientModel;
use CodeIgniter\Model;
use App\Entities\PatientEntity;
use CodeIgniter\Entity\Entity;
use App\Libraries\UserLibrary;
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
$routes->resource('PatientAPI',['websafe' => 1,'controller'=>'APIs\PatientAPI']);
$routes->resource('AdminAPI',['websafe' => 1,'controller'=>'APIs\AdminAPI']);
$routes->resource('DoctorAPI',['websafe' => 1,'controller'=>'APIs\DoctorAPI']);
$routes->resource('ReceptionistAPI',['websafe' => 1,'controller'=>'APIs\ReceptionistAPI']);
$routes->resource('HospitalAPI',['websafe' => 1,'controller'=>'APIs\HospitalAPI']);

$routes->resource('DepartmentAPI',['websafe' => 1,'controller'=>'APIs\DepartmentAPI']);
$routes->resource('DoctorHospitalAPI',['websafe' => 1,'controller'=>'APIs\DoctorHospitalAPI']);
$routes->resource('ExaminationAPI',['websafe' => 1,'controller'=>'APIs\ExaminationAPI']);
$routes->resource('NurseAPI',['websafe' => 1,'controller'=>'APIs\NurseAPI']);
$routes->resource('NurseHospitalAPI',['websafe' => 1,'controller'=>'APIs\NurseHospitalAPI']);

$routes->resource('PharmacistAPI',['websafe' => 1,'controller'=>'APIs\PharmacistAPI']);
$routes->resource('PharmacistConfirmAPI',['websafe' => 1,'controller'=>'APIs\PharmacistConfirmAPI']);
$routes->resource('PharmacistHospitalAPI',['websafe' => 1,'controller'=>'APIs\PharmacistHospitalAPI']);
$routes->resource('ReceptionistHospitalAPI',['websafe' => 1,'controller'=>'APIs\ReceptionistHospitalAPI']);
$routes->resource('WaitListAPI',['websafe' => 1,'controller'=>'APIs\WaitListAPI']);

$routes->get('/', static function()use($container)
{

    $container->set(Model::class, PatientModel::class); 
    $container->set(Entity::class, PatientEntity::class); 
    $pcc = $container->get(UserController::class);
   return $pcc->index(); 
});

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