<header class="header">
    <h1><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
    <?php //bloginfo( 'description' ); ?>
    <?php //get_search_form(); ?>
</header>
<!-- <div class="show-menu clear"><i class="fa fa-bars"></i></div> -->
<nav class="nav">
    <?php wp_nav_menu( array(  'theme_location' => 'primary' ) ); ?>
</nav>
<div class="clear"></div>
