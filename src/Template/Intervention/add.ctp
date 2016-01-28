<div class="modal-header">
    <h4 class="modal-title">Ajouter intervenant : <?= $edition->titre; ?></h4>
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
                'options' => array('speaker' => 'Speaker', 'startup' => 'Startup', 'partenaire' => 'Partenaire'),
                'empty' => 'Selectionne une categorie',
                'class' => 'g-select'
            ]
        );

        echo $this->Form->input('speaker_id',
            ['label' => 'Intervenant :',
                'type' => 'select',
                'options' => $list,
                'empty' => 'Selectionne l\'intervenant',
                'class' => 'g-select'
            ]);
    ?>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    <a href="/intervention/index/<?= $edition->id ?>" class="btn btn-info" id="return">Retour</a>
    <button type="button" id="submit" class="btn btn-primary">Enregistrer</button>
</div>
<?= $this->Form->end() ?>
<script>
    $("select.g-select").select2();

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