<?php 

// Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );






register_nav_menus( array(                          //MENUS:  enregistrement de l emplacement
	'main' => 'Menu Principal',
	'footer' => 'Bas de page',
) );



// J introduit mon scripts.js
function enqueue_custom_scripts() {
	wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/scripts.js', array(), '1.0', true);
}

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
