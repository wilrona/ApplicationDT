<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Edition'), ['action' => 'edit', $edition->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Edition'), ['action' => 'delete', $edition->id], ['confirm' => __('Are you sure you want to delete # {0}?', $edition->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Edition'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Edition'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Intervention'), ['controller' => 'Intervention', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Intervention'), ['controller' => 'Intervention', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="edition view large-9 medium-8 columns content">
    <h3><?= h($edition->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Titre') ?></th>
            <td><?= h($edition->titre) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($edition->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Date') ?></th>
            <td><?= h($edition->date) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Intervention') ?></h4>
        <?php if (!empty($edition->intervention)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Titre') ?></th>
                <th><?= __('Note') ?></th>
                <th><?= __('Categorie') ?></th>
                <th><?= __('Actif') ?></th>
                <th><?= __('Chrono Speaking') ?></th>
                <th><?= __('Chrono Question') ?></th>
                <th><?= __('Date Speaking') ?></th>
                <th><?= __('Date Question') ?></th>
                <th><?= __('Date Update') ?></th>
                <th><?= __('Edition Id') ?></th>
                <th><?= __('Speaker Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($edition->intervention as $intervention): ?>
            <tr>
                <td><?= h($intervention->id) ?></td>
                <td><?= h($intervention->titre) ?></td>
                <td><?= h($intervention->note) ?></td>
                <td><?= h($intervention->categorie) ?></td>
                <td><?= h($intervention->actif) ?></td>
                <td><?= h($intervention->chrono_speaking) ?></td>
                <td><?= h($intervention->chrono_question) ?></td>
                <td><?= h($intervention->date_speaking) ?></td>
                <td><?= h($intervention->date_question) ?></td>
                <td><?= h($intervention->date_update) ?></td>
                <td><?= h($intervention->edition_id) ?></td>
                <td><?= h($intervention->speaker_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Intervention', 'action' => 'view', $intervention->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Intervention', 'action' => 'edit', $intervention->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Intervention', 'action' => 'delete', $intervention->id], ['confirm' => __('Are you sure you want to delete # {0}?', $intervention->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
