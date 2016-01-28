
<div class="modal-header">
    <h4 class="modal-title">Creation d'un speaker</h4>
</div>
<?= $this->Form->create($speaker, ['id' => 'formulaire', 'horizontal' => false, 'cols' => [
        'lg' => [
            'label' => 4,
            'input' => 6,
            'error' => 4
        ]
    ], 'type' => 'file']) ?>
<div class="modal-body">

        <?= $this->Flash->render() ?>

        <?php
            echo $this->Form->input('nom',  ['label' => 'Nom du speaker :', 'type' => 'text']);
            echo $this->Form->input('fonction',  ['label' => 'Fonction du speaker :', 'type' => 'text']);
            echo $this->Form->input('twitter',  ['label' => 'Compte Tweeter :', 'type' => 'text']);
        ?>
        <div class="row">
            <div class="col-lg-7">
                <?php
                echo $this->Form->input('avatar', ['label' => 'Ajouter une photo:', 'type' => 'file', 'id' => 'photo']);
                ?>
            </div>
            <div class="col-lg-5">
                <img src="" alt="" class="img-rounded img-responsive" id="img-photo" style="width: 320px;"/>
            </div>
        </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <?= $this->Form->button('Enregistrement', ['bootstrap-type' => 'primary', 'id' => 'submit']) ?>
</div>
<?= $this->Form->end() ?>
<script>
    $('#submit').on('click', function(e){
        e.preventDefault();
        $form = $('#formulaire');
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();
        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            contentType: false, // obligatoire pour de l'upload
            processData: false, // obligatoire pour de l'upload
            data: data,
            success: function(data) {
                $('.modal-content').html(data);
            }
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img-photo').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#photo').on('change', function(e){
//        readURL(this);
        var files = $(this)[0].files;

        if (files.length > 0) {
            // On part du principe qu'il n'y qu'un seul fichier
            // étant donné que l'on a pas renseigné l'attribut "multiple"
            var file = files[0], $image_preview = $('#img-photo');

            // Ici on injecte les informations recoltées sur le fichier pour l'utilisateur
            $image_preview.attr('src', window.URL.createObjectURL(file));
            $('#input-photo').val(window.URL.createObjectURL(file))
        }
    });

   <?php
        if($success == true){
   ?>
            window.location.replace(window.location.origin+"/speaker").delay();
   <?php
        }
   ?>
</script>
