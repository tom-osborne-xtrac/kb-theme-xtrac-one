<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */


 /* 
POST TYPE: glossary_terms
FIELDS: [
	acronym {
		type: text-field,
		desc: The acronym being defined
		reqd: true
	},
	term {
		type: text-field,
		desc: The words of the acronym
		reqd: true
	},
	description {
		type: text-area,
		desc: A brief description of the acronym,
		reqd: false
	},
	url {
		type: url,
		desc: link to further reading,
		reqd: false
	}
]

 */
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php custom_breadcrumbs(); ?>

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1>Glossary of Terms</h1>
			</header><!-- .page-header -->

			<!-- Add new button -->
			<?php if( current_user_can( 'publish_posts' ) ) { ?>
				<a href="<?php print admin_url('post-new.php?post_type=glossary_terms'); ?>" class="button-green" style="float:right; margin: 0;">Add New</a>
			<?php } ?>

			<div class="filter-input"><input type="text" id="tableFilterInput" onkeyup="tableFilter('tableFilterInput', 'table_glossary_terms', 0)" placeholder="Filter by acronym..."></div>

			<!-- Table header -->
			<table id="table_glossary_terms" class="tablesorter">
				<thead>
					<tr>
						<th span="1" style="width: 12%;" class="acronym filter-select filter_onlyAvail">Acronym</th>
						<th span="1" style="width: 38%;" class="term filter-select filter_onlyAvail">Term</th>
						<th span="1" style="" class="description filter-select filter_onlyAvail">Decription</th>
						<!-- Edit row button -->
						<?php if( current_user_can( 'publish_posts' ) ) { ?>
							<th span="1" style="width: 30px;">Edit</th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
			<?php

			/* Setup the query to display all HT codes */
			$args = array(
				'post_type' => 'glossary_terms',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'orderby' => 'title',
				'order' => 'ASC',
				'post_parent' => 0,
			);
		   	
		   	$loop = new WP_Query( $args );
		     
		   	while ( $loop->have_posts() ) : $loop->the_post();

			   $term = get_field('glossary_term');
			   $url = get_field('glossary_url');
			   $desc = get_field('glossary_description'); ?>
		      	
				<!-- for each result display the information as a new row in the table -->
	      		<tr <?php if($url) { echo " data-href='" . $url . "'"; } ?>>
	      			<td>
						<?php
						if($url) { ?>
						<a href="<?php echo $url; ?>" style="font-weight: bold;">
							<?php print the_title(); ?>
							<span style="font-size: 10px; position: relative; top:-2px; margin-left: 4px;">
								<i class="fas fa-external-link-alt"></i>
							</span>
						</a>
						<?php }else{ print the_title("<strong>", "</strong>"); } ?>
					</td>
	      			
					<td><?php echo $term; ?></td>
	      			<td><?php echo $desc; ?></td>
					<!-- Edit row button -->
					<?php if( current_user_can( 'publish_posts' ) ) { ?>
						<td>
							<a href="<?php echo get_edit_post_link( get_the_ID() ); ?>" class="button-darkgrey button-small" title="Edit">
								<img src="http://172.20.20.135/wp-content/themes/xtrac-one/images/pencil-edit-button.png" width="10px">
							</a>
						</th>
					<?php } ?>
	      		</tr>

		    <?php  	
		   	endwhile;
		
			?>
			</tbody>
			</table>
		

		<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
