<?php $this->extend('templates/dashboard') ?>

<?php $this->section('content') ?>

<section class="contener__account">
    <div class="contener__account--div">
        <div class="acount">
            <h2 class="account--text">Odbiorca</h2>
            <div class="form">
                <label for="address" class="form--label">Dane odbiorcy</label>
                <input type="text" class="form--input" value="<?= $transfer[0]->adresO === '-' ? GetUser($transfer[0]->transferFrom) : esc($transfer[0]->adresO) ?>" disabled>
            </div>
            <div class="form">
                <label for="address" class="form--label">Numer rachunku</label>
                <input type="text" class="form--input" value="<?= GetAccount($transfer[0]->transferTo, 'number') ?>" disabled>
            </div>
        </div>
        <div class="acount">
            <h2 class="account--text">Dane transakcji</h2>
            <div class="contener__form">
                <div class="form">
                    <label for="address" class="form--label">Tytuł</label>
                    <input type="text" class="form--input" value="<?= $transfer[0]->title ?>" disabled>
                </div>
                <div class="form">
                    <label for="address" class="form--label">Kwota</label>
                    <input type="number" class="form--input" value="<?= $transfer[0]->price ?>" disabled>
                </div>
                <div class="form">
                    <label for="address" class="form--label">Data operacji</label>
                    <input type="text" class="form--input" value="<?= $transfer[0]->transferDate ?>" disabled>
                </div>
            </div>
        </div>
        <div class="acount">
            <h2 class="account--text">Nadawca</h2>
            <div class="form">
                <label for="address" class="form--label">Dane Nadawcy</label>
                <input type="text" class="form--input" value="<?= GetUser($transfer[0]->transferFrom) ?>" disabled>
            </div>
            <div class="form">
                <label for="address" class="form--label">Numer rachunku</label>
                <input type="text" class="form--input" value="<?= GetAccount($transfer[0]->transferFrom, 'number') ?>" disabled>
            </div>
        </div>
        <div class="button_form">
            <a href="<?= base_url('viewHistory') ?>"><button class="edit__buton">Powrót</button></a>
            <button class="edit__buton" type="submit">Pobierz PDF</button>
        </div>

    </div>
</section>


<?php $this->endSection() ?>