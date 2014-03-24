=== Sideways8 Custom Login and Registration ===
Contributors: sideways8, technical_mastermind, areimann
Tags: s8, sideways8, sideways 8, custom login, login, registration, form, login widget, widget, theme login, style login, theme, style log in, theme log in, log in, custom log in, brand, brand login, brand log in
Requires at least: 3.3
Tested up to: 3.5.2
Stable tag: 0.8.7
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Hides the WP login page, allows you to "embed" login in a page, and allows customization on how the login page looks.

== Description ==
The way your site is presented to your users is important. That is why we made the "Custom Login and Registration" plugin. It is designed so that both you and your users never see the built-in WP login, registration, and password reset forms. It is still compatible with all of WordPress' built-in functionality and logout links will still function as they should. A login form widget is included to make it easy for your non-logged in visitors to find the login form. You are even able to add content to the login, registration, forgot password and password reset pages through the settings page.

If you want to add a form to a page on your site, you can use the following shortcodes: `[s8-login-form]`, `[s8-registration-form]`, and `[s8-forgot-form]`.

Note: This plugin requires that you use pretty permalinks

= Support/Help =
We have tutorial videos available on our site and are constantly working on adding more and keeping them up to date as needed. Click [here](http://sideways8.com/tutorials/ "Sideways8 Tutorials") to visit our tutorials page.

== Installation ==
1. Download and extract the plugin from the zip file.
2. Upload the entire "s8-custom-login-and-registration" folder to your wp-content/plugins directory.
3. Activate the plugin.

== Frequently Asked Questions ==
= HELP! I'm unable to login! What happened? =
Despite our best attempts, it is possible that a WordPress update or another plugin may cause an issue with our plugin and you will be unable to login. To get around this use the following URL: http://yourDomainName.com/wp-login.php?no-redirect=true
NOTE: Replace yourDomainName.com with your domain name. If your WordPress install is in a subdirectory (e.g. yourDomainName.com/folder/wp-login.php) then adjust the URL as needed.

= How do I use the shortcode and what is it? =
A shortcode is an easy and accessible way for any site owner to add custom functionality to their site. In this case it allows you to put our login, registration, and forgot password forms on ANY page of your site.

To use it simply place one of the following shortcodes where you want the form to appear:
Login: `[s8-login-form]`
Registration: `[s8-registration-form]`
Forgot password: `[s8-forgot-form]`

You can also add the option 'hide_links' to your shortcode to hide the links to the other forms.
`[s8-login-form hide_links="forgot,register"]`
The above will, for example, hide the links to the forgot password and registration forms. You can also use 'login' as an option.

= How can I change the CSS on the login/register/forgot/reset password pages? =
Make a new css file in your theme folder called 's8-login.css' and add your CSS to it. This will replace the stylesheet that comes with the plugin without being overwritten every time the plugin updates.

= How can I change the layout of the login/register/forgot/reset password pages? =
On the settings page there is an option to change which theme file is used for displaying the login/register/forgot/reset password page. If you want a completely custom layout you may create a new theme file and place it inside your theme folder (this requires that you know how to make a new theme template file that uses the WordPress Loop). Only requirements for it to work are that the header gets loaded, that `the_content()` gets called inside the loop, and that you name it 's8-login.php' OR make sure the following is at the beginning of your file:
`/**
  * Template Name: Your Template Name
  */`

== Screenshots ==
1. The widget as it appears with default TwentyTen theme styling.
2. The login page using the TwentyTen theme. There is no additional styling done to this page.

== Upgrade Notice ==
= 0.8.7 =
Fixed a login related bug that could prevent a previously logged in user from logging in
= 0.8.6 =
Minor bug fix related to the number 1 appearing on some forms
= 0.8.5 =
Several major and minor bug fixes with some code improvements
= 0.8.4 =
Bug fix related to the password reset functionality.
= 0.8.3 =
Added shortcodes and the ability to redirect users when they login based on role.
= 0.8.2 =
Added widget options for when the user is logged in.
= 0.8.1 =
Several under the hood improvements and the addition the ability to override what CSS and template files are used.
= 0.8.0 =
Initial release in WP repository

== Changelog ==
= 0.8.7 =
* Fixed a login related bug that could prevent a previously logged in user from logging in
= 0.8.6 =
* Fixed a bug where the number "1" could appear at the bottom of some forms.
= 0.8.5 =
* Updated a function related to the login process to more effectively use WordPress' built-in methods
* Updated the login redirect priority to fire LATER so other plugins have the opportunity to do their own redirects
* Several other minor improvements and bug fixes
* Fixed a bug related to WordPress' default password protection of pages/posts
= 0.8.4 =
* Fixed a bug related to resetting a password
= 0.8.3 =
* Added shortcodes for use anywhere on the site
* Added new CSS classes to the forms for easy styling (form tag is the wrapper for content inserted using the shortcode)
* Cleaned up the admin settings page
* Added option to use WordPress registration form
* Fixed a bug when going to our registration form
* Added basic login redirect support to redirect users to specific URLs on login
= 0.8.2 =
* Can now specify if a logout link should show in the widget
* Fixed a bug when getting the logout link
= 0.8.1 =
* Widget no longer displays if you are on the login, password reset, or register pages.
* Improved and cleaned up some code (and fixed some potential bugs).
* Can now add a CSS file named 's8-login.css' to your theme to use ONLY on the login/register/forgot password pages. (Also overrides the one in the plugin automatically)
* Can change/add content to login, registration, forgot password and reset password pages/forms.
= 0.8.0 =
* Initial release
