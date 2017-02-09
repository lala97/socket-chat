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
  console.log("Server port: 3000");
});

// Connection
io.on('connection', function(socket){
  socket.on('send_message', function(data){
    if (data.message != '') {
      connection.query('INSERT INTO chats SET?',[data],function (err) {
          if (err) throw err;
          io.emit('only_one_data',data);
      });
    }else {
      console.log('Mesaj boş ola bilməz');
    }
      connection.query("SELECT chats.message, chats.sender_id, chats.receiver_id, users.name, users.avatar FROM `chats` INNER JOIN `users` ON chats.sender_id = users.id", function (err,data) {
          if (err) throw err;
          io.emit('all_data',data);
      });
  });

     socket.on('data', function(result) {
    connection.query("SELECT chats.message, chats.sender_id, chats.receiver_id, users.name, users.avatar FROM `chats` INNER JOIN `users` ON chats.sender_id = users.id", function (err,data) {
        if (err) throw err;
        io.emit('all_data',data);
    });
  });


});
