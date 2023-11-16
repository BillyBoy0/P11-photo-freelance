
<div class="photo-block__image">
    <?php the_post_thumbnail(); ?>

    <div class="overlay">
        <a href="<?php echo esc_url(get_permalink()); ?>" class="voir">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Icon_eye.svg" alt="Lien vers l'image">
        </a>
        <div class="link-fullscreen  rollover-fullscreen" data-lightbox-item-id="<?php echo get_the_ID();?>)">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Icon_fullscreen.png" alt="Lien vers le mode plein écran">
        </div>
        <p class="reference-photo"><?php echo get_field('reference'); ?></p>
        <?php
            $terms = wp_get_post_terms($post->ID, 'categorie');
            if (!empty($terms)) {
                $term_names = array();
                foreach ($terms as $term) {
                    $term_names[] = $term->name;
                }
                echo '<p class="categorie">' . implode(', ', $term_names) . '</p>';
            }
        ?>
    </div>
</div>