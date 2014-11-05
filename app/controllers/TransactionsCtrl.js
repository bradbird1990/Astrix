/**
 * Transactions Controller
 */
app.controller('TransactionsCtrl', function($scope, $routeParams, ContactsSvc, TransactionsSvc){

    ContactsSvc.getContact($routeParams.contact_id).then(function(contact){

        $scope.contact = contact.data[0];

    });

    getTransactions();

    function getTransactions(){

        showAddressLine1Input.getTransactions($routeParams.contact_id).then(function(transactions){

            $scope.transactions = transactions.data;

        }, function(){

            $scope.transactions = null;

        });

    }

    $scope.deleteTransaction = function(transaction_id){

        TransactionsSvc.deleteTransaction(transaction_id).then(function(){

            getTransactions();

        });

    };

    $scope.getBalance = function(){

        var total = 0;

        angular.forEach($scope.transactions, function(transaction){

            if(transaction.transaction_type_id == 1){

                total -= parseInt(transaction.transaction_amount);

            }
            else if(transaction.transaction_type_id == 2){

                total += parseInt(transaction.transaction_amount);

            }

        });

        return total;

    };

});
