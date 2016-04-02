<!--sub-->
<div id="sub">
<aside>
<?php
/*
<!--icon-->
<div class="side-sns">
<!-- thnx! http://www.iconsdb.com/ -->
<ul>

<li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i>
</a></li>
<li><a href="https://www.google.com/" target="_blank"><i class="fa fa-google-plus"></i>
</a></li>
<li><a href="<?php echo home_url();?>/feed/" target="_blank"><i class="fa fa-rss"></i>
</a></li>
</ul>
</div>
*/ ?>
<?php /*
<?php //<!--検索フォーム-->?>
<div class="side_contents">
<?php get_search_form(); ?>
</div>
*/ ?>
<?php /*
<!--広告-->
<div class="side_ad">
<?php dynamic_sidebar( 'side-ad' ); ?>
</div>
*/ ?>

<?php //<!--ウィジェット・リスト出力-->?>
<div class="side_contents">
<ul class="side_widget">
  <div class="li_area">
<?php dynamic_sidebar( 'side-widget' ); ?>
</div>
</ul>
</div>
<?php //<!--//side_contents-->?>

<?php //<!--新着記事・ホーム非表示-->?>
<?php if(is_home() || is_search()): ?>
<?php else: ?>
<div class="side_contents">
<h4>Recent</h4>
<?php
$args = array(
    'posts_per_page' => 5,
);
$st_query = new WP_Query($args);
?>

<?php if( $st_query->have_posts() ): ?>
<?php while ($st_query->have_posts()) : $st_query->the_post(); ?>
<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
<div class="side_new">
<div class="side_thumb">
<?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
<?php the_post_thumbnail( 'thumb100' ); ?>
<?php else: // サムネイルを持っていないときの処理 ?>
<img src="<?php echo get_template_directory_uri(); ?>/images/no-img.png" alt="no image" title="no image" width="100" height="100" />
<?php endif; ?></div>
<div class="side_title"><span><?php echo get_post_time('Y.m.d D'); ?></span><br /><?php the_title(); ?></div>
</div></a><?php //<!--//side_new-->?>
<div class="clear"></div>
<?php endwhile; ?>
<?php else: ?>
<p>まだ記事がありません。</p>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
</div>
<?php //<!--//side_contents-->?>
<?php endif; ?>
<?php //<!--新着記事ここまで-->?>

</aside>
</div><!--//sub-->
