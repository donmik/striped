<?php
/**
 * @package stripedbydonmik
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php /** QUOTE **/ if (get_post_format() == 'quote'): ?>
    
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
	</div><!-- .entry-content -->
    
	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list(' ');
				if ( $categories_list && striped_by_donmik_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'striped' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list();
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged: %1$s', 'striped' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php edit_post_link( __( 'Edit', 'striped' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
    
    <?php /** OTHERS POST FORMATS **/ else: ?>
    
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
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

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'striped' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'striped' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list(' ');
				if ( $categories_list && striped_by_donmik_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'striped' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list();
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged: %1$s', 'striped' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php edit_post_link( __( 'Edit', 'striped' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
    <?php endif; ?>
</article><!-- #post-## -->
