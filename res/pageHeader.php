<div id="pageHeader">
	<div class="row">
		<div class="col-xs-9">
			<?php 
				if (isset($pgTitleSmall)){ ?>
					<h1 class='small'>
						<?php 
							if (isset($pgTitle)){
								echo $pgTitle;
							}
						?>
					</h1>
				<?php
				} else { 
				?>
					<h1>
						<?php 
							if (isset($pgTitle)){
								echo $pgTitle;
							}
						?>
					</h1>
				<?php 
				}
			?>
			
		</div>
		<div class="col-xs-3">
			<?php require('userPortal.php'); ?>
		</div>
	</div>
	<div class="row">
		<div id="breadcrumbs" class="col-xs-6">
	        <ul>
	            <li><a href="/">Home</a></li>
	            <?php 
	            	if (isset($pgBreadcrumb)){
	            		echo $pgBreadcrumb;
	            	}
	            ?>
	        </ul>
	    </div>
		<div id="pageHeaderLinks" class="col-xs-6">
			<?php 
				if (isset($pgHeaderLinks)){
					echo $pgHeaderLinks;
				}
			?>
		</div>
	</div>
</div>