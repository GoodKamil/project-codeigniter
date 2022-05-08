<?php $this->extend('templates/dashboard') ?>

<?php $this->section('content') ?>

<section class="contener__account">
    <div class="contener__account--div">
        <?php if (session()->getFlashdata('successInsert')) : ?>
            <div class="success">
                <p class="seccuess-tekst">Numer konta został pomyślnie dodany </p>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('errorAccount')) : ?>
            <div class="error_contener">
                <p class="error_contener-tekst">Maksymalnie użytkownik może posiadać dwa numery kont bankowych</p>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('noOwnTransfer')) : ?>
            <div class="error_contener">
                <p class="error_contener-tekst">Nie można dokonac przelewu własnego ponieważ posiadasz jeden numer konta bankowego</p>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('successTransfer')) : ?>
            <div class="success">
                <p class="seccuess-tekst">Przelew na konto własne został wykonany pomyślnie</p>
            </div>
        <?php endif; ?>
        <div class="acount">
            <h2 class="account--text">Numer konta</h2>
            <div class="select--acount">
                <select name="account_you" class="form--input" id="changeNumerAccount">
                    <?php foreach ($numberAccount as $key => $value) : ?>
                        <option value="<?= $value->id_N ?>"><?= $value->number ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="acount">
            <h2 class="account--text">Kwota</h2>
            <div class="select--acount">
                <input type="text" value='<?= $price . ' zł' ?>' class='form--input' id='changePrice' disabled>
            </div>
        </div>
        <div class="acount">
            <h2 class="account--text">Nazwa banku</h2>
            <div class="select--acount">
                <input type="text" value='Bank Wielkopolski' class='form--input' disabled>
            </div>
        </div>
        <div class="button_form" style="margin:4rem 0 2rem 0">
            <a href="<?= base_url('addAccount') ?>"><button class="edit__buton" type="submit">Dodaj numer konta</button></a>
            <a href="<?= base_url('ownTransfer') ?>"><button class="edit__buton" type="submit">Przelew własny</button></a>
        </div>
    </div>
</section>

<script src=<?= base_url('js/ajax.js') ?>></script>

<?php $this->endSection() ?>