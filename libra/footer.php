</div><!--//contents-->
<div id="copy_right">
  <p><small>&copy;<?php bloginfo('name'); ?></small></p>
</div>
<!-- footer -->
<footer id="footer">
<?php //<!--フッター分岐--> ?>
<?php if(is_mobile()) { ?>
<?php //<!--スマホ表示エリア--> ?>
<ul class="top-home">
<li><a href="#header"><i class="fa fa-arrow-up"></i><br />TOP</a></li>
<li><a href="<?php echo home_url();?>"><i class="fa fa-home"></i><br />HOME</a></li>
</ul>
<?php //<!--//スマホ表示エリア--> ?>


<?php } else { ?>
<?php //<!--PC3段 タブレット1+2段--> ?>
<div id="footer-in" class="cleafix">
<?php //<!--フッター左--> ?>
<div class="footer_l">
<?php dynamic_sidebar( 'footer_left' ); ?>
</div><!--//footer_l-->
<?php //<!--フッター中--> ?>
<div class="footer_c">
<ul>
<?php dynamic_sidebar( 'footer_center' ); ?>
</ul>
</div><!--//footer_c-->
<?php //<!--フッター右--> ?>
<div class="footer_r">
<ul>
<?php dynamic_sidebar( 'footer_right' ); ?>
</ul>
</div><!--//footer_r-->
<div class="clear"></div>
</div><!--//footer-in-->
<!--//PC-->
<?php } ?>

</footer>
<!-- //footer -->
<?php wp_footer(); ?>
<?php //<!-- ページトップへ スマホ非表示 --> ?>
<?php if(is_mobile()) { ?>
<?php } else { ?>
<div id="page-top"><a href="#header"><i class="fa fa-arrow-up"></i>
</a></div>
<?php } ?>
<?php //<!-- //ページトップへ--> ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/common.js"></script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id))
{js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";
fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<script type="text/javascript">
  window.___gcfg = {lang: 'ja'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
</body>
</html>
