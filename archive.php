<?php get_template_parts( array( 'incs/html-header', 'incs/header' ) ); ?>

<?php if ( have_posts() ): ?>

    <?php if ( is_day() ) : ?>
        <h2>Archive: <?php echo  get_the_date( 'D M Y' ); ?></h2>
        <?php elseif ( is_month() ) : ?>
        <h1>Archive: <?php echo  get_the_date( 'M Y' ); ?></h1>
        <?php elseif ( is_year() ) : ?>
        <h1>Archive: <?php echo  get_the_date( 'Y' ); ?></h1>
        <?php else : ?>
        <h1>Archive</h1>
    <?php endif; ?>

    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            <time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time> <?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
            <?php the_content(); ?>
        </article>
    <?php endwhile; ?>

<?php else: ?>
<h2>No posts to display</h2>
<?php endif; ?>

<?php get_template_parts( array( 'incs/footer','incs/html-footer' ) ); ?>
