<?php

if(!function_exists('s8_get_current_url')) {
    /**
     * Returns the entire current URL with SSL detection.
     * @since 0.6.0
     * @return string
     */
    function s8_get_current_url() {
        $protocol = is_ssl()?'https':'http';
        $port = ($_SERVER['SERVER_PORT'] == '80')?'':':'.$_SERVER['SERVER_PORT'];
        return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
    }
}

if(!function_exists('s8_get_login_url')) {
    /**
     * Returns a string containing the url of the S8 login page
     * @since 0.8.0
     * @param null $redirect_url
     * @return string|void
     */
    function s8_get_login_url($redirect_url = null) {
        $formatted_redirect_url = '?redirect='.(
        ($redirect_url != null)?urlencode($redirect_url):urlencode(s8_get_current_url()));
        if($redirect_url === false) $formatted_redirect_url = '?redirect='.urlencode(home_url('/'));
        if($redirect_url === true) $formatted_redirect_url = '';
        return home_url('/'.s8_login_registration::ep_login.
            '/'.($formatted_redirect_url?$formatted_redirect_url:''));
    }
}

if(!function_exists('s8_get_register_url')) {
    /**
     * Returns the URL of the S8 register page
     * @since 0.8.0
     * @param null $redirect_url
     * @return string|void
     */
    function s8_get_register_url($redirect_url = null) {
        $formatted_redirect_url = '&redirect='.(
        ($redirect_url != null)?urlencode($redirect_url):urlencode(s8_get_current_url()));
        if($redirect_url === false) $formatted_redirect_url = '&redirect='.urlencode(home_url('/'));
        if($redirect_url === true) $formatted_redirect_url = '';
        $check = get_option('s8_allow_wp_register');
        if($check) return site_url('/wp-login.php?action=register');
        return home_url('/'.s8_login_registration::ep_login.
            '/?action=register'.($formatted_redirect_url?$formatted_redirect_url:''));
    }
}

if(!function_exists('s8_get_forgot_password_url')) {
    /**
     * Returns the URL of the forgot password URL
     * @since 0.8.0
     * @return string|void
     */
    function s8_get_forgot_password_url() {
        return home_url('/'.s8_login_registration::ep_login.'/?action=forgot');
    }
}

if(!function_exists('s8_get_logout_url')) {
    function s8_get_logout_url($redirect_url = null) {
        $redirect_url = '&redirect='.(($redirect_url != null)?urlencode($redirect_url):urlencode(home_url('/')));
        return home_url('/'.s8_login_registration::ep_login.'/?action=logout'.($redirect_url?$redirect_url:''));
    }
}

if(!function_exists('s8_loginout')) {
    /**
     * returns a full HTML login/logout link depending on if the user is logged in or not
     * @since 0.8.0
     * @return string
     */
    function s8_loginout() {
        $redirect_url = s8_get_current_url();
        if(!is_user_logged_in())
            return s8_get_login_link($redirect_url);
        else
            return s8_get_logout_link($redirect_url);
    }
}

if(!function_exists('s8_get_login_link')) {
    /**
     * Returns the full HTML needed to show a login link
     * @since 0.8.1
     * @param bool $redirect_url
     * @return string
     */
    function s8_get_login_link($redirect_url = false) {
        return '<a href="'.s8_get_login_url($redirect_url).'">'.__('Login').'</a>';
    }
}

if(!function_exists('s8_get_register_link')) {
    /**
     * Returns the full HTML needed to show a register link
     * @since 0.8.1
     * @param bool $redirect_url
     * @return string
     */
    function s8_get_register_link($redirect_url = false) {
        return '<a href="'.s8_get_register_url($redirect_url).'">'.__('Register').'</a>';
    }
}

if(!function_exists('s8_get_forgot_password_link')) {
    /**
     * Returns the full HTML needed to show a forgot password link
     * @since 0.8.1
     * @return string
     */
    function s8_get_forgot_password_link() {
        return '<a href="'.s8_get_forgot_password_url().'">'.__('Forgot Password?').'</a>';
    }
}

if(!function_exists('s8_get_logout_link')) {
    /**
     * Returns the full HTML needed to show a logout link
     * @since 0.8.1
     * @param bool $redirect_url
     * @return string
     */
    function s8_get_logout_link($redirect_url = false) {
        return '<a href="'.s8_get_logout_url($redirect_url).'">'.__('Logout').'</a>';
    }
}

if(!function_exists('s8_get_login_registration_page_css')):
    function s8_get_login_registration_page_css() {
        if(file_exists(get_template_directory().'/s8-login.css'))
            $file = get_template_directory_uri().'/s8-login.css';
        else
            $file = plugins_url('/css/s8-login-basic-styles.css', S8_LOGIN_FILE);
        return $file;
    }
endif;
