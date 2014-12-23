$(function() {
	$.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );
	$( "#datePickerDeb" ).datepicker({ dateFormat: "dd-mm-yy" });;
	$( "#datePickerFin" ).datepicker({ dateFormat: "dd-mm-yy" });;
});