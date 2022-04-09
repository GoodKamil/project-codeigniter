<?php $this->extend('templates/main') ?>
<?php $this->section('content') ?>

<div class="contener__login">
    <div class="contener__login-wrapper">
        <div class="create_account">
            <?php if (session()->getFlashdata('successInsert')) : ?>
                <div class="success">
                    <p class="seccuess-tekst">Pomyślnie utworzono konto </p>
                </div>
            <?php endif; ?>
            <div class="title__div">
                <h1 class="title__div--text">Zaloguj sie</h1>
            </div>
            <form action="LoginUser" method="post">
                <div class="form__contener">
                    <div class="input__contener">
                        <label for="" class="input__contener--text">Login:</label>
                        <div class="wrapper--icon">
                            <input type="text" name="loginKey" value="<?= set_value('loginKey', '') ?>" class="input__contener--input">
                            <i class="icon bi bi-key"></i>
                        </div>
                        <p class="error"><?= isset($validation) && $validation->hasError('loginKey') ? $validation->getError('loginKey') : '&nbsp' ?> </p>
                    </div>
                    <div class="input__contener">
                        <label for="" class="input__contener--text">Email:</label>
                        <div class="wrapper--icon">
                            <input type="email" name="emailLogin" autocomplete="off" value="<?= set_value('emailLogin', '') ?>" class="input__contener--input">
                            <i class="icon bi bi-at"></i>
                        </div>
                        <p class="error"><?= isset($validation) && $validation->hasError('emailLogin') ? $validation->getError('emailLogin') : '&nbsp' ?> </p>
                    </div>
                    <div class="input__contener">
                        <label for="" class="input__contener--text">Password:</label>
                        <div class="wrapper--icon">
                            <input type="password" name="passwordLogin" value="<?= set_value('passwordLogin', '') ?>" class="input__contener--input">
                            <i class="icon  bi bi-lock"></i>
                        </div>
                        <p class="error"><?= isset($validation) && $validation->hasError('passwordLogin') ? $validation->getError('passwordLogin') : '&nbsp' ?> </p>
                    </div>
                    <div class="button__contener">
                        <button class="button_contener--btn" type="submit">Zaloguj się</button>
                    </div>
                </div>
                <div class="contener__helper">
                    <a href="<?= base_url('createAccount') ?>" class="contener__helper--link">Nie posiadasz konta?<b>Zarejestruj się</b></a>
                    <a href="#" class="contener__helper--link">Zapomnaiłes hasła?<b>Odzyskaj hasło</b></a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->endSection() ?>