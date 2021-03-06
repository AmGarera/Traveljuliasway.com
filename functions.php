<?php

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
	});
	
	add_filter('template_include', function($template) {
		return get_stylesheet_directory() . '/static/no-timber.html';
	});
	
	return;
}

Timber::$dirname = array('templates', 'views');

class StarterSite extends TimberSite {

	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}

	function register_post_types() {
		//this is where you can register custom post types
	}

	function register_taxonomies() {
		//this is where you can register custom taxonomies
	}

	function add_to_context( $context ) {
		$context['foo'] = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::get_context();';
		$context['menu'] = new TimberMenu();
		$context['site'] = $this;
		// $context['gallery'] = "/wp-content/themes/twig-wp-theme/static/Gallery.png";
		$context['slideshow'] = "/wp-content/themes/twig-wp-theme/static/Slideshow.png";
		$context['RibbonCenter'] = "/wp-content/themes/twig-wp-theme/static/JuliaContact.png";
		$context['RibbonSide'] = "/wp-content/themes/twig-wp-theme/static/Julia_greenbanner.png";
		// $context['postss'] = new TimberPost(28); // It's a new TimberPost object, but an existing post from WordPress.
		$context['lls'] = "/wp-content/themes/twig-wp-theme/static/LongLiveSimple.png";
		$context['countryBanner'] = "/wp-content/themes/twig-wp-theme/static/ExplorebyCountry_ribbon.png";
		$context['heroRibbon'] = "/wp-content/themes/twig-wp-theme/static/Hero_ribbon.png";
		$context['Gifted'] = "/wp-content/themes/twig-wp-theme/static/GIFTED_Logo_Horiz_Member377x116.fw.png";
		$context['affluent'] = "/wp-content/themes/twig-wp-theme/static/AffluentTravelerCollection-logo.png";
		$context['storyposts'] = Timber::get_posts();
		$context['sig'] = "/wp-content/themes/twig-wp-theme/static/Juliasignature.png";
		// Social Media Icons
		$context['facebook'] = "/wp-content/themes/twig-wp-theme/static/FacebookIcon.png";
		$context['instagram'] = "/wp-content/themes/twig-wp-theme/static/InstagramIcon.png";
		$context['twitter'] = "/wp-content/themes/twig-wp-theme/static/TwitterIcon.png";
		$context['youtube'] = "/wp-content/themes/twig-wp-theme/static/YouTubeIcon.png";
		// Home Page Gallery
		$context['home1'] = "/wp-content/themes/twig-wp-theme/static/home1.png";
		$context['home2'] = "/wp-content/themes/twig-wp-theme/static/2_PlitviceLakesNationalParkCroatia.png";
		$context['home3'] = "/wp-content/themes/twig-wp-theme/static/3_BoraBora.png";
		$context['home4'] = "/wp-content/themes/twig-wp-theme/static/4_Ecuador.png";
		$context['home5'] = "/wp-content/themes/twig-wp-theme/static/5_CassisFrance.png";
		$context['home6'] = "/wp-content/themes/twig-wp-theme/static/6_PenangMalaysia.png";
		
		// Home Thumbnails
		$context['home7'] = "/wp-content/themes/twig-wp-theme/static/1_VeniceItaly_small.png";
		$context['home8'] = "/wp-content/themes/twig-wp-theme/static/2_PlitviceLakesNationalParkCroatia_small.png";
		$context['home9'] = "/wp-content/themes/twig-wp-theme/static/3_BoraBora_small.png";
		$context['home10'] = "/wp-content/themes/twig-wp-theme/static/4_Ecuador_small.png";
		$context['home11'] = "/wp-content/themes/twig-wp-theme/static/5_CassisFrance_small.png";
		$context['home12'] = "/wp-content/themes/twig-wp-theme/static/6_PenangMalaysia_small.png";
		// Page Hero's
		// $context['destinations'] = "/wp-content/themes/twig-wp-theme/static/destinations.png";
		
		
		// Other page heros
		$context['destinations'] = "/wp-content/themes/twig-wp-theme/static/Destinations_hero.png";
		$context['gallery'] = "/wp-content/themes/twig-wp-theme/static/Gallery_hero.png";
		$context['stories'] = "/wp-content/themes/twig-wp-theme/static/StoriesfromtheRoad_hero.png";
		$context['testimonial'] = "/wp-content/themes/twig-wp-theme/static/Testimonials_hero.png";
		$context['tipsguide'] = "/wp-content/themes/twig-wp-theme/static/Tips&Guides_hero.png";
		$context['services'] = "/wp-content/themes/twig-wp-theme/static/Services_hero.png";
		$context['upcomingtrips'] = "/wp-content/themes/twig-wp-theme/static/UpcomingEvents_hero.png";
		$context['meetjulia'] = "/wp-content/themes/twig-wp-theme/static/MeetJulia_hero.png";
		
		$context['country'] = new TimberTerm('France');
		return $context;
	}

	function myfoo( $text ) {
		$text .= ' bar!';
		return $text;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own functions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter('myfoo', new Twig_SimpleFilter('myfoo', array($this, 'myfoo')));
		return $twig;
	}

}

new StarterSite();
