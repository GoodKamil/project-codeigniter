<?php $this->extend('templates/main') ?>
<?php $this->section('content') ?>

<div class="contener__login">
    <div class="contener__register-wrapper">
        <div class="create_account">
            <div class="title__div">
                <h1 class="title__div--text">Zarejestruj się</h1>
            </div>
            <form action="#" method="post">
                <div class="form__contener">
                    <div class="register__input">
                        <div class="input__contener">
                            <label for="" class="input__contener--text">Email:</label>
                            <div class="wrapper--icon">
                                <input type="email" name="email" autocomplete="off" required class="input__contener--input">
                                <i class="icon bi-at"></i>
                            </div>
                            <p class="error"><?= isset($validation) && $validation->hasError('email') ? $validation->getError('email') : '&nbsp' ?> </p>
                        </div>
                    </div>
                    <div class="register">
                        <div class="input__contener flex-45">
                            <label for="" class="input__contener--text">Imię:</label>
                            <div class="wrapper--icon">
                                <input type="text" name="firstname" autocomplete="off" class="input__contener--input">
                                <i class="icon bi bi-person"></i>
                            </div>
                            <p class="error"><?= isset($validation) && $validation->hasError('firstname') ? $validation->getError('firstname') : '&nbsp' ?> </p>
                        </div>
                        <div class="input__contener flex-45">
                            <label for="" class="input__contener--text">Nazwisko:</label>
                            <div class="wrapper--icon">
                                <input type="text" name="lastname" autocomplete="off" class="input__contener--input">
                                <i class="icon bi bi-person"></i>
                            </div>
                            <p class="error"><?= isset($validation) && $validation->hasError('lastname') ? $validation->getError('lastname') : '&nbsp' ?> </p>
                        </div>
                    </div>
                    <div class="register">
                        <div class="input__contener flex-45">
                            <label for="" class="input__contener--text">Hasło:</label>
                            <div class="wrapper--icon">
                                <input type="password" name="password" class="input__contener--input">
                                <i class="icon  bi bi-lock"></i>
                            </div>
                            <p class="error"><?= isset($validation) && $validation->hasError('password') ? $validation->getError('password') : '&nbsp' ?> </p>
                        </div>
                        <div class="input__contener flex-45">
                            <label for="" class="input__contener--text">Powtórz hasło:</label>
                            <div class="wrapper--icon">
                                <input type="password" name="RepeatPassword" class="input__contener--input">
                                <i class="icon  bi bi-lock"></i>
                            </div>
                            <p class="error"><?= isset($validation) && $validation->hasError('RepeatPassword') ? $validation->getError('RepeatPassword') : '&nbsp' ?> </p>
                        </div>
                    </div>
                    <div class="register">
                        <div class="input__contener flex-45">
                            <label for="" class="input__contener--text">Numer Telefonu:</label>
                            <div class="wrapper--icon">
                                <input type="tel" name="phone" autocomplete="off" pattern="{1}[0-9]{11,14}" class="input__contener--input no-arrow">
                                <i class=" icon bi bi-phone"></i>
                            </div>
                            <p class="error"><?= isset($validation) && $validation->hasError('phone') ? $validation->getError('phone') : '&nbsp' ?> </p>
                        </div>
                        <div class="input__contener flex-45">
                            <label for="" class="input__contener--text">Key:</label>
                            <div class="wrapper--icon">
                                <input type="number" name="Key" autocomplete="off" class="input__contener--input no-arrow">
                                <i class="icon bi bi-key"></i>
                                <p class="error"><?= isset($validation) && $validation->hasError('Key') ? $validation->getError('Key') : '&nbsp' ?> </p>
                            </div>
                        </div>
                    </div>
                    <div class="button__contener">
                        <button class="button_contener--btn" type="submit">Zarejestruj się</button>
                    </div>
                </div>

                <div class="contener__helper">
                    <a href="<?= base_url('/') ?>" class="contener__helper--link"><b>Powrót</b></a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->endSection() ?>