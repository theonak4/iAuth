  var idr; 
var cylon = require('cylon');
var GT511C3 = require('gt511c3');
var mysql = require('mysql');
var connection = mysql.createConnection({
  host     : 'XXXXXXXXXX',
  port     : '3306',
  user     : 'XXXXXXXXXX',
  password : 'XXXXXXXXXXXX',
  database : 'jefferson-id-db'
});


var fps = new GT511C3('/dev/ttyUSB0');
fps.init().then(
   every((1).second(), function() {
fps.captureFinger(0)
			.then(function() {
				return fps.identify();
			})
			.then(function(ID) {
                                  
                         connection.query('UPDATE currentuser SET id=' + ID, function(err) {
                                 if (err) console.log(err);
                                 });
                           
 
				console.log("[iAuth Xerus 1.0] Scan Result: ID = " + ID);
                                idr = ID;
                               
                                runnable = "true";
			}, function(err) {
                                fps.ledONOFF(1);
				console.log("[iAuth Xerus 1.0] !ERRROR! Identify Error: " + fps.decodeError(err));
                                
			});

                        

    }, function(err) {
  console.log(err);
}));


