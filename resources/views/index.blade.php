<?php
session_start();
if(isset($_SESSION['userName'])){
    $userName = $_SESSION['userName'];
    $userScore = $_SESSION['userScore'];
    $userEmail = $_SESSION['userEmail'];
    $userId = $_SESSION['userId'];
    $isAdmin = $_SESSION['isAdmin'];
	\App\Http\Controllers\QuizController::randomQuest();
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
	<div id="LoginTab" ng-controller="LoginForm" class="container-fluid wow fadeInDown">
		<!-- $scope.loged: bi?n cho bi?t user ?ã log in hay ch?a. Phiên b?n firebase ph?i ??ng nh?p b?ng email -->
		<div class="row" ng-hide="<?php echo isset($_SESSION['userName']); ?>">
			<form action="{{route('user.register')}}" method="POST">
				<div class="col-lg-5 col-md-4 col-sm-12 col-xs-12">
					<input type="text" name="userName" class="form-control input-lg input-login" ng-model="username" placeholder="UserName">
				</div>
				<div class="col-lg-5 col-md-4 col-sm-12 col-xs-12">
					<input type="password" name="password" class="form-control input-lg input-login" ng-model="password" placeholder="Password">
				</div>
				<button type="button" class="btn btn-lg btn-login col-lg-1 col-md-2 col-sm-6 col-xs-12" ng-click="LogIn()">Log in</button>
				<button type="submit" class="btn btn-lg btn-login col-lg-1 col-md-2 col-sm-6 col-xs-12" ng-click="Register()">Register</button>
			</form>
		</div>

		<!-- n?u ?ã login( in session ) thì s? thông báo xin chào. Tài kho?n m?i register c?n vào profile ch?nh s?a thông tin cá nhân -->
		<div class="row" ng-show="<?php echo isset($_SESSION['userName'])?>">
			<div class="col-lg-10 col-md-8 col-sm-6 col-xs-6">
				<p class="input-login"> Hi {{$userName}} </p>
			</div>
			<a href="#" type="button" class="btn btn-lg btn-login col-lg-1 col-md-2 col-sm-3 col-xs-3">Profile</a>
			<button type="button" class="btn btn-lg btn-login col-lg-1 col-md-2 col-sm-3 col-xs-3" ng-click="LogOut()">Log Out</button>
		</div>
	</div>

	<!-- Leaderboard: hi?n ra 5 ng??i có ?i?m cao nh?t( sau này s? thêm tính n?ng ?i?m/ s? bài test cao nh?t )  -->

	<div id="leaderboard" ng-controller="Leaderboard" class="container-fluid wow slideInLeft">
		<p class="leaderboard-tittle">  Leaderboard </p>
		<div class="row">
			<p class="leaderboard-tittle col-lg-1 col-md-2 col-sm-3 col-xs-3"> Users </p>
			<p class="leaderboard-tittle col-lg-1 col-md-2 col-sm-3 col-xs-3 col-lg-offset-10 col-md-offset-8 col-sm-offset-6 col-xs-offset-6"> Score </p>
		</div>
		<div ng-repeat="user in userList|orderBy:'-score'|limitTo:5" class="leaderboard-user">
			<p class="col-lg-2 col-md-2 col-sm-3 col-xs-3"> {{$userName}} </p>
			<p class="col-lg-1 col-md-1 col-sm-1 col-xs-2 col-lg-offset-9 col-md-offset-9 col-sm-offset-8 col-xs-offset-7"> {{$userScore}} </p>
		</div>
	</div>

	<!-- Các lo?i bài test -->
	<div ng-controller="TopicController" class="container-fluid wow slideInLeft">
		<div class="row no-gutter">
			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" ng-repeat="topic in menu">
				<a href="@{{ topic.link }}" class="card-box">
					<img src="@{{topic.icon}}" class="img">
					<div class="card-box-caption">
						<div class="card-box-caption-content">
							<div class="project-category text-faded">
								<h3>@{{topic.tittle}}</h3>
							</div>
							<div class="project-name">
								@{{topic.description}}
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>

	</body>
@stop