<?php
  /*
  Template Name: Home Page
  */
?>
<?php get_template_parts( array( 'incs/html-header', 'incs/header' ) ); ?>

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>
    <?php endwhile; ?>

<?php get_template_parts( array( 'incs/footer','incs/html-footer' ) ); ?>
