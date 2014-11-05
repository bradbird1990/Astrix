/**
 * Contacts Controller
 */
app.controller('ContactCtrl', function($scope, $routeParams, ContactsSvc){

    // If we are on a single contact page then get the contact
    if($routeParams.contact_id){}

    // If the add location button is clicked
    $scope.addContactLocation = function(contact_id){

        // Add the location to the contact
        ContactsSvc.addContactLocation(contact_id).then(function(){

            // Retrieve a contacts locations
            getContactLocations();

        });

    };

    // If the delete location button is clicked
    $scope.deleteContactLocation = function(contact_location_id){

        // Add the location to the contact
        ContactsSvc.deleteContactLocation(contact_location_id).then(function(){

            // Retrieve a contacts location details
            getContactLocations();

        });

    };

    // If the add comm button is clicked
    $scope.addContactComm = function(contact_id, contact_comm_type_id){

        // Add the location to the contact
        ContactsSvc.addContactComm(contact_id, contact_comm_type_id).then(function(){

            // Retrieve a contacts comm details
            getContactComms();

        });

    };

    // If the contact comm is updated
    $scope.updateContactComm = function(contact_comm){

        // Update the contact comm field
        ContactsSvc.updateContactComm(contact_comm)
            .then(function(){

                // Retrieve a contacts comm details
                getContactComm(contact_comm.contact_comm_id);

            }, function(){

                // Retrieve a contacts comm details
                getContactComm(contact_comm.contact_comm_id);

            });

    };

    // If the delete comm button is clicked
    $scope.deleteContactComm = function(contact_comm_id){

        // Add the location to the contact
        ContactsSvc.deleteContactComm(contact_comm_id).then(function(){

            // Retrieve a contacts comm details
            getContactComms();

        });

    };

    // If the make primary button is clicked
    $scope.makePrimaryContactComm = function(contact_comm_id){

        // Add the location to the contact
        ContactsSvc.makePrimaryContactComm(contact_comm_id).then(function(){

            // Retrieve a contacts comm details
            getContactComms();

        });

    };

    // Retrieve a contact
    ContactsSvc.getContact($routeParams.contact_id).then(function(contact){

        $scope.contact = contact.data[0];

    });

    // Retrieve a contacts comm details
    // getRelatedContacts();

    // Retrieve a contacts locations
    getContactLocations();

    // Retrieve a contacts comm details
    getContactComms();

    // Retrieve a contacts comm details
    // Todo: Second parameter does need to grab from a dynamic source eventually 1.Person 2.Company
    // Todo: This function is experimental and is no way near finished yet
    ContactsSvc.getContactContacts($routeParams.contact_id).then(function(contact_contacts){

        $scope.contact_contacts = contact_contacts.data;

    });

    // Retrieve a contacts locations
    function getContactLocations(){

        ContactsSvc.getContactLocations($routeParams.contact_id).then(function(contact_locations){

            $scope.contact_locations = contact_locations.data;

        });

    }

    // Retrieve a contacts comms
    function getContactComms(){

        ContactsSvc.getContactComms($routeParams.contact_id).then(function(contact_comms){

            $scope.contact_comms = contact_comms.data;

        });

    }

    // Retrieve a comm
    function getContactComm(contact_comm_id){

        ContactsSvc.getContactComm(contact_comm_id).then(function(contact_comm){

            // Todo: There must be a better way to do this... Have a look when you become more adept at AngularJS young padawan learner
            angular.forEach($scope.contact_comms, function(object, key){

                if(object.contact_comm_id == contact_comm_id){

                    $scope.contact_comms[key] = contact_comm.data[0];

                }

            });

        });

    }

});

/**
 * Contact Controller
 */
app.controller('ContactsCtrl', function($scope, $routeParams, ContactsSvc){

    // Retrieve all contacts
    ContactsSvc.getContacts().then(function(contacts){

        $scope.contacts = contacts.data;

    });

});
