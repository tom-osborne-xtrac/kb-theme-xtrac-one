<?php
/**
 * Template Name: Page METCALC
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

get_header(); ?>
<!-- PAGE TEMPLATE page.php -->
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php custom_breadcrumbs(); ?>
			<?php
			
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			wp_reset_query(); ?>
				
			<!-- MATERIAL HANDBOOK TABLE -->
			<!-- <h2>Hardness Conversion Tool</h2> -->
			
					<!-- EDIT BUTTON -->					
		<?php get_template_part( 'template-parts/content', 'editbutton' ); ?>
			
		<!-- Rockwell FROM Vickers -->
		<div id="container-hc">
			<div class="col-hc col-hc-1 inputLabel">
				<span class="label">Vickers (Hv)</span>
			</div>
			<div class="col-hc col-hc-2 input">
				<input class="input-hc" id="input_rockwellFromVickers" type="number" oninput="rockwellFromVickers(this.value, 'output_rockwellFromVickers')" onchange="rockwellFromVickers(this.value, 'output_rockwellFromVickers')">
			</div>
			<div class="col-hc col-hc-3 output">
				<span id="output_rockwellFromVickers">&nbsp;</span>
			</div>
			<div class="col-hc col-hc-4 outputLabel">
				<span class="label">Rockwell (HRc)</span>
			</div>
		</div>

		<!-- Brinell FROM Vickers -->
		<div id="container-hc">
			<div class="col-hc col-hc-1 inputLabel">
				<span class="label">Vickers (Hv)</span>
			</div>
			<div class="col-hc col-hc-2 input">
				<input class="input-hc" id="input_brinellFromVickers" type="number" oninput="brinellFromVickers(this.value, 'output_brinellFromVickers')" onchange="brinellFromVickers(this.value, 'output_brinellFromVickers')">
			</div>
			<div class="col-hc col-hc-3 output">
				<span id="output_brinellFromVickers">&nbsp;</span>
			</div>
			<div class="col-hc col-hc-4 outputLabel">
				<span class="label">Brinell (HB)</span>
			</div>
		</div>

		<!-- Strength FROM Vickers -->
		<div id="container-hc">
			<div class="col-hc col-hc-1 inputLabel">
				<span class="label">Vickers (Hv)</span>
			</div>
			<div class="col-hc col-hc-2 input">
				<input class="input-hc" id="input_strengthFromVickers" type="number" oninput="strengthFromVickers(this.value, 'output_strengthFromVickers')" onchange="strengthFromVickers(this.value, 'output_strengthFromVickers')">
			</div>
			<div class="col-hc col-hc-3 output">
				<span id="output_strengthFromVickers">&nbsp;</span>
			</div>
			<div class="col-hc col-hc-4 outputLabel">
				<span class="label">Strength (MPa)</span>
			</div>
		</div>

		<!-- Vickers FROM Rockwell -->
		<div id="container-hc">
			<div class="col-hc col-hc-1 inputLabel">
				<span class="label">Rockwell (HRc)</span>
			</div>
			<div class="col-hc col-hc-2 input">
				<input class="input-hc" id="input_vickersFromRockwell" type="number" oninput="vickersFromRockwell(this.value, 'output_vickersFromRockwell')" onchange="vickersFromRockwell(this.value, 'output_vickersFromRockwell')">
			</div>
			<div class="col-hc col-hc-3 output">
				<span id="output_vickersFromRockwell">&nbsp;</span>
			</div>
			<div class="col-hc col-hc-4 outputLabel">
				<span class="label">Vickers (Hv)</span>
			</div>
		</div>

		<!-- Vickers FROM Brinell-->
		<div id="container-hc">
			<div class="col-hc col-hc-1 inputLabel">
				<span class="label">Brinell (HB)</span>
			</div>
			<div class="col-hc col-hc-2 input">
				<input class="input-hc" id="input_vickersFromBrinell" type="number" oninput="vickersFromBrinell(this.value, 'output_vickersFromBrinell')" onchange="vickersFromBrinell(this.value, 'output_vickersFromBrinell')">
			</div>
			<div class="col-hc col-hc-3 output">
				<span id="output_vickersFromBrinell">&nbsp;</span>
			</div>
			<div class="col-hc col-hc-4 outputLabel">
				<span class="label">Vickers (Hv)</span>
			</div>
		</div>

		<!-- Vickers FROM Strength-->
		<div id="container-hc">
			<div class="col-hc col-hc-1 inputLabel">
				<span class="label">Strength (MPa)</span>
			</div>
			<div class="col-hc col-hc-2 input">
				<input class="input-hc" id="input_vickersFromStrength" type="number" oninput="vickersFromStrength(this.value, 'output_vickersFromStrength')" onchange="vickersFromStrength(this.value, 'output_vickersFromStrength')">
			</div>
			<div class="col-hc col-hc-3 output">
				<span id="output_vickersFromStrength">&nbsp;</span>
			</div>
			<div class="col-hc col-hc-4 outputLabel">
				<span class="label">Vickers (Hv)</span>
			</div>
		</div>

		<!-- Vickers FROM Knoop-->
		<div id="container-hc">
			<div class="col-hc col-hc-1 inputLabel">
				<span class="label">Knoop (HK)</span>
			</div>
			<div class="col-hc col-hc-2 input">
				<input class="input-hc" id="input_vickersFromKnoop" type="number" oninput="vickersFromKnoop(this.value, 'output_vickersFromKnoop')" onchange="vickersFromKnoop(this.value, 'output_vickersFromKnoop')">
			</div>
			<div class="col-hc col-hc-3 output">
				<span id="output_vickersFromKnoop">&nbsp;</span>
			</div>
			<div class="col-hc col-hc-4 outputLabel">
				<span class="label">Vickers (Hv)</span>
			</div>
		</div>

	
		<!-- Charts -->
		<!-- <canvas id="chartVickers" width="400" height="400" style="margin-bottom: 50px"></canvas>
		<script>
		let ctx = document.getElementById('chartVickers');
		let chartVickers = new Chart(ctx, {
			"type":"line",
			"data": { 
				"labels":["January","February","March","April","May","June","July"],
				"datasets":[{
					"label":"My First Dataset",
					"data":[65,59,80,81,56,55,40],
					"fill":false,
					"borderColor":"rgb(75, 192, 192)",
					"lineTension":0.1
				}]
			},
			"options":{

			}});
		</script> -->

		</main><!-- #main -->
	</div><!-- #primary -->
	<script type="text/javascript" src="/wp-content/themes/xtrac-one/js/hardnessconversion.js"></script>
<?php
//get_sidebar();
get_footer();