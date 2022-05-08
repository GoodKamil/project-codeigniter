<?php $this->extend('templates/dashboard') ?>

<?php $this->section('content') ?>

<section class="contener__account">
    <div class="contener__account--div">
        <?php if (session()->getFlashdata('errorUpdate')) : ?>
            <div class="error_contener">
                <p class="error_contener-tekst">Wystąpił problem przy edytowaniu konta</p>
            </div>
        <?php endif; ?>
        <div>
            <div class="title__div">
                <h1 class="title__div--text">Edytuj konto</h1>
            </div>
            <form action="<?= base_url('editUser') ?>" method="post">
                <div class="form__contener">
                    <div class="register__input">
                        <div class="input__contener">
                            <label for="" class="input__contener--text">Email:</label>
                            <div class="wrapper--icon">
                                <input type="email" name="email" autocomplete="off" value="<?= set_value('email', $user[0]->Email) ?>" class="input__contener--input">
                                <i class="icon bi-at"></i>
                            </div>
                            <p class="error"><?= isset($validation) && $validation->hasError('email') ? $validation->getError('email') : '&nbsp' ?> </p>
                        </div>
                    </div>
                    <div class="register">
                        <div class="input__contener flex-45">
                            <label for="" class="input__contener--text">Imię:</label>
                            <div class="wrapper--icon">
                                <input type="text" name="firstname" autocomplete="off" value="<?= set_value('firstname', $user[0]->FirstName) ?>" class="input__contener--input">
                                <i class="icon bi bi-person"></i>
                            </div>
                            <p class="error"><?= isset($validation) && $validation->hasError('firstname') ? $validation->getError('firstname') : '&nbsp' ?> </p>
                        </div>
                        <div class="input__contener flex-45">
                            <label for="" class="input__contener--text">Nazwisko:</label>
                            <div class="wrapper--icon">
                                <input type="text" name="lastname" autocomplete="off" value="<?= set_value('lastname', $user[0]->LastName) ?>" class="input__contener--input">
                                <i class="icon bi bi-person"></i>
                            </div>
                            <p class="error"><?= isset($validation) && $validation->hasError('lastname') ? $validation->getError('lastname') : '&nbsp' ?> </p>
                        </div>
                    </div>
                    <div class="register">
                        <div class="input__contener flex-45">
                            <label for="" class="input__contener--text">Hasło:</label>
                            <div class="wrapper--icon">
                                <input type="text" name="password" class="input__contener--input" disabled value="********">
                                <i class="icon  bi bi-lock"></i>
                            </div>
                            <p class="error"> &nbsp; </p>
                        </div>
                        <div class="input__contener flex-45">
                            <label for="" class="input__contener--text">Powtórz hasło:</label>
                            <div class="wrapper--icon">
                                <input type="text" name="RepeatPassword" class="input__contener--input" disabled value="********">
                                <i class="icon  bi bi-lock"></i>
                            </div>
                            <p class="error"> &nbsp;</p>
                        </div>
                    </div>
                    <div class="register">
                        <div class="input__contener flex-45">
                            <label for="" class="input__contener--text">Numer Telefonu:</label>
                            <div class="wrapper--icon">
                                <input type="tel" name="phone" autocomplete="off" value="<?= set_value('phone', $user[0]->NumberPhone) ?>" pattern="{1}[0-9]{11,14}" class="input__contener--input no-arrow">
                                <i class=" icon bi bi-phone"></i>
                            </div>
                            <p class="error"><?= isset($validation) && $validation->hasError('phone') ? $validation->getError('phone') : '&nbsp' ?> </p>
                        </div>
                        <div class="input__contener flex-45">
                            <label for="" class="input__contener--text">Key:</label>
                            <div class="wrapper--icon">
                                <input type="text" name="Key" disabled value="********" class="input__contener--input no-arrow">
                                <i class="icon bi bi-key"></i>
                            </div>
                            <p class="error">&nbsp; </p>
                        </div>
                    </div>
                    <div class="button__contener">
                        <button class="button_contener--btn" type="submit">Edytuj</button>
                    </div>
                </div>

                <div class="contener__helper">
                    <a href="<?= base_url('Settings') ?>" class="return--link"><b>Powrót</b></a>
                </div>
            </form>
        </div>
    </div>
</section>

<?php $this->endSection() ?>