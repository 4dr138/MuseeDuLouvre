$(document).ready(function() {
        // On récupère la balise <div> en question qui contient l'attribut « data-prototype » qui nous intéresse.
        var $container = $('div#appbundle_basket_billet');
        $('legend:nth-child(1)').remove();

        // On définit un compteur unique pour nommer les champs qu'on va ajouter dynamiquement
        var index = $container.find(':input').length;

        // On ajoute un nouveau champ à chaque clic sur le lien d'ajout.
        $('#add_billet').click(function(e) {
            addBillet($container);

            e.preventDefault(); // évite qu'un # apparaisse dans l'URL
            return false;
        });

        // On ajoute un premier champ automatiquement s'il n'en existe pas déjà un (cas d'une nouvelle annonce par exemple).
        if (index == 0) {
            addBillet($container);
        } else {
            // S'il existe déjà des billets, on ajoute un lien de suppression pour chacune d'entre elles
            $container.children('div').each(function() {
                addDeleteLink($(this));
            });
        }

        // La fonction qui ajoute un formulaire BilletType
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

            // On donne un attribut au prototype pour pouvoir le masquer au fur et à mesure
            $prototype = $prototype.attr("id","prototype"+index);

            if(index >= 1) {
                $("#prototype" + (index - 1)).hide();
            }

            // On ajoute au prototype un lien pour pouvoir supprimer le billet
            addDeleteLink($prototype);


            // On ajoute le prototype modifié à la fin de la balise <div>
            $container.append($prototype);

            // Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
            index++;
        }

        // La fonction qui ajoute un lien de suppression d'un billet
        function addDeleteLink($prototype) {
            // Création du lien
            var $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a>');

            // Ajout du lien
            $prototype.append($deleteLink);

            // Ajout du listener sur le clic du lien pour effectivement supprimer le billet
            $deleteLink.click(function(e) {
                $prototype.remove();
                index--;

                e.preventDefault(); // évite qu'un # apparaisse dans l'URL
                return false;
            });
        }
    });
