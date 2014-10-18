<?php get_template_parts( array( 'incs/html-header', 'incs/header' ) ); ?>
    <div class="sidebar">
        <?php get_template_parts( array( 'incs/sidebar-pages') ); ?>
    </div>
    <div class="content">
        <?php woocommerce_content(); ?>
    </div>
     <div class="clear"></div>
<?php get_template_parts( array( 'incs/footer','incs/html-footer' ) ); ?>
