<div class="modal-header bg-primary">
    <h4 class="modal-title">Activer un speaker : <?= $edition->titre ?></h4>
</div>
<div class="modal-body" style="height: 450px; overflow-y: auto;">
    <h3>Liste des intervenants</h3>
    <hr/>
    <table class="table table-condensed table-stripped">
        <thead>
        <tr>
            <th>Speaker</th>
            <th>Sujet</th>
            <th>Categorie</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
            foreach($intervention as $inter):
        ?>
            <tr <?php if($inter->actif): ?> class="active" <?php endif; ?>>
                <td><?= $inter->speaker->nom; ?></td>
                <td><?= $inter->titre; ?></td>
                <td><?= $inter->categorie ?></td>
                <td>
                    <a href="/evenement/activer_speaker/<?= $edition->id; ?>/<?= $inter->id; ?>.json" class="btn btn-link btn-xs activation" ><?php if($inter->actif): ?>Desactiver <?php else: ?> Activer <?php endif; ?></a>
                </td>
            </tr>
        <?php
            endforeach;
        ?>
        </tbody>
    </table>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="closed">Fermer</button>
</div>

<script>
       $('.activation').on('click', function(e){
           e.preventDefault();
           var url = $(this).attr('href');
           $.ajax({
               url: url,
               type: 'GET',
               success: function(data) {
                    if(data.speaker['actif'] == 1){
                        var socket = io.connect( 'http://'+window.location.hostname+':3000' );

                        socket.emit('active_speaker', {
                            nom: data.speaker['nom'],
                            fonction: data.speaker['fonction'],
                            sujet: data.speaker['sujet'],
                            photo: data.speaker['photo'],
                            twitter: data.speaker['twitter'],
                            categorie: data.speaker['categorie'],
                            intervent: data.speaker['intervent']
                        });



                    }else{
                        if(!$('#speaking-start').hasClass('disabled')) {
                            $("#speaking-start").addClass('disabled');
                        }
                        if(!$('#show-front').hasClass('disabled')) {
                            $("#show-front").addClass('disabled');
                        }
                    }

                   $('#chrono').removeClass('bg-danger');
                   $('#speaking-start').addClass('disabled');
                   $('#speaking-stop').addClass('disabled');
                   $('#speaking-reset').addClass('disabled');

                   $('#question-start').addClass('disabled');
                   $('#question-stop').addClass('disabled');

                   $('#closed').trigger('click');
               }

           });
       });

</script>