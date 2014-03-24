<?php
/* Comment Form */
$args = array(
	'id_form' => 'comment-form-container',
	'id_submit' => 'submit_btn',
	'title_reply' => __( '','textdomain_techblog' ),
	'title_reply_to' => __( 'Leave a Reply to %s','textdomain_techblog' ),
	'cancel_reply_link' => __( 'Cancel Reply','textdomain_techblog' ),
	'label_submit' => __( 'Send Comment','textdomain_techblog' ),
			   
	'comment_field' => '
	<div class="form-box big">
    <label for="comment">Comment <small>*</small></label><textarea cols="60" rows="5" name="comment" id="comment" class="text" placeholder="Message"></textarea>
	</div>
	<div class="clearfix"></div>',
		   
	'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		
	'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		
	'comment_notes_before' => '<p class="comment-notes"></p>',
		
	'comment_notes_after' => '<p class="form-allowed-tags"></p>',
	
	'fields' => apply_filters( 'comment_form_default_fields', array(
		
	'author' => '<div class="form-box">
        <label for="name">Name <small>*</small></label>
		<input type="text" name="author" class="text" id="name" size="50" class="text-input" placeholder="Enter Name" ' . $aria_req . ' /></div>',
			
	'email' => '<div class="form-box">
        <label for="email">Email <small>*</small></label>
		<input type="text" name="email" class="text" id="email" size="50" class="text-input" placeholder="Enter Email" ' . $aria_req . ' /></div>',
		
	'url' => '<div class="form-box last">
        <label for="url">Website </label>
		<input id="url" class="text" name="url" type="text" placeholder="Enter Website URL" /></div>'

		)
			)
				);
?>



<div class="comments-box">
<?php if (get_comments_number() >= 1 ) { ?>
<h3 class="title bottom-1"><?php comments_number() ?></h3><!-- Title Post -->
<hr class="bottom-2">
<?php } ?>
      
      
<ul class="comments">
	<?php wp_list_comments('type=comment&callback=theme_comment'); ?>
</ul><!-- End comments -->
</div>



<div class="comment-form top-4">
<hr class="bottom-2">
<h3 class="title bottom-2">Add Comment</h3><!-- Title Post -->

<?php comment_form( $args ); ?>

</div>