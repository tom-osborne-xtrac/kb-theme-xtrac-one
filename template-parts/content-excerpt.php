<?php 
/* EXCERPT */

if( is_home() || is_archive() || is_search() ||is_front_page() ) { 

?>

	
	<!-- EXCERPT -->
	<?php echo '<div class="excerpt">' . get_the_excerpt() . '</div>'; ?>

<?php }else{
	the_content( sprintf(
		/* translators: %s: Name of current post. */
		wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', '_s' ), array( 'span' => array( 'class' => array() ) ) ),
		the_title( '<span class="screen-reader-text">"', '"</span>', false )
	) );

	wp_link_pages( array(
		'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
		'after'  => '</div>',
	) );
} //end if
?>
