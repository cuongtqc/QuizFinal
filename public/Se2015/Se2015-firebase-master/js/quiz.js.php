<?php
	session_start();
		$tempName = '$scope.name = "' . $_SESSION['userName'] . '";';
		$tempUserIndex = '$scope.userIndex = -1;';
		$tempLoged =  '$scope.loged =' . isset($_SESSION['userName']) . ';';

		$questBank = array();
			for( $i = 0 ; $i < 10 ; $i ++){
				$questBank[$i] = array(
					'id'=>$_SESSION['quest'.$i]['id'], 'question'=>$_SESSION['quest'.$i]['question'],
					'answer' => array($_SESSION['quest'.$i]['answer1'], $_SESSION['quest'.$i]['answer2'],
					$_SESSION['quest'.$i]['answer3'], $_SESSION['quest'.$i]['answer4']),
					'trueAnswer'=>$_SESSION['quest'.$i]['trueAnswer'], 'type'=>$_SESSION['quest'.$i]['type']
				);
			}
		$questBankSerial = json_encode($questBank);




?>
<?php header('Content-type: text/javascript', false); ?>
var choice = [];

app.controller( 'QuestLibrary' , function( $scope , $q) {
	alert('TEST QuestLibrary');
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


	// c�i n�y l� sau khi ?n take test ph�t l� editDB = false => ?n ?i c�i editDB, v� c�i kh�c s? hi?n l�n :))
	$scope.takeTest = function() {
		$scope.editDB = false;
	};
	$scope.userDef = {
		uid: "",
		name: "Guest",
		score: 0
	};

	// user control
	// l?y th�ng tin user, ??ng th?i ph?i l?y dk score, t�n, blah blah
	// $scope.loged c?ng l� log in ch?a nh�. C�i n�y c� th? l� boolean ho?c l� 1 object. N?u object r?ng th� ~ false. B�n HTML s? hi?u th?
	// C??ng: Th�m code PHP ?? truy?n gi� tr? cho bi?n name, userIndex, loged

	<?php echo $tempName.$tempUserIndex.$tempLoged?>

	//------------------------------------
	// C??NG : ?� th�m getdata th�nh c�ng
	//------------------------------------
	// ch?a to�n b? c�c c�u h?i trong database


	var bank=[];
	var bankTemp;

		bank= JSON.parse('<?php echo $questBankSerial?>');

			//C??NG : Edit Push quests list
		$scope.loaded = true;
		for( var i = 0; i < Math.min( 10 , bank.length ); i ++ )
			$scope.list.push( bank[i] );
		$scope.currentQuestion = bank[0];


	/* select answer */
	/* ch?n 1 trong 4 ?�p �n */
	$scope.selected = -1;
	$scope.select = function( index ) {
		$scope.selected = index;
	};

	/* Test */
	//  ?n submit xong th� n� truy xu?t c�i n�y, �o li�n quan server c�u cho bi?t th�i a
	$scope.submitQuestion = function() {
		/* increase point after a good answer */
		if ( $scope.selected == $scope.currentQuestion.trueAnswer -1 ) $scope.score += 10;
		//EDIT HERE ------------------------->>>>>>>>>>>>>>>>>>>>
		choice[$scope.index] = $scope.selected;

		/* next question */
		if ( $scope.index <= $scope.list.length - 1 ) $scope.index ++;
		$scope.currentQuestion = $scope.list[$scope.index];

		$scope.selected = -1; /* reset answer */
		if ( $scope.index == $scope.list.length ) return $scope.submitTest();
		/* if user submit the last question, return all answer and score */
	};

	/* publish score and question */
	// ch?ch xong 10 c�u h?i s? ph?i truy xu?t server v� c?ng ?i?m cho ng??i d�ng
	$scope.submitTest = function() {
		$scope.publish = false;
		//update score
		 var data_content = jQuery.param({username: '<?php echo $_SESSION['userName']?>', userScore : $scope.score});
		alert('Test data content before SEND: '+data_content);
		 $.ajax({
		 		url:'http://localhost:69/QuizFinal/public/updateScore',
		 		data: data_content,
			 	type: 'POST',
			 	contentType: 'application/x-www-form-urlencoded',
		 		complete: function(response){
		 			alert('RESPONSE submit : ' + response.responseText);
		 		},
		 		error: function(){

		 			alert('Error');
		 		}
		 });

		// ph?n c?ng ?i?m code d??i, nh? s?a l?i $scope.score = 0 sau khi c?ng
		bankTemp = '';
		$.ajax({
			url:'http://localhost:69/QuizFinal/public/randomQuest',
			complete: function(response){
				bankTemp = response.responseText ;
				//alert('RESPONSE: '+response.responseText);
			},
			error: function(){
				//alert('Error');
			}
		});
		//bank = JSON.parse(bankTemp);
		bank= JSON.parse('<?php echo $questBankSerial?>');
		$scope.list = [];
		for( var i = 0; i < Math.min( 10 , bank.length ); i ++ )
			$scope.list.push( bank[i] );
		$scope.currentQuestion = bank[0];

		$scope.loaded = true;
		$scope.index = 0;
		//$scope.score = 0;
	};

	/* class for selected answer and right answer */
	$scope.getSel = function( index ) {
		return choice[index];
	};
	$scope.getRight = function( index ) {
		return bank[index].trueAnswer-1;
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
		/*
		$.ajax({
			url:'http://localhost:69/QuizFinal/public/randomQuest',
			complete: function (){ alert('It is okay!')},
			error: function (){ alert('What the hell are you doing?')}
		});
		*/
		bankTemp = <?php echo '\''.$questBankSerial.'\''?>;
		bank = JSON.parse(bankTemp);
		$scope.loaded = true;
		$scope.list = [];
		for( var i = 0; i < Math.min( 10 , bank.length ); i ++ )
			$scope.list.push( bank[i] );
		$scope.currentQuestion = bank[0];
		//for( var i = 0; i < $scope.list.length; i ++ )
			//$scope.list[i] = QuizBank[QuestArr[i]];
		//$scope.currentQuestion = QuizBank[ QuestArr[0] ];
	};
});