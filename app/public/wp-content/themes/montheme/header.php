<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Mono&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">   
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header class="header">
    <a href="<?php echo home_url( '/' ); ?>">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo">
    </a>  

    <?php 
      wp_nav_menu( 
          array( 
            'theme_location' => 'main', 
            'container' => 'ul', // afin d'éviter d'avoir une div autour par défaut
            'menu_class' => 'site__header__menu', // ma classe personnalisée 
          ) 
      ); 
    ?>
  </header>
    
    <?php wp_body_open(); ?>