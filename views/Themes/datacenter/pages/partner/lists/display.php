<?php require_once 'init.php'; ?>

<div id="mainContainer" class="clearfix listpage2-container" data-plugins="main">


	<div role="content">
		<div role="main">

<div class="listpage2 has-loading offline" data-plugins="listpage2" data-options="<?= $this->fn->stringify( array(
		'url' => $this->getURL
	) )?>">

	<!-- header -->
	<?php require 'header.php'; ?>

	<!-- table -->
	<div ref="table" class="listpage2-table">
		<div ref="tabletitle"><?php require 'tabletitle.php'; echo $tabletitle; ?></div>
		<div ref="tablelists"></div>

		<!-- <div class="listpage2-table-overlay"></div> -->
		<div class="listpage2-table-empty">
	        <div class="empty-icon"><i class="icon-<?=$this->pageIcon?>"></i></div>
	        <div class="empty-title"><?=$this->lang->translate('No Results Found.')?></div>
		</div>
		
	</div>

	<div class="listpage2-table-overlay-warp">
		<div class="listpage2-table-overlay"></div>
		<div class="listpage2-alert">
			<div class="listpage2-loading">
				<div class="listpage2-loading-icon loader-spin-wrap"><div class="loader-spin"></div></div>
				<div class="listpage2-loading-text"><?=$this->lang->translate('Loading')?>...</div> 
			</div>
		</div>
	</div>
</div>

		</div>
		<!-- end: main -->
	</div>
	<!-- end: content -->
</div>
<!-- end: container -->

<script type="text/javascript">

	$(function () {

		/*$('[data-action=filter]').change(function() {
			window.location = Event.URL + 'manage/authorization?enabled=' + $(this).val();
		});*/
		
		$('body').delegate('#auto_password', 'change', function () {

			var is = $(this).prop('checked'),
				$fieldset = $('.form-emp-add #password_fieldset');

			$fieldset.toggle( !is );

			if( !is ){
				$fieldset.find('.inputtext').focus();
			}
		});

		var password;
		$('body').delegate('.form-emp-add', 'submit', function (e) {
			e.preventDefault();

			var $form = $(this);
			Event.inlineSubmit( $form ).done(function( resp ){

				Event.processForm($form, resp);

				password = resp.password;

				if( resp.error ){
					return false;
				}

				Dialog.open({
					'title': 'สร้างผู้ใช้ใหม่',
					'body': '<div class="form-vertical">'+

						'<i class="icon-check mrs"></i>'+ resp.data.name + ' เป็นผู้ใช้แล้ว <br><br>' + 
						'<fieldset class="control-group">'+
							'<label class="control-label">ชื่อผู้ใช้</label>' +
							'<div class="controls">' + resp.data.login + '</div>'+ 
						'</fieldset>'+
						'<fieldset class="control-group">' + 
							'<label class="control-label">รหัสผ่าน</label>' +
							'<div class="controls"><span id="show-password">******</span> <a class="show-password-toggle">แสดงรหัสผ่าน</a></div>'+ 
						'</fieldset>' +

					'</div>',
					'button': '<button type="button" role="dialog-close" class="btn js-close"><span class="btn-text">ปิด</span></button>',
					'form': '<div class="form-conf">',
				});

			});
		});

		$('body').delegate('.form-conf .js-close', 'click', function () {

			setTimeout(function() {
				window.location = window.location.href;
			}, 800);
		});
		

		$('body').delegate('.show-password-toggle', 'click', function () {

			var $this = $(this),
				box = $('#show-password');


			if( box.hasClass('show') ){
				$this.text('แสดงรหัสผ่าน');
				box.removeClass('show').text('******');
			}
			else{

				$this.text('ซ่อนรหัสผ่าน');
				box.addClass('show').text( password );
			}

		});


		$('body').delegate('.form-reset-password input[name=password_auto]', 'change', function () {

			var $form = $('.form-reset-password'),
				is = $(this).prop('checked');


			if( is ){
				$form.find('#password_new, #password_confirm').val('123456').prop('disabled', true).addClass('disabled');
			}
			else{
				$form.find('#password_new, #password_confirm').val('').prop('disabled', false).removeClass('disabled');
			}
		});
		
		$('body').delegate('.form-reset-password', 'submit', function (e) {
			e.preventDefault();

			var $form = $(this);
			Event.inlineSubmit( $form ).done(function( resp ){

				Event.processForm($form, resp);

				if( resp.error ){
					return false;
				}

				password = resp.password;
				Dialog.open({
					'title': 'รีเซ็ตรหัสผ่าน',
					'body': '<div class="form-vertical">'+

						'<fieldset class="control-group">' + 
							'<label class="control-label">รหัสผ่าน</label>' +
							'<div class="controls"><span id="show-password">******</span> <a class="show-password-toggle">แสดงรหัสผ่าน</a></div>'+ 
						'</fieldset>' +

					'</div>',
					'button': '<button type="button" role="dialog-close" class="btn"><span class="btn-text">ปิด</span></button>',
				});


			});
		});



		/*$(':in;putselect.selector').change(function() {
			var $this = $(this);

			var id = $this.closest('tr').attr('data-id');

			$.get( app.getUri('partner/update'), {
				id: id,
				name: $this.attr('name'),
				value: $this.val()
			});
		});*/


		$('body').delegate(':input[data-action=checked]', 'change', function (e) {
			var $this=$(this), id = $this.closest('tr').attr('data-id');

			$.get( app.getUri('partner/update'), {
				id: id,
				name: $this.attr('name'),
				value: $this.prop('checked') ? 1: 0
			});
		});

	});
</script>