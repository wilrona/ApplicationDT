var socket  = require( 'socket.io' );
var express = require('express');
var app     = express();
var server  = require('http').createServer(app);
var io      = socket.listen( server );
var port    = process.env.PORT || 3000;

server.listen(port, function () {
  console.log('Server listening at port %d', port);
});


io.on('connection', function (socket) {

  socket.on( 'view_moment', function( data ) {
    io.sockets.emit( 'view_moment', {
    	moment: data.moment

    });
  });

    socket.on( 'change_etape', function( data ) {
        io.sockets.emit( 'change_etape', {
            etape: data.etape

        });
    });

  //socket.on( 'update_count_message', function( data ) {
  //  io.sockets.emit( 'update_count_message', {
  //  	update_count_message: data.update_count_message
  //  });
  //});
  //
  //socket.on( 'new_message', function( data ) {
  //  io.sockets.emit( 'new_message', {
  //  	name: data.name,
  //  	email: data.email,
  //  	subject: data.subject,
  //  	created_at: data.created_at,
  //  	id: data.id
  //  });
  //});

  
});
