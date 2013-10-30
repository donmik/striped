<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to striped_by_donmik_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package stripedbydonmik
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>
        
	<?php if ( have_comments() ) : ?>
        <?php
            // Pingbacks / Trackbacks.
            if (striped_by_donmik_comment_count('pings', true) != __('No pingbacks/trackbacks', 'striped_by_donmik')): 
        ?>
        <h2 class="comments-title">
			<?php printf('%s on &ldquo;%s&rdquo;', striped_by_donmik_comment_count('pings', true), '<span>'.get_the_title().'</span>'); ?>
		</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( array( 'type' => 'pings', 'callback' => 'striped_by_donmik_comment') );
			?>
		</ol><!-- .comment-list -->
        <?php endif; ?>
    
        <?php
            // Comments.
            if (striped_by_donmik_comment_count('comments', true) != __('No Comments', 'striped_by_donmik')): 
        ?>
		<h2 class="comments-title">
			<?php printf('%s on &ldquo;%s&rdquo;', striped_by_donmik_comment_count('comments', true), '<span>'.get_the_title().'</span>'); ?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'striped_by_donmik' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'striped_by_donmik' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'striped_by_donmik' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use striped_by_donmik_comment() to format the comments.
				 * If you want to override this in a child theme, then you can
				 * define striped_by_donmik_comment() and that will be used instead.
				 * See striped_by_donmik_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 'type' => 'comment', 'callback' => 'striped_by_donmik_comment', 'avatar_size' => '80' ) );
			?>
		</ol><!-- .comment-list -->
    
        <?php endif; ?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'striped_by_donmik' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'striped_by_donmik' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'striped_by_donmik' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'striped_by_donmik' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
