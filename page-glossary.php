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
		      		<th style="min-width: 100px; width: 10%;">Acronym</th>
		      		<th style="min-width: 300px; width: 40%;">Term</th>
                    <th>Description</th>
		      	</tr>
		
			<?php 
			/* Setup the query to display all glossary terms */
			$repeater = get_field('glossary_term_repeater');
			$order = array();
			foreach( $repeater as $i => $row ) {
				$order[ $i ] = $row['glossary_acronym'];
			}
			array_multisort( $order, SORT_ASC, $repeater );
			
            if( have_rows('glossary_term_repeater') ):
                               
                while( have_rows('glossary_term_repeater') ) : the_row();

                    $acronym 	= get_sub_field('glossary_acronym');
                    $term 		= get_sub_field('glossary_term');
                    $desc 		= get_sub_field('glossary_description');
                    $url 		= get_sub_field('glossary_url');
                    $approved 	= get_sub_field('glossary_approved');

                                   
                if($approved == true):
            ?>
	      		<tr>
		      		<td><strong>
					  <?php if($url) { ?>
                            <a href="<?php echo $url; ?>" target="_blank" rel="noopener noreferrer"><?php echo $acronym ?>
								<span style="font-size: 10px; position: relative; top:-2px; margin-left: 4px;">
									<i class="fas fa-external-link-alt"></i>
								</span>
							</a>
						<?php }else{ echo $acronym; } ?>
					</strong></td>
					<td><?php echo $term; ?></td>
                    <td><?php echo $desc ?></td>
		      	</tr>
            <?php
                endif; // end approval check
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