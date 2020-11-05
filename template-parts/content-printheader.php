<?php $cpt = get_post_type_object( get_post_type($post) );
if( is_single() ) : ?> 
<div class="print-header">
	<img src="/wp-content/themes/xtrac-one/images/2015 4 col XTRAC LOGO CMYK.jpg" class="print-logo">
	<?php 	 		
 	if($cpt->name == 'material_handbook') { ?>
		<h1>MATERIAL HANDBOOK</h1>
	<?php
	 	}else{
	 	?>	 	
		<h1>ENGINEERING REPORT:</h1>
	 	<h2><!-- POST TYPE -->
	 	<!-- CATEGORY -->
	 	<?php 	
	 	foreach((get_the_category()) as $category) { 
			echo $category->cat_name . ' '; 
		}   
	}
		?>
	</h2>	 
</div>
<?php endif; 

if( is_page() ): ?>
<div class="print-header">
	<img src="/wp-content/themes/xtrac-one/images/2015 4 col XTRAC LOGO CMYK.jpg" class="print-logo">
	<h1>Knowledge Base</h1>
	<?php echo ( get_the_permalink() ); ?>
</div>
<?php endif; ?>
