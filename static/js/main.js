var App = angular.module('my-app', ['ngRoute']);

App.config(function($routeProvider) {
		$routeProvider

			// route for the home page
			.when('/', {
				templateUrl : 'views/partials/home.html',
				controller  : 'Mycontroller'
			})
});

App.controller('Mycontroller',function($scope){
	// $scope.test = "Hello World";

	$scope.getStudents = function(){
		var promise = $.post("php/main.php",{request:'get' }).then(
			function(response) {
				// do something
				// console.log("jhgjks");
				// console.log(answer);
				data=JSON.parse(response);

				$scope.itemsByPage=10;

    			// $scope.rowCollection = data;
    			$scope.count = data.length;
				// console.log("data");
				console.log(data);
				// //alert(data);
				// console.log("data");
				// $scope.messages = data;
				// ///
				// $scope.message = 'This is unread messages';
				// // model for bs-table
				// $scope.contactList = [];

				// // get contact list
				// $scope.contactList = data;

			},
			function(error) {
				// report something
			});

	}
});
