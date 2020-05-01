<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 */
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>
<?php $protocol = is_ssl() ? 'https://' : 'http://'; ?>
<div itemscope itemtype="<?php echo esc_attr($protocol); ?>schema.org/Comment" id="comments" class="post-comments comment-area clearfix">
	<?php if ( have_comments() ) : ?>
	 
     <h6 class="commentlist-title m-t60">
     	<?php $comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'sigma' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s Reply to &ldquo;%2$s&rdquo;',
						'%1$s Replies to &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'sigma'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			} ?>
     </h6>
        
    <div class="commentlist">
        <?php
            wp_list_comments( array(
                'style'       => 'div',
                'short_ping'  => true,
                'avatar_size' => 74,
                'callback'=>'sigma_bunch_list_comments'
            ) );
        ?>
    </div>
    <?php
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
    ?>
    <nav class="navigation comment-navigation clearfix" role="navigation">
        <h1 class="screen-reader-text section-heading"><?php esc_html_e( 'Comment navigation', 'sigma' ); ?></h1>
        <div class="nav-previous pull-left"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'sigma' ) ); ?></div>
        <div class="nav-next pull-right"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'sigma' ) ); ?></div>
    </nav><!-- .comment-navigation -->
    <?php endif; // Check for comment navigation ?>
    <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'sigma' ); ?></p>
    <?php endif; ?>
    
<?php endif; ?> 
     
     <!-- Comment Form -->
    <div class="add-comment-box">
        <!-- Heading -->
        <?php if ( comments_open()) : ?>
			<?php sigma_bunch_comment_form(); ?>
        <?php endif; ?>	
    </div>    
</div><!-- #comments -->