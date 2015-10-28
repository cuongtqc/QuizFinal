<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('AdminMathQuiz', function(){
    return view('AdminMathQuiz');
});

Route::get('/AdminEditMathQuiz', function () {
    return view('AdminEditMathQuiz');
});

Route::post('/AdminEditMathQuiz','QuizController@postaddquiz');


Route::get('/userProfile', function () {
    return view('userProfile');
});
Route::get('/deleteQuestion{id}', function($id){
    \App\Http\Controllers\QuizController::questionDelete($id);
    return view('AdminEditMathQuiz');
});
Route::get('/login{user}/{pass}', function($user, $pass){
   \App\Http\Controllers\UserQuizFinalController::login($user, $pass);
});
Route::post('/register{id}/{pass}', function($id, $pass){
    \App\Http\Controllers\UserQuizFinalController::postregister($id, $pass);
});
