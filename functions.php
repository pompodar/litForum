<?php

// enqueueing styles and scripts

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( 'parenthandle' ), 
        wp_get_theme()->get('Version')
    );
	wp_enqueue_script( 'child-script', get_stylesheet_directory_uri() . '/js/script.js',
        array( 'jquery' ));
		wp_register_script( 'aos', 'https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js', array('jquery') );
wp_enqueue_script('aos');
		wp_register_script( 'rellax', 'https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js', array('jquery') );
wp_enqueue_script('rellax');
wp_enqueue_script('rellax-js', get_stylesheet_directory_uri() . '/js/rellax.js', array('jquery'));
        wp_enqueue_script('aos-js', get_stylesheet_directory_uri() . '/js/aos.js', array('jquery'));
		
}

// adding login and register buttons

add_filter( 'wp_nav_menu_items', 'rkk_add_auth_links', 10 , 2 );
function rkk_add_auth_links( $items, $args ) {
 if ( !is_user_logged_in() ) {
	 $items .= "<li><a href='/login'>увійти або зареєструватися</a></li>";
  }
  $items .= "<li><a class='faq-menu'>контакти</a></li>";
 return $items;
}

// disabling admin bar except for admins

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}

// footer

add_action( 'generate_credits', 'generate_add_footer_info', 15 );
	/**
	 * Add the copyright to the footer
	 *
	 * @since 0.1
	 */
	function generate_add_footer_info() {
		$copyright = sprintf(
			'<span class="copyright">&copy; %1$s %2$s</span> &bull; %4$s <span>%5$s</span>',
			date( 'Y' ), // phpcs:ignore
			get_bloginfo( 'name' ),
			esc_url( 'https://generatepress.com' ),
			_x( 'сотворено', 'GeneratePress', 'generatepress' ),
			__( 'GeneratePress', 'generatepress' ),
			'microdata' === generate_get_schema_type() ? ' itemprop="url"' : ''
		);

		echo apply_filters( 'generate_copyright', $copyright ); // phpcs:ignore
	}

	/* 
	modifying replies
	https://www.youtube.com/watch?v=JTysb54CnNs&ab_channel=JakeStack
	*/

	function replies_modifier ($replies) {
		return $replies - 1;
	}

	add_filter('bbp_get_topic_post_count', 'replies_modifier');

	// modifying login

	function login_modifier ($fields) {
		return $fields = array(
	'xoo-el-username' => array(
		'input_type' 		=> 'text',
		'placeholder' 		=>  '',
		'cont_class' 		=> array( 'xoo-aff-group' ),
		'required' 			=> 'yes',
		'autocomplete' => 'email'
	),

	'xoo-el-password' => array(
		'input_type' 	=> 'password',
		'placeholder' 	=> '',
		'cont_class' 	=> array( 'xoo-aff-group' ),
		'required' 		=> 'yes'
	),
	);
	}

	add_filter('xoo_el_login_fields', 'login_modifier');

//BBpress New Topic Button // 
add_shortcode('wpmu_bbp_topic', 'wpmu_bbp_create_new_topic', 10);
function wpmu_bbp_create_new_topic(){
	
	if ( isset($_GET['ForumId']) ){
		
		return do_shortcode("[bbp-topic-form forum_id=".$_GET['ForumId']."]");
		
	}else{
		
		return do_shortcode("[bbp-topic-form]");
		
	}
}
	function custom_menu_item_filter($items, $args) {
        if (is_user_logged_in()) {
            // User is logged in, add the menu item
            $menu_item = '<li class="menu-item"><a href="/forums/forum/usi-tvorinnya/#new-topic-0">поділитися власним творінням</a></li>';
            $items .= $menu_item;
        }
    return $items;
}
add_filter('wp_nav_menu_items', 'custom_menu_item_filter', 2, 2);

function custom_logout_redirect() {
    wp_redirect(home_url()); // Redirect to the homepage
    exit;
}
add_action('wp_logout', 'custom_logout_redirect');

function custom_login_logo() {
    echo '<style type="text/css">
	    body {
			background-color: white !important;
		}
			
        #login h1 a, .login h1 a {
            background-image: url(' . get_stylesheet_directory_uri() . '/img/cropped-—pngtree—feather-pen-write-sign-logo_4775109.png);
            width: 100%;
            background-size: contain;
        }
    </style>';
}

add_action('login_enqueue_scripts', 'custom_login_logo');