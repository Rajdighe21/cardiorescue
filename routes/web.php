<?php

use App\Models\Patients_Appointment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Users_information;
use App\Http\Controllers\PatientAppointment;
use App\Http\Controllers\FMS\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ImageUploderController;
use NumberToWords\Legacy\Numbers\Words\Locale\Ro;
use App\Http\Controllers\Admin\BranchesController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\PatientConditionController;
use App\Http\Controllers\Admin\ConsultationController;
use App\Http\Controllers\Admin\PatinetsListController;
use App\Http\Controllers\Management\consentController;
use App\Http\Controllers\Management\DoctorsController;
use App\Http\Controllers\Management\patientController;
use App\Http\Controllers\Management\reclickController;
use App\Http\Controllers\Doctor\PatientProtocolController;
use App\Http\Controllers\Doctor\PatientAssesmentController;
use App\Http\Controllers\Management\DailyReciptsController;
use App\Http\Controllers\Doctor\PatientAppointmentController;
use App\Http\Controllers\Doctor\PatientRegistrationController;
use App\Http\Controllers\Management\ManagementLoginController;
use App\Http\Controllers\Management\SessionPlanningController;

Route::get('/', [PatientConditionController::class, 'index'])->name('indexone');

Route::get('/mobility-test', [PatientConditionController::class, 'mobilityTest'])->name('mobilityTest');
Route::post('/mobilityTestsecond', [PatientConditionController::class, 'mobilitySecondStore'])->name('mobilitySecondStore');
Route::get('/mobility-test-second', [PatientConditionController::class, 'SecondTest'])->name('SecondTest');
Route::post('/mobilityTestThird', [PatientConditionController::class, 'mobilityTestThird'])->name('mobilityTestThird');
Route::get('/mobility-testTh', [PatientConditionController::class, 'ThirdTest'])->name('ThirdTest');
Route::post('/mobilityTestFour', [PatientConditionController::class, 'mobilityTestFour'])->name('mobilityTestFour');
Route::get('/mobility-testFo', [PatientConditionController::class, 'ForthTest'])->name('ForthTest');
Route::post('/mobilityTestFive', [PatientConditionController::class, 'mobilityTestFive'])->name('mobilityTestFive');
Route::get('/mobility-testFi', [PatientConditionController::class, 'FifthTest'])->name('FifthTest');
Route::post('/mobilityTestSix', [PatientConditionController::class, 'mobilityTestSix'])->name('mobilityTestSix');
Route::get('/mobility-testSi', [PatientConditionController::class, 'SixTest'])->name('SixTest');
Route::post('/mobilityTestSeven', [PatientConditionController::class, 'mobilityTestSeven'])->name('mobilityTestSeven');
Route::get('/mobility-testSe', [PatientConditionController::class, 'SevenTesT'])->name('SevenTesT');
Route::post('/mobilityTestEight', [PatientConditionController::class, 'mobilityTestEight'])->name('mobilityTestEight');
Route::get('/mobility-testEi', [PatientConditionController::class, 'EightTest'])->name('EightTest');
Route::post('/mobilityTestNine', [PatientConditionController::class, 'mobilityTestNine'])->name('mobilityTestNine');
Route::get('/mobility-testNi', [PatientConditionController::class, 'NineTest'])->name('NineTest');
Route::post('/mobilityTestTen', [PatientConditionController::class, 'mobilityTestTen'])->name('mobilityTestTen');
Route::get('/mobility-testTe', [PatientConditionController::class, 'TenTest'])->name('TenTest');

//After Checkup
Route::post('/PastYears', [PatientConditionController::class, 'PastYears'])->name('PastYears');
Route::get('/FromPastYears', [PatientConditionController::class, 'FromPastYears'])->name('FromPastYears');

Route::post('/Goal', [PatientConditionController::class, 'Goal'])->name('Goal');
Route::get('/mobilityGoal', [PatientConditionController::class, 'mobilityGoal'])->name('mobilityGoal');

Route::post('/health', [PatientConditionController::class, 'health'])->name('health');
Route::get('/mobilityHealth', [PatientConditionController::class, 'mobilityHealth'])->name('mobilityHealth');

//Result Page
Route::get('/FinalResult', [PatientConditionController::class, 'FinalResult'])->name('FinalResult');
Route::post('/results', [PatientConditionController::class, 'results'])->name('results');

//Apoointments Route
Route::post('/appointment', [PatientAppointment::class, 'store'])->name('appointment');
Route::get('/view', [\App\Http\Controllers\ViewController::class, 'identify'])->name('view');
Route::get('/patient-condition/{conditions_id}', [PatientConditionController::class, 'identify'])->name('patient-condition');
Route::get('/booking', [PatientConditionController::class, 'booking'])->name('booking');
Route::get('/payment', [PatientConditionController::class, 'payment'])->name('payment');

// Get Information  identify
Route::post('/store', [Users_information::class, 'store'])->name('store');
Route::post('/index', [Users_information::class, 'index'])->name('index');
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
        Route::post('/authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');
    });
    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [HomeController::class, 'logout'])->name('admin.logout');
        //Patients List Route
        Route::get('/patients-list', [PatinetsListController::class, 'index'])->name('admin.patients-list');

         Route::get('/patients-list', [PatinetsListController::class, 'index'])->name('admin.patients-list');

        Route::resource('/branches', BranchesController::class);
        Route::get('/attendance',[AttendanceController::class,'index'])->name('attendance');
    });
});





//Generate Pdf
Route::get('/download-invoice', [PatientRegistrationController::class, 'invoicePdf'])->name("invoicePdf");

//MANAGEMENT-ROUTES
Route::group(['prefix' => 'management'], function () {
    Route::group(['middleware' => 'manage.guest'], function () {
        Route::get('/login', [ManagementLoginController::class, 'login'])->name('manage.login');
        Route::post('/authenticate', [ManagementLoginController::class, 'authenticate'])->name('manage.authenticate');
    });

    Route::group(['middleware' => 'manage.auth'], function () {
        Route::get('/dashboard', [ManagementLoginController::class, 'dashboard'])->name('manage.dashboard')->middleware('manage.auth');;
        Route::get('/logout', [ManagementLoginController::class, 'logout'])->name('manage.logout');



        // Doctors
        Route::get('/doctor-list', [DoctorsController::class, 'doctorList'])->name('manage.doctorList');
        Route::get('/addDoctor', [DoctorsController::class, 'create'])->name('create.doctors');
        Route::post('/StoreDoctor', [DoctorsController::class, 'store'])->name('store.doctors');
        Route::get('/doctorDelete/{id}',[DoctorsController::class,'doctorDelete'])->name('doctorDelete');
        Route::get('/doctorEdit/{id}',[DoctorsController::class,'doctorEdit'])->name('doctorEdit');
        Route::post('/editDoctor/{id}', [DoctorsController::class, 'edit'])->name('edit.doctors');

        // TRASH
        Route::get('/trashList',[DoctorsController::class,'trashList'])->name('trashList');
        Route::get('/restoreTrash/{id}',[DoctorsController::class,'restoreTrash'])->name('restoreTrash');
        Route::get('/trashed/{id}',[DoctorsController::class,'trashed'])->name('trashed');


        //BOOK APPOINTMENT ROUTE
        Route::get('/doctorApp/{id}', [DoctorsController::class, 'doctorApp'])->name('manage.doctorApp');
        Route::post('/doctorAppBook', [DoctorsController::class, 'doctorAppBook'])->name('manage.doctorAppBook');

        // Patients
        Route::get('/patientsList', [patientController::class, 'patientsList'])->name('manage.patientsList');
        Route::get('/addPatient', [patientController::class, 'create'])->name('create.patient');
        Route::post('/StorePatient', [patientController::class, 'store'])->name('store.patient');
        Route::get('/bookApp', [patientController::class, 'bookApp'])->name('manage.bookApp');

        Route::get('/PatientAppointment/{id}', [patientController::class, 'PatientAppointment'])->name('PatientAppointment.patient');
        Route::get('/EditPatient/{id}', [patientController::class, 'EditPatient'])->name('EditPatient.patient');
        Route::post('/UpdatePatient/{id}', [patientController::class, 'UpdatePatient'])->name('UpdatePatient.patient');
        Route::get('/ClickPatients', [patientController::class, 'ClickPatients'])->name('manage.ClickPatients');

        //SearchBars
        Route::get('/SearchPatients', [patientController::class, 'SearchPatients'])->name('manage.SearchPatients');
        Route::post('/appointmentSrch', [PatientRegistrationController::class, 'appointmentSrch'])->name('appointmentSrch');
        Route::post('/registerSrch', [patientController::class, 'registerSrch'])->name('registerSrch');
        Route::post('/consentSrch', [consentController::class, 'consentSrch'])->name('consentSrch');


        //Patient'registration
        Route::get('register', [PatientRegistrationController::class, 'register'])->name('manage.register');
        Route::post('registerStore', [PatientRegistrationController::class, 'registerStore'])->name('manage.registerStore');
        Route::get('updateRegister/{id}', [PatientRegistrationController::class, 'updateRegister'])->name('manage.updateRegister');
        Route::post('registerStore/{id}', [PatientRegistrationController::class, 'registerUpdate'])->name('manage.registerUpdate');
        Route::get('patients/registration', [PatientRegistrationController::class, 'index'])->name('patients.registration');
        Route::post('/registration', [PatientRegistrationController::class, 'store'])->name('registration');
        Route::get('registration/edit/{id}', [PatientRegistrationController::class, 'edit'])->name('registration.edit');


        // Daily Recipts
        Route::post('/dailyRecipts/store', [DailyReciptsController::class, 'store'])->name('dailyRecipts.store');
        Route::get('/dailyRecipts/{id}', [DailyReciptsController::class, 'index'])->name('dailyRecipts');


        // Consents
        Route::get('/consent', [consentController::class, 'index'])->name('manage.consent');
        Route::get('/addConsent/{id}', [consentController::class, 'addConsent'])->name('manage.addConsent');
        Route::post('/storeConsent', [consentController::class, 'storeConsent'])->name('manage.storeConsent');


        //reclick patitions
        Route::get('/reclick', [reclickController::class, 'index'])->name('reclick.index');
        Route::get('/add/reclick', [reclickController::class, 'create'])->name('reclick.create');
        Route::post('/store/reclick', [reclickController::class, 'store'])->name('reclick.store');
        Route::get('/patientSrch', [reclickController::class, 'patientSrch'])->name('reclick.patientSrch');
        Route::get('/reclick-receipt/{id}', [reclickController::class, 'reReceipt'])->name('reclick.receipt');
        Route::get('/reclick-invoice/{id}', [reclickController::class, 'reInvoice'])->name('reclick.invoice');
        Route::get('/patientListSrch', [reclickController::class, 'patientListSrch'])->name('reclick.patientListSrch');


        //Assessment Pdf
        Route::get('/view-pdf/{id}', [patientController::class, 'viewPdf'])->name('manage.view-pdf');

        //Genarate PDf
        Route::get('/download-receipt/{id}', [PatientRegistrationController::class, 'downloadPdf'])->name("downloadPDF");
        Route::get('/download-invoice/{id}', [PatientRegistrationController::class, 'recieptForInvice'])->name("manage.invoicePdf");
        Route::get('/dailyReciptsPdf/{id}', [DailyReciptsController::class, 'dailyReciptsPdf'])->name("manage.dailyReciptsPdf");
        Route::get('/consentPdf/{id}', [consentController::class, 'consentPdf'])->name("manage.consentPdf");


        // SESSION PLANING
        Route::get('/planing',[SessionPlanningController::class,'index'])->name('index.planing');
        Route::get('/assign/planing',[SessionPlanningController::class,'assign'])->name('assign.planing');

    });
});




//THIS ROUTES FOR DOCTORS
Route::group(['prefix' => 'doctor'], function () {
    Route::group(['middleware' => 'doctor.guest'], function () {

        Route::get('/login', [DoctorsController::class, 'login'])->name('doctor.login');
        Route::post('/authenticate', [DoctorsController::class, 'authenticate'])->name('doctor.authenticate');
    });


    Route::group(['middleware' => 'doctor.auth'], function () {

        //Patients Protocol
        Route::get('/patient/protocol', [PatientProtocolController::class, 'index'])->name('patients.protocol');
        Route::get('/protocol/search', [PatientProtocolController::class, 'search'])->name('protocol.search');
        Route::get('/dashboard', [DoctorsController::class, 'dashboard'])->name('doctor.dashboard');
        Route::get('/logout', [DoctorsController::class, 'logout'])->name('doctor.logout');
        Route::post('/protocol/store', [PatientProtocolController::class, 'store'])->name('protocol.store');


        //Patient's Assesment
        Route::get('patients/assesment/{id}', [PatientAssesmentController::class, 'assesment'])->name('assesment-view');
        Route::post('/assesment', [PatientAssesmentController::class, 'store'])->name('assessment.store');
        Route::get('patients/assesment/search', [PatientAssesmentController::class, 'search'])->name('search');

        //NOTIFICATION ROUTE
        Route::get('/markAsRead/{id}', [DoctorsController::class, 'markAsRead'])->name('doctor.markAsRead');


        // CONSULTATION
        Route::get('/consultation/{id}',[ConsultationController::class,'index'])->name('doctor.consultation');
        Route::post('/startSession',[ConsultationController::class,'startSession'])->name('doctor.startSession');
        Route::post('/endSession',[ConsultationController::class,'endSession'])->name('doctor.endSession');
        Route::post('/storeConsultation',[ConsultationController::class,'storeConsultation'])->name('doctor.storeConsultation');


    });
});




Route::get('/fms/dashboard', [LoginController::class, 'dashboard'])->name('fms.dashboard');
Route::get('/fms/logout', [LoginController::class, 'logout'])->name('fms.logout');
