<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Quiz;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function postaddquiz(){
        if(isset($_POST['submit'])){
            $quiz = new Quiz();
            //$quiz->id = auto_increment;
            $quiz->question = $_POST['question'];
            $quiz->answer1 = $_POST['answer1'];
            $quiz->answer2 = $_POST['answer2'];
            $quiz->answer3 = $_POST['answer3'];
            $quiz->answer4 = $_POST['answer4'];
            $quiz->trueAnswer = $_POST['trueAnswer'];;
            $quiz->type = $_POST['type'];
            $quiz->save();
            return view('AdminMathQuiz');
        }
    }
    public static function getquiz(){
        $quizs =  Quiz::all();
        $allQuestions = '';
        $number=0;
        foreach ($quizs as $row){
            $number++;
            $idEncoded=base64_encode(''.$row->id);
            $script = '<script>function delx (id){window.location=\'http://localhost:69/QuizFinal/public/deleteQuestion\''.'+id;alert(\'Succeed!\')}</script>';
            $allQuestions.='<div class='.'\'btn btn-answer col-lg-12 col-md-12 col-sm-12 col-xs-12\''.'onclick=\'delx("'.$idEncoded.'")\'>'.$row->id.'. '.$row->question.'</div>';

        }
        return $script.$allQuestions;
    }

    public static function questionDelete($id){
        $idDecoded=intval(base64_decode($id));
        $quizs=Quiz::all();
        $record=$quizs->find($idDecoded);
        $record->delete();
        echo '<script>window.location=\'http://localhost:69/QuizFinal/public/AdminEditMathQuiz\'</script>';
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
