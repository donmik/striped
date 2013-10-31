<?php
/**
 * @package stripedbydonmik
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->
    
    <div class="entry-meta">
    <?php if ( 'post' == get_post_type() ) : ?>
        <?php striped_by_donmik_posted_on(); ?>
    <?php endif; ?>
    <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
        <ul class="entry-stats">
            <li><?php comments_popup_link( '0', '1', '%', 'link-icon24 link-icon24-1 comments-link' ); ?></li>
        </ul>
    <?php endif; ?>
    </div><!-- .entry-meta -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'striped' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list(' ');

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list();

			if ( ! striped_by_donmik_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( '<span class="tags-links">Tagged: %2$s</span><span class="bookmark-link">Bookmark the <a href="%3$s" rel="bookmark">permalink</a></span>.', 'striped' );
				} else {
					$meta_text = __( '<span class="bookmark-link">Bookmark the <a href="%3$s" rel="bookmark">permalink</a></span>.', 'striped' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( '<span class="cat-links">Posted in %1$s</span><span class="tags-links">Tagged: %2$s</span><span class="bookmark-link">Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.</span>', 'striped' );
				} else {
					$meta_text = __( '<span class="cat-links">Posted in %1$s</span><span class="bookmark-link">Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.</Span>', 'striped' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
		?>

		<?php edit_post_link( __( 'Edit', 'striped' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
