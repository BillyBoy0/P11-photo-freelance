<?php get_header(); 

$args = array(
    'post_type' => 'photo', 
    'posts_per_page' => 1,
    'orderby' => 'rand' // mode aléatoire
);

$random_photo = get_posts($args);

if ($random_photo) {

	$photo_url = get_the_post_thumbnail_url($random_photo[0], 'full'); // Récupère l'URL de l'image
    echo '<div class="banner">';
    echo '<img src="' . $photo_url . '" alt="Photo aléatoire">';
    echo '<H1>PHOTOGRAPHE EVENT</H1>';
    echo '</div>';
}
?>


<?php get_footer(); ?>