<?php

// Support/actions/filters
//---------------------------------------------
add_editor_style('editorstyle.css');
add_theme_support('post-thumbnails');
add_filter( 'body_class', 'add_slug_to_body_class' );
add_action( 'wp_enqueue_scripts', 'script_enqueuer' );
add_action( 'widgets_init', 'nology_widgets_init' );
add_filter('widget_text', 'do_shortcode');

// Load Styles/Scripts
//---------------------------------------------

function script_enqueuer() {
	wp_register_script( 'site', get_template_directory_uri().'/js/site.js', array( 'jquery' ) );
	wp_enqueue_script( 'site' );

	wp_register_script( 'vids', get_template_directory_uri().'/js/fitvids.js', array( 'jquery' ) );
	wp_enqueue_script( 'vids' );

	wp_register_style( 'screen', get_template_directory_uri().'/style.css', '', '', 'all' );
	wp_enqueue_style( 'screen' );
}

// Define Menus
//---------------------------------------------

//register multiple menus
// register_nav_menus( array(
// 		//'blog_pages' => 'Blog Pages',
// 		'primary' => 'Primary Pages'
// 	) );

// If you want to define a class for your menu
// function add_menuclass($ulclass) {
// 	return preg_replace('/<ul>/', '<ul class="nav">', $ulclass, 1);
// }
// add_filter('wp_page_menu','add_menuclass');


// Shortcodes
//---------------------------------------------


// Define Sidebars
//---------------------------------------------

function nology_widgets_init() {

	register_sidebar(array(
		'name' => __( 'Pages Sidebar' ),
		'id' => 'pages-widget-area',
		'description' => __( 'The sub nav widget area' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		));

	register_sidebar(array(
		'name' => __( 'Blog Sidebar' ),
		'id' => 'blog-widget-area',
		'description' => __( 'The blog widget area' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		));
}

// Additional Functions
//---------------------------------------------

// If using responsive nav pattern

// function add_menuclass($ulclass) {
// return preg_replace('/<ul>/', '<ul class="nav">', $ulclass, 1);
// }
// add_filter('wp_page_menu','add_menuclass');


//if using BE Subpages Plugin
// function be_subpages_menu_order( $args ) {
// 	$args['sort_column'] = 'menu_order';
// 	return $args;
// }
// add_filter( 'be_subpages_widget_args', 'be_subpages_menu_order' );


// Based on Starkers' Utilities/Functions
//---------------------------------------------

function get_template_parts( $parts = array() ) {
	foreach( $parts as $part ) {
		get_template_part( $part );
	};
}

function add_slug_to_body_class( $classes ) {
global $post;
if( is_home() ) {
	$key = array_search( 'blog', $classes );
	if($key > -1) {
		unset( $classes[$key] );
	};
} elseif( is_page() ) {
	$classes[] = sanitize_html_class( $post->post_name );
} elseif(is_singular()) {
	$classes[] = sanitize_html_class( $post->post_name );
};
return $classes;
}

function get_category_id( $cat_name ){
	$term = get_term_by( 'name', $cat_name, 'category' );
	return $term->term_id;
}

function starkers_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>
	<?php if ( $comment->comment_approved == '1' ): ?>
	<li>
		<?php echo get_avatar( $comment ); ?>
		<h4><?php comment_author_link() ?></h4>
		<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
		<div class="clear"></div>
		<article id="comment-<?php comment_ID() ?>">
			<?php comment_text() ?>
		</article>
	<?php endif;
}
