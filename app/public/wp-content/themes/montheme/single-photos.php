<?php
/**
 * @package montheme
 */

get_header(); ?>

<div class="degrade">
</div>


<?php
if (have_posts()) :
    while (have_posts()) : the_post();
        ?>
        <div class="post">	
            
            <div class="article-photo">
                <?php the_post_thumbnail(); ?>  
                <div class="single-fullscreen rollover-fullscreen" data-lightbox-item-id="<?php echo get_the_ID();?>)">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Icon_fullscreen.png" alt="Lien vers le mode plein écran">
                </div>
            </div>
            
			<div class="description">
				<h2><?php the_title(); ?></h2>		
				<p>Année : <?php echo get_the_date('Y'); ?></p>
				<p>Catégorie : <?php echo get_the_term_list($post->ID, 'categorie', '', ', ', ''); ?></p>
                <p>Format : <?php echo get_the_term_list($post->ID, 'format', '', ', ', ''); ?></p>
				<p>Type : <?php echo get_field('type'); ?></p>
				<p>Référence : <?php echo get_field('reference'); ?></p>
			</div>
        </div>
        <?php
    endwhile;
endif; ?>








<section class="navigation-banner">
    <div class="interested-contact">
        <p>Cette photo vous intéresse ?</p>
        <button id="contact-btn" class="bouton">Contact</button>
    </div>
    <div class="navigation-photos">
        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" class="miniature" alt="">
        <div class="arrow-navigation">
            <?php 
            $prev_post = get_previous_post();
            if (!empty($prev_post)) :            ?>
                <a href="<?php echo get_permalink($prev_post->ID); ?>" class="arrow-left" >←</a>
            <?php endif; ?>

            <?php
            $next_post = get_next_post();
            if (!empty($next_post)) :            ?>
            <a href="<?php echo get_permalink($next_post->ID); ?>" class="arrow-right" >→</a>
            <?php endif; ?>
        </div>
    </div>

</section>






<section class="featured-images">
    <h3>VOUS AIMEREZ AUSSI</h3>

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

get_template_part('template-parts/photo_block'); 

    endwhile;
    wp_reset_postdata(); // Réinitialiser les données de la boucle
else :
    echo 'Aucun article photo trouvé.';
endif;
?>
</div>



<div class="centrer-bouton">
    <a href="http://nathalie-mota.local">
        <button class="bouton charger">Toutes les photos</button>
    </a>
</div>



<script> //script des miniatures
    const miniature = document.querySelector(".miniature");

    if (<?php echo json_encode(!empty($next_post)); ?>) {
        const prochaineMiniatureURL = "<?php echo esc_url(get_the_post_thumbnail_url($next_post->ID, 'thumbnail')); ?>";

        const boutonDroit = document.querySelector(".arrow-right");

        boutonDroit.addEventListener("mouseenter", function () {  //affiche la prochaine Thumbnail
            miniature.src = prochaineMiniatureURL;
        });

        boutonDroit.addEventListener("mouseleave", function () {    //Reviens a la normal quand la souris quitte
            miniature.src = "<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>";
        });
    }

    if (<?php echo json_encode(!empty($prev_post)); ?>) {
        const prevMiniatureURL = "<?php echo esc_url(get_the_post_thumbnail_url($prev_post->ID, 'thumbnail')); ?>";

        const boutonGauche = document.querySelector(".arrow-left");

        boutonGauche.addEventListener("mouseenter", function () {
            miniature.src = prevMiniatureURL;
        });

        boutonGauche.addEventListener("mouseleave", function () {
            miniature.src = "<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>";
        });
    }
</script>


<script type="text/javascript">      //Ajoute la reference dans le formulaire automatiquement
    jQuery(document).ready(function($) {
        $("#reference").val("<?php echo get_field('reference'); ?>");
    });



    //Apparition du logo fullscreen sur l article principal
    document.addEventListener("DOMContentLoaded", function() {
    const articlePhoto = document.querySelector('.article-photo');
    const singleFullscreen = articlePhoto.querySelector('.single-fullscreen');

    articlePhoto.addEventListener('mouseenter', function() {
        singleFullscreen.style.opacity = '0.7';
    });

    articlePhoto.addEventListener('mouseleave', function() {
        singleFullscreen.style.opacity = '0';
    });
});


</script>

<?php get_footer(); 
?>