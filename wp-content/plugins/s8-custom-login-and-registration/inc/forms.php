<?php
/**
 * Part of the Sideways8 Custom Login and Registration plugin
 */

if ( ! function_exists( 's8_clr_get_form' ) ):
    /**
     * Echos out the requested form
     * @since 0.8.1
     */
    function s8_clr_get_form( $form = 'login', $args = array(), $errors = false ) {
        global $s8_login_errors;
        $args = array_merge( array(
            // Work on ANY form
            'split_lines' => false, // This splits the labels and form fields onto separate lines
            'single_line' => false, // This, when true, displays the entire form without any line breaks
            'use_html5_placeholders' => false, // When true, labels become HTML5 placeholder text instead
            'submit_text' => false, // This changes the submit button text, false uses the forms default value

            // Works only on login form
            'hide_remember' => false, // Login form specific, hides the "Remember me" checkbox
        ), $args );
        if ( $errors === false ) {
            $errors = $s8_login_errors;
        }
        // Pick the right form
        switch ( $form ) {
            case 'register':
                /***** REGISTRATION FORM *****/
                $redirect_url = ( $_GET['redirect'] != '' ) ? $_GET['redirect'] : home_url();
                // Output our form
                ?><form method="post" action="<?php echo s8_get_register_url( $redirect_url ); ?>" name="register" class="s8_form register_form"><?php
                    // Output any errors we find
                    if ( is_wp_error( $errors ) ) {
                        echo '<p class="error">' . $errors->get_error_message() . '</p>';
                    } elseif ( $errors !== false && ! empty( $errors ) && ! is_array( $errors ) ) {
                        echo '<p class="notice">'.$errors.'</p>';
                    } ?>
                    <p>
                        <?php wp_nonce_field( plugin_dir_path( S8_LOGIN_FILE ), 's8-clr-register-nonce' );
                        //<input type="hidden" name="s8-register-nonce" value="<?php echo wp_create_nonce('s8-register-new-user') ? >" />

                        // USERNAME FIELD AND LABEL
                        if ( ! $args['use_html5_placeholders'] ) { // Don't display if we are using html5 placeholders
                            ?><label for="username"><?php _e( 'Username' ); ?></label><?php
                        }
                        if ( $args['split_lines'] && ! $args['single_line'] ) echo '<br/>'; ?>
                        <input type="text" name="username" id="username" value="<?php echo $_POST['username']; ?>" required="required" <?php if ( $args['use_html5_placeholders'] ) echo 'placeholder="' . __( 'Username' ) . '"'; ?> /><?php
                        if ( ! $args['single_line'] ) echo '<br/>';

                        // EMAIL ADDRESS FIELD AND LABEL
                        if ( ! $args['use_html5_placeholders'] ) { // Don't display if we are using html5 placeholders
                            ?><label for="email"><?php _e( 'Email Address' ); ?></label><?php
                        }
                        if ( $args['split_lines'] && ! $args['single_line'] ) echo '<br/>'; ?>
                        <input type="email" name="email" id="email" value="<?php echo $_POST['email']; ?>" required="required" <?php if ( $args['use_html5_placeholders'] ) echo 'placeholder="' . __( 'Email Address' ) . '"'; ?> /><?php
                        if ( ! $args['single_line'] ) echo '<br/>';

                        // PASSWORD NOTICE
                        if ( $args['split_lines'] && ! $args['single_line'] ) echo '<br/>';
                        _e( 'A password will be e-mailed to you.' );
                        if ( ! $args['single_line'] ) echo '<br/>';

                        // SUBMIT BUTTON AND LINKS ?>
                        <input type="hidden" name="redirect" value="<?php echo $redirect_url; ?>" />
                        <input type="submit" name="s8-register" value="<?php echo ( $args['submit_text'] ) ? $args['submit_text'] : __( 'Register' ); ?>" />
                        <?php
                        if ( $args['login'] ) {
                            echo ( $args['single_line'] ? '' : '<br/>' ) . s8_get_login_link( false );
                        }
                        if ( $args['forgot'] ) {
                            echo ( $args['single_line'] ? '' : '<br/>' ) . s8_get_forgot_password_link( s8_get_current_url() );
                        } ?>
                    </p>
                </form><?php
                break;

            case 'reset':
                /***** PASSWORD RESET FORM *****/
                // Output our form
                ?><form name="pass-reset" action="<?php echo home_url( '/' . s8_login_registration::ep_login . '/?action=reset&key=' . $_GET['key'] . '&login=' . $_GET['login'] ); ?>" method="post" class="s8_form reset_form"><?php
                    // Output any errors we found
                    if ( is_wp_error( $errors ) ) {
                        echo '<p class="error">' . $errors->get_error_message() . '</p>';
                    } elseif ( $errors !== false && ! empty( $errors ) && ! is_array( $errors ) ) {
                        echo '<p class="notice">' . $errors . '</p>';
                    } ?>
                    <p>
                        <?php wp_nonce_field( plugin_dir_path( S8_LOGIN_FILE ), 's8-clr-reset-nonce' );
                        // <input type="hidden" name="s8-login-nonce" value="<?php echo wp_create_nonce('s8_wp_custom_login-nonce-reset'); ? >" />

                        // NEW PASSWORD FIELD AND LABEL
                        if ( ! $args['use_html5_placeholders'] ) { // Don't display if we are using html5 placeholders
                            ?><label for="new-pass"><?php _e( 'New Password' ); ?></label><?php
                        }
                        if ( $args['split_lines'] && ! $args['single_line'] ) echo '<br/>'; ?>
                        <input type="password" name="new-pass" id="new-pass"  <?php if ( $args['use_html5_placeholders'] ) echo 'placeholder="' . __( 'New Password' ) . '"'; ?> /><?php
                        if ( ! $args['single_line'] ) echo '<br/>';

                        // CONFIRM NEW PASSWORD FIELD AND LABEL
                        if ( ! $args['use_html5_placeholders'] ) { // Don't display if we are using html5 placeholders
                            ?><label for="new-pass-confirm"><?php _e( 'Confirm New Password' ); ?></label><?php
                        }
                        if ( $args['split_lines'] && ! $args['single_line'] ) echo '<br/>'; ?>
                        <input type="password" name="new-pass-confirm" id="new-pass-confirm"  <?php if ( $args['use_html5_placeholders'] ) echo 'placeholder="' . __( 'Confirm New Password' ) . '"'; ?> /><?php
                        if ( ! $args['single_line'] ) echo '<br/>';

                        // SUBMIT BUTTON ?>
                        <input type="submit" name="s8-login-reset" value="<?php echo ( $args['submit_text'] ) ? $args['submit_text'] : __( 'Change Password' ); ?>" />
                    </p>
                </form><?php
                break;

            case 'forgot':
                /***** FORGOT PASSWORD FORM *****/
                // Output our form
                ?><form name="forgot" action="<?php echo s8_get_forgot_password_url(); ?>" method="post" class="s8_form forgot_form"><?php
                    // Output any errors we found
                    if ( is_wp_error( $errors ) ) {
                        echo '<p class="error">' . $errors->get_error_message() . '</p>';
                    } elseif ( $errors !== false && ! empty( $errors ) && ! is_array( $errors ) ) {
                        echo '<p class="notice">' . $errors . '</p>';
                    } ?>
                    <p>
                        <?php wp_nonce_field( plugin_dir_path( S8_LOGIN_FILE ), 's8-clr-forgot-nonce' );
                        //<input type="hidden" name="s8-login-nonce" value="<?php echo wp_create_nonce('s8_wp_custom_login-nonce-forgot'); ? >" />
                        // USERNAME OR EMAIL FIELD AND LABEL
                        if ( ! $args['use_html5_placeholders'] ) { // Don't display if we are using html5 placeholders
                            ?><label for="user_login"><?php _e( 'Username or Email Address' ); ?></label><?php
                        }
                        if ( $args['split_lines'] && ! $args['single_line'] ) echo '<br/>'; ?>
                        <input type="text" name="user_login" id="user_login" value="<?php echo $_POST['user_login']; ?>" <?php if ( $args['use_html5_placeholders'] ) echo 'placeholder="' . __( 'Username or Email Address' ) . '"'; ?> /><?php
                        if ( ! $args['single_line'] ) echo '<br/>';

                        // SUBMIT BUTTON AND LINKS ?>
                        <input type="submit" name="s8-login-forgot" value="Get New Password" />
                        <?php
                        if ( $args['login'] ) {
                            echo ( $args['single_line'] ? '' : '<br/>' ) . s8_get_login_link();
                        }
                        if ( $args['register'] && get_option( 'users_can_register' ) ) {
                            echo ( $args['single_line'] ? '' : '<br/>' ) . s8_get_register_link( s8_get_current_url() );
                        } ?>
                    </p>
                </form><?php
                break;

            default:
                /***** LOGIN FORM *****/
                global $wp_query;
                // Get our redirect url
                $redirect_url = ( $_GET['redirect'] != '' ) ? $_GET['redirect'] : s8_get_current_url();
                if ( isset( $wp_query->query_vars[s8_login_registration::ep_login] ) && s8_get_current_url() == $redirect_url ) {
                    $redirect_url = home_url();
                }
                // Output our form
                ?><form action="<?php echo s8_get_login_url( $redirect_url ); ?>" name="login" method="post" class="s8_form login_form"><?php
                    // Output any errors we found
                    if ( is_wp_error( $errors ) ) {
                        echo '<p class="error">' . $errors->get_error_message() . '</p>';
                    } elseif ( $errors !== false && ! empty( $errors ) && ! is_array( $errors ) ) {
                        echo '<p class="notice">' . $errors . '</p>';
                    } ?>
                    <p>
                        <?php wp_nonce_field( plugin_dir_path( S8_LOGIN_FILE ), 's8-clr-login-nonce' );
                        // <input type="hidden" name="s8-login-nonce" value="<?php echo wp_create_nonce( 's8_CLR-login-nonce' ); ? >" />
                        // USERNAME FIELD AND LABEL
                        if ( ! $args['use_html5_placeholders'] ) { // Don't display if we are using html5 placeholders
                            ?><label for="username"><?php _e( 'Username' ); ?></label><?php
                        }
                        if ( $args['split_lines'] && ! $args['single_line'] ) echo '<br/>'; ?>
                        <input type="text" name="username" id="username" <?php if ( $args['use_html5_placeholders'] ) echo 'placeholder="' . __( 'Username' ) . '"'; ?> /><?php
                        if ( ! $args['single_line'] ) echo '<br/>';

                        // PASSWORD FIELD AND LABEL
                        if ( ! $args['use_html5_placeholders'] ) { // Don't display if we are using html5 placeholders
                            ?><label for="pwd"><?php _e('Password'); ?></label><?php
                        }
                        if ( $args['split_lines'] && ! $args['single_line'] ) echo '<br/>'; ?>
                        <input type="password" name="pwd" id="pwd" <?php if ( $args['use_html5_placeholders'] ) echo 'placeholder="' . __( 'Password' ) . '"'; ?> /><?php
                        if ( ! $args['single_line'] ) echo '<br/>';

                        //do_action('login_form'); // TODO: Look at integrating this and how it all works

                        // REMEMBER ME CHECKBOX
                        if ( ! $args['hide_remember'] ) { ?>
                            <input type="checkbox" id="remember-me" name="remember" value="forever" /> <label for="remember-me"><? _e( 'Remember me' ); ?></label><?php
                            if ( ! $args['single_line'] ) echo '<br/>';
                        }

                        // SUBMIT BUTTON AND LINKS ?>
                        <input type="hidden" name="redirect" value="<?php echo $redirect_url; ?>" />
                        <input type="submit" name="s8-login" value="<?php echo ( $args['submit_text'] ) ? $args['submit_text'] : __( 'Login' ); ?>" class="login-button" />
                        <?php
                        if ( $args['forgot'] ) {
                            echo ( $args['single_line'] ? '' : '<br/>' ) . s8_get_forgot_password_link();
                        }
                        if ( $args['register'] && get_option( 'users_can_register' ) ) {
                            echo ( $args['single_line'] ? '' : '<br/>' ) . s8_get_register_link( s8_get_current_url() );
                        } ?>
                    </p>
                </form>
                <?php
        }
    }
endif;
