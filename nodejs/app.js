var express = require('express');
var app = express();
var mysql = require('mysql');
var server = require('http').createServer(app);
var io = require('socket.io').listen(server);
var PORT = process.env.PORT || 3000;
var connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'final_project'
  });
connection.connect(function (err) {
    if (err){
        console.error("error connecting " + err.stack);
    }
});


server.listen(PORT, function() {
  console.log("Serverm port: 3000");
});

// Connection
io.on('connection', function(socket){
  socket.on('send_message', function(data){
      connection.query('INSERT INTO chats SET?',data,function (err) {
          if (err) throw err;
      });
      connection.query("SELECT * FROM chats",function (err,result) {
          if (err) throw err;
          io.emit('all_data',result);
      });
  });
    connection.query("SELECT * FROM chats",function (err,result) {
        if (err) throw err;
        io.emit('all_data',result);
    });


});
