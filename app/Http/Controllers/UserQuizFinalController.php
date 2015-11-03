<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Routing\Controller;
use App\UserQuizFinal;

class UserQuizFinalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  Check login //
    public static function login($userName, $pass){
        /*Ki?m tra ??ng nhâp cho ng??i dùng
        N?u ng??i dùng có trong csdl thì ki?m tra xem có ph?i là admin hay không ??ng th?i ?n ?i ph?n login và hi?n
        thanh greeting và nut logout
        */
        $users=UserQuizFinal::all();
        $auth = new UserQuizFinal();
        $flag = false;
        foreach($users as $user ){
            if ($user->userName==$userName && $user->userPass==$pass){
                $flag = true;
                session_start();
                $_SESSION['userId']=$user->userId;
                $_SESSION['userName']=$user->userName;
                $_SESSION['userScore']=$user->userScore;
                $_SESSION['userEmail']=$user->userEmail;
                $_SESSION['isAdmin']=$user->isAdmin;
                break;
            }
        }
        if($flag==true) {
            //echo '<script type="text/javascript">alert("Login Succeed!"); </script>';
            echo '<script>window.location = \'http://localhost:69/QuizFinal/public/\'</script>';
            return true;
        }
        else {
            echo '<script type="text/javascript">alert("Login Failed!")</script>';
            echo '<script>window.location = \'http://localhost:69/QuizFinal/public/\'</script>';
            return false;
        }
    }

    //  Register    //
    public static function register($id, $password){
        $user=new UserQuizFinal();
        $user->userName=$id;
        $user->userPass=$password;
        //$user->userMail=$mail;
        $user->score=0;
        $user->isAdmin=false;
        $user->save();
    }
    // Logout       //
    public static function  logout(){
        session_start();
        session_destroy();
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
