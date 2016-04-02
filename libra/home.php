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
<div id="home_article">
<?php if (have_posts()) {
$i = 0;
while (have_posts()) {
	the_post();
	if($i == 0) {
		?>
		<div class="home_area">
			<div class="pri_article">

			<section>
				<header>
				<h1 id="single_title"><a href="<?php the_permalink() ?>" ><?php the_title(); ?></a></h1>
				<div class="meta_box">
					<ul>
				<li class="day"><p><i class="fa fa-calendar"></i><?php the_time('Y/m/d') ?></p></li>
				<li class="cat"><i class="fa fa-folder-open-o"></i><?php the_category(' ') ?></li>
			</ul>
				</div><!--//meta_box-->
				</header>
				<?php the_content("(more...)"); ?>
			</section>
		</div><!--//pri_article-->
		<ul id="comment_btn">
			<li><a class="home_comment" href="<?php echo the_permalink(), "#comment" ?>">&nbsp;Comment&nbsp;</a><li>
			</ul>
		</div><!--//home_area-->
		<?php
	}else {
		?>
<div class="home_area">
		<div class="sec_article">
			<section>
				<ul>
				<li>
				<div class="thumb_box"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="img_link">
						<?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
							<?php
							$title= get_the_title();
							the_post_thumbnail(array( 75,75 ),
							array( 'alt' =>$title, 'title' => $title)); ?>
						<?php else: // サムネイルを持っていないときの処理 ?>
							<img src="<?php echo get_template_directory_uri(); ?>/images/no-img.png" alt="no image" title="no image" width="75" height="75" />
						<?php endif; ?>
					</a>
				</div><!--//thumb_box-->
			</li>
			<li>
				<div class="entry_box"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" >
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" >
						<p class="date-time"><?php the_time('Y/m/d') ?></p>
					</a>
					<a class="new_entry_title" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" >
						<p class="sec_short"> <?php echo mb_substr(get_the_excerpt(), 0, 200); ?>  </p>
					</a>
				</div>
			</li>
				<div class="clear"></div>
	</ul>
	</a>
			</section>
		</div><!--//sec_article-->
		</div><!--//home_area-->
<?php
}
$i++;
}
}else {
	?>
<p>記事がありません</p>
<?php
}?>
</div><!--//home_article-->

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

</div><!--//entry_body-->
</div><!--//main-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
