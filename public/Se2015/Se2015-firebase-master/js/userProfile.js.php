<?php
    session_start();
?>

<?php header('Content-type: text/javascript', false); ?>

new WOW().init();

	var app = angular.module('Quiz', ['ngAnimate']);
    var user = [];

	app.controller( 'UserProfile', function( $scope ) {
	/* user control */
		$scope.name = '<?php echo $_SESSION['name']?>';
        $scope.username = "<?php echo $_SESSION['userName']?>";
		$scope.newPassword = "";
		$scope.newPasswordCompare = "";
		$scope.currentPassword = "";
		$scope.userIndex = 0;
		$scope.loaded = true;

		/* get user */
		$scope.score = <?php echo $_SESSION['userScore']?>;
		$scope.loged = <?php echo isset($_SESSION['userName'])?>;


	// clear thông tin đang điền hiện tại
	$scope.clear = function() {
			$scope.newPassword = "";
			$scope.newPasswordCompare = "";
			$scope.currentPassword = "";
		}

    $scope.submit = function() {
            var data_content = jQuery.param({username: $scope.username,name: $scope.name, newPassword : $scope.newPassword, newPasswordCompare: $scope.newPasswordCompare, currentPassword: $scope.currentPassword});
            alert('Test data content before SEND: ' + data_content);
            $.ajax({
                url:'http://localhost:69/QuizFinal/public/updateProfile',
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
            alert( "UserProfile has been updated!")
    }
});