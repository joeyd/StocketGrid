<?php get_template_parts( array( 'incs/html-header', 'incs/header' ) ); ?>

    <?php //get_template_parts( array( 'incs/sidebar-pages' ) ); ?>

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
        <?php //comments_template( '', true ); ?>

    <?php endwhile; ?>

<?php get_template_parts( array( 'incs/footer','incs/html-footer' ) ); ?>
