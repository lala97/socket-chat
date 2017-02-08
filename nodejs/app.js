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
    database: 'bumerang'
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
    if (data.message != '') {
      connection.query('INSERT INTO chats SET?',[data],function (err) {
          if (err) throw err;
      });
    }else {
      console.log('Mesaj boş ola bilməz');
    }
      connection.query("SELECT * FROM chats WHERE sender_id=" + data.sender_id,function (err,result) {
          if (err) throw err;
          io.emit('all_data',result);
      });
  });

     socket.on('data', function(result) {
    connection.query("SELECT * FROM chats WHERE sender_id=" + result.sender_id, function (err,result) {
        if (err) throw err;
        io.emit('all_data',result);
    });
  });


});
