<div id="comments-thread">
  <?php
if(have_comments()):
?>
  <h3 id="resp">コメント</h3>
  <ol class="commets-list" type="1">
    <?php wp_list_comments('callback=mytheme_comment'); //コメントの出力をカスタマイズする?>
  </ol>
  <?php
endif;

$comment_field = '<p id="textarea"><label for="comment">' . __( '' ) . '</label><br />'
               . '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';

$args=array(
			'fields' => array(
	        'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'お名前' ) . '</label> ' .
	                    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"'  . ' /></p>',
	        'email'  => '',
	        'url'    => '',
	    ),
	    'comment_field'         => $comment_field,
	    'title_reply'          => 'コメントはこちら',
	    'comment_notes_before' => '',
	    //'comment_notes_after'  => '<p class="form-allowed-tags">内容に問題なければ、下記の「コメントを送信する」ボタンを押してください。</p>',
	    'label_submit'         => 'コメントを送信する',
		'title_reply' => '',
    'lavel_submit' => ('Submit Comment'),
);
comment_form($args);
?>
</div>
<!-- END div#comments-thread -->
