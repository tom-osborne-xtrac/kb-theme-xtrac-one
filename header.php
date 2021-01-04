<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php wp_head(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="stylesheet" type="text/css" href="/wp-content/themes/xtrac-one/css/jPushMenu.css" />
<link rel="icon" type="image/x-icon" href="http://172.20.20.135/wp-content/uploads/favicon.ico" />

<!--CALL JAVASCRIPT LIBRARIES -->
<!-- JQuery -->
<link rel="stylesheet" href="/wp-content/themes/xtrac-one/js/jquery-ui.min.css">
<script src="/wp-content/themes/xtrac-one/js/external/jquery/jquery.js"></script>
<script src="/wp-content/themes/xtrac-one/js/jquery-ui.min.js"></script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
<script>Chart.plugins.unregister(ChartDataLabels);</script>

<!-- VUE -->
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>

<!-- PapaParse -->
<script src="/wp-content/themes/xtrac-one/js/papaparse.min.js"></script>

<!-- FontAwesome -->
<script src="https://kit.fontawesome.com/ab1d9e87ee.js" crossorigin="anonymous"></script>

<!-- Tablesorter -->
<script src="/wp-content/themes/xtrac-one/js/tablesorter-master/js/jquery.tablesorter.js"></script>
<script src="/wp-content/themes/xtrac-one/js/tablesorter-master/js/jquery.tablesorter.widgets.js"></script>

<!-- Custom JS -->
<script src="/wp-content/themes/xtrac-one/js/custom.js"></script>
<script src="/wp-content/themes/xtrac-one/js/jPushMenu.js"></script>
<!-- <script src="/wp-content/themes/xtrac-one/js/fetchData.js"></script> -->

</head>

<body <?php body_class(); ?>>

<!-- Return to Top -->
<a href="javascript:" id="return-to-top"><img src="/wp-content/themes/xtrac-one/images/chevron-up.png" /></a>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '_s' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
	
		<!-- PRINT HEADER -->					
		<?php get_template_part( 'template-parts/content', 'printheader' ); ?>
		
		<div class="top-bar">
			<!-- hamburger -->
			<div class="hamburger" title="Toggle Menu">
				<span class="hamburger-top"></span>
				<span class="hamburger-middle"></span>
				<span class="hamburger-bottom"></span>
			</div>
			
			<!-- Site branding -->
			<div class="site-branding">
			
			<!-- CHRISTMAS HAT -->
			<?php $month = date("m"); 
					if($month == 12): ?>
			<a href="https://www.timeanddate.com/countdown/christmas" target="_blank">
				<img src="/wp-content/themes/xtrac-one/images/Christmas-Hat-PNG.png" id="xmas-hat" height="32px" width="32px">
			</a>
			<?php endif; ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="http://172.20.20.135/wp-content/themes/xtrac-one/images/XTRAC logo white.svg" alt="Xtrac Logo" class="xtrac-logo">
				</a>
        		<?php
				if ( is_front_page() && is_home() ) : ?>
					<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
				<?php else : ?>
					<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
				<?php
				endif;
	
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php
				endif; ?>
			</div><!-- .site-branding -->
			
			<!-- SEARCH -->
			<div class="top-bar-search"><?php get_search_form(); ?></div>

			<!-- WP NAV -->
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', '_s' ); ?></button>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'item_spacing' => 'discard' ) ); ?>
			</nav><!-- #site-navigation -->
			
			
		</div><!-- close top-bar -->
		
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<?php	
		get_sidebar('left'); 
		
		$excludeSidebarRight = array();
		
		if ( is_active_sidebar ( 'right' ) ) {
			if ( !is_page_template( array( 'page-dashb.php', 'page-dashb-rd.php', 'page-dashb-ca.php', 'page-projects.php' ) ) && !is_search() && !is_post_type_archive('material_handbook') && !is_post_type_archive('ht_code') ) {
					get_sidebar('right');
			}
		}
	 	?>