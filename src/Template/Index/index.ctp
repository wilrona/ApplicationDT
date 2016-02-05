<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header"><i class="fa fa-dashboard"></i> Evenement <span class="pull-right"><strong>Edition en cours:</strong> <?= $edition_encours->titre; ?> du <?= $edition_encours->date->format('d M Y'); ?></span>
            <span class="pull-right" style="margin-right: 20px;"><strong>Etape en cours:</strong> <span id="etape_encours"> <?php
                if($etape->etape == 0): echo "Introduction";  endif;
                if($etape->etape == 1): echo "Presentation";  endif;
                if($etape->etape == 2): echo "Speaker";  endif;
                if($etape->etape == 3): echo "Applaudissement";   endif;   ?></span></span> </h4>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-6">
        <ul class="nav nav-pills">
            <li <?php if($etape->etape != 2): ?> class="disabled" <?php endif; ?> id="active_speaker" role="presentation"><a href="/evenement/activer_speaker/<?= $edition_encours->id; ?>" data-target="#myModal" data-backdrop="static" data-toggle="modal">Activer un speaker</a></li>
            <li><a href="/evenement/change_etape" data-target="#myModal" data-backdrop="static" data-toggle="modal">Changer d'etape</a></li>
        </ul>
    </div>
    <div class="col-lg-6">
        <div class="" style="margin-bottom: 0;">
            <form class="form-inline" id="formulaire_moment">
                <div class="form-group" style="width: 83%;">
                    <input type="text" class="form-control" id="inputMoment" placeholder="Ecrire le moment" style="width: 100%;">
                </div>
                <button type="button" id="submit" class="btn btn-primary">Afficher</button>
            </form>
        </div>
    </div>
</div>

<?php $speaker = $intervention->first(); ?>
<hr style="margin-top: 10px;"/>
<div class="row">
    <div class="col-lg-3">
        <div class="thumbnail">
            <?php
            if($speaker):

                echo $this->Html->image($speaker->speaker->avatar, ['class' => 'img-circle img-responsive', 'id ' => 'speaker-photo', 'style' => 'width:177px;']);

            else:
                ?>
                <?= $this->Html->image('uploads/event_image.jpg', ['class' => 'img-circle img-responsive', 'id ' => 'speaker-photo', 'style' => 'width:177px;']); ?>
            <?php
            endif;
            ?>

<!--            <img data-src="holder.js/100%x180" alt="...">-->
        </div>

        <h1 class="text-center" id="chrono"><span class="min">00</span>:<span class="sec">00</span>:<span class="cent">0</span>  </h1>

    </div>

    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-horizontal center-block">
                            <div class="form-group">
                                <label class="col-lg-4 control-label" style="text-align: left !important;">Nom :</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static" id="speaker-nom">
                                        <?php
                                        if($speaker):

                                                echo $speaker->speaker->nom;

                                        else:
                                        ?>
                                            Nom du speaker
                                        <?php
                                        endif;
                                        ?>
                                    </p>
                                </div>

                            </div>
                        </div>
                        <div class="form-horizontal center-block">
                            <div class="form-group">
                                <label class="col-lg-4 control-label" style="text-align: left !important;">Fonction :</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static" id="speaker-fonction">
                                        <?php
                                        if($speaker):

                                            echo $speaker->speaker->fonction;

                                        else:
                                            ?>
                                            Fonction du speaker
                                        <?php
                                        endif;
                                        ?>
                                    </p>
                                </div>

                            </div>
                        </div>
                        <div class="form-horizontal center-block">
                            <div class="form-group">
                                <label class="col-lg-4 control-label" style="text-align: left !important;">Twitter :</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static" id="speaker-twitter">
                                        <?php
                                        if($speaker):

                                            echo $speaker->speaker->twitter;

                                        else:
                                            ?>

                                            Compte twitter
                                        <?php
                                        endif;
                                        ?>

                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-horizontal center-block">
                            <div class="form-group">
                                <label class="col-lg-4 control-label" style="text-align: left !important;">Categorie :</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static" id="speaker-categorie">
                                        <?php
                                        if($speaker):

                                            echo $speaker->categorie;

                                        else:
                                            ?>

                                            Categorie speaker
                                        <?php
                                        endif;
                                        ?>
                                    </p>
                                </div>

                            </div>
                        </div>
                            <div class="center-block">
                                <div class="form-group">
                                    <label class="control-label">Sujet :</label>
                                    <p class="form-control-static" id="speaker-sujet">
                                        <?php
                                        if($speaker):

                                            echo $speaker->titre;

                                        else:
                                            ?>

                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        <?php
                                        endif;
                                        ?>

                                    </p>

                                </div>
                            </div>

                    </div>
                </div>
                <hr style="margin-top: 0"/>
                <div class="row">
                    <div class="col-lg-4 text-center">
                        <strong>Speaking</strong><br/>
                        <button class="btn btn-success btn-sm disabled" id="speaking-start">Start</button>
                        <button class="btn btn-danger btn-sm disabled" id="speaking-stop">Stop</button>
                        <button class="btn btn-default btn-sm disabled" id="speaking-reset">Reset</button>
                    </div>
                    <div class="col-lg-4 text-center">
                        <strong>Question</strong><br/>
                        <button class="btn btn-success btn-sm disabled" id="question-start">Start</button>
                        <button class="btn btn-danger btn-sm disabled" id="question-stop">Stop</button>
                    </div>
                    <div class="col-lg-4"><br/>
                        <button class="btn btn-block btn-primary btn-sm <?php if(!$speaker || $etape->etape != 2): ?>disabled <?php endif; ?>" id="show-front" data-use="<?php if($etape->etape == 2): echo 1;  else:  echo 0; endif; ?>">Afficher</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr style="margin-top: 0"/>
<div class="row">
    <div class="col-lg-12 well text-center">
        <h1 id="moment">Afficher vos moments ici</h1>
    </div>
</div>
<?php

$this->start('script2');
?>
<script>
    $(document).ready(function(){

//        $('#show-front').data('use', 0);

        var centi=9; // initialise les dixtièmes
        var secon=59; //initialise les secondes
        var minu=4 ;//initialise les minutes
        var compte;

        $('#speaking-start').on('click', function(){
            compte = setInterval(function chrono(){
                centi--; //incrémentation des dixièmes de 1
                if (centi<0){centi=9;secon--} //si les dixièmes > 9,
//            on les réinitialise à 0 et on incrémente les secondes de 1
                if (secon<0){secon=59;minu--} //si les secondes > 59,
//            on les réinitialise à 0 et on incrémente les minutes de 1
                $(".min").html("0"+minu);
                var space = "";
                if(secon<10){ space = "0"}
                $(".sec").html(space+""+secon);
                $(".cent").html(centi);
                if(centi == 0 && secon == 0 && minu == 0){
                    $("#question-start").removeClass('disabled');
                    $("#speaking-start").addClass('disabled');
                    $("#speaking-stop").addClass('disabled');
                    $("#speaking-reset").addClass('disabled');
                    $("#chrono").addClass('bg-danger');
                    socket = io.connect( 'http://'+window.location.hostname+':3000' );

                    socket.emit('view_moment', {
                        moment: "Fin du speech de l'intervenant"
                    });
                    clearInterval(compte);
                }
            },100);
            $(this).addClass('disabled');
            $("#speaking-stop").removeClass('disabled');
            $("#speaking-reset").removeClass('disabled');
            $("#question-start").addClass('disabled');

            var sockets = io.connect( 'http://'+window.location.hostname+':3000' );
            sockets.emit('start_chrono', {
                start_chrono: 1
            });
        });

        // Stopper le chrono pour le speaking
        $('#speaking-stop').on('click', function(){
            socket = io.connect( 'http://'+window.location.hostname+':3000' );
            if(centi != 0 && secon != 0 && minu != 0){
                socket.emit('view_moment', {
                    moment: "Chrono Dompté"
                });
            }

            socket.emit('start_chrono', {
                start_chrono: 0
            });

            $("#speaking-start").removeClass('disabled');
            $("#speaking-reset").removeClass('disabled');
            $("#question-start").removeClass('disabled');
            clearInterval(compte);
        });

        // Reset le chrono pour le speaking
        $('#speaking-reset').on('click', function(){

//            $("#speaking-stop").addClass('disabled');
            $("#question-start").addClass('disabled');

//            $(this).addClass('disabled');
            centi=9; // initialise les dixtièmes
            secon=59; //initialise les secondes
            minu=4 ;//initialise les minutes

            $(".min").html("00");
            $(".sec").html("00");
            $(".cent").html("0");

            socket = io.connect( 'http://'+window.location.hostname+':3000' );
            socket.emit('start_chrono', {
                start_chrono: 2
            });
        });

        var qcenti=9; // initialise les dixtièmes
        var qsecon=59; //initialise les secondes
        var qminu=4 ;//initialise les minutes

        $('#question-start').on('click', function () {
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

            $("#speaking-start").addClass('disabled');
            $("#speaking-reset").addClass('disabled');
            $("#speaking-stop").addClass('disabled');
            $("#chrono").removeClass('bg-danger');
            $(this).addClass('disabled');

            socket = io.connect( 'http://'+window.location.hostname+':3000' );

            socket.emit('view_moment', {
                moment: "Posez vos questions !"
            });

            qcompte = setInterval(function chrono(){

                qcenti--; //incrémentation des dixièmes de 1
                if (qcenti<0){qcenti=9;qsecon--} //si les dixièmes > 9,
//            on les réinitialise à 0 et on incrémente les secondes de 1
                if (qsecon<0){qsecon=59;qminu--} //si les secondes > 59,
//            on les réinitialise à 0 et on incrémente les minutes de 1
                $(".min").html("0"+qminu);
                var space = "";
                if(qsecon<10){ space = "0"}
                $(".sec").html(space+""+qsecon);
                $(".cent").html(qcenti);

                if(qcenti == 0 && qsecon == 0 && qminu == 0){
                    socket = io.connect( 'http://'+window.location.hostname+':3000' );

                    socket.emit('view_moment', {
                        moment: "Fin de vos questions !"
                    });
                    clearInterval(qcompte);
                }
            },100);
        });


        $('#submit').on('click', function(e){
            e.preventDefault();
            if($('#inputMoment').val() != ""){
                var $value = $('#inputMoment').val();
                socket = io.connect( 'http://'+window.location.hostname+':3000' );

                socket.emit('view_moment', {
                    moment: $value
                });
            }
        });

        $('#inputMoment').keypress(function(e) {
            if (e.which == 13) {
                e.preventDefault();
                return false;
            }
        });

        var socket = io.connect( 'http://'+window.location.hostname+':3000' );

        socket.on( 'view_moment', function( data ) {
            $( "#moment" ).html( data.moment);
        });

        socket.on( 'speaker_ready', function( data ) {
            $('#show-front').data('use', data.speaking);
        });

        socket.on( 'active_speaker', function( data ) {
            $( "#speaker-photo" ).attr('src', '\\img\\'+data.photo);
            $( "#speaker-nom" ).html( data.nom);
            $( "#speaker-fonction" ).html( data.fonction);
            $( "#speaker-sujet" ).html( data.sujet);
            $( "#speaker-categorie" ).html( data.categorie);
            $( "#speaker-twitter" ).html( data.twitter);
            $("#show-front").removeClass('disabled');
        });

        $(".nav li").on("click", function(e) {
            if ($(this).hasClass("disabled")) {
                e.preventDefault();
                return false;
            }
        });

        // Affichage du speaker sur le frontend de l'application
        $('#show-front').on('click', function(){
            if($(this).data('use') == 1){
                $(this).addClass('disabled');
                $('#speaking-start').removeClass('disabled');

                socket.emit('affiche_speaker', {
                    nom: $( "#speaker-nom").html(),
                    fonction: $( "#speaker-fonction").html(),
                    sujet: $( "#speaker-sujet").html(),
                    photo:  $( "#speaker-photo" ).attr('src'),
                    twitter: $( "#speaker-twitter").html(),
                    categorie: $( "#speaker-categorie").html()
                });

                socket.emit('change_etape', {
                    etape: 2
                });

                socket.emit('view_moment', {
                    moment: $( "#speaker-sujet").html()
                });
            }
        });
    });

    <?php
        if($speaker && $etape->etape == 2):
    ?>
        if($('#show-front').data('use') == 1){
            var socketss = io.connect( 'http://'+window.location.hostname+':3000' );
            socketss.on( 'synchro_chrono', function( data ) {
                if(data.starts == 1){
                    centi=data.cent; // initialise les dixtièmes
                    secon=data.secon; //initialise les secondes
                    minu=data.minut ;//initialise les minutes
                    $('#show-front').addClass('hidden');
                    $('#speaking-start').removeClass('hidden').trigger('click');
                }
            });
        }
    <?php
        endif;
    ?>
</script>
<?php
$this->end();

?>
