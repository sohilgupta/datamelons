<?php
/**
 * Plugin Name: Sideways8 Custom Login and Registration
 * Plugin URI: http://sideways8.com/plugins/s8-custom-login-and-registration/
 * Description: The way your site is presented to your users is important. That is why we made the "Custom Login and Registration" plugin. It is designed so that both you and your users never see the built-in WP login, registration, and password reset forms. It is still compatible with all of WordPress' built-in functionality and logout links will still function as they should. It also comes with a login form widget to make it easy for your non-logged in visitors to find the login form.
 * Tags: s8, sideways8, sideways 8, custom login, login, registration, form, login widget, widget, theme login, style login, theme, style log in, theme log in, log in, custom log in, brand, brand login, brand log in
 * Version: 0.8.7
 * Author: Sideways8 Interactive, LLC
 * Author URI: http://sideways8.com/
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

//define('S8_LOGIN_EP', 'login');
define( 'S8_LOGIN_FILE', __FILE__ );

include_once( plugin_dir_path( S8_LOGIN_FILE ) . 'inc/forms.php' );
include_once( plugin_dir_path( S8_LOGIN_FILE ) . 'inc/functions.php' );
include_once( plugin_dir_path( S8_LOGIN_FILE ) . 'inc/s8-login-widget.php' );

/**
 * Main class file for the Custom Login plugin
 * @package s8-custom-login
 * @since 0.5.0
 */
class s8_login_registration {
    const ep_login = 'login';
    private $version = '0.8.7',
            $title = '404 Not Found',
            $content = 'Sorry, what you are looking for could not be found!';

    /**
     * Our basic starting point
     * @since 0.5.0
     */
    function __construct() {
        // Update if needed
        if ( $this->version != get_option( 's8-login-registration-version' ) ) $this->update();
        // Add our activation/deactivation hooks
        register_activation_hook( S8_LOGIN_FILE, array( $this, 'activation' ) );
        register_deactivation_hook( S8_LOGIN_FILE, array( $this, 'deactivation' ) );
        // Add our endpoints
        add_action( 'init', array( $this, 'endpoints' ) );
        // Add our posts and load the appropriate template
        add_action( 'the_posts', array( $this, 'the_posts' ) );
        add_action( 'template_include', array( $this, 'template_include' ) );
        add_action( 'template_redirect', array( $this, 'header_output' ) );
        // Filter out the wrong urls in the reset password emails
        add_filter( 'retrieve_password_message', array( $this, 'filter_email_urls' ), 10, 2 );
        // Keep people from seeing the WP Login page
        add_action( 'login_init', array( $this, 'no_wp_login' ) );
        // Work with the WordPress functions
        add_filter( 'logout_url', array( $this, 'logout_url' ), 10, 2 );
        add_filter( 'login_url', array( $this, 'login_url' ), 10, 2 );
        add_filter( 'lostpassword_url', array( $this, 'forgotpassword_url' ), 10, 2 );
        // Add our shortcodes
        add_shortcode( 's8-login-form', array( $this, 'login_shortcode' ) );
        add_shortcode( 's8-registration-form', array( $this, 'registration_shortcode' ) );
        add_shortcode( 's8-forgot-form', array( $this, 'forgot_shortcode' ) );
        add_shortcode( 's8-reset-form', array( $this, 'reset_shortcode' ) ); // This is intended for internal use ONLY
        //add_filter('register', array($this, 'register_url'));
        // Add our admin stuff
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        add_action( 'wp_login', array( $this, 'login_redirect' ), 99, 2 );
    }

    /**
     * Filter the content for our login/register/lost password pages to be what we want.
     * @since 0.5.0
     * @param $posts
     * @return array
     */
    function the_posts($posts) {
        global $wp_query;
        if(isset($wp_query->query_vars[self::ep_login]) && $_GET['action'] == 'logout') {
            if($_GET['redirect'] != '') $url = $_GET['redirect'];
            else $url = home_url('/');
            // If logged in, log out and redirect to url, else, redirect to url!
            if(is_user_logged_in())
                wp_logout();
            wp_redirect( $url, 302 );
            exit;
        }
        elseif(isset($wp_query->query_vars[self::ep_login])) {
            // Solve an issue with homepage detection
            $wp_query->is_home = false;
            // Redirect logged in users! They shouldn't be here.
            if ( is_user_logged_in() ) { wp_redirect( home_url('/'), 302  ); exit; }
            // Include our CSS
            wp_enqueue_style('s8-login-registration', s8_get_login_registration_page_css());
            // Find out what we are doing
            global $s8_login_errors; // Only available when on one of our pages.
            switch($_GET['action']) {
                case 'register':
                    if ( ! get_option( 'users_can_register' ) ) {
                        wp_redirect( s8_get_login_url( home_url() ) );
                        exit;
                    }
                    if ( isset( $_POST['s8-register'] ) ) {
                        $s8_login_errors = $this->register_user();
                    }
                    $this->title = __('Register');
                    $this->content = '[s8-registration-form s8_internal="true"]';
                        //$this->display_template('register');
                    break;
                case 'reset':
                    define( 'S8_LOGIN_INIT', true );
                    if ( isset( $_POST['s8-login-reset'] ) ) {
                        $s8_login_errors = $this->user_password_reset();
                    }
                    $this->title = __( 'Reset Password' );
                    $this->content = '[s8-reset-form action="reset" s8_internal="true"]';
                        //$this->display_template('login');
                    break;
                case 'forgot':
                    define( 'S8_LOGIN_INIT', true );
                    if ( isset( $_POST['s8-login-forgot'] ) ) {
                        $s8_login_errors = $this->user_password_reset_request();
                    }
                    $this->title = __( 'Forgot Password' );
                    $this->content = '[s8-forgot-form s8_internal="true"]';
                        //$this->display_template('login');
                    break;
                default:
                    // Check if we are processing (and process if needed)
                    if ( isset( $_POST['s8-login'] ) ) {
                        $s8_login_errors = $this->login_user();
                    }
                    // Do our stuff
                    $this->title = __('Login');
                    $this->content = '[s8-login-form s8_internal="true"]';
                        //$this->display_template('login');
            }
            $post = array(
                'ID' => 1,
                'post_author' => 1,
                'post_date' => current_time('mysql'),
                'post_date_gmt' => current_time('mysql', 1),
                'post_content' => $this->content,
                'post_title' => $this->title,
                'post_status' => 'static',
                'comment_status' => 'closed',
                'ping_status' => 'closed',
                'post_name' => self::ep_login . '/',
                'post_parent' => 0,
                'post_type' => 'page'
            );
            $posts = array( (object) $post );
        }
        return $posts;
    }

    /**
     * Changes the template used for the form pages
     * @param string $template
     * @return string
     * @since 0.8.3
     */
    function template_include( $template ) {
        global $wp_query;
        if ( isset( $wp_query->query_vars[self::ep_login] ) ) {
            $order = array( 's8-login.php', 'page.php', 'index.php' );
            if ( $temp = get_option( 's8_custom_login_form_template' ) )
                $order = array( $temp, 's8-login.php', 'page.php', 'index.php' );
            $template = locate_template( $order );
        }
        // If we fail to find an appropriate file, return what WP was going to use anyways.
        return $template;
    }

    function header_output() {
        global $wp_query;
        if ( isset( $wp_query->query_vars[self::ep_login] ) ) {
            wp_clear_auth_cookie();
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
        }
    }

    /**
     * Registers a user after validating all input. Notifies them by email with their password.
     * @since 0.8.1
     * @return WP_Error
     */
    function register_user() {
        if ( ! wp_verify_nonce( $_POST['s8-clr-register-nonce'], plugin_dir_path( S8_LOGIN_FILE ) ) )
            die('An attempt to bypass security checks was detected! Please go back to the register form and try again.');
        // Verify our data
        if(empty($_POST['username']) || empty($_POST['email']))
            $errors = new WP_Error('emptyfield', 'A required field was left empty! All fields are required.');
        elseif(!is_email(trim($_POST['email'])))
            $errors = new WP_Error('invalidemail', 'The email address you entered is invalid!');
        elseif(email_exists(trim($_POST['email'])))
            $errors = new WP_Error('emailexists', 'There is already an account associated with the email address you entered! All accounts must have a unique email address.');
        elseif(!validate_username(trim($_POST['username'])))
            $errors = new WP_Error('invalidusername', 'The username you entered is invalid! Make sure your username starts with a letter, doesn\'t contain spaces or special characters, and is at least 5 characters long');
        elseif(username_exists(trim($_POST['username'])))
            $errors = new WP_Error('userexists', 'The username you entered already exists! Please choose a different username.');
        else {
            $password = wp_generate_password();
            $user_data = array(
                'user_pass' => $password,
                'user_login' => trim($_POST['username']),
                'user_email' => trim($_POST['email']),
            );
            $user_id = wp_insert_user($user_data);
            if($user_id) {
                // Send user an email with their username & password
                wp_new_user_notification($user_id, $password);
                // Redirect user to the login page if we can find it
                $redirect_url = ($_POST['redirect'] != '')?$_POST['redirect']:false;
                $url = (function_exists('s8_get_login_url'))?s8_get_login_url($redirect_url):home_url('/');
                wp_redirect($url);
                exit;
            }
            else $errors = new WP_Error('nouser', 'An error occurred saving your information! You were not registered.');
        }
        return $errors;
    }

    /**
     * Called when resetting a users password. Does the required checks before resetting the password.
     * @since 0.8.1
     */
    function user_password_reset() {
        if ( ! wp_verify_nonce( $_POST['s8-clr-reset-nonce'], plugin_dir_path( S8_LOGIN_FILE ) ) )
            die('An attempt to bypass security checks was detected! Please go back to the password reset and try again.');
        // We are updating our password!
        ob_start();
        require_once(ABSPATH.'wp-login.php');
        $tmp = ob_get_clean(); // Keep wp-login.php from showing up by accident.
        $user = check_password_reset_key($_GET['key'], $_GET['login']);
        // Is the reset key valid?
        if(is_wp_error($user)) $errors = $user;
        // Is the new password valid?
        elseif(empty($_POST['new-pass']) || !preg_match('/^[a-zA-Z0-9\.!#@$%^&?*]{8,30}$/', $_POST['new-pass'])) $errors = new WP_Error('invalid', 'Password is invalid! Password must be at least 8 characters in length and not contain spaces, (), {}, &gt;&lt; or []');
        // Does the confirm password match the new password?
        elseif($_POST['new-pass'] != $_POST['new-pass-confirm']) $errors = new WP_Error('nomatch', 'Passwords do not match! Please try again.');
        // Everything checks out sir, update the password!
        else {
            reset_password($user, $_POST['new-pass']);
            wp_redirect(s8_get_login_url(false));
            exit;
        }
        return $errors;
    }

    /**
     * Called when a user is requesting a password reset.
     * @since 0.8.1
     */
    function user_password_reset_request() {
        if ( ! wp_verify_nonce( $_POST['s8-clr-forgot-nonce'], plugin_dir_path( S8_LOGIN_FILE ) ) )
            die('An attempt to bypass security checks was detected! Please go back to the forgot password form, refresh the page, and try again.');
        // We are requesting a password reset!
        ob_start();
        require_once(ABSPATH.'wp-login.php');
        $tmp = ob_get_clean(); // Keep wp-login.php from showing up by accident.
        $result = retrieve_password();
        if(is_wp_error($result))
            return $result;
        unset($_POST);
        return 'Password email sent!';
    }

    /**
     * Called when a user is logging in. Checks that the credentials match before logging them in and redirecting.
     * @since 0.8.1
     */
    function login_user() {
        if ( ! wp_verify_nonce( $_POST['s8-clr-login-nonce'], plugin_dir_path( S8_LOGIN_FILE ) ) )
            die( 'An attempt to bypass security checks was detected! Please go back to the login form, refresh the page, and try again.' );
        $credentials = array(
            'user_login' => sanitize_user( $_POST['username'] ),
            'user_password' => $_POST['pwd'],
            'remember' => ( empty( $_POST['remember'] ) ? false : true )
        );
        $user = wp_signon( $credentials );
        return $user;
    }

    /**
     * This handles the redirection of our users after login, this was split off from our login_user function
     * @param $user_login
     * @param $user
     * @since 0.8.5
     */
    function login_redirect( $user_login, $user ) {
        // Check for custom redirect
        $redirects = get_option('s8_login_redirects');
        $role = $user->roles;
        // Grab the first user role
        if ( is_array( $role ) )
            $role = $role[0];
        // Setup our redirect URL
        if ( isset( $redirects[$role] ) ) {
            $url = $redirects[$role];
        } elseif ( $_POST['redirect'] != '' ) {
            $url = $_POST['redirect'];
        } else {
            $url = home_url('/');
        }
        // Redirect and exit to avoid errors
        wp_redirect( $url, 302 );
        exit;
    }

    /**
     * Auto-redirects away from the WP login page to our login page.
     * @since 0.6.0
     */
    function no_wp_login() {
        // This does something important...
        if ( defined( 'S8_LOGIN_INIT' ) && S8_LOGIN_INIT === true )
            return;
        // See if we are trying to register and want to use the WP registration form
        $check = get_option( 's8_allow_wp_register' );
        if ( $check && $_REQUEST['action'] == 'register' )
            return;
        // Check if this is validation for a password protected post/page
        if ( $_GET['action'] == 'postpass' )
            return;
        // See if we are in no-redirect mode
        if ( $_GET['no-redirect'] == 'true' ) {
            wp_enqueue_script( 's8-login-failsafe', plugins_url( '/js/s8-login-failsafe.js', S8_LOGIN_FILE ), array( 'jquery' ) );
            return;
        }
        // Let's check for a redirect value
        if ( $_GET['redirect_to'] != '' ) {
            $url = $_GET['redirect_to'];
        } else {
            $url = false;
        }
        // Redirect away from the WP login page
        if ( $_GET['action'] == 'logout' ) {
            wp_redirect( s8_get_logout_url( $url ) );
        } elseif ( $_GET['action'] == 'register' ) {
            wp_redirect( s8_get_register_url( $url ) );
        } else {
            wp_redirect( s8_get_login_url( $url ) );
        }
        exit;
    }

    /**
     * Filters out the incorrect URL's in password reset email and replaces them with the ones for this plugin.
     * @since 0.5.0
     * @param $message
     * @param $key
     * @return mixed
     */
    function filter_email_urls($message, $key) {
        if ( strpos( $_POST['user_login'], '@' ) !== false ) {
            $user_data = get_user_by( 'email', trim( $_POST['user_login'] ) );
        } else {
            $login = trim($_POST['user_login']);
            $user_data = get_user_by('login', $login);
        }
        $user_login = $user_data->user_login;
        $reset_url = home_url('/'.self::ep_login.'/?action=reset&key='.$key.'&login='.rawurlencode(($user_login)));
        $message = preg_replace('/<(.+wp\-login\.php.*)>/', $reset_url, $message);
        $message = str_replace(network_site_url(), home_url('/'), $message);
        return $message;
    }

    /**
     * Load up one of our template files for the current pages content.
     * Files to be included should be inside the inc folder.
     * @since 0.5.0
     * @param string $name The name (without .php on the end) of the file to include.
     * @return string The output from the included file.
     *
    function display_template($name) {
        $base = plugin_dir_path(S8_LOGIN_FILE).'inc/';
        if(file_exists($base.$name.'.php')) {
            if($name == 'register') {
                $url = apply_filters('s8_custom_register_template', $base.$name.'.php');
            }
            else {
                $url = $base.$name.'.php';
            }
            ob_start();
            include($url);
            return ob_get_clean();
        }
        return $this->content;
    } */

    /**
     * Logic for shortcode to show the login form
     * @since 0.8.1
     * @param $atts
     * @return bool|string Should only ever return a string when on a page not generated by us/widget
     */
    function login_shortcode($atts) {
        $s8_internal = $hide_links = '';
        extract(shortcode_atts(array('s8_internal' => 'false', 'hide_links' => ''), $atts));
        $action = 'login';
        if($s8_internal == 'true') {
            $args = array('forgot' => false, 'register' => false, 'login' => false);
            $form_text = get_option('s8_custom_login_form_text');
            if(!is_array($form_text)) $form_text = array();
            if($form_text[$action]) {
                ob_start();
                if(strpos($form_text[$action], '%FORM%') !== false) {
                    $output = explode('%FORM%', $this->prepare_content($form_text[$action]), 2);
                    echo ( $output[0] ) ? $output[0] : '';
                    s8_clr_get_form($action, $args);
                    echo ( $output[1] ) ? $output[1] : '';
                }
                else {
                    echo $this->prepare_content($form_text[$action]);
                    s8_clr_get_form($action, $args);
                }
                return ob_get_clean();
            }
        }
        $tmp = array();
        if(!empty($hide_links)) {
            // Hide our links!
            $hide = explode(',', $hide_links);
            foreach($hide as $link) {
                $link = strtolower(trim($link));
                if($link == 'login') $tmp['login'] = false;
                elseif($link == 'register') $tmp['register'] = false;
                elseif($link == 'forgot') $tmp['forgot'] = false;
            }
        }
        $args = array_merge(array('forgot' => true, 'register' => true, 'login' => true), $tmp);
        ob_start();
        s8_clr_get_form($action, $args);
        return ob_get_clean();
    }

    /**
     * Logic for shortcode to show the register form
     * @since 0.8.3
     * @param $atts
     * @return bool|string Should only ever return a string when on a page not generated by us/widget
     */
    function registration_shortcode($atts) {
        $s8_internal = $hide_links = '';
        extract(shortcode_atts(array('s8_internal' => 'false', 'hide_links' => ''), $atts));
        $action = 'register';
        if($s8_internal == 'true') {
            $args = array('forgot' => false, 'register' => false, 'login' => false);
            $form_text = get_option('s8_custom_login_form_text');
            if(!is_array($form_text)) $form_text = array();
            if($form_text[$action]) {
                ob_start();
                if(strpos($form_text[$action], '%FORM%') !== false) {
                    $output = explode( '%FORM%', $this->prepare_content( $form_text[$action] ), 2 );
                    echo ( $output[0] ) ? $output[0] : '';
                    s8_clr_get_form($action, $args);
                    echo ( $output[1] ) ? $output[1] : '';
                }
                else {
                    echo $this->prepare_content( $form_text[$action] );
                    s8_clr_get_form($action, $args);
                }
                return ob_get_clean();
            }
        }
        $tmp = array();
        if(!empty($hide_links)) {
            // Hide our links!
            $hide = explode(',', $hide_links);
            foreach($hide as $link) {
                $link = strtolower(trim($link));
                if($link == 'login') $tmp['login'] = false;
                elseif($link == 'register') $tmp['register'] = false;
                elseif($link == 'forgot') $tmp['forgot'] = false;
            }
        }
        $args = array_merge(array('forgot' => true, 'register' => true, 'login' => true), $tmp);
        ob_start();
        s8_clr_get_form($action, $args);
        return ob_get_clean();
    }

    /**
     * Logic for shortcode to show the forgot form
     * @since 0.8.3
     * @param $atts
     * @return bool|string Should only ever return a string when on a page not generated by us/widget
     */
    function forgot_shortcode($atts) {
        $s8_internal = $hide_links = '';
        extract(shortcode_atts(array('s8_internal' => 'false', 'hide_links' => ''), $atts));
        $action = 'forgot';
        if($s8_internal == 'true') {
            $args = array('forgot' => false, 'register' => false, 'login' => false);
            $form_text = get_option('s8_custom_login_form_text');
            if(!is_array($form_text)) $form_text = array();
            if($form_text[$action]) {
                ob_start();
                if(strpos($form_text[$action], '%FORM%') !== false) {
                    $output = explode('%FORM%', $this->prepare_content($form_text[$action]), 2);
                    echo ( $output[0] ) ? $output[0] : '';
                    s8_clr_get_form($action, $args);
                    echo ( $output[1] ) ? $output[1] : '';
                }
                else {
                    echo $this->prepare_content($form_text[$action]);
                    s8_clr_get_form($action, $args);
                }
                return ob_get_clean();
            }
        }
        $tmp = array();
        if(!empty($hide_links)) {
            // Hide our links!
            $hide = explode(',', $hide_links);
            foreach($hide as $link) {
                $link = strtolower(trim($link));
                if($link == 'login') $tmp['login'] = false;
                elseif($link == 'register') $tmp['register'] = false;
                elseif($link == 'forgot') $tmp['forgot'] = false;
            }
        }
        $args = array_merge(array('forgot' => true, 'register' => true, 'login' => true), $tmp);
        ob_start();
        s8_clr_get_form($action, $args);
        return ob_get_clean();
    }

    /**
     * Logic for shortcode to show the forgot form
     * @since 0.8.3
     * @param $atts
     * @return bool|string Should only ever return a string when on a page not generated by us/widget
     */
    function reset_shortcode($atts) {
        $s8_internal = $hide_links = '';
        extract(shortcode_atts(array('s8_internal' => 'false', 'hide_links' => ''), $atts));
        $action = 'reset';
        if($s8_internal == 'true') {
            $args = array('forgot' => false, 'register' => false, 'login' => false);
            $form_text = get_option('s8_custom_login_form_text');
            if(!is_array($form_text)) $form_text = array();
            if($form_text[$action]) {
                ob_start();
                if(strpos($form_text[$action], '%FORM%') !== false) {
                    $output = explode('%FORM%', $this->prepare_content($form_text[$action]), 2);
                    echo ( $output[0] ) ? $output[0] : '';
                    s8_clr_get_form($action, $args);
                    echo ( $output[1] ) ? $output[1] : '';
                }
                else {
                    echo $this->prepare_content($form_text[$action]);
                    s8_clr_get_form($action, $args);
                }
                return ob_get_clean();
            }
        }
        $tmp = array();
        if(!empty($hide_links)) {
            // Hide our links!
            $hide = explode(',', $hide_links);
            foreach($hide as $link) {
                $link = strtolower(trim($link));
                if($link == 'login') $tmp['login'] = false;
                elseif($link == 'register') $tmp['register'] = false;
                elseif($link == 'forgot') $tmp['forgot'] = false;
            }
        }
        $args = array_merge(array('forgot' => true, 'register' => true, 'login' => true), $tmp);
        ob_start();
        s8_clr_get_form($action, $args);
        return ob_get_clean();
    }

    /**
     * Runs all the content filters to prepare our custom content for display.
     * @since 0.8.1
     * @param $content
     * @return mixed
     */
    function prepare_content($content) {
        $tmp = array(
            'FORGOT_PASSWORD_URL' => s8_get_forgot_password_url(),
            'FORGOT_PASSWORD_LINK' => s8_get_forgot_password_link(),
            'LOGIN_URL' => s8_get_login_url(true),
            'LOGIN_LINK' => s8_get_login_link(true),
        );
        if(get_option('users_can_register')) {
            $tmp['REGISTER_URL'] = s8_get_register_url(true);
            $tmp['REGISTER_LINK'] = s8_get_register_link(true);
        }
        $content = stripslashes($content);
        $content = force_balance_tags($content);
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        foreach($tmp as $tag=>$value) {
            $content = str_replace('%'.$tag.'%', $value, $content);
        }
        return $content;
    }

    /**
     * Filter the default logout URL to our logout URL
     * @since 0.8.0
     */
    function logout_url($url, $redirect) {
        $url = s8_get_logout_url($redirect);
        return $url;
    }

    /**
     * Filter the default login URL to our login URL
     * @since 0.8.0
     */
    function login_url($url, $redirect) {
        $url = s8_get_login_url($redirect);
        return $url;
    }

    /**
     * Filter the default forgot password URL to our forgot password URL
     * @since 0.8.0
     */
    function forgotpassword_url($url, $redirect) {
        $url = s8_get_forgot_password_url();
        return $url;
    }

    /**
     * Adds our admin menu
     * @since 0.8.1
     */
    function admin_menu() {
        $page = add_options_page('Sideways8 Custom Login and Registration Settings', 'S8 Login & Registration', 'manage_options', 's8-custom-login-settings', array($this, 'settings_page'));
        add_action('admin_print_scripts-'.$page, array($this, 'admin_enqueue_scripts'));
    }

    /**
     * Adds our admin settings page
     * @since 0.8.1
     */
    function settings_page() {
        if (!current_user_can('manage_options'))
            wp_die('You do not have sufficient permissions to access this page!');
        include_once(plugin_dir_path(S8_LOGIN_FILE).'admin/settings.php');
    }

    /**
     * Enqueues our admin settings page css file.
     * @since 0.8.1
     */
    function admin_enqueue_scripts() {
        if(is_admin())
            wp_enqueue_style('s8-login-styles', plugins_url('/css/s8-login-admin.css', S8_LOGIN_FILE));
            wp_enqueue_style('s8-login-tabs.jquery', plugins_url('/css/jquery-ui-1.9.0.custom.min.css', S8_LOGIN_FILE));
            wp_enqueue_script('s8-login-admin', plugins_url('/js/s8-login-admin.js', S8_LOGIN_FILE), array('jquery', 'jquery-ui-tabs'));
    }

    /**
     * Adds our endpoint
     * @since 0.5.0
     */
    function endpoints() {
        add_rewrite_endpoint(self::ep_login, EP_ROOT);
    }

    /**
     * Runs on activation, adds our custom endpoints and refreshes rewrite rules
     * @since 0.5.0
     */
    function activation() {
        $this->endpoints();
        flush_rewrite_rules();
    }

    /**
     * Runs on deactivation, clears out our custom endpoint rewrites.
     * @since 0.5.0
     */
    function deactivation() {
        flush_rewrite_rules();
    }

    /**
     * Update function, may never need to do anything, but it's here if it is ever needed.
     * @since 0.5.0
     */
    function update() {
        update_option('s8-login-registration-version', $this->version);
    }
}
new s8_login_registration();
