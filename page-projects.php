<?php
/*
 * Template Name: Page PROJECTS
 */

get_header(); ?>
<!-- PAGE TEMPLATE page.php -->
	<div id="primary" class="content-area-nosidebar">
		<main id="main" class="site-main" role="main">
		<?php custom_breadcrumbs(); ?>
			<?php
			while ( have_posts() ) : the_post(); ?>

				<h1>Projects</h1>
				
				<!-- EDIT BUTTON -->					
				<?php get_template_part( 'template-parts/content', 'editbutton' ); ?>

				<input type="text" id="projectCodeFilterInput" onkeyup="projectCodeFilter()" placeholder="Filter projects...">
				<div id="projectCodeFilterList">
				<?php //PROJECTS LIST
				$project_codes = get_terms( array(
									'taxonomy' => 'project_code',
									) );

				foreach ($project_codes as $project_code) { ?>				
						<div class="projectCode <?php echo $project_code->name; ?>"><a href="<?php echo get_term_link( $project_code ); ?>" ><?php echo $project_code->name; ?></a></div>
				<?php } ?>
					 
					 </div>

				<?php // If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
