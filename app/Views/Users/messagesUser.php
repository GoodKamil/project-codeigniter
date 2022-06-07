<?php $this->extend('templates/dashboard') ?>

<?php $this->section('content') ?>


<section class="contener__account ">

    <div class="search__contener">
        <form action='#' id='form'>
            <div class="row__search">
                <div class="search-item1">
                    <label for="numberAccount" class="form--label">Data od</label>
                    <input type="date" class='form--input' name='dateOd' value=<?= set_value('dateOd', date('Y-m-d')) ?>>
                </div>
                <div class="search-item1">
                    <label for="numberAccount" class="form--label">Data do</label>
                    <input type="date" class='form--input' name='dateDo' value=<?= set_value('dateDo', date('Y-m-d')) ?>>
                </div>
                <div class="search-item1">
                    <label for="numberAccount" class="form--label">Status wiadomości</label>
                    <select name="status" class="form--input">
                        <option value="0">Wszystkie</option>
                        <?php foreach ($status as $key => $value) : ?>
                            <option <?= isset($_POST['status']) && $_POST['status'] == $key  ? 'selected' : ''  ?> value="<?= $key ?>"><?= $value ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="btn_search">
                <button class="edit__buton" id='button__search'>Pokaż</button>
            </div>
        </form>
    </div>

    <div class="contener__account--div scroll-class topSet" id='search__contener'>
        <?php foreach ($messages as $value) :
            $icon = 'bi-patch-question';
            if ($value->status === '2')
                $icon = 'bi-patch-check';
            else if ($value->status === '3')
                $icon = 'bi-patch-exclamation';

        ?>
            <a href="<?= base_url('viewMessageUser/' . $value->id_M) ?>">
                <div class=" contener__history">
                    <div class="contener__history--address">
                        <div class="icon">
                            <i class="historyIcon bi <?= $icon ?>"></i>
                        </div>
                        <div style="margin-left:1rem;">
                            <h4 class="address"><?= $value->id_E ? 'Doradca klienta ' . GetUserID($value->id_E) : '-'  ?> </h4>
                            <p class="history--text"><?= $value->title ?></p>
                        </div>
                    </div>
                    <div class="contener__history--price">
                        <p class="history--text"><?= $value->dateCreateProblems     ?></p>
                    </div>
                </div>
            </a>
        <?php endforeach;  ?>
    </div>
</section>

<script>
    $(function() {
        $('#button__search').click(function() {
            const form = $('#form').serialize();
            event.preventDefault();
            $.ajax({
                type: 'GET',
                url: `http://wsb.localhost/ajaxSearchMessages`,
                headers: "Access-Control-Allow-Origin: '*'",
                data: form,
                dataType: 'JSON',
                success: function(response) {
                    $('#search__contener').empty();

                    if (response.params.length === 0) {
                        const html = '<p class="noresult">Brak danych</p>';
                        $('#search__contener').append(html);
                        return;

                    }

                    $.each(response.params, function(index, param) {
                        let icon = 'bi-patch-question';
                        if (param.status === '2')
                            icon = 'bi-patch-check';
                        else if (param.status === '3')
                            icon = 'bi-patch-exclamation';

                        const html = `<a href="${
              'http://' + window.location.host + '/viewMessageUser/' + param.id_M}">
                     <div class=" contener__history">
                    <div class="contener__history--address">
                        <div class="icon">
                            <i class="historyIcon bi ${icon}"></i>
                        </div>
                        <div style="margin-left:1rem;">
                            <h4 class="address" id='text-user'>${GetUserID(param.id_E)}</h4>
                            <p class="history--text">${param.title}</p>
                        </div>
                    </div>
                    <div class="contener__history--price">
                        <p class="history--text">${param.dateCreateProblems}</p>
                    </div>
                </div>
                </a>
            `;

                        $('#search__contener').append(html);
                    });
                }
            });
        });
    });



    function GetUserID(idUser) {
        let Name = '-';

        if (idUser == 0)
            return Name;


        $.ajax({
            type: 'GET',
            url: `http://wsb.localhost/GetUserIDAjax`,
            headers: "Access-Control-Allow-Origin: '*'",
            data: {
                id: idUser
            },
            dataType: 'JSON',
            async: false,
            success: function(response) {
                Name = 'Doradca klienta ' + response.user;
            },
            failure: function(response) {
                Name = 'Wystąpił problem, przepraszamy za utrudnienia';
            }
        })

        return Name;
    }
</script>

<?php $this->endSection() ?>