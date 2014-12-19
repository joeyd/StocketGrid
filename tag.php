<?php get_template_parts( array( 'incs/html-header', 'incs/header' ) ); ?>

    <?php if ( have_posts() ): ?>
    <h1>Tag Archive: <?php echo single_tag_title( '', false ); ?></h1>
    <?php while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    	<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
    	<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time> <?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
    	<?php the_content(); ?>
    </article>
    <?php endwhile; ?>
    <?php else: ?>
    <h1>No posts to display in <?php echo single_tag_title( '', false ); ?></h1>
    <?php endif; ?>

<?php get_template_parts( array( 'incs/footer','incs/html-footer' ) ); ?>
