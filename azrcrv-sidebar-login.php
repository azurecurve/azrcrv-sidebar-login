<?php
/**
 * ------------------------------------------------------------------------------
 * Plugin Name: Sidebar Login
 * Description: Login via AJAX enabled sidebar widget.
 * Version: 1.1.4
 * Author: azurecurve
 * Author URI: https://development.azurecurve.co.uk/classicpress-plugins/
 * Plugin URI: https://development.azurecurve.co.uk/classicpress-plugins/sidebar-login/
 * Text Domain: sidebar-login
 * Domain Path: /languages
 * ------------------------------------------------------------------------------
 * This is free software released under the terms of the General Public License,
 * version 3. It is distributed WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. Full
 * text of the license is available at https://www.gnu.org/licenses/gpl-3.0.html.
 * ------------------------------------------------------------------------------
 */

// Prevent direct access.
if (!defined('ABSPATH')){
	die();
}

// include plugin menu
require_once(dirname( __FILE__).'/pluginmenu/menu.php');
add_action('admin_init', 'azrcrv_create_plugin_menu_sl');

// include update client
require_once(dirname(__FILE__).'/libraries/updateclient/UpdateClient.class.php');

/**
 * Setup actions, filters and shortcodes.
 *
 * @since 1.0.0
 *
 */
// add actions
add_action('admin_menu', 'azrcrv_sl_create_admin_menu');

// add filters
add_filter('plugin_action_links', 'azrcrv_sl_add_plugin_action_link', 10, 2);

/**
 * Add action link on plugins page.
 *
 * @since 1.0.0
 *
 */
function azrcrv_sl_add_plugin_action_link($links, $file){
	static $this_plugin;

	if (!$this_plugin){
		$this_plugin = plugin_basename(__FILE__);
	}

	if ($file == $this_plugin){
		$settings_link = '<a href="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=azrcrv-sl"><img src="'.plugins_url('/pluginmenu/images/Favicon-16x16.png', __FILE__).'" style="padding-top: 2px; margin-right: -5px; height: 16px; width: 16px;" alt="azurecurve" />'.esc_html__('Settings' ,'sidebar-login').'</a>';
		array_unshift($links, $settings_link);
	}

	return $links;
}

/**
 * Add menu to plugin menu.
 *
 * @since 1.0.0
 *
 */
function azrcrv_sl_create_admin_menu(){
	
	add_submenu_page("azrcrv-plugin-menu"
						,esc_html__("Sidebar Login Settings", "sidebar-login")
						,esc_html__("Sidebar Login", "sidebar-login")
						,'manage_options'
						,'azrcrv-sl'
						,'azrcrv_sl_settings');
						
}

/**
 * Display Settings page.
 *
 * @since 1.0.0
 *
 */
function azrcrv_sl_settings(){
	if (!current_user_can('manage_options')){
		$error = new WP_Error('not_found', esc_html__('You do not have sufficient permissions to access this page.' , 'sidebar-login'), array('response' => '200'));
		if(is_wp_error($error)){
			wp_die($error, '', $error->get_error_data());
		}
	}
	?>
	
	<div id="azrcrv-sl-general" class="wrap">
		<h1><?php echo esc_html(get_admin_page_title()); ?></h1>

		<label for="explanation">
			<span id="explanation">
				<p><?php esc_html_e('Sidebar Login adds a useful login widget which can be used to login from in the sidebar of your ClassicPress powered blog; once a user logs in they are redirected back to the page they logged in from rather than the admin panel (this is configurable).', 'sidebar-login'); ?></p>
				<p><?php esc_html_e('The following tags can be used in the widget settings for titles and links and will be replaced at runtime:', 'sidebar-login'); ?></p>
				<ul style='margin-left: 12px;'>
					<li><code>%username%</code> - <?php esc_html_e("logged in users display name", "sidebar-login"); ?></li>
					<li><code>%userid%</code> - <?php esc_html_e("logged in users ID", "sidebar-login"); ?></li>
					<li><code>%firstname%</code> - <?php esc_html_e("logged in users firstname", "sidebar-login"); ?></li>
					<li><code>%lastname%</code> - <?php esc_html_e("logged in users lastname", "sidebar-login"); ?></li>
					<li><code>%name%</code> - <?php esc_html_e("logged in users firstname and lastname", "sidebar-login"); ?></li>
					<li><code>%avatar%</code> - <?php esc_html_e("user's avatar", "sidebar-login"); ?></li>
					<li><code>%logout_url%</code> - <?php esc_html_e("logout url", "sidebar-login"); ?></li>
					<li><code>%admin_url%</code> - <?php esc_html_e("url to WP admin", "sidebar-login"); ?></li>
				</ul>
			</span>
		</label>
	</div>
	<?php
}

/**
 * Sidebar_Login class.
 */
class Sidebar_Login {

	private $version = '2.7.3';

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		// Hook-in
		add_action( 'plugins_loaded', array( $this, 'i18n' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'widgets_init', array( $this, 'register_widget' ) );
		add_action( 'wp_authenticate', array( $this, 'convert_email_to_username' ), 10, 2 );

		// Ajax events
		add_action( 'wp_ajax_sidebar_login_process', array( $this, 'ajax_handler' ) );
		add_action( 'wp_ajax_nopriv_sidebar_login_process', array( $this, 'ajax_handler' ) );
	}

	/**
	 * i18n function.
	 *
	 * @access public
	 * @return void
	 */
	public function i18n() {
		load_plugin_textdomain( 'sidebar-login', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * enqueue function.
	 *
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		$suffix       = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$js_in_footer = apply_filters( 'sidebar_login_js_in_footer', false );

		// Register BLOCK UI
		wp_register_script( 'jquery-blockui', plugins_url( 'assets/jquery/jquery.blockUI.min.js', __FILE__ ), array( 'jquery' ), '2.70', $js_in_footer );

		// Enqueue Sidebar Login JS
		wp_enqueue_script( 'sidebar-login', plugins_url( 'assets/jquery/sidebar-login' . $suffix . '.js', __FILE__ ), array( 'jquery', 'jquery-blockui' ), $this->version, $js_in_footer );

		// Enqueue Styles
		if ( apply_filters( 'sidebar_login_include_css', true ) ) {
			wp_enqueue_style( 'sidebar-login', plugins_url( 'assets/css/sidebar-login.css', __FILE__ ), '', $this->version );
		}

		// Pass variables
		$sidebar_login_params = array(
			'ajax_url'         => $this->ajax_url(),
			'force_ssl_admin'  => force_ssl_admin() ? 1 : 0,
			'is_ssl'           => is_ssl() ? 1 : 0,
			'i18n_username_required' => __( 'Please enter your username', 'sidebar-login' ),
			'i18n_password_required' => __( 'Please enter your password', 'sidebar-login' ),
			'error_class'      => apply_filters( 'sidebar_login_widget_error_class', 'sidebar_login_error' )
		);

		wp_localize_script( 'sidebar-login', 'sidebar_login_params', $sidebar_login_params );
	}

	/**
	 * Include and register the widget class.
	 *
	 * @access public
	 * @return void
	 */
	public function register_widget() {
		include_once( 'includes/class-sidebar-login-widget.php' );
	}

	/**
	 * ajax_url function.
	 *
	 * @access public
	 * @return void
	 */
	private function ajax_url() {
		if ( is_ssl() ) {
			return str_replace( 'http:', 'https:', admin_url( 'admin-ajax.php' ) );
		} else {
			return str_replace( 'https:', 'http:', admin_url( 'admin-ajax.php' ) );
		}
	}

	/**
	 * When posting an email, convert to a username
	 */
	public function convert_email_to_username( &$username, &$password ) {
		// If the user inputs an email address instead of a username, try to convert it
		if ( is_email( $username ) ) {
			if ( $user = get_user_by( 'email', $username ) ) {
				$username = $user->user_login;
			}
		}
	}

	/**
	 * ajax_handler function.
	 *
	 * @access public
	 * @return void
	 */
	public function ajax_handler() {
		// Get post data
		$creds                  = array();
		$creds['user_login']    = stripslashes( trim( $_POST['user_login'] ) );
		$creds['user_password'] = stripslashes( trim( $_POST['user_password'] ) );
		$creds['remember']      = isset( $_POST['remember'] ) ? sanitize_text_field( $_POST['remember'] ) : '';
		$redirect_to            = esc_url_raw( $_POST['redirect_to'] );
		$secure_cookie          = null;

		// If the user wants ssl but the session is not ssl, force a secure cookie.
		if ( ! force_ssl_admin() ) {
			$user = is_email( $creds['user_login'] ) ? get_user_by( 'email', $creds['user_login'] ) : get_user_by( 'login', sanitize_user( $creds['user_login'] ) );

			if ( $user && get_user_option( 'use_ssl', $user->ID ) ) {
				$secure_cookie = true;
				force_ssl_admin( true );
			}
		}

		if ( force_ssl_admin() ) {
			$secure_cookie = true;
		}

		if ( is_null( $secure_cookie ) && force_ssl_admin() ) {
			$secure_cookie = false;
		}

		// Login
		$user = wp_signon( $creds, $secure_cookie );

		// Redirect filter
		if ( $secure_cookie && strstr( $redirect_to, 'wp-admin' ) ) {
			$redirect_to = str_replace( 'http:', 'https:', $redirect_to );
		}

		// Result
		$result = array();

		if ( ! is_wp_error( $user ) ) {
			$result['success']  = 1;
			$result['redirect'] = $redirect_to;
		} else {
			$result['success'] = 0;
			if ( $user->errors ) {
				foreach ( $user->errors as $error ) {
					$result['error'] = $error[0];
					break;
				}
			} else {
				$result['error'] = __( 'Please enter your username and password to login.', 'sidebar-login' );
			}
		}

		echo '<!--SBL-->';
		echo json_encode( $result );
		echo '<!--SBL_END-->';

		die();
	}

}

new Sidebar_Login();
