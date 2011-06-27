<?php
$categories_tree = get_categories_deep(); // $categories_tree[%id%] = array ('values'=>/category names/, 'class'=> /level class names/);
//var_dump($categories_tree);
$categories_tree['values'] = array(0=>'All Categories') + $categories_tree['values'];
$categories_tree['class'] = array(0=>'level-none') + $categories_tree['class'];



$value_sets = array (
	'YES_NO' => array(
		'values'=>array(
			'yes'=>__('Yes',THEME_DOMAIN),
			'no' =>__('No',THEME_DOMAIN),
		),
		'input_type' => 'select',
		'validate' => 'string'
	),
	'NUMBER' => array(
		'values'=>'',
		'input_type' => 'text',
		'validate' => 'float'
	),	
	'TEXT' => array(
		'values'=>'',
		'input_type' => 'text',
		'validate' => 'string'
	),
	'SIDEBARS' => array(
		'values'=>array(
			'no_sidebars' =>'sidebars_no_sidebars.gif',
			'right_sidebar'=>'sidebars_right_sidebar.gif',
			'left_sidebar' =>'sidebars_left_sidebar.gif',
			'left_right_sidebars' =>'sidebars_left_right_sidebars.gif',
			'2_left_sidebars' =>'sidebars_2_left_sidebars.gif',
			'2_right_sidebars' =>'sidebars_2_right_sidebars.gif',
			'4_left_sidebars' =>'sidebars_4_left_sidebars.gif',
			'4_right_sidebars' =>'sidebars_4_right_sidebars.gif',
		),
		'alt'=>array(
			'no_sidebars' =>__('No sidebars',THEME_DOMAIN),
			'right_sidebar'=>__('Right sidebar',THEME_DOMAIN),
			'left_sidebar' =>__('Left sidebar',THEME_DOMAIN),
			'left_right_sidebars' =>__('Left and right sidebars',THEME_DOMAIN),
			'2_left_sidebars' =>__('Two sidebars at the left',THEME_DOMAIN),
			'2_right_sidebars' =>__('Two sidebars at the right',THEME_DOMAIN),
			'4_left_sidebars' =>__('Three or four sidebars at the left',THEME_DOMAIN),
			'4_right_sidebars' =>__('Three or four sidebars at the right',THEME_DOMAIN),
		),
		'input_type' => 'radio_image',
		'validate' => 'string'
	),
	'FOOTERS' => array(
		'values'=>array(
			'1' =>'footer_1.gif',
			'2'	=>'footer_2.gif',
			'3' =>'footer_3.gif',
			'4' =>'footer_4.gif',
		),
		'alt'=>array(
			'1' =>__('One column in the footer',THEME_DOMAIN),
			'2' =>__('Two columns in the footer',THEME_DOMAIN),
			'3' =>__('Three columns in the footer',THEME_DOMAIN),
			'4' =>__('Four columns in the footer',THEME_DOMAIN),
		),
		'input_type' => 'radio_image',
		'validate' => 'string'
	),
	'WIDTH_UOM' => array(
		'values'=>array(
			'px'=>'px',
			'%' =>'%',
		),
		'input_type' => 'select',
		'validate' => 'string'
	),
	'FONT_FAMILY' =>	array(
		'values'=>array(
			'Arial, Helvetica, sans-serif'						=>'Arial, Helvetica, sans-serif',
			'Arial Black, Gadget, sans-serif' 					=>'Arial Black, Gadget, sans-serif',
			'Comic Sans MS, cursive' 							=>'Comic Sans MS, cursive',
			'Courier New, Courier, monospace' 					=>'Courier New, Courier, monospace',
			'Georgia, serif'									=>'Georgia, serif',
			'Impact, Charcoal, sans-serif' 						=>'Impact, Charcoal, sans-serif',
			'Lucida Console, Monaco, monospace' 				=>'Lucida Console, Monaco, monospace',
			'Lucida Sans Unicode, Lucida Grande, sans-serif' 	=>'Lucida Sans, Lucida Grande, sans-serif',
			'Palatino Linotype, Book Antiqua, Palatino, serif' 	=>'Palatino Linotype, Book Antiqua, serif',
			'Tahoma, Geneva, sans-serif' 						=>'Tahoma, Geneva, sans-serif',
			'Times New Roman, Times, serif' 					=>'Times New Roman, Times, serif',
			'Trebuchet MS, Helvetica, sans-serif' 				=>'Trebuchet MS, Helvetica, sans-serif',
			'Verdana, Geneva, sans-serif' 						=>'Verdana, Geneva, sans-serif',
			'MS Sans Serif, Geneva, sans-serif' 				=>'MS Sans Serif, Geneva, sans-serif',
		),
		'styles'=>array(
			'Arial, Helvetica, sans-serif'						=>'font-size:12px; font-family: Arial, Helvetica, sans-serif',
			'Arial Black, Gadget, sans-serif' 					=>'font-size:12px; font-family: Arial Black, Gadget, sans-serif',
			'Comic Sans MS, cursive' 							=>'font-size:12px; font-family: Comic Sans MS, Comic Sans MS, cursive',
			'Courier New, Courier, monospace' 					=>'font-size:12px; font-family: Courier New, Courier, monospace',
			'Georgia, serif' 									=>'font-size:12px; font-family: Georgia, serif',
			'Impact, Charcoal, sans-serif' 						=>'font-size:12px; font-family: Impact, Charcoal, sans-serif',
			'Lucida Console, Monaco, monospace' 				=>'font-size:11px; font-family: Lucida Console, Monaco, monospace',
			'Lucida Sans Unicode, Lucida Grande, sans-serif' 	=>'font-size:11px; font-family: Lucida Sans Unicode, Lucida Grande, sans-serif',
			'Palatino Linotype, Book Antiqua, Palatino, serif' 	=>'font-size:12px; font-family: Palatino Linotype, Book Antiqua, Palatino, serif',
			'Tahoma, Geneva, sans-serif' 						=>'font-size:12px; font-family: Tahoma, Geneva, sans-serif',
			'Times New Roman, Times, serif' 					=>'font-size:12px; font-family: Times New Roman, Times, serif',
			'Trebuchet MS, Helvetica, sans-serif' 				=>'font-size:12px; font-family: Trebuchet MS, Helvetica, sans-serif',
			'Verdana, Geneva, sans-serif' 						=>'font-size:12px; font-family: Verdana, Geneva, sans-serif',
			'MS Sans Serif, Geneva, sans-serif' 				=>'font-size:12px; font-family: MS Sans Serif, Geneva, sans-serif',
		),
		'input_type' => 'select',
		'validate' => 'string'
	),
	'FONT_SIZE_UOM' => array(
		'values'=>array(
			'px'=>'px',
			'em' =>'em',
			'pt' =>'pt',
			'%' =>'%',
		),
		'input_type' => 'select',
		'validate' => 'string'
	),
	'FONT_WEIGHT' => array(
		'values'=>array(
			'normal'=>'normal',
			'bold' =>'bold',
		),
		'styles'=>array(
			'normal'=>'font-weight: normal',
			'bold' =>'font-weight: bold',
		),
		'input_type' => 'select',
		'validate' => 'string'
	),
	
	'TEXT_DECORATION' => array(
		'values'=>array(
			'none'=>'none',
			'underline' =>'underline',
			'overline' =>'overline',
			'line-through' =>'line-through',
			'blink' =>'blink',
		),
		'input_type' => 'select',
		'validate' => 'string'
	),


	'COLOR' => array(
		'input_type' => 'color',
		'validate' => 'string'
	),
	
	'BORDER_STYLE' => array(
		'values'=>array(
			'none'=>'none',
			'hidden' =>'hidden',
			'dotted' =>'dotted',
			'dashed' =>'dashed',
			'solid' =>'solid',
			'double' =>'double',
			'groove' =>'groove',
			'ridge' =>'ridge',
			'inset' =>'inset',
			'outset' =>'outset',
		),
		'input_type' => 'select',
		'validate' => 'string'
	),
	
	'TEXTAREA' => array(
		'input_type' => 'textarea',
		'validate' => 'string'
	),
	
	'SHOW_IN_COLUMN' => array(
		'values'=>array(
			'latest_posts'	=> __('Latest Posts',THEME_DOMAIN),
			'selected_posts' => __('Selected Posts Only',THEME_DOMAIN),
			'selected_pages' => __('Selected Pages Only',THEME_DOMAIN)
		),
		'input_type' => 'select',
		'validate' => 'string'
	),
	'CATEGORY_SELECT' => array(
		'values'	=> $categories_tree['values'],
		'class'		=> $categories_tree['class'],
		'input_type' => 'select',
		'validate' => 'string'
	),
	'SOCIAL' => array(
		'values'=>array(
			'delicious' =>'delicious.com',
			'digg' =>'digg.com',
			'facebook' =>'facebook.com',
			'stumbleupon' =>'stumbleupon.com',
			'reddit' =>'reddit.com',
			'twitter' =>'twitter.com',
		),
		'input_type' => 'checkbox',
		'multiselect' => 1,
		'validate' => 'string'
	),
	'SOCIAL_THEME' => array(
		'values'=>array(
			'green-jelly-icons' =>__('Green jelly',THEME_DOMAIN),
			'grey'				=>__('Grey',THEME_DOMAIN),
		),
		'input_type' => 'select',
		'validate' => 'string'
	),
	'PAGE_TYPES' => array(
		'values'=>array(
			'index' =>'Index page',
			'category' =>'Category',
			'tag' =>'Tag',
			'archive' =>'Archive',
			'search' =>'Search results',
			'author' =>'Author page',
		),
		'input_type' => 'checkbox',
		'multiselect' => 1,
		'validate' => 'string'
	),
	'REGULAR_POST_THUMBNAIL_POSITION' => array(
		'values'=>array(
			'at_the_left_under_post_title'	=>__('Under post title, at the left of excerpt',THEME_DOMAIN),
			'at_the_left_of_title' 			=>__('At the left of post title and excerpt',THEME_DOMAIN),
		),
		'input_type' => 'select',
		'validate' => 'string'
	),
	
);
//echo"####"; print_r($value_sets['CATEGORY_SELECT']);
