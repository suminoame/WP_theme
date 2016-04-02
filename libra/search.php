<?php
/*
Template Name: Search Page
*/
?>
<?php get_header(); ?>

<div id="contents"><!-- contentns -->
<div id="main">
<div id="entry_body">
<div id="article_body">
<article>
<header>
<?php if(!is_home()): ?>


<?php else: ?>
<?php endif; ?>

  <!--roop-->
  <?php $allsearch =& new WP_Query("s=$s&posts_per_page=-1");
  $key = wp_specialchars($s, 1);
  $count = $allsearch->post_count;
  if($count!=0){
  // 検索結果を表示:該当記事あり
      echo '<p>“<strong>'.$key.'</strong>”で検索した結果、<strong>'.$count.'</strong>件の記事が見つかりました。</p>';
  }
  else {
  // 検索結果を表示:該当記事なし
      echo '<p>“<strong>'.$key.'</strong>”で検索した結果、関連する記事は見つかりませんでした。</p>';
  }
  ?>

  <div id="search_result">
  <?php if (have_posts()) {
  $i = 0;
  while (have_posts()) {
  	the_post();
  	?>
  <div class="search_area">
    <div class="sec_article">
  			<section>
  				<ul>
            <div class="search_img">
  				<li>
  				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="img_link">
  						<?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
  							<?php
  							$title= get_the_title();
  							the_post_thumbnail(array( 75,75 ),
  							array( 'alt' =>$title, 'title' => $title)); ?>
  						<?php else: // サムネイルを持っていないときの処理 ?>
  							<img src="<?php echo get_template_directory_uri(); ?>/images/no-img.png" alt="no image" title="no image" width="75" height="75" />
  						<?php endif; ?>
  					</a>
  			</li>
      </div>
  			<li>
  				<div class="search_artbox">
            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="search_top_r">
  						<?php the_time('Y/m/d') ?>
  					</a>
            <br>
  					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="img_link">
              <?php the_title(); ?>
            </a>
            <br>
  					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="img_link">
  					  <?php echo mb_substr(get_the_excerpt(), 0, 200); ?>
  					</a>
  				</div>
  			</li>
  				<div class="clear"></div>
  	</ul>
  	</a>
  			</section>
      </div>
		</div><!--//search_area-->
  <?php
  }
  }else {	?>
    <?php echo 'キーワードを変えて再度お試しください。'; ?>
    <div class="search_notfound">
      <h3>最近の投稿</h3>
    <?php
    $args = array(
        'posts_per_page' => 5,
    );
    $st_query = new WP_Query($args);
    ?>

    <?php if( $st_query->have_posts() ): ?>
    <?php while ($st_query->have_posts()) : $st_query->the_post(); ?>

    <div class="side_new">
    <div class="side_thumb">
      <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="img_link">
    <?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
    <?php the_post_thumbnail( 'thumb100' ); ?>
    <?php else: // サムネイルを持っていないときの処理 ?>
    <img src="<?php echo get_template_directory_uri(); ?>/images/no-img.png" alt="no image" title="no image" width="100" height="100" />
    <?php endif; ?></div></a>
    <div class="side_title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="img_link"><span><?php echo get_post_time('Y.m.d D'); ?></span></a>
      <br />
      <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></div></a>
    </div><?php //<!--//side_new-->?>
    <div class="clear"></div>
    <?php endwhile; ?>
    <?php else: ?>
    <p>まだ記事がありません。</p>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
  </div>
  <?php
  }?>
  </div><!--//search_result-->

  <!--//roop-->

</article>
</div><!--//article_body-->
</div><!--//entry_body-->
</div><!--//main-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
