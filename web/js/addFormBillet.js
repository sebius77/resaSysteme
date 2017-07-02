$(document).ready(function() {
        // On récupère la balise <div> en question qui contient l'attribut « data-prototype » qui nous intéresse.
        var $container = $('div#commande_billet_billets');

        // On définit un compteur unique pour nommer les champs qu'on va ajouter dynamiquement
        var index = $container.find(':input').length;

        // La fonction qui ajoute un formulaire CategoryType
        function addBillet($container) {
            // Dans le contenu de l'attribut « data-prototype », on remplace :
            // - le texte "__name__label__" qu'il contient par le label du champ
            // - le texte "__name__" qu'il contient par le numéro du champ
            var template = $container.attr('data-prototype')
                .replace(/__name__label__/g, 'Billet n°' + (index+1))
                .replace(/__name__/g,        index)
            ;


            // On crée un objet jquery qui contient ce template
            var $prototype = $(template);

            // On ajoute le prototype modifié à la fin de la balise <div>
            $container.append($prototype);

            // Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
            index++;
        }

        var nbreBillet = $('#formBillets').attr('nbre');

        // En fonction du nombre de billet on ajoute le ou les formulaires
        for(var i = 1 ; i<= nbreBillet; i++)
        {
            addBillet($container);
        }

});