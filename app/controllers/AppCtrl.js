/**
 * App Controller
 */
app.controller('AppCtrl', function($scope, $location){

    // Set default URI to dashboard if none has been set
    // Todo: Refreshing causes us to redirect back to the dashboard every time
    //if($scope.currentLocation == undefined || $scope.currentLocation == ''){$location.path('dashboard')}

    // Set the API Url
    $location.apiUrl = function(){return $location.protocol() + '://' + $location.host() + '/git-dadapp/DadApp'};

    //
    $scope.today = function(){
        $scope.dt = new Date();
    };
    $scope.today();

    $scope.clear = function(){
        $scope.dt = null;
    };

    // Disable weekend selection
    $scope.disabled = function(date, mode){
        return ( mode === 'day' && ( date.getDay() === 0 || date.getDay() === 6 ) );
    };

    $scope.toggleMin = function(){
        $scope.minDate = $scope.minDate ? null : new Date();
    };
    $scope.toggleMin();

    $scope.open = function($event){
        $event.preventDefault();
        $event.stopPropagation();

        $scope.opened = true;
    };

    $scope.dateOptions = {
        formatYear: 'yy',
        startingDay: 1
    };

    $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
    $scope.format = $scope.formats[0];

});
