<?php $this->extend('templates/dashboard') ?>

<?php $this->section('content') ?>


<section class="contener__account ">
    <div class="contener__account--div width">
        <div>
            <a class="show__group" href="<?= base_url('viewGroup/' . $show) ?>">
                <p style="margin:1.5rem 0;"><?= $show == 'ShowKlient' ? 'Pokaż klientów' : 'Pokaż pracowników'  ?></p>
            </a>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    "scrollX": false,
                    "pageLength": 10,
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.10.22/i18n/Polish.json'
                    }
                });
            });
        </script>

        <div class="contener__table">
            <table class="table__contener" id="dataTable">
                <thead class='table__contener-thead'>
                    <tr class='thead--tr'>
                        <th>LP.</th>
                        <th>Imie</th>
                        <th>Nazwisko</th>
                        <th>Email</th>
                        <th>Telefon</th>
                        <th>Ostatnie połączenie</th>
                        <th style="text-align:center">Akcje</th>
                    </tr>
                </thead>
                <tbody class='table__contener-tbody'>
                    <?php $x = 0;
                    foreach ($result as $row) : ?>
                        <tr class='tbody--tr'>
                            <td><?= ++$x ?></td>
                            <td><?= $row->FirstName ?></td>
                            <td><?= $row->LastName ?></td>
                            <td><?= $row->NumberPhone ?></td>
                            <td><?= $row->Email  ?></td>
                            <td><?= $row->LastConnect  ?></td>
                            <td>
                                <div class="contener--action">
                                    <button class="button__action">Edytuj</button>
                                    <?php if ($row->block == '1') : ?>
                                        <a href="<?= base_url('blockUser/' . $row->id_U . '/unlock') ?>">
                                            <button class="button__action background-block">Odblokuj</button>
                                        </a>
                                    <?php else : ?>
                                        <a href="<?= base_url('blockUser/' . $row->id_U . '/block') ?>">
                                            <button class=" button__action background-Noblock">Zablokuj</button>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php $this->endSection() ?>