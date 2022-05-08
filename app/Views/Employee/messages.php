<?php $this->extend('templates/dashboard') ?>

<?php $this->section('content') ?>


<section class="contener__account ">
    <div class="contener__account--div scroll-class">
        <?php if (session()->getFlashdata('successUpdate')) : ?>
            <div class="success">
                <p class="seccuess-tekst">Decyzja odnośnie wiadomość została wysłana </p>
            </div>
        <?php endif; ?>
        <?php foreach ($messages as $value) :
            $icon = 'bi-patch-question';
            if ($value->status === '2')
                $icon = 'bi-patch-check';
            else if ($value->status === '3')
                $icon = 'bi-patch-exclamation';

        ?>

            <a href="<?= base_url('viewMessage/' . $value->id_M) ?>">
                <div class=" contener__history">
                    <div class="contener__history--address">
                        <div class="icon">
                            <i class="historyIcon bi <?= $icon ?>"></i>
                        </div>
                        <div style="margin-left:1rem;">
                            <h4 class="address"><?= GetUserID($value->id_U)  ?> </h4>
                            <p class="history--text"><?= $value->title ?></p>
                        </div>
                    </div>
                    <div class="contener__history--price">
                        <p class="history--text"><?= $value->dateCreateProblems     ?></p>
                    </div>
                </div>
            </a>
        <?php endforeach;  ?>
    </div>
</section>
<?php $this->endSection() ?>