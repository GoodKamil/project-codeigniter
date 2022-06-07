<?php
$this->extend('templates/main');
$this->section('content');

/**
 *
 *
 * @var $idUser int
 *
 */

?>


<div class="bacground--contener">
    <div class="contener__login">
        <div class="contener__login-wrapper">
            <div class="create_account">
                <div class="title__div">
                    <h1 class="title__div--text">Odzyskiwanie konto</h1>
                </div>
                <form action="<?=base_url('doRecoverChangePassword') ?>" method="post">
                    <input type="hidden" name="idUser" value="<?=$idUser?>">
                    <div class="form__contener">
                        <div class="input__contener">
                            <label for="" class="input__contener--text">Hasło:</label>
                            <div class="wrapper--icon">
                                <input type="password" name="password" value="<?= set_value('password', '') ?>" class="input__contener--input">
                                <i class="icon bi bi-key"></i>
                            </div>
                            <p class="error"><?= isset($validation) && $validation->hasError('password') ? $validation->getError('password') : '&nbsp' ?> </p>
                        </div>
                        <div class="input__contener">
                            <label for="" class="input__contener--text">Powtórz hasło:</label>
                            <div class="wrapper--icon">
                                <input type="password" name="repeatPassword" value="<?= set_value('repeatPassword', '') ?>" class="input__contener--input">
                                <i class="icon bi bi-key"></i>
                            </div>
                            <p class="error"><?= isset($validation) && $validation->hasError('repeatPassword') ? $validation->getError('repeatPassword') : '&nbsp' ?> </p>
                        </div>
                        <div class="button__contener">
                            <button class="button_contener--btn" type="submit">Zmień</button>
                        </div>
                    </div>
                    <div class="contener__helper">
                        <a href="<?= base_url('/') ?>" class="contener__helper--link">Powrót</b></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>
