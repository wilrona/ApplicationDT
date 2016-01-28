<div class="modal-header bg-primary">
    <h4 class="modal-title">Activer un speaker : <?= $edition->titre ?></h4>
</div>
<div class="modal-body">

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
            <tr>
                <td><?= $inter->speaker_id; ?></td>
                <td><?= $inter->titre; ?></td>
                <td></td>
                <td></td>
            </tr>
        <?php
            endforeach;
        ?>
        </tbody>
    </table>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    <button type="button" class="btn btn-primary" id="validation">Valider</button>
</div>