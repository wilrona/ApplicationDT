
<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header"><i class="fa fa-file-text"></i> Editions</h4>
    </div>
    <!-- /.col-lg-12 -->
</div>

<ul class="nav nav-pills">
    <li><a data-toggle="modal" href="/edition/add" data-target="#myModal" data-backdrop="static">Creer une edition</a></li>
</ul>
<hr/>
<div class="edition index large-9 medium-8 columns content">
    <?= $this->Flash->render() ?>
    <table cellpadding="0" cellspacing="0" class="table table-bordered">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('titre') ?></th>
                <th><?= $this->Paginator->sort('date evenement') ?> </th>
                <th class="actions" width="25%"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($edition as $edition): ?>
            <tr>
                <td><?= h($edition->titre) ?></td>
                <td><?= h($edition->date->format('d M Y')) ?></td>
                <td class="actions">
                    <a data-toggle="modal" href="/edition/edit/<?= $edition->id; ?> " data-target="#myModal" data-backdrop="static">Modifier</a> /
<!--                    --><?//= $this->Form->postLink('Supprimer', ['action' => 'delete', $edition->id], ['confirm' => __('Are you sure you want to delete # {0}?', $edition->id)]) ?><!-- /-->
                    <a data-toggle="modal" href="/intervention/index/<?= $edition->id; ?> " data-target="#myModal" data-backdrop="static">Intervenant</a>
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
<!--        <p>--><?//= $this->Paginator->counter() ?><!--</p>-->
    </div>
</div>
