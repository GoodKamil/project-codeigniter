<?php $this->extend('templates/main') ?>
<?php $this->section('content') ?>

<div class="contener__login">
    <div class="contener__login-wrapper">
        <div class="create_account">
            <div class="title__div">
                <h1 class="title__div--text">Zaloguj sie</h1>
            </div>
            <form action="LoginUser" method="post">
                <div class="form__contener">
                    <div class="input__contener">
                        <label for="" class="input__contener--text">Login:</label>
                        <div class="wrapper--icon">
                            <input type="text" name="loginKey" required class="input__contener--input">
                            <i class="icon bi bi-key"></i>
                        </div>
                        <p class="error"><?= isset($validation) && $validation->hasError('loginKey') ? $validation->getError('loginKey') : '&nbsp' ?> </p>
                    </div>
                    <div class="input__contener">
                        <label for="" class="input__contener--text">Email:</label>
                        <div class="wrapper--icon">
                            <input type="email" name="username" autocomplete="off" required class="input__contener--input">
                            <i class="icon bi bi-at"></i>
                        </div>
                        <p class="error"><?= isset($validation) && $validation->hasError('username') ? $validation->getError('username') : '&nbsp' ?> </p>
                    </div>
                    <div class="input__contener">
                        <label for="" class="input__contener--text">Password:</label>
                        <div class="wrapper--icon">
                            <input type="password" name="password" required class="input__contener--input">
                            <i class="icon  bi bi-lock"></i>
                        </div>
                        <p class="error"><?= isset($validation) && $validation->hasError('password') ? $validation->getError('password') : '&nbsp' ?> </p>
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