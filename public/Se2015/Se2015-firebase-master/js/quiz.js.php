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

app.controller( 'QuestLibrary' , function( $scope ) {
	alert('TEST');
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


	// cái này là sau khi ?n take test phát là editDB = false => ?n ?i cái editDB, và cái khác s? hi?n lên :))
	$scope.takeTest = function() {
		$scope.editDB = false;
	};
	$scope.userDef = {
		uid: "",
		name: "Guest",
		score: 0
	};

	// user control
	// l?y thông tin user, ??ng th?i ph?i l?y dk score, tên, blah blah
	// $scope.loged c?ng là log in ch?a nhé. Cái này có th? là boolean ho?c là 1 object. N?u object r?ng thì ~ false. Bên HTML s? hi?u th?
	// C??ng: Thêm code PHP ?? truy?n giá tr? cho bi?n name, userIndex, loged

	<?php echo $tempName.$tempUserIndex.$tempLoged?>

	//------------------------------------
	// C??NG : ?ã thêm getdata thành công
	//------------------------------------
	// ch?a toàn b? các câu h?i trong database
	var bankTemp = <?php echo '\''.$questBankSerial.'\''?>;
	var bank = JSON.parse(bankTemp);
	$scope.loaded = true;

	//C??NG : Edit Push quests list
	for( var i = 0; i < Math.min( 10 , bank.length ); i ++ )
		$scope.list.push( bank[i] );
	$scope.currentQuestion = bank[0];

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
		if ( $scope.selected == $scope.currentQuestion.trueAnswer-1 ) $scope.score += 10;
		choice[$scope.index] = $scope.selected;

		/* next question */
		if ( $scope.index <= $scope.list.length - 1 ) $scope.index ++;
		$scope.currentQuestion = $scope.list[$scope.index];

		$scope.selected = -1; /* reset answer */
		if ( $scope.index == $scope.list.length ) return $scope.submitTest();
		/* if user submit the last question, return all answer and score */
	};

	/* publish score and question */
	// ch?ch xong 10 câu h?i s? ph?i truy xu?t server và c?ng ?i?m cho ng??i dùng
	$scope.submitTest = function() {
		$scope.publish = false;
		// ph?n c?ng ?i?m code d??i, nh? s?a l?i $scope.score = 0 sau khi c?ng
		bankTemp = <?php echo '\''.$questBankSerial.'\''?>;
		bank = JSON.parse(bankTemp);
		for( var i = 0; i < Math.min( 10 , bank.length ); i ++ )
			$scope.list.push( bank[i] );
		$scope.currentQuestion = bank[0];

		$scope.loaded = true;
		$scope.index = 0;
		$scope.score = 0;
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
		bankTemp = <?php echo '\''.$questBankSerial.'\''?>;
		bank = JSON.parse(bankTemp);
		$scope.loaded = true;
		//for( var i = 0; i < $scope.list.length; i ++ )
			//$scope.list[i] = QuizBank[QuestArr[i]];
		//$scope.currentQuestion = QuizBank[ QuestArr[0] ];
	};
});