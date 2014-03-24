<?php
/**
 * Comments Template
 *
 * Lists comments and calls the comment form.  Individual comments have their own templates.  The 
 * hierarchy for these templates is $comment_type.php, comment.php.
 *
 * @package Zenith
 * @subpackage Template
 * @since 0.1
 * @author Tung Do <tung@devpress.com>
 * @copyright Copyright (c) 2013, Tung Do
 * @link http://devpress.com/themes/zenith/
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Kill the page if trying to access this template directly. */
if ( 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
	die( __( 'Please do not load this page directly. Thanks!', 'zenith' ) );

/* If a post password is required or no comments are given and comments/pings are closed, return. */
if ( post_password_required() || ( !have_comments() && !comments_open() && !pings_open() ) )
	return;
?>

<div id="comments-template">

	<div class="comments-template-inner">

		<div id="comments">

			<?php if ( have_comments() ) : ?>

				<h3 class="comments-template-title comments-number"><span><?php comments_number( __( 'No Comments', 'zenith' ), __( 'One Comment', 'zenith' ), __( '% Comments', 'zenith' ) ); ?></span></h3>

				<?php do_atomic( 'before_comment_list' );// zenith_before_comment_list ?>

				<ol class="comment-list">
					<?php wp_list_comments( hybrid_list_comments_args() ); ?>
				</ol><!-- .comment-list -->
				
				<?php if ( get_option( 'page_comments' ) ) : ?>
					<div class="comment-navigation comment-pagination">
						<span class="page-numbers"><?php printf( __( 'Page %1$s of %2$s', 'zenith' ), ( get_query_var( 'cpage' ) ? absint( get_query_var( 'cpage' ) ) : 1 ), get_comment_pages_count() ); ?></span>
						<?php paginate_comments_links(); ?>
					</div><!-- .comment-navigation -->
				<?php endif; ?>

				<?php do_atomic( 'after_comment_list' ); // zenith_after_comment_list ?>
				
			<?php endif; ?>

			<?php if ( pings_open() && !comments_open() ) : ?>

				<p class="comments-closed pings-open">
					<?php printf( __( 'Comments are closed, but <a href="%1$s" title="Trackback URL for this post">trackbacks</a> and pingbacks are open.', 'zenith' ), get_trackback_url() ); ?>
				</p><!-- .comments-closed .pings-open -->

			<?php elseif ( !comments_open() ) : ?>

				<p class="comments-closed">
					<?php _e( 'Comments are closed.', 'zenith' ); ?>
				</p><!-- .comments-closed -->

			<?php endif; ?>

		</div><!-- #comments -->

		<?php comment_form( array( 'title_reply' => __( 'Post Comment', 'zenith' ) ) ); // Loads the comment form. ?>

	</div><!-- .comments-template-inner -->

</div><!-- #comments-template -->