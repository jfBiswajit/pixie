<?php /* Template Name: King Composer Page */
	get_header();
	$meta = _WSH()->get_meta('_bunch_header_settings');
	$title = sigma_set($meta, 'header_title');
?>
<?php if(sigma_set($meta, 'breadcrumb')):?>
<!--Start breadcrumb area-->
<div id="page-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
    
                <h3><?php if($title) echo wp_kses_post($title); else wp_title(''); ?></h3>
    
            </div><!-- col -->
        </div><!-- row -->
    </div>
</div>
<!--End breadcrumb area-->
<?php endif; ?>
<?php while( have_posts() ): the_post(); ?>
    <?php the_content(); ?>
<?php endwhile;  ?>
<?php get_footer(); ?>