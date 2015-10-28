<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
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
        $users=UserQuizFinal::all();
        $auth = new UserQuizFinal();
        $flag = false;
        foreach($users as $user ){
            if ($user->userName==$userName && $user->userPass==$pass){
                $flag = true;
            }
        }
        if($flag==true) {
            echo '<script type="text/javascript">alert("Login Succeed!"); window.location="http://localhost:69/QuizFinal/public/"</script>';
            return $auth;
        }
        else {
            echo '<script type="text/javascript">alert("Login Failed!")</script>';
            return false;
        }
    }
    //  Register    //
    public static function postregister($id, $password){
        $user=new UserQuizFinal();
        $user->userName=$id;
        $user->userPass=$password;
        //$user->userMail=$mail;
        $user->score=0;
        $user->isAdmin=false;
        $user->save();
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
