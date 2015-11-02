<!DOCTYPE html>

<!-- hoàn toàn giống math.quiz và các bài quiz khác, tách ra chỉ để kiểm soát dễ hơn. -->
<html>
    <head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="../../public/Se2015/Se2015-firebase-master/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../../public/Se2015/Se2015-firebase-master/css/animate.min.css" />
		<link rel="stylesheet" href="../../public/Se2015/Se2015-firebase-master/css/main.css" />
		<link rel="stylesheet" href="../../public/Se2015/Se2015-firebase-master/css/addQuiz.css" />

		<script src="../../public/Se2015/Se2015-firebase-master/js/system/jquery.min.js"> </script>
		<script src="../../public/Se2015/Se2015-firebase-master/js/system/bootstrap.min.js"> </script>
		<script src="../../public/Se2015/Se2015-firebase-master/js/system/angular.min.js"> </script>
		<script src="../../public/Se2015/Se2015-firebase-master/js/system/angular-animate.min.js"> </script>
		<script src="../../public/Se2015/Se2015-firebase-master/js/system/wow.min.js"> </script>
		<script src="../../public/Se2015/Se2015-firebase-master/js/system/firebase.js"> </script>
		<script src="../../public/Se2015/Se2015-firebase-master/js/system/angularfire.min.js"> </script>
		
		<script src="../../public/Se2015/Se2015-firebase-master/js/main.js"> </script>
		<script src="../../public/Se2015/Se2015-firebase-master/js/funny/editQuiz.js"> </script>
    </head>
	
    <body ng-app="Quiz" class="container-fluid">
		
		<div ng-controller="UpdateFunny" class="container-fluid wow fadeInLeft" id="questionBoard">
			<!-- chỉ có thêm và xóa câu hỏi, chưa có phần chỉnh sửa câu hỏi( vì không cần thiết lắm, có thể chỉnh sửa dễ dàng trên firebase server ) -->
			<p class="input-answer center-block leaderboard-tittle"> Funny </p>
			
			<div class="row" ng-show="editDB">
				<div class="btn btn-answer btn-lg col-lg-6 col-md-6 col-sm-12 col-xs-12" ng-click="addQuestionTab()">Add Question</div>
				<div class="btn btn-answer btn-lg col-lg-6 col-md-6 col-sm-12 col-xs-12" ng-click="deleteQuestionTab()">Delete Question</div>
			</div>
			
			<div ng-show="addTab && loaded">
				<p class="input-answer"> Question: </p>
				<input class="form-control" type="text" placeholder="Question" ng-model="q.data">
				<p class="input-answer"> Four choices </p>
				<input class="form-control" type="text" placeholder="Answer 1" ng-model="q.answer[0]">
				<input class="form-control" type="text" placeholder="Answer 2" ng-model="q.answer[1]">
				<input class="form-control" type="text" placeholder="Answer 3" ng-model="q.answer[2]">
				<input class="form-control" type="text" placeholder="Answer 4" ng-model="q.answer[3]">
				<p class="input-answer"> Right answer </p>
				<input class="form-control" type="number" min="1" max="4" ng-model="q.right">
				<button class="btn btn-lg btn-answer pull-left" type="button" ng-click="returnEdit()"> Return </button>	
				<button class="btn btn-lg btn-answer pull-right" type="submit" ng-click="submitQuestion()"> Submit </button>
				<button class="btn btn-lg btn-answer center-block" type="button" ng-click="clearQuestion()"> Clear </button>
			</div>
			
			<div ng-show="editTab && loaded" class="row">
				<button class="btn btn-lg btn-answer col-lg-2 col-md-3 col-sm-4 col-xs-5" type="button" ng-click="returnEdit()"> Return </button>	
				<div class="marginTop" ng-repeat="q in temp">
					<div class="btn btn-answer col-lg-12 col-md-12 col-sm-12 col-xs-12" ng-click="deleteQuiz($index)"> {{ q.data }} </div>
				</div>
			</div>
		</div>

    </body>
</html>
