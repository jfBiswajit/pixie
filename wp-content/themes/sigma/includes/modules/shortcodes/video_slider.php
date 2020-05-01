<a class="youtube-player" data-property="{videoURL:'<?php echo esc_attr( $video_url );?>',containment:'#youtube-video-section',showControls:true,autoPlay:true, mute:true, startAt:25, stopAt:50, opacity:1}"><?php esc_html_e('My video', 'sigma');?></a>

<section class="full-section dark-section" id="main-section" style="background-image:url('<?php echo esc_url( $bg_img );?>');">

    <div id="youtube-video-section">
    </div><!-- youtube-video-section -->

    <div class="full-section-container">

        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">

                    <h1 class="wow fadeInUp" data-wow-offset="-50"><?php echo wp_kses_post( $title );?></h1>

                    <p class="wow fadeInUp" data-wow-offset="-50" data-wow-delay="0.15s"><?php echo wp_kses_post( $text );?></p>

                    <br>

                    <a class="btn btn-default-1 waves wow fadeInUp" data-wow-offset="-50" href="<?php echo esc_url( $btn_link );?>" data-wow-delay="0.3s"><?php echo wp_kses_post( $btn_title );?></a>

                </div>
            </div>
        </div>

    </div>

</section>