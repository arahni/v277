<?
/**
 * Theme CSS dir
 */
function themeCssUrl() {
	return get_stylesheet_directory_uri() . '/assets/css/';
}
/**
 * Theme JS dir
 */
function themeJsUrl() {
	return get_stylesheet_directory_uri() . '/assets/js/';
}
/**
 * Include jQuery
 */
function jquery_to_wp_head() {
 	wp_enqueue_script( 'jquery' );
}

add_action( 'wp_enqueue_scripts', 'jquery_to_wp_head' );
/**
 * Include styles
 */
add_action('wp_head', 'initCSS', 9999);
function initCSS() {
    echo '<link rel="stylesheet" href="' . themeCssUrl() . 'lib.min.css" type="text/css" media="all">';
    echo '<link rel="stylesheet" href="' . themeCssUrl() . 'main.min.css" type="text/css" media="all">';
}
/**
 * Include JS before </body>
 */
add_action( 'wp_footer', 'initJSscripts' );
function initJSscripts() {
	wp_deregister_script('libsScript');
    wp_register_script('libsScript', themeJsUrl() . 'libs.min.js', array(), null);
    wp_enqueue_script('libsScript');

	wp_deregister_script('mainScript');
    wp_register_script('mainScript', themeJsUrl() . 'main-script.min.js', array(), null);
    wp_enqueue_script('mainScript');
}
/**
 * remove tag
 */
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
/**
 * register menu
 */
register_nav_menus(
	[
		'header-menu' => 'Шапка сайта',
		'header-menu-mobile' => 'Мобильное меню',
		'footer-menu-1' => 'Меню подвала 1',
		'footer-menu-2' => 'Меню подвала 2',
	]
);
/**
 * register sidebars
 */
function true_register_wp_sidebars() {
	register_sidebar(
		[
			'id' => 'logo_widget',
			'name' => 'Логотип',
			'description' => '',
			'before_widget' => '<div class="logo__block">',
			'after_widget' => '</div>',
			'before_title' => '',
			'after_title' => ''
		]
	);

	register_sidebar(
		[
			'id' => 'footer_widget_1',
			'name' => 'Виджет подвала 1',
			'description' => '',
			'before_widget' => '<div class="footer-widget-1">',
			'after_widget' => '</div>',
			'before_title' => '',
			'after_title' => ''
		]
	);

	register_sidebar(
		[
			'id' => 'footer_widget_2',
			'name' => 'Виджет подвала 2',
			'description' => '',
			'before_widget' => '<div class="footer-widget-2">',
			'after_widget' => '</div>',
			'before_title' => '',
			'after_title' => ''
		]
	);

	register_sidebar(
		[
			'id' => 'footer_copyright',
			'name' => 'COPYRIGHT',
			'description' => '',
			'before_widget' => '<div class="copyright-block">',
			'after_widget' => '</div>',
			'before_title' => '',
			'after_title' => ''
		]
	);
}

add_action( 'widgets_init', 'true_register_wp_sidebars' );
/**
 * register widgets
 */
class SocialLinkWidget extends WP_Widget {

	public static $arrSocialLink = [
			'vk-link' => [
				'name' => 'vk.com',
				'ico' => '<i class="fa fa-vk" aria-hidden="true"></i>'
			],
			'faceboock-link' => [
				'name' => 'facebook.com',
				'ico' => '<i class="fa fa-facebook-square" aria-hidden="true"></i>'
			],
			'youtube-link' => [
				'name' => 'youtube.com',
				'ico' => '<i class="fa fa-youtube-play" aria-hidden="true"></i>'
			],
			'ok-link' => [
				'name' => 'ok.ru',
				'ico' => '<i class="fa fa-odnoklassniki" aria-hidden="true"></i>'
			]
		];

    public function __construct() {
        parent::__construct("social_link_widget", "Ссылки соц.сетей",
            ["description" => "Ссылки на соц.сети"]);
    }

	public function form($instance) {

		if (!empty($instance)) {
			$arrLink = [];

			foreach ($instance as $instKey => $instValue) {

				if ($instKey == 'titleSocLink') {
					$arrLink['titleSocLink'] = $instValue;
					continue;
				};

				$arrLink[$instKey] = $instValue['link'];

			};

    	};

		$linkId = $this->get_field_id('titleSocLink');
		$linkName = $this->get_field_name('titleSocLink');
		echo '<label for="' . $linkId . '">Заголовок</label><br />';
		echo '<input id="' . $linkName . '" type="text" class="widefat" name="' . $linkName . '" value="' . $arrLink['titleSocLink'] . '" /><br /><br />';

		foreach ($this::$arrSocialLink as $keySocialLink => $valueSocialLink){
		    $linkId = $this->get_field_id($keySocialLink);
		    $linkName = $this->get_field_name($keySocialLink);

		    echo '<label for="' . $linkId .'">' . $valueSocialLink['name'] . '</label><br />';
		    echo '<input id="' . $linkId . '" type="text" class="widefat" name="' . $linkName .'"value="' . $arrLink[$keySocialLink] .'"><br /><br />';
		};
	}

	public function update($newInstance, $oldInstance) {
		$linkValue = [];

		foreach ($newInstance as $keyNewInstance => $valueNewInstance){

			if ($keyNewInstance == 'titleSocLink'){
				$linkValue['titleSocLink'] = $valueNewInstance;
				continue;
			}

			$linkValue[$keyNewInstance] = [
				'link' => $valueNewInstance,
				'ico' => $this::$arrSocialLink[$keyNewInstance]['ico']
			];

		};

		return $linkValue;
	}

	public function widget($args, $instance) {

		if ($instance['titleSocLink'] != ""){
			echo '<h3 class="social-link-title">' . $instance['titleSocLink'] . '</h3>';
		}

		echo '<ul class="social-link-list">';

			foreach($instance as $resultKey => $resultValue){

				if ($resultKey != 'titleSocLink'){

					if ($resultValue['link'] != ""){
						$linkSocial = $resultValue['link'];
						$icoSocial = $resultValue['ico'];

						echo '<li class="social-link-item">';
							echo '<a href="' . $linkSocial . '" target="_blank">';
								echo $icoSocial;
							echo '</a>';
						echo '</li>';
					};

				};

			};

		echo '</ul>';

	}
};

add_action("widgets_init", function () {
    register_widget("SocialLinkWidget");
});
