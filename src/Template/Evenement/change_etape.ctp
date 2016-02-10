<div class="modal-header bg-primary">
    <h4 class="modal-title">Changer d'etape</h4>
</div>
<div class="modal-body">

    <div class="form-horizontal">

        <form class="form-group" id="formulaire">
            <label for="inputEmail3" class="col-sm-3 control-label">Etape Event :</label>
            <div class="col-sm-9">
                <select class="form-control" name="etape">
                    <option value="0" <?php if($etape->etape == 0) echo "selected" ?>>Choisir une etape</option>
                    <option value="1" <?php if($etape->etape == 1) echo "selected" ?>>Presentation</option>
                    <option value="2" <?php if($etape->etape == 2) echo "selected" ?>>Speaker</option>
                    <option value="3" <?php if($etape->etape == 3) echo "selected" ?>>Applaudissement</option>
                </select>
            </div>
        </form>
    </div>


</div>
<div class="modal-footer">
    <span class="pull-left">
        <button type="button" class="btn btn-info <?php if($etape->etape != 3): ?>disabled <?php endif; ?>" id="ChronoApplaud">Start Chrono Applaudissement</button>
    </span>
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    <button type="button" class="btn btn-primary" id="validation">Valider</button>
</div>
<script>
    $(document).ready(function(){

        $('#ChronoApplaud').on('click', function(e){
            e.preventDefault();
            var socket = io.connect( 'http://'+window.location.hostname+':3000' );
            socket.emit('start_chrono', {
                start_chrono: 4
            });
        });

        $('#validation').on('click', function(e){
            e.preventDefault();
            $.ajax({
                url: "/evenement/change_etape.json",
                data: $('#formulaire').serialize(),
                type: 'POST',
                success: function(data) {
                    if(data.etape == 0){
                        $('#etape_encours').html('Introduction');
                        $('#ChronoApplaud').addClass('disabled');
                        $('#active_speaker').addClass('disabled');

                        if(!$('#speaking-start').hasClass('disabled')) {
                            $("#speaking-start").addClass('disabled');
                        }
                        if(!$('#show-front').hasClass('disabled')) {
                            $("#show-front").addClass('disabled');
                        }
                    }
                    if(data.etape == 1){
                        $('#etape_encours').html('Presentation');
                        $('#ChronoApplaud').addClass('disabled');
                        $('#active_speaker').addClass('disabled');
                        if(!$('#speaking-start').hasClass('disabled')) {
                            $("#speaking-start").addClass('disabled');
                        }
                        if(!$('#show-front').hasClass('disabled')) {
                            $("#show-front").addClass('disabled');
                        }

                        var socketss = io.connect( 'http://'+window.location.hostname+':3000' );

                        socketss.emit('view_moment', {
                            moment: "Bienvenu aux Digital Thursday"
                        });
                    }
                    if(data.etape == 2){
                        $('#etape_encours').html('Speaker');
                        $('#ChronoApplaud').addClass('disabled');
                        $('#active_speaker').removeClass('disabled');

                        var sockets = io.connect( 'http://'+window.location.hostname+':3000' );

                        if(data.intervention){
//                            if($('#speaking-start').hasClass('disabled')) {
//                                $("#speaking-start").removeClass('disabled');
//                            }
                            if($('#show-front').hasClass('disabled')) {
                                $("#show-front").removeClass('disabled');
                            }
                            sockets.emit('speaker_ready', {
                                speaking: 1
                            });

                        }else{

                            sockets.emit('speaker_ready', {
                                speaking: 1
                            });

                        }
                    }
                    if(data.etape == 3){
                        $('#etape_encours').html('Applaudissement');
                        $('#ChronoApplaud').removeClass('disabled');
                        $('#active_speaker').addClass('disabled');
                        if(!$('#speaking-start').hasClass('disabled')) {
                            $("#speaking-start").addClass('disabled');
                        }
                        if(!$('#show-front').hasClass('disabled')) {
                            $("#show-front").addClass('disabled');
                        }
                    }

                    if (data.etape != 2){
                        var socket = io.connect( 'http://'+window.location.hostname+':3000' );

                        socket.emit('change_etape', {
                            etape: data.etape
                        });
                    }

                }
            });
        })
    });
</script>