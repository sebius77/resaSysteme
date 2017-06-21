$( function() {

    // Configuration du datePicker avec les paramètres français
    $.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );

    /*
     * Affichage du calendrier DatePicker
     *  avec en date de départ, la date d'aujourd'hui
     *  Un réservation maximale sur 2 mois
     *  Les dimanches (0) et les mardis (2) désactivés
     */
    $("#datePicker").datepicker({
        minDate: 0,
        maxDate: "+2m",
        altField: "#actualDate",
        dateFormat: "dd-mm-yy",
        // Désactivation des mardis et dimanche
        beforeShowDay: function(date) {

            // A Faire : Améliorer la fonction pour qu'elle traite un tableau
            if (date.getDay() === 0 || date.getDay() === 2 || ((date.getMonth() === 4) && (date.getDate() === 1))
                || ((date.getMonth() === 10) && (date.getDate() === 1)) ||
                ((date.getDate() === 25) && (date.getMonth() === 11)))
            {
                return [false, ''];
            } else
            {
                return [true, ''];
            }
        },


        /**
         * @param date
         * Fonction qui va appeler une requête Ajax en transmettant
         * la date sélectionnée.
         * En retour nous verrons le nombre de place restante
         */
        onSelect: function(date) {
            //console.log(date);
            //$('#jourCommande').text(date);

            $('#appbundle_commande_dateReservation').val(date);

            // Ici une requ^te ajax qui tape sur l'url http://localhost/resaSysteme/web/app_dev.php/calculBillet

            /* Je n'arrive pas à taper sur le contrôleur avec ma requête Ajax erreur #14683
            * Je vais donc faire autrement
            $.ajax({
                type: 'POST',
                url: 'calculBillet',
                success: function(data) {
                    console.log(data);
                },
                error: function(xhr,statut,error) {
                    console.log('xhr : ' + xhr);
                    console.log('statut : ' + statut);
                    console.log('error : ' + error);
                }
            });
            */

        }

        }
    );

} );
