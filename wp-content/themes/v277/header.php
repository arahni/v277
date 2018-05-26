<?

$args_mian_menu = [
	'theme_location' => 'header-menu',
	'container' => '',
	'menu_class' => 'main-menu',
	'menu_id' => 'main-menu'
];
$args_mobail_menu = [
	'theme_location' => 'header-menu-mobile',
	'container' => '',
	'menu_class' => 'mobile-menu',
	'menu_id' => 'mobile-menu'
];

?>


<!DOCTYPE html>
<head>
	<title>Высота 277</title>
	<meta name="description" content="Сайт рок-группы Высота 277. Донбасс. Рок-музыка" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<? do_action(wp_head()) ?>
</head>
<body <? body_class() ?>>
 	<div id="wrapper">
		<div id="header">
			<div class="container">
				<div class="header-origin">
					<div class="row">

						<?php if (is_active_sidebar('logo_widget')) : ?>
							<div class="col-lg-3 col-md-3 col-sm-2 header-logo">
								<a href="/">
									<?php dynamic_sidebar('logo_widget'); ?>
								</a>
							</div>
						<?php endif; ?>

						<div class="col-lg-9 col-md-9 col-sm-10 header-menu">
							<? wp_nav_menu($args_mian_menu) ?>
						</div>
					</div>
				</div>
				<div class="header-mobile">
					<div class="row">
						<?php if (is_active_sidebar('logo_widget')) : ?>
							<div class="col-xs-12 header-logo">
								<a href="/">
									<?php dynamic_sidebar('logo_widget'); ?>
								</a>
								<div class="mobile-menu-bottun">
									<i class="fa fa-bars" aria-hidden="true"></i>
									<i class="fa fa-times" aria-hidden="true"></i>
								</div>
							</div>
						<?php endif; ?>
						<div class="col-xs-12 mobile-menu-box">
							<? wp_nav_menu($args_mobail_menu) ?>
						</div>
					</div>

				</div>
			</div>
		</div>
