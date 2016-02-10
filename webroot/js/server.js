var socket  = require( 'socket.io' );
var express = require('express');
var app     = express();
var server  = require('http').createServer(app);
var io      = socket.listen(server);
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

    socket.on( 'current_speaker', function( data ) {
        io.sockets.emit( 'current_speaker', {
            speaker: data.speaker

        });
    });

    socket.on( 'change_etape', function( data ) {
        io.sockets.emit( 'change_etape', {
            etape: data.etape

        });
    });

    socket.on( 'speaker_ready', function( data ) {
        io.sockets.emit( 'speaker_ready', {
            speaking: data.speaking

        });
    });

    socket.on( 'active_speaker', function( data ) {
        io.sockets.emit( 'active_speaker', {
            nom: data.nom,
            fonction: data.fonction,
            sujet: data.sujet,
            photo: data.photo,
            twitter: data.twitter,
            categorie: data.categorie,
            intervent: data.intervent

        });
    });

    socket.on( 'affiche_speaker', function( data ) {
        io.sockets.emit( 'affiche_speaker', {
            nom: data.nom,
            fonction: data.fonction,
            sujet: data.sujet,
            photo: data.photo,
            twitter: data.twitter,
            categorie: data.categorie,
            numbers: data.numbers

        });
    });

  socket.on( 'start_chrono', function( data ) {
    io.sockets.emit( 'start_chrono', {
    	start_chrono: data.start_chrono
    });
  });

    socket.on( 'synchro_chrono', function( data ) {
        io.sockets.emit( 'synchro_chrono', {
            cent: data.cent,
            secon: data.secon,
            minut: data.minut,
            starts: data.starts
        });
    });

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
