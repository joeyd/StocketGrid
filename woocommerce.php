<?php get_template_parts( array( 'incs/html-header', 'incs/header' ) ); ?>
<div class="">
    <div class="left col">
        <h3><?php get_template_parts( array('incs/sidebar-pages' ) ); ?></h3>
    </div>
    <div class="content col">
        <?php woocommerce_content(); ?>
    </div>
</div>
 <div class="clear"></div>
<?php get_template_parts( array( 'incs/footer','incs/html-footer' ) ); ?>
