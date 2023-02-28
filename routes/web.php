<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BarCodeController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\BlocklistController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//===================================TEST============================================
Route::resource('test', TestController::class);
//===================================================================================

//===================================WELCOME==========================================
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
//===================================================================================

//===================================HOME=============================================
Route::get('/home', [HomeController::class, 'index'])->name('home');
//===================================================================================

//==============================Error Page===========================================
Route::get('/error', [ErrorController::class, 'error'])->name('error.page');
//===================================================================================

//==============================Block Page===========================================
Route::get('/blocked', [ErrorController::class, 'block'])->name('block.page');
//===================================================================================

//==============================Disable Page=========================================
Route::get('/disabled_error', [ErrorController::class, 'disabled'])->name('disabled.page');
//===================================================================================

//=============================EMAIL VERIFICATION===================================
Auth::routes(['verify' => true]);
//==================================================================================





//==================================================================================
//==============================VISITOR=============================================
//==================================================================================
//==============================BARCODE==============================================
Route::get('barcodes', [BarCodeController::class, 'makeBarcode'])->name('barcode.generate');
//==============================APPOINTMENTS========================================
Route::resource('appointments', AppointmentController::class);
//==============================APPROVED APPOINTMENTS===============================
Route::get('approved_myappointments', [AppointmentController::class, 'indexApproved'])->name('myappointments.approved');
//==============================PENDING APPOINTMENTS================================
Route::get('pending_myappointments', [AppointmentController::class, 'indexPending'])->name('myappointments.pending');
//==============================DENIED APPOINTMENTS=================================
Route::get('denied_myappointments', [AppointmentController::class, 'indexDenied'])->name('myappointments.denied');
//==============================CANCELED APPOINTMENTS================================
Route::get('canceled_myappointments', [AppointmentController::class, 'indexCanceled'])->name('myappointments.canceled');
//==============================DELETE==============================================
Route::delete('delete_myappointments', [AppointmentController::class, 'delete'])->name('myappointments.delete');
//==============================CANCEL==============================================
Route::put('calcel_myappointments', [AppointmentController::class, 'cancel'])->name('myappointments.cancel');
//==============================PROFILE==============================================
Route::resource('profiles', ProfileController::class);
//==============================QnA==================================================
Route::get('/secury_question/{id}/verify', [QuestionController::class, 'index'])->name('question.verify');





//==============================ALL USERTYPE=========================================
//==============================PASSWORD=============================================
Route::resource('passwords', ChangePasswordController::class);
//===================================================================================





//===================================================================================
//==============================ADMIN================================================
//===================================================================================
//==============================USER MANAGEMENT PAGE=================================
//===================================================================================
//==============================USER MANAGEMENT======================================
Route::resource('users_management', UserController::class);
//==============================USER SEARCH==========================================
Route::put('users_management', [App\Http\Controllers\UserController::class, 'index'])->name('user.search');

//==============================DEPARTMENT PAGE======================================
//===================================================================================
Route::resource('departments', DepartmentController::class);
//==============================GENERATE DEPTS ACCNT=================================
Route::get('generate_departments', [App\Http\Controllers\DepartmentController::class, 'generateDepartments'])->name('departments.generate');
//==============================RESET DEPTS ACCNT====================================
Route::put('reset_departments', [App\Http\Controllers\DepartmentController::class, 'resetPassword'])->name('department.resetPassword');

//==============================MARSHALL PAGE========================================
//Route::resource('marshalls', UserController::class);
//===================================================================================
Route::get('marshalls', [App\Http\Controllers\UserController::class, 'indexMarshall'])->name('marshall.index');

//==============================ARCHIVE PAGE=========================================
//===================================================================================
//==============================USER ARCHIVE=========================================
Route::put('user_archive', [App\Http\Controllers\UserController::class, 'archive'])->name('user.archive');
//==============================USER ARCHIVE=========================================
Route::put('user_disable', [App\Http\Controllers\UserController::class, 'disable'])->name('user.disable');
Route::put('user_enable', [App\Http\Controllers\UserController::class, 'enable'])->name('user.enable');
//==============================USER ARCHIVED=========================================
Route::get('user_archived', [App\Http\Controllers\UserController::class, 'indexArchived'])->name('user.archived');





//===================================================================================
//==============================DEPARTMENT===========================================
//===================================================================================
//==============================UPCOMING APPOINTMENT PAGE============================
//===================================================================================
Route::get('upcoming_appointments', [App\Http\Controllers\DepartmentController::class, 'indexUpcoming'])->name('appointment.upcoming');
//==============================FAIL APPOINTMENT=====================================
Route::put('fail_appointments', [App\Http\Controllers\AppointmentController::class, 'failAppointment'])->name('appointment.fail');
//==============================CONCLUDE APPOINTMENT==================================
Route::put('conclude_appointments', [App\Http\Controllers\AppointmentController::class, 'concludeAppointment'])->name('appointment.conclude');

//==============================PENDING APPOINTMENT PAGE==============================
//===================================================================================
Route::get('pending_appointments', [App\Http\Controllers\DepartmentController::class, 'indexAppointmentPending'])->name('appointment.pending');
//==============================REJECT APPOINTMENT==================================
Route::put('reject_appointments', [App\Http\Controllers\AppointmentController::class, 'rejectAppointment'])->name('appointment.reject');
//==============================APPROVE APPOINTMENT==================================
Route::put('approve_appointments', [App\Http\Controllers\AppointmentController::class, 'approveAppointment'])->name('appointment.approve');

//==============================HISTORY APPOINTMENT PAGE=============================
//===================================================================================
Route::get('history_appointments', [App\Http\Controllers\DepartmentController::class, 'indexAppointmentHistory'])->name('appointment.history');
//==============================DELETE HISTORY========================================
Route::delete('delete_appointments', [App\Http\Controllers\AppointmentController::class, 'remove'])->name('appointment.remove');

//==============================PASSWORD VERIFY======================================
Route::get('/password_security/{id}/verify', [App\Http\Controllers\QuestionController::class, 'index'])->name('password.verify');
//==============================SECURITY CONTROLLER==================================
Route::resource('security', SecurityController::class);





//===================================================================================
//==============================MARSHALL=============================================
//===================================================================================
//==============================MONITORING===========================================
Route::resource('dashboard', MonitoringController::class);

//==============================MONITORING ACTIVE===================================
Route::get('active_list/{dept}', [App\Http\Controllers\MonitoringController::class, 'indexActive'])->name('active.list');

//==============================ACTIVE FILTER=======================================
Route::get('active_list', [App\Http\Controllers\MonitoringController::class, 'indexActiveFilter'])->name('active.filter');

//==============================HISTORY HISTORY==================================
Route::get('history_list/{dept}', [App\Http\Controllers\MonitoringController::class, 'indexHistory'])->name('history.list');
//==============================HISTORY FILTER==================================
Route::put('history_list/{dept}', [App\Http\Controllers\MonitoringController::class, 'indexHistory'])->name('history.filter');
//==============================HISTORY FILTER PDF====================================
Route::put('history_pdf/{dept}', [App\Http\Controllers\MonitoringController::class, 'indexHistoryPDF'])->name('history.pdf');

//STUDENT-EMPLOYEES-VISITORS-PENDING ROUTE
//==============================PENDING LIST========================================
Route::get('active/students', [App\Http\Controllers\MonitoringController::class, 'indexListStudent'])->name('index.listStudent');
Route::put('active/students', [App\Http\Controllers\MonitoringController::class, 'indexListStudent'])->name('indexFilter.listStudent');

Route::get('active/employees', [App\Http\Controllers\MonitoringController::class, 'indexListEmployee'])->name('index.listEmployee');
Route::put('active/employees', [App\Http\Controllers\MonitoringController::class, 'indexListEmployee'])->name('indexFilter.listEmployee');

Route::get('active/visitors', [App\Http\Controllers\MonitoringController::class, 'indexListVisitor'])->name('index.listVisitor');
Route::put('active/visitors', [App\Http\Controllers\MonitoringController::class, 'indexListVisitor'])->name('indexFilter.listVisitor');

Route::get('pending/lists', [App\Http\Controllers\MonitoringController::class, 'indexListPending'])->name('index.listPending');
Route::put('pending/lists', [App\Http\Controllers\MonitoringController::class, 'indexListPending'])->name('indexFilter.listPending');

Route::get('pending/lists_history', [App\Http\Controllers\MonitoringController::class, 'indexListPendingHistory'])->name('index.listPendingHistory');
Route::put('pending/lists_history', [App\Http\Controllers\MonitoringController::class, 'indexListPendingHistory'])->name('indexFilter.listPendingHistory');





//==============================POST SELECT PAGE=====================================
//===================================================================================
//==============================POST SELECT PAGE=====================================
Route::get('post_index', [App\Http\Controllers\SecurityController::class, 'post'])->name('post.index');
//==============================POST SELECT PUT======================================
Route::put('post_select', [App\Http\Controllers\SecurityController::class, 'postSelect'])->name('post.select');

//==============================SCAN PAGE============================================
//===================================================================================
Route::get('scan_page', [App\Http\Controllers\SecurityController::class, 'scanPage'])->name('scan.page');
//==============================USER INPUT===========================================
Route::put('scan_page', [App\Http\Controllers\SecurityController::class, 'input_scan'])->name('input.userId');
//==============================SCAN CAM============================================
Route::post('scan_cam', [App\Http\Controllers\SecurityController::class, 'scan'])->name('scan.cam');

//==============================TRANSACTION PAGE====================================
//===================================================================================
Route::resource('transactions', TransactionController::class);
//==============================TRANSACTION FILTER==================================
Route::put('transactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('transaction.filter');

//==============================VISITOR PAGE=========================================
//===================================================================================
//==============================VISITOR LIST PAGE====================================
Route::get('visitors', [App\Http\Controllers\SecurityController::class, 'indexVisitor'])->name('visitor.list');
//==============================VISITOR SEARCH=======================================
Route::put('visitors', [App\Http\Controllers\SecurityController::class, 'indexVisitor'])->name('visitor.search');
//==============================VISITOR INFO========================================
Route::get('visitor_profile/{id}', [App\Http\Controllers\SecurityController::class, 'visitorView'])->name('visitor.profile');
//==============================VISITOR TANSAC======================================
Route::get('visitor_transaction/{id}', [App\Http\Controllers\SecurityController::class, 'visitorTransac'])->name('visitor.transac');
//==============================VISITOR BLOCK========================================
Route::put('visitor_block', [App\Http\Controllers\SecurityController::class, 'visitorBlock'])->name('visitor.block');

//==============================REPORT PAGE==========================================
//===================================================================================
//==============================REPORT PAGE==========================================
Route::resource('reports', ReportController::class);
//==============================REPORT FILTER========================================
Route::put('reports', [App\Http\Controllers\ReportController::class, 'index'])->name('reports.filter');
//==============================REPORT FILTER PDF====================================
Route::put('report_pdf', [App\Http\Controllers\ReportController::class, 'pdfFilter'])->name('report.pdf');

//==============================BLACKLISTS PAGE======================================
//===================================================================================
//==============================BLACKLISTS===========================================
Route::resource('blacklists', BlocklistController::class);
//==============================BLOCK USER SEARCH====================================
Route::put('blacklists', [App\Http\Controllers\BlocklistController::class, 'index'])->name('block.search');