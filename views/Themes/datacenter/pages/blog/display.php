<?php

require_once 'incs/init.php';

echo '<div id="mainContainer" data-plugins="main">';
	if( $this->count_nav > 1 ){ require_once 'incs/leftMenu.php'; }

	echo '<div role="content"><div role="main"><div class="pal mhl">';
		
		echo '<div id="site-settings" class="admin-settings">';


			if( !empty($this->section) ){
				$path = __DIR__. "/sections/{$this->section}.php";
				if( file_exists($path) ){
					require_once "sections/{$this->section}.php";
				}
				
			}
		echo '</div>';

		// 
	echo '</div></div></div>';

echo '</div>';