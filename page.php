<?php get_template_parts( array( 'incs/html-header', 'incs/header' ) ); ?>
    <div class="sidebar">
        <?php get_template_parts( array( 'incs/sidebar-pages') ); ?>
    </div>
    <div class="content">
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
        <?php //comments_template( '', true ); ?>
        <?php endwhile; ?>
    </div>
<?php get_template_parts( array( 'incs/footer','incs/html-footer' ) ); ?>
