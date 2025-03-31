<?php
/**
 * School functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage School
 * @since School 1.0
 */

// Adds theme support for post formats.
if ( ! function_exists( 'school_post_format_setup' ) ) :
	/**
	 * Adds theme support for post formats.
	 *
	 * @since School 1.0
	 *
	 * @return void
	 */
	function school_post_format_setup() {
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'school_post_format_setup' );

// Enqueues editor-style.css in the editors.
if ( ! function_exists( 'school_editor_style' ) ) :
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since School 1.0
	 *
	 * @return void
	 */
	function school_editor_style() {
		add_editor_style( get_parent_theme_file_uri( 'assets/css/editor-style.css' ) );
	}
endif;
add_action( 'after_setup_theme', 'school_editor_style' );

// Enqueues style.css on the front.
if ( ! function_exists( 'school_enqueue_styles' ) ) :
	/**
	 * Enqueues style.css on the front.
	 *
	 * @since School 1.0
	 *
	 * @return void
	 */
	function school_enqueue_styles() {
		wp_enqueue_style(
			'school-style',
			get_parent_theme_file_uri( 'style.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'school_enqueue_styles' );

// Registers custom block styles.
if ( ! function_exists( 'school_block_styles' ) ) :
	/**
	 * Registers custom block styles.
	 *
	 * @since School 1.0
	 *
	 * @return void
	 */
	function school_block_styles() {
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'school' ),
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
	}
endif;
add_action( 'init', 'school_block_styles' );

// Registers pattern categories.
if ( ! function_exists( 'school_pattern_categories' ) ) :
	/**
	 * Registers pattern categories.
	 *
	 * @since School 1.0
	 *
	 * @return void
	 */
	function school_pattern_categories() {

		register_block_pattern_category(
			'school_page',
			array(
				'label'       => __( 'Pages', 'school' ),
				'description' => __( 'A collection of full page layouts.', 'school' ),
			)
		);

		register_block_pattern_category(
			'school_post-format',
			array(
				'label'       => __( 'Post formats', 'school' ),
				'description' => __( 'A collection of post format patterns.', 'school' ),
			)
		);
	}
endif;
add_action( 'init', 'school_pattern_categories' );

// Registers block binding sources.
if ( ! function_exists( 'school_register_block_bindings' ) ) :
	/**
	 * Registers the post format block binding source.
	 *
	 * @since School 1.0
	 *
	 * @return void
	 */
	function school_register_block_bindings() {
		register_block_bindings_source(
			'school/format',
			array(
				'label'              => _x( 'Post format name', 'Label for the block binding placeholder in the editor', 'school' ),
				'get_value_callback' => 'school_format_binding',
			)
		);
	}
endif;
add_action( 'init', 'school_register_block_bindings' );

// Registers block binding callback function for the post format name.
if ( ! function_exists( 'school_format_binding' ) ) :
	/**
	 * Callback function for the post format name block binding source.
	 *
	 * @since School 1.0
	 *
	 * @return string|void Post format name, or nothing if the format is 'standard'.
	 */
	function school_format_binding() {
		$post_format_slug = get_post_format();

		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;


function enqueue_lightgallery_frontpage_only() {
    if ( is_front_page() ) {
        // 添加动画 CSS
        wp_enqueue_style(
            'gallery-animations',
            get_template_directory_uri() . '/css/animations.css',
            array(),
            null
        );

        // lightGallery CSS
        wp_enqueue_style(
            'lightgallery-css',
            'https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lightgallery.min.css',
            array(),
            null
        );

        // lightGallery JS
        wp_enqueue_script(
            'lightgallery-js',
            'https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/lightgallery.min.js',
            array(),
            null,
            true
        );

        // init lightgallery
        wp_enqueue_script(
            'lightgallery-init',
            get_template_directory_uri() . '/js/lg-init.js',
            array('lightgallery-js'),
            null,
            true
        );

		wp_enqueue_style(
			'lg-thumbnail-css',
			'https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lg-thumbnail.min.css',
			array(),
			null
		);
		
		// thumbnail 插件的 JS
		wp_enqueue_script(
			'lg-thumbnail-js',
			'https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/thumbnail/lg-thumbnail.min.js',
			array('lightgallery-js'),
			null,
			true
		);

        // 添加全屏模式
        wp_enqueue_style(
            'lg-fullscreen-css',
            'https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lg-fullscreen.min.css',
            array(),
            null
        );
        wp_enqueue_script(
            'lg-fullscreen-js',
            'https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/fullscreen/lg-fullscreen.min.js',
            array('lightgallery-js'),
            null,
            true
        );

        // 添加旋转功能
        wp_enqueue_style(
            'lg-rotate-css',
            'https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lg-rotate.min.css',
            array(),
            null
        );
        wp_enqueue_script(
            'lg-rotate-js',
            'https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/rotate/lg-rotate.min.js',
            array('lightgallery-js'),
            null,
            true
        );

        // 添加分享功能
        wp_enqueue_style(
            'lg-share-css',
            'https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lg-share.min.css',
            array(),
            null
        );
        wp_enqueue_script(
            'lg-share-js',
            'https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/share/lg-share.min.js',
            array('lightgallery-js'),
            null,
            true
        );

        // 添加视频支持
        wp_enqueue_style(
            'lg-video-css',
            'https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lg-video.min.css',
            array(),
            null
        );
        wp_enqueue_script(
            'lg-video-js',
            'https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/video/lg-video.min.js',
            array('lightgallery-js'),
            null,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'enqueue_lightgallery_frontpage_only');

function register_student_post_type() {
    $args = array(
        'labels' => array(
            'name' => 'Students',
            'singular_name' => 'Student',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Student',
            'edit_item' => 'Edit Student',
            'new_item' => 'New Student',
            'view_item' => 'View Student',
            'search_items' => 'Search Students',
            'not_found' => 'No students found',
            'not_found_in_trash' => 'No students found in Trash',
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'student'),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'supports' => array('title', 'editor', 'thumbnail'),
        'template' => array(
            array('core/paragraph', array(
                'placeholder' => 'Write a short biography here...',
            )),
            array('core/button', array(
                'text' => 'View Portfolio',
                'url' => '#'
            )),
        ),
        'template_lock' => 'all',
    );
    register_post_type('student', $args);
}
add_action('init', 'register_student_post_type');

function change_student_title_placeholder($title) {
    $screen = get_current_screen();
    if ('student' === $screen->post_type) {
        $title = 'Add student name';
    }
    return $title;
}
add_filter('enter_title_here', 'change_student_title_placeholder');

function register_student_taxonomy() {
    $args = array(
        'label' => 'Programs',
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
    );
    register_taxonomy('program', 'student', $args);
}
add_action('init', 'register_student_taxonomy');

add_image_size('student-thumb-sm', 200, 200, true); // 小图
add_image_size('student-thumb-lg', 400, 400, true); // 大图

// 添加到媒体库图像选择器中
function add_custom_image_sizes_to_selector($sizes) {
    return array_merge($sizes, array(
        'student-thumb-sm' => 'Student Thumbnail Small',
        'student-thumb-lg' => 'Student Thumbnail Large',
    ));
}
add_filter('image_size_names_choose', 'add_custom_image_sizes_to_selector');

// 注册学生样式
function register_student_styles() {
    wp_enqueue_style('student-styles', get_template_directory_uri() . '/assets/css/students.css', array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'register_student_styles');

// 注册 Staff Post Type
function register_staff_post_type() {
    $args = array(
        'labels' => array(
            'name' => 'Staff',
            'singular_name' => 'Staff Member',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Staff Member',
            'edit_item' => 'Edit Staff Member',
            'new_item' => 'New Staff Member',
            'view_item' => 'View Staff Member',
            'search_items' => 'Search Staff',
            'not_found' => 'No staff members found',
            'not_found_in_trash' => 'No staff members found in Trash',
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'staff',
            'with_front' => false
        ),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => array('title', 'editor', 'thumbnail'),
        'template' => array(
            array('core/paragraph', array(
                'placeholder' => 'Enter job title...',
                'className' => 'staff-job-title'
            )),
            array('core/paragraph', array(
                'placeholder' => 'Enter email address...',
                'className' => 'staff-email'
            )),
        ),
        'template_lock' => 'all',
        'posts_per_page' => -1, // 显示所有文章
        'paged' => false, // 禁用分页
    );
    register_post_type('staff', $args);
}
add_action('init', 'register_staff_post_type');

// 修改 Staff 标题占位符
function change_staff_title_placeholder($title) {
    $screen = get_current_screen();
    if ('staff' === $screen->post_type) {
        $title = 'Add staff name';
    }
    return $title;
}
add_filter('enter_title_here', 'change_staff_title_placeholder');

// 注册 Staff Taxonomy
function register_staff_taxonomy() {
    $args = array(
        'label' => 'Departments',
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'capabilities' => array(
            'manage_terms' => 'manage_options',
            'edit_terms' => 'manage_options',
            'delete_terms' => 'manage_options',
            'assign_terms' => 'edit_posts'
        ),
    );
    register_taxonomy('department', 'staff', $args);
}
add_action('init', 'register_staff_taxonomy');

// 添加 Staff 样式
function register_staff_styles() {
    wp_enqueue_style('staff-styles', get_template_directory_uri() . '/assets/css/staff.css', array(), '1.0.0');
    error_log('Staff styles registered: ' . get_template_directory_uri() . '/assets/css/staff.css');
}
add_action('wp_enqueue_scripts', 'register_staff_styles');

// 添加 AOS 动画库
function enqueue_aos_assets() {
    // AOS CSS
    wp_enqueue_style(
        'aos-css',
        'https://unpkg.com/aos@2.3.1/dist/aos.css',
        array(),
        '2.3.1'
    );

    // AOS JS
    wp_enqueue_script(
        'aos-js',
        'https://unpkg.com/aos@2.3.1/dist/aos.js',
        array(),
        '2.3.1',
        true
    );

    // AOS 初始化
    wp_enqueue_script(
        'aos-init',
        get_template_directory_uri() . '/js/aos-init.js',
        array('aos-js'),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_aos_assets');

// 注册动画区块
function register_animate_block() {
    register_block_type( get_template_directory() . '/build/blocks/animate-block' );
}
add_action( 'init', 'register_animate_block' );

