/**
 * Transactions Factory
 */
app.factory('TransactionsSvc', function($http, $location){

    return {

        getContacts: function(){

            return $http.get($location.apiUrl() + '/contacts_api/contacts').

                success(function(data){return data});

        },

        getContact: function(contact_id){

            return $http.get($location.apiUrl() + '/contacts_api/contact',
                {params: {contact_id: contact_id}})

                .success(function(data){return data});

        },

        getContactLocations: function(contact_id){

            return $http.get($location.apiUrl() + '/contacts_api/contact_locations',
                {params: {contact_id: contact_id}})

                .success(function(data){

                    return data;

                });

        },

        addContactLocation: function(contact_id){

            return $http.post($location.apiUrl() + '/contacts_api/contact_location',
                {contact_id: contact_id})

                .success(function(data){

                    return data;

                });

        },

        deleteContactLocation: function(contact_location_id){

            return $http.post($location.apiUrl() + '/contacts_api/delete_contact_location',
                {contact_location_id: contact_location_id})

                .success(function(data){

                    return data;

                });

        },

        getContactComms: function(contact_id){

            return $http.get($location.apiUrl() + '/contacts_api/contact_comms',
                {params: {contact_id: contact_id}})

                .success(function(data){

                    return data;

                });

        },

        getTransactions: function(contact_id){

            return $http.get($location.apiUrl() + '/transactions_api/transactions',
                {params: {contact_id: contact_id}})

                .success(function(data){return data})
                .error(function(){return true});

        },

        addContactComm: function(contact_id){

            return $http.post($location.apiUrl() + '/contacts_api/add_contact_comm',
                {contact_id: contact_id})

                .success(function(data){

                    return data;

                });

        },

        addTransaction: function(transaction_contact_id, transaction_amount, transaction_transaction_type_id){

            return $http.post($location.apiUrl() + '/transactions_api/add_transaction',
                {transaction_contact_id: transaction_contact_id, transaction_amount: transaction_amount, transaction_transaction_type_id: transaction_transaction_type_id})

                .success(function(data){

                    return data;
d
                });

        },

        updateContactComm: function(contact_comm){

            return $http.post($location.apiUrl() + '/contacts_api/update_contact_comm',
                {contact_comm: contact_comm})

                .success(function(data){

                    return data;

                })

                .error(function(){

                    return false;

                });

        },

        deleteTransaction: function(transaction_id){

            return $http.post($location.apiUrl() + '/transactions_api/delete_transaction',
                {transaction_id: transaction_id})

                .success(function(data){

                    return data;

                });

        },

        makePrimaryContactComm: function(contact_comm_id){

            return $http.post($location.apiUrl() + '/contacts_api/make_primary_contact_comm',
                {contact_comm_id: contact_comm_id})

                .success(function(data){

                    return data;

                });

        },

        getContactContacts: function(contact_id, contact_type_id){

            return $http.get($location.apiUrl() + '/contacts_api/contact_contacts',
                {params: {contact_id: contact_id, contact_type_id: contact_type_id}})

                .success(function(data){

                    return data;

                });

        }

    };

});
