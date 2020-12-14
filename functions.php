<?php
/**
 * _s functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _s
 */

if ( ! function_exists( '_s_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function _s_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _s, use a find and replace
	 * to change '_s' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( '_s', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', '_s' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( '_s_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', '_s_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function _s_content_width() {
	$GLOBALS['content_width'] = apply_filters( '_s_content_width', 640 );
}
add_action( 'after_setup_theme', '_s_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _s_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar left', '_s' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', '_s' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar right', '_s' ),
		'id'            => 'right',
		'description'   => esc_html__( 'Add widgets here.', '_s' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', '_s_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function _s_scripts() {
	wp_enqueue_style( '_s-style', get_stylesheet_uri() );

	wp_enqueue_script( '_s-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( '_s-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', '_s_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/*-----------------------------------------------*
* Custom functions added by T Osborne
*-----------------------------------------------*/

/* ------------------------------------------------------------------------- */
/* SHOW TEMPLATE FILE -------------------------------------------------------- */
/* Shows which template file is being used for the current page ------------ */

/*
add_action( 'admin_bar_menu', 'show_template' );
function show_template() {
global $template;
echo "<span style='margin-left:600px'>";
print_r( $template );
echo "</span>";
}

*/
/* ------------------------------------------------------------------------- */
/* EXCERPT STRIPPER -------------------------------------------------------- */
/* Removes any headings from the excerpt to improve readability ------------ */

function wp_strip_header_tags( $excerpt='' ) {

	$raw_excerpt = $excerpt;
	if ( '' == $excerpt ) {
		$excerpt = get_the_content('');
 		$excerpt = strip_shortcodes( $excerpt );
		$excerpt = apply_filters('the_content', $excerpt);
		$excerpt = str_replace(']]>', ']]&gt;', $excerpt);
	}

	$regex = '#(<h([1-6])[^>]*>)\s?(.*)?\s?(<\/h\2>)#';
			$excerpt = preg_replace($regex,'', $excerpt);
			$excerpt_length = apply_filters('excerpt_length', 45);
			$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
			$excerpt = wp_trim_words( $excerpt, $excerpt_length, $excerpt_more );
	
	return apply_filters('wp_trim_excerpt', preg_replace($regex,'', $excerpt), $raw_excerpt);
}

add_filter( 'get_the_excerpt', 'wp_strip_header_tags', 9);


/* ------------------------------------------------------------------------- */
/* SEARCHWP MODIFICATIONS -------------------------------------------------- */
/* Adjustment of SearchWP functions to improve the search results ---------- */

// enable SearchWP debugging
//add_filter( 'searchwp_debug', '__return_true' );

/*
function my_searchwp_minimum_word_length() {
  // index and search for words with at least two characters
  return 1;
}
 
add_filter( 'searchwp_minimum_word_length', 'my_searchwp_minimum_word_length' );


// FORCE AND LOGIC ONLY
add_filter( 'searchwp_and_logic_only', '__return_true' );

function my_searchwp_common_words( $terms ) {
  
  // we DO NOT want to ignore 'time' so remove it from the list of common words
  $words_to_keep = array( 'time', 'times' );
  
  $terms = array_diff( $terms, $words_to_keep );
  
  return $terms;
}

add_filter( 'searchwp_common_words', 'my_searchwp_common_words' );

//Authors

function my_searchwp_extra_metadata( $extra_meta, $post_being_indexed ) {
    
    // available author meta: http://codex.wordpress.org/Function_Reference/get_the_author_meta
    
    // retrieve the author's name(s)
    $author_nicename      = get_the_author_meta( 'user_nicename', $post_being_indexed->post_author );
    $author_display_name  = get_the_author_meta( 'display_name', $post_being_indexed->post_author );
    $author_nickname      = get_the_author_meta( 'nickname', $post_being_indexed->post_author );
    $author_first_name    = get_the_author_meta( 'first_name', $post_being_indexed->post_author );
    $author_last_name     = get_the_author_meta( 'last_name', $post_being_indexed->post_author );
    
    // grab the author bio
    $author_bio           = get_the_author_meta( 'description', $post_being_indexed->post_author );
    
    // index the author name and bio with each post
    $extra_meta['my_author_meta_nicename']     = $author_nicename;
    $extra_meta['my_author_meta_display_name'] = $author_display_name;
    $extra_meta['my_author_meta_nickname']     = $author_nickname;
    $extra_meta['my_author_meta_first_name']   = $author_first_name;
    $extra_meta['my_author_meta_last_name']    = $author_last_name;
    $extra_meta['my_author_meta_bio']          = $author_bio;
    
    return $extra_meta;
}

add_filter( 'searchwp_extra_metadata', 'my_searchwp_extra_metadata', 10, 2 );


function my_searchwp_author_meta_keys( $keys )
{
    // the keys we used to store author meta (see https://gist.github.com/jchristopher/8558947 for more info)
    $my_custom_author_meta_keys = array( 
        'my_author_meta_nicename', 
        'my_author_meta_display_name', 
        'my_author_meta_nickname', 
        'my_author_meta_first_name', 
        'my_author_meta_last_name', 
        'my_author_meta_bio' 
    );
    
    // merge my custom meta keys with the existing keys
    $keys = array_merge( $keys, $my_custom_author_meta_keys );
    
    // make sure there aren't any duplicates
    $keys = array_unique( $keys );
    
    return $keys;
}
 
add_filter( 'searchwp_custom_field_keys', 'my_searchwp_author_meta_keys', 10, 1 );
*/

/* ------------------------------------------------------------------------- */
/* CUSTOM POST TYPES ------------------------------------------------------- */
/* Register and configure custom post types -------------------------------- 

function custom_conference_in_home_loop( $query ) {
	if ( is_home() && $query->is_main_query() )  {
		$query->set( 'post_type', array( 'post', 'condition_assessment', 'xt_report', 'snippet', 'guides', 'material_handbook') ); 
			return $query; 
	} 
}
add_filter( 'pre_get_posts', 'custom_conference_in_home_loop' );



function cptui_register_my_cpts() {

	/* CONDITION ASSESSMENTS  - REMOVED as Condition Assessments are stored as XT Reports under the category Condition Assessment
	$labels = array(
		"name" => __( 'Condition Assessments', '' ),
		"singular_name" => __( 'Condition Assessment', '' ),
		"menu_name" => __( 'Condition Assessments', '' ),
		"all_items" => __( 'All Condition Assessments', '' ),
		"add_new" => __( 'Add New', '' ),
		"add_new_item" => __( 'Add New Condition Assessment', '' ),
		"edit_item" => __( 'Edit Condition Assessment', '' ),
		"new_item" => __( 'New Condition Assessment', '' ),
		"view_item" => __( 'View Condition Assessment', '' ),
		"search_items" => __( 'Search Condition Assessments', '' ),
		"not_found" => __( 'No Condition Assessments Found', '' ),
		"not_found_in_trash" => __( 'No Condition Assessments found in Trash', '' ),
		"parent_item_colon" => __( 'Parent Condition Assessment:', '' ),
		"featured_image" => __( 'Featured Image for this Condition Assessment', '' ),
		"set_featured_image" => __( 'Set Featured Image for this Condition Assessment', '' ),
		"remove_featured_image" => __( 'Remove Featured Image for this Condition Assessment', '' ),
		"use_featured_image" => __( 'Use as Featured Image for Condition Assessment', '' ),
		"archives" => __( 'Condition Assessment Archives', '' ),
		"insert_into_item" => __( 'Insert into Condition Assessment', '' ),
		"uploaded_to_this_item" => __( 'Uploaded to this Condition Assessment', '' ),
		"filter_items_list" => __( 'Filter Condition Assessment List', '' ),
		"items_list_navigation" => __( 'Condition Assessment list navigation', '' ),
		"items_list" => __( 'Condition Assessment list', '' ),
		"parent_item_colon" => __( 'Parent Condition Assessment:', '' ),
		);

	$args = array(
		"label" => __( 'Condition Assessments', '' ),
		"labels" => $labels,
		"description" => "Condition assessment report",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
				"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "condition_assessment", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 6,
		"supports" => array( "title", "editor", "thumbnail", "revisions", "author" ),		
		"taxonomies" => array( "post_tag" ),
		
		"yarpp_support" => true,
	);
	register_post_type( "condition_assessment", $args ); 


	// XT REPORTS
	$labels = array(
		"name" => __( 'XT Reports', '' ),
		"singular_name" => __( 'XT Report', '' ),
		"menu_name" => __( 'XT Reports', '' ),
		"all_items" => __( 'All XT Reports', '' ),
		"add_new" => __( 'Add New', '' ),
		"add_new_item" => __( 'Add New XT Report', '' ),
		"edit_item" => __( 'Edit XT Report', '' ),
		"new_item" => __( 'New XT Report', '' ),
		"view_item" => __( 'View XT Report', '' ),
		"search_items" => __( 'Search XT Report', '' ),
		"not_found" => __( 'No XT Reports found', '' ),
		"not_found_in_trash" => __( 'No XT Reports found in Trash', '' ),
		"parent_item_colon" => __( 'Parent XT Report:', '' ),
		"featured_image" => __( 'Featured Image for this XT Report', '' ),
		"set_featured_image" => __( 'Set Featured Image for this XT Report', '' ),
		"remove_featured_image" => __( 'Remove Featured Image for this XT Report', '' ),
		"use_featured_image" => __( 'Use as Featured Image for this XT Report', '' ),
		"archives" => __( 'XT Report Archives', '' ),
		"insert_into_item" => __( 'Insert into XT Report', '' ),
		"uploaded_to_this_item" => __( 'Uploaded to this XT Report', '' ),
		"filter_items_list" => __( 'Filter XT Report list', '' ),
		"items_list_navigation" => __( 'XT Reports list navigation', '' ),
		"items_list" => __( 'XT Reports list', '' ),
		"parent_item_colon" => __( 'Parent XT Report:', '' ),
		);

	$args = array(
		"label" => __( 'XT Reports', '' ),
		"labels" => $labels,
	//	"description" => "XT report",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
				"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "xt_report", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-admin-generic",
		"menu_position" => 5,
		"supports" => array( "title", "editor", "thumbnail", "revisions", "author", "post-formats", "comments" ),		
		"taxonomies" => array( "category", "post_tag" ),		
		"yarpp_support" => true,
		"searchwp_support" => true,
	);
	register_post_type( "xt_report", $args );


	//GUIDES
	$labels = array(
		"name" => __( 'Guides', '' ),
		"singular_name" => __( 'Guide', '' ),
		"add_new_item" => __( 'Add New Guide', '' ),

	);

	$args = array(
		"label" => __( 'Guides', '' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => array( "slug" => "guides", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-media-document",
		"menu_position" => 6,
		"supports" => array( "title", "editor", "thumbnail", "custom-fields", "author", "post-formats", "comments" ),
		"taxonomies" => array( "category", "post_tag", "project_code", "technical_area", "sales_territory" ),
		"yarpp_support" => true,
		"searchwp_support" => true,

	);

	register_post_type( "guides", $args );


	//MATERIALS HANDBOOKS
	$labels = array(
		"name" => __( "Material Handbooks", "" ),
		"singular_name" => __( "Material Handbook", "" ),
	);

	$args = array(
		"label" => __( "Material Handbooks", "" ),
		"labels" => $labels,
		"description" => "Material handbooks, created and managed by Metallurgy",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capabilities" => array(
			"edit_post" => "edit_material_handbook",
			"edit_posts" => "edit_material_handbooks",
			"edit_others_posts" => "edit_other_material_handbooks",
	        "publish_posts" => "publish_material_handbooks",
	        "read_post" => "read_material_handbook",
	        "read_private_posts" => "read_private_material_handbooks",
	        "delete_post" => "delete_material_handbook"
	        ),
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => array( "slug" => "material_handbook", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-archive",
		"menu_position" => 7,
		"supports" => array( "title", "editor", "author", "thumbnail", "revisions", "page-attributes" ),
		"taxonomies" => array( "post_tag" ),
		"yarpp_support" => true,
		"searchwp_support" => true,

	);

	register_post_type( "material_handbook", $args );

	//HEAT TREAT CODES
	$labels = array(
		"name" => __( "HT Codes", "" ),
		"singular_name" => __( "HT Codes", "" ),
	);

	$args = array(
		"label" => __( "HT Codes", "" ),
		"labels" => $labels,
		"description" => "Heat Treat Codes, created and managed by Metallurgy",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => array( "slug" => "ht_code", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-book",
		"menu_position" => 8,
		"supports" => array( "title", "editor", "author", "thumbnail", "revisions", "page-attributes" ),
		"taxonomies" => array( "post_tag" ),
		"yarpp_support" => true,
		"searchwp_support" => true,

	);

	register_post_type( "ht_code", $args );

	// SNIPPETS
	$labels = array(
		"name" => __( 'Snippets', '' ),
		"singular_name" => __( 'Snippet', '' ),
		"all_items" => __( 'All Snippets', '' ),
		"add_new" => __( 'Add New Snippet', '' ),
		"add_new_item" => __( 'Add New Snippet', '' ),
	);

	$args = array(
		"label" => __( 'Snippets', '' ),
		"labels" => $labels,
		"description" => "Short pieces of information not related to projects or reports.",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "snippet", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 8,
		"supports" => array( "title", "editor", "thumbnail", "author", " searchwp", "comments" ),
		"taxonomies" => array( "post_tag", "project_code", "technical_area" ),
		"yarpp_support" => true,
	);

	register_post_type( "snippet", $args );

	
// End of cptui_register_my_cpts()
}
add_action( 'init', 'cptui_register_my_cpts' );

// ADD CPTs TO RSS FEED

function extend_feed($qv) {
	if (isset($qv['feed']))
		$qv['post_type'] = get_post_types();
	return $qv;
}
add_filter('request', 'extend_feed');

//Register custom post types in AUTHOR, TAG and CATEGORY archives

function cpt_register_tags( $query ) {
    if ( $query->is_tag() && $query->is_main_query() || $query->is_category() && $query->is_main_query() || $query->is_author() && $query->is_main_query() ) {
        $query->set( 'post_type', array( 'post', 'xt_report', /*'condition_assessment', 'snippet', 'guides', 'material_handbook', 'ht_code' ) );
    }
}
add_action( 'pre_get_posts', 'cpt_register_tags' );

//Add custom post types to archive widget drop down
add_filter( 'getarchives_where', 'custom_getarchives_where' );
function custom_getarchives_where( $where ){
    $where = str_replace( "post_type = 'post'", "post_type IN ( 'post', 'xt_report', 'snippet', 'guides', 'material_handbook', 'ht_code' )", $where );
    return $where;
}




//REGISTER TAXONOMIES
add_action( 'init', 'cptui_register_my_taxes' );
function cptui_register_my_taxes() {

	//SALES TERRITORIES -> XT Reports, Guides
	$labels = array(
		"name" => __( 'Sales Territories', '' ),
		"singular_name" => __( 'Sales Territory', '' ),
		);

	$args = array(
		"label" => __( 'Sales Territories', '' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Sales Territories",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'sales_territory', 'with_front' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "sales_territory", array( /*"condition_assessment", "xt_report", "guides"), $args );
	
	
	//PROJECT CODES -> XT Reports, Guides, Snippets
	$labels = array(
		"name" => __( 'Project Codes', '' ),
		"singular_name" => __( 'Project Code', '' ),
		"separate_items_with_commas" => __( 'Separate with commas', '' ),
		);

	$args = array(
		"label" => __( 'Project Codes', '' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => false,
		"label" => "Project Codes",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'project_code', 'with_front' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "project_code", array( /*"condition_assessment", "xt_report", "guides", "snippet" ), $args );
	
	
	//TECHNICAL AREAS -> XT Reports, Guides, Snippets
	$labels = array(
		"name" => __( 'Technical Areas', '' ),
		"singular_name" => __( 'Technical Area', '' ),
		);

	$args = array(
		"label" => __( 'Technical Areas', '' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Technical Areas",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'technical_area', 'with_front' => true,  'hierarchical' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "technical_area", array( /*"condition_assessment", "xt_report", "guides", "snippet" ), $args );

// End cptui_register_my_taxes()
}


/* ------------------------------------------------------------------------- */
/* BREADCRUMBS ------------------------------------------------------------- */
/* Displays breadcrumb links above any post or page  ----------------------- */

function custom_breadcrumbs() {
       
    // Settings
    $separator          = '»';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = 'Home';
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'technical_area';
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() ) {
       
        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
           
        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';
           
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
              
            echo '<li class="item-current item-archive"><span class="bread-current bread-archive">' . post_type_archive_title('', false) . '</span></li>';
              
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><span class="bread-current bread-archive">' . $custom_tax_name . '</span></li>';
              
        } else if ( is_single() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            // Get post category info
            $category = get_the_category();
             
            if(!empty($category)) {
              
                // Get last category post is in
                $cat_values = array_values($category);
                $last_category = end($cat_values);
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists ) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                
                if( !empty($taxonomy_terms) ) {
	                $cat_id         = $taxonomy_terms[0]->term_id;
	                $cat_nicename   = $taxonomy_terms[0]->slug;
	                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
	                $cat_name       = $taxonomy_terms[0]->name;
               }
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';
              
            } else {
                  
                echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';
                  
            }
              
        } else if ( is_category() ) {

            // Get post category info
            $category = get_the_category();
            
            if(!empty($category)) {
              
                // Get last category post is in
                $cat_values = array_values($category);
                $last_category = end($cat_values);
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                  	$cat_display .= '<li class="item-cat">'.$parents.'</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }
             
            
			}

            // Category page
            echo $cat_display;
            echo '<li class="item-current item-cat"><span class="bread-current bread-cat">' . single_cat_title('', false) . '</span></li>';
               
        } else if ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                   
                // Display parent pages
                echo $parents;
                   
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><span title="' . get_the_title() . '"> ' . get_the_title() . '</span></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</span></li>';
                   
            }
               
        } else if ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><span class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</span></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
               
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><span class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</span></li>';
               
        } else if ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><span class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</span></li>';
               
        } else if ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><span class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</span></li>';
               
        } else if ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
               
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><span class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</span></li>';
           
        } else if ( get_query_var('paged') ) {
               
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><span class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</span></li>';
               
        } else if ( is_search() ) {
           
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><span class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</span></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }
       
        echo '</ul>';
           
    }
       
} //end breadcrumbs

/*--------------------------------------------------------------*/
/* POSTS TO POSTS-----------------------------------------------*/
/*--------------------------------------------------------------*/

/*function my_connection_types() {
    p2p_register_connection_type( array(
        'name' 	=> 'posts_to_pages',
        'from'	=> 'post',
        'to' 	=> 'page'
    ) );
}
add_action( 'p2p_init', 'my_connection_types' ); */


add_action( 'mb_relationships_init', function() {
    MB_Relationships_API::register( array(
        'id'   => 'pages_to_posts',
        'from' => 'page',
        'to'   => 'post',
    ) );
} );

/*--------------------------------------------------------------*/
/* PAGINATION-----------------------------------------------*/
/*--------------------------------------------------------------*/

if ( ! function_exists( 'xtracONE_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 * Based on paging nav function from Twenty Fourteen
 */

function xtracONE_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 2,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'yourtheme' ),
		'next_text' => __( 'Next &rarr;', 'yourtheme' ),
		'type'      => 'list',
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'yourtheme' ); ?></h1>
			<?php echo $links; ?>
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;

/*--------------------------------------------------------------*/
/* AUTHOR BIO WIDGET--------------------------------------------*/
/*--------------------------------------------------------------*/

class TO_Author_Bio_Widget extends WP_Widget {

/* A simple widget to display author name, job title and email link */

	public function __construct() {
		$widget_options = array(
			'classname' => 'TO_author_bio_widget',
			'description' => 'TO Author Bio Widget',
		);
		parent::__construct( 
			'TO_author_bio_widget', // ID
			'Author Bio Widget',	// Name
			$widget_options 
		);
	}


	/* Widget front end display*/
	
	public function widget( $args, $instance ) {
	
	if (get_the_author_meta('description')) : // Checking if the user has added any author descript or not. If it is added only, then lets move ahead ?>
	    <div class="author-box">
	        <h3 class="author-name"><?php esc_html(the_author_meta('display_name')); // Displays the author name of the posts ?></h3>
	        <p class="author-description"><strong>Job Title: </strong><?php esc_textarea(the_author_meta('description')); // Displays the author description added in Biographical Info ?></p>
	        <a href="mailto:<?php esc_html(the_author_meta('user_email')); // Displays the author description added in Biographical Info ?>">Email <?php esc_html(the_author_meta('display_name')); ?></a>
	    </div>
	<?php endif;
	}

	/* Widget back end display */
	
	 public function form( $instance ) {
	
	  $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
	  <p>
	    <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
	    <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
	  </p><?php 
	
	}



}

// register TO_Author_Bio_Widget widget
function register_TO_Author_Bio_Widget() {
    register_widget( 'TO_Author_Bio_Widget' );
}
add_action( 'widgets_init', 'register_TO_Author_Bio_Widget' );


/*--------------------------------------------------------------*/
/* RELEVANSSI-----------------------------------------------*/
/*--------------------------------------------------------------*/
add_action( 'init', 'switch_search_meter_priority' );
function switch_search_meter_priority() {
    remove_filter( 'the_posts', 'tguy_sm_save_search', 20 );
    add_filter( 'the_posts', 'tguy_sm_save_search', 100 );
}

add_filter( 'relevanssi_match', 'post_type_extra_weight' );
function post_type_extra_weight( $match ) {
	$post_type = relevanssi_get_post_type( $match->doc );
	if ( 'material_handbook' === $post_type ) {
		$match->weight = $match->weight * 1.5;
	}elseif ( $post_type === 'guides' ) {
		$match->weight = $match->weight * 2;
	}
	return $match;
}

add_filter('relevanssi_hits_filter', 'rlv_gather_categories', 99);
function rlv_gather_categories($hits) {
    global $rlv_categories_present;
    $rlv_categories_present = array();
    foreach ( $hits[0] as $hit ) {
        $terms = get_the_terms( $hit->ID, 'category' );
        if (is_array($terms)) {
            foreach ( $terms as $term ) {
                $rlv_categories_present[ $term->term_id ] = $term->name;
            }
        }
    }
    asort( $rlv_categories_present );
    return $hits;
}

function rlv_category_dropdown() {
    global $rlv_categories_present, $wp_query;
 
    if (!empty($wp_query->query_vars['cat'])) {
        $url = esc_url(remove_query_arg('cat')); ?>
        
        Filtering by Category: <?php global $wp_query;
		$category = get_category($wp_query->query_vars['cat']);
		echo '<strong>'.$category->cat_name.'</strong>';
        
        echo "<p><a class='button-green' href='$url'>Remove category filter</a></p>";
    }
    else {
        $select = "<select id='rlv_cat' name='rlv_cat'><option value=''>Filter results by category...</option>";
        foreach ( $rlv_categories_present as $cat_id => $cat_name ) {
            $select .= "<option value='$cat_id'>$cat_name</option>";
        }
        $select .= "</select>";
        $url = esc_url(remove_query_arg('paged'));
        if (strpos($url, 'page') !== false) {
            $url = preg_replace('/page\/\d+\//', '', $url);
        }
        $select .= <<<EOH
 
<script>
<!--
    var dropdown = document.getElementById("rlv_cat");
    function onCatChange() {
        if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
            location.href = "$url"+"&cat="+dropdown.options[dropdown.selectedIndex].value;
        }
    }
    dropdown.onchange = onCatChange;
-->
</script>
EOH;
 
        echo $select;
    }
}


add_filter('relevanssi_hits_filter', 'search_result_types');
function search_result_types( $hits ) {
    global $hns_search_result_type_counts, $wp_query, $rlv_doing_this_already;
 
    if (!$rlv_doing_this_already && $wp_query->query_vars['post_type'] != 'any') {
    	$copy_query = $wp_query;
    	$copy_query->query_vars['post_type'] = "any";
    	$rlv_doing_this_already = true;
    	relevanssi_do_query($copy_query);
    	return $hits;
    }
 
    $types = array();
    if ( ! empty( $hits ) ) {
        foreach ( $hits[0] as $hit ) {
            $types[$hit->post_type]++;
        }
    }
 
    $hns_search_result_type_counts = $types;
    return $hits;
}


/***********************************************
 * ACF Repeater Sort
 ***********************************************/
function my_acf_load_value( $value, $post_id, $field ) {
	
	// vars
	$order = array();
		
	// bail early if no value
	if( empty($value) ) {
		return $value;
	}
	
	// populate order
	foreach( $value as $i => $row ) {
		$order[ $i ] = $row['field_5fcf810d5b7fc'];
	}
	
	// multisort
	array_multisort( $order, SORT_ASC, $value );
		
	// return	
	return $value;
}
add_filter('acf/load_value/name=glossary_term_repeater', 'my_acf_load_value', 10, 3);
?>