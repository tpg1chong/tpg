<?php require_once "incs/init.php"; ?>
<div id="mainContainer" class="Setting clearfix container" data-plugins="main">

	<?php 

		if( $this->count_nav > 1 ){
			require_once 'incs/list-menu.php';
		}
	?>

	<div class="setting-content" role="content">
		<div class="setting-main" role="main"><?php

			if( !empty($this->section) ){

				if( !empty($this->tap) ){
					require_once "sections/{$this->section}/{$this->tap}.php";
				}
				else{
					require_once "sections/{$this->section}/default.php";
				}
			}
			else{
				require_once "sections/default.php";
			}

		?></div>
	</div>
</div>