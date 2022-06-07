<?php $this->extend('templates/dashboard') ?>

<?php $this->section('content') ?>


<style>
    @media screen and (max-width: 800px) {
        td:nth-of-type(1):before {
            content: 'LP';
        }

        td:nth-of-type(2):before {
            content: 'Imie';
        }

        td:nth-of-type(3):before {
            content: 'Nazwisko:';
        }

        td:nth-of-type(4):before {
            content: 'Email:';
        }

        td:nth-of-type(5):before {
            content: 'Telefon:';
        }

        td:nth-of-type(6):before {
            content: 'Ostatnie połączenie:';
        }

        td:nth-of-type(7):before {
            content: 'Akcje:';
        }
    }
</style>

<section class="contener__account ">
    <div class="contener__account--div width">
        <div>
            <form action="#" id="form_get_show">
                <label id="click_labe_show" class="show__group">Pokaż pracowników</label>
                <input type="hidden" value="ShowEmployee" id='show' name='show'>
            </form>
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

        <div class="contener__table scroll--class--table ">
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
                <tbody class='table__contener-tbody' id="tableParams">
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
                                        <a class="button__action" href="<?= base_url('blockUser/' . $row->id_U . '/unlock') ?>">
                                            <button class="button__action background-block">Odblokuj</button>
                                        </a>
                                    <?php else : ?>
                                        <a class='link-width' href="<?= base_url('blockUser/' . $row->id_U . '/block') ?>">
                                            <button class=" button__action background-unlock">Zablokuj</button>
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
<script src=<?= base_url('js/ajax-search-Group.js') ?>></script>
<?php $this->endSection() ?>