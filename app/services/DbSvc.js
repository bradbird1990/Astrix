/**
 * Database Factory
 */
app.factory('DbSvc', function($cordovaSQLite){

    var db_name = 'moneyo';

    var db = $cordovaSQLite.openDB({name: db_name + '.db'});

    return {

        setupInit: function(){



            return true;

        }

    }

});
