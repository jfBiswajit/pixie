<?php $options = _WSH()->option();
	get_header(); 
	$settings  = sigma_set(sigma_set(get_post_meta(get_the_ID(), 'bunch_page_meta', true) , 'bunch_page_options') , 0);
	$meta = _WSH()->get_meta('_bunch_layout_settings');
	$meta1 = _WSH()->get_meta('_bunch_header_settings');
	$meta2 = _WSH()->get_meta();
	_WSH()->page_settings = $meta;
	$bg = sigma_set($meta1, 'header_img');
	$title = sigma_set($meta1, 'header_title');
?>
<!--Start breadcrumb area-->     
<section class="breadcrumb-area" <?php if($bg):?>style="background-image:url('<?php echo esc_attr($bg)?>');"<?php endif; ?>>
	<div class="container-fluid text-center">
		<h1><?php if($title) echo wp_kses_post($title); else wp_title(''); ?></h1>
		<div class="breadcrumb-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="left pull-left">
                            <?php echo wp_kses_post(sigma_get_the_breadcrumb()); ?>
                        </div>
                        <?php if(sigma_set($meta1, 'quote_link')){ ?>
                        <div class="right pull-right">
                            <a href="<?php echo wp_kses_post(sigma_set($meta1, 'quote_link')); ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i><?php esc_html_e('Get a Quote', 'sigma'); ?></a>
                        </div> 
                        <?php } ?>   
                    </div>
                </div>
            </div>
		</div>
	</div>
</section>
<!--End breadcrumb area-->

<?php while( have_posts() ): the_post();
global $post;
$projects_meta = _WSH()->get_meta();
$page_style = sigma_set($projects_meta, 'project_page_style');
$projects_image = sigma_set($projects_meta, 'bunch_projects_image');
$related_data = sigma_set($projects_meta, 'bunch_related_projects');
$term_list = wp_get_post_terms(get_the_id(), 'projects_category', array("fields" => "names"));
if($page_style == 'style1') { ?>
<!--Start project single v1 area-->
<section id="project-single-area" class="project-single-v1-area">
    <div class="container">
        <!--Start project carousel-->
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div id="project-single-carousel" class="carousel slide" data-ride="carousel">
                    <?php $i=0; if(!empty($portfolio_img)): ?>
                    <ol class="carousel-indicators">
                        <?php foreach($portfolio_img as $key => $value):?>
                        <li data-target="#project-single-carousel" data-slide-to="<?php echo esc_attr($i); ?>" <?php if($i == 0){ echo 'class="active"'; } ?>></li>
                        <?php $i++; endforeach; ?>
                    </ol>
                    <?php endif; ?>
                    
                    <?php $i=0; if(!empty($portfolio_img)): ?>
                    <div class="carousel-inner" role="listbox">
                    	<?php foreach($portfolio_img as $key => $value): ?>
                        <div class="item <?php if($i == 0){ echo 'active'; } ?>">
                            <div class="single-item">
                                <div class="img-holder">
                                    <img src="<?php echo esc_url(sigma_set($value, 'projects_image')); ?>" alt="<?php esc_attr_e('Awesome Image', 'sigma'); ?>">
                                </div>
                            </div>
                        </div>
                        <?php $i++; endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="project-info">
                    <h3><?php esc_html_e('Project Info', 'sigma'); ?></h3>
                    <?php the_content(); ?>
                    <ul class="project-info-list">
                        <li>
                            <div class="icon-holder">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </div>
                            <div class="text-holder">
                                <h5><?php esc_html_e('Client', 'sigma'); ?></h5>
                                <p><?php echo wp_kses_post(sigma_set($projects_meta, 'client')); ?></p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-holder">
                                <i class="fa fa-folder-open" aria-hidden="true"></i>
                            </div>
                            <div class="text-holder">
                                <h5><?php esc_html_e('Category', 'sigma'); ?></h5>
                                <p><?php echo implode( ', ', (array)$term_list ); ?></p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-holder">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </div>
                            <div class="text-holder">
                                <h5><?php esc_html_e('Start Date', 'sigma'); ?></h5>
                                <p><?php echo wp_kses_post(sigma_set($projects_meta, 'start_date')); ?></p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-holder">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </div>
                            <div class="text-holder">
                                <h5><?php esc_html_e('End Date', 'sigma'); ?></h5>
                                <p><?php echo wp_kses_post(sigma_set($projects_meta, 'end_date')); ?></p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-holder">
                                <i class="fa fa-usd" aria-hidden="true"></i>
                            </div>
                            <div class="text-holder">
                                <h5><?php esc_html_e('Project Value', 'sigma'); ?></h5>
                                <p><?php echo wp_kses_post(sigma_set($projects_meta, 'price')); ?></p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-holder">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                            </div>
                            <div class="text-holder">
                                <h5><?php esc_html_e('Location', 'sigma'); ?></h5>
                                <p><?php echo wp_kses_post(sigma_set($projects_meta, 'location')); ?></p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--End project carousel-->
        <!--Start project description content-->
        <div class="row">
            <div class="col-md-12">
                <div class="project-description-content">
                    <h3><?php esc_html_e('Project Description', 'sigma'); ?></h3>
                    <?php echo wp_kses_post(sigma_set($projects_meta, 'project_description')); ?>
                </div>
            </div>
        </div>
        <!--End project description content-->
        <!--Start related project items-->
        <div class="row">
            <div class="related-project-items">
                <div class="sec-title text-center">
                    <h2><?php esc_html_e('Related Projects', 'sigma'); ?></h2>
                </div>
                <?php $i=0; if(!empty($related_data)):
				foreach($related_data as $key => $value): ?>
                <!--Start single project item-->
                <div class="col-md-4">
                    <div class="single-project-item">
                        <div class="img-holder">
                            <img src="<?php echo esc_url(sigma_set($value, 'related_image')); ?>" alt="<?php esc_attr_e('Awesome Image', 'sigma'); ?>">
                            <div class="overlay">
                                <div class="box">
                                    <div class="content">
                                        <div class="icon-holder">
                                            <a href="<?php echo esc_url(sigma_set($value, 'related_url')); ?>" data-rel="prettyPhoto" title="<?php esc_attr_e('Interrio Project', 'sigma'); ?>"><span class="flaticon-cross"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-holder">
                            <h3><a href="<?php echo esc_url(sigma_set($value, 'related_url')); ?>"><?php echo wp_kses_post(sigma_set($value, 'related_title')); ?></a></h3>
                            <p><?php echo wp_kses_post(sigma_set($value, 'related_category')); ?></p>
                        </div>   
                    </div>
                </div>
                <!--End single project item-->
                <?php $i++; endforeach; endif; ?>
            </div>
        </div>
        <!--End related project items-->        
    </div>
</section>
<!--End project single v1 area-->
<?php }else{ ?>
<!--Start project single v2 area-->
<section id="project-single-area" class="project-single-v2-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
            	<?php $i=0; if(!empty($portfolio_img)):
				foreach($portfolio_img as $key => $value):?>
                <!--Start single project item-->
                <div class="single-project-item">
                    <div class="img-holder">
                        <img src="<?php echo esc_url(sigma_set($value, 'projects_image')); ?>" alt="<?php esc_attr_e('Awesome Image', 'sigma'); ?>">
                        <div class="overlay">
                            <div class="box">
                                <div class="content">
                                    <div class="icon-holder">
                                        <a href="<?php echo esc_url(sigma_set($value, 'projects_image')); ?>" data-rel="prettyPhoto" title="<?php esc_attr_e('Interrio Project', 'sigma'); ?>"><span class="flaticon-magnifying-glass"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <!--End single project item-->
                <?php $i++; endforeach; endif; ?>
            </div>
            <div class="col-md-4">
                <div class="project-info">
                    <h3><?php esc_html_e('About Project', 'sigma'); ?></h3>
                    <?php the_content(); ?>
                    <ul class="project-info-list">
                        <li>
                            <div class="icon-holder">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </div>
                            <div class="text-holder">
                                <h5><?php esc_html_e('Client', 'sigma'); ?></h5>
                                <p><?php echo wp_kses_post(sigma_set($projects_meta, 'client')); ?></p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-holder">
                                <i class="fa fa-folder-open" aria-hidden="true"></i>
                            </div>
                            <div class="text-holder">
                                <h5><?php esc_html_e('Category', 'sigma'); ?></h5>
                                <p><?php echo implode( ', ', (array)$term_list ); ?></p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-holder">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </div>
                            <div class="text-holder">
                                <h5><?php esc_html_e('Start Date', 'sigma'); ?></h5>
                                <p><?php echo wp_kses_post(sigma_set($projects_meta, 'start_date')); ?></p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-holder">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </div>
                            <div class="text-holder">
                                <h5><?php esc_html_e('End Date', 'sigma'); ?></h5>
                                <p><?php echo wp_kses_post(sigma_set($projects_meta, 'end_date')); ?></p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-holder">
                                <i class="fa fa-usd" aria-hidden="true"></i>
                            </div>
                            <div class="text-holder">
                                <h5><?php esc_html_e('Project Value', 'sigma'); ?></h5>
                                <p><?php echo wp_kses_post(sigma_set($projects_meta, 'price')); ?></p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-holder">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                            </div>
                            <div class="text-holder">
                                <h5><?php esc_html_e('Location', 'sigma'); ?></h5>
                                <p><?php echo wp_kses_post(sigma_set($projects_meta, 'location')); ?></p>
                            </div>
                        </li>
                    </ul>
                    <div class="share-project">
                        <div class="title">
                            <h5><?php esc_html_e('share this project', 'sigma'); ?></h5>
                        </div>
                        <div class="social-share">
                            <ul>
                            	<li><a href="http://www.facebook.com/sharer.php?u=<?php echo esc_url(get_permalink(get_the_id())); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://twitter.com/share?url=<?php echo esc_url(get_permalink(get_the_id())); ?>&text=<?php echo esc_attr($post_slug=$post->post_name); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://plus.google.com/share?url=<?php echo esc_url(get_permalink(get_the_id())); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="http://www.linkedin.com/shareArticle?url=<?php echo esc_url(get_permalink(get_the_id())); ?>&title=<?php echo esc_attr($post_slug=$post->post_name); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row bottom">
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="button prev pull-left">
                	<?php previous_post_link('%link','<i class="fa fa-angle-left" aria-hidden="true"></i>Prev'); ?>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="icon-holder text-center">
                    <a href="#">
                        <i class="fa fa-th" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="button next pull-right">
                	<?php next_post_link('%link','Next<i class="fa fa-angle-right" aria-hidden="true"></i>'); ?>
                </div>
            </div>
        </div>                                          
    </div>
</section>
<!--End project single v2 area-->
<?php } ?>
<?php endwhile; ?>

<?php get_footer(); ?>