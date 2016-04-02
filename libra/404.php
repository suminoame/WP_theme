<?php get_header(); ?>

<div id="contents"><!-- contentns -->
<div id="main">
<div id="entry_body">

<header>
<h3>404－Not Found</h3>
</header><?php /*
<img src="<?php echo get_template_directory_uri(); ?>/images/sorry-404.png" alt="404" width="600" height="400" style="margin-bottom: 36px" />
*/ ?>
<p>指定したURLは正体不明のページです。<br></p>
<ul>
<li><a href="<?php echo home_url();?>" title="<?php bloginfo('name'); ?>">トップに戻る</a></li>
</ul>

</div><!--//entry_body-->
</div><!--//main-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
