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
    database: 'final'
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
        console.log(data);
      connection.query('INSERT INTO chats SET?',[data],function (err) {
          if (err) throw err;
          io.emit('only_one_data',data);
      });
    }else {
      console.log('Mesaj boş ola bilməz');
    }
      connection.query(
          "SELECT " +
          "chats.message, chats.sender_id, chats.receiver_id, users.name, users.avatar " +
          "FROM " +
          "`chats` " +
          "INNER JOIN " +
          "`users` " +
          "ON " +
          "chats.sender_id = users.id",
          function (err,data) {
          if (err) throw err;
          io.emit('all_data',data);
      });
  });
     socket.on('data', function(result) {
    connection.query(
        "SELECT " +
        "chats.message, chats.sender_id, chats.receiver_id, users.name, users.avatar " +
        "FROM " +
        "`chats` " +
        "INNER JOIN " +
        "`users` " +
        "ON chats.sender_id = users.id",
        function (err,data) {
        if (err) throw err;
        io.emit('all_data',data);
    });
  });

  socket.on('message_notifications', function(result) {
      if(result.id !=0) {
          var query = connection.query(
              "SELECT " +
              "chats.sender_id, chats.receiver_id,chats.id, chats.message, users.name, users.avatar, chats.seen " +
              "FROM " +
              "chats " +
              "INNER JOIN " +
              "users " +
              "ON " +
              "chats.sender_id = users.id " +
              "WHERE " +
              "chats.receiver_id = " + connection.escape(result.id)+
              " ORDER BY " +
              "chats.id DESC",
              function (err, message_notification_data) {
                  if (err) throw err;
                  io.emit('notifications', message_notification_data);
              });
          console.log(query.sql);
      }else{
          io.emit('notifications', result);
      }
  });
});
