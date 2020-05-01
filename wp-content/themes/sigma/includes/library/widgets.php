<?php
///----Blog widgets---

//Recent Post
class Bunch_Recent_Post extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_Recent_Post', /* Name */esc_html__('Sigma Recent Post','sigma'), array( 'description' => esc_html__('Show the recent posts sidebar', 'sigma' )) );
	}
	
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo wp_kses_post($before_widget); ?>
		
        <!-- Recent Posts -->
        <div class="widget-recent-posts">
			<?php echo wp_kses_post($before_title.$title.$after_title); ?>
        	<div class="post">
                
                <?php $query_string = 'posts_per_page='.$instance['number'];
				if( $instance['cat'] ) $query_string .= '&cat='.$instance['cat'];
				 
				$this->posts($query_string);  
				?>
                
            </div>
        
        </div>
        
		<?php echo wp_kses_post($after_widget);
	}
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}
	
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Recent Post', 'sigma');
		$number = ( $instance ) ? esc_attr($instance['number']) : 3;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : ''; ?>
		
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'sigma'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('No. of Posts:', 'sigma'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
    	<p>
            <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e('Category', 'sigma'); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'sigma'), 'selected'=>$cat, 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
        </p>
        
		<?php 
	}
	
	function posts($query_string)
	{
		$query = new WP_Query($query_string);
		if( $query->have_posts() ):?>
            <!-- Title -->
            <?php while( $query->have_posts() ): $query->the_post(); ?>
            <div class="item">
                <figure class="thumb"><?php the_post_thumbnail('sigma_60x60'); ?></figure>
                <a class="post-title" href="<?php echo esc_url(get_permalink(get_the_id())); ?>">New trends</a>
                <div class="post-details">
                    by <a class="post-author" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><?php the_author();?></a>
                    <a class="post-date" href="<?php echo esc_url(get_month_link(get_the_date('d'), get_the_date('m'))); ?>"><?php echo get_the_date(); ?></a>
                </div><!-- post-details -->
            </div>
            <?php endwhile;
		endif;
		wp_reset_postdata();
    }
}

//Our Brochures
class Bunch_Quote extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_Quote', /* Name */esc_html__('Sigma Quote','sigma'), array( 'description' => esc_html__('Show the Quote of the day', 'sigma' )) );
	}
	
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo wp_kses_post($before_widget); ?>
      	
        <div class="widget-text">
			<?php echo wp_kses_post($before_title.$title.$after_title); ?>
        	<div>
                <blockquote>
                    <p>&quot;<?php echo wp_kses_post($instance['text']); ?>&quot;</p>
                    <footer><?php echo wp_kses_post($instance['author']); ?></footer>
                </blockquote>
            </div>
        
        </div>
            
		<?php echo wp_kses_post($after_widget);
	}
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['text'] = $new_instance['text'];
		$instance['author'] = $new_instance['author'];

		return $instance;
	}
	
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Quote of day', 'sigma');
		$text = ( $instance ) ? esc_attr($instance['text']) : '';
		$author = ($instance) ? esc_attr($instance['author']) : esc_html__('John Doe', 'sigma');
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'sigma'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php esc_html_e('Text:', 'sigma'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>" ><?php echo wp_kses_post($text); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('author')); ?>"><?php esc_html_e('Author Name:', 'sigma'); ?></label>
            <input placeholder="<?php esc_attr_e('Name here', 'sigma'); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('author')); ?>" name="<?php echo esc_attr($this->get_field_name('author')); ?>" type="text" value="<?php echo esc_attr($author); ?>" />
        </p>
        
		<?php 
	}
}

///----footer widgets---
//About Us
class Bunch_About_Us extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_About_Us', /* Name */esc_html__('Sigma About Us','sigma'), array( 'description' => esc_html__('Show the information about company', 'sigma' )) );
	}
	
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$options = _WSH()->option();
		echo wp_kses_post($before_widget); ?>
      		
        <!--Footer Column-->
        <div class="widget-text">
			<?php echo wp_kses_post($before_title.$title.$after_title); ?>
        	<div>
        
                <p><?php echo wp_kses_post($instance['text']); ?></p>
        		<?php if( $instance['show'] ): ?>
                    <ul class="social-icon-two">
                        <?php echo wp_kses_post(sigma_get_social_icons()); ?>
                    </ul>
                <?php endif; ?>
            </div>
        
        </div>
        
		<?php echo wp_kses_post($after_widget);
	}
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['text'] = $new_instance['text'];
		$instance['show'] = $new_instance['show'];

		return $instance;
	}
	
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('We are Sigma', 'sigma');
		$text = ( $instance ) ? esc_attr($instance['text']) : '';
		$show = ($instance) ? esc_attr($instance['show']) : '';
		?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'sigma'); ?></label>
            <input placeholder="<?php esc_attr_e('Title', 'sigma'); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php esc_html_e('Content:', 'sigma'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>" ><?php echo wp_kses_post($text); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('show')); ?>"><?php esc_html_e('Show Social Icons:', 'sigma'); ?></label>
			<?php $selected = ( $show ) ? ' checked="checked"' : ''; ?>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('show')); ?>"<?php echo esc_attr($selected); ?> name="<?php echo esc_attr($this->get_field_name('show')); ?>" type="checkbox" value="true" />
        </p>
                
		<?php 
	}
}

//Contact Us
class Bunch_Contact_Us extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_Contact_Us', /* Name */esc_html__('Sigma Contact Us','sigma'), array( 'description' => esc_html__('Show the information about company', 'sigma' )) );
	}
	
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$options = _WSH()->option();
		echo wp_kses_post($before_widget); ?>
      		
        <!--Footer Column-->
        <div class="widget-contact">
			<?php echo wp_kses_post($before_title.$title.$after_title); ?>
        	<ul>
                <?php if( $instance['address'] ):?>
                <li>
                    <i class="sigma-icon-placeholder-1"></i>
                    <?php echo wp_kses_post($instance['address']); ?>
                </li>
                <?php endif;?>
                <?php if( $instance['phone'] ):?>
                <li>
                    <i class="sigma-icon-telephone-call"></i>
                    <?php echo wp_kses_post($instance['phone']); ?>
                </li>
                <?php endif;?>
                <?php if( $instance['email'] ):?>
                <li>
                    <i class="sigma-icon-envelope-4"></i>
                    <a href="mailto:<?php echo sanitize_email($instance['email']); ?>"><?php echo sanitize_email($instance['email']); ?></a>
                </li>
                <?php endif;?>
            </ul>
        
        </div>
        
		<?php echo wp_kses_post($after_widget);
	}
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['address'] = $new_instance['address'];
		$instance['phone'] = $new_instance['phone'];
		$instance['email'] = $new_instance['email'];

		return $instance;
	}
	
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Contact', 'sigma');
		$address = ( $instance ) ? esc_attr($instance['address']) : esc_html__('4453 Meadow Lane San Jose, <br class="visible-lg-block"> CA 95134', 'sigma');
		$phone = ( $instance ) ? esc_attr($instance['phone']) : esc_html__('315-411-8716', 'sigma');
		$email = ( $instance ) ? esc_attr($instance['email']) : esc_html__('info@example.tech', 'sigma');
		?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'sigma'); ?></label>
            <input placeholder="<?php esc_attr_e('Title', 'sigma'); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('address')); ?>"><?php esc_html_e('Address:', 'sigma'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('address')); ?>" name="<?php echo esc_attr($this->get_field_name('address')); ?>" ><?php echo wp_kses_post($address); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('phone')); ?>"><?php esc_html_e('Phone:', 'sigma'); ?></label>
            <input placeholder="<?php esc_attr_e('Phone here...', 'sigma'); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_attr($phone); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php esc_html_e('Email Address:', 'sigma'); ?></label>
            <input placeholder="<?php esc_attr_e('Email Address here', 'sigma'); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>" />
        </p>
                
		<?php 
	}
}

///----Service Sidebar widgets---
//Recent Services
class Bunch_services extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_services', /* Name */esc_html__('Sigma Services Sidebar','sigma'), array( 'description' => esc_html__('Show the Services Sidebar', 'sigma' )) );
	}
 
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		
		echo wp_kses_post($before_widget); ?>
		
        <!--Blog Category Widget-->
        <div class="sidebar-blog-category">
            <ul class="blog-cat">
                <?php 
                    $args = array('post_type' => 'bunch_services', 'showposts'=>$instance['number']);
                    if( $instance['cat'] ) $args['tax_query'] = array(array('taxonomy' => 'services_category','field' => 'id','terms' => (array)$instance['cat']));
                    query_posts($args); 
                    $this->posts();
					wp_reset_query();
				?>
            </ul>
        </div>
		
        <?php echo wp_kses_post($after_widget);
	}
 
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$number = ( $instance ) ? esc_attr($instance['number']) : 6;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
		
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of posts: ', 'sigma'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e('Category', 'sigma'); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'sigma'), 'selected'=>$cat, 'taxonomy' => 'services_category', 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
        </p>
            
		<?php 
	}
	
	function posts()
	{
		
		if( have_posts() ):?>
        
           	<!-- Title -->
            <?php $count = 1; while( have_posts() ): the_post(); 
				global $post ; 
				$service_meta = _WSH()->get_meta();
			?>
            <li class="<?php if($count == 1) echo 'active'; ?>"><a href="<?php echo esc_url(sigma_set($service_meta, 'ext_url')); ?>"><?php the_title(); ?></a></li>
            <?php $count++; endwhile; ?>
                
        <?php endif;
    }
}

//We can help
class Bunch_We_Can_Help extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_We_Can_Help', /* Name */esc_html__('Sigma We can help','sigma'), array( 'description' => esc_html__('Show the We can help', 'sigma' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		
		echo wp_kses_post($before_widget);?>
      		
			<!--Help Widget-->
            <div class="help-widget">
                <div class="widget-content">
                    <div class="image">
                        <img src="<?php echo esc_url($instance['image']); ?>" alt="<?php esc_attr_e('Awesome Image', 'sigma');?>" />
                        <div class="content">
                            <h2><?php echo wp_kses_post($instance['upper_title']); ?></h2>
                            <h3><?php echo wp_kses_post($instance['title']); ?></h3>
                            <a href="<?php echo esc_url($instance['btn_link']); ?>" class="theme-btn btn btn-default-2 waves"><?php echo wp_kses_post($instance['btn_title']); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            
		<?php
		
		echo wp_kses_post($after_widget);
	}
	

	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['image'] = strip_tags($new_instance['image']);
		$instance['upper_title'] = $new_instance['upper_title'];
		$instance['title'] = $new_instance['title'];
		$instance['btn_title'] = $new_instance['btn_title'];
		$instance['btn_link'] = $new_instance['btn_link'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$image = ($instance) ? esc_attr($instance['image']) : 'http://wp.efforttech.net/newwp/sigma/wp-content/uploads/2019/01/bg-8.jpg';
		$upper_title = ($instance) ? esc_attr($instance['upper_title']) : '';
		$title = ($instance) ? esc_attr($instance['title']) : '';
		$btn_title = ($instance) ? esc_attr($instance['btn_title']) : '';
		$btn_link = ($instance) ? esc_attr($instance['btn_link']) : '';
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php esc_html_e('Image Url:', 'sigma'); ?></label>
            <input placeholder="<?php esc_attr_e('', 'sigma');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('image')); ?>" type="text" value="<?php echo esc_attr($image); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('upper_title')); ?>"><?php esc_html_e('Upper Title:', 'sigma'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('upper_title')); ?>" name="<?php echo esc_attr($this->get_field_name('upper_title')); ?>" ><?php echo esc_attr($upper_title); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'sigma'); ?></label>
            <input placeholder="<?php esc_attr_e('', 'sigma');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('btn_title')); ?>"><?php esc_html_e('Button Title:', 'sigma'); ?></label>
            <input placeholder="<?php esc_attr_e('Get appointment', 'sigma');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('btn_title')); ?>" name="<?php echo esc_attr($this->get_field_name('btn_title')); ?>" type="text" value="<?php echo esc_attr($btn_title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('btn_link')); ?>"><?php esc_html_e('Button Link:', 'sigma'); ?></label>
            <input placeholder="<?php esc_attr_e('#', 'sigma');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('btn_link')); ?>" name="<?php echo esc_attr($this->get_field_name('btn_link')); ?>" type="text" value="<?php echo esc_attr($btn_link); ?>" />
        </p>
               
                
		<?php 
	}
	
}

//Our Brochures
class Bunch_Brochures extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_Brochures', /* Name */esc_html__('Sigma Our Brochures','sigma'), array( 'description' => esc_html__('Show the info Our Brochures', 'sigma' )) );
	}
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget);?>
      		
            <!--Download Widget-->
            <div class="download-widget">
                <div class="widget-content">
                    <?php echo wp_kses_post($before_title.$title.$after_title); ?>
                    <a href="<?php echo esc_url($instance['pdf_link']); ?>" class="download-box"><?php echo wp_kses_post($instance['pdf_title']); ?> <span class="icon sigma-icon-file-2"></span></a>
                </div>
            </div>
			
		<?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['pdf_title'] = $new_instance['pdf_title'];
		$instance['pdf_link'] = $new_instance['pdf_link'];
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : 'Download';
		$pdf_title = ($instance) ? esc_attr($instance['pdf_title']) : '';
		$pdf_link = ($instance) ? esc_attr($instance['pdf_link']) : '';
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'sigma'); ?></label>
            <input placeholder="<?php esc_attr_e('Download', 'sigma');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('pdf_title')); ?>"><?php esc_html_e('PDF Title:', 'sigma'); ?></label>
            <input placeholder="<?php esc_attr_e('Download Brochure', 'sigma');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('pdf_title')); ?>" name="<?php echo esc_attr($this->get_field_name('pdf_title')); ?>" type="text" value="<?php echo esc_attr($pdf_title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('pdf_link')); ?>"><?php esc_html_e('PDF Link:', 'sigma'); ?></label>
            <input placeholder="<?php esc_attr_e('#', 'sigma');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('pdf_link')); ?>" name="<?php echo esc_attr($this->get_field_name('pdf_link')); ?>" type="text" value="<?php echo esc_attr($pdf_link); ?>" />
        </p>
                
		<?php 
	}
	
}

?>