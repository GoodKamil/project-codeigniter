<?php $this->extend('templates/dashboard');
      $this->section('content');
/**
 *
 *
 * @var array $numberAccount
 * @var int $priceOneAccount
 *@var array $tableBank
 *
 */

    ?>

<section class="contener__account">
    <div class="bacground--contener">
        <div class="contener__account--div">
            <?php if (session()->getFlashdata('successInsert')) : ?>
                <div class="success">
                    <p class="seccuess-tekst">Przelew został wykonany pomyślnie </p>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('TransferBank') ?>" method="post">
                <div class="acount">
                    <h2 class="account--text">Numer konta</h2>
                    <div class="row__account">
                        <div class="select--acount basis">
                            <select name="account_you" class="form--input" id="changeNumerAccount">
                                <?php foreach ($numberAccount as $key => $value) : ?>
                                    <option <?= isset($_POST['account_you']) && $_POST['account_you'] == $value->id_N  ? 'selected' : ''  ?> value="<?= $value->id_N ?>"><?= $value->number ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="select--acount">
                            <input type="text" value='<?= set_value('priceSource', $priceOneAccount) ?>' id='changePrice' name="priceSource" class='form--input' data-option='priceOne' readonly>
                        </div>
                    </div>
                    <p class="error"><?= isset($validation) && $validation->hasError('priceSource') ? $validation->getError('priceSource') : '&nbsp' ?> </p>
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
                            <p class="error"><?= isset($validation) && $validation->hasError('numberAccount') ? $validation->getError('numberAccount') : '&nbsp' ?> </p>
                        </div>
                        <div class="form">
                            <label for="nameBank" class="form--label">(*) Nazwa banku</label>
                            <select name="nameBank" data-option="nameBank" class="form--input" id="">
                                <?php foreach ($tableBank as $key => $value) : ?>
                                    <option <?= isset($_POST['nameBank']) && $_POST['nameBank'] == $key ? 'selected' : '' ?> value="<?= $key ?>"><?= $value ?></option>
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
                            <label for="description" class="form--label">Tytuł <span data-option="Title"><?= strlen(set_value('description', 'Przelew')) ?></span>/140</label>
                            <input type="text" data-option="transferTitle" class="form--input" name='description' value="<?= set_value('description', 'Przelew') ?>">
                            <p class="error"><?= isset($validation) && $validation->hasError('description') ? $validation->getError('description') : '&nbsp' ?></p>
                        </div>
                        <div class="form">
                            <label for="dateOd" class="form--label">Data</label>
                            <input type="date" class="form--input" readonly name='dataTransfer' value="<?= date('Y-m-d') ?>">
                            <p style="margin-bottom:0px" class="error">&nbsp</p>
                        </div>
                        <div class="form">
                            <button style="margin:1rem 0;" class="edit__buton" type="submit">Wyślij</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script src=<?= base_url('js/ajax.js') ?>></script>


<?php $this->endSection() ?>