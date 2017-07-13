jQuery(document).ready( function($){

 $('.hfbw_type').change( function(){
	var type = ( $('.hfbw_type:checked').val()  == 'tab' ) ? 'tab' : 'link';
	if( type == 'tab' ){
	  $('p.type-tab').show();
	  $('p.type-link').hide();
	  $('h2.tab-setting').fadeIn().next('table').fadeIn();	
	}else{
	  $('p.type-tab').hide();
	  $('p.type-link').show();	
	  $('h2.tab-setting').fadeOut().next('table').fadeOut();
	}
 })
 
 $('.hfbw_type').trigger('change');
 $('#hfbw_bgcolor, #hfbw_textcolor').wpColorPicker();	 
})