<!DOCTYPE HTML>
<html lang="ja">
<head>
<?php  /*/WP独自のjqueryを無効化、/home/js/内のjsファイルを読み込み ?>
<?php wp_deregister_script('jquery'); ?>
<script type="text/javascript" src="./js/jquery-2.2.2.min.js"></script>
*/ ?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="サイト説明文">
<title><?php
global $page, $paged;
if(is_front_page()) {
  bloginfo('name');
} elseif(is_single()) {
  wp_title('|', true,'right');
  bloginfo('name');
} elseif(is_page()) {
  wp_title('|', true,'right');
  bloginfo('name');
} elseif(is_archive()) {
  if(is_date()) {
    //アーカイブ
    if(is_day()) {
      the_time('n月j日 Y | ');
      bloginfo('name');
    } elseif(is_month()) {
      the_time('n月 Y | ');
      bloginfo('name');
    } elseif(is_year()) {
      the_time('Y | ');
      bloginfo('name');
    }

  } elseif(is_category()) {
    //カテゴリー
    $cat = get_the_category();
    $cat = $cat[0];
    echo get_cat_name($cat->term_id), ' | ';
    bloginfo('name');
  } elseif(is_tag()) {
    //タグ
    echo 'タグ - ', single_tag_title( ), ' | ';
    bloginfo('name');
  }
} elseif(is_search()) {
  echo '検索結果：', the_search_query(), ' | ';
  bloginfo('name');
} elseif(is_404()) {
echo'404 - ';
bloginfo('name');
}

if($paged >= 2 || $page >= 2):
echo'-'.sprintf('%sページ',
max($paged,$page));
endif;
?></title>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" media="all" />

<?php if(is_page('about') || is_page('contact')) {
// サイドバー削除時のスペース確保
  ?>
<style>
#contents #main{
/*box-sizing:border-box;
max-width: 100%;*/
/*margin-left: 18px;*/
width: 950px;
padding: 20px;
background-color: #F6F7F8;
/*Geppaku*/
}
#contents #main #entry_body{
box-sizing:border-box;
width: 100%;
}
#contents #main #entry_body #article_body {
box-sizing:border-box;
width: 100%;
}
</style>
<?php } ?>

<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js" charset="UTF-8"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/css3-mediaqueries.js" charset="UTF-8"></script>
<![endif]-->
<?php wp_head(); ?>
</script>
</head>

<body <?php body_class(); ?>>

<div id="fb-root"></div>
<?php /*
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
*/ ?>
<div id="header"><!-- header -->
<header>
<?php /*
<div class="menubtn"><i class="fa fa-bars"></i>NAVI</div>
<nav id="menu" class="togmenu">
<?php wp_nav_menu(); ?>
*/ ?>

</nav>
<div class="hgroup">
  <h1 class="top_title"><a class="top_header" href="<?php echo home_url();?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
  <nav>
    <ul>
  	<li><a href="<?php echo home_url(); ?>/about" itemprop="url"> <span itemprop="title">About</span></a></li>
  	<li><a href="<?php echo home_url(); ?>/illustration" itemprop="url"> <span itemprop="title">Illustration</span></a></li>
  	<li><a href="<?php echo home_url(); ?>/photo" itemprop="url"> <span itemprop="title">Snapshot</span></a></li>
  	<li><a href="<?php echo home_url(); ?>/contact" itemprop="url"> <span itemprop="title">Contact</span></a></li>
  	</ul>
  </nav>
</div>
</header>
<?php if(is_home()) { ?>
  <div class="rss_tw">
    <ul>
  <li><a href="https://twitter.com/intent/tweet?text=<?php bloginfo('name'); ?>&url=<?php echo home_url(); ?>"><i class="fa fa-twitter"></i>
  </a></li>
  <li><a href="<?php echo home_url();?>/feed/" target="_blank"><i class="fa fa-rss-square"></i>
  </a></li>
</ul>
</div>
<?php
}?>
</div><!-- //header -->
