var QuestArr = [];
var avail = [];
var choice = [];
var QuizBank = [];

var random = function( length ) {
	return Math.floor( Math.random() * length );
};

/* init l� ?? chu?n b? th�ng tin ban ??u, regen l� n?u ng??i d�ng mu?n l�m l?i test. 
 M�y s? l?y h?t t?t c? c�c c�u h?i tr�n server v� ch?y thu?t to�n ch?n random 10 c�u
 trong js.
 Ph?n ch?n 10 c�u h?i n�y c� th? reuse code nh?ng ko c?n thi?t */

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
	// c�c bi?n n�y ch? l� ?? ki?m so�t vi?c click v�o n�t g� th� n� hide show c�i g� th�i
	$scope.publish = true;
	$scope.editDB = true;
	$scope.loaded = false;

	/* index: c�u h?i hi?n t?i trong 10 c�u h?i.
	 score: ?i?m c?a b�i test hi?n t?i
	 list: 10 c�u h?i ???c ch?n random t? bank
	 */
	$scope.index = 0;
	$scope.score = 0;
	$scope.list = [];


	// c�i n�y l� sao khi ?n take test ph�t l� editDB = false => ?n ?i c�i editDB, v� c�i kh�c s? hi?n l�n :))
	$scope.takeTest = function() {
		$scope.editDB = false;
	};
	$scope.userDef = {
		uid: "",
		name: "",
		score: 0
	};

	// user control
	// l?y th�ng tin user, ??ng th?i ph?i l?y dk score, t�n, blah blah
	// $scope.loged c?ng l� log in ch?a nh�. C�i n�y c� th? l� boolean ho?c l� 1 object. N?u object r?ng th� ~ false. B�n HTML s? hi?u th?
	$scope.name = "";
	$scope.userIndex = -1;
	$scope.loged = false;


	// synchronize data from server. load ???c c�u h?i th� m?i ???c l?a ch?n take test.
	// $scope.loaded = true th� l� ?� synchronize ???c ??ng c�u h?i t? server v?, khi ?� m?i cho ng??i d�ng l?a ch?n take test hay l� edit question database
	// e ?? nguy�n ph?n code firebase cho a d? t??ng t??ng nh�
	$scope.loaded = false;
	var bank = [];	// ch?a to�n b? c�c c�u h?i trong database
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
	/* l?a ch?n 1 trong 4 ?�p �n th�i */
	$scope.selected = -1;
	$scope.select = function( index ) {
		$scope.selected = index;
	};

	/* Test */
	// ?n submit xong th� n� truy xu?t c�i n�y, �o li�n quan server ?�u ??c cho bi?t th�i a
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
	// ch?ch xong 10 c�u h?i s? ph?i truy xu?t server v� c?ng ?i?m cho ng??i d�ng
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