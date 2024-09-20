<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EducationHistoryController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\OccupationController;
use App\Http\Controllers\RelationController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentGuardianController;
use App\Http\Controllers\UpdateImageController;
use App\Http\Controllers\UserController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/classrooms', [ClassroomController::class, 'index'])->name('classrooms.index');
    Route::get('/classrooms/create', [ClassroomController::class, 'create'])->name('classrooms.create');
    Route::post('/classrooms', [ClassroomController::class, 'store'])->name('classrooms.store');
    Route::get('/classrooms/{id}', [ClassroomController::class, 'show'])->name('classrooms.show');
    Route::get('/classrooms/{id}/edit', [ClassroomController::class, 'edit'])->name('classrooms.edit');
    Route::patch('/classrooms/{classroom}', [ClassroomController::class, 'update'])->name('classrooms.update');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::view('/abort', 'messages.abort');

    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::patch('/students/{student}', [StudentController::class, 'update'])->name('students.update');
    // Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::patch('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/departments/{id}', [DepartmentController::class, 'show'])->name('departments.show');
    Route::get('/departments/{id}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::patch('/departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');

    Route::get('/staffs', [StaffController::class, 'index'])->name('staffs.index');
    Route::get('/staffs/create', [StaffController::class, 'create'])->name('staffs.create');
    Route::post('/staffs', [StaffController::class, 'store'])->name('staffs.store');
    Route::get('/staffs/{id}', [StaffController::class, 'show'])->name('staffs.show');
    Route::get('/staffs/{id}/edit', [StaffController::class, 'edit'])->name('staffs.edit');
    Route::patch('/staffs/{staff}', [StaffController::class, 'update'])->name('staffs.update');
    // Route::delete('/staffs/{staff}', [StaffController::class, 'destroy'])->name('staffs.destroy');

    Route::get('/education-history/create', [EducationHistoryController::class, 'create'])->name('education-history.create');
    Route::post('/education-history', [EducationHistoryController::class, 'store'])->name('education-history.store');
    Route::get('/education-history/{id}/edit', [EducationHistoryController::class, 'edit'])->name('education-history.edit');
    Route::patch('/education-history/{education_history}', [EducationHistoryController::class, 'update'])->name('education-history.update');
    Route::delete('/education-history/{education_history}', [EducationHistoryController::class, 'destroy'])->name('education-history.destroy');

    Route::get('/occupations', [OccupationController::class, 'index'])->name('occupations.index');
    Route::get('/occupations/create', [OccupationController::class, 'create'])->name('occupations.create');
    Route::post('/occupations', [OccupationController::class, 'store'])->name('occupations.store');
    Route::get('/occupations/{id}/edit', [OccupationController::class, 'edit'])->name('occupations.edit');
    Route::patch('/occupations/{occupation}', [OccupationController::class, 'update'])->name('occupations.update');
    Route::delete('/occupations/{occupation}', [OccupationController::class, 'destroy'])->name('occupations.destroy');

    Route::get('/guardians', [GuardianController::class, 'index'])->name('guardians.index');
    Route::get('/guardians/create', [GuardianController::class, 'create'])->name('guardians.create');
    Route::post('/guardians', [GuardianController::class, 'store'])->name('guardians.store');
    Route::get('/guardians/{id}', [GuardianController::class, 'show'])->name('guardians.show');
    Route::get('/guardians/{id}/edit', [GuardianController::class, 'edit'])->name('guardians.edit');
    Route::patch('/guardians/{guardian}', [GuardianController::class, 'update'])->name('guardians.update');
    Route::delete('/guardians/{guardian}', [GuardianController::class, 'destroy'])->name('guardians.destroy');

    Route::get('/relations', [RelationController::class, 'index'])->name('relations.index');
    Route::get('/relations/create', [RelationController::class, 'create'])->name('relations.create');
    Route::post('/relations', [RelationController::class, 'store'])->name('relations.store');
    Route::get('/relations/{id}/edit', [RelationController::class, 'edit'])->name('relations.edit');
    Route::patch('/relations/{relation}', [RelationController::class, 'update'])->name('relations.update');
    Route::delete('/relations/{relation}', [RelationController::class, 'destroy'])->name('relations.destroy');

    Route::get('/studentGuardian/create', [StudentGuardianController::class, 'create'])->name('studentGuardian.create');
    Route::post('/studentGuardian', [StudentGuardianController::class, 'store'])->name('studentGuardian.store');
    Route::get('/studentGuardian/{id}/edit', [StudentGuardianController::class, 'edit'])->name('studentGuardian.edit');
    Route::patch('/studentGuardian/{studentGuardian}', [StudentGuardianController::class, 'update'])->name('studentGuardian.update');
    Route::delete('/studentGuardian/{studentGuardian}', [StudentGuardianController::class, 'destroy'])->name('studentGuardian.destroy');

    Route::get('/updateStudentImage/{id}/edit', [UpdateImageController::class, 'edit'])->name('updateStudentImage.edit');
    Route::patch('/updateStudentImage/{student}', [UpdateImageController::class, 'update'])->name('updateStudentImage.update');
    Route::delete('/updateStudentImage/{student}', [UpdateImageController::class, 'destroy'])->name('updateStudentImage.destroy');

});