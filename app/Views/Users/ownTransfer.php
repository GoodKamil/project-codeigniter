<?php $this->extend('templates/dashboard') ?>

<?php $this->section('content') ?>

<section class="contener__account">
    <div class="contener__account--div">
        <form action="ownTransfer" method='post'>
            <div class="acount">
                <div class="row__account change--acount">
                    <h2 class="change--acount--text">Rachunek zródłowy</h2>
                    <i class="bi bi-arrow-left-right iconChange" data-option='iconChangeAccount'></i>
                </div>
                <div class="row__account">
                    <div class="select--acount basis">
                        <input type="text" value='<?= set_value('accountOne', $numberAccount[0]->number) ?>' name='accountOne' class='form--input' data-option='NumberOne' readonly>
                        <input type="hidden" name='accountSource' value='<?= set_value('accountSource', $numberAccount[0]->id_N) ?>' data-option='NumberOneID'>
                    </div>
                    <div class="select--acount">
                        <input type="text" value='<?= set_value('priceSource', $priceOneAccount) ?>' class='form--input' name="priceSource" id='changePrice' data-option='priceOne' readonly>
                    </div>
                </div>
                <p class="error"><?= isset($validation) && $validation->hasError('priceSource') ? $validation->getError('priceSource') : '&nbsp' ?> </p>
            </div>
            <div class="acount">
                <h2 class="account--text">Rachunek docelowy</h2>
                <div class="row__account">
                    <div class="select--acount basis">
                        <input type="text" value='<?= set_value('accountTwo', $numberAccount[1]->number) ?>' class='form--input' name='accountTwo' id='changePrice' data-option='NumberTwo' readonly>
                        <input type="hidden" name='accountTarget' value='<?= set_value('accountTarget', $numberAccount[1]->id_N) ?>' data-option='NumberTwoID'>
                    </div>
                    <div class="select--acount">
                        <input type="text" value='<?= set_value('priceTarget', $priceTwoAccount) ?>' class='form--input' name="priceTarget" data-option='priceTwo' readonly>
                    </div>
                </div>
                <p class="error"><?= isset($validation) && $validation->hasError('priceTwo') ? $validation->getError('priceTwo') : '&nbsp' ?> </p>
                <div class="form">
                    <label for="description" class="form--label">Tytuł</label>
                    <input type="text" class="form--input" name='description' value="Przelew własny" readonly>
                </div>
                <p class="error">&nbsp </p>
                <div class="form">
                    <label for="price" class="form--label">(*)Kwota</label>
                    <input type="number" step='0.1' class="form--input" name='price' value="<?= set_value('price', '0.00') ?>">
                    <p class="error"><?= isset($validation) && $validation->hasError('price') ? $validation->getError('price') : '&nbsp' ?> </p>
                </div>
                <div class="form">
                    <label for="dateOd" class="form--label">Data</label>
                    <input type="date" class="form--input" name='dataTransfer' readonly value="<?= date('Y-m-d') ?>">
                    <p style="margin-bottom:0px" class="error">&nbsp</p>
                </div>
            </div>
            <div class="button_form" style="margin:4rem 0 2rem 0">
                <button class="edit__buton" formaction="<?= base_url('HomeUser') ?>" formmethod="get">Powrót</button>
                <button class="edit__buton" type="submit">Wykonaj</button>
            </div>
        </form>
    </div>
</section>
<?php $this->endSection();
