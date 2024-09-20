<?php

function sejr_og_davidsen_posttypes()
{
    register_post_type('Nyheder', array(
        'public' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'taxonomies' => array('category'),
        'has_archive' => true,
        'public' => true,
        'rewrite' => array('slug' => 'nyheder'),
        'labels' => array(
            'name' => 'Nyheder',
            'add_new_item' => 'Tilføj en ny Nyhed',
            'edit_item' => 'Rediger nyhed',
            'all_items' => 'Alle Nyheder',
            'singular_name' => 'Nyhed',
            'add_new' => 'Tilføj ny nyhed',
            'search_items' => 'Søg efter nyheder',
            'not_found' => 'Ingen nyheder fundet',
            'view_item' => 'Se nyhed'
        ),
        'menu_icon' => 'dashicons-admin-site-alt3',
    ));

    register_post_type('Hunde', array(
        'public' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'taxonomies' => array('category'),
        'labels' => array(
            'name' => 'Hunde',
            'add_new_item' => 'Tilføj en ny hund',
            'edit_item' => 'Rediger hund',
            'all_items' => 'Alle hunde',
            'singular_name' => 'Hund',
            'add_new' => 'Tilføj ny hund',
            'search_items' => 'Søg efter hunde',
            'not_found' => 'Ingen hunde fundet',
            'view_item' => 'Se hund'
        ),
        'menu_icon' => 'dashicons-pets',
    ));


    register_post_type('Racer', array(
        'public' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'taxonomies' => array('category'),
        'labels' => array(
            'name' => 'Racer',
            'add_new_item' => 'Tilføj en ny race',
            'edit_item' => 'Rediger race',
            'all_items' => 'Alle racer',
            'singular_name' => 'Race',
            'add_new' => 'Tilføj ny race',
            'search_items' => 'Søg efter racer',
            'not_found' => 'Ingen racer fundet',
            'view_item' => 'Se race'
        ),
        'menu_icon' => 'dashicons-book',
    ));
}
