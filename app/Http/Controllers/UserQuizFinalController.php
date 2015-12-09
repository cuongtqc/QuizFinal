<?php

namespace App\Http\Controllers;

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
                $_SESSION['name']=$user->name;
                $_SESSION['userScore']=$user->userScore;
                $_SESSION['userEmail']=$user->userEmail;
                $_SESSION['isAdmin']=$user->isAdmin;
                $_SESSION['userPass']=$user->userPass;
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
    public static function postRegister(){
        if(isset($_POST['userName'])){
            $user=new UserQuizFinal();
            $user->userName=$_POST['userName'];
            $user->userPass=$_POST['password'];
            //$user->userMail=$mail;
            $user->userScore=0;
            $user->isAdmin=false;
            $user->save();
            echo '<script type="text/javascript">alert("Register Succeed!")</script>';
            echo '<script>window.location = \'http://localhost:69/QuizFinal/public/\'</script>';
        } else {
            echo '<script type="text/javascript">alert(\'Submit failed!\')</script>';
        }
    }
    // Logout       //
    public static function  logout(){
        session_start();
        session_destroy();
    }

    // Profile //

    public static function profile($userName, $pass){

        $users=UserQuizFinal::all();
        $flag = false;
        foreach($users as $user ){
            if ($user->userName==$userName && $user->userPass==$pass){
                $flag = true;
                session_start();
                $_SESSION['userId']=$user->userId;
                $_SESSION['name']=$user->name;
                $_SESSION['userName']=$user->userName;
                $_SESSION['userScore']=$user->userScore;
                $_SESSION['userEmail']=$user->userEmail;
                $_SESSION['isAdmin']=$user->isAdmin;
                $_SESSION['userPass']=$user->userPass;
                break;
            }
        }
        if($flag==true) {
            //echo '<script type="text/javascript">alert("Login Succeed!"); </script>';
            //echo '<script>window.location = \'http://localhost:69/QuizFinal/public/\'</script>';
            return true;
        }
        else {
            echo '<script type="text/javascript">alert("Login to profile Failed!")</script>';
            echo '<script>window.location = \'http://localhost:69/QuizFinal/public/\'</script>';
            return false;
        }
    }

    public static function leaderBoard(){
        $users = UserQuizFinal::all();
        $userList = [];
        foreach ($users as $user){
            array_push($userList,['username'=>$user->userName, 'userScore'=>$user->userScore]);
        }
        return json_encode($userList);
    }

    public static function updateScore(){
        $cdm = UserQuizFinal::find($_POST['username']);
        $cdm->userScore +=$_POST['userScore'];
        $cdm->save();
        return 'Okay';
    }

    public static function updateProfile(){
        $cdm = UserQuizFinal::find($_POST['username']);
        if($_POST['currentPassword']!=''){
            if($_POST['newPassword']!=$_POST['newPasswordCompare']) return 'New password dif Retype password';
            else {
                $cdm->userPass = $_POST['newPassword'];
            }

        }
        if($_POST['name']!=''){
            $cdm->name = $_POST['name'];
        }
        $cdm->save();
        return 'Okay';
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
