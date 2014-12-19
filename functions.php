<?php

//---------------------------------------------
//---------------------------------------------
// SECURITY NOTE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// If you re not using a security plugin (Sucuri
// is good) to harden WordPrss, be sure to
// include the DISALLOW_FILE_EDIT to wp-config.php.
// >> define( 'DISALLOW_FILE_EDIT', true );
// END SECURITY NOTE!!!!!!!!!!!!!!!!!!!!!!!!!!!
//---------------------------------------------
//---------------------------------------------

// Support/filters
//---------------------------------------------
//---------------------------------------------
add_filter( 'xmlrpc_methods', function( $methods ) {
   unset( $methods['pingback.ping'] );
   unset( $methods['pingback.extensions.getPingbacks'] );
   return $methods;
});
add_editor_style('editorstyle.css');
add_theme_support('post-thumbnails');
add_filter( 'body_class', 'add_slug_to_body_class' );
add_filter('widget_text', 'do_shortcode');
//add_image_size( $name, $width, $height, $crop );

// Load Styles/Scripts
//---------------------------------------------
//---------------------------------------------

function script_enqueuer_tzo() {
	wp_register_script( 'fitvids', get_template_directory_uri().'/js/plugins/fitvids.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'fitvids' );

	wp_register_script( 'site', get_template_directory_uri().'/js/site.js', array( 'fitvids' ), '1.0', true );
	wp_enqueue_script( 'site' );

	wp_register_style( 'screen', get_template_directory_uri().'/style.css', '', '2.0', 'all' );
	wp_enqueue_style( 'screen' );
}
add_action( 'wp_enqueue_scripts', 'script_enqueuer_tzo' );


// Define Menus
//---------------------------------------------
//---------------------------------------------

//register multiple menus
// register_nav_menus( array(
// 	'blog_pages' => 'Blog Pages',
// 	'primary' => 'Primary Pages'
// ) );

// Shortcodes
//---------------------------------------------
//---------------------------------------------


// Define Sidebars
//---------------------------------------------
//---------------------------------------------

function widgets_init_tzo() {

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
add_action( 'widgets_init', 'widgets_init_tzo' );

// Define CPTs
//---------------------------------------------
//---------------------------------------------



// Based on Starkers' Utilities/Functions
//---------------------------------------------
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

function get_page_id_from_path( $path ) {
	$page = get_page_by_path( $path );
	if( $page ) {
		return $page->ID;
	} else {
		return null;
	};
}

function starkers_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>
	<?php if ( $comment->comment_approved == '1' ): ?>
	<li>
		<article id="comment-<?php comment_ID() ?>">
			<?php echo get_avatar( $comment ); ?>
			<h4><?php comment_author_link() ?></h4>
			<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
			<?php comment_text() ?>
		</article>
	<?php endif;
}

// Internal use
//get_template_parts( array( 'incs/admin/admin-login') );
