<div class="photo-block">
    <?php
    // Récupère l'ID de l'article en cours
    $current_post_id = get_the_ID();

    // Récupère les termes de la taxonomie "catégorie" de l'article actuel
    $terms = wp_get_post_terms($current_post_id, 'categorie');

    // Crée un tableau vide pour stocker les IDs des termes
    $term_ids = array();

    // Ajoute les IDs des termes au tableau
    foreach ($terms as $term) {
        $term_ids[] = $term->term_id;
    }

    // Exclure l'article actuel de la requête
    $exclude_post = ($current_post_id) ? array($current_post_id) : array();

    // Paramètres de la requête
    $args = array(
        'post_type' => 'photo', // Remplace 'photo' par le nom réel de ton post type
        'posts_per_page' => 2, // Récupérer 2 articles
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie', // Remplace 'categorie' par le nom réel de ta taxonomie
                'field' => 'id',
                'terms' => $term_ids, // Utilise les IDs des termes de la taxonomie de l'article actuel
            ),
        ),
        'post__not_in' => $exclude_post, // Exclure l'article actuel
        'orderby' => 'rand', // Ordonner aléatoirement
    );

    $photo_query = new WP_Query($args);

    if ($photo_query->have_posts()) :
        while ($photo_query->have_posts()) : $photo_query->the_post();
            ?>
            <div class="photo-block__image">
                <?php the_post_thumbnail(); ?>

                <div class="overlay">
                    <a href="#" class="voir">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Icon_eye.svg" alt="Lien vers l'image">
                    </a>
                    <a href="#" class="link-fullscreen">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Icon_fullscreen.png"  alt="Lien vers le mode plein écran">
                    </a>
                    <p class="reference-photo"><?php echo get_field('reference'); ?></p>
                    <p class="categorie"><?php echo get_the_term_list($post->ID, 'categorie', '', ', ', ''); ?></p>
                </div>
            </div>
            <?php
        endwhile;
        wp_reset_postdata(); // Réinitialiser les données de la boucle
    else :
        echo 'Aucun article photo trouvé.';
    endif;
    ?>
    </div>

    <div class="centrer-bouton">
        <button class="bouton charger">Toutes les photos</button>
    </div>
