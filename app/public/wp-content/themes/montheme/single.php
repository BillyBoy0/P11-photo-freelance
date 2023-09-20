<?php
/**
 * Template Name: Single
 *
 * This is the template that displays a single post.
 *
 * @package montheme
 */

get_header();


if (have_posts()) :
    while (have_posts()) : the_post();
        ?>
        <div class="post">	
            <div class="post-thumbnail">       <!-- La featured image -->
                <?php the_post_thumbnail('large'); ?>  
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
endif;  


get_footer(); // Ajoutez cet appel si vous souhaitez inclure le pied de page de votre thème
?>