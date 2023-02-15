<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HasteStarter
 */

?>
<section id="comments" class="content-wrap" itemscope itemtype="http://schema.org/Comment">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view all comments.', 'haste-starter' ); ?></p>
</section><!-- #comments -->
		<?php
		return;
	endif;
	if ( have_comments() ) :
		?>
		<h2 id="comments-title" class="page-header">
			<?php
			comments_number( __( '0 Comments', 'haste-starter' ), __( '1 Comment', 'haste-starter' ), __( '% Comments', 'haste-starter' ) );
			echo ' ' . __( 'to', 'haste-starter' ) . ' <span>&quot;' . get_the_title() . '&quot;</span>';
			?>
		</h2>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-above">
				<ul class="pager">
					<li class="previous"><?php previous_comments_link( __( '&larr; Old Comments', 'haste-starter' ) ); ?></li>
					<li class="next"><?php next_comments_link( __( 'New Comments &rarr;', 'haste-starter' ) ); ?></li>
				</ul>
			</nav>
		<?php endif; ?>
		<ul class="media-list">
			<?php wp_list_comments( array( 'callback' => 'haste_starter_comments_loop' ) ); ?>
		</ul>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-above">
				<ul class="pager">
					<li class="previous"><?php previous_comments_link( __( '&larr; Old Comments', 'haste-starter' ) ); ?></li>
					<li class="next"><?php next_comments_link( __( 'New Comments &rarr;', 'haste-starter' ) ); ?></li>
				</ul>
			</nav>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ( ! comments_open() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="nocomments"><?php _e( 'Comments closed.', 'haste-starter' ); ?></p>
	<?php endif; ?>
	<?php
		$commenter     = wp_get_current_commenter();
		$req           = get_option( 'require_name_email' );
		$aria_req      = ( $req ? " aria-required='true'" : '' );
		$html_req      = ( $req ? " required='required'" : '' );
		$html5         = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : null;
		$comment_field = '<div class="comment-form-comment form-group"><label class="control-label" for="comment">' . __( 'Comment', 'haste-starter' ) . ' <span class="required text-danger">*</span></label> ' . '<textarea id="comment" name="comment" class="form-control" cols="45" rows="8" aria-required="true" required="required"></textarea></div>';
		$fields        = array(
			'author' => '<div class="comment-form-author form-group">' . '<label for="author">' . __( 'Name', 'haste-starter' ) . ( $req ? ' <span class="required text-danger">*</span>' : '' ) . '</label> ' .
						'<input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></div>',
			'email'  => '<div class="comment-form-email form-group"><label for="email">' . __( 'E-mail', 'haste-starter' ) . ( $req ? ' <span class="required text-danger">*</span>' : '' ) . '</label> ' .
						'<input id="email" name="email" class="form-control" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req . ' /></div>',
			'url'    => '<div class="comment-form-url form-group"><label for="url">' . __( 'Website', 'haste-starter' ) . '</label> ' .
						'<input id="url" name="url" class="form-control" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>',
		);
		comment_form(
			array(
				'comment_notes_after' => '',
				'comment_field'       => $comment_field,
				'fields'              => apply_filters( 'comment_form_default_fields', $fields ),
				'class_submit'        => 'submit btn btn-default',
			)
		);
		?>
</section><!-- #comments -->
