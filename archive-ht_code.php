<?php
/**
 * The template for displaying Heat Treatment Codes.
 * 
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

get_header(); ?>

	<div id="primary" class="content-area-nosidebar" style="width:calc(100% - 390px);">
		<main id="main" class="site-main" role="main">
		<?php custom_breadcrumbs(); ?>
		
		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1>Heat Treatment Programs</h1>
				<h1 class="confidential">CONFIDENTIAL - DO NOT DISTRIBUTE</h1>

			</header><!-- .page-header -->
			
			<?php if( current_user_can( 'publish_posts' ) ) { ?>
				<a href="<?php print admin_url('post-new.php?post_type=ht_code'); ?>" class="button-green" style="float:right; margin: 0;">Add New</a>
			<?php } ?>
			
			<a href="http://172.20.20.135/engineering/advanced-engineering-group/metallurgy/hardness-conversion/" class="button-green" style="float:right; margin-top: 0;">Hardness Conversion Tool</a>

			<div class="filter-input"><input type="text" id="filter_ht_htcode" class="search"  data-column="all" placeholder="Filter table..."></div>
			
			<!-- HT CODE TABLE -->
			<table id="table_htcode" class="tablesorter">
				<thead>
	      		<tr>
		      		<th span="1" style="width: 6%;" class="htcode filter-select filter_onlyAvail">HT Code</th>
		      		<th span="1" style="width: 6%;" class="progno filter-select filter_onlyAvail">Program Number</th>
		      		<th span="1" style="width: 6%;" class="tempercode filter-select filter_onlyAvail">Temper Code</th>
		      		<th span="1" style="width: 14%;" class="process">Process</th>
		      		<th span="1" style="width: 6%;" class="tempertemp filter-select filter_onlyAvail">Tempering Temp [&deg;C]</th>
		      		<th span="1" style="width: 6%;" class="tempertime filter-select filter_onlyAvail">Tempering Time [mins]</th>
		      		<th span="1" style="width: 6%;" class="surfacehardness filter-select filter_onlyAvail">Surface Hardness</th>
		      		<th span="1" style="width: 6%;" class="casedepth filter-select filter_onlyAvail">Case Depth [mm]</th>
		      		<th span="1" style="width: 6%;" class="corehardness filter-select filter_onlyAvail">Core Hardness</th>
		      		<th span="1" style="width: 32%;" class="comments">Comments</th>
		      		<th span="1" style="width: 6%;" class="cycletime filter-select filter_onlyAvail">Cycle Time [hours]</th>
		      	</tr>
				</thead>	
				<tbody>
			
			<?php 
			/* Setup the query to display all HT codes */
			$args = array(
				'post_type' => 'ht_code',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'orderby' => 'title',
				'order' => 'ASC',
				'post_parent' => 0,
			);
		   	
		   	$loop = new WP_Query( $args );
		     
		   	while ( $loop->have_posts() ) : $loop->the_post(); ?>
		      	
				<!-- for each result display the information as a new row in the table -->
	      		<tr data-href="<?php echo (esc_url( get_permalink() ) ); ?>">
	      			<td><a href="<?php echo (esc_url( get_permalink() ) ); ?>" style="font-weight: bold;"><?php print the_title(); ?></a></td>
	      			<td><?php echo the_field('program_number'); ?></td>
	      			<td><?php echo the_field('temper_code'); ?></td>
	      			<td><?php echo the_field('process'); ?></td>
	      			<td><?php echo the_field('tempering_temp'); ?></td>
	      			<td><?php echo the_field('tempering_time'); ?></td>
	      			<td><?php echo the_field('sf_hardness'); ?></td>
	      			<td><?php echo the_field('case_depth'); ?></td>
	      			<td><?php echo the_field('core_hardness'); ?></td>
	      			<td><?php echo the_field('htcode_details'); ?></td>
	      			<td><?php echo the_field('cycle_time'); ?></td>
	      		</tr>

		    <?php  	
		   	endwhile;
		
			?>
			</tbody>
			</table> <!-- MATERIAL HANDBOOKS TABLE -->
		

	<?php	else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
