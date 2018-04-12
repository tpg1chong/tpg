<div class="container clearfix module">

<div class="data-table">
	<header class="data-table__header">
		<h1><i class="icon-building-o"></i><span class="mlm">Company</span></h1>
	</header>

	<div class="data-table__filter clearfix">
		
	</div>

	<div class="data-table__table-container"> 

		<div class="data-table__table-lists"> 
			<div class="data-table__table">
				<?php for ($i=0; $i < 10; $i++) { ?>
				<div class="data-table__table-tr">
					<div class="data-table__table-td td-check">
						<label class="checkbox"><input type="checkbox" name=""></label>
					</div>
					<div class="data-table__table-td td-name">AAA</div>
					<div class="data-table__table-td td-date"></div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<!-- emd: table-container -->
</div>


</div>

<style type="text/css">
	.data-table__header h1{
		font-size: 22px;
		font-weight: normal;
		margin-bottom: 6px;
	}
	.data-table__header{
		border-bottom: 1px solid #d9d9d9;
		padding-bottom: 10px;
		margin-bottom: 10px;
	}
	.data-table__table-container{
		/*background-color: #fff;
		border: 1px solid #ccc; 
		border-radius: 4px;*/
	}
	.data-table__table{
		width: 100%;
		display: table;
	}
	.data-table__table-tr{
		display: table-row;
	}
	.data-table__table-th, .data-table__table-td{
		display: table-cell;
		padding: 12px;
		vertical-align: middle;
	}
	.data-table__table-th{
		font-weight: bold;
		padding: 4px 12px;
		background-color: #fff;
	}
	.data-table__table .td-check{
		width: 18px;
		padding-right: 0;
		/*padding-left: 0*/
	}
	.data-table__table .td-check .checkbox{
		margin: 4px 0 0;
		opacity: 0
	}
	.data-table__table .data-table__table-tr:hover .td-check .checkbox{
		opacity: 1
	}
	.data-table__table .td-check .radio input[type=radio],.data-table__table .td-check .checkbox input[type=checkbox]{
		margin: 0;
	}
	.data-table__table-tr:nth-child(odd) {background-color: #f2f2f2}

	.data-table__table-tr:hover{
		background-color: #d9d9d9
	}
	
</style>