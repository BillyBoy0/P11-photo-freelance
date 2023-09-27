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

<?php get_template_part('template-parts/photo_block'); ?>



<script>
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


<script type="text/javascript">                //Ajoute la reference dans le formulaire automatiquement
    jQuery(document).ready(function($) {
        $("#reference").val("<?php echo get_field('reference'); ?>");
    });
</script>

<?php get_footer(); 
?>