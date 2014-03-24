<?php
/**
 * Main admin settings page for the Sideways8 Custom Login and Registration Plugin
 */

if($_POST['s8-login-settings-save'] != '') {
    if($_POST['s8_custom_login_form_text'] && is_array($_POST['s8_custom_login_form_text'])) {
        $tmp = array();
        foreach($_POST['s8_custom_login_form_text'] as $key=>$value) {
            $tmp[$key] = $value;
        }
        update_option('s8_custom_login_form_text', $tmp);
    }
    if($_POST['page-template'] && $_POST['page-template'] != '0') {
        update_option('s8_custom_login_form_template', addslashes(strip_tags(trim($_POST['page-template']))));
    }
    else
        delete_option('s8_custom_login_form_template');
    if($_POST['use_wp_register'] == 'yes')
        update_option('s8_allow_wp_register', true);
    else
        update_option('s8_allow_wp_register', false);
    if(!empty($_POST['add_url'])) {
        $redirects = get_option('s8_login_redirects');
        $redirects[strip_tags(trim($_POST['add_role']))] = addslashes(strip_tags(trim($_POST['add_url'])));
        update_option('s8_login_redirects', $redirects);
    }
    if($_POST['delete_login_redirect'] && is_array($_POST['delete_login_redirect'])) {
        $redirects = get_option('s8_login_redirects');
        foreach($_POST['delete_login_redirect'] as $redirect) {
            unset($redirects[$redirect]);
        }
        update_option('s8_login_redirects', $redirects);
    }
}
$page_templates = array('s8-login.php', 'post.php', 'page.php', 'index.php');
$child_theme = get_stylesheet_directory();
$parent_theme = get_template_directory();
$redirects = get_option('s8_login_redirects');
if($child_theme == $parent_theme) {
    // Same theme!
    foreach($page_templates as $key=>$file) {
        if(!file_exists($parent_theme.'/'.$file))
            unset($page_templates[$key]);
    }
}
else {
    // Check child and parent
    foreach($page_templates as $key=>$file) {
        if(!file_exists($child_theme.'/'.$file) && !file_exists($parent_theme.'/'.$file))
            unset($page_templates[$key]);
    }
}
$form_text = get_option('s8_custom_login_form_text');
$template = get_option('s8_custom_login_form_template');
$allow_wp_register = get_option('s8_allow_wp_register');
if(!$form_text || !is_array($form_text))
    $form_text = array();

$checked = ' checked="checked"';
?><div class="wrap s8-login-settings">
    <div id="icon-options-general" class="icon32"></div><h2>Sideways8 Custom Login and Registration Settings</h2>
    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <div id="tabs">
            <ul>
                <li><a href="#tabs-1"><?php _e('General Options'); ?></a></li>
                <li><a href="#tabs-2"><?php _e('Login Page Options'); ?></a></li>
                <li><a href="#tabs-3"><?php _e('Register Page Options'); ?></a></li>
                <li><a href="#tabs-4"><?php _e('Forgot Password Page Options'); ?></a></li>
                <li><a href="#tabs-5"><?php _e('Reset Password Page Options'); ?></a></li>
                <li><a href="#tabs-6"><?php _e('User Redirect Options'); ?></a></li>
            </ul>
            <div class="tabs-spacer"></div>
            <div id="tabs-1">
                <p>
                    <label for="page-template"><? _e('Page layout template for form pages:'); ?></label><br/>
                    <select name="page-template" id="page-template">
                        <option value="0">-- Use default --</option>
                        <?php foreach($page_templates as $temp_file) {
                        ?><option value="<?php echo $temp_file; ?>"<?php echo($temp_file == $template)?' selected="selected"':''; ?>><?php echo $temp_file; ?></option><?php
                    } ?>
                        <?php page_template_dropdown($template); ?>
                    </select><br/>
                </p>
                <p>
                    <input type="checkbox" name="use_wp_register" id="use_wp_register" value="yes"<?php echo ($allow_wp_register)?$checked:''; ?> /> <label for="use_wp_register">Use the WordPress registration form and link</label>
                </p>
                <p>
                    <input type="submit" class="button-primary" name="s8-login-settings-save" value="Save Settings" />
                </p>
            </div>
            <div id="tabs-6">
                <h3><?php _e('On login redirects'); ?></h3>
                <p>
                    These redirects will be FORCED meaning they will always take effect on each login (based on user role).
                </p>
                <table>
                    <thead>
                        <tr><th>Delete?</th><th>Role</th><th>URL</th></tr>
                    </thead>
                    <tbody>
                        <?php
                        if($redirects && is_array($redirects) && count($redirects) > 0) {
                            global $wp_roles;
                            foreach($redirects as $role_name=>$url) {
                                if(isset($wp_roles->roles[$role_name]['name'])) $name = $wp_roles->roles[$role_name]['name'];
                                else $name = ucwords($role_name);
                                echo '<tr><td><input type="checkbox" name="delete_login_redirect[]" value="'.$role_name.'" /></td><td>'.$name.'</td><td>'.$url.'</td></tr>';
                            }
                        }
                        else
                            echo '<tr><td>No redirects yet!</td></tr>';
                        ?>
                    </tbody>
                </table>
                <p>
                    <label for="add_role"><b>Add new redirect</b> (Note: selecting a role that already has a redirect will OVERWRITE the existing redirect)</label><br/>
                    <select name="add_role" for="add_role">
                        <?php wp_dropdown_roles(); ?>
                    </select><br/>
                    <label for="add_url">URL:</label> <input type="text" name="add_url" id="add_url" />
                </p>

                <?php /*<h3><?php _e('On logout redirects'); ?></h3> */ ?>
                <p>
                    <input type="submit" class="button-primary" name="s8-login-settings-save" value="Save Settings" />
                </p>
            </div>
            <div id="tabs-2">
                <h3>Login page text</h3>
                <p>
                    Shown when a user is logging in.
                </p>
                <?php wp_editor(stripslashes($form_text['login']), 's8-login', array('textarea_name' => 's8_custom_login_form_text[login]')); ?>
                <p>
                    <input type="submit" class="button-primary" name="s8-login-settings-save" value="Save Settings" />
                </p>
                <p>
                    You can include any of the following tags to customize the content of the page:<br/>
                    %FORM% = Shows the appropriate form. If not included, form appears below the content.<br/>
                    %REGISTER_URL% = URL of the register page NOTE: Users must be allowed to register for this to work!<br/>
                    %REGISTER_LINK% = Link to the register page NOTE: Users must be allowed to register for this to work!<br/>
                    %LOGIN_URL% = URL of the login page<br/>
                    %LOGIN_LINK% = Link to the login page<br/>
                    %FORGOT_PASSWORD_URL% = URL of the forgot password page<br/>
                    %FORGOT_PASSWORD_LINK% = Link to the forgot password page
                </p>
            </div>
            <div id="tabs-3">
                <h3>Registration page text</h3>
                <p>
                    Shown when a user is registering for the site.
                </p>
                <?php wp_editor(stripslashes($form_text['register']), 's8-register', array('textarea_name' => 's8_custom_login_form_text[register]')); ?>
                <p>
                    <input type="submit" class="button-primary" name="s8-login-settings-save" value="Save Settings" />
                </p>
                <p>
                    You can include any of the following tags to customize the content of the page:<br/>
                    %FORM% = Shows the appropriate form. If not included, form appears below the content.<br/>
                    %REGISTER_URL% = URL of the register page NOTE: Users must be allowed to register for this to work!<br/>
                    %REGISTER_LINK% = Link to the register page NOTE: Users must be allowed to register for this to work!<br/>
                    %LOGIN_URL% = URL of the login page<br/>
                    %LOGIN_LINK% = Link to the login page<br/>
                    %FORGOT_PASSWORD_URL% = URL of the forgot password page<br/>
                    %FORGOT_PASSWORD_LINK% = Link to the forgot password page
                </p>
            </div>
            <div id="tabs-4">
                <h3>Forgot password page text</h3>
                <p>
                    Shown when a user is requesting a password reset (the form sends them an email).
                </p>
                <?php wp_editor(stripslashes($form_text['forgot']), 's8-forgot', array('textarea_name' => 's8_custom_login_form_text[forgot]')); ?>
                <p>
                    <input type="submit" class="button-primary" name="s8-login-settings-save" value="Save Settings" />
                </p>
                <p>
                    You can include any of the following tags to customize the content of the page:<br/>
                    %FORM% = Shows the appropriate form. If not included, form appears below the content.<br/>
                    %REGISTER_URL% = URL of the register page NOTE: Users must be allowed to register for this to work!<br/>
                    %REGISTER_LINK% = Link to the register page NOTE: Users must be allowed to register for this to work!<br/>
                    %LOGIN_URL% = URL of the login page<br/>
                    %LOGIN_LINK% = Link to the login page<br/>
                    %FORGOT_PASSWORD_URL% = URL of the forgot password page<br/>
                    %FORGOT_PASSWORD_LINK% = Link to the forgot password page
                </p>
            </div>
            <div id="tabs-5">
                <h3>Reset password page text</h3>
                <p>
                    Shown when the user is resetting their password.
                </p>
                <?php wp_editor(stripslashes($form_text['reset']), 's8-reset', array('textarea_name' => 's8_custom_login_form_text[reset]')); ?>
                <p>
                    <input type="submit" class="button-primary" name="s8-login-settings-save" value="Save Settings" />
                </p>
                <p>
                    You can include any of the following tags to customize the content of the page:<br/>
                    %FORM% = Shows the appropriate form. If not included, form appears below the content.<br/>
                    %REGISTER_URL% = URL of the register page NOTE: Users must be allowed to register for this to work!<br/>
                    %REGISTER_LINK% = Link to the register page NOTE: Users must be allowed to register for this to work!<br/>
                    %LOGIN_URL% = URL of the login page<br/>
                    %LOGIN_LINK% = Link to the login page<br/>
                    %FORGOT_PASSWORD_URL% = URL of the forgot password page<br/>
                    %FORGOT_PASSWORD_LINK% = Link to the forgot password page
                </p>
            </div>
        </div>
    </form>
</div>
