$(document).ready(function() {
        // On récupère la balise <div> en question qui contient l'attribut « data-prototype » qui nous intéresse.
        var $container = $('div#appbundle_basket_billet');
        $('legend:nth-child(1)').remove();
        // On récupère la position du bouton payer
        var marginSubmit = $('#submitForm').css("margin-top");

    // Gestion de l'email pour le format de la string avec REGEX
    function validateEmail(email)
    {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    $('#appbundle_basket_mail').blur(function()
    {
        $('#Validation').replaceWith("<div id = 'Validation'></div>");
        var email = $("#appbundle_basket_mail").val();
        var newBalise = $("<div id = 'Validation'></div>").insertAfter('#appbundle_basket_mail');
        if(validateEmail(email))
        {
            newBalise.html("<p>Email Correct ! </p>").css('color', 'green');
        }
        else {
            newBalise.html("<p>Format de l'email Incorrect !</p>").css('color', 'red');
        }
    });

        // On définit un compteur unique pour nommer les champs qu'on va ajouter dynamiquement
        var index = $container.find(':input').length;
        var indexMax = index;
        var $lastBillet= false;

        // On ajoute un nouveau champ à chaque clic sur le lien d'ajout.
        $('#add_billet').click(function(e) {
            var $name = $('#appbundle_basket_billet_'+(index-1)+'_name');
            var $firstname = $('#appbundle_basket_billet_'+(index-1)+'_firstname');
            var $email = $("#appbundle_basket_mail");
            var returnMail = check($email);
            if(returnMail === false) {
                return false;
            }
            var returnName = check($name);
            if(returnName === false) {
                return false;
            }
            var returnFirstName = check($firstname);
            if(returnFirstName === false){
                return false;
            }
            addBillet($container, $lastBillet);

            e.preventDefault(); // évite qu'un # apparaisse dans l'URL
            return false;
        });

        // On valide si les champs nom/prénom sont vides ou non
        function check(champ)
        {
            $('#Check').remove();
            var newBalise = $("<div id = 'Check'></div>").insertAfter(champ);
            if(champ.val() == ''){ // si le champ est vide
                newBalise.html("<p>Attention, le champ doit être complété ! </p>").css('color', 'red');
                return false;
            }
            else
            {
                return true;
            }
        }

        // On ajoute un premier champ automatiquement s'il n'en existe pas déjà un (cas d'une nouvelle annonce par exemple).
        if (index == 0) {
            addBillet($container, $lastBillet);
        } else {
            // S'il existe déjà des billets, on ajoute un lien de suppression pour chacune d'entre elles
            $container.children('div').each(function() {
                addDeleteLink($(this));
            });
        }

        // La fonction qui ajoute un formulaire BilletType
        function addBillet($container, $lastBillet) {
            // Dans le contenu de l'attribut « data-prototype », on remplace :
            // - le texte "__name__label__" qu'il contient par le label du champ
            // - le texte "__name__" qu'il contient par le numéro du champ
            var template = $container.attr('data-prototype')
                .replace(/__name__label__/g, '<hr /><li>Billet</li>')
                .replace(/__name__/g,        index)
            ;

            // On crée un objet jquery qui contient ce template
            var $prototype = $(template);

            // On donne un attribut au prototype pour pouvoir le masquer au fur et à mesure
            $prototype = $prototype.attr("id","prototype"+index);

            // On gère le bouton pour payer (submit) ainsi que l'affichage dynamique des billets l'un après l'autre
            if(index >= 1) {
                $("#prototype" + (index - 1)).hide();
                $("#appbundle_basket_payer").show();
                // $("#prototype"+ (index) + " legend").accordion();
            }
            else
            {
                $("#appbundle_basket_payer").hide();
            }

            // On ajoute un récap sur le coté
            addRecapBillet($prototype, $lastBillet);


            // On ajoute le prototype modifié à la fin de la balise <div>
            $container.append($prototype);

            // Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
            index++;
            indexMax++;
        }

    function addRecapBillet($prototype, $lastBillet) {
        if (index >= 1 && $lastBillet == false) {
            // On récupère les valeurs des champs qui nous intéressent pour la partie visible du récap
            var name = $('#appbundle_basket_billet_' + (index - 1) + '_name').val();
            var firstname = $('#appbundle_basket_billet_' + (index - 1) + '_firstname').val();
            var type = $('#appbundle_basket_type option:selected').text();
            var datereservation = $('#appbundle_basket_date').val();

            // On vérifie si la checkbox tarif réduit est bien cochée ou non
            var tarifreduit = $('#appbundle_basket_billet_' + (index - 1) + '_discount');
            var country = $('#appbundle_basket_billet_' + (index - 1) + '_country option:selected').text();
            // On calcule l'âge en fonction de la date choisie dans le billet
            var day = $('#appbundle_basket_billet_' + (index - 1) + '_birthdate_day option:selected').val();
            var month = $('#appbundle_basket_billet_' + (index - 1) + '_birthdate_month option:selected').val();
            var year = $('#appbundle_basket_billet_' + (index - 1) + '_birthdate_year option:selected').val();
            month = month - 1;
            var date = new Date(year, month, day);

            // On convertit la date dans un format string pour l'utiliser lors de la modification du billet
            var textdate = formatDate(date);
            var today = new Date();
            var age = Math.floor((today - date) / (365.25 * 24 * 60 * 60 * 1000));

            // Détermination du tarif en fonction de l'age
            var tarif = "";
            if (tarifreduit.is(':checked') && age < 4) {
                tarif = "bebe";
            }
            else if (tarifreduit.is(':checked') && age >= 4 && age < 12)
            {
                tarif = "enfant";
            }
            else if (tarifreduit.is(':checked'))
            {
                tarif = "reduit";
            }
            else if (age >= 4 && age < 12) {
                tarif = "enfant";
            }
            else if (age >= 60) {
                tarif = "senior";
            }
            else if (age < 4) {
                tarif = "bebe";
            }
            else {
                tarif = "normal";
            }


            // On gère le placement du bouton payer
            marginSubmit = marginSubmit.slice(0, (marginSubmit.length - 2));
            marginSubmit = marginSubmit * 1 + (75 * 1);
            marginSubmit = marginSubmit + "px";
            $("#submitForm").css("margin-top", marginSubmit);

            // Placement des différents éléments dans le bloc récap
            $("#titreResa").append("<div id ='resaBillet'></div>");

            getPrice(index, name, firstname, datereservation, type, tarif);
        }
    }

    function getPrice(index,name,firstname,datereservation,type,tarif)
    {
        //debugger;
        var url = Routing.generate('price', {tarif: tarif});
        $.ajax({
            url: url,
            data: tarif,
            type: 'POST',
            success: function(data){
                $("#resaBillet").append("<p class = 'recapBillet"+index+"'><strong>- "+name+" "+firstname+"</strong><br />"+datereservation+" - Tarif "+type+" - <strong>"+data+" €</strong><br />");
                $("#resaBillet").append("<input type = 'hidden' value = '" + data + "' id = 'tarifindex_"+ index +"' />");
                validationBasket(data, index);
                deleteBillet(index,data);

            },
            error: function(data){
                alert('No data');
            }
        });
    }

    function validationBasket(data, index){
        $("#totalPrice").remove();
        if(index == 1) {
            var totalTTC = data;
        }
        else
        {
            var oldValue =  $("#totalPrice").val();
            totalTTC = oldValue * 1 + data * 1;
        }
        var totalTVA = totalTTC - (totalTTC * 0.8);
        totalTVA = totalTVA.toFixed(2);
        var totalHT = totalTTC * 1 - totalTVA * 1;

        //Récap Prix
        var $recapPrice = $("<div id = 'totalPrice'><p>Total HT : "+totalHT+"€<br />TVA : "+totalTVA+"€<br />Total TTC : "+totalTTC+"€</p></div>");
        // On récupère la value du HT pour pouvoir le gérer après
        $("body").append("<input type='hidden' id='htPrice' value=  />");
        $("#htPrice").attr({value: totalHT});
        $("body").append("<input type='hidden' id='totalPrice' value=  />");
        $("#totalPrice").attr({value: totalTTC});

        $("#titreResa").append($recapPrice);
    }

    // La fonction qui ajoute un lien de suppression d'un billet
    function deleteBillet(index, data) {
        // Création du lien
        var $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a><br />');
        // Ajout du lien
        $(".recapBillet"+index+"").append($deleteLink);

        // Ajout du listener sur le clic du lien pour effectivement supprimer le billet
        $deleteLink.click(function(e) {
            // On supprime le billet et le récap
            $('#prototype'+(index-1)).remove();
            $("#totalPrice").remove();
            $(".recapBillet"+index+"").remove();
            var total = $("#htPrice").val();
            var totalHT = total * 1 - data * 1;
            $("#htPrice").attr({value: totalHT});
            var totalTVA = totalHT * 0.2;
            totalTVA = totalTVA.toFixed(2);
            var totalTTC = totalHT * 1 + totalTVA * 1;

            //Récap Prix
            var $recapPrice = $("<div id = 'totalPrice'><p>Total HT : "+totalHT+"€<br />TVA : "+totalTVA+"€<br />Total TTC : "+totalTTC+"€</p></div>");
            $("#titreResa").append($recapPrice);

            $("body").append("<input type='hidden' id='totalPrice' value=  />");
            $("#totalPrice").attr({value: totalTTC});

            // On gère le placement du bouton payer
            marginSubmit = marginSubmit.slice(0, (marginSubmit.length - 2));
            marginSubmit = marginSubmit * 1  - (75 * 1);
            marginSubmit = marginSubmit + "px";
            $("#submitForm").css("margin-top", marginSubmit);

            index--;
            // évite qu'un # apparaisse dans l'URL
            e.preventDefault();
            return false;
        });

    }
    // Fonction qui permet de formater la date
    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year, month, day].join('-');
    }

 // On gère la partie Disabled au clic du payer pour ne pas bloquer la transmission de données
    $("#submitForm").click(function(e){
        $('#appbundle_basket_type').prop('disabled', false);
        $("#prototype"+(indexMax-1)).remove();
    });

});

