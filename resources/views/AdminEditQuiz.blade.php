@extends('masterEditQuiz')
@section('body')
    <body ng-app="Quiz" class="container-fluid">
		
		<div ng-controller="UpdateQuiz" class="container-fluid wow fadeInLeft" id="questionBoard">

			<div class="row" ng-show="editDB">
				<div class="btn btn-answer btn-lg col-lg-6 col-md-6 col-sm-12 col-xs-12" ng-click="addQuestionTab()">Add Question</div>
				<div class="btn btn-answer btn-lg col-lg-6 col-md-6 col-sm-12 col-xs-12" ng-click="deleteQuestionTab()">Delete Question</div>
				<button class="btn btn-lg btn-answer pull-left" type="button" ng-click="returnEditRoot()"> Return </button>
			</div>

			<div ng-show="addTab">
				<form action="<?php echo \App\Http\Controllers\QuizController::postaddquiz()?>" method="POST">
					<p class="input-answer"> Question: </p>
					<input class="form-control" type="text" placeholder="Question" name="question">
					<p class="input-answer"> Four choices </p>
					<input class="form-control" type="text" placeholder="Answer 1" name="answer1">
					<input class="form-control" type="text" placeholder="Answer 2" name="answer2">
					<input class="form-control" type="text" placeholder="Answer 3" name="answer3">
					<input class="form-control" type="text" placeholder="Answer 4" name="answer4">
					<p class="input-answer"> Right answer </p>
					<input class="form-control" type="number" min="1" max="4" name="trueAnswer">
					<p class="input-answer"> Type </p>
					<input class="form-control" type="text" name="type">
					<!-- Them the loai cau hoi vao day -->
					<button class="btn btn-lg btn-answer pull-left" type="button" ng-click="returnEdit()"> Return </button>
					<button class="btn btn-lg btn-answer pull-right" type="submit" name="submit" onclick="addQuiz()"> Submit </button>
					<button class="btn btn-lg btn-answer center-block" type="button" ng-click="clearQuestion()"> Clear </button>
				</form>
			</div>

			<!--Javascript AJAX-->

			<div ng-show="editTab" class="row">
				<button class="btn btn-lg btn-answer col-lg-2 col-md-3 col-sm-4 col-xs-5" type="button" ng-click="returnEdit()"> Return </button>

				<div class="marginTop">
					<?php
						echo \App\Http\Controllers\QuizController::getquiz();
					?>
				</div>

			</div>
		</div>


    </body>
@stop
