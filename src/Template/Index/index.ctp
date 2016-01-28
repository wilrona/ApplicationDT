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
<hr/>
<div class="row">
    <div class="col-lg-3">
        <div class="thumbnail">
            <?= $this->Html->image('uploads/event_image.jpg', ['class' => 'img-circle img-responsive', 'id ' => 'img-photo', 'style' => 'width:177px;']); ?>
<!--            <img data-src="holder.js/100%x180" alt="...">-->
        </div>

        <h1 class="text-center" id="chrono">00:00</h1>

    </div>
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="form-horizontal  center-block">
                        <div class="form-group">
                            <label class="col-lg-4 control-label lead">Nom :</label>
                            <div class="col-lg-8">
                                <p class="form-control-static lead">Ronald steve Ndi</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label lead">Fonction :</label>
                            <div class="col-lg-8">
                                <p class="form-control-static lead">Developpeur</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-lg-6">
                        <a class="btn btn-block btn-info disabled" href="#">Start chrono speaking</a>
                    </div>
                    <div class="col-lg-6">
                        <a class="btn btn-block btn-info disabled" href="#">Start chrono question</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr/>
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

        $('#submit').on('click', function(e){
            e.preventDefault();
            if($('#inputMoment').val() != ""){
                var $value = $('#inputMoment').val();
                var socket = io.connect( 'http://'+window.location.hostname+':3000' );

                socket.emit('view_moment', {
                    moment: $value
                });

            }
        });

        var socket = io.connect( 'http://'+window.location.hostname+':3000' );

        socket.on( 'view_moment', function( data ) {
            $( "#moment" ).html( data.moment);
        });
//        var socket = io.connect( 'http://'+window.location.hostname+':3000' );
//
//        socket.emit('new_count_message', {
//            new_count_message: data.new_count_message
//        });
//
//        socket.emit('new_message', {
//            name: data.name,
//            email: data.email,
//            subject: data.subject,
//            created_at: data.created_at,
//            id: data.id
//        });

        $(".nav li").on("click", function(e) {
            if ($(this).hasClass("disabled")) {
                e.preventDefault();
                return false;
            }
        });
    });
</script>
<?php
$this->end();

?>
