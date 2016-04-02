<?php

function raindrops_monthly_archive_prev_next_navigation(){
	global $wpdb, $wp_query;

	if( is_month() ){
	    if ( have_posts() ) {
			$thisyear 	= mysql2date('Y', $wp_query->posts[0]->post_date);
			$thismonth 	= mysql2date('m', $wp_query->posts[0]->post_date);
		}else{
			return;
		}

		$unixmonth 	= mktime(0, 0 , 0, $thismonth, 1, $thisyear);
		$last_day 	= date('t', $unixmonth);

		$previous 	= $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year	FROM $wpdb->posts
			WHERE post_date < '$thisyear-$thismonth-01'
			AND post_type = 'post' AND post_status = 'publish'
				ORDER BY post_date DESC
				LIMIT 1");
		$next 		= $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year FROM $wpdb->posts
			WHERE post_date > '$thisyear-$thismonth-{$last_day} 23:59:59'
			AND post_type = 'post' AND post_status = 'publish'
				ORDER BY post_date ASC
				LIMIT 1");

		$html 		= '<a href="%1$s" class="%3$s">%2$s</a>';

		if ( $previous ) {
			$calendar_output = sprintf( $html,
										get_month_link($previous->year,
										$previous->month) ,
										sprintf(__('%sth','Raindrops'),
										$previous->month),
										'alignleft'
									  );
		}
		$calendar_output .= "\t" ;
		if ( $next ) {
			$calendar_output .= sprintf($html,
										get_month_link($next->year,
										$next->month),
										sprintf(__('%sth','Raindrops'),
										$next->month),
										'alignright'
										);
		}

		$html = '<div class="%1$s">%2$s</div>';

			$calendar_output = sprintf( $html,
										'raindrops_monthly_archive_prev_next_navigation',
										$calendar_output
									);

		echo apply_filters( 'raindrops_monthly_archive_prev_next_navigation', $calendar_output );
	}
}

//無記名のコメント投稿者名を変更する
function rename_anonymous() {
    global $comment;
    if( empty( $comment->comment_author ) ) {
        if( !empty( $comment->user_id ) ) {
            $user = get_userdata( $comment->user_id );
            $author = $user->user_login;
        } else {
            $author = '墨染の名無し';
        }
    } else {
        $author = $comment->comment_author;
    }
    return $author;
}
add_filter( 'get_comment_author', 'rename_anonymous' );
//コメントリスト表示用カスタマイズコード
function mytheme_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <div id="comment-<?php comment_ID(); ?>">
    <div class="comment-listCon">
        <div class="comment-info">
            <?php //echo get_avatar( $comment, 48 );//アバター画像 ?>
            <?php printf(__('名前:<cite class="fn comment-author">%s<span class="admin"></span></a></cite> :'), get_comment_author_link()); //投稿者の設定 ?>
            <span class="comment-datetime">投稿日：<?php printf(__('%1$s at %2$s'), get_comment_date('Y/m/d(D)'),  get_comment_time('H:i:s')); //投稿日の設定 ?></span>
<?php /*            <span class="comment-id">
            ID：<?php //IDっぽい文字列の表示（あくまでIDっぽいものです。）
                $ip01 = get_comment_author_IP(); //書き込んだユーザーのIPアドレスを取得
                $ip02 = get_comment_date(jn); //今日の日付
                $ip03 = ip2long($ip01); //IPアドレスの数値化
                $ip04 = ($ip02) * ($ip03); //ip02とip03を掛け合わせる
                echo mb_substr(base64_encode($ip04), 2, 9); //base64でエンコード、頭から9文字まで出力
            ?>
            </span>
*/ ?>
            <span class="comment-edit"><?php edit_comment_link(__('Edit'),'  ',''); //編集リンク ?></span>
        </div>
        <?php if ($comment->comment_approved == '0') : ?>
            <em><?php _e('Your comment is awaiting moderation.') ?></em>
        <?php endif; ?>
        <div class="comment-text"></div>
        <?php comment_text(); //コメント本文 ?>
        <?php //返信機能は不要なので削除 ?>
    </div>
</div>
</li>
<?php
}


//投稿画像用クラス付け
add_filter( 'image_send_to_editor', 'remove_img_attr' );
function remove_img_attr( $html ) {
	$class = 'img_link';
	return str_replace( '<a ', '<a class="'. $class. '" ', $html );
}

/*カスタムメニューのIDやクラスを簡略化*/
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
 return is_array($var) ? array_intersect($var, array('current-menu-item')) : '';
}



//jQuery読み込み
function load_script(){
    wp_enqueue_script('jquery');
}
add_action('init', 'load_script');

//アイキャッチサムネイル生成
add_theme_support('post-thumbnails');
add_image_size('thumb100',100,100,true);
add_image_size('thumb110',110,110,true);

//投稿スラッグ自動生成・日本語を使う場合は削除
function auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
    if ( preg_match( '/(%[0-9a-f]{2})+/', $slug ) ) {
        $slug = utf8_uri_encode( $post_type ) . '-' . $post_ID;
    }
    return $slug;
}
add_filter( 'wp_unique_post_slug', 'auto_post_slug', 10, 4  );

//RSS出力
add_theme_support('automatic-feed-links');

//エディタスタイル
add_theme_support('editor-style');
add_editor_style('editor-style.css');
function custom_editor_settings( $initArray ){
	$initArray['body_class'] = 'editor-area';
	return $initArray;
}
add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );

//画像に重ねる文字の色
define('HEADER_TEXTCOLOR', '');

//画像に重ねる文字を非表示にする
define('NO_HEADER_TEXT',true);

//投稿用ファイルを読み込む
get_template_part('functions/create-thread');

//カスタム背景
add_theme_support( 'custom-background' );

//ヘッダー整理
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );

//セルフピンバック禁止
function no_self_ping( &$links ) {
    $home = home_url();
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, $home ) )
            unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_ping' );

//ウイジェット追加
if (function_exists('register_sidebar')) {

//サイドバー
register_sidebar( array(
     'name' => __( 'サイドバー' ),
     'id' => 'side-widget',
     'before_widget' => '<li>',
     'after_widget' => '</li>',
     'before_title' => '<h4>',
     'after_title' => '</h4>',
) );

//サイドバー300px広告
register_sidebar( array(
     'name' => __( 'サイド広告300px' ),
     'id' => 'side-ad',
     'description'   => '404ページ規約違反回避のためAdSense以外推奨',
     'before_widget' => '<div>',
     'after_widget' => '</div>',
     'before_title' => '',
     'after_title' => '',
) );

//メイン上部
register_sidebar( array(
     'name' => __( 'メイン上部728px' ),
     'id' => 'main-top',
     'description'   => 'レスポンシブデザイン用AdSense推奨',
     'before_widget' => '<div class="entrybodytop_ad">',
     'after_widget' => '</div>',
     'before_title' => '',
     'after_title' => '',
) );

//メイン下部
register_sidebar( array(
     'name' => __( 'メイン下部728px' ),
     'id' => 'main-bottom',
     'description'   => 'レスポンシブデザイン用AdSense推奨',
     'before_widget' => '<div class="entrybodybottom_ad">',
     'after_widget' => '</div>',
     'before_title' => '',
     'after_title' => '',
) );

//記事下左300広告
register_sidebar( array(
     'name' => __( '記事下左300px' ),
     'id' => 'efa_l',
     'before_widget' => '<div class="efa_left">',
     'after_widget' => '</div>',
     'before_title' => '',
     'after_title' => '',
) );

//記事下右300広告
register_sidebar( array(
     'name' => __( '記事下右300px' ),
     'id' => 'efa_r',
     'description'   => 'スマホでは出力されません。左に広告がない場合は左寄せになります',
     'before_widget' => '<div class="efa_right">',
     'after_widget' => '</div>',
     'before_title' => '',
     'after_title' => '',
) );

//フッター左
register_sidebar( array(
     'name' => __( 'フッター左' ),
     'id' => 'footer_left',
     'before_widget' => '<div>',
     'after_widget' => '</div>',
     'before_title' => '<h2>',
     'after_title' => '</h2>',
) );

//フッター中央
register_sidebar( array(
     'name' => __( 'フッター中' ),
     'id' => 'footer_center',
     'before_widget' => '<li>',
     'after_widget' => '</li>',
     'before_title' => '<h3>',
     'after_title' => '</h3>',
) );

//フッター右
register_sidebar( array(
     'name' => __( 'フッター右' ),
     'id' => 'footer_right',
     'before_widget' => '<li>',
     'after_widget' => '</li>',
     'before_title' => '<h3>',
     'after_title' => '</h3>',
) );
}

//更新日の追加
function get_mtime($format) {
    $mtime = get_the_modified_time('Ymd');
    $ptime = get_the_time('Ymd');
    if ($ptime > $mtime) {
        return get_the_time($format);
    } elseif ($ptime === $mtime) {
        return null;
    } else {
        return get_the_modified_time($format);
    }
}

//スマホ表示分岐
function is_mobile(){
    $useragents = array(
        'iPhone', // iPhone
        'iPod', // iPod touch
        'Android.*Mobile', // 1.5+ Android *** Only mobile
        'Windows.*Phone', // *** Windows Phone
        'dream', // Pre 1.5 Android
        'CUPCAKE', // 1.5+ Android
        'blackberry9500', // Storm
        'blackberry9530', // Storm
        'blackberry9520', // Storm v2
        'blackberry9550', // Storm v2
        'blackberry9800', // Torch
        'webOS', // Palm Pre Experimental
        'incognito', // Other iPhone browser
        'webmate' // Other iPhone browser

    );
    $pattern = '/'.implode('|', $useragents).'/i';
    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

// コメントフォームタグ削除
add_filter( "comment_form_defaults", "my_comment_notes_after");
function my_comment_notes_after( $defaults){
    $defaults['comment_notes_after'] = '';
    return $defaults;
}

//更新日選択
add_action( 'admin_menu', 'add_update_level_custom_box' );
add_action( 'save_post', 'save_custom_field_postdata' );

function add_update_level_custom_box() {
    add_meta_box( 'update_level', '更新日を変更しますか？', 'html_update_level_custom_box', 'post', 'side', 'high' );
}

function html_update_level_custom_box() {
    $update_level = get_post_meta( $_GET['post'], 'update_level' );

    echo '<div style="padding-top: 3px; overflow: hidden;">';
    echo '<div style="width: 100px; float: left;"><input name="update_level" type="radio" value="high" ';
    if( $update_level[0]=="" || $update_level[0]=="high" ) echo ' checked="checked"';
    echo ' />変更する</div><div style="width: 100px; float: left;"><input name="update_level" type="radio" value="low" ';
    if( $update_level[0]=="low" ) echo ' checked="checked"';
    echo '/>変更しない<br /></div>';
    echo '</div>';
}

function save_custom_field_postdata( $post_id ) {
    $mydata = $_POST['update_level'];
    if( "" == get_post_meta( $post_id, 'update_level' )) {
        add_post_meta( $post_id, 'update_level', $mydata, true ) ;
    } elseif( $mydata != get_post_meta( $post_id, 'update_level' )) {
        update_post_meta( $post_id, 'update_level', $mydata ) ;
    } elseif( "" == $mydata ) {
        delete_post_meta( $post_id, 'update_level' ) ;
    }
}

add_filter( 'wp_insert_post_data', 'my_insert_post_data', 10, 2 );
function my_insert_post_data( $data, $postarr ){
    $mydata = $_POST['update_level'];
    if( $mydata == "low" ){
        unset( $data["post_modified"] );
        unset( $data["post_modified_gmt"] );
    }
    return $data;
}

?>
