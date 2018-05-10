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

function setElem__PropertyItem( data ) {
	// console.log( data.facilities );

	// Title 
	var $Title = $('<div>', {class: 'property-item__section'}).append(
		  $('<h1>', {class: 'property-item__title'}).append( $('<span>').text( data.type_name ) , ' in ', $('<span>').text( data.zone_name ) )
		, $('<div>', {class: 'property-item__code'}).append( $('<span>', {class: 'fwb'}).text('Code:') , ' ', $('<strong>', {class: 'color-blue code'}).text( data.code ) )
	);


	// Facility
	var $Facility = $('<div>', {class: 'property-item__section'}).append(
		  $('<label>', {class: 'property-item__title'}).text( 'Facility:' )
		, $('<p>').text( '-' )
	);

	// Room Amenities
	var $Amenities = $('<div>', {class: 'property-item__section'}).append(
		  $('<label>', {class: 'property-item__title'}).text( 'Room Amenities:' )
		, $('<p>').text( '-' )
	);

	// Sale Point
	var $SalePoint = $('<div>', {class: 'property-item__section'}).append(
		  $('<label>', {class: 'property-item__title'}).text( 'Sale Point:' )
		, $('<p>').text( '-' )
	);

	// Create & Last Update
	var $Create = $('<div>', {class: ''}).append(
		  $('<p>', {class: ''}).append( 'Create: ', data.created_str )
		, $('<p>', {class: ''}).append( 'Last Update: ', data.updated_str )
		, $('<div>', {class: 'property-item__alert uiBoxYellow lastCall'}).append( 
			  $('<strong>').text( 'Last call: ' )
			, $('<span>').text( data.lastCall_str )
		)
	);

	// Room data
	var $Room = $('<div>', {class: 'property-item__section'}).append(
		  $('<h2>', {class: 'property-item__name color-blue'}).text( data.building_name )
		, $('<div>').text( '' )
	);

	// status
	var $Status = $('<div>', {class: 'property-item__status'});
	if( data.property_for.forrent ){
		$Status.append( $('<div>', {class: 'status forrent', text: 'For Rent'}) );
	}

	if( data.property_for.forsale ){
		$Status.append( $('<div>', {class: 'status forsale', text: 'For Sale'}) );
	}

	// Picture
	var $Picture = $('<div>', {class: 'property-item__section'}).append(
		  $('<div>', {class: 'property-item__pic'})
		, $Status
	);


	// available_date
	/*$LastCall = $('<div>', {class: 'property-item__section'}).append(
		
	);*/

	// Room Details
	var UL = $('<ul>', {class: 'property-item__list'});
	$.each([
		  {key: 'bRoom_str', addClass: 'color-red fwb',}
		, {label: 'Price for Rent:', key: 'price_str', addClass: 'color-blue fwb', 'unit': '฿/Month'}
		, {label: 'Living Area:', key: 'livingArea_str', 'unit': 'Sqm.'}
		, {label: 'Land Area:', key: 'landArea_str', 'unit': 'Sqm.'}
		// , {label: 'Living Area:', key: ''}
		, {label: 'Available:', key: 'available_str', addClass: 'color-red'}
	], function(i, obj) {

		if( data[ obj.key ] ){
			UL.append( $('<li>').addClass( obj.addClass ? obj.addClass : '' ).append( 
				(obj.label ? $('<label>').text( obj.label ): '')
				, ' '
				,  $('<span>', {class: ''}).text( data[ obj.key ] ) 
				, ( obj.unit ? $('<span>', {class: 'mls unit'}).text( obj.unit ): '' )
			) ); 
		}
	});
	var $RoomDetails = $('<div>', {class: 'property-item__section'}).append( UL );


	// Contact
	var $Contact = $('<div>', {class: 'property-item__section'}).append(
		$('<label>', {class: 'property-item__label color-blue'}).text( 'Contact:' )
	);

	// Owner
	var $Owner = $('<div>', {class: 'property-item__section'}).append(
		$('<label>', {class: 'property-item__label color-green'}).text('Owner:')
	);

	if( data.owner_id ){

		var ul = $('<ul>', {class: 'property-item__list list-splice'});
		$.each([
			  {key: 'owner_name', addClass: 'fwb'}
			, {icon: 'mobile', key: 'owner_mobile'}
			, {icon: 'phone', key: 'owner_phone'}
			, {icon: 'envelope-o', key: 'owner_email'}
			, {icon: 'line', key: 'owner_socialLine'}
		], function(i, obj) {

			if( data[ obj.key ] ){
				ul.append( $('<li>').append( 
					  ( obj.icon ? $('<i>', {class: 'fa'}).addClass( 'fa-' + obj.icon ): '')
					, ( obj.label ? $('<label>', {class: 'mrs'}).text( obj.label ): '')
					, $('<span>', {class: 'mrs'}).addClass( obj.addClass ).text( data[ obj.key ] )

				) );
			}
		});


		$Owner.append( $('<div>', {class: 'property-item__person'}).append( ul ) );
	}
	else{
		$Owner.addClass('has-notdata').append( $('<span>', {class: 'property-item__notdata'}).text( '-' ) )
	}

	// data other
	var UL = $('<ul>', {class: 'property-item__list'});
	var LI = [
		  {label: 'Phone office:', key: 'building_phone'}
		, {label: 'Commission:', key: ''}
		, {label: 'Address:', key: ''}
		, {label: 'Embassy:', key: ''}
		, {label: 'Permissions:', key: ''}
		, {label: 'Furnished:', key: ''}
		, {label: 'Contract Type:', key: 'available_str'}
	];
	for (var i = 0; i < LI.length; i++) {
		UL.append( $('<li>').append( (LI[i].label ? $('<label>', {class: 'fwb'}).text( LI[i].label ): ''), ' ',  $('<span>').text( data[ LI[i].key ] ) ) ); 
	}
	var $Other = $('<div>', {class: 'property-item__section'}).append( UL );


	// help Icon
	var $HelpIcon = $('<nav>', {class: 'property-item__helpIcon'});
	var LI = [
		  /*'/css/img/icon-dog-allow.png'
		, '/css/img/icon-cat-allow.png'
		, '/css/img/icon-dog-not-allow.png'
		, '/web/assets/images/icon-dog-allow.png'*/
		/*, 'icon-cat-allow.png'
		, 'icon-no-map.png'
		, 'icon-dog-not-allow.png'
		, 'icon-cat-not-allow.png'
		, 'icon-globe.png'
		, 'icon-flame.png'*/
	];


	for (var i = 0; i < LI.length; i++) {
		$HelpIcon.append( $('<span>', {class: 'icon'}).html( $('<img>', {src: LI[i] }) ) ); 
	}
	
	var $table = $('<div>', {class: 'property-item__table'});
	$table.append(
		  $('<div>', {class: 'property-item__cell'}).append( $Title, $Facility, $Amenities )
		, $('<div>', {class: 'property-item__cell'}).append( $Room, $Picture, $RoomDetails )
		, $('<div>', {class: 'property-item__cell'}).append( $Contact, $Owner, $Other )
	);

	data.property_comment = $.trim( data.property_comment );

	var $footer = $('<div>', {class: 'property-item__footer clearfix'}).append(
		  $('<div>', {class: 'lfloat mrl'}).append( $Create )
		, $('<div>', {class: 'lfloat mrl'}).append( $HelpIcon )
		, $('<div>', {class: 'property-item__note'}).append(
			  $('<label>', {class: 'property-item__label'}).text( 'Staff Note:' )
			, ' '
			, ( data.property_comment ? $('<div>', {class: 'property-item__note-item'}).text( data.property_comment ) : '-' )
		)

	);



	var $content = $('<div>', {class: 'property-item__inner'});
	$content.append(

		// item__nomber
		  $('<div>', {class: 'property-item__number'})

		// item__controls
		, $('<div>', {class: 'property-item__controls'}).append(
			$('<div>', {class: 'control check-list', 'data-action': 'withlist'}).html( $('<i class="icon-check"></i>') )
		)

		// item__table
		, $table

		, $footer
	);


	var $item = $('<div>', {class: 'property-item'}).addClass('state-'+data.state).append( $content );
	return $item;
}

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