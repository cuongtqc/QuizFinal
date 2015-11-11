app.controller( 'UpdateMath' , function( $scope , $firebaseArray , $firebaseObject ) {
	// initiate value
	// cũng như bên quiz.js thôi, hiện ẩn blah blah phù hợp click thôi mà a
	$scope.editDB = true;
	$scope.loaded = false;
	$scope.addTab = false;
	$scope.editTab = false;
	$scope.returnEdit = function() {
		$scope.editDB = true;
		$scope.addTab = false;
		$scope.editTab = false;
	}

	// synchronize data from server
	// math là array chứa đống câu hỏi từ DB
	var math = [];
	/* 
	var bank = $firebaseArray( math );  
	bank.$loaded (
		function( data ) {
			$scope.list = data;
			$scope.temp = data;
			$scope.loaded = true;
		},
		function(error) {
			console.error("Error:", error);
		}
	); */
	
	// add Question tab
	$scope.addQuestionTab = function() {
		$scope.editDB = false;
		$scope.addTab = true;
		$scope.editTab = false;
	}
	
	// câu hỏi default, reset blah blah
	$scope.q = {
		data: "",
		answer: ["" , "" , "" , ""],
		right: 0
	}
	var resetQues = function() {
		$scope.q.data = "";
		$scope.q.right = 0;
		for( var i = 0; i < 4; i ++ ) $scope.q.answer[i] = "";
	}
	$scope.clearQuestion = function() {
		resetQues();
	}
	
	// submit Question
	$scope.submitQuestion = function() {
		var flag = false;
		for( var i = 0; i < 4; i ++ ) flag = flag || ( $scope.q.answer[i] == "" );
		if ( $scope.q.data == "" || flag || $scope.q.right < 1 || $scope.q.right > 4 ) 
			alert( "Can not add question!");
		else {
			// bên trên là nếu ko đủ dữ liệu ko cho add, còn nếu đủ thì add vào DB, code bên dưới nhé a
			
			
			// sau khi add thì reset template và trở về tab quản lí DB
			resetQues();
			$scope.returnEdit();
		}
	}
	
	// delete Question tab
	$scope.deleteQuestionTab = function() {
		$scope.editDB = false;
		$scope.addTab = false;
		$scope.editTab = true;
	}
	
	// xóa câu hỏi
	$scope.deleteQuiz = function( index ) {
		var r = confirm("You want to delete question " + index + "?" );
		if ( r ) {
			// confirm xong mới được xóa
		};
	}
});