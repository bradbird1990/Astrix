/**
 * Dashboard Controller
 */
app.controller('DashboardCtrl', function($scope, $location, $routeParams, ContactsSvc, TransactionsSvc){

    //
    $scope.transaction = {};
    $scope.transaction['transaction_amount'] = 0;

    // Retrieve all contacts
    ContactsSvc.getContacts().then(function(contacts){

        $scope.contacts = contacts.data;
        $scope.showContactID = $scope.contacts[0].contact_id;

        if($routeParams.contact_id){

            $scope.showContactID = $routeParams.contact_id;
            $scope.transaction['transaction_contact_id'] = $routeParams.contact_id; // Set initial contact ID into the transaction model

        }
        else{

            $scope.location.path('dashboard/' + contacts[0].contact_id);

        }

    });

    //
    $scope.changeContact = function(which){

        var currentContactID = $scope.showContactID;
        var newContactID = 0;

        if(which){

            angular.forEach($scope.contacts, function(contact, key){

                if(contact.contact_id == currentContactID){

                    if($scope.contacts[which == 'next' ? key + 1 : key - 1] == undefined){

                        newContactID = $scope.contacts[which == 'next' ? 0 : $scope.contacts.length - 1].contact_id;

                    }
                    else{

                        newContactID = $scope.contacts[which == 'next' ? key + 1 : key - 1].contact_id;

                    }

                }

            });

            $scope.showContactID = newContactID;
            $scope.transaction['transaction_contact_id'] = newContactID; // Set the transaction contact ID when the contact changes

        }

    };

    //
    $scope.transactionUpdateAmount = function(amount){

        var newAmount = $scope.transaction['transaction_amount'] += amount;

        if(newAmount < 0){newAmount = 0}

        $scope.transaction['transaction_amount'] = newAmount;

    };

    //
    $scope.addTransaction = function(transaction, transaction_type){

        if(transaction.transaction_amount != null &&
            transaction.transaction_amount > 0){

            if(transaction_type == 'loan'){transaction.transaction_transaction_type_id = 1}
            if(transaction_type == 'repayment'){transaction.transaction_transaction_type_id = 2}

            // Add the location to the contact
            TransactionsSvc.addTransaction(transaction.transaction_contact_id, transaction.transaction_amount, transaction.transaction_transaction_type_id).then(function(){

                $scope.transaction['transaction_amount'] = 0;

            });

        }

    };

});
