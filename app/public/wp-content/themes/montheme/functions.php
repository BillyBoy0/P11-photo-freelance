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


// Pour que mes articles photos arrivent sur le template adapté

function custom_single_template($template) {
    if (is_singular('photo')) {
        $template = locate_template(array('single-photos.php'));
    }
    return $template;
}

add_filter('template_include', 'custom_single_template');




function get_reference_from_custom_fields($post_id) {
  // Obtenir la valeur de la custom field "reference"
  $reference = get_post_meta($post_id, 'reference', true);

  // Retourner la valeur de la custom field "reference"
  return $reference;
}







// Filtre Catégorie
add_action('wp_enqueue_scripts', 'ajouter_scripts');

function ajouter_scripts() {
    wp_enqueue_script('mon-script-ajax', get_template_directory_uri() . '/scripts.js', array('jquery'), '1.0', true);

    // Ici tu vas passer des données à ton script
    wp_localize_script('mon-script-ajax', 'mon_script_vars', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}

add_action('wp_ajax_filtre_photos', 'filtre_photos');
add_action('wp_ajax_nopriv_filtre_photos', 'filtre_photos');

function filtre_photos() {
    if (isset($_POST['taxonomy']) && isset($_POST['term'])) {
        $taxonomy = sanitize_text_field($_POST['taxonomy']); // Récupère la taxonomie depuis la requête et la nettoie
        $term = sanitize_text_field($_POST['term']); // Récupère le terme depuis la requête et le nettoie

        // Utilise WP_Query pour récupérer les articles en fonction de la taxonomie et du terme sélectionnés
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomy, // Taxonomie à filtrer
                    'field' => 'slug',
                    'terms' => $term, // Terme de la taxonomie à rechercher
                ),
            ),
        );

        $photo_query = new WP_Query($args);

        if ($photo_query->have_posts()) {
            while ($photo_query->have_posts()) {
                $photo_query->the_post();
                // Ici, vous pouvez afficher les articles ou faire ce que vous souhaitez avec les résultats
                get_template_part('template-parts/photo_block');
            }
            wp_reset_postdata(); // Réinitialise les données postérieures à la requête
        } else {
            echo 'Aucun article photo trouvé pour cette catégorie.'; // Ajustez le message en fonction de vos besoins
        }
    }

    // Assurez-vous d'arrêter l'exécution une fois que vous avez traité la requête
    wp_die();
}





// La fonction pour traiter les "combined_filters"
add_action('wp_ajax_combined_filters', 'combined_filters');
add_action('wp_ajax_nopriv_combined_filters', 'combined_filters');

function combined_filters() {
    $page = $_POST['page'];
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
        'paged' => $page,
    );

    if (isset($_POST['category']) && isset($_POST['format']) && isset($_POST['order'])) {
        $tax_queries = array();

        if ($_POST['category']) {
            $tax_queries[] = array(
                'taxonomy' => 'categorie',
                'field' => 'slug',
                'terms' => $_POST['category'],
            );
        }

        if ($_POST['format']) {
            $tax_queries[] = array(
                'taxonomy' => 'format',
                'field' => 'slug',
                'terms' => $_POST['format'],
            );
        }

        if ($_POST['order']) {
            $args['orderby'] = 'date';
            $args['order'] = $_POST['order'] === 'croissant' ? 'ASC' : 'DESC';
        }

        if (!empty($tax_queries)) {
            $args['tax_query'] = $tax_queries;
        }
    }

    $photo_query = new WP_Query($args);

    if ($photo_query->have_posts()) {
        while ($photo_query->have_posts()) {
            $photo_query->the_post();
            get_template_part('template-parts/photo_block');
        }
        wp_reset_postdata();
    } else {
        echo 'Aucun article photo trouvé.';
    }

    wp_die();
}




// Fonction pour charger plus de photos via Ajax
function load_more_photos() {
    $page = $_POST['page'];
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
        'paged' => $page,
    );

    if (isset($_POST['category']) && isset($_POST['format']) && isset($_POST['order'])) {
        $tax_queries = array();

        if ($_POST['category']) {
            $tax_queries[] = array(
                'taxonomy' => 'categorie',
                'field' => 'slug',
                'terms' => $_POST['category'],
            );
        }

        if ($_POST['format']) {
            $tax_queries[] = array(
                'taxonomy' => 'format',
                'field' => 'slug',
                'terms' => $_POST['format'],
            );
        }

        if ($_POST['order']) {
            $args['orderby'] = 'date';
            $args['order'] = $_POST['order'] === 'croissant' ? 'ASC' : 'DESC';
        }

        if (!empty($tax_queries)) {
            $args['tax_query'] = $tax_queries;
        }
    }

    $photo_query = new WP_Query($args);

    if ($photo_query->have_posts()) :
        while ($photo_query->have_posts()) : $photo_query->the_post();
            get_template_part('template-parts/photo_block');
        endwhile;
        wp_reset_postdata();
    else :
        echo '';
    endif;

    die();
}

// Action pour les utilisateurs connectés
add_action('wp_ajax_load_more_photos', 'load_more_photos');

// Action pour les utilisateurs non connectés
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');











