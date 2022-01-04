<?php
/**
 * Template Name: Page GLOSSARY
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

function acf_add_glossary_term() {
	$field_key = '';
	$post_id = get_the_ID();
	$value = get_field($field_key, $post_id);

}
//acf_form_head();
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
			
			<!--ACF FORM -->
			<?php
				$form_settings = array(
					'new_post' => true,
					'fields' => array('field_5fcf80ef5b7fb') 
				);
				//acf_form($form_settings);
				if( current_user_can('editor') || current_user_can('administrator') ) {
					$count = count(get_field('glossary_term_repeater'));
					echo '<p>Terms: ' . $count . '</p>';
					// echo '<p>PostID: ' . $post_id . '</p>';
				

					/* Setup the query to display all glossary terms */
					$repeater = get_field('glossary_term_repeater');
					$order = array();
					foreach( $repeater as $i => $row ) {
						$order[ $i ] = $row['glossary_acronym'];
					}
					array_multisort( $order, SORT_ASC, $repeater ); ?>

					<!-- <ul>
					<?php foreach( $repeater as $i => $row ): ?>
						<li><?php echo $row['glossary_acronym']; ?>
					<?php endforeach; ?> 
					</ul>  -->
					<?php
					// $post_id = get_the_ID();
					// $key_glossary_term_repeater = 'field_5fcf80ef5b7fb';
					

					// // Entry form for submitting a new glosary term

					// $key_glossary_acronym = 'field_5fcf810d5b7fc';
					// $key_glossary_term = 'field_5fcf812f5b7fd';
					// $key_glossary_description = 'field_5fd09d23147ca';
					// $key_glossary_url = 'field_5fd09d33147cb';
					// $key_glossary_approved = 'field_5fd0ca8e47d84';

					// $ui_glossary_acronym = $_POST['acronym'];
					// $ui_glossary_term	= $_POST['term'];
					// $ui_glossary_description = $_POST['description'];
					// $ui_glossary_url = $_POST['url'];
					// $ui_glossary_approved = True;
					

					// $row_new = array(
					// 	'glossary_acronym'		=> $ui_glossary_acronym,
					// 	'glossary_term' 			=> $ui_glossary_term,
					// 	'glossary_description' 	=> $ui_glossary_description,
					// 	'glossary_url' 			=> $ui_glossary_url,
					// 	'glossary_approved' 		=> $ui_glossary_approved
					// );
					// add_row($repeater, $row_new, $post_id);
										
					// $value = array(
					// 	'field_5fcf810d5b7fc' 		=> 'TEST',
					// 	'field_5fcf812f5b7fd' 		=> 'TEST TERM',
					// 	'field_5fd09d23147ca'		=> 'TEST DESC',
					// 	'field_5fd09d33147cb'		=> 'http://172.20.20.135/#',
					// 	'field_5fd0ca8e47d84' 		=> TRUE
					// );
					// $v = add_row('field_5fcf810d5b7fc', $value, $post_id);
					
					if($value) {
						foreach ( $value as $key => $val ) {
							echo $val . "<br />";
						}
						echo "Value exists!";
					}

					?>
					<!-- <form action="" method="POST">
						<input type="text" label="Acronym" name="acronym">Acronym<br />
						<input type="text" label="Term" name="term">Term<br />
						<input type="text" label="Description" name="description">Description<br />
						<input type="text" label="Url" name="url">URL<br />
						<input type="submit" value="Submit">
					</form> -->
				<?php
				}	
			?>
			
			<div class="filter-input"><input type="text" id="tableFilterInput" onkeyup="tableFilter('tableFilterInput', 'glossary_table', 0)" placeholder="Filter by acronym..."></div>

			<!-- GLOSSARY TABLE -->
			<table id="glossary_table">	
	      		<tr>
		      		<th style="min-width: 100px; width: 10%;">Acronym</th>
		      		<th style="min-width: 300px; width: 40%;">Term</th>
                    <th>Description</th>
		      	</tr>
		
			<?php 

			
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