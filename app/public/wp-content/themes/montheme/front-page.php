<?php get_header(); 

$args = array(
    'post_type' => 'photo', 
    'posts_per_page' => 1,
    'orderby' => 'rand' 
);

$random_photo = get_posts($args);

if ($random_photo) {

	$photo_url = get_the_post_thumbnail_url($random_photo[0], 'full'); 
    echo '<div class="banner">';
    echo '<img src="' . $photo_url . '" alt="Bannière">';
    echo '<H1>PHOTOGRAPHE EVENT</H1>';
    echo '</div>';
}
?>





<section class="catalogue">

<div class="bloc-filtres">
    <div class="filtres-gauche">
        <div class="dropdown-list">
            <div class="selected-option" onclick="toggleClass(this)">
                <p>Catégories</p>
            </div>
            <div class="select-option-card">
                <ul>
                    <?php
                        $terms = get_terms('categorie', array(
                            'taxonomy' => 'categorie',
                        ));

                        foreach ($terms as $term) {
                            echo '<li data-taxonomy="categorie" data-term="' . $term->slug . '">' . $term->name . '</li>';
                        }
                    ?>
                </ul>

            </div>

        </div>

        <div class="dropdown-list">
            <div class="selected-option" onclick="toggleClass(this)">
                <p>Formats</p>
            </div>
            <div class="select-option-card">
                <ul>
                    <?php
                        $terms = get_terms('format', array(
                            'taxonomy' => 'format',
                        ));

                        foreach ($terms as $term) {
                            echo '<li data-taxonomy="format" data-term="' . $term->slug . '">' . $term->name . '</li>';                        
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="filtres-droite">
        <div class="dropdown-list">
            <div class="selected-option" onclick="toggleClass(this)">
                <p>Trier par</p>
            </div>
            <div class="select-option-card">
                <ul>
                    <li data-order="croissant">Ordre croissant</li>
                    <li data-order="decroissant">Ordre décroissant</li>
                </ul>
            </div>
        </div>
    </div>
</div>





<div class="photo-block">

<?php // Pagination de base

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
    ); 

    $photo_query = new WP_Query($args);

    if ($photo_query->have_posts()) :
        while ($photo_query->have_posts()) : $photo_query->the_post();
            get_template_part('template-parts/photo_block');
        endwhile;
        echo '</div>';
        wp_reset_postdata();
    else :
        echo 'Aucun article photo trouvé.';
    endif;

?>
</div>



<div class="centrer-bouton">
    <button id="load-more" class="bouton">Charger plus</button>
</div>

</section>













<script>




// event listenner sur les filtres catégorie format et date
var selectedCategory = '';
var selectedFormat = '';
var selectedOrder = '';
var page = 1;

document.addEventListener('DOMContentLoaded', function() {
    var options = document.querySelectorAll('.select-option-card ul li');
    options.forEach(function(option) {
        option.addEventListener('click', function() {
            var taxonomy = this.getAttribute('data-taxonomy');
            var term = this.getAttribute('data-term');
            var order = this.getAttribute('data-order');

            if (taxonomy === 'categorie') {
                selectedCategory = term;
            } else if (taxonomy === 'format') {
                selectedFormat = term;
            } else if (order) {
                selectedOrder = order;
            }

            sendCombinedFilters();
        });
    });

    function sendCombinedFilters() {
        jQuery.post(mon_script_vars.ajaxurl, {
            action: 'combined_filters',
            category: selectedCategory,
            format: selectedFormat,
            order: selectedOrder,
            page: page
        }, function(response) {
            $('.photo-block').html(response);
        });
    }
});










// ajoute et supprime une classe lors du clic sur les selects pour la couleur rouge
                        function toggleClass(element) {
        var dropdowns = document.querySelectorAll('.selected-option');
        dropdowns.forEach(function(dropdown) {
            if (dropdown !== element) {
                dropdown.classList.remove('select-clicked');
            }
        });
        element.classList.toggle('select-clicked');
    }

    document.addEventListener('click', function(event) {
        var dropdowns = document.querySelectorAll('.selected-option');
        dropdowns.forEach(function(dropdown) {
            if (!dropdown.contains(event.target)) {
                dropdown.classList.remove('select-clicked');
            }
        });
    });



//ouverture de la popup filtres
    $(".selected-option").click(function(event) {
    event.stopPropagation();
    $(this).next(".select-option-card").stop().fadeToggle("fast");
});

$(".select-option-card li").click(function(event) {
    var x = $(this).text();
    var selectedOption = $(this).parents(".dropdown-list").find(".selected-option p");
    selectedOption.text(x);
    $(this).addClass("selected-category").siblings().removeClass("selected-category");
    $(this).parents(".select-option-card").hide();
});

// body click to close popup.
$(document).click(function() {
    $(".select-option-card").hide();
});



// bouton loadmore sur front-page

jQuery(document).ready(function ($) {

        var currentPage = 1; 
        var loading = false;
        var $loadmoreButton = $('.bouton');
        var $photoBlock = $('.photo-block');
        var loadedPosts = []; 
        let page = 1;
        localStorage.setItem('page', JSON.stringify(page));
        $loadmoreButton.on("click", function () {
            if (!loading) {
            loading = true;
            $loadmoreButton.text('Chargement en cours...');}
            page = JSON.parse(localStorage.getItem('page'));
            page++; // Ajout de 1 à la page
            localStorage.setItem('page', JSON.stringify(page));
            $.ajax({
                type: "POST",
                url: './wp-admin/admin-ajax.php',
                dataType: "html",
                data: {
                    action: "load_more_photos",
                    page : page,
                    category: selectedCategory, 
                    format: selectedFormat,
                    order: selectedOrder,
                },
            success: function(response) {
                if (response) {
                    $photoBlock.append(response);
                    loading = false;
                    $loadmoreButton.text('Charger plus');
                } else {
                    $loadmoreButton.text('Aucune autre photo à charger');
                    $loadmoreButton.addClass('disabled');
                }
            }
        });
      });
  });





</script>

<?php get_footer(); ?>