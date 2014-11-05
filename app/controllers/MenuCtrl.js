/**
 * Menu Controller
 */
app.controller('MenuCtrl', function($scope, $location){

    // Setup the menu items
    $scope.menuItems = [{

        label: 'Dashboard',
        url: 'dashboard',
        icon: 'fa-globe'

    }, {

        label: 'Contacts',
        url: 'contacts',
        icon: 'fa-group'

    }, {

        label: 'Projects',
        url: 'projects',
        icon: 'fa-folder'

    }];

    // Returns true if the current menu item is active or not
    $scope.isActive = function(url){

        $scope.currentLocation = $location.url().replace('/', '').split('/')[0];

        return url == $scope.currentLocation;

    }

});
