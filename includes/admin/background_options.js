var farbtastic;

function pickBandColor(color) {
	jQuery('#band-color').val(color);
}

jQuery(document).ready(function() {
	jQuery('#pickcolorband').click(function() {
		jQuery('#colorPickerBand').show();
		return false;
	});

	jQuery('#band-color').keyup(function() {
		var _hex = jQuery('#band-color').val(), hex = _hex;
		if ( hex[0] != '#' )
			hex = '#' + hex;
		hex = hex.replace(/[^#a-fA-F0-9]+/, '');
		if ( hex != _hex )
			jQuery('#band-color').val(hex);
		if ( hex.length == 4 || hex.length == 7 )
			pickBandColor( hex );
	});

	farbtastic = jQuery.farbtastic('#colorPickerBand', function(color) {
		pickBandColor(color);
	});
	pickBandColor(jQuery('#band-color').val());

	jQuery(document).mousedown(function(){
		jQuery('#colorPickerBand').each(function(){
			var display = jQuery(this).css('display');
			if ( display == 'block' )
				jQuery(this).fadeOut(2);
		});
	});
});




function pickGradientColor(color) {

	jQuery('#gradient-color').val(color);
	
	var backgroundColor = jQuery('#background-color').val();
	var gradientColor = color;
	
	var backgroundgradient = "";

	if( jQuery.browser.msie )
		backgroundgradient = "background-image: filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='"+gradientColor+"', endColorstr='"+backgroundColor+"' )";
	
	if( jQuery.browser.opera )
		backgroundgradient = "-o-gradient( top, bottom, from("+gradientColor+"), to("+backgroundColor+") )";

	if( jQuery.browser.mozilla )
		backgroundgradient = "-moz-linear-gradient( top, "+gradientColor+", "+backgroundColor+" )";
	
	if( jQuery.browser.webkit )
		backgroundgradient = "-webkit-gradient(linear, left top, left bottom, from("+gradientColor+"), to("+backgroundColor+") )";
	
	jQuery('#custom-background-image').css('background-image', backgroundgradient);
}

jQuery(document).ready(function() {
	jQuery('#pickcolorgradient').click(function() {
		jQuery('#colorPickerGradient').show();
		return false;
	});

	jQuery('#gradient-color').keyup(function() {
		var _hex = jQuery('#gradient-color').val(), hex = _hex;
		if ( hex[0] != '#' )
			hex = '#' + hex;
		hex = hex.replace(/[^#a-fA-F0-9]+/, '');
		if ( hex != _hex )
			jQuery('#gradient-color').val(hex);
		if ( hex.length == 4 || hex.length == 7 )
			pickGradientColor( hex );
	});

	farbtastic = jQuery.farbtastic('#colorPickerGradient', function(color) {
		pickGradientColor(color);
	});
	pickGradientColor(jQuery('#gradient-color').val());

	jQuery(document).mousedown(function(){
		jQuery('#colorPickerGradient').each(function(){
			var display = jQuery(this).css('display');
			if ( display == 'block' )
				jQuery(this).fadeOut(2);
		});
	});
});