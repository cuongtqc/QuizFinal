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

Route::get('/AdminEditQuiz', function () {
    return view('AdminEditQuiz');
});

Route::post('/AdminEditQuiz','QuizController@postaddquiz');


Route::get('/userProfile', function () {
    return view('userProfile');
});

Route::get('/deleteQuestion{id}', function($id){
    \App\Http\Controllers\QuizController::questionDelete($id);
    return view('AdminEditQuiz');
});

// ??ng nh?p, ??ng xu?t, ??ng k�
Route::get('/login/{user}/{pass}', function($user, $pass){
   \App\Http\Controllers\UserQuizFinalController::login($user, $pass);
});

Route::get('/leaderBoard', 'UserQuizFinalController@leaderBoard');

Route::post('/updateScore', 'UserQuizFinalController@updateScore');

Route::post('/register/', [
    'uses' => 'UserQuizFinalController@postRegister',
    'as' => 'user.register'
]);

Route::get('/randomQuest', [
    'uses' => 'QuizController@randomQuest',
    'as' =>'quiz.randomQuest'
]);


Route::get('/logout', function(){
    \App\Http\Controllers\UserQuizFinalController::logout();
    echo '<script>window.location = \'http://localhost:69/QuizFinal/public/\'</script>';
});

Route::get('/profile/{user}/{pass}', function($user, $pass){
    echo '<script type=\'text/javascript\'>alert(\'Login to profile Failed!\'); console.log(\''.$user.'\')</script>';

    \App\Http\Controllers\UserQuizFinalController::profile($user, $pass);
    return view('userProfile');
});

Route::post('/updateProfile', function(){
    \App\Http\Controllers\UserQuizFinalController::updateProfile();
});

//Chuy?n ??n c�c trang quiz
Route::get('/mathQuiz', function(){
    session_start();
    if(isset($_SESSION['userName'])) {
        return view('mathQuiz');
        exit;
    } else echo '<script>alert(\'Login first!\')</script>';
    echo '<script>window.location = \'http://localhost:69/QuizFinal/public/\'</script>';
});

Route::get('/funnyQuiz', function(){
    session_start();
    if(isset($_SESSION['userName'])) {
        return view('funnyQuiz');
    } else echo '<script>alert(\'Login first!\')</script>';
    echo '<script>window.location = \'http://localhost:69/QuizFinal/public/\'</script>';
});

Route::get('/travelQuiz', function(){
    session_start();
    if(isset($_SESSION['userName'])) {
        return view('travelQuiz');
    } else echo '<script>alert(\'Login first!\')</script>';
    echo '<script>window.location = \'http://localhost:69/QuizFinal/public/\'</script>';
});

Route::get('/footballQuiz', function(){
    session_start();
    if(isset($_SESSION['userName'])) {
        return view('footballQuiz');
    } else echo '<script>alert(\'Login first!\')</script>';
    echo '<script>window.location = \'http://localhost:69/QuizFinal/public/\'</script>';
});

Route::get('/IQQuiz', function(){
    session_start();
    if(isset($_SESSION['userName'])) {
        return view('IQQuiz');
    } else echo '<script>alert(\'Login first!\')</script>';
    echo '<script>window.location = \'http://localhost:69/QuizFinal/public/\'</script>';
});

Route::get('/japanQuiz', function(){
    session_start();
    if(isset($_SESSION['userName'])) {
        return view('japanQuiz');
    } else echo '<script>alert(\'Login first!\')</script>';
    echo '<script>window.location = \'http://localhost:69/QuizFinal/public/\'</script>';
});

//Chuy?n ??n c�c trang editQuiz
Route::get('/editMathQuiz', function(){
   return view('editMathQuiz');
});

Route::get('/editFunnyQuiz', function(){
    return view('editFunnyQuiz');
});

Route::get('/editTravelQuiz', function(){
    return view('editTravelQuiz');
});

Route::get('/editFootballQuiz', function(){
    return view('editFootballQuiz');
});

Route::get('/editIQQuiz', function(){
    return view('editIQQuiz');
});

Route::get('/editJapanQuiz', function(){
    return view('editJapanQuiz');
});