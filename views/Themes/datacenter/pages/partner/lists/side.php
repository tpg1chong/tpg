<?php


echo '<div class="settings-left" role="left" data-width="180" style="background-color: #e5e5e5;z-index: 100; border-right: 1px solid #d9d9d9;">';

	// <!-- menu -->
	echo '<div class="settings-nav">';
	foreach ($this->menu as $key => $value) {

		$sub = '';
		if( !empty($value['sub']) ){

			foreach ($value['sub'] as $i => $item) {
				$active = '';

				$k = $item['key'];

				if( !empty($k) && !empty($this->_tap) ){

					if( $k==$this->section ){
						$active = ' active';
					}
				}elseif( !empty($k) && !empty($this->tap) ){

					if( $k==$this->tap ){
						$active = ' active';
					}
				}
				elseif(!empty($k) && !empty($this->section)){

					if( $k==$this->section ){
						$active = ' active';
					}
				}

				$url = !empty($item['url']) ? '  href="'.$item['url'].'"': '';

				$sub .= '<li><a class="settings-nav-page-link'.$active.'"'.$url.'>'.$item['text'].'</a></li>';
			}

			$sub = '<ul class="settings-nav-list">'.$sub.'</ul>';
		}

		echo '<div>';

			$active = '';
			if( !empty($value['key']) && !empty($this->section) ){
				if( $value['key']==$this->section ){
					$active = ' active';
				}
			}

			$url = !empty($value['url']) ? ' href="'.$value['url'].'"':'';

			echo '<a class="settings-nav-header-link'.$active.'"'.$url.'>'.$value['text'].'</a>';

			echo $sub;
		echo '</div>';

		
	}

	echo '</div>';
	// <!-- /menu -->

echo '</div>';