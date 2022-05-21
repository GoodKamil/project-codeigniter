<?php $this->extend('templates/dashboard') ?>

<?php $this->section('content') ?>

<section class="contener__account">
    <div class="contener__account--div">
        <?php if ($message) : ?>
            <form action="<?= base_url('viewMessage/' . $message[0]->id_M) ?>" method='post'>
                <div class="acount">
                    <h2 class="account--text">Zgłaszający</h2>
                    <div class="select--acount">
                        <input type="text" value="<?= GetUserID($message[0]->id_U) ?>" class='form--input' disabled>
                    </div>

                </div>
                <div class="acount">
                    <h2 class="account--text">Tytuł Wiadomości</h2>
                    <div class="select--acount">
                        <input type="text" value="<?= $message[0]->title ?> " class='form--input' disabled>
                    </div>

                </div>
                <div class="acount">
                    <h2 class="account--text">Wiadomość</h2>
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
                        <input type="datetime" value='<?= $message[0]->dateCreateProblems      ?>' class='form--input' disabled>
                    </div>
                </div>
                <p class="error">&nbsp;</p>
                <div class="acount">
                    <h2 class="account--text">Dodaj komentarz</h2>
                    <div class="select--acount">
                        <textarea class='form--input' style="resize:none;" name='addComent'><?= $message[0]->employeeComment ?></textarea>
                    </div>
                    <p class="error"><?= isset($validation) && $validation->hasError('addComent') ? $validation->getError('addComent') : '&nbsp' ?> </p>
                </div>
                <div class="acount">
                    <h2 class="account--text">Ustaw status</h2>
                    <div class="select--acount">
                        <select class="form--input" name='status'>
                            <?php foreach ($status as $key => $value) : ?>
                                <option <?= isset($_POST['status']) && $_POST['status'] == $key || $message[0]->status == $key  ? 'selected' : '' ?> value="<?= $key ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p class="error"><?= isset($validation) && $validation->hasError('status') ? $validation->getError('status') : '&nbsp' ?> </p>
                    </div>
                </div>
                <div class="button_form" style="margin:4rem 0 2rem 0">
                    <button formaction="<?= base_url('messages') ?>" class="edit__buton" formmethod="GET" type="submit">Powrót</button>
                    <button class="edit__buton" type="submit">Wyślij</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</section>

<?php $this->endSection() ?>