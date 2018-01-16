$(document).ready(function() {
    "use strict";
// Définition des dates particulières à bloquer pour le datepicker
    var unavailableDates = ["1-5-2018", "1-11-2018", "25-12-2017", "1-5-2018", "1-11-2018", "25-12-2018", "1-5-2019", "1-11-2019", "25-12-2019"];

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
    $(".js-datepicker").datepicker({
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
        beforeShowDay: unavailable
    });
});