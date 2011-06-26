<?php
$a = ClearLineOptions::countOptions();
$template_url =  get_bloginfo('template_url');

$options_categories = array (
	'About' => array (
		'display_name' => __('About', THEME_DOMAIN),
		'description' =>__('<h1>Clear Line Theme Options</h1>
		Thank you for using the theme!<br/>
		The Clear Line Theme is a clear and very lightweight theme with ample opportunities of customization. 
		As for now the theme contains ${option_count[\'full-fledged\']} full-fledged options that consist of ${option_count[\'sub-options\']} sub-options.
		Here are some tips that can help you to understend them better.

		<h2>Translate the theme</h2>
		The theme is translation ready now! You can translate it and your translation will be available in the next theme release!<br/>
		Please read <a href="http://vatuma.com/wordpress-themes/clear-line/translation">instructions</a> for details.
		
		<h2>Getting help</h2>
		
		To get help on a theme option just click it\'s title:<br/><br/>
		<img src="${template_url}/options/img/help/header_decs_option.gif"/>
		
		<h2>Inheritance</h2>
		
		The unique feature of the option page is the options inheritance. 
		With this feature, options can be set to their own values or be inherited from another "parent" option.
		Thanks to the inheritance, you can change color scheme (e.g. green to blue) by changing only three options.
		<br/>
		The following picture explains how it works<br/><br/>
		<img src="${template_url}/options/img/help/inherited_option.gif"/>
		<br/><br/>
		Note that you can create chains of inherited options.<br/>
		
		<h2>Support</h2>
		
		You can ask questions, report bugs, request a feature or new options at the <a href="http://vatuma.com/support/" target="_blank">Support Forum</a>'
, THEME_DOMAIN)
/*		<h2>Help needed!</h2>
		If you are a native English speaker and you see mistakes of any kind in option titles and/or descriptions, please let me know of them.
		The best help is to edit the files <code>option_descriptions.php</code> and <code>options_categories.php</code>.
		I will appreciate your help very much.
*/
	),
	'General' => array (
		'display_name' => __('General', THEME_DOMAIN),
		'description' =>'',
	),
	'Header' => array (
		'display_name' => __('Header', THEME_DOMAIN),
		'description' =>'',
	),
	'Navigation' => array (
		'display_name' => __('Navigation', THEME_DOMAIN),
		'description' =>'',
	),
	'Sidebars' => array (
		'display_name' => __('Sidebars', THEME_DOMAIN),
		'description' =>'',
	),
	'Footer' => array (
		'display_name' => __('Footer', THEME_DOMAIN),
		'description' =>'',
	),
	'Post List' => array (
		'display_name' => __('Post List', THEME_DOMAIN),
		'description' =>'',
	),
	'Post' => array (
		'display_name' => __('Post', THEME_DOMAIN),
		'description' =>''
	),
	'Social' => array (
		'display_name' => __('Social', THEME_DOMAIN),
		'description' =>'',
	),
	'Headings' => array (
		'display_name' => __('Headings', THEME_DOMAIN),
		'description' =>'',
	),
	'Comments' => array (
		'display_name' => __('Comments', THEME_DOMAIN),
		'description' =>'',
	),
	'Images' => array (
		'display_name' => __('Images', THEME_DOMAIN),
		'description' =>'',
	),
	'Pagination' => array (
		'display_name' => __('Pagination', THEME_DOMAIN),
		'description' =>'',
	),
	'SEO' => array (
		'display_name' => __('SEO', THEME_DOMAIN),
		'description' =>'',
	),
);