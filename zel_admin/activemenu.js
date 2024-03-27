$(document).ready(function(){

$("#dashboard a:contains('Home')").parent().addClass('active');
$("#addcutomer a:contains('Add Customer')").parent().addClass('active');
$("#editcutomer a:contains('Edit Customer')").parent().addClass('active');
$("#addvehicle a:contains('Add Vehicle')").parent().addClass('active');

/*
$('ul.nav li.dropdown').hover(function(){
	$('.dropdown-menu', this).fadeIn('');
}, function(){
	$('.dropdown-menu', this).fadeOut('fast');
}); //hover */

});