<?php $options = _WSH()->option();
get_header();
$title = (sigma_set($options, '404_banner_title'));
$page_title = (sigma_set($options, '404_page_title'));
$page_tagline = (sigma_set($options, '404_page_tagline'));
$page_text = (sigma_set($options, '404_page_text'));  ?>

<!--Page Title-->
<div id="page-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
    
                <h3><?php if($title) echo wp_kses_post($title); else wp_title(''); ?></h3>
    
            </div><!-- col -->
        </div><!-- row -->
    </div>
</div>
<!--End Page Title-->

<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">

            <h1 class="text-error"><?php if($page_title) echo wp_kses_post($page_title); else esc_html_e('404', 'sigma'); ?></h1>

            <h3><?php if($page_tagline) echo wp_kses_post($page_tagline); else esc_html_e('The page you are looking for could not be found', 'sigma'); ?></h3>
            <p><?php if($page_text) echo wp_kses_post($page_text); else esc_html_e('Sorry, we can’t find the page you were looking for.', 'sigma'); ?></p>

            <br>

            <p><a class="btn btn-default-1 waves" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Go to home', 'sigma'); ?></a></p>

        </div><!-- col -->
    </div><!-- row -->
</div>

<?php get_footer(); ?>