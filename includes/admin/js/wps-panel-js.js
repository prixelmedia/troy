jQuery(document).ready(function($){
	 // $('#add_location').click(function(e){
		// e.preventDefault(e);
		 // $(this).parent().parent().clone().insertAfter('#add_location');
	 // });
		// var c = 0;
		// $(document).on('click', '#add_location', function(e) {
			// e.preventDefault(e);
			// var $clone = $(this).parent().parent().find('.wps-panel-field').clone();
			
				// $clone.find(('.wps_locationno')).each(function() { 
					// //var $th = $(this);
					// //alert($th.attr('id'));
					// var $th = $(this);
					// var $last_p = parseInt($th.attr('id').replace(/\D/g,""))+1;
					// var $first_p = $th.attr('id').replace(/\d+/,"");
					// $th.attr('id', $first_p + $last_p);
					// $th.attr('name', $first_p + $last_p);
					// //alert($th.attr('id'));
				// });
			// $clone.insertBefore('#wps_locationno').find( "#wps_address_head" ).parent().remove();;	
			// $('#wps_locationno').val(parseInt($('#wps_locationno').val())+1);
			// $(this).remove();
		// });
        var getActive =  $.cookie('current_page');
		if(getActive != null){        
			$('#wps-panel-sidebar li a').each(function(i, li) {         
			var product = $(this).attr('href');            
			if(product==getActive){              
				var val = product.substring(1, product.length);
				$('#wps-panel-content .wps-panel-section:first').removeClass('wps-panel-active'); 
				$('#wps-panel-content').siblings('div').find('.wps-panel-active').removeClass('wps-panel-active');
				$(this).parent().addClass('active');   
				$(this).addClass('wps-panel-active');             
				$("#"+val).addClass('wps-panel-active');      
			}      
			});        
		}else{  
			/* Assign .wps-panel-active class to the first section link and the first section content */    
			$('#wps-panel-sidebar a:first').addClass('wps-panel-active');   
			$('#wps-panel-content .wps-panel-section:first').addClass('wps-panel-active');   
		}   
			/* Handle the section change when a section link is clicked */   
		$('#wps-panel-sidebar a').click(function(e){     
			/* Prevent default behaviour */     
			e.preventDefault();             
			/* Get the section id */      
			var section_id = $(this).attr('href');     
			$.cookie('current_page', section_id, { expires: 7 });             
			/* Remove .wps-panel-active class from the previous section link and add it to the new one */   
			$('#wps-panel-sidebar .wps-panel-active').removeClass('wps-panel-active');    
			$(this).addClass('wps-panel-active');               
			/* Add .wps-panel-active class to the new section content and remove it from the previous one */  
			$('#wps-panel-content .wps-panel-section' + section_id).addClass('wps-panel-active').siblings('.wps-panel-active').removeClass('wps-panel-active');         
		});    
		var custom_uploader;
		$('.upload_image_button').click(function(e) {		
			e.preventDefault();        
			cls = $(this).parent();		
			//If the uploader object has already been created, reopen the dialog		
			if (custom_uploader) {		
				custom_uploader.open();		
				return;		
			}		
			//Extend the wp.media object
			custom_uploader = wp.media.frames.file_frame = wp.media({title: 'Choose Image', button: {text: 'Choose Image'},	multiple: false	});
			//When a file is selected, grab the URL and set it as the text field's value
			custom_uploader.on('select', function() {	
				attachment = custom_uploader.state().get('selection').first().toJSON();			
				cls.find('.upload_image').val(attachment.url);	
			});		
			//Open the uploader dialog	
			custom_uploader.open();	
		});  
		$('#wps-panel-sidebar li').click(function(){   
			$('#wps-panel-sidebar li.active').removeClass('active');
			$(this).addClass('active');          
		});
});