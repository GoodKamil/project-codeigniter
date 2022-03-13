<?php $this->extend('templates/main') ?>

<?php $this->section('content') ?>

<div class="wrapper__application">
  <?= view_cell('\App\Libraries\Render::renderMenu') ?>
  <?php $this->renderSection('content') ?>
</div>
<?php $this->endSection() ?>