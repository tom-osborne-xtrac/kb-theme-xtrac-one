<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

?>
<!-- content-page.php -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header-page">
		
		<!-- FEATURED IMG -->
		<?php if ( has_post_thumbnail() ) : ?>
				<div class="featured-img-top">
					<a href="<?php the_post_thumbnail_url( 'full' ); ?>"><?php the_post_thumbnail( 'full' ); ?></a>
				</div> 
		<?php endif; //end 'if has post thumbnail' ?> 

		
		<!-- EDIT BUTTON -->					
		<?php get_template_part( 'template-parts/content', 'editbutton' ); ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		
		<!-- POST META  -->
		<?php get_template_part( 'template-parts/content', 'postmeta' ); ?>
		

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
				'after'  => '</div>',
			) );
		?>
		
		<!-- FEATURED  -->
		<?php get_template_part( 'template-parts/content', 'latestposts' ); ?>
		
		<!-- LINKED POSTS
		<?php echo "TEST LINKED POSTS"; 
			$connected = new WP_Query( array(
    			'relationship' => array(
        			'id'   => 'posts_to_pages',
        			'to' => get_the_ID(), // You can pass object ID or full object
    			),
    			'nopaging'     => true,
			) );
			while ( $connected->have_posts() ) : $connected->the_post();
  				?>
    			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    			<?php
			endwhile;
			
			wp_reset_postdata(); 
		?> -->
		
		
	</div><!-- .entry-content -->

</article><!-- #post-## -->