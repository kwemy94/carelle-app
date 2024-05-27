<?php

use App\Models\Setting;
use App\Models\Questionnaire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SolutionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuestionnaireController;

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
    $questionnaires = Questionnaire::where('status', 1)->get();
    $canRegister = Setting::where('name', "Activer l'enregistrement des utilisateurs")->first();
    return view('welcome', compact('questionnaires', 'canRegister'));
})->name('home');

# Language management
Route::get('lang/home', [LangController::class, 'index']);
Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');


# Dashboard management
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('/questionnaire', QuestionnaireController::class);
    Route::get('/Quiz/{id}/publish', [QuestionnaireController::class, 'publishQuiz'])->name('publish.quiz');
    Route::resource('/use-method', CategoryController::class);
    Route::resource('/quiz-answer', AnswerController::class);
    Route::get('/quiz-general-report', [AnswerController::class, 'IndexGeneralReport'])->name('rapport.general.index');
    Route::get('/quiz-general/{id}/report', [AnswerController::class, 'generalReport'])->name('rapport.general.chart');
    Route::resource('/solution', SolutionController::class);
    Route::resource('/settings', SettingController::class);
    Route::resource('/question', QuestionController::class);
    Route::get('/list-user', [UserController::class, 'index'])->name('list.all.user');
    Route::delete('/delete/{id}/user', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::get('quiz/{id}/chouse', [QuestionnaireController::class, 'show'])->name('show-quiz-selected');
Route::post('quiz/answer', [AnswerController::class, 'store'])->name('quiz.answer');

require __DIR__.'/auth.php';
