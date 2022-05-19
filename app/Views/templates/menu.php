<?php if (session()->get('permissions') == 1) : ?>
    <header class="contener__header hiddenMobile">
        <nav class="menu__contener">
            <ul class="menu__contener--ul">
                <li class="menu--link"><i class="bi iconMenu bi-house-door"></i><a href="<?= base_url('HomeUser') ?>" class="menu--item">Strona główna</a></li>
                <li class="menu--link"><i class="bi iconMenu bi-bank"></i><a href="<?= base_url('Transfer') ?>" class="menu--item">Przelew</a></li>
                <li class="menu--link"><i class="bi iconMenu bi-bank"></i><a href="<?= base_url('viewHistory') ?>" class="menu--item">Historia</a></li>
                <li class="menu--link"><i class="bi iconMenu bi-envelope"></i><a href="<?= base_url('messagesUser') ?>" class="menu--item">Wiadomości</a></li>
                <li class="menu--link"><i class="bi iconMenu bi-gear"></i><a href="<?= base_url('Settings') ?>" class="menu--item">Ustawienia</a></li>
                <li class="menu--link"><i class="bi iconMenu bi-tools"></i><a href="<?= base_url('reportProblem') ?>" class="menu--item">Zgłoś problem</a></li>
                <li class="menu--link"><i class="bi iconMenu bi-box-arrow-left"></i><a href="<?= base_url('Logout') ?>" class="menu--item">Wyloguj się</a></li>
            </ul>
        </nav>
    </header>
    <div class="dropdown">
        <i class="bi bi-list barMenu ropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></i>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li class="menu--link"><i class="bi iconMenu bi-house-door"></i><a href="<?= base_url('HomeUser') ?>" class="menu--item">Strona główna</a></li>
            <li class="menu--link"><i class="bi iconMenu bi-bank"></i><a href="<?= base_url('Transfer') ?>" class="menu--item">Przelew</a></li>
            <li class="menu--link"><i class="bi iconMenu bi-bank"></i><a href="<?= base_url('viewHistory') ?>" class="menu--item">Historia</a></li>
            <li class="menu--link"><i class="bi iconMenu bi-envelope"></i><a href="<?= base_url('messagesUser') ?>" class="menu--item">Wiadomości</a></li>
            <li class="menu--link"><i class="bi iconMenu bi-gear"></i><a href="<?= base_url('Settings') ?>" class="menu--item">Ustawienia</a></li>
            <li class="menu--link"><i class="bi iconMenu bi-tools"></i><a href="<?= base_url('reportProblem') ?>" class="menu--item">Zgłoś problem</a></li>
            <li class="menu--link"><i class="bi iconMenu bi-box-arrow-left"></i><a href="<?= base_url('Logout') ?>" class="menu--item">Wyloguj się</a></li>
        </ul>
    </div>
<?php elseif (session()->get('permissions') == 5) : ?>
    <header class="contener__header  hiddenMobile">
        <nav class="menu__contener">
            <ul class="menu__contener--ul">
                <li class="menu--link"><i class="bi iconMenu bi-envelope"></i><a href="<?= base_url('messages') ?>" class="menu--item">Wiadomości</a><span class='menu--item__span'><?= WaitingNews() == 0 ? '' : WaitingNews()  ?></span></li>
                <li class="menu--link"><i class="bi iconMenu bi-box-arrow-left"></i><a href="<?= base_url('Logout') ?>" class="menu--item">Wyloguj się</a></li>
            </ul>
        </nav>
    </header>
    <div class="dropdown">
        <i class="bi bi-list barMenu ropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></i>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li class="menu--link"><i class="bi iconMenu bi-envelope"></i><a href="<?= base_url('messages') ?>" class="menu--item">Wiadomości</a><span class='menu--item__span'><?= WaitingNews() == 0 ? '' : WaitingNews()  ?></span></li>
            <li class="menu--link"><i class="bi iconMenu bi-box-arrow-left"></i><a href="<?= base_url('Logout') ?>" class="menu--item">Wyloguj się</a></li>
        </ul>
    </div>
<?php else : ?>
    <header class="contener__header  hiddenMobile">
        <nav class="menu__contener">
            <ul class="menu__contener--ul">
                <li class="menu--link"><i class="gg-user-list iconMenu"></i><a href="<?= base_url('viewGroup/ShowKlient') ?>" class="menu--item">Grupy</a><span class='menu--item__span'></li>
                <li class="menu--link"><i class="gg-user-add iconMenu"></i><a href="<?= base_url('addEmployee') ?>" class="menu--item">Dodaj pracownika</a><span class='menu--item__span'></li>
                <li class="menu--link"><i class="bi iconMenu bi-box-arrow-left"></i><a href="<?= base_url('Logout') ?>" class="menu--item">Wyloguj się</a></li>
            </ul>
        </nav>
    </header>
    <div class="dropdown">
        <i class="bi bi-list barMenu ropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></i>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li class="menu--link"><i class="gg-user-list iconMenu"></i><a href="<?= base_url('viewGroup/ShowKlient') ?>" class="menu--item">Grupy</a><span class='menu--item__span'></li>
            <li class="menu--link"><i class="gg-user-add iconMenu"></i><a href="<?= base_url('addEmployee') ?>" class="menu--item">Dodaj pracownika</a><span class='menu--item__span'></li>
            <li class="menu--link"><i class="bi iconMenu bi-box-arrow-left"></i><a href="<?= base_url('Logout') ?>" class="menu--item">Wyloguj się</a></li>
        </ul>
    </div>
<?php endif;  ?>