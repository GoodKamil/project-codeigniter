<?php $this->extend('Users/dashboard') ?>

<?php $this->section('content') ?>

<section class="contener__account">
    <div class="contener__account--div">
        <div class="acount">
            <h2 class="account--text">Odbiorca</h2>
            <div class="form">
                <label for="address" class="form--label">Dane odbiorcy</label>
                <input type="text" class="form--input" value="Kamil Krawczak,Rąbczyn 87A,62-106 Rąbczyn" disabled>
            </div>
            <div class="form">
                <label for="address" class="form--label">Numer rachunku</label>
                <input type="text" class="form--input" value="29 1090 1317 0000 0001 4168 7052" disabled>
            </div>
        </div>
        <div class="acount">
            <h2 class="account--text">Dane transakcji</h2>
            <div class="contener__form">
                <div class="form">
                    <label for="address" class="form--label">Tytuł</label>
                    <input type="text" class="form--input" value="Zakup potrzebny do przeżycia" disabled>
                </div>
                <div class="form">
                    <label for="address" class="form--label">Kwota</label>
                    <input type="number" class="form--input" value="213.54" disabled>
                </div>
                <div class="form">
                    <label for="address" class="form--label">Data operacji</label>
                    <input type="text" class="form--input" value="2022-16-04" disabled>
                </div>
            </div>
        </div>
        <div class="acount">
            <h2 class="account--text">Nadawca</h2>
            <div class="form">
                <label for="address" class="form--label">Dane Nadawca</label>
                <input type="text" class="form--input" value="Kamil Krawczak,Rąbczyn 87A,62-106 Rąbczyn" disabled>
            </div>
            <div class="form">
                <label for="address" class="form--label">Numer rachunku</label>
                <input type="text" class="form--input" value="85 1090 1317 0000 0321 4140 6252" disabled>
            </div>
        </div>
        <div class="form">
            <button style="margin:2rem 0;" class="edit__buton" type="submit">Pobierz PDF</button>
        </div>

    </div>
</section>


<?php $this->endSection() ?>