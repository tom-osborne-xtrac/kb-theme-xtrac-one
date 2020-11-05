<?php 
	global $post, $current_user;

	wp_get_current_user();
		if( current_user_can( 'edit_others_posts', $post->ID ) || ($post->post_author == $current_user->ID) || current_user_can('level_10')) : ?>
			<span class="editButton">
					<a href="<?php echo get_edit_post_link( get_the_ID() ); ?>" class="button-grey" title="Edit"><img src="http://172.20.20.135/wp-content/themes/xtrac-one/images/pencil-edit-button.png" width="16px"></a>
			</span>
		<?php endif; ?>
<!-- END EDIT BUTTON -->
