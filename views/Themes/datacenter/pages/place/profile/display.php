<?php require 'incs/init.php'; ?>
<div id="mainContainer" class="clearfix" data-plugins="main" data-ref="forumlists">
	
<div id="forum" class="forum hasLeft" data-plugins="mainforum" data-options="<?=$this->fn->stringify( array(
	'load'=>URL."admin/place/{$this->item['id']}/",
	'tab' => !empty($this->pageOptions['tab']) ? $this->pageOptions['tab']: ''
) )?>">
	<div class="forum-toolbar" role="topbar">
		<div class="clearfix">
			<div class="forum-toolbar-title lfloat">
				<h2 class="title" data-profile="name"><?=$this->item['name']?></h2>
				<div class="fsm mvs" style="margin-top: 2px">
					<div>
						<span><i class="icon-building mrs"></i><?=$this->item['type_name']?></span>
						<span class="mhs">·</span> 
 						<span><i class="icon-map-marker mrs"></i><?=$this->item['location_str']?></span>
					</div>
				</div>
			</div>
			<div class="rfloat">
				<a class="btn btn-red" data-plugins="lightbox" href="<?=URL?>place/del/<?=$this->item['id']?>?next=<?=URL?>admin/place"><i class="icon-remove"></i><span class="mls">Delate</span></a>
			</div>
		</div>

		<nav class="forum-toolbar-nav"><?php

			foreach ($this->tabs as $key => $value) {

				echo '<a class="forum-toolbar-navItem" data-action-tab="'.$value['tab'].'" data-options="'.$this->fn->stringify( $value ).'"><i class="icon-'.$value['icon'].'"></i><span class="mls">'.$value['name'].'</span><span class="mls hidden_elem">[<span data-profile="contactTotal">0</span>]</span></a>';
			}
		?></nav>
	</div>

	<div class="forum-left" role="left" data-width="220">

		<div class="forum-profile-sile">

			<div class="forum-profile-avatar">
				<i class="icon-map-marker"></i>
			</div>

			<div class="uiBoxYellow phm mvm pvs hidden_elem">
				<p data-profile="note"></p>
			</div>

			<section>
				<table class="table-dataInfo">
					<tbody>

						<tr>
							<td class="label">Partner:</td>
							<td class="data">
								<div class="hidden_elem"><span data-profile="expatTotal"></span></div>
							</td>
						</tr>
						
						<tr>
							<td class="label">Created Date:</td>
							<td class="data"><span data-profile="created_str"></span><div class="check-hide hidden_elem" style="font-size: 11px;">by <a data-profile="created_author_username"></a></div></td>
						</tr>

						<tr>
							<td class="label">Last Update:</td>
							<td class="data"><span data-profile="updated_str"></span><div class="check-hide hidden_elem" style="font-size: 11px;">by <a data-profile="updated_author_username"></a></div></td>
						</tr>

					</tbody>
				</table>
			</section>
		</div>
	</div>

	<div class="forum-content hasLeft has-empty" role="content">

		<div class="forum-profile-wrap" role="main">
			<?php

			/*<div class="forum-profile-forms">
			<?php foreach ($this->tabs as $key => $value) { 

				echo '<div class="forum-profile-section" data-section="'.$value['id'].'">';
				require_once "sections/{$value['id']}.php";
				echo '</div>';
			} ?>
			</div>*/
			?>

			<!-- <div class="forum-content-alert forum-alert">
				<div class="loading">Loading...</div>
				<div class="empty">Choose company the left side entry.</div>
			</div> -->
		</div>
	</div>
</div>
<!-- end: mainProperty -->
</div>
<!-- end: #mainContainer -->