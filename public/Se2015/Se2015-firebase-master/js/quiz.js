var QuestArr = [];
var avail = [];
var choice = [];
var QuizBank = [];

var random = function( length ) {
	return Math.floor( Math.random() * length );
};

/* init là ?? chu?n b? thông tin ban ??u, regen là n?u ng??i dùng mu?n làm l?i test. 
 Máy s? l?y h?t t?t c? các câu h?i trên server và ch?y thu?t toán ch?n random 10 câu
 trong js.
 Ph?n ch?n 10 câu h?i này có th? reuse code nh?ng ko c?n thi?t */

var init = function( length , max ) {
	for( var i = 0; i < length; i ++ ) {
		avail.push( true );
		choice.push( 0 );
	}
	for( var i = 0; i < max; i ++ ) {
		var next = random( length );
		while ( !avail[next] ) next = random( length );
		QuestArr.push( next );
		avail[next] = false;
	}
};

var regen = function( length , max ) {
	for( var i = 0; i < length; i ++ ) {
		avail[i] = true;
		choice[i] = 0;
	}
	for( var i = 0; i < max; i ++ ) {
		var next = random( length );
		while ( !avail[next] ) next = random( length );
		QuestArr[i] = next;
		avail[next] = false;
	}
};

app.controller( 'QuestLibrary' , function( $scope ) {

	// initiate value
	// các bi?n này ch? là ?? ki?m soát vi?c click vào nút gì thì nó hide show cái gì thôi
	$scope.publish = true;
	$scope.editDB = true;
	$scope.loaded = false;

	/* index: câu h?i hi?n t?i trong 10 câu h?i.
	 score: ?i?m c?a bài test hi?n t?i
	 list: 10 câu h?i ???c ch?n random t? bank
	 */
	$scope.index = 0;
	$scope.score = 0;
	$scope.list = [];


	// cái này là sao khi ?n take test phát là editDB = false => ?n ?i cái editDB, và cái khác s? hi?n lên :))
	$scope.takeTest = function() {
		$scope.editDB = false;
	};
	$scope.userDef = {
		uid: "",
		name: "",
		score: 0
	};

	// user control
	// l?y thông tin user, ??ng th?i ph?i l?y dk score, tên, blah blah
	// $scope.loged c?ng là log in ch?a nhé. Cái này có th? là boolean ho?c là 1 object. N?u object r?ng thì ~ false. Bên HTML s? hi?u th?
	$scope.name = "";
	$scope.userIndex = -1;
	$scope.loged = false;


	// synchronize data from server. load ???c câu h?i thì m?i ???c l?a ch?n take test.
	// $scope.loaded = true thì là ?ã synchronize ???c ??ng câu h?i t? server v?, khi ?ó m?i cho ng??i dùng l?a ch?n take test hay là edit question database
	// e ?? nguyên ph?n code firebase cho a d? t??ng t??ng nhé
	$scope.loaded = false;
	var bank = [];	// ch?a toàn b? các câu h?i trong database
	/* 
	 var math = new Firebase("https://se15.firebaseio.com/math");
	 var bank = $firebaseArray( math );
	 bank.$loaded(
	 function( data ) {
	 $scope.loaded = true;
	 init( data.length , Math.min( 10 , data.length ) );
	 for( var i = 0; i < Math.min( 10 , data.length ); i ++ )
	 $scope.list.push( data[QuestArr[i]] );
	 $scope.currentQuestion = data[ QuestArr[0] ];
	 QuizBank = data;
	 },
	 function(error) {
	 console.error("Error:", error);
	 }
	 ); */

	/* select answer */
	/* l?a ch?n 1 trong 4 ?áp án thôi */
	$scope.selected = -1;
	$scope.select = function( index ) {
		$scope.selected = index;
	};

	/* Test */
	// ?n submit xong thì nó truy xu?t cái này, éo liên quan server ?âu ??c cho bi?t thôi a
	$scope.submitQuestion = function() {
		/* increase point after a good answer */
		if ( $scope.selected == $scope.currentQuestion.right ) $scope.score += 10;
		choice[ QuestArr[$scope.index] ] = $scope.selected;

		/* next question */
		if ( $scope.index <= $scope.list.length - 1 ) $scope.index ++;
		$scope.currentQuestion = bank[ QuestArr[$scope.index] ];

		$scope.selected = -1; /* reset answer */
		if ( $scope.index == $scope.list.length ) return $scope.submitTest();
		/* if user submit the last question, return all answer and score */
	};

	/* publish score and question */
	// ch?ch xong 10 câu h?i s? ph?i truy xu?t server và c?ng ?i?m cho ng??i dùng
	$scope.submitTest = function() {
		$scope.publish = false;
		// ph?n c?ng ?i?m code d??i, nh? s?a l?i $scope.score = 0 sau khi c?ng
		/* $scope.userIndex = $scope.getUser( ref.getAuth() );
		 if ( $scope.userIndex >= 0 ) {
		 userList[$scope.userIndex].score += $scope.score;
		 userList.$save( $scope.userIndex ).then( function() {
		 console.log( "Save user's score successfully!")
		 });
		 $scope.score = 0;
		 }	 */
	};

	/* class for selected answer and right answer */
	$scope.getSel = function( index ) {
		return choice[index];
	};
	$scope.getRight = function( index ) {
		return bank[index].right;
	};
	$scope.good = function( index ) {
		return ( $scope.getSel( index ) == index && $scope.getRight( index ) == index );
	};

	/* Return mathQuiz index */
	$scope.ReturnQuiz = function() {
		$scope.publish = true;
		$scope.editDB = true;
		$scope.index = 0;
		$scope.score = 0;
		regen( bank.length , $scope.list.length );
		for( var i = 0; i < $scope.list.length; i ++ )
			$scope.list[i] = QuizBank[QuestArr[i]];
		$scope.currentQuestion = QuizBank[ QuestArr[0] ];
	};
});