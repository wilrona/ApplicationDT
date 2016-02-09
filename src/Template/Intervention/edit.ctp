<div class="modal-header">
    <h4 class="modal-title">Modifier intervenant : <?= $edition->titre; ?></h4>
</div>
<?= $this->Form->create($intervention, ['id' => 'formulaire', 'horizontal' => false, 'cols' => [
        'lg' => [
            'label' => 3,
            'input' => 7,
            'error' => 4
        ]
    ]]) ?>
<div class="modal-body">
    <?= $this->Flash->render() ?>
    <?php
    echo $this->Form->input('titre',  ['label' => 'Presentation :', 'type' => 'text']);
    echo $this->Form->input('categorie',
        ['label' => 'Categorie :',
            'type' => 'select',
            'options' => array('speaker' => 'Speaker', 'startup' => 'Startup', 'partenaire' => 'Partenaire', 'partenaire gold' => 'Partenaire Gold'),
            'empty' => 'Selectionne une categorie',
            'class' => 'g-select input-lg'
        ]
    );

    echo $this->Form->input('speaker_id',
        ['label' => 'Intervenant :',
            'type' => 'select',
            'options' => $list,
            'empty' => 'Selectionne l\'intervenant',
            'class' => 'g-select input-lg'
        ]);
    ?>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    <a href="/intervention/index/<?= $edition->id; ?>" class="btn btn-info" id="return">Retour</a>
    <button type="button" id="submit" class="btn btn-primary">Enregistrer</button>
</div>
<?= $this->Form->end() ?>
<script>

    $('#return').on('click', function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            type: 'GET',
            success: function(data) {
                $('.modal-content').html(data);
            }
        });
    });

    $('#submit').on('click', function(e){
        e.preventDefault();
        $.ajax({
            url: $('#formulaire').attr('action'),
            data: $('#formulaire').serialize(),
            type: 'POST',
            success: function(data) {
                $('.modal-content').html(data);
            }
        });
    });

    // Google styled selects
    $("select.g-select").each(function() {
        var e = $(this);
        e.select2()
    });

    <?php
    if($success == true){
    ?>
    $.ajax({
        url: "/intervention/index/<?= $edition->id; ?>",
        type: 'GET',
        success: function(data) {
            $('.modal-content').html(data);
        }
    });
    <?php
    }
    ?>
</script>