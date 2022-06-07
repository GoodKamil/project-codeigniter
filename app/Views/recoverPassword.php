<?php $this->extend('templates/main') ?>
<?php $this->section('content') ?>


<div class="bacground--contener">
    <div class="contener__login">
        <div class="contener__login-wrapper">
            <div class="create_account">
                <?php if (session()->getFlashdata('successSend')) : ?>
                    <div class="success">
                        <p class="seccuess-tekst"><?=session()->getFlashdata('successSend') ?></p>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('errorSend')) : ?>
                    <div class="error_contener">
                        <p class="error_contener-tekst"><?=session()->getFlashdata('errorSend') ?></p>
                    </div>
                <?php endif; ?>
                <div class="title__div">
                    <h1 class="title__div--text">Odzyskaj konto</h1>
                </div>
                <form action="<?=base_url('recoverPassword') ?>" method="post">
                    <div class="form__contener">
                        <div class="input__contener">
                            <label for="" class="input__contener--text">Email:</label>
                            <div class="wrapper--icon">
                                <input type="text" name="Email" value="<?= set_value('Email', '') ?>" class="input__contener--input">
                                <i class="icon bi bi-key"></i>
                            </div>
                            <p class="error"><?= isset($validation) && $validation->hasError('Email') ? $validation->getError('Email') : '&nbsp' ?> </p>
                        </div>
                        <div class="button__contener">
                            <button class="button_contener--btn" type="submit">Wyślij</button>
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
