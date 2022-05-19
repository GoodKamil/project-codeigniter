<?php $this->extend('templates/dashboard') ?>

<?php $this->section('content') ?>

<section class="contener__account">

    <div class="contener__account--div">
        <?php if ($message) : ?>
            <div class="acount">
                <h2 class="account--text">Doradca klienta</h2>
                <div class="select--acount">
                    <input type="text" value="<?= $message[0]->id_E ? GetUserID($message[0]->id_E) : '-' ?>" class='form--input' disabled>
                </div>

            </div>
            <div class="acount">
                <h2 class="account--text">Tytuł Wiadomości</h2>
                <div class="select--acount">
                    <input type="text" value="<?= $message[0]->title ?> " class='form--input' disabled>
                </div>

            </div>
            <div class="acount">
                <h2 class="account--text">Wiadomośc</h2>
                <div class="select--acount">
                    <textarea class='form--input' style="resize:none;" disabled><?= $message[0]->description ?></textarea>
                </div>

            </div>
            <div class="acount">
                <h2 class="account--text">Data wystąpienia problemu</h2>
                <div class="select--acount">
                    <input type="date" value='<?= $message[0]->dateProblems  ?>' class='form--input' disabled>
                </div>
            </div>
            <div class="acount">
                <h2 class="account--text">Data wysłania wiadomości</h2>
                <div class="select--acount">
                    <input type="datetime" value='<?= $message[0]->dateCreateProblems  ?>' class='form--input' disabled>
                </div>
            </div>
            <p class="error">&nbsp;</p>
            <div class="acount">
                <h2 class="account--text">Dodaj komentarz</h2>
                <div class="select--acount">
                    <textarea class='form--input' style="resize:none;" disabled><?= $message[0]->employeeComment ?></textarea>
                </div>
            </div>
            <div class="acount">
                <h2 class="account--text">Ustaw status</h2>
                <div class="select--acount">
                    <input type="text" value='<?= GetStatus($message[0]->status) ?>' class='form--input' disabled>
                </div>
            </div>
            <div class="button_form" style="margin:4rem 0 2rem 0">
                <a href="<?= base_url('messagesUser') ?>"><button class="edit__buton" type="submit">Powrót</button></a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php $this->endSection() ?>