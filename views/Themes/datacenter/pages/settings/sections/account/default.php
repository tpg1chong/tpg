<div class="maestro">

	<header class="maestro-header"><h1>Personal account</h1></header>

	<div class="account-page" style="max-width: 750px;">
		
		<div class="mc-tabbed-header hidden_elem">
			<ul role="tablist" class="mc-tabbed-header-list">
				<li class="mc-tabbed-header-item active"><a>General</a></li>

				<li class="mc-tabbed-header-item"><a>Security</a></li>

				<li class="mc-tabbed-header-item"><a>Notifications</a></li>
				<!-- <li class="mc-tabbed-header-item"><a>Connected apps</a></li> -->
			</ul>
		</div>

		<div class="account-page-tab account-page-general">
			
			<div class="account-page-block">
				<div class="general-page-header">Basics</div>

				<div class="settings-listItem">
					<div class="settings-listLink">
						<span class="settings-listLabel fcg fwb fsm">Photo</span>
						<span class="settings-listValue fcg"></span>
						<span class="settings-listActions">
							<button type="button"><i class="icon-pencil mrs"></i><span>Edit</span></button>
							<!-- <button type="button"><i class="icon-trash mrs"></i><span>Delete</span></button> -->
						</span>
					</div>
				</div>

				<div class="settings-listItem">
					<div class="settings-listLink">
						<span class="settings-listLabel fcg fwb fsm">Name</span>
						<span class="settings-listValue fcg">shiichong ชง</span>
						<span class="settings-listActions">
							<button type="button"><i class="icon-pencil mrs"></i><span>Edit</span></button>
						</span>
					</div>
				</div>

				<div class="settings-listItem">
					<div class="settings-listLink">
						<span class="settings-listLabel fcg fwb fsm">Personal email</span>
						<span class="settings-listValue fcg">monkey.d.chong@gmail.com</span>
						<span class="settings-listActions">
							<button type="button"><i class="icon-pencil mrs"></i><span>Edit</span></button>
						</span>
					</div>
				</div>

			</div>

			<div class="account-page-block">
				<div class="general-page-header">Preferences</div>

				<div class="settings-listItem">
					<div class="settings-listLink">
						<span class="settings-listLabel fcg fwb fsm">Language</span>
						<span class="settings-listValue fcg">English (United States)</span>
						<span class="settings-listActions">
							<!-- <button type="button"><i class="icon-pencil mrs"></i><span>Edit</span></button> -->
						</span>
					</div>
				</div>

				<div class="settings-listItem">
					<div class="settings-listLink">
						<span class="settings-listLabel fcg fwb fsm">Theme</span>
						<span class="settings-listValue">
<?php

$form = new Form();
$form = $form->create()->elem('div');

$theme = array();
$theme[] = array('id'=>'light', 'name'=>'Light');
$theme[] = array('id'=>'dark', 'name'=>'Dark');
// $theme[] = array('id'=>'blue', 'name'=>'Blue');

$form   ->field("user_mode")->type('radio')->items( $theme )->checked( $this->me['mode'] );

echo $form->html();


					?>
						</span>
						<span class="settings-listActions">
							<!-- <button type="button"><i class="icon-pencil mrs"></i><span>Edit</span></button> -->
						</span>
					</div>

				</div>
				
			</div>

			<div class="account-page-block">
				<div class="general-page-header">Security</div>

				<div class="settings-listItem">
					<div class="settings-listLink">
						<span class="settings-listValue">
							<strong>Password</strong>
							<div class="fcg fsm">Set a unique password to protect your personal TPG account.</div>
						</span>
						<span class="settings-listActions">
							<button type="button"><i class="icon-pencil mrs"></i><span>Change password</span></button>
						</span>
					</div>

				</div>

			</div>
		</div>
	</div>

</div>

<script type="text/javascript">
	
	$('[name=user_mode]').change(function() {
		
		var val = $(this).val();

		$.post( app.getUri('me/update'), { 'name': 'user_mode', value: val }, function (res) {
			console.log( res );
			
			if( val=='dark' ){
				$('body').removeClass('light').addClass( val );
			}
			else{
				$('body').removeClass('dark').addClass( val );
			}


			Event.log({
				text: 'Theme Updated.',
				auto: true
			});

		}, 'json' );

		

	});
	

</script>