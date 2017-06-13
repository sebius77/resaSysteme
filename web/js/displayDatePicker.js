
$( function() {

    $.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );
    $("#datePicker").datepicker({
        minDate: 0,
        maxDate: "+2m"
        }

    );



} );
