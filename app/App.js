/**
 * Bootstrap File and Core Controllers
 */
var app = angular.module('app', ['ngRoute'])

    .config(['$routeProvider', function($routeProvider){

        $routeProvider

            .when('/dashboard/:contact_id', {

                templateUrl: 'views/dashboard.html',
                controller: 'DashboardCtrl'

            })

            .when('/contacts', {

                templateUrl: 'views/contacts.html',
                controller: 'ContactsCtrl'

            })

            .when('/contacts/:contact_id', {

                templateUrl: 'views/contact.html',
                controller: 'ContactCtrl'

            })

            .when('/transactions/:contact_id', {

                templateUrl: 'views/transactions.html',
                controller: 'TransactionsCtrl'

            });

    }]);
