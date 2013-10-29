<header>
    <h1><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
    <?php bloginfo( 'description' ); ?>
    <?php get_search_form(); ?>
</header>
<nav>
    <?php wp_nav_menu( array(  'theme_location' => 'primary' ) ); ?>
</nav>
<div class="clear"></div>
