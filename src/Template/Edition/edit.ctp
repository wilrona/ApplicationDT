<div class="modal-header">
    <h4 class="modal-title">Modification d'une edition</h4>
</div>
<?= $this->Form->create($edition, ['id' => 'formulaire', 'horizontal' => true, 'cols' => [
        'lg' => [
            'label' => 4,
            'input' => 6,
            'error' => 4
        ]
    ]]); ?>
<div class="modal-body">
    <?php
    echo $this->Form->input('titre', ['label' => 'Nom de l\'edition :', 'type' => 'text']);

    $date = '';
    if(!empty($last_date)): $date = $last_date; endif;
    echo $this->Form->input('date', ['label' => 'Date de l\'edition :', 'type' => 'text', 'id' => 'datepicker', 'value' => $last_date]);
    ?>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <?= $this->Form->button('Enregistrement', ['bootstrap-type' => 'primary', 'id' => 'submit']) ?>
</div>
<?= $this->Form->end() ?>

<script>
    $('#datepicker').datepicker({
        format: "dd/mm/yyyy",
        weekStart: 1,
        todayBtn: "linked",
        orientation: "top auto",
        todayHighlight: true
    });
    $('#submit').on('click', function(e){
        e.preventDefault();
        $form = $('#formulaire').attr('action');
        $.ajax({
            url: $form,
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
    window.location.replace(window.location.origin+"/edition").delay();
    <?php
    }
    ?>
</script>

