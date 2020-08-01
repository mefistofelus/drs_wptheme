<?php
/**
 * drs functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package drs
 */

if ( ! defined( '_S_VERSION' ) ) {
        // Replace the version number of the theme on each release.
        define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'drs_setup' ) ) :
        /**
         * Sets up theme defaults and registers support for various WordPress features.
         *
         * Note that this function is hooked into the after_setup_theme hook, which
         * runs before the init hook. The init hook is too late for some features, such
         * as indicating support for post thumbnails.
         */
        function drs_setup() {
                /*
                 * Make theme available for translation.
                 * Translations can be filed in the /languages/ directory.
                 * If you're building a theme based on drs, use a find and replace
                 * to change 'drs' to the name of your theme in all the template files.
                 */
                load_theme_textdomain( 'drs', get_template_directory() . '/languages' );

                // Add default posts and comments RSS feed links to head.
                add_theme_support( 'automatic-feed-links' );

                /*
                 * Let WordPress manage the document title.
                 * By adding theme support, we declare that this theme does not use a
                 * hard-coded <title> tag in the document head, and expect WordPress to
                 * provide it for us.
                 */
                add_theme_support( 'title-tag' );

                /*
                 * Enable support for Post Thumbnails on posts and pages.
                 *
                 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
                 */
                add_theme_support( 'post-thumbnails' );

                // This theme uses wp_nav_menu() in one location.
                register_nav_menus(
                        array(
                                'menu-1' => esc_html__( 'Main menu', 'drs' ),
                        )
                );

                /*
                 * Switch default core markup for search form, comment form, and comments
                 * to output valid HTML5.
                 */
                add_theme_support(
                        'html5',
                        array(
                                'search-form',
                                'comment-form',
                                'comment-list',
                                'gallery',
                                'caption',
                                'style',
                                'script',
                        )
                );

                // Set up the WordPress core custom background feature.
                add_theme_support(
                        'custom-background',
                        apply_filters(
                                'drs_custom_background_args',
                                array(
                                        'default-color' => 'ffffff',
                                        'default-image' => '',
                                )
                        )
                );

                // Add theme support for selective refresh for widgets.
                add_theme_support( 'customize-selective-refresh-widgets' );

                /**
                 * Add support for core custom logo.
                 *
                 * @link https://codex.wordpress.org/Theme_Logo
                 */
                add_theme_support(
                        'custom-logo',
                        array(
                                'height'      => 250,
                                'width'       => 250,
                                'flex-width'  => true,
                                'flex-height' => true,
                        )
                );
        }
endif;
add_action( 'after_setup_theme', 'drs_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function drs_content_width() {
        // This variable is intended to be overruled from themes.
        // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
        // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
        $GLOBALS['content_width'] = apply_filters( 'drs_content_width', 640 );
}
add_action( 'after_setup_theme', 'drs_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function drs_widgets_init() {
        register_sidebar(
                array(
                        'name'          => esc_html__( 'Home Sidebar', 'drs' ),
                        'id'            => 'homepage-sidebar',
                        'description'   => esc_html__( 'Add widgets here.', 'drs' ),
                        'before_widget' => '<section id="%1$s" class="widget %2$s">',
                        'after_widget'  => '</section>',
                        'before_title'  => '<h6 class="text-primary text-lg-left border-left shadow-2 font-weight-bold pl-2 py-2 mb-2 mt-3">',
                        'after_title'   => '</h6>',
                )
        );

        register_sidebar(
                array(
                        'name'          => esc_html__( 'Pages Sidebar', 'drs' ),
                        'id'            => 'page-sidebar',
                        'description'   => esc_html__( 'Add widgets here.', 'drs' ),
                        'before_widget' => '<section id="%1$s" class="widget %2$s">',
                        'after_widget'  => '</section>',
                        'before_title'  => '<h6 class="text-primary text-lg-left border-left shadow-2 font-weight-bold pl-2 py-2 mb-2 mt-3">',
                        'after_title'   => '</h6>',
                )
        );
        register_sidebar(
                array(
                        'name'          => esc_html__( 'Pages Vijet', 'drs' ),
                        'id'            => 'page-vijet',
                        'description'   => esc_html__( 'Add widgets here.', 'drs' ),
                        'before_widget' => '<section id="%1$s" class="widget %2$s">',
                        'after_widget'  => '</section>',
                        'before_title'  => '<h6 class="text-primary text-lg-left border-left shadow-2 font-weight-bold pl-2 py-2 mb-2 mt-3">',
                        'after_title'   => '</h6>',
                )
        );		
}
add_action( 'widgets_init', 'drs_widgets_init' );

/**
 * Custom Birthdays Shortcodes
 */

add_shortcode( 'cards', 'shortcode_cards' );

function shortcode_cards( $atts ) {
    ob_start();

    // белый список параметров
    $atts = shortcode_atts( [
        'template' => '',
    ], $atts );

    /**
     * Подключает файл по пути:
     * мой_домен/wp-content/themes/моя_тема/template-parts/переданное_имя_файла.php
     */
    get_template_part( "template-parts/birthday/{$atts['template']}" );

    return ob_get_clean();
}

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');

/**
 * Enqueue scripts and styles.
 */
function drs_scripts() {
        // STYLES
        wp_enqueue_style( 'Main_Style', get_stylesheet_uri() );
        wp_enqueue_style( 'Font_Awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
        wp_enqueue_style( 'MDB', get_template_directory_uri() . '/css/mdb5/mdb.min.css' );
        wp_enqueue_style( 'custom-old-styles-css', get_template_directory_uri() . '/css/custom-style-old.css' );
        wp_enqueue_style( 'Style', get_template_directory_uri() . '/css/style.css' );
        wp_enqueue_style( 'jScrollPane-css', get_template_directory_uri() . '/js/jScrollPane/jScrollPane.css' );
        wp_enqueue_style( 'chat-css', get_template_directory_uri() . '/css/chat.css' );

        // SCRIPTS
        wp_enqueue_script( 'MDB', get_template_directory_uri() . '/js/mdb5/mdb.min.js', array(), '1.0.0', true );
        wp_enqueue_script( 'Script', get_template_directory_uri() . '/js/script.js', array('jquery', 'jSP', 'jMW'), '1.0.0', true );
		

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
        }

        // CUSTOM JQUERY DEPENDENCIES
        if( is_home() ) {

                wp_deregister_script( 'jquery' );
                wp_enqueue_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js', array(), '1.4.2', false);
                wp_enqueue_script( 'jquery' );
                wp_enqueue_script( 'jSP', get_template_directory_uri() . '/js/jScrollPane/jScrollPane.min.js', array('jquery'), '1.0.0', true );
                wp_enqueue_script( 'jMW', get_template_directory_uri() . '/js/jScrollPane/jquery.mousewheel.js', array('jquery'), '1.0.0', true );
        }

}
add_action( 'wp_enqueue_scripts', 'drs_scripts' );

add_filter( 'excerpt_length', function(){
        return 30;
} );

add_filter('excerpt_more', function($more) {
        return '...';
});

// breadcrumbs
function the_breadcrumb(){
 
        // получаем номер текущей страницы
        $pageNum = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
 
        $separator = ' &raquo; '; //  »
 
        // если главная страница сайта
        if( is_front_page() ){
 
                if( $pageNum > 1 ) {
                        echo '<a href="' . site_url() . '">Головна</a>' . $separator . $pageNum . ' сторінка';
                } else {
                        echo 'Ви знаходитесь на головній сторінці';
                }
 
        } else { // не главная
 
                echo '<a href="' . site_url() . '">Головна</a>' . $separator;
 
 
                if( is_single() ){ // записи
 
                        the_category(', '); echo $separator; the_title();
 
                } elseif ( is_page() ){ // страницы WordPress 
 
                        the_title();
 
                } elseif ( is_category() ) {
 
                        single_cat_title();
 
                } elseif( is_tag() ) {
 
                        single_tag_title();
 
                } elseif ( is_day() ) { // архивы (по дням)
 
                        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $separator;
                        echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $separator;
                        echo get_the_time('d');
 
                } elseif ( is_month() ) { // архивы (по месяцам)
 
                        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $separator;
                        echo get_the_time('F');
 
                } elseif ( is_year() ) { // архивы (по годам)
 
                        echo get_the_time('Y');
 
                } elseif ( is_author() ) { // архивы по авторам
 
                        global $author;
                        $userdata = get_userdata($author);
                        echo 'Опублікував(ла) ' . $userdata->display_name;
 
                } elseif ( is_404() ) { // если страницы не существует
 
                        echo 'Помилка 404';
 
                }
 
                if ( $pageNum > 1 ) { // номер текущей страницы
                        echo ' (' . $pageNum . ' сторінка)';
                }
 
        }
 
}
// breadcrumbs

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
        require get_template_directory() . '/inc/jetpack.php';
}