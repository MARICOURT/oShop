// home-categories-form

var app = {
    // initialisation du module
    init: function() {
        console.log('init');

        // cibler le formulaire
        var formElement = document.querySelector('#home-categories-form');
        // écouter la soumission => déclenche un handler
        formElement.addEventListener('submit', app.submitHandler);
    },
    submitHandler: function(event) {
        

        // parcourir tous les select du form pour vérifier que la valeur n'est pas vide
        var selectFieldList = document.querySelectorAll('#home-categories-form select');

        // on stocke ici chaque valeur déjà parcourue
        var previousValues = [];

        // on stocke les erreurs rencontrées
        var errors = [];

        // la fonction anonyme passée à forEach récupère l'élément courant dans un paramètre
        // équivalent en php :
        // foreach ($selectFieldList as $selectElement)
        selectFieldList.forEach(function(selectElement) {
            // récupérer la valeur contenue dans CE select
            var currentValue = selectElement.value;

            
            // si pas de valeur (ou si vide) 
            if (currentValue === "") {
                // déclencher une erreur
                console.error('Saisie obligatoire');
                errors.push('Saisie obligatoire');
            } else {
                console.log('saisie ok');
            }
            
            // vérifier qu'aucune catégorie n'est pas saisie plus d'une fois => vérifier que la valeur courante n'est pas déjà saisie
            // indexOf() sur un array renvoie la position d'un élément recherché dans cet array (ou -1 si pas présent)
            if (previousValues.indexOf(currentValue) !== -1) {
                // la valeur est déjà présente dans previousValues
                console.error('Valeur ajoutée deux fois !');
                errors.push('Valeur ajoutée deux fois !');
            } else {
                // la valeur n'a jamais été ajoutée à previousValues
                
                // ajouter cette valeur aux valeurs précédement testées
                previousValues.push(currentValue);
                console.log('valeur ok');
            }
        });

        if (errors.length > 0) {
            // on empêche la soumission du formulaire
            event.preventDefault();
        }

    }
}

// on démarre le module lorsque le DOM est chargé, pas avant
document.addEventListener('DOMContentLoaded', app.init);