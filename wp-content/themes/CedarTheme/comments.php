<?php
 
	/**
	 * COMMENTS TEMPLATE
	 */

?>

	<?php if(comments_open() != false): ?>

	<section class="comments">

		<?php

			if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
				die ('Please do not load this page directly.');

			if (!empty($post->post_password)) {
				if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {
					?><p class="graybar"><?php esc_html_e('This post is password protected. Enter the password to view comments.', ECKO_THEME_ID); ?></p><?php
					return;
				}
			}

		?>

		<section class="commentheader">
			<div class="wrapper">
				<i class="fa fa-comments-o"></i>
				<span class="commenttitle"><?php esc_html_e('Comments', ECKO_THEME_ID); ?></span>
				<span class="commentcount"><?php comments_number( '0', '1', '%' ); ?></span>
			</div>
		</section>

		<section class="commentitems">
			<div class="wrapper">

		<?php if(have_comments()): ?>

				<ul class="commentwrap">
					<?php wp_list_comments('type=comment&callback=cedar_comment_format'); ?>
				</ul>

			<?php previous_comments_link() ?>
			<?php next_comments_link() ?>

		 <?php else : ?>
			<?php if(comments_open()): ?>

				<div class="notification"><i class="fa fa-info"></i> <?php esc_html_e('There are currently no comments.', ECKO_THEME_ID); ?></div>

			<?php endif; ?>
		<?php endif; ?>

		<?php

			if (comments_open()){
				$args = array(
					'id_form'           => 'commentform',
					'id_submit'         => 'submit',
					'title_reply'       => '',
					'title_reply_to'    => '<div class="graybar"><i class="fa fa-comments-o"></i>' . esc_html__('Leave a Reply to', ECKO_THEME_ID) . ' %s' . '</div>',
					'cancel_reply_link' => esc_html__( 'Cancel Reply', ECKO_THEME_ID),
					'label_submit'      => esc_html__( 'Post Comment', ECKO_THEME_ID),
					'comment_field' =>  '<textarea placeholder="' . esc_attr__('Add your comment here', ECKO_THEME_ID) . '..." name="comment" class="commentbody" id="comment" rows="5" tabindex="4"></textarea>',
					'comment_notes_after' => '',
					'comment_notes_before' => '',
					'fields' => apply_filters( 'comment_form_default_fields', array(
						'author' =>
							'<input type="text" placeholder="' . esc_attr__('Name', ECKO_THEME_ID) . ' ' . ( $req ?  '(' . esc_attr__('Required', ECKO_THEME_ID) . ')' : '') . '" name="author" id="author" value="' . esc_attr($comment_author) . '" size="22" tabindex="1" ' . ($req ? "aria-required='true'" : '' ). ' />',

						'email' =>
							'<input type="text" placeholder="' . esc_attr__('Email', ECKO_THEME_ID) . ' ' . ( $req ? '(' . esc_attr__('Required', ECKO_THEME_ID) . ')' : '') . '" name="email" id="email" value="' . esc_attr($comment_author_email) . '" size="22" tabindex="1" ' . ($req ? "aria-required='true'" : '' ). ' />',

						'url' =>
							'<input type="text" placeholder="' . esc_attr__('Website URL', ECKO_THEME_ID) . '" name="url" id="url" value="' . esc_attr($comment_author_url) . '" size="22" tabindex="1" />'

						)
					)

				);
				comment_form($args);
			}

		?>

			</div>
		</section>

	</section>

<?php endif; ?>