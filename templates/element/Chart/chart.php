<?php
/**
 * @var \App\View\AppView $this
 * @var string $caption
 * @var string $tableOptions
 * @var string $tbodyContents
 */
?>
<table class="charts-css <?= $tableOptions ?>">
<?php if ($caption) : ?>
    <caption><?= $caption ?></caption>
    <tbody>
        <?= $tbodyContents ?>
    </tbody>
<?php endif; ?>
</table>
