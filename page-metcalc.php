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
		<main id="main" class="site-main" role="main">TEST
		<?php custom_breadcrumbs(); ?>
			
        <div class="calc-container">
        
            Strength: <input id="input_strength_mpa" oninput="strength_to_hardness(this.value)" onchange="strength_to_hardness(this.value)">
            Hardness: <input id="output_hardness_hv">

        </div>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
