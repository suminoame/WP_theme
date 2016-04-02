<?php get_header(); ?>

<div id="contents"><!-- contentns -->
<div id="main">
<div id="entry_body">

<!-- main_top 728*90 -->
<?php if(is_mobile()) { ?>
<?php } else { ?>
<?php dynamic_sidebar( 'main-top' ); ?>
<?php } ?>
<!-- //main_top 728*90 -->

<div id="article_body">
<article>
<header>
<div class="topic_path">
  <div id="breadcrumb">
    <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"> <a href="<?php echo home_url(); ?>" itemprop="url"> <span itemprop="title">ホーム</span> </a> &gt; </div>
  </div>
</div>

<!--roop-->
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<h1 id="single_title"><?php the_title(); ?></h1>
<div class="meta_box">
  <ul>
<li class="day"><p><i class="fa fa-calendar"></i><a href="<?php echo home_url(),"/archives/date",the_time('/Y/m/d');?>"><?php the_time('Y/m/d') ?></a></p></li>
<li class="cat"><i class="fa fa-folder-open-o"></i><?php the_category(' ') ?></li>
</ul>
</div><!--//meta_box-->

</header>
<div class="article_main ">
<?php the_content(); ?>
</div>
<?php wp_link_pages(); ?>
<?php if(has_tag()==true) { ?>
<div id="cat_tag"><span><?php the_tags('<i class="fa fa-tag"></i> ', ' ', ' '); ?></span></div>
<?php } ?>
<div id="entry_footer_ad">
<aside>
<?php if(is_mobile()) { ?>
<?php dynamic_sidebar( 'efa_l' ); ?>
<?php } else { ?>
<?php dynamic_sidebar( 'efa_l' ); ?>
<?php dynamic_sidebar( 'efa_r' ); ?>
<?php } ?>
<div class="clear"></div>
</aside>
</div><!--//ad-->

<footer>


<?php //get_template_part('sns');?>
</footer>
  <?php endwhile; else: ?>
  <p>記事がありません</p>
  <?php endif; ?>
<!--roop-->

</article>
</div><!--//article_body-->


<div id="page_pn" class="clearfix">
  <ul id="prenex">
    <li class="next">
      <?php
        $next_post = get_next_post();
        if (!empty( $next_post )): ?>
        <?php
          //http://www.crystalsnowman.com/?p=467 より
	         $next_post_title = $next_post->post_title;
	         if ( mb_strlen( $next_post_title ) > 15 ) { $next_post_title = mb_substr( $next_post_title, 0, 15).'...'; } ?>
                <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" title="<?php echo $next_post->post_title; ?>"> <?php echo $next_post_title; ?></a>
                <?php echo "　≪　次の記事"; ?>
      <?php endif; ?>
    </li>
    <li class="prev">
      <?php
        $previous_post = get_previous_post();
        if (!empty( $previous_post )): ?>
        <?php
          //http://www.crystalsnowman.com/?p=467 より
	         $pre_post_title = $previous_post->post_title;
	         if ( mb_strlen( $pre_post_title ) > 15 ) { $pre_post_title = mb_substr( $pre_post_title, 0, 15).'...'; }
           echo "前の記事　≫　"; ?>
		      <a href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>" title="<?php echo $previous_post->post_title; ?>"> <?php echo $pre_post_title; ?></a>
      <?php endif; ?>
    </li>
  </ul>
</div><!--//page_pn-->

<div id="relations">
<h3>関連記事-こちらもどうぞ</h3>
<ul class="rel-in clearfix">
<?php
$categories = get_the_category($post->ID);
$category_ID = array();
foreach($categories as $category):
array_push( $category_ID, $category -> cat_ID);
endforeach ;
$args = array(
'post__not_in' => array($post -> ID),
//表示する関連ページの数
'posts_per_page'=> 4,
'category__in' => $category_ID,
'orderby' => 'rand',
);
$st_query = new WP_Query($args); ?>
          <?php
if( $st_query -> have_posts() ): ?>
          <?php
while ($st_query -> have_posts()) : $st_query -> the_post(); ?>

<li>
 <ul class="clearfix">
  <li class="rel-in-thumb"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="img_link">
   <?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
   <?php echo get_the_post_thumbnail($post->ID, 'thumb110'); ?>
   <?php else: // サムネイルを持っていないときの処理 ?>
   <img src="<?php echo get_template_directory_uri(); ?>/images/no-img.png" alt="no image" title="no image" width="110" /><?php endif; ?></a></li>
  <li class="rel-in-ttl"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
 </ul>
</li>
<?php endwhile; ?>
<?php else: ?>
<li class="rel-in-noentry">関連記事はありませんでした。</li>
<?php endif; wp_reset_postdata(); ?>
</ul>
</div><!--//relations-->
<div class="clear"></div>

<!--comments-->
<?php
if( is_singular('post') ) {
    comments_template();
}
?>
<!--//comments-->



</div><!--//entry_body-->
</div><!--//main-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
