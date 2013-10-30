<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package stripedbydonmik
 */

if ( ! function_exists( 'striped_by_donmik_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function striped_by_donmik_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';
	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'striped_by_donmik' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'striped_by_donmik' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'striped_by_donmik' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

        <?php
            $current_page = max(1, get_query_var('paged'));  

            $args = array(
                'base' => get_pagenum_link(1) . '%_%',  
                'format' => '/page/%#%', 
                'total' => $wp_query->max_num_pages,
                'current' => $current_page,
                'prev_text' => __( 'Previous Page', 'striped_by_donmik' ),
                'next_text' => __( 'Next Page', 'striped_by_donmik' ),
            );
        ?>
        <div class="pager">
            <?php echo paginate_links( $args ); ?>
        </div>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // striped_by_donmik_content_nav

if ( ! function_exists( 'striped_by_donmik_comment_count' ) ) :
/**
 * Return comment count by type.
 */
function striped_by_donmik_comment_count( $type = 'comments', $return = false ) {
    if ($type == 'comments'):
        $typeSql = 'comment_type = ""';
        $oneText = __('One comment', 'striped_by_donmik');
        $moreText = __('% comments', 'striped_by_donmik');
        $noneText = __('No Comments', 'striped_by_donmik');
    elseif ($type == 'pings'):
        $typeSql = 'comment_type != ""';
        $oneText = __('One pingback/trackback', 'striped_by_donmik');
        $moreText = __('% pingbacks/trackbacks', 'striped_by_donmik');
        $noneText = __('No pingbacks/trackbacks', 'striped_by_donmik');
    elseif($type == 'trackbacks'):
        $typeSql = 'comment_type = "trackback"';
        $oneText = __('One trackback', 'striped_by_donmik');
        $moreText = __('% trackbacks', 'striped_by_donmik');
        $noneText = __('No trackbacks', 'striped_by_donmik');
    elseif($type == 'pingbacks'):
        $typeSql = 'comment_type = "pingback"';
        $oneText = __('One pingback', 'striped_by_donmik');
        $moreText = __('% pingbacks', 'striped_by_donmik');
        $noneText = __('No pingbacks', 'striped_by_donmik');
    endif;
        
    global $wpdb;
    $result = $wpdb->get_var('
        SELECT
            COUNT(comment_ID)
        FROM
            '.$wpdb->comments.'
        WHERE
            '.$typeSql.' AND
            comment_approved="1" AND
            comment_post_ID= '.get_the_ID()
    );
    if ($result == 0):
        $result_text = str_replace('%', $result, $noneText);
    elseif ($result == 1):
        $result_text = str_replace('%', $result, $oneText);
    elseif ($result > 1):
        $result_text = str_replace('%', $result, $moreText);
    endif;
    
    if ($return)
        return $result_text;
    
    echo $result_text;
}
endif;

if ( ! function_exists( 'striped_by_donmik_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function striped_by_donmik_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php echo ucfirst($comment->comment_type); ?>: <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'striped_by_donmik' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
                    <time datetime="<?php comment_time( 'c' ); ?>">
                        <?php printf( _x( '%1$s <br/> %2$s', '1: date, 2: time', 'striped_by_donmik' ), get_comment_date(), get_comment_time() ); ?>
                    </time>
					<?php edit_comment_link( __( 'Edit', 'striped_by_donmik' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'striped_by_donmik' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

            <div class="comment-right">
                <div class="comment-content">
                    <h3 class="author_name"><?php comment_author_link(); ?></h3>
                    <?php comment_text(); ?>
                </div><!-- .comment-content -->

                <?php
                    comment_reply_link( array_merge( $args, array(
                        'add_below' => 'div-comment',
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth'],
                        'before'    => '<div class="reply">',
                        'after'     => '</div>',
                    ) ) );
                ?>
            </div>
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for striped_by_donmik_comment()

if ( ! function_exists( 'striped_by_donmik_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 */
function striped_by_donmik_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'striped_by_donmik_attachment_size', array( 1200, 1200 ) );
	$next_attachment_url = wp_get_attachment_url();

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the
	 * URL of the next adjacent image in a gallery, or the first image (if
	 * we're looking at the last image in a gallery), or, in a gallery of one,
	 * just the link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'striped_by_donmik_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function striped_by_donmik_posted_on() {
    printf('<a href="%s" class="date"><span class="month">%s<span>%s</span></span> <span class="day">%s</span><span class="year">, %s</span></a>',
            get_permalink(),
            ucfirst(get_the_date('M')),
            str_replace(get_the_date('M'), '', get_the_date('F')),
            get_the_date('d'),
            get_the_date('Y'));
}
endif;

/**
 * Returns true if a blog has more than 1 category
 */
function striped_by_donmik_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so striped_by_donmik_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so striped_by_donmik_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in striped_by_donmik_categorized_blog
 */
function striped_by_donmik_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'striped_by_donmik_category_transient_flusher' );
add_action( 'save_post',     'striped_by_donmik_category_transient_flusher' );
