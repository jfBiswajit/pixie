<?php add_action('after_setup_theme', 'sigma_bunch_theme_setup');
function sigma_bunch_theme_setup()
{
	global $wp_version;
	if(!defined('SIGMA_VERSION')) define('SIGMA_VERSION', '1.0');
	if( !defined( 'SIGMA_ROOT' ) ) define('SIGMA_ROOT', get_template_directory().'/');
	if( !defined( 'SIGMA_URL' ) ) define('SIGMA_URL', get_template_directory_uri().'/');	
	include_once get_template_directory() . '/includes/loader.php';
	
	
	load_theme_textdomain('sigma', get_template_directory() . '/languages');
	
	//ADD THUMBNAIL SUPPORT
	add_theme_support('post-thumbnails');
	add_theme_support('woocommerce');
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support('automatic-feed-links'); //Enables post and comment RSS feed links to head.
	add_theme_support('widgets'); //Add widgets and sidebar support
	add_theme_support( "title-tag" );
	add_theme_support( "custom-header" );
	add_theme_support( "custom-background" );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
	/** Register wp_nav_menus */
	if(function_exists('register_nav_menu'))
	{
		register_nav_menus(
			array(
				/** Register Main Menu location header */
				'main_menu1' => esc_html__('Main Menu 1', 'sigma'),
				'main_menu2' => esc_html__('Main Menu 2', 'sigma'),
				'main_menu3' => esc_html__('Main Menu 3', 'sigma'),
				'main_menu4l' => esc_html__('Main Menu 4 Left', 'sigma'),
				'main_menu4r' => esc_html__('Main Menu 4 Right', 'sigma'),
				'main_menu5l' => esc_html__('Main Menu 5 Left', 'sigma'),
				'main_menu5r' => esc_html__('Main Menu 5 Right', 'sigma'),
				'main_menu6' => esc_html__('Main Menu 6', 'sigma'),
			)
		);
	}
	if ( ! isset( $content_width ) ) $content_width = 960;
	add_image_size( 'sigma_550x550', 550, 550, true ); //'sigma_550x550 Portfolio'
	add_image_size( 'sigma_480x550', 480, 550, true ); //'sigma_480x550 Team & blog'
	add_image_size( 'sigma_960x480', 960, 480, true ); //'sigma_960x480 Portfolio V2'
	add_image_size( 'sigma_480x960', 480, 960, true ); //'sigma_480x960 Portfolio V2'
	add_image_size( 'sigma_960x960', 960, 960, true ); //'sigma_960x960 Portfolio V2'
	add_image_size( 'sigma_1170x500', 1170, 500, true ); //'sigma_1170x500 Blog'
	add_image_size( 'sigma_60x60', 60, 60, true ); //'sigma_1170x500 Blog'
}

function sigma_gutenberg_editor_palette_styles() {
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => esc_html__( 'strong yellow', 'sigma' ),
            'slug' => 'strong-yellow',
            'color' => '#f7bd00',
        ),
        array(
            'name' => esc_html__( 'strong white', 'sigma' ),
            'slug' => 'strong-white',
            'color' => '#fff',
        ),
		array(
            'name' => esc_html__( 'light black', 'sigma' ),
            'slug' => 'light-black',
            'color' => '#242424',
        ),
        array(
            'name' => esc_html__( 'very light gray', 'sigma' ),
            'slug' => 'very-light-gray',
            'color' => '#797979',
        ),
        array(
            'name' => esc_html__( 'very dark black', 'sigma' ),
            'slug' => 'very-dark-black',
            'color' => '#000000',
        ),
    ) );
	
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name' => esc_html__( 'Small', 'sigma' ),
			'size' => 10,
			'slug' => 'small'
		),
		array(
			'name' => esc_html__( 'Normal', 'sigma' ),
			'size' => 15,
			'slug' => 'normal'
		),
		array(
			'name' => esc_html__( 'Large', 'sigma' ),
			'size' => 24,
			'slug' => 'large'
		),
		array(
			'name' => esc_html__( 'Huge', 'sigma' ),
			'size' => 36,
			'slug' => 'huge'
		)
	) );
	
}
add_action( 'after_setup_theme', 'sigma_gutenberg_editor_palette_styles' );

function sigma_bunch_widget_init()
{
	global $wp_registered_sidebars;
	$theme_options = _WSH()->option();
	register_sidebar(array(
	  'name' => esc_html__( 'Default Sidebar', 'sigma' ),
	  'id' => 'default-sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown on the right-hand side.', 'sigma' ),
	  'before_widget'=>'<div id="%1$s" class="widget sidebar-widget %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<h5 class="widget-title">',
	  'after_title' => '</h5>'
	));
	register_sidebar(array(
	  'name' => esc_html__( 'Footer Sidebar', 'sigma' ),
	  'id' => 'footer-sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown in Footer Area.', 'sigma' ),
	  'before_widget'=>'<div id="%1$s" class="col-sm-3 footer-widget %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<h5 class="widget-title">',
	  'after_title' => '</h5>'
	));
	register_sidebar(array(
	  'name' => esc_html__( 'Blog Listing', 'sigma' ),
	  'id' => 'blog-sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown on the right-hand side.', 'sigma' ),
	  'before_widget'=>'<div id="%1$s" class="widget sidebar-widget %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<h5 class="widget-title">',
	  'after_title' => '</h5>'
	));
	if( !is_object( _WSH() )  )  return;
	$sidebars = sigma_set(sigma_set( $theme_options, 'dynamic_sidebar' ) , 'dynamic_sidebar' ); 
	foreach( array_filter((array)$sidebars) as $sidebar)
	{
		if(sigma_set($sidebar , 'topcopy')) continue ;
		
		$name = sigma_set( $sidebar, 'sidebar_name' );
		
		if( ! $name ) continue;
		$slug = sigma_bunch_slug( $name ) ;
		
		register_sidebar( array(
			'name' => $name,
			'id' =>  sanitize_title( $slug ) ,
			'before_widget' => '<div id="%1$s" class="side-bar widget sidebar_widget %2$s">',
			'after_widget' => "</div>",
			'before_title' => '<div class="sec-title"><h3>',
			'after_title' => '</h3></div>',
		) );		
	}
	
	update_option('wp_registered_sidebars' , $wp_registered_sidebars) ;
}
add_action( 'widgets_init', 'sigma_bunch_widget_init' );

// Update items in cart via AJAX
function sigma_load_head_scripts() {
	$options = _WSH()->option();
    if ( !is_admin() ) {
		$protocol = is_ssl() ? 'https://' : 'http://';
		if( sigma_set($options, 'map_api_key') ){
		$map_path = '?key='.sigma_set($options, 'map_api_key');
		wp_enqueue_script( 'map-api', ''.$protocol.'maps.google.com/maps/api/js'.$map_path, array(), false, false );}
	}
}
add_action( 'wp_enqueue_scripts', 'sigma_load_head_scripts' );

//global variables
function sigma_bunch_global_variable() {
    global $wp_query;
}

function sigma_enqueue_scripts() {
	$options = _WSH()->option();
    //styles
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_style( 'sigma-icons', get_template_directory_uri() . '/css/sigma-icons.min.css' );
	wp_enqueue_style( 'jquery-fancybox', get_template_directory_uri() . '/css/jquery.fancybox.css' );
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css' );
	wp_enqueue_style( 'jquery-ytplayer', get_template_directory_uri() . '/css/jquery.mb.ytplayer.min.css' );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.min.css' );
	wp_enqueue_style( 'sigma-main-style', get_stylesheet_uri() );
	if(is_page('home-demo-02')){
		wp_enqueue_style( 'sigma-custom-style-two', get_template_directory_uri() . '/css/demo2/custom.css' );
		wp_enqueue_style( 'sigma-pages-style-two', get_template_directory_uri() . '/css/demo2/pages-style.css' );
	}
	elseif(is_page('home-demo-03')){
		wp_enqueue_style( 'sigma-custom-style-three', get_template_directory_uri() . '/css/demo3/custom.css' );
		wp_enqueue_style( 'sigma-pages-style-three', get_template_directory_uri() . '/css/demo3/pages-style.css' );
	}
	elseif(is_page('home-demo-04')){
		wp_enqueue_style( 'sigma-custom-style-four', get_template_directory_uri() . '/css/demo4/custom.css' );
		wp_enqueue_style( 'sigma-pages-style-four', get_template_directory_uri() . '/css/demo4/pages-style.css' );
	}
	elseif(is_page('home-demo-05')){
		wp_enqueue_style( 'sigma-custom-style-five', get_template_directory_uri() . '/css/demo5/custom.css' );
		wp_enqueue_style( 'sigma-pages-style-five', get_template_directory_uri() . '/css/demo5/pages-style.css' );
	}
	elseif(is_page('home-demo-06')){
		wp_enqueue_style( 'sigma-custom-style-six', get_template_directory_uri() . '/css/demo6/custom.css' );
		wp_enqueue_style( 'sigma-pages-style-six', get_template_directory_uri() . '/css/demo6/pages-style.css' );
	}
	else{
		wp_enqueue_style( 'sigma-custom-style', get_template_directory_uri() . '/css/custom-style.css' );
		wp_enqueue_style( 'sigma-pages-style', get_template_directory_uri() . '/css/pages-style.css' );
	}
	wp_enqueue_style( 'sigma-custom', get_template_directory_uri() . '/css/custom.css' );
	if(class_exists('woocommerce')) wp_enqueue_style( 'sigma-woocommerce', get_template_directory_uri() . '/css/woocommerce.css' );
	wp_enqueue_style( 'sigma-tut-style', get_template_directory_uri() . '/css/tut.css' );
	wp_enqueue_style( 'sigma-gutenberg', get_template_directory_uri() . '/css/gutenberg.css' );
	wp_enqueue_style( 'sigma-responsive', get_template_directory_uri() . '/css/responsive.css' );
	
	
    //scripts
	wp_enqueue_script( 'jquery-ui-core', array( 'jquery' ), '2.1.2', true);
	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'jquery-easing', get_template_directory_uri().'/js/jquery.easing.min.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'jquery-viewport', get_template_directory_uri().'/js/jquery.viewport.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'hover', get_template_directory_uri().'/js/hover.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'superfish', get_template_directory_uri().'/js/superfish.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'jquery-fancybox', get_template_directory_uri().'/js/jquery.fancybox.pack.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri().'/js/owl.carousel.min.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'jquery-stellar', get_template_directory_uri().'/js/jquery.stellar.min.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'imagesloaded-pkgd', get_template_directory_uri().'/js/imagesloaded.pkgd.min.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'isotope', get_template_directory_uri().'/js/isotope.pkgd.min.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'jquery-easypiechart', get_template_directory_uri().'/js/jquery.easypiechart.min.js', array( 'jquery' ), '2.1.2', true );
	if( sigma_set($options, 'map_api_key') ){
	wp_enqueue_script( 'sigma-gmap', get_template_directory_uri().'/js/gmap3.min.js', array( 'jquery' ), '2.1.2', true );
	}
	wp_enqueue_script( 'jquery-simple-counter', get_template_directory_uri().'/js/jquery.simple.counter.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'instafeed', get_template_directory_uri().'/js/instafeed.min.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'jquery-ytplayer', get_template_directory_uri().'/js/jquery.mb.ytplayer.min.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'jquery-countdown', get_template_directory_uri().'/js/jquery.countdown.min.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'wow', get_template_directory_uri().'/js/wow.min.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'sigma-main-script', get_template_directory_uri().'/js/custom.js', array(), false, true );
	if( is_singular() ) wp_enqueue_script('comment-reply');
}
add_action( 'wp_enqueue_scripts', 'sigma_enqueue_scripts' );

/*-------------------------------------------------------------*/
function sigma_theme_slug_fonts_url() {
    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $muli = _x( 'on', 'Muli font: on or off', 'sigma' );
	$noto = _x( 'on', 'Noto font: on or off', 'sigma' );
	$poppins = _x( 'on', 'Poppins font: on or off', 'sigma' );
 
    if ( 'off' !== $muli || 'off' !== $noto || 'off' !== $poppins ) {
        $font_families = array();
 
        if ( 'off' !== $muli ) {
            $font_families[] = 'Muli:300,300i,400,400i,700,700i';
        }
		
		if ( 'off' !== $noto ) {
            $font_families[] = 'Noto Serif:400,400i';
        }
		
		if ( 'off' !== $poppins ) {
            $font_families[] = 'Poppins:300,400,500,600,700';
        }
		
        $opt = get_option('sigma'.'_theme_options');
		if ( sigma_set( $opt, 'body_custom_font' ) ) {
			if ( $custom_font = sigma_set( $opt, 'body_font_family' ) )
				$font_families[] = $custom_font . ':300,300i,400,400i,600,700';
		}
		if ( sigma_set( $opt, 'use_custom_font' ) ) {
			$font_families[] = sigma_set( $opt, 'h1_font_family' ) . ':300,300i,400,400i,600,700';
			$font_families[] = sigma_set( $opt, 'h2_font_family' ) . ':300,300i,400,400i,600,700';
			$font_families[] = sigma_set( $opt, 'h3_font_family' ) . ':300,300i,400,400i,600,700';
			$font_families[] = sigma_set( $opt, 'h4_font_family' ) . ':300,300i,400,400i,600,700';
			$font_families[] = sigma_set( $opt, 'h5_font_family' ) . ':300,300i,400,400i,600,700';
			$font_families[] = sigma_set( $opt, 'h6_font_family' ) . ':300,300i,400,400i,600,700';
		}
		$font_families = array_unique( $font_families);
        
		$query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 		$protocol = is_ssl() ? 'https://' : 'http://';
        $fonts_url = add_query_arg( $query_args, ''.$protocol.'fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}
function sigma_theme_slug_scripts_styles() {
    wp_enqueue_style( 'sigma-theme-slug-fonts', sigma_theme_slug_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'sigma_theme_slug_scripts_styles' );
add_action( 'admin_enqueue_scripts', 'sigma_theme_slug_scripts_styles' );
/*---------------------------------------------------------------------*/
function sigma_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'admin_init', 'sigma_add_editor_styles' );


/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */ 
function sigma_woo_related_products_limit() {
  global $product;
  $options = _WSH()->option();
  
  $num = sigma_set($options, 'number_of_products_per_page');
  $num = ($num) ? $num : 6;
 
 $args['posts_per_page'] = $num;
 return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'sigma_jk_related_products_args' );
  function sigma_jk_related_products_args( $args ) {
 $options = _WSH()->option();
 
 $rel_num = sigma_set($options, 'number_of_related_products');
    $rel_num = ($rel_num) ? $rel_num : 3;
  
 $args['posts_per_page'] = $rel_num; // 4 related products
 $args['columns'] = $rel_num; // arranged in 2 columns
 return $args;
}