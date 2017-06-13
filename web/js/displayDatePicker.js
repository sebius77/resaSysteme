
/*
 * Affichage du calendrier DatePicker
 *  avec en date de départ, la date d'aujourd'hui
 *  Un réservation maximale sur 2 mois
 *  Les dimanches (0) et les mardis (2) désactivés
 */

$( function() {

    // get the current date

    $.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );
    $("#datePicker").datepicker({
        minDate: 0,

        // Désactivation des mardis et dimanche
        beforeShowDay: function(date) {
            if (date.getDay() === 0 || date.getDay() === 2 || ((date.getMonth() === 4) && (date.getDate() === 1))
                || ((date.getMonth() === 10) && (date.getDate() === 1)) ||
                ((date.getDate() === 25) && (date.getMonth() === 11)))
            {
                return [false, ''];
            } else
            {
                return [true, ''];
            }
        }
        }





    );

} );
