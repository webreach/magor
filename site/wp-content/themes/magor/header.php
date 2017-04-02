<!DOCTYPE html>
<html class="no-js">
<head>
	<title><?php wp_title('•', true, 'right'); bloginfo('name'); ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
	<link rel='stylesheet' id='magor' href='<?php bloginfo( 'template_url' ); ?>/theme/css/magor.css' type='text/css' media='all' />
</head>
<body <?php body_class(); ?>>
<img style="width:100%;" src="<?php bloginfo( 'template_url' ); ?>/images/logomain.jpg" />
<nav class="navbar navbar-topbar navbar-dark">
	<button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
		&#9776;
	</button>
	<div class="collapse navbar-toggleable-xs" id="collapsingNavbar">
		<?php
			wp_nav_menu( array(
				'theme_location'	=> 'navbar',
				'container'         => false,
				'menu_class'		=> 'nav navbar-nav',
				'fallback_cb'		=> '__return_false',
				'items_wrap'		=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'depth'				=> 2,
				'walker'            => new b4st_walker_nav_menu()
			) );
		?>
		<img id="menubottom" src="<?php bloginfo( 'template_url' ); ?>/images/menubuttom.jpg" />
	</div>
</nav>
<div class="container">
	<div class="row" id="youface">
		<div class="col-sm-12">
			<a href="https://www.youtube.com/user/magorofficial" target="_blank"><img style="margin-left:10px;" src="<?php bloginfo( 'template_url' ); ?>/images/youtube.png" /></a>
			<a href="https://www.facebook.com/MagorBand" target="_blank"><img src="<?php bloginfo( 'template_url' ); ?>/images/facemed.png" /></a>
		</div>
	</div>
</div>
<?php /*
Site Title
==========
If you are displaying your site title in the "brand" link in the Bootstrap navbar, 
then you probably don't require a site title. Alternatively you can use the example below. 
See also the accompanying CSS example in theme/css/b4st.css .

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <h1 id="site-title">
      	<a class="text-muted" href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a>
      </h1>
    </div>
  </div>
</div>
*/ ?>
