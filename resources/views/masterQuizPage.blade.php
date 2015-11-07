<?php
if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['userName'])){
    $userName = $_SESSION['userName'];
    $userScore = $_SESSION['userScore'];
    $userEmail = $_SESSION['userEmail'];
    $userId = $_SESSION['userId'];
    $isAdmin = $_SESSION['isAdmin'];
} else {
    $userName = 'Guest';
    $userScore = '';
    $userEmail = '';
    $userId = -1;
    $isAdmin = 0;
}

?>
@extends('master')
@section('body')
<body ng-app="Quiz" class="container-fluid">
<!-- Log in tab. N?u mà ?ang làm test thoát ra thì k?t qu? không ???c ch?p nh?n( L?u vào tài kho?n ) -->
<div id="LoginTab" ng-controller="LoginForm" class="container-fluid wow fadeInDown">
    <div class="row" ng-hide="<?php echo isset($_SESSION['userName']); ?>">
        <div class="col-lg-5 col-md-4 col-sm-12 col-xs-12">
            <input type="email" class="form-control input-lg input-login" ng-model="username" placeholder="Email">
        </div>
        <div class="col-lg-5 col-md-4 col-sm-12 col-xs-12">
            <input type="password" class="form-control input-lg input-login" ng-model="password" placeholder="Password">
        </div>
        <button type="button" class="btn btn-lg btn-login col-lg-1 col-md-2 col-sm-6 col-xs-12" ng-click="LogIn()">Log in</button>
        <button type="submit" class="btn btn-lg btn-login col-lg-1 col-md-2 col-sm-6 col-xs-12" ng-click="Register()">Register</button>
    </div>
    <div class="row" ng-show="<?php echo isset($_SESSION['userName']); ?>">
        <div class="col-lg-10 col-md-8 col-sm-6 col-xs-6">
            <p class="input-login"> Hi {{ $userName }} </p>
        </div>
        <a href="#" class="btn btn-lg btn-login col-lg-1 col-md-2 col-sm-3 col-xs-3">Profile</a>
        <button type="button" class="btn btn-lg btn-login col-lg-1 col-md-2 col-sm-3 col-xs-3" ng-click="LogOut()">Log Out</button>
    </div>
</div>

<img class="img-responsive" src="@yield('headerImage')">
<!-- L?u các bài test và các tr?ng thái c?a nó
    editDB = true: l?a ch?n gi?a vi?c edit ques DB hay take test. Ng??i dùng bth có th? vào trang edit DB nh?ng ko th? thêm hay xóa ???c
                    ( Nên s? ch? ?? xem list là chính ).
    !editDB && loaded && publish: loaded là bi?n cho bi?t 10 câu h?i ?ã ???c l?a ch?n random ch?a( bao g?m c? vi?c load t? server v? ).
                        publish: cho bi?t ng??i dùng ?ang ? câu 1 -> 9 hay là ? câu 10. Câu 1 -> 9 thì ?n submit s? ra câu ti?p. Câu 10 ?n submit
                        s? hi?n lên các ?áp án và thông báo ?i?m.
    !editDB && loaded && !publish Hi?n k?t qu?: Câu tr? l?i ?úng s? có màu xanh lá cây. Màu xanh d??ng là l?a ch?n c?a ng??i dùng. Màu ?? là k?t qu? sai.
    Dùng angular khá bí ? kho?n tái s? d?ng code trong 1 vài tr??ng h?p.
-->
<div ng-controller="QuestLibrary" class="container-fluid wow fadeInLeft" id="questionBoard" ng-show="loaded">
    <div class="row" ng-show="editDB">
        <a href="@yield('editPage')" class="btn btn-answer btn-lg col-lg-6 col-md-6 col-sm-12 col-xs-12">Edit question bank</a>
        <div class="btn btn-answer btn-lg col-lg-6 col-md-6 col-sm-12 col-xs-12" ng-click="takeTest()">Take test</div>
    </div>

    <div ng-show="publish && !editDB && loaded">
        <p class="question-style"> @yield('questionData') </p>
        <div class="row">
            <div class="btn btn-answer col-lg-3 col-sm-6 col-xs-12" ng-repeat="ans in currentQuestion.answer" ng-click="select($index)" ng-class="{sel: $index == selected}">
                @{{ ans }}
            </div>
        </div>
        <div class="btn btn-answer marginTop pull-left" ng-click="ReturnQuiz()"> Return </div>
        <div class="btn btn-answer marginTop pull-right" ng-click="submitQuestion()"> Submit </div>
    </div>

    <div ng-show="!publish && !editDB && loaded">
        <p class="question-style"> Your score is {{ $userScore }} </p>
        <div ng-repeat="question in list">
            <p class="question-style"> @{{ question.data }} </p>
            <p class="btn-answer col-lg-3 col-xs-6 col-xs-12" ng-repeat="ans in question.answer"
               ng-class="{sel: $index == getSel($parent.$index),right: $index == getRight($parent.$index),good:$index == getRight($parent.$index) && $index == getSel($parent.$index) }">
                @{{ ans }}
            </p>
        </div>
        <div class="btn btn-login btn-lg col-lg-2 col-lg-offset-10 col-md-3 col-md-offset-9 col-sm-6 col-sm-offset-6 col-xs-12" ng-click="ReturnQuiz()"> Return </div>
    </div>
</div>

</body>
@stop