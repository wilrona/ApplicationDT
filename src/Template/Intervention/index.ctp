<div class="modal-header">
    <h4 class="modal-title">Liste des intervenants : <?= $edition->titre; ?></h4>
</div>
<div class="modal-body">
    <div>
        <a href="/intervention/add/<?= $edition->id; ?>" class="btn btn-primary pull-right edit">Ajouter un intervenant</a>
    </div>
    <br/>
    <?= $this->Flash->render() ?>
    <table class="table table-stripped">
        <thead>
        <tr>
            <th width="30%">Speaker</th>
            <th width="45%">Sujet</th>
            <th width="10%">Categorie</th>
            <th width="15%">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($intervention as $intervention): ?>
            <tr>
                <td><?= h($intervention->speaker->nom) ?></td>
                <td><?= h($intervention->titre) ?></td>
                <td><?= h($intervention->categorie) ?></td>
                <td class="actions">
                    <a href="/intervention/edit/<?= $intervention->id; ?> " class="btn btn-link btn-xs edit"><i class="fa fa-pencil-square-o"></i></a> /
                    <a href="/intervention/index/<?= $intervention->edition_id; ?>/<?= $intervention->id ?> " class="btn btn-link btn-xs delete"><i class="fa fa-trash"></i></a>

                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>

<script>
    $('.edit, .delete').on('click', function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            type: 'GET',
            success: function(data) {
                $('.modal-content').html(data);
            }
        });
    });
</script>