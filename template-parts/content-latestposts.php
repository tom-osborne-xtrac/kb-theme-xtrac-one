
<!--
<?php

//Get the selected page links
$post_objects = get_field( 'featured_pages' ); //returns array ?>

<div class="feature-row">
<?php
if( $post_objects ): //if there is content selected
?>

	<?php
	//loop through array
	foreach( $post_objects as $post_object ) { ?>
		<a href="<?php echo get_permalink($post_object->ID); ?>"><?php echo get_the_title($post_object->ID); ?></a>
	<?php }	//end foreach ?>

<?php endif; ?>
</div> -->


<?php 	$terms = get_field( 'category-for-page' );
		$num_posts = get_field( 'num-posts' );

// if no. of posts is left blank default to 5
if( empty( $num_posts ) ) :
	$num_posts = 5;
endif;

if( $terms ): ?>
<!-- FEATURED CATEGORY POSTS --->

<!-- Retrieve selected category -->

	<?php foreach( $terms as $term ): ?>

		<h2>Latest <?php echo $term->name; ?> Reports</h2>
		<p><?php echo $term->description; ?></p>
		
		<div class="latest-post">
			<!-- Start Loop-->
			<?php 
			wp_reset_query();
			$args = array(
					'post_type' => array( 'post', 'attachment', 'condition_assessment', 'xt_report', 'snippet', 'guides' ),
					'tax_query' => array(
						array(
							'taxonomy' => 'category',
							'field'    => 'name',
							'terms'    => $term->name,
						),
					),
					'posts_per_page' => $num_posts			
			);
	
			// query
			$the_query = new WP_Query( $args ); ?>
			
			<!-- Start our WP Query -->
			<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
			
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						
						<!-- MEDIA IMG -->
						<?php	if ( get_post_type( get_the_ID() ) == 'attachment' ) { //Check post-type is attachment
						    //if is true
						?>
						<a href="<?php echo get_permalink(); ?>" rel="bookmark"><img src="http://172.20.20.135/wp-content/themes/xtrac-one/images/icon-file.png" class="media-icon"></a>
				
						<?php } ?>
						
						<!-- EDIT BUTTON -->					
						<?php get_template_part( 'template-parts/content', 'editbutton' ); ?>
				
						<?php if ( is_single() ) : //Just show the title else link to the post ?>
							<h1 class="entry-title"><?php  the_title();?></h1> 
								
								<?php if ( has_post_thumbnail() ) : ?>
										<div class="loop-img-right"><a href="<?php the_post_thumbnail_url( 'full' ); ?>"><?php the_post_thumbnail( 'medium' ); ?></a> </div> <!-- thumbnail image align right -->
								<?php endif; //end 'if has post thumbnail' ?>
								
						<?php else : //link to the post ?>
				
						<?php	the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' , '</a></h2>' );
						endif; //end 'if is single' ?>
				
						<!-- POST META  -->
						<?php get_template_part( 'template-parts/content', 'postmeta' ); ?>
				
					</header><!-- .entry-header -->
				
					<div class="entry-content">
				
					<!-- THUMBNAIL -->
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="loop-img"><a href="<?php echo (esc_url( get_permalink() ) ); ?>"><?php the_post_thumbnail(); ?></a></div> <!-- thumbnail image -->
						<?php endif; //end 'if has post thumbnail' ?>
					
						<!-- EXCERPT -->
						<?php echo '<div class="excerpt">' . get_the_excerpt() . '</div>'; ?>
				
					</div><!-- .entry-content -->
				
					<footer class="entry-footer">
						<?php _s_entry_footer(); ?>
					</footer><!-- .entry-footer -->
				</article><!-- #post-## -->
				
			<?php 
			endwhile; // close loop
			wp_reset_postdata(); //reset post data for parent loop
			?>


				
			<p><a href="<?php echo get_term_link( $term ); ?>">View all '<?php echo $term->name; ?>' reports</a></p>
	 	</div>
	<?php endforeach; ?>	

<?php endif; ?>	

