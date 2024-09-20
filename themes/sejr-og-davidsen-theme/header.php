<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header>
        <a href="<?php echo site_url() ?>">
            <h1 class="logo">Sejr & Davidsens</h1>
            <h1 class="logo">Dyrepension og Internat</h1>
        </a>
        <nav>
            <ul>
                <li <?php if (is_page('Forside') or wp_get_post_parent_id(0) == 5) echo 'class="active-menu"' ?>><a class="hover-styling" href="<?php echo site_url() ?>">Forside</a></li>
                <li <?php if (is_page('/for-du-adoptere') or wp_get_post_parent_id(0) == 7) echo 'class="active-menu"' ?>><a class="hover-styling" href="<?php echo site_url('/for-du-adoptere') ?>">Før du adoptere</a></li>
                <div class="sub-menu-top">
                    <li <?php if (is_page('/internat-og-adoption') or wp_get_post_parent_id(0) == 9) echo 'class="active-menu"' ?>>
                        <a class="hover-styling" href="<?php echo site_url('/internat-og-adoption') ?>">Internat & Adoption</a>
                        <ul class="submenu">
                            <li><a class="hover-styling" href="<?php echo site_url('/om-adoptionsprocessen') ?>">Om adoptionsprocessen</a></li>
                            <li><a class="hover-styling" href="<?php echo site_url('/dyr-til-adoption') ?>">Dyr til adoption</a></li>
                            <li><a class="hover-styling" href="<?php echo site_url('/om-internattet') ?>">Om internattet</a></li>
                        </ul>
                    </li>
                </div>
                <li <?php if (is_page('/hunde-pension') or wp_get_post_parent_id(0) == 11) echo 'class="active-menu"' ?>><a class="hover-styling" href="<?php echo site_url('/hunde-pension') ?>">Hundepension</a></li>
                <li <?php if (is_page('/hundetraening') or wp_get_post_parent_id(0) == 13) echo 'class="active-menu"' ?>><a class="hover-styling" href="<?php echo site_url('/hundetraening') ?>">Hundetræning</a></li>
                <li><a class="hover-styling" href="#">Om Os</a></li>
                <li><a class="hover-styling" href="#">Kontakt</a></li>
            </ul>
        </nav>

        <a class="search-icon" href="#"><span class="material-symbols-outlined">search</span></a>


    </header>