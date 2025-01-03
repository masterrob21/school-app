<?php

use App\Http\Controllers\AccountChartController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EducationHistoryController;
use App\Http\Controllers\GeneralJournalController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LedgerAccountController;
use App\Http\Controllers\OccupationController;
use App\Http\Controllers\PaymentModeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProgramTypeController;
use App\Http\Controllers\RelationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentGuardianController;
use App\Http\Controllers\UpdateImageController;
use App\Http\Controllers\UserController;
use App\Mail\MessagePosted;
use App\Models\ProgramType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/send-message', [HomeController::class, 'sendMessage']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/role-permissions/{role}/edit', [RolePermissionController::class, 'edit'])->name('role-permissions.edit')->middleware('permission:update role permission');
    Route::patch('/role-permissions/{id}', [RolePermissionController::class, 'update'])->name('role-permission.update');

    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index')->middleware('permission:view role');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('permission:add role');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('permission:update role');
    Route::patch('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('permission:delete role');
    
    Route::get('/security', [DashboardController::class, 'security']);
    Route::get('/student-dashboard', [DashboardController::class, 'biodata']);
    Route::get('/accounting', [DashboardController::class, 'accounting']);
    Route::get('/staff-dashboard', [DashboardController::class, 'staff']);

    Route::get('/programTypes', [ProgramTypeController::class, 'index'])->name('programTypes.index')->middleware('permission:view program type');
    Route::get('/programTypes-fetch', [ProgramTypeController::class, 'fetch'])->name('programTypes.fetch');
    Route::get('/programTypes/{programType}/edit', [ProgramTypeController::class, 'edit'])->name('programTypes.edit')->middleware('permission:update role');
    Route::patch('/programTypes/{programType}', [ProgramTypeController::class, 'update'])->name('programTypes.update');

    Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index')->middleware('permission:view program');
    Route::get('/programs/create', [ProgramController::class, 'create'])->name('programs.create')->middleware('permission:add program');
    Route::get('/programs-fetch', [ProgramController::class, 'fetch'])->name('programs.fetch');
    Route::post('/programs', [ProgramController::class, 'store'])->name('programs.store');
    Route::get('/programs/{program}', [ProgramController::class, 'show'])->name('programs.show')->middleware('permission:view program');
    Route::get('/programs/{program}/edit', [ProgramController::class, 'edit'])->name('programs.edit')->middleware('permission:update program');
    Route::patch('/programs/{program}', [ProgramController::class, 'update'])->name('programs.update');
    Route::delete('/programs/{program}', [ProgramController::class, 'destroy'])->name('programs.destroy')->middleware('permission:delete program');

    Route::get('/branches', [BranchController::class, 'index'])->name('branches.index')->middleware('permission:view branch');
    Route::get('/branches/{id}', [BranchController::class, 'show'])->name('branches.show')->middleware('permission:view view');
    Route::get('/branches/{branch}/edit', [BranchController::class, 'edit'])->name('branches.edit')->middleware('permission:update branch');
    Route::patch('/branches/{branch}', [BranchController::class, 'update'])->name('branches.update');
    
    Route::get('/paymentMethods', [PaymentModeController::class, 'index'])->name('paymentMethods.index')->middleware('permission:view payment method');
    Route::get('/paymentMethods/{paymentMode}/edit', [PaymentModeController::class, 'edit'])->name('paymentMethods.edit')->middleware('permission:update payment method');
    Route::patch('/paymentMethods/{paymentMode}', [PaymentModeController::class, 'update'])->name('paymentMethods.update');

    Route::get('/currency', [CurrencyController::class, 'index'])->name('currency.index')->middleware('permission:view currency');
    Route::get('/currency-fetch', [CurrencyController::class, 'fetch'])->name('currency.fetch');
    Route::get('/currency/create', [CurrencyController::class, 'create'])->name('currency.create')->middleware('permission:add currency');
    Route::post('/currency', [CurrencyController::class, 'store'])->name('currency.store');
    Route::get('/currency/{id}/edit', [CurrencyController::class, 'edit'])->name('currency.edit')->middleware('permission:update currency');
    Route::patch('/currency/{currency}', [CurrencyController::class, 'update'])->name('currency.update');
    Route::delete('/currency/{currency}', [CurrencyController::class, 'destroy'])->name('currency.destroy')->middleware('permission:delete currency');
    
    Route::get('/general-journal', [GeneralJournalController::class, 'index'])->name('general-journal.index');
    Route::get('/get-transactions', [GeneralJournalController::class, 'getTransactions'])->name('general-journal.getTransactions');
    Route::get('/general-journal/create', [GeneralJournalController::class, 'create'])->name('general-journal.create')->middleware('permission:add journal transaction');
    Route::get('/fetchledger', [GeneralJournalController::class, 'fetch'])->name('fetchledger.fetch');
    Route::post('/general-journal', [GeneralJournalController::class, 'store'])->name('general-journal.store');

    Route::get('/settings', [DashboardController::class, 'settings']);

    Route::get('/ledgeraccounts-getchartid/{id}', [LedgerAccountController::class, 'index'])->name('ledgeraccounts.index')->middleware('permission:view ledger account');
    Route::get('/ledgeraccounts-fetch', [LedgerAccountController::class, 'fetch'])->name('ledgeraccounts.fetch');
    Route::get('/ledgeraccounts/create', [LedgerAccountController::class, 'create'])->name('ledgeraccounts.create')->middleware('permission:add ledger account');
    Route::post('/ledgeraccounts', [LedgerAccountController::class, 'store'])->name('ledgeraccounts.store');
    Route::get('/ledgeraccounts/{id}/edit', [LedgerAccountController::class, 'edit'])->name('ledgeraccounts.edit')->middleware('permission:update ledger account');
    Route::patch('/ledgeraccounts/{ledgeraccount}', [LedgerAccountController::class, 'update'])->name('ledgeraccounts.update');
    Route::delete('/ledgeraccounts/{ledgeraccount}', [LedgerAccountController::class, 'destroy'])->name('ledgeraccounts.destroy')->middleware('permission:delete ledger account');

    Route::get('/accountcharts', [AccountChartController::class, 'index'])->name('accountcharts.index')->middleware('permission:view chart of account');
    Route::get('/accountcharts-fetch', [AccountChartController::class, 'fetch'])->name('accountcharts.fetch');
    Route::get('/accountcharts/create', [AccountChartController::class, 'create'])->name('accountcharts.create')->middleware('permission:add chart of account');
    Route::post('/accountcharts', [AccountChartController::class, 'store'])->name('accountcharts.store');
    Route::get('/accountcharts/{id}', [AccountChartController::class, 'show'])->name('accountcharts.show');
    Route::get('/accountcharts/{id}/edit', [AccountChartController::class, 'edit'])->name('accountcharts.edit')->middleware('permission:update chart of account');
    Route::patch('/accountcharts/{accountchart}', [AccountChartController::class, 'update'])->name('accountcharts.update');
    Route::delete('/accountcharts/{accountchart}', [AccountChartController::class, 'destroy'])->name('accountcharts.destroy')->middleware('permission:delete chart of account');

    Route::get('/classrooms', [ClassroomController::class, 'index'])->name('classrooms.index')->middleware('permission:view classroom');
    Route::get('/classrooms/create', [ClassroomController::class, 'create'])->name('classrooms.create')->middleware('permission:add classroom');
    Route::post('/classrooms', [ClassroomController::class, 'store'])->name('classrooms.store');
    Route::get('/classrooms/{id}', [ClassroomController::class, 'show'])->name('classrooms.show');
    Route::get('/classrooms/{id}/edit', [ClassroomController::class, 'edit'])->name('classrooms.edit')->middleware('permission:update classroom');
    Route::patch('/classrooms/{classroom}', [ClassroomController::class, 'update'])->name('classrooms.update');
    Route::delete('/classrooms/{classroom}', [classroomController::class, 'destroy'])->name('classrooms.destroy')->middleware('permission:delete classroom');
    Route::get('/classrooms-fetch', [classroomController::class, 'fetch'])->name('classrooms.fetch');

    Route::get('/user', [UserController::class, 'index'])->name('user.index')->middleware('permission:view user');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create')->middleware('permission:add user');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('permission:update user');
    Route::patch('/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy')->middleware('permission:delete user');
    Route::get('/user-fetch', [UserController::class, 'fetch'])->name('user.fetch');

    Route::view('/abort', 'messages.abort');

    Route::get('/students', [StudentController::class, 'index'])->name('students.index')->middleware('permission:view student');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create')->middleware('permission:add student');
    Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show')->middleware('permission:view student');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit')->middleware('permission:update student');
    Route::patch('/students/{student}', [StudentController::class, 'update'])->name('students.update')->middleware('permission:update student');
    Route::get('/getStudent', [StudentController::class, 'getStudent']);
    // Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index')->middleware('permission:view course');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create')->middleware('permission:add course');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit')->middleware('permission:update course');
    Route::patch('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy')->middleware('permission:delete course');
    Route::get('/courses-fetch', [CourseController::class, 'fetch'])->name('courses.fetch');

    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index')->middleware('permission:view department');
    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create')->middleware('permission:add department');
    Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/departments/{id}', [DepartmentController::class, 'show'])->name('departments.show');
    Route::get('/departments/{id}/edit', [DepartmentController::class, 'edit'])->name('departments.edit')->middleware('permission:update department');
    Route::patch('/departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy')->middleware('permission:delete department');
    Route::get('/departments-fetch', [DepartmentController::class, 'fetch'])->name('departments.fetch');

    Route::get('/staffs', [StaffController::class, 'index'])->name('staffs.index')->middleware('permission:view staff');
    Route::get('/staffs/create', [StaffController::class, 'create'])->name('staffs.create')->middleware('permission:add staff');
    Route::post('/staffs', [StaffController::class, 'store'])->name('staffs.store');
    Route::get('/staffs/{id}', [StaffController::class, 'show'])->name('staffs.show');
    Route::get('/staffs/{id}/edit', [StaffController::class, 'edit'])->name('staffs.edit')->middleware('permission:update staff');
    Route::patch('/staffs/{staff}', [StaffController::class, 'update'])->name('staffs.update');
    Route::get('/staffs-fetch', [StaffController::class, 'fetch'])->name('staffs.fetch');
    // Route::delete('/staffs/{staff}', [StaffController::class, 'destroy'])->name('staffs.destroy');

    Route::get('/education-history/create', [EducationHistoryController::class, 'create'])->name('education-history.create')->middleware('permission:add educational history');
    Route::post('/education-history', [EducationHistoryController::class, 'store'])->name('education-history.store');
    Route::get('/education-history/{id}/edit', [EducationHistoryController::class, 'edit'])->name('education-history.edit')->middleware('permission:update educational history');
    Route::patch('/education-history/{education_history}', [EducationHistoryController::class, 'update'])->name('education-history.update');
    Route::delete('/education-history/{education_history}', [EducationHistoryController::class, 'destroy'])->name('education-history.destroy')->middleware('permission:delete educational history');

    Route::get('/occupations', [OccupationController::class, 'index'])->name('occupations.index')->middleware('permission:view occupation');
    Route::get('/occupations/create', [OccupationController::class, 'create'])->name('occupations.create')->middleware('permission:add occupation');
    Route::post('/occupations', [OccupationController::class, 'store'])->name('occupations.store');
    Route::get('/occupations/{id}/edit', [OccupationController::class, 'edit'])->name('occupations.edit')->middleware('permission:update occupation');
    Route::patch('/occupations/{occupation}', [OccupationController::class, 'update'])->name('occupations.update');
    Route::delete('/occupations/{occupation}', [OccupationController::class, 'destroy'])->name('occupations.destroy')->middleware('permission:delete occupation');
    Route::get('/occupations-fetch', [OccupationController::class, 'fetch'])->name('occupations.fetch');

    Route::get('/guardians', [GuardianController::class, 'index'])->name('guardians.index')->middleware('permission:view guardian');
    Route::get('/guardians/create', [GuardianController::class, 'create'])->name('guardians.create')->middleware('permission:add guardian');
    Route::post('/guardians', [GuardianController::class, 'store'])->name('guardians.store');
    Route::get('/guardians/{id}', [GuardianController::class, 'show'])->name('guardians.show');
    Route::get('/guardians/{id}/edit', [GuardianController::class, 'edit'])->name('guardians.edit')->middleware('permission:update guardian');
    Route::patch('/guardians/{guardian}', [GuardianController::class, 'update'])->name('guardians.update');
    Route::delete('/guardians/{guardian}', [GuardianController::class, 'destroy'])->name('guardians.destroy')->middleware('permission:delete guardian');
    Route::get('/guardiansfetch', [GuardianController::class, 'fetch'])->name('guardians.fetch');

    Route::get('/relations', [RelationController::class, 'index'])->name('relations.index')->middleware('permission:view relation');
    Route::get('/relations/create', [RelationController::class, 'create'])->name('relations.create')->middleware('permission:add relation');
    Route::post('/relations', [RelationController::class, 'store'])->name('relations.store');
    Route::get('/relations/{id}/edit', [RelationController::class, 'edit'])->name('relations.edit')->middleware('permission:update relation');
    Route::patch('/relations/{relation}', [RelationController::class, 'update'])->name('relations.update');
    Route::delete('/relations/{relation}', [RelationController::class, 'destroy'])->name('relations.destroy')->middleware('permission:delete relation');
    Route::get('/relations-fetch', [RelationController::class, 'fetch'])->name('relations.fetch');

    Route::get('/studentGuardian/create', [StudentGuardianController::class, 'create'])->name('studentGuardian.create')->middleware('permission:add guardian to student');
    Route::post('/studentGuardian', [StudentGuardianController::class, 'store'])->name('studentGuardian.store');
    Route::get('/studentGuardian/{id}/edit', [StudentGuardianController::class, 'edit'])->name('studentGuardian.edit')->middleware('permission:update guardian to student');
    Route::patch('/studentGuardian/{studentGuardian}', [StudentGuardianController::class, 'update'])->name('studentGuardian.update');
    Route::delete('/studentGuardian/{studentGuardian}', [StudentGuardianController::class, 'destroy'])->name('studentGuardian.destroy')->middleware('permission:delete guardian from student');

    Route::get('/updateStudentImage/{id}/edit', [UpdateImageController::class, 'edit'])->name('updateStudentImage.edit')->middleware('permission:add student photo');
    Route::patch('/updateStudentImage/{student}', [UpdateImageController::class, 'update'])->name('updateStudentImage.update');
    Route::delete('/updateStudentImage/{student}', [UpdateImageController::class, 'destroy'])->name('updateStudentImage.destroy')->middleware('permission:delete student photo');

});