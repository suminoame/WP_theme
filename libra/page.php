<?php get_header(); ?>

<div id="contents"><!-- contentns -->
<div id="main">
<div id="entry_body">
<div id="article_body">
<article>
<header>
<?php if(!is_home()): ?>
<?php /*
<div class="topic_path">
  <div id="breadcrumb">
    <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"> <a href="<?php echo home_url(); ?>" itemprop="url"> <span itemprop="title">ホーム</span> </a> &gt; </div>
    <?php $postcat = get_the_category(); ?>
    <?php $catid = $postcat[0]->cat_ID; ?>
    <?php $allcats = array($catid); ?>
    <?php
while(!$catid==0) {
    $mycat = get_category($catid);
    $catid = $mycat->parent;
    array_push($allcats, $catid);
}
array_pop($allcats);
$allcats = array_reverse($allcats);
?>
    <?php foreach($allcats as $catid): ?>
    <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"> <a href="<?php echo get_category_link($catid); ?>" itemprop="url"> <span itemprop="title"><?php echo get_cat_name($catid); ?></span> </a> &gt; </div>
    <?php endforeach; ?>
  </div>
</div><!--//topic_path-->
*/ ?>

<?php else: ?>
<?php endif; ?>
<?php
if(is_page("illustration") || is_page("photo")) { ?>
  <h1 id="single_title"><?php the_title(); ?></h1>
  </header>
  <?php the_content(); ?>
  <?php wp_link_pages(); ?>
<?php
}else {
  ?>
  <!--roop-->
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<h1 id="single_title"><?php the_title(); ?></h1>
</header>

<?php the_content(); ?>
<?php wp_link_pages(); ?>

  <?php endwhile; else: ?>
  <p>記事がありません</p>
  <?php endif; ?>
  <!--//roop-->
<?php
} ?>
</article>
</div><!--//article_body-->
</div><!--//entry_body-->
</div><!--//main-->
<?php
if(!is_page('about') || is_page('contact')) {
    get_sidebar();
}
 ?>
<?php get_footer(); ?>
