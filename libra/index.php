<?php get_header(); ?>

<div id="contents">			<!-- contentns -->
<div id="main">
<div id="entry_body">

<!-- main_top 728*90 -->
<?php if(is_mobile()) { ?>
<?php } else { ?>
<?php dynamic_sidebar( 'main-top' ); ?>
<?php } ?>
<!-- //main_top 728*90 -->

<?php if (have_posts()) {
$i = 0;
while (have_posts()) {
	the_post();
		?>	<div class="sec_article">

			<section>

				<!--
				<div class="thumb_box">
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
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
					<p class="new_entry_title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
					<div class="eb_cat"><i class="fa fa-folder-open-o"></i><?php the_category(' ') ?> <?php the_tags(' ', ' ', ' '); ?></div>
				</div>

				<div class="clear"></div>
			</section>

		</div><!--//home_area-->
<?php
}
}else {
	?>
<p>記事がありません</p>
<?php
}?>

<?php //<!--ページナビ-->?>
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
<?php /*
<!-- main_bottom 728*90 -->
<?php dynamic_sidebar( 'main-bottom' ); ?>
<!-- //main_bottom 728*90 -->


<?php get_header(); ?>
<div id="content">
<?php
	while(have_posts()) {
		the_post();
		get_template_part('content');
		if( is_singular('post') ) {
			comments_template();
		}
	} ?>
</div>
*/ ?>
</div><!--//entry_body-->
</div><!--//main-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
