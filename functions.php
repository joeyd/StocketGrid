<?php

// Support/filters
//---------------------------------------------
//---------------------------------------------
add_editor_style('editorstyle.css');
add_theme_support('post-thumbnails');
add_filter( 'body_class', 'add_slug_to_body_class' );
add_filter('widget_text', 'do_shortcode');
//add_image_size( $name, $width, $height, $crop );


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


// Load Styles/Scripts
//---------------------------------------------
//---------------------------------------------

function nolo_sg_script_enqueuer() {
	wp_register_script( 'fitvids', get_template_directory_uri().'/js/plugins/fitvids.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'fitvids' );

	wp_register_script( 'site', get_template_directory_uri().'/js/site.js', array( 'fitvids' ), '1.0', true );
	wp_enqueue_script( 'site' );

	wp_register_style( 'screen', get_template_directory_uri().'/style.css', '', '2.0', 'all' );
	wp_enqueue_style( 'screen' );
}
add_action( 'wp_enqueue_scripts', 'nolo_sg_script_enqueuer' );

// Disable Woocommerce Styles
//---------------------------------------------
//---------------------------------------------
// Remove each style one by one
// add_filter( 'woocommerce_enqueue_styles', 'wjd_dequeue_woo_styles' );
// function wjd_dequeue_woo_styles( $enqueue_styles ) {
// 	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
// 	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
// 	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
// 	return $enqueue_styles;
// }
// Or just remove them all in one line
//add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Define Menus
//---------------------------------------------
//---------------------------------------------

//register multiple menus
// register_nav_menus( array(
// 	'blog_pages' => 'Blog Pages',
// 	'primary' => 'Primary Pages'
// ) );

// If you want to define a class for your menu
// function add_menuclass($ulclass) {
// 	return preg_replace('/<ul>/', '<ul class="nav">', $ulclass, 1);
// }
// add_filter('wp_page_menu','add_menuclass');
//


// function be_customize_subpage_classes( $classes, $subpage ) {
// 	global $post;
//     //$parents = get_post_ancestors( $post );
// 	$parent = get_page( $id );
// 	$class = 'parent';

// if( $subpage->ID == $post->ID ) {
// 	if ( $subpage->ID && $post->post_parent > 0 ) {
// 	    echo "This is a child page";
//     	var_dump($subpage->ID);
//         $classes[] = $class;
// 	}
// }
//     return $classes;
// }
// add_filter( 'be_subpages_widget_class', 'be_customize_subpage_classes', 10, 2 );


// Additional Menu Functions
//---------------------------------------------
//---------------------------------------------

// If using the responsive nav pattern

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


// Shortcodes
//---------------------------------------------
//---------------------------------------------


// Define Sidebars
//---------------------------------------------
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
add_action( 'widgets_init', 'nology_widgets_init' );



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
