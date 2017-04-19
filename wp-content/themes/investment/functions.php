<?php
/**
 * Theme sprecific functions and definitions
 */

/* Theme setup section
------------------------------------------------------------------- */

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) $content_width = 1170; /* pixels */

// Add theme specific actions and filters
// Attention! Function were add theme specific actions and filters handlers must have priority 1
if ( !function_exists( 'investment_theme_setup' ) ) {
	add_action( 'investment_action_before_init_theme', 'investment_theme_setup', 1 );
	function investment_theme_setup() {

		// Register theme menus
		add_filter( 'investment_filter_add_theme_menus',		'investment_add_theme_menus' );

		// Register theme sidebars
		add_filter( 'investment_filter_add_theme_sidebars',	'investment_add_theme_sidebars' );

		// Set options for importer
		add_filter( 'investment_filter_importer_options',		'investment_set_importer_options' );

		// Add theme specified classes into the body
		add_filter( 'body_class', 'investment_body_classes' );

		// Set list of the theme required plugins
		investment_storage_set('required_plugins', array(
			'essgrids',
			'instagram_widget',
			'revslider',
//			'tribe_events',
			'trx_utils',
			'visual_composer',
//			'woocommerce',
			)
		);
		
	}
}


// Add/Remove theme nav menus
if ( !function_exists( 'investment_add_theme_menus' ) ) {
	//add_filter( 'investment_filter_add_theme_menus', 'investment_add_theme_menus' );
	function investment_add_theme_menus($menus) {
		//For example:
		//$menus['menu_footer'] = esc_html__('Footer Menu', 'investment');
		//if (isset($menus['menu_panel'])) unset($menus['menu_panel']);
		return $menus;
	}
}


// Add theme specific widgetized areas
if ( !function_exists( 'investment_add_theme_sidebars' ) ) {
	//add_filter( 'investment_filter_add_theme_sidebars',	'investment_add_theme_sidebars' );
	function investment_add_theme_sidebars($sidebars=array()) {
		if (is_array($sidebars)) {
			$theme_sidebars = array(
				'sidebar_main'		=> esc_html__( 'Main Sidebar', 'investment' ),
				'sidebar_footer'	=> esc_html__( 'Footer Sidebar', 'investment' )
			);
			if (function_exists('investment_exists_woocommerce') && investment_exists_woocommerce()) {
				$theme_sidebars['sidebar_cart']  = esc_html__( 'WooCommerce Cart Sidebar', 'investment' );
			}
			$sidebars = array_merge($theme_sidebars, $sidebars);
		}
		return $sidebars;
	}
}


// Add theme specified classes into the body
if ( !function_exists('investment_body_classes') ) {
	//add_filter( 'body_class', 'investment_body_classes' );
	function investment_body_classes( $classes ) {

		$classes[] = 'investment_body';
		$classes[] = 'body_style_' . trim(investment_get_custom_option('body_style'));
		$classes[] = 'body_' . (investment_get_custom_option('body_filled')=='yes' ? 'filled' : 'transparent');
		$classes[] = 'theme_skin_' . trim(investment_get_custom_option('theme_skin'));
		$classes[] = 'article_style_' . trim(investment_get_custom_option('article_style'));
		
		$blog_style = investment_get_custom_option(is_singular() && !investment_storage_get('blog_streampage') ? 'single_style' : 'blog_style');
		$classes[] = 'layout_' . trim($blog_style);
		$classes[] = 'template_' . trim(investment_get_template_name($blog_style));
		
		$body_scheme = investment_get_custom_option('body_scheme');
		if (empty($body_scheme)  || investment_is_inherit_option($body_scheme)) $body_scheme = 'original';
		$classes[] = 'scheme_' . $body_scheme;

		$top_panel_position = investment_get_custom_option('top_panel_position');
		if (!investment_param_is_off($top_panel_position)) {
			$classes[] = 'top_panel_show';
			$classes[] = 'top_panel_' . trim($top_panel_position);
		} else 
			$classes[] = 'top_panel_hide';
		$classes[] = investment_get_sidebar_class();

		if (investment_get_custom_option('show_video_bg')=='yes' && (investment_get_custom_option('video_bg_youtube_code')!='' || investment_get_custom_option('video_bg_url')!=''))
			$classes[] = 'video_bg_show';

		if (investment_get_theme_option('page_preloader')!='')
			$classes[] = 'preloader';

		return $classes;
	}
}


// Preloader load
if ( !function_exists( 'investment_preloader_load' ) ) {
    function investment_preloader_load() {
        if (($preloader=investment_get_theme_option('page_preloader'))!='') {
            $clr = investment_get_scheme_color('bg_color');
            ?>
            <style type="text/css">
                #page_preloader {
                    background-color: <?php echo esc_attr($clr); ?>;
                    background-image:url(<?php echo esc_url($preloader); ?>);
                    background-position:center; background-repeat:no-repeat;
                    position:fixed;
                    z-index:1000000;
                    left:0;
                    top:0;
                    right:0;
                    bottom:0;
                    opacity: 0.8;
                }
            </style>
        <?php
        }
    }
}

// Set theme specific importer options
if ( !function_exists( 'investment_set_importer_options' ) ) {
	//add_filter( 'investment_filter_importer_options',	'investment_set_importer_options' );
	function investment_set_importer_options($options=array()) {
		if (is_array($options)) {
			$options['debug'] = investment_get_theme_option('debug_mode')=='yes';
			$options['domain_dev'] = 'investment.dv.ancorathemes.com';
			$options['domain_demo'] = 'investment.ancorathemes.com';
			$options['menus'] = array(
				'menu-main'	  => esc_html__('Main menu', 'investment'),
				'menu-user'	  => esc_html__('User menu', 'investment'),
				'menu-footer' => esc_html__('Footer menu', 'investment'),
				'menu-outer'  => esc_html__('Main menu', 'investment')
			);
			$options['file_with_attachments'] = array(				// Array with names of the attachments
//				'http://investment.ancorathemes.com/uploads.zip',		// Name of the remote file with attachments
                'http://investment.ancorathemes.com/wp-content/imports/uploads.001',
                'http://investment.ancorathemes.com/wp-content/imports/uploads.002',
                'http://investment.ancorathemes.com/wp-content/imports/uploads.003',
                'http://investment.ancorathemes.com/wp-content/imports/uploads.004',
                'http://investment.ancorathemes.com/wp-content/imports/uploads.005',
                'http://investment.ancorathemes.com/wp-content/imports/uploads.006',
                'http://investment.ancorathemes.com/wp-content/imports/uploads.007',
                'http://investment.ancorathemes.com/wp-content/imports/uploads.008',
                'http://investment.ancorathemes.com/wp-content/imports/uploads.009',
                'http://investment.ancorathemes.com/wp-content/imports/uploads.010',
                'http://investment.ancorathemes.com/wp-content/imports/uploads.011'

			);
			$options['attachments_by_parts'] = true;				// Files above are parts of single file - large media archive. They are must be concatenated in one file before unpacking
		}
		return $options;
	}
}


/* Include framework core files
------------------------------------------------------------------- */
// If now is WP Heartbeat call - skip loading theme core files (to reduce server and DB uploads)
// Remove comments below only if your theme not work with own post types and/or taxonomies
//if (!isset($_POST['action']) || $_POST['action']!="heartbeat") {
	get_template_part('fw/loader');
//}
/**
 * Registering a new user.
 */
add_action('template_redirect', 'register_user');
 
function register_user(){
  if(isset($_GET['do']) && $_GET['do'] == 'register'):
    $errors = array();
    if(empty($_POST['user'])) 
       $errors[] = 'Please enter a fullname.<br>';
    if(empty($_POST['email'])) 
       $errors[] = 'Please enter a email.<br>';
    if(empty($_POST['pass'])) 
       $errors[] = 'Please enter a password.<br>';
    if(empty($_POST['cpass'])) 
       $errors[] = 'Please enter a confirm password.<br>';
    if((!empty($_POST['cpass']) && !empty($_POST['pass'])) && ($_POST['pass'] != $_POST['cpass'])) 
       $errors[] = 'Entered password did not match.';
    $user_login = esc_attr($_POST['user']);
    $user_email = esc_attr($_POST['email']);
    $user_pass = esc_attr($_POST['pass']);
    $user_confirm_pass = esc_attr($_POST['cpass']);
    $user_phone = esc_attr($_POST['phone']);
    $sanitized_user_login = sanitize_user($user_login);
    $user_email = apply_filters('user_registration_email', $user_email);
  
    if(!is_email($user_email)) 
       $errors[] = 'Invalid e-mail.<br>';
    elseif(email_exists($user_email)) 
       $errors[] = 'This email is already registered.<br>';
  
    if(empty($sanitized_user_login) || !validate_username($user_login)) 
       $errors[] = 'Invalid user name.<br>';
    elseif(username_exists($sanitized_user_login)) 
       $errors[] = 'User name already exists.<br>';
  
    if(empty($errors)):
      $user_id = wp_create_user($sanitized_user_login, $user_pass, $user_email);
  
    if(!$user_id):
      $errors[] = 'Registration failed';
    else:
      update_user_option($user_id, 'default_password_nag', true, true);
      wp_new_user_notification($user_id, $user_pass);
      update_user_meta ($user_id, 'user_phone', $user_phone);
      wp_cache_delete ($user_id, 'users');
      wp_cache_delete ($user_login, 'userlogins');
      do_action ('user_register', $user_id);
      $user_data = get_userdata ($user_id);
      if ($user_data !== false) {
         wp_clear_auth_cookie();
         wp_set_auth_cookie ($user_data->ID, true);
         do_action ('wp_login', $user_data->user_login, $user_data);
         // Redirect user.
         wp_redirect ('?page_id=213');
         exit();
       }
      endif;
    endif;
  
    if(!empty($errors)) 
      define('REGISTRATION_ERROR', serialize($errors));
  endif;
}
function my_login_redirect( $url, $request, $user ){
    if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
        if( $user->has_cap( 'administrator' ) ) {
            $url = admin_url();
        } else {
            $url = home_url('/dashboard/');
        }
    }
    return $url;
}
add_filter('login_redirect', 'my_login_redirect', 10, 3 );
function login_failed() {
  $login_page  = home_url( '/login/' );
  wp_redirect( $login_page . '?login=failed' );
  exit;
}
add_action( 'wp_login_failed', 'login_failed' );
 
function verify_username_password( $user, $username, $password ) {
  $login_page  = home_url( '/login/' );
    if( $username == "" || $password == "" ) {
        wp_redirect( $login_page . "?login=empty" );
        exit;
    }
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);
add_filter( 'body_class', 'my_neat_body_class');
function my_neat_body_class( $classes ) {
if ( is_page('login'))
$classes[] = 'login';
return $classes;
}
//* Redirect WordPress Logout to Home Page
add_action('wp_logout',create_function('','wp_redirect(home_url());exit();'));

require_once 'sub-functions.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-/class-phpass.php';
/**
 * Disable Admin Bar for All Users Except for Administrators
 */
function remove_admin_bar() {
    if (!current_user_can('administrator')) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'remove_admin_bar');



/*add_action('frm_after_create_entry', 'add_agent_id_to_user_table', 30, 2);
function add_agent_id_to_user_table($entry_id, $form_id){
  global $wpdb;
 if($form_id == 2){ //replace 5 with the id of the form
    $user = $wpdb->get_var($wpdb->prepare("SELECT user_id FROM {$wpdb->prefix}frm_items WHERE id=%d", $entry_id));
    
      if ( !$user ) {
             return;
         }else{
          $agent_created_user_id = $_POST['item_meta'][127];
          echo $agent_created_user_id;
          update_user_meta($agent_created_user_id,'under_user_id',$user);
         }
      
 }
}*/

add_filter('get_avatar','add_gravatar_class');

function add_gravatar_class($class) {
    $class = str_replace("class='avatar", "class='avatar img-responsive", $class);
    return $class;
}
?>

