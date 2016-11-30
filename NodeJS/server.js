var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');

server.listen(8890);
io.on('connection', function (socket) {

  console.log("new client connected");
  var redisClient = redis.createClient();
  redisClient.subscribe('message', 'comment', 'votes', 'charts');

  redisClient.on("message", function(channel, message) {
    console.log("new message in queue "+ message + "channel");
    socket.emit(channel, message);
  });

  redisClient.on("comment", function(channel, comment) {
    console.log("new comment in queue "+ comment + "channel");
    socket.emit(channel, comment);
  });

  redisClient.on("votes", function(channel, votes) {
    console.log("new votes in queue "+ votes + "channel");
    socket.emit(channel, votes);
  });

  redisClient.on("charts", function(channel, charts) {
    console.log("new charts in queue "+ charts + "channel");
    socket.emit(channel, charts);
  });

  socket.on('disconnect', function() {
    redisClient.quit();
  });

});
