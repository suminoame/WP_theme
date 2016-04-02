<?php get_header(); ?>

<div id="contents"><!-- contentns -->
<div id="main">
<div id="entry_body">
<div id="archive_body">

<!-- main_top 728*90 -->
<?php if(is_mobile()) { ?>
<?php } else { ?>
<?php dynamic_sidebar( 'main-top' ); ?>
<?php } ?>
<!-- //main_top 728*90 -->

<article>
<header>
	<div class="topic_path">
	  <div id="breadcrumb">
	    <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"> <a href="<?php echo home_url(); ?>" itemprop="url"> <span itemprop="title">ホーム</span></a></div>
			<?php if( is_category() ) { ?>
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
	    	<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"> &gt; <?php echo get_cat_name($catid); ?></div>
	    	<?php endforeach; ?>
			<?php } elseif( is_tag() ) { ?>
				<?php echo '&gt; ', single_tag_title(); ?>
			<?php } elseif (is_day()) { ?>
	    	<?php
	    	$topic_year = get_the_time('Y');
				$topic_month = get_the_time('M');
				$topic_day = get_the_time('j');
				?>
				<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"> &gt; <a href="<?php echo get_year_link( $archive_year); ?>" itemprop="url"><span itemprop="title"><?php echo $topic_year; ?></span></a></div>
				<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"> &gt; <a href="<?php echo get_month_link( $archive_year, $archive_month); ?>" itemprop="url"><span itemprop="title"><?php echo $topic_month; ?></span></a></div>
				<?php echo " > ",$topic_day; ?>
			<?php } elseif (is_month()) { ?>
				<?php
	    	$topic_year = get_the_time('Y');
				$topic_month = get_the_time('M');
				?>
				<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"> &gt; <a href="<?php echo get_year_link( $archive_year); ?>" itemprop="url"> <span itemprop="title"><?php echo $topic_year; ?></span></a></div>
	    	<?php echo " > ", $topic_month; ?>
			<?php } elseif (is_year()) { ?>
				<?php
				$topic_year = get_the_time('Y');
				?>
	    	<?php echo " > ",$topic_year; ?>
			<?php } ?>
	  </div>
	</div><?php //<!--//topic_path--> ?>
	<br>

</header>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<!--roop-->

<div class="home_area">

<section>
<div class="thumb_box">
<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="img_link">
<?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
<?php
$title= get_the_title();
the_post_thumbnail(array( 150,150 ),
array( 'alt' =>$title, 'title' => $title)); ?>
<?php else: // サムネイルを持っていないときの処理 ?>
<img src="<?php echo get_template_directory_uri(); ?>/images/no-img.png" alt="no image" title="no image" width="150" height="150" />
<?php endif; ?>
</a>
</div><!--//thumb_box-->

<div class="entry_box">
<p class="date-time"><?php the_time('Y/m/d') ?></p>
<h3 class="new_entry_title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
<div class="eb_cat"><i class="fa fa-folder-open-o"></i><?php the_category('，') ?> &nbsp;&nbsp;<?php the_tags('<i class="fa fa-tag"></i>', '，', ' '); ?></div>
</div>

<div class="clear"></div>
</section>

</div><!--//home_area-->

<?php endwhile; else: ?>
<p>記事がありません</p>
<?php endif; ?>
</article>

<?php //<!--ページナビ--> ?>
<div class="pager">
	<?php global $wp_rewrite;
	$paginate_base = get_pagenum_link(1);
	if(strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()){
		$paginate_format = '';
		$paginate_base = add_query_arg('paged','%#%');
	}
	else{
		$paginate_format = (substr($paginate_base,-1,1) == '/' ? '' : '/') .
		user_trailingslashit('page/%#%/','paged');;
		$paginate_base .= '%_%';
	}
	echo paginate_links(array(
		'base' => $paginate_base,
		'format' => $paginate_format,
		'total' => $wp_query->max_num_pages,
		'mid_size' => 4,
		'current' => ($paged ? $paged : 1),
		'prev_text' => '≪',
		'next_text' => '≫',
	)); ?>
</div>

<!-- main_bottom 728*90 -->
<?php dynamic_sidebar( 'main-bottom' ); ?>
<!-- //main_bottom 728*90 -->

</div><!--//archive_body-->
</div><!--//entry_body-->
</div><!--//main-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
