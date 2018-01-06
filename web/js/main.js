$(document).ready(function() {
    "use strict";
// Définition des dates particulières à bloquer pour le datepicker
var unavailableDates = ["1-5-2018", "1-11-2018", "25-12-2017","1-5-2018", "1-11-2018", "25-12-2018","1-5-2019", "1-11-2019", "25-12-2019"];

function disabledays(date) {
    var day = date.getDay();
    return [(day != 2 && day != 0)];
}


function unavailable(date) {
    var dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
    if ($.inArray(dmy, unavailableDates) >= 0) {
        return [false, "", "Unavailable"];
    } else {
        return disabledays(date);
    }
}


//     // Initialisation du DatePicker
    $( ".js-datepicker" ).datepicker({
        firstDay: 1,
        minDate: new Date(),
        altField: "#datepicker",
        closeText: 'Fermer',
        prevText: 'Précédent',
        nextText: 'Suivant',
        currentText: 'Aujourd\'hui',
        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
        dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
        weekHeader: 'Sem.',
        dateFormat: 'dd/mm/yy',
        beforeShowDay : unavailable
    });

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
    // On récupère la balise <div> en question qui contient l'attribut « data-prototype » qui nous intéresse.
    var $container = $('div#appbundle_basket_billet');
    $('legend:nth-child(1)').hide();

    // On définit un compteur unique pour nommer les champs qu'on va ajouter dynamiquement
    var index = $container.find(':input').length;

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



    // La fonction qui ajoute un formulaire CategoryType
    function addBillet($container) {

        // Dans le contenu de l'attribut « data-prototype », on remplace :
        // - le texte "__name__label__" qu'il contient par le label du champ
        // - le texte "__name__" qu'il contient par le numéro du champ
        var template = $container.attr('data-prototype')
            .replace(/__name__label__/g, '<li>Billet n°' + (index+1) + '</li>')
            .replace(/__name__/g,        index)
        ;
        // On crée un objet jquery qui contient ce template
        var $prototype = $(template);

        // On ajoute au prototype un lien pour pouvoir supprimer le billet
        // addDeleteLink($prototype);

        // On ajoute le prototype modifié à la fin de la balise <div>
        $container.prepend($prototype);

        // On conditionne le fait que les formulaires se masquent l'un après l'autre
        if(index !== 0) {
            $('.formBillet').hide();

            $('#appbundle_basket_billet_'+index).show();
            $("li").hide();
            $("li").eq(0).show();
            $("li").eq(1).show();
            addRecapBillet($prototype);
            $("li").eq(2).replaceWith($("#add_billet"));
        }

        // Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
        index++;
    }

    // On ajoute un nouveau champ à chaque clic sur le lien d'ajout.
    $('#add_billet').click(function(e){
        var $name = $('#appbundle_basket_billet_'+(index-1)+'_name');
        var $firstname = $('#appbundle_basket_billet_'+(index-1)+'_firstname');
        var $email = $("#appbundle_basket_mail").val();
        // var returnMail = check($email);
        // if(returnMail === false) {
        //     return false;
        // }
        // var returnName = check($name);
        // if(returnName === false) {
        //     return false;
        // }
        // var returnFirstName = check($firstname);
        // if(returnFirstName === false){
        //     return false;
        // }


        // On conditionne le nombre de billets à ajouter par la valeur du select associé
        var select = $('#appbundle_basket_nbbillets option:selected').val();
        if(index > select)
        {
            alert('Vous avez précisé ne vouloir que ' + select + ' billet(s), veuillez revoir votre commande si vous voulez en ajouter plus ! ');
        }
        else {
            addBillet($container);
            e.preventDefault(); // évite qu'un # apparaisse dans l'URL
            return false;
        }
    });

    // On ajoute un premier champ automatiquement s'il n'en existe pas déjà un (cas d'un nouveau billet par exemple).
    if (index == 0) {
        addBillet($container);
    }
    else {
        // S'il existe déjà des billets, on ajoute un lien de suppression pour chacune d'entre elles
        $container.children('div').each(function() {
            // addDeleteLink($(this));

        });
    }

    // La fonction qui ajoute un lien de suppression d'un billet
    function deleteBillet(index) {

        // Création du lien
        var $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a><br />');

        // Ajout du lien
        $(".recapBillet"+index+"").append($deleteLink);

        // Ajout du listener sur le clic du lien pour effectivement supprimer le billet
        $deleteLink.click(function(e) {
            $(".recapBillet"+index+"").remove();

            e.preventDefault(); // évite qu'un # apparaisse dans l'URL
            return false;
        })
    }

    function modifBillet()
    {
      alert('hello');
    }
    function changeBillet(index, name, firstname, textdate, country, tarifreduit) {
        var $changeLink = $('<a href = "#" class = "btn btn-modif">Modifier ce billet</a>');

        $(".recapBillet"+index+"").append($changeLink);
        $changeLink.click(function(e){
          var popup = window.open('../../app/Reources/views/modifBillet/modifBillet.html.twig', 'popup', 'height=200, width=600');
          // popup.document.write('<form>');
          // popup.document.write('<div id = "formName">Votre nom : <input type = "text" value = '+name+' /><br /></div>');
          // popup.document.write('<div id = "formFirstName">Votre prénom : <input type = "text" value = '+firstname+' /><br /></div>');
          // popup.document.write('<div id = "formBirthDate">Votre date de naissance : <input type = "date" value = '+textdate+' /><br /></div>');
          // popup.document.write('<div id = "formCountry">Votre pays de résidence : <select name = "country"><option value = '+country+'>'+country+'</option><option value = "Angleterre">Angleterre</option></select><br /></div>');
          // popup.document.write('<div id = "formCheckTarif">Tarif réduit ? : <input type = "checkbox" '+tarifreduit+' /><br /></div>');
          // popup.document.write('<div id = "formSubmit"><input type = "button" onclick = "modifBillet()" value = "Modifier"/></div>');
          // popup.document.write('<div id = "formClose"><input type = "button" value = "Annuler" onclick = window.close() /></div>');
          // popup.document.write('</form>');
          // popup.document.write('<script src = "main.js"></script>');
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

    function validationBasket(data, index){

        $("#validationPanier").remove();
        $("#totalPrice").remove();

        // var ht = 0;
        // var totalHT = calculHT(ht, data);
        if(index == 1){
            var totalHT = data;
        }
        else{
            var oldData = $("#htPrice");
            console.log(oldData);
            console.log(oldData.val());
            // var totalHT = data * 1 + oldData * 1;
        }

        var totalTVA = totalHT * 0.2;
        totalTVA = totalTVA.toFixed(2);
        var totalTTC = totalHT * 1 + totalTVA * 1;


        //Récap Prix
        var $recapPrice = $("<div id = 'totalPrice'><p>Total HT : "+totalHT+"€<br />TVA : "+totalTVA+"€<br />Total TTC : "+totalTTC+"€</p></div>");
        // Création du lien
        var $validPanier = $('<div id="validationPanier"><br />Payer</div>');
        // On récupère la value du HT pour pouvoir le gérer après dans la boucle quand l'index sera supérieur à 1
        var $htValue = $("<input type = 'number' id = 'htPrice' value = "+totalHT+" />");

        $("#titreResa").append($recapPrice);
        // Ajout du lien
        $("#titreResa").append($validPanier);

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
                $("#resaBillet").append("<p class = 'recapBillet"+index+"'>Billet n°"+index+" - <strong>"+name+" "+firstname+"</strong><br />"+datereservation+" - Tarif "+type+" - <strong>"+data+" € HT</strong><br />");
                deleteBillet(index);
                validationBasket(data, index);
            },
            error: function(data){
                alert('No data');
            }
          });
        }

        function addRecapBillet($prototype){
          // On récupère les valeurs des champs qui nous intéressent pour la partie visible du récap
          var name = $('#appbundle_basket_billet_'+(index-1)+'_name').val();
          var firstname = $('#appbundle_basket_billet_'+(index-1)+'_firstname').val();
          var type = $('#appbundle_basket_type option:selected').text();
          var datereservation = $('#appbundle_basket_date').val();

          // On vérifie si la checkbox tarif réduit est bien cochée ou non
          var tarifreduit = $('#appbundle_basket_billet_'+(index-1)+'_discount');
            if(tarifreduit.is(':checked'))
            {
              tarifreduit = 'checked';
            }


          var country = $('#appbundle_basket_billet_'+(index-1)+'_country option:selected').text();
          // On calcule l'âge en fonction de la date choisie dans le billet
          var day = $('#appbundle_basket_billet_'+(index-1)+'_birthdate_day option:selected').val();
          var month = $('#appbundle_basket_billet_'+(index-1)+'_birthdate_month option:selected').val();
          var year = $('#appbundle_basket_billet_'+(index-1)+'_birthdate_year option:selected').val();
          month = month - 1;
          var date = new Date(year,month,day);

          // On convertit la date dans un format string pour l'utiliser lors de la modification du billet
          var textdate = formatDate(date);
          var today = new Date();
          var age = Math.floor((today-date) / (365.25 * 24 * 60 * 60 * 1000));


          // Détermination du tarif en fonction de l'age
            var tarif = "";
          if(age < 4)
            {
              tarif = "bebe";
            }
          else if (age >= 4 && age < 12)
            {
              tarif = "enfant";
            }
          else if (age >= 60)
            {
              tarif = "senior";
            }
          else if (age && tarifreduit.is(':checked'))
            {
              tarif = "reduit";
            }
          else
            {
              tarif = "normal";
            }

          // On se sert de l'élément récupéré pour faire notre calcul de tarif
          $("<input type = 'number' id = 'htPrice' value =  />");
          // Placement des différents éléments dans le bloc récap
          $("#titreResa").append("<div id ='resaBillet'></div>");
          getPrice(index,name,firstname,datereservation,type,tarif);
          changeBillet(index, name, firstname, textdate, country, tarifreduit);
          // $("#resaBillet").append(changeBillet($(".recapBillet")));
        }

    });
