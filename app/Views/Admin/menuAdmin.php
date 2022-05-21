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
        <li class="menu--link"><i class="gg-user-list iconMenu"></i><a href="<?= base_url('viewGroup') ?>" class="menu--item">Grupy</a><span class='menu--item__span'></li>
        <li class="menu--link"><i class="gg-user-add iconMenu"></i><a href="<?= base_url('addEmployee') ?>" class="menu--item">Dodaj pracownika</a><span class='menu--item__span'></li>
        <li class="menu--link"><i class="bi iconMenu bi-box-arrow-left"></i><a href="<?= base_url('Logout') ?>" class="menu--item">Wyloguj się</a></li>
    </ul>
</div>