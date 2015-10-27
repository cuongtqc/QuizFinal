new WOW().init();

var app = angular.module('Quiz', ['ngAnimate']);


app.controller( 'LoginForm', function( $scope  ) {
	/* user control */
	$scope.username = "";
	$scope.password = "";
	/* form control */
	$scope.score = 0;
});

app.controller('TopicController', function( $scope ) {
	/* menu items */
	var rootLink = window.location.href;
	$scope.menu = [
		{ 
			icon: 'Se2015/Se2015-firebase-master/img/math.jpg',
			tittle: 'Math quiz', 
			description: 'You think you are a math genius?',
			link:rootLink+'AdminMathQuiz',
		},
		{
			icon: 'Se2015/Se2015-firebase-master/img/troll.jpg',
			tittle: 'Funny quiz',
			description: 'You will never get a highscore at this quiz',
			link: '#',
		},
		{
			icon: 'Se2015/Se2015-firebase-master/img/travel.jpg',
			tittle: 'Travelling quiz',
			description: 'Quizzes on countries, cities, beaches, ....',
			link: '#',
		},
		{
			icon: 'Se2015/Se2015-firebase-master/img/football.jpg',
			tittle: 'Football quiz',
			description: 'Do you know anything about football?',
			link: '#',
		},
		{
			icon: 'Se2015/Se2015-firebase-master/img/iq.jpg',
			tittle: 'IQ test',
			description: "This will test your IQ, or it doesn't?",
			link: '#',
		},
		{
			icon: 'Se2015/Se2015-firebase-master/img/japanese.jpg',
			tittle: 'Japanese culture',
			description: 'This quiz is about Japanese culture',
			link: '#',
		}
	];
});