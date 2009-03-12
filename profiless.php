<?php
/*
Plugin Name: Profiless
Plugin URI: http://www.lautre-monde.fr
Description: Profiless is a plugin that removes access to the profile page for the subscriber level user.
Author: Olivier
Version: 1.0
Author URI: http://www.lautre-monde.fr
*/

/*
1/ License terms :
- You are free to use Profiless.
- Release 1.0 of Profiless is free of use (this doesn't mean that it will be the case for the entire life of this plugin, you never know what can happen in life).
- I won't assume any responsibility for any problem that could happen as part of the use of this plugin so use it at your own risk.
- The plugin has been designed and tested under Wordpress 2.7.1. It may work under others releases but I haven't tested so I cannot commit on it.
- Copyrights : Olivier @ L'autre monde 2005-2009

2/ Release history :
- 1.0 (10/03/2009) : original release

3/ Plugin description :
This plugin is very simple! It removes the menu icon to access the profile page for the level 0 user in wordpress admin pannel. It also redirects the level 0 user to the admin
homepage if it tries to access directly the profile page (as the menuitem has been removed).
*/

$profiless_version = '1.0';

function profiless_remove_profile_access()
{
	global $menu, $current_user;

	$plugin_url = trailingslashit(get_option('siteurl')) . 'wp-content/plugins/' . basename(dirname(__FILE__)) .'/';
    $requesteduri = $_SERVER['REQUEST_URI'];
    $destpage = get_option('siteurl') . '/wp-admin/index.php';
	$result = strpos($requesteduri, '/wp-admin/profile.php');

    if ($current_user->user_level == 0)
        unset($menu[50]);

    if (($result != 0) && ($current_user->user_level == 0))
        wp_safe_redirect($destpage);

	return;
}

function profiless_init()
{    
	add_action('admin_menu', 'profiless_remove_profile_access');
}

add_action('plugins_loaded','profiless_init');

php?>