<footer class="site__footer">
		<?php wp_nav_menu( 
          array( 
            'theme_location' => 'footer', 
            'container' => 'ul', // afin d'éviter d'avoir une div autour par défaut
            'menu_class' => 'site__footer__menu', // ma classe personnalisée 
          ) 
      ); 
    ?>
</footer>

<?php wp_footer(); ?>

<?php get_template_part('template-parts/popup-contact'); ?>
<?php get_template_part('template-parts/lightbox'); ?>


</body>
</html>