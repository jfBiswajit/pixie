<a class="youtube-player" data-property="{videoURL:'<?php echo esc_url( $video_url );?>',containment:'#youtube-video-section',showControls:true,autoPlay:true, mute:true, startAt:25, stopAt:50, opacity:1}">My video</a>
<section class="full-section dark-section" id="section-5" style="background-image:url('<?php echo esc_url($bg_img);?>');">

    <div id="youtube-video-section">
    </div><!-- youtube-video-section -->

    <div class="full-section-container">

        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">

                    <h1><?php echo wp_kses_post($title); ?></h1>
					<p><?php echo wp_kses_post($text); ?></p>

                </div><!-- col -->
            </div><!-- row -->
        </div><!-- container -->

    </div><!-- full-section-container -->
</section>
