<?

$args_footer_menu_1 = [
	'theme_location' => 'footer-menu-1',
	'container' => '',
	'menu_class' => 'footer-menu-1',
	'menu_id' => 'footer-menu-1'
];
$args_footer_menu_2 = [
	'theme_location' => 'footer-menu-2',
	'container' => '',
	'menu_class' => 'footer-menu-2',
	'menu_id' => 'footer-menu-2'
];

?>
		<div id="footer">
			<div class="container">
				<div class="footer-info">
					<div class="row ">
						<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 footer-logo">
							<a href="/">
								<? dynamic_sidebar('logo_widget'); ?>
							</a>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 footer-widge-1">
							<? dynamic_sidebar('footer_widget_1') ?>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 footer-menu">
							<? wp_nav_menu($args_footer_menu_1) ?>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 footer-menu" style="border-left: 0;">
							<? wp_nav_menu($args_footer_menu_2) ?>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 footer-widget-2">
							<? dynamic_sidebar('footer_widget_2') ?>
						</div>
					</div>
				</div>

				<? if (is_active_sidebar('footer_copyright')) : ?>
					<div class="row">
						<div class="col-lg-12 copiryght">
							<? dynamic_sidebar('footer_copyright'); ?>
						</div>
					</div>
				<? endif; ?>

			</div>
		</div>
		<? do_action('wp_footer') ?>
 	</div>
</body>
