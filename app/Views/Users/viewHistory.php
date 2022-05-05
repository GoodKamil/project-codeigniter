<?php $this->extend('Users/dashboard') ?>

<?php $this->section('content') ?>

<section class="contener__account ">
    <div class="contener__account--div scroll-class">
        <?php foreach ($history as $value) : ?>
            <?php $payment = '';
            foreach ($numberAccount as $number) {
                $value->transferFrom === $number->id_N ? $payment = true : $payment = false;
            } ?>

            <a href="<?= base_url('viewHistoryOne/' . $value->id_T . '') ?>">
                <div class=" contener__history">
                    <div class="contener__history--address">
                        <div class="icon">
                            <i class="historyIcon bi bi-currency-exchange"></i>
                        </div>
                        <div style="margin-left:1rem;">
                            <h4 class="address"><?= $value->adresO ?> </h4>
                            <p class="history--text"><?= $value->title ?></p>
                        </div>
                    </div>
                    <div class="contener__history--price">

                        <p class="history--text"><?= $payment ? '-' . $value->price . ' zł' : $value->price . 'zł' ?></p>
                        <p class="history--text"><?= $value->transferDate ?></p>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</section>


<?php $this->endSection() ?>