<?php

if(!class_exists('s8_login_registration_widget') && class_exists('WP_Widget')) {
    class s8_login_registration_widget extends WP_Widget {
        function s8_login_registration_widget() {
            // What our users will see when looking at the widgets to add
            $name = __('Custom Login Form');
            $description = __('Displays the login form in a widget area.');
            // Setting up basic stuff for the WP side of widget handling
            $this->WP_Widget($id_base = false,
                $name,
                $widget_options = array('classname' => strtolower(get_class($this)), 'description' => $description),
                $control_options = array());
        }

        function form($instance) {
            $instance = wp_parse_args(
                (array) $instance,
                array(
                    'title' => 'Login',
                    'show_forgot' => 'yes',
                    'show_register' => 'no',
                )
            );
            $checked = 'checked="checked"';
            ?>
            <h3><?php _e('Logged out settings'); ?></h3>
            <p> <!-- TITLE -->
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label><br/>
                <input type="text"
                       name="<?php echo $this->get_field_name('title'); ?>"
                       id="<?php echo $this->get_field_id('title'); ?>"
                       value="<?php echo $instance['title']; ?>" />
            </p>
            <p> <!-- ADDITIONAL OPTIONS -->
                <input type="checkbox"
                       name="<?php echo $this->get_field_name('show_forgot'); ?>"
                       id="<?php echo $this->get_field_id('show_forgot'); ?>"
                       <?php if($instance['show_forgot'] == 'yes') echo $checked; ?>
                       value="yes" />
                <label for="<?php echo $this->get_field_id('show_forgot'); ?>"><?php _e('Show forgot password link'); ?></label><br/>
                <input type="checkbox"
                       name="<?php echo $this->get_field_name('show_register'); ?>"
                       id="<?php echo $this->get_field_id('show_register'); ?>"
                       <?php if($instance['show_register'] == 'yes') echo $checked; ?>
                       value="yes" />
                <label for="<?php echo $this->get_field_id('show_register'); ?>"><?php _e('Show register link'); ?></label><br/>
            </p>
            <h3><?php _e('Logged in settings'); ?></h3>
            <p> <!-- TITLE -->
                <label for="<?php echo $this->get_field_id('logged_title'); ?>"><?php _e('Title:'); ?></label><br/>
                <input type="text"
                       name="<?php echo $this->get_field_name('logged_title'); ?>"
                       id="<?php echo $this->get_field_id('logged_title'); ?>"
                       value="<?php echo $instance['logged_title']; ?>" />
            </p>
            <p> <!-- LINKS TO SHOW? -->
                <input type="checkbox"
                       name="<?php echo $this->get_field_name('show_logout'); ?>"
                       id="<?php echo $this->get_field_id('show_logout'); ?>"
                       <?php if($instance['show_logout'] == 'yes') echo $checked; ?>
                       value="yes" />
                <label for="<?php echo $this->get_field_id('show_logout'); ?>"><?php _e('Show logout link'); ?></label><br/>
            </p>
            <?php
        }

        function update($new_instance, $old_instance) {
            $instance = $old_instance;

            $instance['title'] = strip_tags($new_instance['title']);
            $instance['show_forgot'] = ($new_instance['show_forgot'] == 'yes')?'yes':'no';
            $instance['show_register'] = ($new_instance['show_register'] == 'yes')?'yes':'no';

            $instance['logged_title'] = strip_tags($new_instance['logged_title']);
            $instance['show_logout'] = ($new_instance['show_logout'] == 'yes')?'yes':'no';

            return $instance;
        }

        function widget($args, $instance) {
            global $wp_query;
            // If we are on our endpoint, don't show the sidebar widget. It's redundant...
            if(isset($wp_query->query_vars[s8_login_registration::ep_login])) return;
            // Displaying our widget!
            // Get our args, defined by the widget area definition
            $before_title = $before_widget = $after_widget = $after_title = '';
            extract($args, EXTR_IF_EXISTS);
            // Begin our widget display
            echo $before_widget;
            echo (!is_user_logged_in())
                ?$before_title.$instance['title'].$after_title
                :($instance['show_logout'] == 'yes' && $instance['logged_title'] != '')
                    ?$before_title.$instance['logged_title'].$after_title:'';
            echo '<div class="s8-login-register-widget-content">';
            if(!is_user_logged_in()) {
                // We display our login form
                $args = array(
                    'register' => ($instance['show_register'] == 'yes')?true:false,
                    'forgot' => ($instance['show_forgot'] == 'yes')?true:false,
                    'split_lines' => true,
                );
                s8_clr_get_form('login', $args);
            }
            elseif($instance['show_logout'] == 'yes') {
                echo s8_get_logout_link();
            }
            echo '</div>'.$after_widget;
        }
    }
    // Register our widget
    add_action('widgets_init', create_function('', 'return register_widget("s8_login_registration_widget");'));
}
