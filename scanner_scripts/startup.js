  var idr; 
var cylon = require('cylon');
var GT511C3 = require('gt511c3');
var mysql = require('mysql');
var ping = require ("net-ping");
var childProcess = require('child_process');
var connection = mysql.createConnection({
  host     : '75.85.176.92',
  port     : '3306',
  user     : 'xdata',
  password : 'Theo2003',
  database : 'jefferson-id-db'
});


var fps = new GT511C3('/dev/ttyUSB0');
fps.init().then(
  function() {
    //When there is an error, log it in MySQL tagged with the MHUB Serial Number so that user can search it on support site.
    var iauthserverip = '75.85.176.92';
    console.log('---------- MHUB INFO ----------');
    console.log('[iAuth Xerus 1.0] MHub Firmware: v' + fps.firmwareVersion);
    console.log('[iAuth Xerus 1.0] MHub Serial Number: ' + fps.deviceSerialNumber);
    console.log('-------------------------------');

    console.log('[iAuth Xerus 1.0] Beginning Startup Tests...');
    console.log('[iAuth Xerus 1.0] [Test] Testing connection to iAuth Servers...');
setTimeout(function() {
     var session = ping.createSession ();

    session.pingHost (iauthserverip, function (error, target) {
    if (error)
        console.log('[iAuth Xerus 1.0] [Test] Could not establish connection.');
    else
        console.log('[iAuth Xerus 1.0] [Test] Secure connection established!');
        
        console.log('[iAuth Xerus 1.0] [Test] Ending test...');
        setTimeout(function() {
  console.log('[iAuth Xerus 1.0] [Test] Test finished with 0 errors! Starting main scripts...');
function runScript(scriptPath, callback) {

    var invoked = false;

    var process = childProcess.fork(scriptPath);

    process.on('error', function (err) {
        if (invoked) return;
        invoked = true;
        callback(err);
    });

    process.on('exit', function (code) {
        if (invoked) return;
        invoked = true;
        var err = code === 0 ? null : new Error('exit code ' + code);
        callback(err);
    });

}
// Startup can start any script from wifi setup to identifying.
runScript('/home/sc/iot-lab-001/GT-511C3-master/examples/Xerus 1.0/identify.js', function (err) {
    if (err) throw err;
    console.log('[iAuth Xerus 1.0] Started identify.js');
});

}, 2000);
    });
},2000);
  },
  function(err) {
    console.log('init err: ' + err);
  });


