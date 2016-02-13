$(document).ready(function(){

    $('.canvas').circleProgress({
        startAngle: -1/2*Math.PI,
        fill: {
            gradient: ["red", "orange"]
        }
    });

    $('.canvas-notes').circleProgress({
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
            $('#speaking-ico').addClass('hidden');
            $('#question-ico').addClass('hidden');
        }

        if(data.etape == 1){
            $('.moment').removeClass('hidden').data('etape', 1);
            $("#TextMoment").removeClass('hidden');

            $('#speaker').addClass('hidden');
            $('#presentation').removeClass('hidden');
            $('#speaking-ico').addClass('hidden');
            $('#question-ico').addClass('hidden');

            $("#speaking").removeClass('hidden');
            $("#end").addClass('hidden');
            clearInterval(the_moment);
        }

        if(data.etape == 2){
            $('#presentation').addClass('hidden');
            $('#speaker').removeClass('hidden');
            $('.moment').removeClass('hidden').data('etape', 2);
            $('#speaking-ico').addClass('hidden');
            $('#question-ico').addClass('hidden');
            $('#note-chrono').removeClass('note-chrono');
            $('#speaker-nom').removeClass('note-margin');

            $("#speaking").removeClass('hidden');
            $("#end").addClass('hidden');
        }

        if(data.etape == 3){
            $(".moment").addClass('hidden');
            $("#speaking").addClass('hidden');
            $("#end").removeClass('hidden');
            $('#horloge').html("00&#58;00&#58;0");
            $('#speaker-twitter').html("@DgitalThursday");
            $('#ville').addClass('hidden');
            $(".moment").data('etape', 3);
        }
    });

    socket.on( 'affiche_speaker', function( data ) {
        $( "#speaker-nom").html(data.nom);
        $( "#speaker-fonction").html(data.fonction);
        $( "#speaker-sujet").html(data.sujet);
        $( "#speaker-photo" ).attr('src', data.photo);
        $( "#speaker-twitter").html(data.twitter);

        $("#horloge").removeClass('text-danger');
        $('#speaking-ico').addClass('hidden').addClass('blink_me');
        $('#question-ico').addClass('hidden').addClass('blink_me');
        $('.canvas').circleProgress('value',0);
        $('.canvas-notes').circleProgress('value',0);

        var my_categorie;
        if(data.categorie == 'speaker'){
            my_categorie = 1;
        }else if(data.categorie == 'startup'){
            my_categorie = 2;
        }else if(data.categorie == 'partenaire'){
            my_categorie = 3;
        }else if(data.categorie == 'partenaire gold'){
            my_categorie = 4;
        }

        $('#note-chrono').removeClass('note-chrono');
        $('#speaker-nom').removeClass('note-margin');
        $('#note-view').addClass('hidden');
        $('#ville').removeClass('hidden');
        $( "#speaker-categorie").html(data.categorie).data('categorie', my_categorie);
        $( "#speaker-categorie").data('startup', data.numbers);
        //if($('#TextMoment').prev().html() == "" && $(".moment").data('etape') == 0){
        //    $('#TextMoment').prev().remove();
        //}
    });


    var compteur = 0;

    socket.on( 'view_moment', function( data ) {

        var new_moment = data.moment;
        new_moment = new_moment.split(' _ ');

        if($(".moment").data('etape') == 0 || $(".moment").data('etape') == 3){
            compteur = 0;
        }

        if(new_moment.length > 1){

            $('#TextMoment').addClass('hidden');
            if($('#TextMoment').prev().html() == ""){
                $('#TextMoment').prev().remove();
            }

            if($(".moment").data('etape') == 0 || $(".moment").data('etape') == 3){
                $(".moment").removeClass('hidden');
            }

            if($('#MomentSpeaker2').prev().html() == ""){
                $('#MomentSpeaker2').prev().remove();
            }

            $('#MomentSpeaker1').html(new_moment[0]).removeClass('hidden');
            $('#MomentSpeaker2').html(new_moment[1]).removeClass('hidden').before('<br />');

            if($(".moment").data('etape') == 0 || $(".moment").data('etape') == 3) {
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

            if($(".moment").data('etape') == 0 || $(".moment").data('etape') == 3){
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

            if($(".moment").data('etape') == 0 || $(".moment").data('etape') == 3) {
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


    var speaker_chrono;
    var centi; // initialise les dixtièmes
    var secon; //initialise les secondes
    var minu ;//initialise les minutes

    var max = 298;
    var min = 0;
    var compte;

    var qcenti; // initialise les dixtièmes
    var qsecon; //initialise les secondes
    var qminu ;//initialise les minutes

    var reste_max;
    var qmax;
    var ratio;
    var comptes;

    var last_tweet = 0;
    var last_moyenne = 0;
    var affiche = 0;

    socket.on( 'start_chrono', function( data ) {

        if(data.start_chrono == 0){
            $("#horloge").addClass('text-danger');
            clearInterval(speaker_chrono);
            $('#speaking-ico').removeClass('blink_me');
        }

        if(data.start_chrono == 1){
            compte = 0;
            centi=9; // initialise les dixtièmes
            secon=59; //initialise les secondes
            minu=4 ;//initialise les minutes
            $('#speaking-ico').removeClass('hidden');
            var $categori = $('#speaker-categorie').data('categorie');
            if($categori == 3){
                minu = 0;
                max = 58;
            }
            if($categori == 4){
                minu = 1;
                max = 116;
            }

            if($categori < 3){
                max = 298;
            }

            $("#horloge").removeClass('text-danger');

            speaker_chrono = setInterval(function chrono(){
                centi--; //incrémentation des dixièmes de 1
                if (centi<0){
                    centi=9;
                    secon--;
                    comptes = compte++;
                    ratio = comptes / max;
                    $('.canvas').circleProgress('value',ratio);
                } //si les dixièmes > 9,
//            on les réinitialise à 0 et on incrémente les secondes de 1
                if (secon<0){secon=59;minu--} //si les secondes > 59,
//            on les réinitialise à 0 et on incrémente les minutes de 1
                var space = "";
                if(secon<10){ space = "0"}
                $('#horloge').html("0"+minu+"&#58;"+space+""+secon+"&#58;"+centi);
                if(centi == 0 && secon == 0 && minu == 0){
                    $("#horloge").addClass('text-danger');
                    $('#speaking-ico').removeClass('blink_me');
                    clearInterval(speaker_chrono);
                }
            },100);
        }

        if(data.start_chrono == 2){
            centi=9; // initialise les dixtièmes
            secon=59; //initialise les secondes
            minu=4 ;//initialise les minutes
            $categori = $('#speaker-categorie').data('categorie');
            if($categori == 3){
                minu = 0;
                max = 58;
            }
            if($categori == 4){
                minu = 1;
                max = 116;
            }
            if($categori < 3){
                max = 298;
            }
            $('.canvas').circleProgress('value',0);
            compte = 0;
            $('#horloge').html("00&#58;00&#58;0").removeClass('text-danger');
        }


        if(data.start_chrono == 3){

            $('#speaking-ico').addClass('hidden');
            $('#question-ico').removeClass('hidden');
            affiche = 0;

            reste_max = max - compte;
            qmax = max + reste_max;

            compte = 1;
            ratio = 0;
            $("#horloge").removeClass('text-danger');
            $('.canvas').circleProgress('value',ratio);

            qcenti=9; // initialise les dixtièmes
            qsecon=59; //initialise les secondes
            qminu=4 ;//initialise les minutes

            qcenti += centi;
            while(qcenti > 9){
                qcenti -= 9;
                qsecon += 1;
            }

            qsecon += secon;
            while(qsecon > 59){
                qsecon -= 59;
                qminu += 1;
            }

            qminu += minu;
            // reduction
            //qmax -= qminu;

            speaker_chrono = setInterval(function chrono(){

                qcenti--; //incrémentation des dixièmes de 1
                if (qcenti<0){
                    qcenti=9;
                    qsecon--;
                    comptes = compte++;
                    ratio = comptes / qmax;
                    $('.canvas').circleProgress('value',ratio);
                } //si les dixièmes > 9,
//            on les réinitialise à 0 et on incrémente les secondes de 1
                if (qsecon<0){
                    qsecon=59;
                    qminu--;
                } //si les secondes > 59,
//            on les réinitialise à 0 et on incrémente les minutes de 1
                $categori = $('#speaker-categorie').data('categorie');
                if($categori == 2 && qminu < 3){
                    $('#note-chrono').addClass('note-chrono');
                    $('#speaker-nom').addClass('note-margin');
                    $('#note-view').removeClass('hidden');
                    if(last_tweet == 0 && last_moyenne == 0 && affiche == 0){
                        socket = io.connect( 'http://'+window.location.hostname+':3000' );
                        socket.emit('view_moment', {
                            moment: "Votez votre startup sur twitter en saisissant #DigitalThursday #Startup"+$('#speaker-categorie').data("startup")+" #votre_note allant de 1 à 5."
                        });
                        affiche = 1;
                    }

                    if(qsecon == 30 || qsecon == 0){
                        var url = "/evenement/twitter_note.json";
                        if(last_moyenne && last_tweet){
                            url = url+"?last_tweet="+last_tweet+"&moyenne="+last_moyenne;
                        }
                        $.ajax({
                            url: url,
                            type: 'GET',
                            success: function (data) {
                                last_moyenne = data.moyenne;
                                last_tweet = data.last_tweet;
                                if(last_moyenne){
                                    moyenne = last_moyenne / 5;
                                    $('.canvas-notes').circleProgress('value',moyenne);
                                    $('#text-note').html(data.moyenne+'/5');
                                }
                            }
                        });
                    }
                }

                var space = "";
                if(qsecon<10){ space = "0"}
                $('#horloge').html("0"+qminu+"&#58;"+space+""+qsecon+"&#58;"+qcenti);

                if(qcenti == 0 && qsecon == 0 && qminu == 0){
                    $("#horloge").addClass('text-danger');
                    $('#question-ico').removeClass('blink_me');
                    clearInterval(speaker_chrono);
                }
            },100);
        };

        if(data.start_chrono == 4){
            compte = 0;
            centi=9; // initialise les dixtièmes
            secon=59; //initialise les secondes
            minu=4 ;//initialise les minutes

            $("#horloge").removeClass('text-danger');

            speaker_chrono = setInterval(function chrono(){
                centi--; //incrémentation des dixièmes de 1
                if (centi<0){
                    centi=9;
                    secon--;
                } //si les dixièmes > 9,
//            on les réinitialise à 0 et on incrémente les secondes de 1
                if (secon<0){secon=59;minu--} //si les secondes > 59,
//            on les réinitialise à 0 et on incrémente les minutes de 1
                var space = "";
                if(secon<10){ space = "0"}
                $('#horloge').html("0"+minu+"&#58;"+space+""+secon+"&#58;"+centi);
                if(centi == 0 && secon == 0 && minu == 0){
                    socket = io.connect( 'http://'+window.location.hostname+':3000' );

                    socket.emit('view_moment', {
                        moment: "A Bientôt"
                    });
                    clearInterval(speaker_chrono);
                }
            },100);
        }

    });




});
