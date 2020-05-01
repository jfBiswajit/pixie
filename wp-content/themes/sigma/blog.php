<div class="blog-article new-style <?php if(! has_post_thumbnail() ) echo 'p-t30'?>">
	<?php if( has_post_thumbnail() ):?>
    <div class="blog-article-thumbnail">

        <a class="date" href="<?php echo get_month_link(get_the_date('Y'), get_the_date('m')); ?>"><small><?php echo get_the_date('M');?></small> <span><?php echo get_the_date('d');?></span> <small><?php echo get_the_date('Y');?></small></a>
        <a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php the_post_thumbnail('sigma_1170x500')?></a>

    </div><!-- blog-article-thumbnail -->
    <?php endif;?>
    
	<div class="blog-content-inner">
        <ul class="blog-article-details p-l80">
            <li><i class="fa fa-user"></i><a class="author bg-grip" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author();?></a></li>
            <li><i class="fa fa-comments"></i><a class="comments bg-grip" href="<?php echo esc_url(get_permalink(get_the_id()).'#comments'); ?>"><?php comments_number( wp_kses_post(__('0 Comments' , 'sigma')), wp_kses_post(__('1 Comment' , 'sigma')), wp_kses_post(__('% Comments' , 'sigma'))); ?></a></li>
            <li><i class="fa fa-tags"></i><?php the_category();?></li>
        </ul><!-- blog-article-details -->
        <h5 class="blog-article-title cap"><a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php the_title();?></a></h5>
    
        <div class="blog-article-content">
    
            <?php the_excerpt(); ?>
            <div class="btn-detail">
            	<a class="btn btn-default-1 waves c-w" href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php esc_html_e( 'Read More', 'sigma' );?></a>
    		</div>
        </div><!-- blog-article-content -->
	</div>
</div><!-- blog-article -->