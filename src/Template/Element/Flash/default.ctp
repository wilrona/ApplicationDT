<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
?>
<div class="<?= h($class) ?>"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <?= h($message) ?></div>
