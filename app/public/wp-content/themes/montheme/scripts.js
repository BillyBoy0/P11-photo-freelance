                            //MODALE CONTACT

document.addEventListener('DOMContentLoaded', function() {
    var overlay = document.getElementById('popup-overlay');
    var modal = document.getElementById('modale-contact');

    // Fonction pour afficher la modale
    function afficherModale() {
        overlay.style.display = 'block';
        modal.style.display = 'block';
        modal.classList.add('fadeIn');
    }

    // Fonction pour fermer la modale
    function fermerModale(e) {
        e.stopPropagation(); // Empêche la propagation de l'événement au parent (overlay)
        overlay.style.display = 'none';
        modal.style.display = 'none';
        modal.classList.remove('fadeIn');
    }

    // pour afficher la modale au clic de CONTACT
    document.getElementById('menu-item-11').addEventListener('click', afficherModale);

    // fermer la modale en cliquant sur l'overlay
    overlay.addEventListener('click', fermerModale);

    // Empêche que le clic sur le formulaire ferme la modale
    modal.addEventListener('click', function(e) {
        e.stopPropagation();
    });
});

