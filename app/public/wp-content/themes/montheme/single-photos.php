<?php
/**
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
endif; ?>


<section class="navigation-banner">
    <div class="interested-contact">
        <p>Cette photo vous intéresse ?</p>
        <button id="contact-btn">Contact</button>
    </div>
    <div class="navigation-photos">
        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" alt="">
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
    <h2>VOUS AIMEREZ AUSSI</h2>
    <div class="featured-images-list"></div>
    <button>Toutes les photos</button>
</section>




<script type="text/javascript">                //Ajoute la reference dans le formulaire automatiquement
    jQuery(document).ready(function($) {
        $("#reference").val("<?php echo get_field('reference'); ?>");
    });
</script>

<?php get_footer(); 
?>