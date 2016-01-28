<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header"><i class="fa fa-users"></i> Liste des speakers</h4>
    </div>
    <!-- /.col-lg-12 -->
</div>

<!--<nav class="large-3 medium-4 columns" id="actions-sidebar">-->
<!--    <ul class="side-nav">-->
<!--        <li class="heading">--><?//= __('Actions') ?><!--</li>-->
<!--        <li>--><?//= $this->Html->link(__('New Speaker'), ['action' => 'add']) ?><!--</li>-->
<!--        <li>--><?//= $this->Html->link(__('List Intervention'), ['controller' => 'Intervention', 'action' => 'index']) ?><!--</li>-->
<!--        <li>--><?//= $this->Html->link(__('New Intervention'), ['controller' => 'Intervention', 'action' => 'add']) ?><!--</li>-->
<!--    </ul>-->
<!--</nav>-->
<ul class="nav nav-pills">
    <li><a data-toggle="modal" href="/speaker/add" data-target="#myModal" data-backdrop="static">Creer un speaker</a></li>
</ul>
<hr/>
<?= $this->Flash->render() ?>
<div class="speaker index large-9 medium-8 columns content">
    <table cellpadding="0" cellspacing="0" class="table table-bordered">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('nom') ?></th>
                <th><?= $this->Paginator->sort('fonction') ?></th>
                <th><?= $this->Paginator->sort('twitter') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($speaker as $speaker): ?>
            <tr>
                <td><?= $this->Html->image($speaker->avatar, ['class' => 'img-circle img-responsive pull-left', 'style' => 'width:25px; height: 25px; margin-right: 7px;']); ?>  <?= h($speaker->nom) ?></td>
                <td><?= h($speaker->fonction) ?></td>

                <td><?= h($speaker->twitter) ?></td>
                <td class="actions">
                    <a data-toggle="modal" href="/speaker/edit/<?= $speaker->id; ?> " data-target="#myModal" data-backdrop="static">Modifier</a> /
                    <?= $this->Form->postLink('Supprimer', ['action' => 'delete', $speaker->id], ['confirm' => __('Are you sure you want to delete # {0}?', $speaker->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('Prececent') ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('Suivant') ?>
        </ul>
    </div>
</div>
