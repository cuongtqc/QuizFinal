<?php header('Content-type: text/javascript'); ?>
new WOW().init();

// sử dụng ngAnimate để đỡ nhàm chán cho ng-show ng-hide. Kết hợp vs angular-fire
var app = angular.module('Quiz', ['ngAnimate']);

// leaderboard
app.controller( 'Leaderboard', function($scope) {
    /* form control */
    //show leader board
    $scope.userList = [];
});

//Update quiz
app.controller( 'UpdateQuiz', function( $scope) {
    //$scope.$apply( function(){
    $scope.addTab = false;
    $scope.editDB = true;
    $scope.editTab = false;
//});

/* Edit and Add question */
$scope.addQuestionTab = function() {
    $scope.editDB = false;
    $scope.addTab = true;
    $scope.editTab = false;
};

$scope.deleteQuestionTab = function() {
    $scope.editDB = false;
    $scope.addTab = false;
    $scope.editTab = true;
};

$scope.submit = function() {
    /* add question to server */

    $scope.editTab = false;
    $scope.editDB = true;
    $scope.addTab = false;
};

$scope.returnEdit = function () {
    $scope.editTab = false;
    $scope.editDB = true;
    $scope.addTab = false;
};
    $scope.returnEditRoot = function (){
        window.location = 'http://localhost:69/QuizFinal/public/mathQuiz';
    };
/* question database and score*/

});

//Login form
app.controller( 'LoginForm', function( $scope ) {
    /* user control */
    $scope.username = "";
    $scope.password = "";
    /* form control */
    $scope.score = 0;
    $scope.loged = false;

    // đăng kí, Log in và Log out
    $scope.Register = function() {
        //Hàm này được chuyển qua php, tại UserQuizFinalController lệnh postRegister
    };
    $scope.LogIn = function() {
        var link = 'http://localhost:69/QuizFinal/public/';
        //mã hóa tên tài khoản và mật khẩu
        var user = $scope.username;
        var pass = $scope.password;
        window.location = link + 'login/' + user + '/' + pass;
    };
    $scope.LogOut = function() {
        window.location = 'http://localhost:69/QuizFinal/public/logout';
    };
    });

    app.controller('TopicController', function( $scope ) {
    var rootLink = window.location.href;
    /* menu items( các loại câu hỏi ) */
    $scope.menu = [
    {
        icon: 'Se2015/Se2015-firebase-master/img/math.jpg',
        tittle: 'Math quiz',
        description: 'You think you are a math genius?',
        link: rootLink + 'mathQuiz',
    },
    {
        icon: 'Se2015/Se2015-firebase-master/img/troll.jpg',
        tittle: 'Funny quiz',
        description: 'You will never get a highscore at this quiz',
        link: rootLink + 'funnyQuiz',
    },
    {
        icon: 'Se2015/Se2015-firebase-master/img/travel.jpg',
        tittle: 'Travelling quiz',
        description: 'Quizzes on countries, cities, beaches, ....',
        link: rootLink + 'travelQuiz',
    },
    {
        icon: 'Se2015/Se2015-firebase-master/img/football.jpg',
        tittle: 'Football quiz',
        description: 'Do you know anything about football?',
        link: rootLink + 'footballQuiz',
    },
    {
        icon: 'Se2015/Se2015-firebase-master/img/iq.jpg',
        tittle: 'IQ test',
        description: "This will test your IQ, or it doesn't?",
        link: rootLink + 'IQQuiz',
    },
    {
        icon: 'Se2015/Se2015-firebase-master/img/japanese.jpg',
        tittle: 'Japanese culture',
        description: 'This quiz is about Japanese culture',
        link: rootLink + 'japanQuiz',
    }
    ];
});