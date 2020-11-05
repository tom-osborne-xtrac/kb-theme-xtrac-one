<?php
//only show if the page has children

global $post; //load details about this page

$children = get_pages( array( 'child_of' => $post->ID ) );

if( count( $children ) > 0 ) { 
?>
<div class="sub-pages">
<ul>
<?php 	
global $id; //grab page id

	wp_list_pages( array(
		'title_li' => '',
		'child_of' => $id,
		'depth' => 1,
		'sort_column' => 'post_title',
	) ); 
?>
</ul>
</div>
<?php } //endif ?>