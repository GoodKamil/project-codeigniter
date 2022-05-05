<?php $this->extend('Users/dashboard') ?>

<?php $this->section('content') ?>
<?php print_r(session()->get('isNumber')) ?>

<section class="contener__account">
    <div class="contener__account--div">
        <?php if (session()->getFlashdata('successInsert')) : ?>
            <div class="success">
                <p class="seccuess-tekst">Przelew został wykonany pomyślnie </p>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('TransferBank') ?>" method="post">
            <div class="acount">
                <h2 class="account--text">Numer konta</h2>
                <div class="select--acount">
                    <select name="account_you" class="form--input" id="">
                        <?php foreach ($numberAccount as $key => $value) : ?>
                            <option value="<?= $value->id_N ?>"><?= $value->number ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="acount">
                <h2 class="account--text">Dane Odbiorcy</h2>
                <div class="contener__form">
                    <div class="form">
                        <label for="address" class="form--label">(*) Nazwa i adres</label>
                        <input type="text" class="form--input" name='address' value="<?= set_value('address', '') ?>">
                        <p class="error"><?= isset($validation) && $validation->hasError('address') ? $validation->getError('address') : '&nbsp' ?> </p>
                    </div>
                    <div class="form">
                        <label for="numberAccount" class="form--label">(*) Numer konta</label>
                        <input type="number" data-option="numberBank" class="form--input" name='numberAccount' value="<?= set_value('numberAccount', '') ?>">
                        <p data-option="errorNumber" style="visibility:hidden;" class="error">Niepoprawny numer konta</p>
                    </div>
                    <div class="form">
                        <label for="nameBank" class="form--label">(*) Nazwa banku</label>
                        <select name="nameBank" data-option="nameBank" class="form--input" id="">
                            <?php foreach ($tableBank as $key => $value) : ?>
                                <option value="<?= $key ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p class="error"><?= isset($validation) && $validation->hasError('nameBank') ? $validation->getError('nameBank') : '&nbsp' ?> </p>
                    </div>
                    <div class="form">
                        <label for="price" class="form--label">(*) Kwota</label>
                        <input type="number" step='0.1' class="form--input" name='price' value="<?= set_value('price', '0.00') ?>">
                        <p class="error"><?= isset($validation) && $validation->hasError('price') ? $validation->getError('price') : '&nbsp' ?> </p>
                    </div>
                    <div class="form">
                        <label for="description" class="form--label">Tytuł <span data-option="Title">7</span>/140</label>
                        <input type="text" data-option="transferTitle" class="form--input" name='description' value="<?= set_value('description', 'Przelew') ?>">
                        <p data-option="errorNumberTitle" style="visibility:hidden;" class="error">Maksymalna długośc tytułu wynosi 140znaków</p>
                    </div>
                    <div class="form">
                        <label for="dateOd" class="form--label">Data</label>
                        <input type="date" class="form--input" disabled name='data' value="<?= date('Y-m-d') ?>">
                        <input type="hidden" class="form--input" name='dataTransfer' value="<?= date('Y-m-d') ?>">
                        <p style="margin-bottom:0px" class="error">&nbsp</p>
                    </div>
                    <div class="form">
                        <button style="margin:1rem 0;" class="edit__buton" type="submit">Wyślij</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>


<?php $this->endSection() ?>