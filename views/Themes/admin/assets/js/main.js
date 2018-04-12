/*! =========================================================
          .o88
          "888
 .oooo.    888  .oo.    ..o88.     ooo. .oo.    .oooo`88
d88' `8b   88bP"Y88b   888P"Y88b  "888P"Y88b   888' `88b 
888        88b   888   888   888   888   888   888   888
888. .88   888   888   888   888   888   888   888. .880
 8`bo8P'  o888o o888o   8`bod8P'  o888o o888o   .oooo88o
                                                     088`
                                                    .o88
============================================================ */

var __ui = {
	anchorBucketed: function (data) {
		
		var anchor = $('<div>', {class: 'anchor ui-bucketed clearfix'});
		var avatar = $('<div>', {class: 'avatar lfloat no-avatar mrm'});
		var content = $('<div>', {class: 'content'});
		var icon = '';

		if( !data.image_url || data.image_url=='' ){

			icon = 'user';
			if( data.icon ){
				icon = data.icon;
			}
			icon = '<div class="initials"><i class="icon-'+icon+'"></i></div>';
		}
		else{
			icon = $('<img>', {
				class: 'img',
				src: data.image_url,
				alt: data.text
			});
		}

		avatar.append( icon );

		var massages = $('<div>', {class: 'massages'});

		if( data.text ){
			massages.append( $('<div>', {class: 'text fwb u-ellipsis'}).html( data.text ) );
		}

		if( data.category ){
			massages.append( $('<div>', {class: 'category'}).html( data.category ) );
		}
		
		if( data.subtext ){
			massages.append( $('<div>', {class: 'subtext'}).html( data.subtext ) );
		}

		content.append(
			  $('<div>', {class: 'spacer'})
			, massages
		);
		anchor.append( avatar, content );

        return anchor;
	},
	anchorFile: function ( data ) {
		
		if( data.type=='jpg' ){
			icon = '<div class="initials"><i class="icon-file-image-o"></i></div>';
		}
		else{
			icon = '<div class="initials"><i class="icon-file-text-o"></i></div>';
		}
		
		var anchor = $('<div>', {class: 'anchor clearfix'});
		var avatar = $('<div>', {class: 'avatar lfloat no-avatar mrm'});
		var content = $('<div>', {class: 'content'});
		var meta =  $('<div>', {class: 'subname fsm fcg'});

		if( data.emp ){
			meta.append( 'Added by ',$('<span>', {class: 'mrs'}).text( data.emp.fullname ) );
		}

		if( data.created ){
			var theDate = new Date( data.created );
			meta.append( 'on ', $('<span>', {class: 'mrs'}).text( theDate.getDate() + '/' + (theDate.getMonth()+1) + '/' + theDate.getFullYear() ) );
		}

		avatar.append( icon );

		content.append(
			  $('<div>', {class: 'spacer'})
			, $('<div>', {class: 'massages'}).append(
				  $('<div>', {class: 'fullname u-ellipsis'}).text( data.name )
				, meta
			)
		);
		anchor.append( avatar, content );

        return anchor;
	} 
}

$(document).ready(function() {

	$(window).load(function(){
		$(".navigation-trigger").click(function(e){
			e.preventDefault();
			$("body").toggleClass("is-pushed-left",!$("body").hasClass("is-pushed-left"));
			$.get( app.getUri("admin/navTrigger"), {status:$("body").hasClass("is-pushed-left")?1:0} );
		});

		if( isMobile.any() ){
			$("body").addClass('touch').removeClass('is-pushed-left');
		}		

	}), $(window).resize(function() {
	}), $(window).scroll(function() {
	}), $(window).on(function() {
	});
});