<?php
/**
 * Template Name: Page GLOSSARY
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

get_header(); ?>

	<div id="primary" class="content-area-nosidebar">
		<main id="main" class="site-main" role="main">
		<?php custom_breadcrumbs(); ?>
		
		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1>Glossary</h1>
			</header><!-- .page-header -->
			
			<!-- EDIT BUTTON -->					
			<?php get_template_part( 'template-parts/content', 'editbutton' ); ?>
						
			<div class="filter-input"><input type="text" id="tableFilterInput" onkeyup="tableFilter('tableFilterInput', 'glossary_table', 0)" placeholder="Filter by acronym..."></div>

			<!-- MATERIAL HANDBOOK TABLE -->
			<table id="glossary_table">	
	      		<tr>
		      		<th width="100px;">Acronym</th>
		      		<th>Term</th>
		      		<!--<th>Description</th>-->
		      	</tr>
		
			<?php 
            /* Setup the query to display all glossary terms */
            if( have_rows('glossary_term') ):
                               
                while( have_rows('glossary_term') ) : the_row();

                    $acronym = get_sub_field('glossary_acronym');
                    $term = get_sub_field('glossary_term');
                    $desc = get_sub_field('glossary_description');

            ?>
	      		<tr>
		      		<td><strong><?php echo $acronym ?></strong></td>
		      		<td><?php echo $term ?></td>
		      		<!--<td><?php echo $desc ?></td>-->
		      	</tr>
            <?php
                endwhile;
            else:
                echo "Nothing found!";
            endif;
            ?>

			</table> <!-- MATERIAL HANDBOOKS TABLE -->

	<?php	else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
