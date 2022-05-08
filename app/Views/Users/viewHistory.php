<?php $this->extend('templates/dashboard') ?>

<?php $this->section('content') ?>

<section class="contener__account ">
    <div class="contener__account--div scroll-class">

        <?php
        $array = [];
        foreach ($history as $value) :
            if (!in_array($value->id_T, $array)) :
                $payment = 'Green';
                if ($value->adresO === '-')
                    $payment = 'Violet';
                else {
                    foreach ($numberAccount as $number) {
                        if ($value->transferFrom === $number->id_N)
                            $payment = 'Red';
                    }
                } ?>

                <a href="<?= base_url('viewHistoryOne/' . $value->id_T . '') ?>">
                    <div class=" contener__history <?= 'payment' . $payment ?>">
                        <div class="contener__history--address">
                            <div class="icon">
                                <i class="historyIcon bi bi-currency-exchange"></i>
                            </div>
                            <div style="margin-left:1rem;">
                                <h4 class="address"><?= $payment === 'Violet' ? 'Przelew na własne konto' : esc($value->adresO)  ?> </h4>
                                <p class="history--text"><?= $value->title ?></p>
                            </div>
                        </div>
                        <div class="contener__history--price">

                            <p class="history--text"><?= $payment == 'Red' ? '-' . $value->price . 'zł' : $value->price . 'zł' ?></p>
                            <p class="history--text"><?= $value->transferDate ?></p>
                        </div>
                    </div>
                </a>
        <?php
                array_push($array, $value->id_T);
            endif;
        endforeach; ?>
    </div>
</section>


<?php $this->endSection() ?>