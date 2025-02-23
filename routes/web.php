<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

use App\Models\Teacher;
use App\Models\Student;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminFacultyController;
use App\Http\Controllers\AdminMajorController;
use App\Http\Controllers\AdminFormalClassController;
use App\Http\Controllers\AdminCreditClassController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\AdminTeacherController;
use App\Http\Controllers\AdminSubjectController;
use App\Http\Controllers\AdminScoreController;
use App\Http\Controllers\AdminTrainingSystemController;
use App\Http\Controllers\AdminSchoolYearController;
use App\Http\Controllers\AdminMemberController;

use App\Http\Controllers\FormalClassController;
use App\Http\Controllers\CreditClassController;
use App\Http\Controllers\ScoreController;

use App\Http\Controllers\DashboardController;

use App\Http\Imports\FacultyImport;
use App\Http\Imports\MajorImport;
use App\Http\Imports\FormalClassImport;
use App\Http\Imports\CreditClassImport;
use App\Http\Imports\StudentImport;
use App\Http\Imports\TeacherImport;
use App\Http\Imports\SubjectImport;
use App\Http\Imports\ScoreImport;
use App\Http\Imports\TrainingSystemImport;
use App\Http\Imports\SchoolYearImport;
use App\Http\Imports\MemberImport;

Route::get('/', function ($locale) {
    return redirect(app()->getLocale());
});

Route::prefix('{locale}')->middleware('web')->group(function () {
    // Delete account and logout
    Route::get('/', function () {
        // return view('welcome');
        return redirect(route('login'));
    });

    Route::get('dashboard', [AdminDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('dashboard/student', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('student.dashboard')->can('student');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    // Teacher Profile
    Route::get('profile/teacher', function () {
        $info = Teacher::find(Auth::user()->identifier);

        return view('profile.teacher', compact('info'));
    })->middleware('auth')->name('profile.teacher')->can('teacher');

    // Student Profile
    Route::get('profile/student', function () {
        $info = Student::find(Auth::user()->identifier);

        return view('profile.student', compact('info'));
    })->middleware('auth')->name('profile.student')->can('student');

    // Sidebar Toggle
    Route::get(url(''), function () {
        if (session()->has('sidebar')) {
            if (session()->get('sidebar') === 'sm')
                session(['sidebar' => 'lg']);
            else
                session(['sidebar' => 'sm']);
        } else
            session(['sidebar' => 'sm']);

        return Redirect::back();
    })->name('sidebar.toggle');

    // Multiple Locale
    Route::get('lang/{lang}', function (Request $request, string $currentLocale, $lang) {
        App::setLocale($lang);
        URL::defaults(['locale' => $lang]);

        $prevUrl = parse_url(URL::previous(), PHP_URL_PATH);
        $segments = explode('/', $prevUrl);
        foreach ($segments as &$segment) {
            if (in_array($segment, config('app.available_locales'))) {
                $segment = $lang;
                break;
            }

            array_shift($segments);
        }

        $url = implode('/', $segments);
        return Redirect::to($url);
    })->name('lang');

    //! Import Excel data file
    Route::middleware('CheckExcelFile')->group(function () {
        Route::post('faculty-import', [FacultyImport::class, 'model'])->name('import.faculty');
        Route::post('major-import', [MajorImport::class, 'model'])->name('import.major');
        Route::post('formal-class-import', [FormalClassImport::class, 'model'])->name('import.formal-class');
        Route::post('credit-class-import', [CreditClassImport::class, 'model'])->name('import.credit-class');
        Route::post('student-import', [StudentImport::class, 'model'])->name('import.student');
        Route::post('teacher-import', [TeacherImport::class, 'model'])->name('import.teacher');
        Route::post('subject-import', [SubjectImport::class, 'model'])->name('import.subject');
        Route::post('score-import/{credit_class}', [ScoreImport::class, 'model'])->name('import.score');
        Route::post('training-system-import', [TrainingSystemImport::class, 'model'])->name('import.training-system');
        Route::post('school-year-import', [SchoolYearImport::class, 'model'])->name('import.school-year');
        Route::post('member-import', [MemberImport::class, 'model'])->name('import.member');
    });

    //! Faculty
    Route::resource('faculty', AdminFacultyController::class);
    Route::post('faculty/{faculty}', [AdminFacultyController::class, 'update'])->name('faculty.update');
    Route::get('faculty/{faculty}', [AdminFacultyController::class, 'destroy'])->name('faculty.destroy');

    //! Major
    Route::resource('major', AdminMajorController::class);
    Route::get('major/create/{faculty_code}', [AdminMajorController::class, 'create'])->name('major.create');
    Route::post('major/{major}', [AdminMajorController::class, 'update'])->name('major.update');
    Route::get('major/{major}', [AdminMajorController::class, 'destroy'])->name('major.destroy');

    //! Formal Class
    Route::resource('formal-class', AdminFormalClassController::class);
    Route::post('formal-class/{formal_class}', [AdminFormalClassController::class, 'update'])->name('formal-class.update')->can('admin');
    Route::get('formal-class/{formal_class}', [AdminFormalClassController::class, 'destroy'])->name('formal-class.destroy')->can('admin');

    //? Teacher Role
    Route::get('formal-class/teacher/list', [FormalClassController::class, 'teacher'])->name('teacher.formal-class')->can('teacher');

    //? Student Role
    Route::get('formal-class/student/list', [FormalClassController::class, 'student'])->name('student.formal-class')->can('student');

    //! Credit Class
    Route::resource('credit-class', AdminCreditClassController::class);
    Route::post('credit-class/{credit_class}', [AdminCreditClassController::class, 'update'])->name('credit-class.update')->can('admin');
    Route::get('credit-class/{credit_class}', [AdminCreditClassController::class, 'destroy'])->name('credit-class.destroy')->can('admin');

    // List student
    Route::get('credit-class/{credit_class}/list-student', [AdminCreditClassController::class, 'list'])->name('credit-class.list');
    Route::get('credit-class/create/student/{student}', [AdminCreditClassController::class, 'createStudent'])->name('credit-class.create.student');
    Route::post('credit-class/store/student/{student}', [AdminCreditClassController::class, 'storeStudent'])->name('credit-class.store.student');
    Route::get('credit-class/edit/student/{student}', [AdminCreditClassController::class, 'editStudent'])->name('credit-class.edit.student');
    Route::post('credit-class/update/student/{student}', [AdminCreditClassController::class, 'updateStudent'])->name('credit-class.update.student');
    Route::get('credit-class/destroy/student/{student}', [AdminCreditClassController::class, 'destroyStudent'])->name('credit-class.destroy.student');

    //? Teacher Role
    Route::get('credit-class/teacher/list', [CreditClassController::class, 'teacher'])->name('teacher.credit-class')->can('teacher');

    //? Student Role
    Route::get('credit-class/student/list', [CreditClassController::class, 'student'])->name('student.credit-class')->can('student');

    //! Student
    Route::resource('student', AdminStudentController::class);
    Route::post('student/{student}', [AdminStudentController::class, 'update'])->name('student.update')->can('admin');
    Route::get('student/{student}', [AdminStudentController::class, 'destroy'])->name('student.destroy')->can('admin');

    // Get Major By Faculty
    Route::get('getMajorByFaculty/{faculty}', [AdminStudentController::class, 'getMajorByFaculty'])->name('student.getMajorByFaculty')->can('admin');

    // Get Formal Class By Major
    Route::get('getFormalClassByMajor/{major}', [AdminStudentController::class, 'getFormalClassByMajor'])->name('student.getFormalClassByMajor')->can('admin');

    //! Teacher
    Route::resource('teacher', AdminTeacherController::class);
    Route::post('teacher/{teacher}', [AdminTeacherController::class, 'update'])->name('teacher.update')->can('admin');
    Route::get('teacher/{teacher}', [AdminTeacherController::class, 'destroy'])->name('teacher.destroy')->can('admin');

    //! Subject
    Route::resource('subject', AdminSubjectController::class);
    Route::post('subject/{subject}', [AdminSubjectController::class, 'update'])->name('subject.update')->can('admin');
    Route::get('{subject}/subject', [AdminSubjectController::class, 'destroy'])->name('subject.destroy')->can('admin');

    //! Score
    Route::resource('score', AdminScoreController::class);
    Route::get('score/create/{score}', [AdminScoreController::class, 'create'])->name('score.create')->can('teacher');
    Route::post('score/store/{credit_class}', [AdminScoreController::class, 'store'])->name('score.store')->can('teacher');
    Route::post('score/update/{score}/{credit_class}', [AdminScoreController::class, 'update'])->name('score.update')->can('teacher');
    Route::get('credit-class/score/{score}/show', [AdminScoreController::class, 'show'])->name('score.show')->can('teacher');

    //? Student Role
    Route::get('score/student/list', [ScoreController::class, 'student'])->name('student.score')->can('student');
    Route::get('score/student/{year}', [ScoreController::class, 'changeSchoolYear'])->name('student.changeSchoolYear')->can('student');
    Route::get('score/student/list/{year}', [ScoreController::class, 'redirectStudentScore'])->name('student.redirectScore')->can('student');

    //! Training System
    Route::resource('training-system', AdminTrainingSystemController::class);
    Route::post('training-system/{training_system}', [AdminTrainingSystemController::class, 'update'])->name('training-system.update')->can('admin');
    Route::get('training-system/{training_system}', [AdminTrainingSystemController::class, 'destroy'])->name('training-system.destroy')->can('admin');

    //! School Year
    Route::resource('school-year', AdminSchoolYearController::class);
    Route::post('school-year/{school_year}', [AdminSchoolYearController::class, 'update'])->name('school-year.update')->can('admin');
    Route::get('school-year{school_year}', [AdminSchoolYearController::class, 'destroy'])->name('school-year.destroy')->can('admin');

    //! Member
    Route::resource('member', AdminMemberController::class);
    Route::post('member/{member}', [AdminMemberController::class, 'update'])->name('member.update')->can('admin');
    Route::get('{member}/member', [AdminMemberController::class, 'destroy'])->name('member.destroy')->can('admin');

    // Get identifier
    Route::get('identifier/{member}', [AdminMemberController::class, 'identify'])->name('member.identify')->can('admin');
    Route::get('info/{member}', [AdminMemberController::class, 'info'])->name('member.info')->can('admin');

    require __DIR__ . '/auth.php';
});
