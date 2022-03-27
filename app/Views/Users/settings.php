<?php $this->extend('Users/dashboard') ?>

<?php $this->section('content') ?>

<section class="contener__user">
    <div class="wrapper_user">
        <div class="contener__settings">
            <div class="contener__settings-tekst">
                <p class="settings-tekst">Imie:</p>
            </div>
            <div class="contener__settings-tekst">
                <p class="settings-tekst-dane"><?= $user[0]->FirstName ?></p>
            </div>
        </div>
        <div class="contener__settings">
            <div class="contener__settings-tekst">
                <p class="settings-tekst">Nazwisko:</p>
            </div>
            <div class="contener__settings-tekst">
                <p class="settings-tekst-dane"><?= $user[0]->LastName ?></p>
            </div>
        </div>
        <div class="contener__settings">
            <div class="contener__settings-tekst">
                <p class="settings-tekst">E-mail:</p>
            </div>
            <div class="contener__settings-tekst">
                <p class="settings-tekst-dane"><?= $user[0]->Email ?></p>
            </div>
        </div>
        <div class="contener__settings">
            <div class="contener__settings-tekst">
                <p class="settings-tekst">Numer konta:</p>
            </div>
            <div class="contener__settings-tekst">
                <p class="settings-tekst-dane"><?= $user[0]->NumberAccount ?></p>
            </div>
        </div>
        <div class="contener__settings">
            <div class="contener__settings-tekst">
                <p class="settings-tekst">Numer telefonu:</p>
            </div>
            <div class="contener__settings-tekst">
                <p class="settings-tekst-dane"><?= $user[0]->NumberPhone ?></p>
            </div>
        </div>
        <div class="contener__settings">
            <div class="contener__settings-tekst">
                <p class="settings-tekst">Hasło:</p>
            </div>
            <div class="contener__settings-tekst">
                <p class="settings-tekst-dane">********</p>
            </div>
        </div>
        <div class="contener__settings">
            <div class="contener__settings-tekst">
                <p class="settings-tekst">Klucz logowania</p>
            </div>
            <div class="contener__settings-tekst">
                <p class="settings-tekst-dane">********</p>
            </div>
        </div>
        <div class="contener__settings">
            <div class="contener__settings-tekst">
                <p class="settings-tekst">Ostatnie połączenie:</p>
            </div>
            <div class="contener__settings-tekst">
                <p class="settings-tekst-dane"><?= $user[0]->LastConnect ?></p>
            </div>
        </div>
        <div class="contener__settings">
            <a href="<?= base_url('editUser') ?>"><button class="edit__buton">Edytuj </button></a>
        </div>
        <?php if (session()->getFlashdata('successUpdate')) : ?>
            <div class="success">
                <p class="seccuess-tekst">Pomyślnie edytowano dane</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php $this->endSection() ?>