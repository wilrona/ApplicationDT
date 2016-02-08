$(document).ready(function(){

    $('.canvas').circleProgress({
        startAngle: -1/2*Math.PI,
        fill: {
            gradient: ["red", "orange"]
        }
    });

    var the_moment;
    // Horloge et date
     var horloges = setInterval(function horloges(){
        date = new Date;
        annee = date.getFullYear();
        moi = date.getMonth();
        mois = new Array('Janvier', 'F&eacute;vrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Ao&ucirc;t', 'Septembre', 'Octobre', 'Novembre', 'D&eacute;cembre');
        j = date.getDate();
        jour = date.getDay();
        jours = new Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
        h = date.getHours();
        if(h<10)
        {
            h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
            m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
            s = "0"+s;
        }

        $("#clock").html(h+"&#58;"+m+"&#58;"+s);
        $("#date").html(jours[jour]+' '+j+' '+mois[moi]+' '+annee);

    }, 1000);

    var socket = io.connect( 'http://'+window.location.hostname+':3000' );

    socket.on( 'change_etape', function( data ) {
        if(data.etape == 0){
            $('.moment').addClass('hidden').data('etape', 0);

            $('#speaker').addClass('hidden');
            $('#presentation').removeClass('hidden');
        }

        if(data.etape == 1){
            $('.moment').removeClass('hidden').data('etape', 1);
            $("#TextMoment").removeClass('hidden');

            $('#speaker').addClass('hidden');
            $('#presentation').removeClass('hidden');
            clearInterval(the_moment);
        }

        if(data.etape == 2){
            $('#presentation').addClass('hidden');
            $('#speaker').removeClass('hidden');
            $('.moment').removeClass('hidden').data('etape', 2);
        }
        console.log($('.moment').data('etape'));
    });

    socket.on( 'affiche_speaker', function( data ) {
        $( "#speaker-nom").html(data.nom);
        $( "#speaker-fonction").html(data.fonction);
        $( "#speaker-sujet").html(data.sujet);
        $( "#speaker-photo" ).attr('src', data.photo);
        $( "#speaker-twitter").html(data.twitter);
        $( "#speaker-categorie").html(data.categorie);
        if($('#TextMoment').prev().html() == ""){
            $('#TextMoment').prev().remove();
        }
    });


    var compteur = 0;

    socket.on( 'view_moment', function( data ) {

        var new_moment = data.moment;
        new_moment = new_moment.split(' _ ');

        if($(".moment").data('etape') == 0){
            compteur = 0;
        }

        if(new_moment.length > 1){

            $('#TextMoment').addClass('hidden');
            if($('#TextMoment').prev().html() == ""){
                $('#TextMoment').prev().remove();
            }

            if($(".moment").data('etape') == 0){
                $(".moment").removeClass('hidden');
            }

            if($('#MomentSpeaker2').prev().html() == ""){
                $('#MomentSpeaker2').prev().remove();
            }

            $('#MomentSpeaker1').html(new_moment[0]).removeClass('hidden');
            $('#MomentSpeaker2').html(new_moment[1]).removeClass('hidden').before('<br />');

            if($(".moment").data('etape') == 0) {
                the_moment = setInterval(function moment(){
                    if (compteur > 20) {
                        if($(".moment").data('etape') == 0) {
                            $('.moment').addClass('hidden');
                            if ($('#MomentSpeaker2').prev().html() == "") {
                                $('#MomentSpeaker2').prev().remove();
                            }
                            $('#MomentSpeaker2').addClass('hidden');
                            $('#MomentSpeaker1').addClass('hidden');
                        }
                        clearInterval(the_moment);
                    }
                    compteur++;
                }, 1000);
            }

        }else{

            if(!$('#MomentSpeaker1').hasClass('hidden') && !$('#MomentSpeaker2').hasClass('hidden') ){
                $('#MomentSpeaker1').addClass('hidden');
                $('#MomentSpeaker2').addClass('hidden');
                if($('#MomentSpeaker2').prev().html() == ""){
                    $('#MomentSpeaker2').prev().remove();
                }
            }

            if($(".moment").data('etape') == 0){
                $(".moment").removeClass('hidden');
            }

            if($('#TextMoment').prev().html() == ""){
                $('#TextMoment').prev().remove();
            }

            $('#TextMoment').html(data.moment).removeClass('hidden').before('<br />');

            if(data.moment.length > 50){
                if($('#TextMoment').prev().html() == ""){
                    $('#TextMoment').prev().remove();
                }
            }

            if($(".moment").data('etape') == 0) {
                the_moment = setInterval(function moment() {
                    if (compteur > 20) {
                        if($(".moment").data('etape') == 0){
                            $('.moment').addClass('hidden');
                            if($("#TextMoment").prev().html() == ""){
                                $("#TextMoment").prev().remove();
                            }

                            $("#TextMoment").addClass('hidden');
                        }
                        clearInterval(the_moment);
                    }
                    compteur++;
                }, 1000);
            }
        }


    });





});
