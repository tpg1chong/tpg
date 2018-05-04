// Utility
if ( typeof Object.create !== 'function' ) {
	Object.create = function( obj ) {
		function F() {};
		F.prototype = obj;
		return new F();
	};
}

(function( $, window, document, undefined ) {

	var PropertyListingToggler = {
		init: function ( options, elem ) {
			var self = this;

			self.$elem = $(elem);
			self.setElem();

			self.options = $.extend( {}, $.fn.propertyListingToggler.options, options );
			self.is_loading = false;
			self.getData = {
				limit: 50,
				pager: 1,
			}

			self.resize();
			$( window ).resize(function () {
				self.resize();
			});


			// Event
			self.$form.submit(function(e) {
				e.preventDefault();
				self.search();
			});

			// self.$inputSearch.

			self.$menu.parent().scroll(function() {
	
				var val = (self.$menu.outerHeight() * 3) /100;
				var pos = $(this).scrollTop() + $(this).outerHeight();
				var hei = self.$menu.outerHeight();
				var lev = hei - pos;
				if( lev < val && !self.is_loading ){

					self.getData.pager ++;
					self.load();
				}
			});


			self.$menu.empty();
			self.load();

			
			self.open();
		},

		setElem: function () {
			var self = this;

			
			self.$flyout = self.$elem.find('#propertyListingFlyout');
			self.$menu = self.$elem.find('[role=menu]');
			self.$menu.addClass('propertyListingList')
			self.$form = self.$elem.find('form');
			self.$listsbox = self.$elem.find('[role=listsbox]');
			self.$inputSearch = self.$elem.find('#search-query');
			

		},

		resize: function () {
			var self = this;

			self.$menu.parent().css({
				maxHeight: $(window).height() - 150
			});
		},

		load: function () {
			var self = this;

			self.is_loading = true;

			$.ajax({
				url: app.getUri( 'property/listingList' ),
				type: 'GET',
				dataType: 'json',
				data: self.getData,
			})
			.done(function( res ) {
	
				self.getData = $.extend( {}, self.getData, res.options );
				$.each( res.items, function(i, obj) {
					
					self.display( obj );
				});

				console.log( self.getData );
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				self.is_loading = false;
				console.log("complete");
			});
		},

		display: function (data) {
			var self = this;

			self.$menu.append( self.setItem( data ) );
		},

		setItem: function (data) {
			var self = this;

			var $li = $('<li>', {class: 'menu-item'});
			var $anchor = $('<div>', {class: 'anchor clearfix'});


			var $avatar = $('<a>', {class: 'code lfloat mrm'}).append(
				  $('<span>', {class: 'fwb', text: '#'+data.code})
				, $('<div>', {class: 'fss', text: '19 Items'})
			);

			/* actions */
			var $actions = $('<div>', {class: 'anchor-actions rfloat mlm group-btn'});
			$actions.append( 
				  $('<a>', {class: 'btn btn-small', text: 'Staff', href: 'https://www.thaipropertyguide.com/datacenter.php/exportData/propertyListing/' + data.id + '?exporttype=staff' })
				, $('<a>', {class: 'btn btn-small', text: 'Client', href: 'https://www.thaipropertyguide.com/datacenter.php/exportData/propertyListing/' + data.id + '?exporttype=client'})
			);


			var $date = $('<span>', {class: 'date fcg fsm'});

			$date.append( $('<i>', {class: 'date-i icon-clock-o'}), $('<span>', {class: 'date-str mls'}).html( data.created_str ) );
			if( data.user_name ){
				$date.append( ' - ', $('<span>', {class: ''}).html( data.user_name ) );
			}

			/* content */
			var $content = $('<div>', {class: 'content'});
			$content.append(
				  $('<div>', {class: 'spacer'})
				, $('<div>', {class: 'massages'}).append(

					  $('<a>', {class: 'fullname', text: data.name})
					, $('<div>', {class: 'dics'}).append( $date )
				)
			);

			$anchor.append( $avatar, $actions, $content );

			return $li.append( $anchor );
		},

		open: function () {
			var self = this;

			self.resize();
			self.$elem.addClass('openToggler');
		},

		search: function () {
			
		},


	};

	$.fn.propertyListingToggler = function( options ) {
		return this.each(function() {
			var $this = Object.create( PropertyListingToggler );
			$this.init( options, this );
			$.data( this, 'main', $this );
		});
	};

	$.fn.propertyListingToggler.options = {};
	
})( jQuery, window, document );