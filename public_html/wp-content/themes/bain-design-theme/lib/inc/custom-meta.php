<?php

//	Date/author meta ( "Posted On" )

function mbdmaster_posted_on() {
	printf( __( '<div class="byline post-meta meta">&mdash; <span class="author vcard">%7$s,</span>
				<time class="entry-date" datetime="%3$s" pubdate>%4$s</time></div>
		', 'mbdmaster' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'mbdmaster' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}

//	Post meta ( Categories/Tags/etc. )

function mbdmaster_post_meta() {

	$categories_list = get_the_category_list( __( ', ', 'mbdmaster' ) );
	$tag_list = get_the_tag_list( '', __( ', ', 'mbdmaster' ) );

	if ( $categories_list || $tag_list ) {
		echo '<div class="post-meta meta">';
	}

		if ( $categories_list ) {
			echo '<div class="categories-links"><h4 class="visuallyhidden">Categories</h4><i aria-hidden="true" class="icon-folder-open icon-left"></i> ' . $categories_list . '</div>';
		}

		if ( $tag_list ) {
			echo '<div class="tags-links"><h4 class="visuallyhidden">Tags</h4><i aria-hidden="true" class="icon-tags icon-left"></i> ' . $tag_list . '</div>';
		}
	
	if ( $categories_list || $tag_list ) {
		echo '</div>';
	}

}
