<?php
add_action( '_bunch_after_body_start', 'sigma_bunch_preloader', 5, 1 );
add_action( '_bunch_after_body_start', 'sigma_bunch_sidebar_menu', 10, 1 );
add_action( '_bunch_after_body_start', 'sigma_bunch_nav_and_logo', 15, 1 );
add_action( 'init', 'sigma_bunch_add_flaticon_icons_in_king_composer' );
add_action( 'init', 'sigma_bunch_add_sigma_icons_in_king_composer' );
function _WSH()
{
	return $GLOBALS['_bunch_base'];
}
function sigma_bunch_add_flaticon_icons_in_king_composer() {
	if( function_exists( 'kc_add_icon' ) ) {
		kc_add_icon( get_template_directory_uri().'/css/flaticon.css' );
	}
}
function sigma_bunch_add_sigma_icons_in_king_composer() {
	if( function_exists( 'kc_add_icon' ) ) {
		kc_add_icon( get_template_directory_uri().'/css/sigma-icons.min.css' );
	}
}
/** function to hook body id */
function sigma_bunch_body_id() 
{
	do_action( 'sigma_bunch_body_id' );
}
/** A function to fetch the categories from wordpress */
function sigma_bunch_get_categories($arg = false, $by_slug = false, $show_all = true)
{
	global $wp_taxonomies;
	if( ! empty($arg['taxonomy']) && ! isset($wp_taxonomies[$arg['taxonomy']]))
	{
		
	}
	
	$categories = get_terms(sigma_set( $arg, 'taxonomy', 'category' ), $arg);
	$cats = array();
	if( $show_all ) $cats[] = esc_html__( 'All Categories', 'sigma' );
	
	if( !is_wp_error( $categories ) ) {
	foreach($categories as $category)
	{
		if( $by_slug ) $cats[$category->slug] = $category->name;
		else $cats[$category->term_id] = $category->name;
	}
	}
	return $cats;
}
if( !function_exists( 'sigma_bunch_slug' ) )
{
	function sigma_bunch_slug( $string )
	{
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
}
function sigma_bunch_get_sidebars($multi = false)
{
	global $wp_registered_sidebars;
	$sidebars = !($wp_registered_sidebars) ? get_option('wp_registered_sidebars') : $wp_registered_sidebars;
	if( $multi ) $data[] = array('value'=>'', 'label' => 'No Sidebar');
	else $data = array('' => esc_html__('No Sidebar', 'sigma'));
	foreach( (array)$sidebars as $sidebar)
	{
		if( $multi ) $data[] = array( 'value'=> sigma_set($sidebar, 'id'), 'label' => sigma_set( $sidebar, 'name') );
		else $data[sigma_set($sidebar, 'id')] = sigma_set($sidebar, 'name');
	}
	return $data;
}
if ( ! function_exists('sigma_character_limiter'))
{
	function sigma_character_limiter($str, $n = 500, $end_char = '&#8230;', $allowed_tags = false)
	{
		if($allowed_tags) $str = strip_tags($str, $allowed_tags);
		if (strlen($str) < $n)	return $str;
		$str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));
		if (strlen($str) <= $n) return $str;
		$out = "";
		foreach (explode(' ', trim($str)) as $val)
		{
			$out .= $val.' ';
			
			if (strlen($out) >= $n)
			{
				$out = trim($out);
				return ( strlen($out ) == strlen($str)) ? $out : $out.$end_char;
			}		
		}
	}
}
function sigma_bunch_get_social_icons()
{
	$options = _WSH()->option('social_media');
	$output = '';
	
	$count = 0;
	
	if( sigma_set( $options, 'social_media' ) && is_array( sigma_set( $options, 'social_media' ) ) )
	{
		$total = count( sigma_set( $options, 'social_media' ) ) - 2;
		foreach( sigma_set( $options, 'social_media' ) as $social_icon ){
			if( isset( $social_icon['tocopy' ] ) ) continue;
			$title = sigma_set( $social_icon, 'title');
			$link = sigma_set( $social_icon, 'social_link');
			$icon = sigma_set( $social_icon, 'social_icon');
			$last_class = ( $count == $total ) ? ' class="last"' : '';
			$output .= '
			<a href="'.esc_url( $link ).'" title="'.esc_attr( $title ).'"><span class="fa '.$icon.'"></span></a>'."\n";
			
			$count++;
		}
	}
	
	return $output;
}
function sigma_get_the_breadcrumb()
{
	global $wp_query;
	$queried_object = get_queried_object();
	
	$breadcrumb = '';
	$delimiter = ' ';
	$before = '<li>';
	$after = '</li>';
	if ( ! is_home())
	{
		$breadcrumb .= '<li><a href="'.esc_url(home_url('/')).'">'.esc_html__('Home', 'sigma').'</a></li>';
		
		/** If category or single post */
		if(is_category())
		{
			$cat_obj = $wp_query->get_queried_object();
			$this_category = get_category( $cat_obj->term_id );
	
			if ( $this_category->parent != 0 ) {
				$parent_category = get_category( $this_category->parent );
				$breadcrumb .= get_category_parents($parent_category, TRUE, $delimiter );
			}
			
			$breadcrumb .= '<li><a href="'.esc_url(get_category_link(get_query_var('cat'))).'">'.single_cat_title('', FALSE).'</a></li>';
		}
		elseif(is_tax())
		{
			$breadcrumb .= '<li><a href="'.esc_url(get_term_link($queried_object)).'">'.$queried_object->name.'</a></li>';
		}
		elseif(is_page()) /** If WP pages */
		{
			global $post;
			if($post->post_parent)
			{
                $anc = get_post_ancestors($post->ID);
                foreach($anc as $ancestor)
				{
                    $breadcrumb .= '<li><a href="'.esc_url(get_permalink($ancestor)).'">'.get_the_title($ancestor).'</a></li>';
                }
				$breadcrumb .= '<li>'.get_the_title($post->ID).'</li>';
				
            }else $breadcrumb .= '<li>'.get_the_title().'</li>';
		}
		elseif (is_singular())
		{
			if($category = wp_get_object_terms(get_the_ID(), 'category'))
			{
				if( !is_wp_error($category) )
				{
					$breadcrumb .= '<li><a href="'.esc_url(get_term_link(sigma_set($category, '0'))).'">'.sigma_set( sigma_set($category, '0'), 'name').'</a></li>';
					$breadcrumb .= '<li>'.get_the_title().'</li>';
					
				} else $breadcrumb .= '<li>'.get_the_title().'</li>';
			}else{
				$breadcrumb .= '<li>'.get_the_title().'</li>';
			}
		}
		elseif(is_tag()) $breadcrumb .= '<li><a href="'.esc_url(get_term_link($queried_object)).'">'.single_tag_title('', FALSE).'</a></li>'; /**If tag template*/
		elseif(is_day()) $breadcrumb .= '<li><a href="#">'.esc_html__('Archive for ', 'sigma').get_the_time('F jS, Y').'</a></li>'; /** If daily Archives */
		elseif(is_month()) $breadcrumb .= '<li><a href="' .esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) .'">'.esc_html__('Archive for ', 'sigma').get_the_time('F, Y').'</a></li>'; /** If montly Archives */
		elseif(is_year()) $breadcrumb .= '<li><a href="'.esc_url(get_year_link(get_the_time('Y'))).'">'.esc_html__('Archive for ', 'sigma').get_the_time('Y').'</a></li>'; /** If year Archives */
		elseif(is_author()) $breadcrumb .= '<li><a href="'. esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) .'">'.esc_html__('Archive for ', 'sigma').get_the_author().'</a></li>'; /** If author Archives */
		elseif(is_search()) $breadcrumb .= '<li>'.esc_html__('Search Results for ', 'sigma').get_search_query().'</li>'; /** if search template */
		elseif(is_404()) $breadcrumb .= '<li>'.esc_html__('404 - Not Found', 'sigma').'</li>'; /** if search template */
		elseif ( is_post_type_archive('product') ) 
		{
			
			$shop_page_id = wc_get_page_id( 'shop' );
			if( get_option('page_on_front') !== $shop_page_id  )
			{
				$shop_page    = get_post( $shop_page_id );
				
				$_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
		
				if ( ! $_name ) {
					$product_post_type = get_post_type_object( 'product' );
					$_name = $product_post_type->labels->singular_name;
				}
		
				if ( is_search() ) {
		
					$breadcrumb .= $before . '<a href="' . esc_url(get_post_type_archive_link('product')) . '">' . $_name . '</a>' . $delimiter . esc_html__( 'Search results for &ldquo;', 'sigma' ) . get_search_query() . '&rdquo;' . $after;
		
				} elseif ( is_paged() ) {
		
					$breadcrumb .= $before . '<a href="' . esc_url(get_post_type_archive_link('product')) . '">' . $_name . '</a>' . $after;
		
				} else {
		
					$breadcrumb .= $before . $_name . $after;
		
				}
			}
	
		}
		else $breadcrumb .= '<li><a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a></li>'; /** Default value */
	}
	return '<ul class="">'.$breadcrumb.'</ul>';
}
function sigma_bunch_list_comments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment; ?>
	
    <!-- comment -->
    <div class="sig-comment-item">
        <!-- Item -->
        <div class="single-comment-box" id="comment-<?php comment_ID(); ?>">
        	<div <?php comment_class('comment');?>>
                <div class="comment-body">
        
                    <div class="comment-meta">
        
                        <div class="comment-author">
        					<?php $email = sigma_set( $comment, 'comment_author_email' );
                
							if( $email ): ?>
								<?php echo get_avatar( $email, 70 ); ?>
							<?php else: ?>
								<?php echo get_avatar( $email, 70 ); ?>
							<?php endif;?>
                            <div class="fn"><?php echo get_comment_author_link(); ?></div>
        
                        </div><!-- comment-author -->
        
                        <div class="comment-metadata">
                            <span class="c-date"><?php echo comment_date(); ?></span>
                        </div><!-- comment-metadata -->
        
                    </div><!-- comment-meta -->
        
                    <div class="comment-content">
        
                        <?php comment_text(); ?>
        
                    </div><!--  comment-content -->
        
                    <div class="reply">
                        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => ''.esc_html__('Reply', 'sigma').''))) ?>
                    </div><!-- reply -->
        
                </div><!-- comment-body -->
            </div>
            
		</div>
    <?php
	//endif;
}
/**
 * returns the formatted form of the comments
 *
 * @param	array	$args		an array of arguments to be filtered
 * @param	int		$post_id	if form is called within the loop then post_id is optional
 *
 * @return	string	Return the comment form
 */
function sigma_bunch_comment_form( $args = array(), $post_id = null, $review = false )
{
	if ( null === $post_id )
		$post_id = get_the_ID();
	else
		$id = $post_id;
	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';
	$args = wp_parse_args( $args );
	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html5    = 'html5' === $args['format'];
	$fields   =  array(
		'author' => '<p class="commentform-author"><input id="name" placeholder="'. esc_attr__( 'Your Name', 'sigma' ).'"  class="col-xs-12" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="commentform-email"><input id="email" placeholder="'. esc_attr__( 'Enter Your Email', 'sigma' ).'" class="col-xs-12" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
	);
	$required_text = sprintf( ' ' . esc_html__('Required fields are marked %s', 'sigma'), '<span class="required">*</span>' );
	/**
	 * Filter the default comment form fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $fields The default comment fields.
	 */
	$sigma_col = (is_user_logged_in()) ? 'col-md-12': '';
	$fields = apply_filters( 'comment_form_default_fields', $fields );
	$defaults = array(
		'fields'               => $fields,
		'comment_field'        => '<p class="commentform-comment"><textarea id="comments_text" placeholder="'. esc_attr__( 'Type Comment Here', 'sigma' ).'" class="col-xs-12" name="comment" cols="45" rows="3" aria-required="true"></textarea></p>',
		'must_log_in'          => '<p class="">' . sprintf( wp_kses_post(__( 'You must be <a href="%s">logged in</a> to post a comment.', 'sigma' )), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="">' . sprintf( wp_kses_post(__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'sigma' )), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '<p class="">' . esc_html__( 'Your email address will not be published.', 'sigma' ) . ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '',
		'id_form'              => 'add-comment-form',
		'id_submit'            => 'submit',
		'title_reply'          => '',
		'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'sigma' ),
		'cancel_reply_link'    => esc_html__( 'Cancel reply', 'sigma' ),
		'label_submit'         => esc_html__( 'Post Comment', 'sigma' ),
		'format'               => 'xhtml',
	);
	/**
	 * Filter the comment form default arguments.
	 *
	 * Use 'comment_form_default_fields' to filter the comment fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $defaults The default comment form arguments.
	 */
	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );
	?>
		<?php if ( comments_open( $post_id ) ) : ?>
			<?php
			/**
			 * Fires before the comment form.
			 *
			 * @since 3.0.0
			 */
			do_action( 'comment_form_before' );
			?>
			<div class="default-form clearfix" id="respond">
            	<h6 class="commentlist-title"><?php esc_html_e('Leave Your Reply', 'sigma'); ?></h6>
                <h6><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h6>
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo wp_kses_post($args['must_log_in']); ?>
					<?php
					/**
					 * Fires after the HTML-formatted 'must log in after' message in the comment form.
					 *
					 * @since 3.0.0
					 */
					do_action( 'comment_form_must_log_in_after' );
					?>
				<?php else : ?>
                	<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="col-sm-12" <?php echo wp_kses_post($html5) ? ' novalidate' : ''; ?>>
						<div class="row clearfix">
                        <fieldset>
						<?php
						/**
						 * Fires at the top of the comment form, inside the <form> tag.
						 *
						 * @since 3.0.0
						 */
						do_action( 'comment_form_top' );
						?>
						<?php if ( is_user_logged_in() ) : ?>
							<?php
							/**
							 * Filter the 'logged in' message for the comment form for display.
							 *
							 * @since 3.0.0
							 *
							 * @param string $args['logged_in_as'] The logged-in-as HTML-formatted message.
							 * @param array  $commenter            An array containing the comment author's username, email, and URL.
							 * @param string $user_identity        If the commenter is a registered user, the display name, blank otherwise.
							 */
							echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );
							?>
							<?php
							/**
							 * Fires after the is_user_logged_in() check in the comment form.
							 *
							 * @since 3.0.0
							 *
							 * @param array  $commenter     An array containing the comment author's username, email, and URL.
							 * @param string $user_identity If the commenter is a registered user, the display name, blank otherwise.
							 */
							do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
							?>
						<?php else : ?>
							<?php echo wp_kses_post($args['comment_notes_before']); ?>
							<?php
							/**
							 * Fires before the comment fields in the comment form.
							 *
							 * @since 3.0.0
							 */
							do_action( 'comment_form_before_fields' );
							foreach ( (array) $args['fields'] as $name => $field ) {
								/**
								 * Filter a comment form field for display.
								 *
								 * The dynamic portion of the filter hook, $name, refers to the name
								 * of the comment form field. Such as 'author', 'email', or 'url'.
								 *
								 * @since 3.0.0
								 *
								 * @param string $field The HTML-formatted output of the comment form field.
								 */
								echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
							}
							/**
							 * Fires after the comment fields in the comment form.
							 *
							 * @since 3.0.0
							 */
							do_action( 'comment_form_after_fields' );
							?>
						<?php endif; ?>
						<?php
						/**
						 * Filter the content of the comment textarea field for display.
						 *
						 * @since 3.0.0
						 *
						 * @param string $args['comment_field'] The content of the comment textarea field.
						 */
						echo apply_filters( 'comment_form_field_comment', $args['comment_field'] );
						?>
						<?php echo wp_kses_post($args['comment_notes_after']); ?>
                        	<p class="commentform-submit">
                                <button id="<?php echo esc_attr( $args['id_submit'] ); ?>" type="submit" class="btn btn-default-1 waves"><?php echo esc_attr( $args['label_submit'] ); ?></button>
                            </p>
                          <?php comment_id_fields( $post_id ); ?>
						<?php
						/**
						 * Fires at the bottom of the comment form, inside the closing </form> tag.
						 *
						 * @since 1.5.2
						 *
						 * @param int $post_id The post ID.
						 */
						do_action( 'comment_form', $post_id );
						?>
						</fieldset>
                        </div>
					</form>
				<?php endif; ?>
			</div><!-- #respond -->
			<?php
			/**
			 * Fires after the comment form.
			 *
			 * @since 3.0.0
			 */
			do_action( 'comment_form_after' );
		else :
			/**
			 * Fires after the comment form if comments are closed.
			 *
			 * @since 3.0.0
			 */
			do_action( 'comment_form_comments_closed' );
		endif;
}
function sigma_bunch_blog_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'sigma_bunch_blog_excerpt_more');
function sigma_the_pagination($args = array(), $echo = 1)
{
	
	global $wp_query;
	
	$default =  array('base' => str_replace( 99999, '%#%', esc_url( get_pagenum_link( 99999 ) ) ), 'format' => '?paged=%#%', 'current' => max( 1, get_query_var('paged') ),
						'total' => $wp_query->max_num_pages, 'next_text' => '&raquo;', 'prev_text' => '&laquo;', 'type'=>'list','add_args' => false);
						
	$args = wp_parse_args($args, $default);			
	
	
	$pagination = str_replace("<ul class='page-numbers'", '<ul class="pagination"', paginate_links($args) );
	
	if(paginate_links(array_merge(array('type'=>'array'),$args)))
	{
		if($echo) echo wp_kses_post($pagination);
		return $pagination;
	}
}
add_action( '_bunch_blog_post_image', 'sigma_bunch_get_post_format_output' );
function sigma_bunch_get_post_format_output($meta = array() )
{
	global $post;
	
	
	$meta = ( $meta ) ? $meta : _WSH()->get_meta();
	$format = get_post_format();
	
	$format = get_post_format();
	
	
	$output = '';
	switch( $format )
	{
		case 'standard':
		case 'image': ?>
        	
            <?php if ( has_post_thumbnail() ): ?>
            <div class="blog_post_item_img">
				<?php the_post_thumbnail('852x392', array('class' => 'img-responsive')); ?>
            </div>
            <?php endif; ?>
			
		<?php break;
		case 'gallery': ?>
        	<?php if ( has_post_thumbnail() ): ?>
			<div class="blog_post_item_img">
				<?php the_post_thumbnail('852x392', array('class' => 'img-responsive')); ?>
            </div><!-- end media -->
            <?php endif; ?>
		<?php break;
		case 'video': ?>
        	<?php if ( sigma_set( $meta, 'video' ) ): ?>
			<div class="media-element">
               <?php echo wp_kses_post(sigma_set( $meta, 'video' )); ?>
            </div><!-- end media -->
            <?php endif; ?>
		<?php break;
		case 'audio': ?>
        	<?php if ( sigma_set( $meta, 'audio' ) ): ?>
        	<div class="media-element">
               <?php echo wp_kses_post(sigma_set( $meta, 'audio' )); ?>
            </div><!-- end media -->
            <?php endif; ?>
        <?php break;
		case 'quote':
		case 'link': ?>
			<blockquote class="custom"><?php echo wp_kses_post(sigma_set($meta, 'quote')); ?><small><?php the_author(); ?></small></blockquote>
		<?php break;
		default: ?>
        	<?php if ( has_post_thumbnail() ):?>
			<div class="blog_post_item_img">
				<?php the_post_thumbnail('852x392', array('class' => 'img-responsive')); ?>
            </div>
            <?php endif; ?>
		<?php break;
	}
	
	
}
function sigma_bunch_get_font_settings( $FontSettings = array(), $StyleBefore = '', $StyleAfter = '' )
{
	$i = 1;
	$settings = _WSH()->option();
	$Style = '';
	foreach( $FontSettings as $k => $v )
	{
		if( $i == 1 || $i == 5 )
		{
			$Style .= ( sigma_set( $settings, $k )  ) ? $v.':'.sigma_set( $settings, $k ).'px!important;': '';
		}
		else
		{
			$Style .= ( sigma_set( $settings, $k  )  ) ? $v.':'.sigma_set( $settings, $k ).'!important;': '';
		}
		$i++;
	}
	return ( !empty( $Style ) ) ? $StyleBefore.$Style.$StyleAfter: '';
}
function sigma_bunch_register_dynamic_sidebar()
{
	$theme_options = get_option( 'wp-factory'.'_theme_options');
	$sidebars = sigma_set( sigma_set( $theme_options, 'dynamic_sidebar' ), 'dynamic_sidebar' );
	if( $sidebars && is_array( $sidebars ) )
	{
		foreach( $sidebars as $sidebar ){
			
			if( isset( $sidebar['tocopy'] ) ) continue;
			
			register_sidebar( array(
				'name' => $sidebar['sidebar_name'],
				'id' => sigma_bunch_slug( $sidebar['sidebar_name'] ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => "</div>",
				'before_title' => '<h4 class="title"><span>',
				'after_title' => '</span></h4>',
			) );
		}
	}
}
function sigma_trim( $text, $len, $more = null )
{
	$text = strip_shortcodes( $text );
	
	$text = apply_filters( 'the_content', $text );
	$text = str_replace(']]>', ']]&gt;', $text);
	
	$excerpt_length = apply_filters( 'excerpt_length', $len );
	
	$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
	
	$excerpt_more = ( $more ) ? $more : ' ...';
	
	$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
	
	return $text;
	
}
function sigma_bunch_get_page_by_template( $tmpl, $index = 0 )
{
	$pages = get_posts(array(
        'post_type' => 'page',
		'meta_key' => '_wp_page_template',
		'meta_value' => $tmpl
	));
	
	if( $pages ){
		return $pages[$index];
	}
	
	return false;
}
function sigma_bunch_preloader($options) 
{
	/** Preloader if enabled from theme options */
	if( sigma_set( $options, 'preloader' ) ): ?>
		<div class="animationload">
			<div class="loader"><?php esc_html_e('Loading...', 'sigma'); ?></div>
		</div>
	<?php endif;
}
function sigma_bunch_sidebar_menu($options)
{
	include _WSH()->includes(get_template_directory_uri() . '/includes/modules/sidebar_menu.php');
	
}
function sigma_bunch_nav_and_logo( $options )
{
	$custom_header = sigma_set( $options, 'custom_header' );
	$custom_header = sigma_set( $_GET, 'custom_header' ) ? 'center_logo' : $custom_header;
	if( $custom_header == 'center_logo' )
		include _WSH()->includes(get_template_directory_uri(). '/includes/modules/nav_style1.php');
	else
		include _WSH()->includes(get_template_directory_uri(). '/includes/modules/nav_default.php');
}
function sigma_bunch_header_class( $class = null )
{
	$options = _WSH()->option();
	$header_option = sigma_set( $options, 'header_option' );
	$custom_header = sigma_set( $options, 'custom_header' );
	$header_class = '';
	
	$header_class .= ( $header_option && $custom_header == 'center_logo' ) ? 'header_center affix-top ' : ''; 
	$header_class .= ( $header_option && $custom_header == 'dafault' ) ? 'dark_header affix-top ' : '';
	
	if( sigma_set( $options, 'sticky_menu' ) ) $header_class .= 'afffix ';
	if( $class ) $header_class .= $class;
	if( $header_class ) return ' class="'.$header_class.'" ';
	
	return false;
}
function sigma_wp_get_site_logo(){
	$settings = get_option('wp-factory'.'_theme_options');
	if( sigma_set($settings, 'logo_type') === 'text' )
	{
		$LogoStyle = (sigma_set($settings, 'logo_font_size')) ? 'font-size:'.sigma_set($settings, 'logo_font_size').'px;' : '';
		$LogoStyle .= (sigma_set($settings, 'logo_font_face')) ? 'font-family:'.sigma_set($settings, 'logo_font_face').';' : '';
		$LogoStyle .= (sigma_set($settings, 'logo_color')) ? 'color:'.sigma_set($settings, 'logo_color').'!important;' : '';
		$Logo = '<a style="'.$LogoStyle.'" href="'.esc_url(home_url('/')).'" title="'.get_bloginfo('name').'">'.sigma_set( $settings, 'logo_heading').'</a>';
	}
	else
	{
		$LogoStyle = '';
		$LogoImageStyle = '';
		$LogoImageStyle .= ( sigma_set( $settings, 'logo_width' ) ) ? ' width:'.sigma_set( $settings, 'logo_width' ).'px;': '';
		$LogoImageStyle .= ( sigma_set( $settings, 'logo_height' ) ) ? ' height:'.sigma_set( $settings, 'logo_height' ).'px;': '';
		$Logo = '<a href="'.esc_url(home_url('/')).'" title="'.get_bloginfo('name').'"><img src="'.esc_url(sigma_set( $settings, 'logo_image', get_template_directory_uri().'/images/logo.png' )).'" alt="'.esc_attr__('logo', 'sigma').'" style="'.$LogoImageStyle.'" /></a>';
	}
	
	return $Logo;
}
function sigma_get_social_icons()
{
	$options = _WSH()->option('social_media');
	$output = '';
	
	$count = 0;
	
	if( sigma_set( $options, 'social_media' ) && is_array( sigma_set( $options, 'social_media' ) ) )
	{
		$total = count( sigma_set( $options, 'social_media' ) ) - 2;
		foreach( sigma_set( $options, 'social_media' ) as $social_icon ){
			if( isset( $social_icon['tocopy' ] ) ) continue;
			$title = sigma_set( $social_icon, 'title');
			$class = sigma_set( $social_icon, 'class');
			$link = sigma_set( $social_icon, 'social_link');
			$icon = sigma_set( $social_icon, 'social_icon');
			$last_class = ( $count == $total ) ? ' class="last"' : '';
			$output .= '
			<a class="'.esc_attr( $class ).'" title="'.esc_attr( $title ).'" href="'.esc_url( $link ).'"><i class="fa '.$icon.'"></i></a>'."\n";
			
			$count++;
		}
	}
	
	return $output;
}