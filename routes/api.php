<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    RolController,
    DoctorController,
    PatientsController,
    SupplierController,
    CirugiaController,
    AnesthesiaController,
    DoctorxpreferenceController,
    DocumenttypeController,
    MaterialController,
    OperatorController,
    PreferenceController,
    SourceController,
    SpecialtyController,
    UserController,
    MedicalEventController,
    EquipmentController,
    DiagnosticController,
    DiagnosticDetailSpecialtysController,
    PaymentController,
    TagController,
    ParrillaController,
    SedeController,
    SupplierMaterialDetailController
};
use Illuminate\Support\Facades\Artisan;

/* use App\Http\Controllers\{
}; */
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('clear-cache', function() {
    Artisan::call('cache:clear');
    return redirect()->action([AuthController::class, 'authenticate']);
});

Route::get('clear-optimize', function() {
    Artisan::call('optimize:clear');
    return redirect()->action([AuthController::class, 'authenticate']);
});

Route::post('login', [AuthController::class, 'authenticate']);


// Route::post('register', [AuthController::class, 'register']);
//ALL ONLY JWT
Route::group(['middleware' => ['jwt.verify']], function () {

    // AUTH REGISTER

    //ALL:DOCTOR
    Route::get('/doctor', [DoctorController::class, 'listAll']);
    Route::post('/doctor', [DoctorController::class, 'create']);
    Route::put('/doctor/{id}', [DoctorController::class, 'update']);
    Route::delete('/doctor/{id}', [DoctorController::class, 'delete']);
    Route::get('/doctor/{id}', [DoctorController::class, 'findById']);

    //ALL:PATIENT
    Route::get('/patient', [PatientsController::class, 'listAll']);
    Route::post('/patient', [PatientsController::class, 'create']);
    Route::put('/patient/{id}', [PatientsController::class, 'update']);
    Route::delete('/patient/{id}', [PatientsController::class, 'delete']);
    Route::get('/patient/{id}', [PatientsController::class, 'findById']);

    //ALL:SUPPLIER
    Route::get('/supplier', [SupplierController::class, 'listAll']);
    Route::post('/supplier', [SupplierController::class, 'create']);
    Route::put('/supplier/{id}', [SupplierController::class, 'update']);
    Route::delete('/supplier/{id}', [SupplierController::class, 'delete']);
    Route::get('/supplier/{id}', [SupplierController::class, 'findById']);

    //ALL:DIAGNOSTIC
    Route::get('/diagnostic', [DiagnosticController::class, 'listAll']);
    Route::post('/diagnostic', [DiagnosticController::class, 'create']);
    Route::put('/diagnostic/{id}', [DiagnosticController::class, 'update']);
    Route::delete('/diagnostic/{id}', [DiagnosticController::class, 'delete']);
    Route::get('/diagnostic/{id}', [DiagnosticController::class, 'findById']);
    Route::get('/diagnostic/specialty/{id}', [DiagnosticController::class, 'findbyIdSpecialty']);

    //ALL:CIRUGIA
    Route::get('/cirugia', [CirugiaController::class, 'listAll']);
    Route::post('/cirugia', [CirugiaController::class, 'create']);
    Route::put('/cirugia/{id}', [CirugiaController::class, 'update']);
    Route::delete('/cirugia/{id}', [CirugiaController::class, 'delete']);
    Route::get('/cirugia/{id}', [CirugiaController::class, 'findById']);
    Route::get('/cirugia/specialty/{id}', [CirugiaController::class, 'findbyIdSpecialty']);

    //ALL:ANESTHESIA
    Route::get('/anesthesia', [AnesthesiaController::class, 'listAll']);
    Route::post('/anesthesia', [AnesthesiaController::class, 'create']);
    Route::put('/anesthesia/{id}', [AnesthesiaController::class, 'update']);
    Route::delete('/anesthesia/{id}', [AnesthesiaController::class, 'delete']);
    Route::get('/anesthesia/{id}', [AnesthesiaController::class, 'findById']);

    //ALL:DOCTOR PREFERENCE
    Route::get('/doctorxpreference', [DoctorxpreferenceController::class, 'listAll']);
    Route::post('/doctorxpreference', [DoctorxpreferenceController::class, 'create']);
    Route::put('/doctorxpreference/{id}', [DoctorxpreferenceController::class, 'update']);
    Route::delete('/doctorxpreference/{id}', [DoctorxpreferenceController::class, 'delete']);
    Route::get('/doctorxpreference/{id}', [DoctorxpreferenceController::class, 'findById']);

    //ALL:DOCUMENT TYPE
    Route::get('/documenttype', [DocumenttypeController::class, 'listAll']);
    Route::post('/documenttype', [DocumenttypeController::class, 'create']);
    Route::put('/documenttype/{id}', [DocumenttypeController::class, 'update']);
    Route::delete('/documenttype/{id}', [DocumenttypeController::class, 'delete']);
    Route::get('/documenttype/{id}', [DocumenttypeController::class, 'findById']);

    //ALL:MATERIAL
    Route::get('/material', [MaterialController::class, 'listAll']);
    Route::post('/material', [MaterialController::class, 'create']);
    Route::put('/material/{id}', [MaterialController::class, 'update']);
    Route::delete('/material/{id}', [MaterialController::class, 'delete']);
    Route::get('/material/{id}', [MaterialController::class, 'findById']);

    //ALL: OPERATOR
    Route::get('/operator', [OperatorController::class, 'listAll']);
    Route::post('/operator', [OperatorController::class, 'create']);
    Route::put('/operator/{id}', [OperatorController::class, 'update']);
    Route::delete('/operator/{id}', [OperatorController::class, 'delete']);
    Route::get('/operator/{id}', [OperatorController::class, 'findById']);

    //ALL: PREFERENCE
    Route::get('/preference', [PreferenceController::class, 'listAll']);
    Route::post('/preference', [PreferenceController::class, 'create']);
    Route::put('/preference/{id}', [PreferenceController::class, 'update']);
    Route::delete('/preference/{id}', [PreferenceController::class, 'delete']);
    Route::get('/preference/{id}', [PreferenceController::class, 'findById']);

    //ALL: SOURCE
    Route::get('/source', [SourceController::class, 'listAll']);
    Route::post('/source', [SourceController::class, 'create']);
    Route::put('/source/{id}', [SourceController::class, 'update']);
    Route::delete('/source/{id}', [SourceController::class, 'delete']);
    Route::get('/source/{id}', [SourceController::class, 'findById']);

    //ALL: SPECIALTY
    Route::get('/specialty', [SpecialtyController::class, 'listAll']);
    Route::post('/specialty', [SpecialtyController::class, 'create']);
    Route::put('/specialty/{id}', [SpecialtyController::class, 'update']);
    Route::delete('/specialty/{id}', [SpecialtyController::class, 'delete']);
    Route::get('/specialty/{id}', [SpecialtyController::class, 'findById']);

    //ALL: USER
    Route::get('/user', [UserController::class, 'listAll']);
    Route::post('/user', [UserController::class, 'create']);
    Route::put('/user/{id}', [UserController::class, 'update']);
    Route::delete('/user/{id}', [UserController::class, 'delete']);
    Route::get('/user/{id}', [UserController::class, 'findById']);


    //ALL: MEDICAL EVENT
    Route::get('/medicalevent', [MedicalEventController::class, 'listAll']);
    Route::post('/medicalevent', [MedicalEventController::class, 'create']);
    Route::put('/medicalevent/{id}', [MedicalEventController::class, 'update']);
    Route::delete('/medicalevent/{id}', [MedicalEventController::class, 'delete']);
    Route::get('/medicalevent/{id}', [MedicalEventController::class, 'findById']);
    Route::get('/medicalevent-sala/{calendar}', [MedicalEventController::class, 'findByIdSala']);

    //ALL: Equipment
    Route::get('/equipment', [EquipmentController::class, 'listAll']);
    Route::post('/equipment', [EquipmentController::class, 'create']);
    Route::put('/equipment/{id}', [EquipmentController::class, 'update']);
    Route::delete('/equipment/{id}', [EquipmentController::class, 'delete']);
    Route::get('/equipment/{id}', [EquipmentController::class, 'findById']);

    //ALL: PAYMENT
    Route::get('/payment', [PaymentController::class, 'listAll']);
    Route::post('/payment', [PaymentController::class, 'create']);
    Route::put('/payment/{id}', [PaymentController::class, 'update']);
    Route::delete('/payment/{id}', [PaymentController::class, 'delete']);
    Route::get('/payment/{id}', [PaymentController::class, 'findById']);

    //ALL: TAG
    Route::get('/tag', [TagController::class, 'listAll']);
    Route::post('/tag', [TagController::class, 'create']);
    Route::put('/tag/{id}', [TagController::class, 'update']);
    Route::delete('/tag/{id}', [TagController::class, 'delete']);
    Route::get('/tag/{id}', [TagController::class, 'findById']);

    //ALL: TAG
    Route::get('/parrilla', [ParrillaController::class, 'listAll']);
    Route::post('/parrilla', [ParrillaController::class, 'create']);
    Route::put('/parrilla/{id}', [ParrillaController::class, 'update']);
    Route::delete('/parrilla/{id}', [ParrillaController::class, 'delete']);
    Route::get('/parrilla/{id}', [ParrillaController::class, 'findById']);

    //ALL: TAG
    Route::get('/sede', [SedeController::class, 'listAll']);
    Route::post('/sede', [SedeController::class, 'create']);
    Route::put('/sede/{id}', [SedeController::class, 'update']);
    Route::delete('/sede/{id}', [SedeController::class, 'delete']);
    Route::get('/sede/{id}', [SedeController::class, 'findById']);

    //ALL: SupplierMaterialDetail
    Route::get('/suppliermaterialdetailbyidprov', [SupplierController::class, 'listAllMaterialDetail']);

    Route::get('/suppliermaterialdetail', [SupplierMaterialDetailController::class, 'listAll']);
    Route::post('/suppliermaterialdetail', [SupplierMaterialDetailController::class, 'create']);
    Route::put('/suppliermaterialdetail/{id}', [SupplierMaterialDetailController::class, 'update']);
    Route::delete('/suppliermaterialdetail/{id}', [SupplierMaterialDetailController::class, 'delete']);
    Route::get('/suppliermaterialdetail/{id}', [SupplierMaterialDetailController::class, 'findById']);

    //DiagnosticDetailSpecialtys
    Route::get('/diagnosticdetailspecialtys/{id}', [DiagnosticDetailSpecialtysController::class, 'listByDiagnostic']);
    Route::get('/diagnosticdetailspecialtys', [DiagnosticDetailSpecialtysController::class, 'listAll']);
    Route::post('/diagnosticdetailspecialtys', [DiagnosticDetailSpecialtysController::class, 'create']);
    Route::put('/diagnosticdetailspecialtys/{id}', [DiagnosticDetailSpecialtysController::class, 'update']);
    Route::delete('/diagnosticdetailspecialtys/{id}', [DiagnosticDetailSpecialtysController::class, 'delete']);
    //Route::get('/diagnosticdetailspecialtys/{id}', [DiagnosticDetailSpecialtysController::class, 'findById']);
});
