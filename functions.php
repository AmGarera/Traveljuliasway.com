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
		$context['gallery'] = "/wp-content/themes/twig-wp-theme/static/Gallery.png";
		$context['slideshow'] = "/wp-content/themes/twig-wp-theme/static/Slideshow.png";
		$context['RibbonCenter'] = "/wp-content/themes/twig-wp-theme/static/JuliaContact.png";
		$context['RibbonSide'] = "/wp-content/themes/twig-wp-theme/static/Julia_greenbanner.png";
		$context['posts'] = new TimberPost(28); // It's a new TimberPost object, but an existing post from WordPress.
		$context['lls'] = "/wp-content/themes/twig-wp-theme/static/LongLiveSimple.png";
		$context['countryBanner'] = "/wp-content/themes/twig-wp-theme/static/ExplorebyCountry_ribbon.png";
		$context['heroRibbon'] = "/wp-content/themes/twig-wp-theme/static/Hero_ribbon.png";
		// Home Page Gallery
		$context['home1'] = "/wp-content/themes/twig-wp-theme/static/BEL%2B-%2BBurssels%2B-%2BGrand%2BPlace6.jpg";
		$context['home2'] = "/wp-content/themes/twig-wp-theme/static/AT+-+Vienna+x2+01.jpg";
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
