<?php $this->extend('templates/dashboard') ?>

<?php $this->section('content') ?>

<section class="contener__account">
    <div class="contener__account--div">
        <?php if (session()->getFlashdata('successSendProblem')) : ?>
            <div class="success">
                <p class="seccuess-tekst">Zgłoszenie zostało przyjęte</p>
            </div>
        <?php endif; ?>
        <form action="reportProblem" method='post'>
            <div class="acount">
                <h2 class="account--text">Tytuł problemu</h2>
                <div class="select--acount">
                    <input type="text" class='form--input' autocomplete="off" name='titleProblem'>
                </div>
                <p class="error"><?= isset($validation) && $validation->hasError('titleProblem') ? $validation->getError('titleProblem') : '&nbsp' ?> </p>
            </div>
            <div class="acount">
                <h2 class="account--text">Opis problemu</h2>
                <div class="select--acount">
                    <textarea name="descriptionProblem" autocomplete="off" class='form--input'></textarea>
                </div>
                <p class="error"><?= isset($validation) && $validation->hasError('descriptionProblem') ? $validation->getError('descriptionProblem') : '&nbsp' ?> </p>
            </div>
            <div class="acount">
                <h2 class="account--text">Data wystąpienia problemu</h2>
                <div class="select--acount">
                    <input type="date" value='<?= date('Y-m-d') ?>' name='dateProblems' class='form--input'>
                </div>
                <p class="error"><?= isset($validation) && $validation->hasError('dateProblems') ? $validation->getError('dateProblems') : '&nbsp' ?> </p>
            </div>
            <div class="acount">
                <h2 class="account--text">Data zgłoszenia problemu</h2>
                <div class="select--acount">
                    <input type="datetime" value='<?= date('Y-m-d H:i') ?>' name='dateCreated' class='form--input' readonly>
                </div>
            </div>
            <div class="button_form" style="margin:4rem 0 2rem 0">
                <button formaction="<?= base_url('HomeUser') ?>" class="edit__buton" formmethod="GET" type="submit">Powrót</button>
                <button class="edit__buton" type="submit">Wyślij</button>
            </div>
        </form>
    </div>
</section>

<?php $this->endSection() ?>