<?php
//include (str_replace('//','/',dirname(__FILE__)).'/valuesets.php');

$themename = "Clear Line";
$shortname = "vtm_clr";
//$options_name = $shortname . '_options'

/*
Recordset:
	title 			//short option name
	category		//category / tab where to display the option
	std				//default value. May be an array
	description		//long description. May contain html tags
	valueset		//name of value set. may not be null. May be an array
	width			//width of html input element. may be null. May be an array
	inherrit		//describes from what options the value can be inherited.
*/
$vtm_clr_admin_options = array (

	
	$shortname . '_sidebars_show_demo_data' => array(
		'title' 		=> 'Show Demo Data in Sidebars',
		'category'		=> 'Sidebars',
		'std'			=> 'yes',
		'description'	=> 'Show or not demo data in sidebars columns if there were no widgets added',
		'valueset'		=> 'YES_NO',
		'width'			=> 0,
	),	
	$shortname . '_index_sidebars' => array(
		'title' 		=> 'Sidebars on index page',
		'id'			=> $shortname . '_index_sidebars',
		'category'		=> 'Sidebars',
		'std'			=> '4_right_sidebars',
		'description'	=> 'Select what sidebars must be displayed',
		'valueset'		=> 'SIDEBARS',
		'width'			=> 0,
	),
	$shortname . '_single_page_sidebars' => array(
		'title' 		=> 'Sidebars on single page',
		'id'			=> $shortname . '_single_page_sidebars',
		'category'		=> 'Sidebars',
		'std'			=> 'right_sidebar',
		'description'	=> 'Select what sidebars must be displayed',
		'valueset'		=> 'SIDEBARS',
		'inherit'			=> array ('std'	=>	'none',  // none - doesn't inherit
								'from'	=>	array(
												$shortname.'_index_sidebars' => ''
											),
							),
		'width'			=> 0,
	),	
	$shortname . '_single_post_sidebars' => array(
		'title' 		=> 'Sidebars on single post',
		'id'			=> $shortname . '_single_post_sidebars',
		'category'		=> 'Sidebars',
		'std'			=> 'right_sidebar',
		'description'	=> 'Select what sidebars must be displayed',
		'valueset'		=> 'SIDEBARS',
		'inherit'			=> array ('std'	=>	'none',  // none - doesn't inherit
								'from'	=>	array(
												$shortname.'_index_sidebars' => '',
												$shortname.'_single_page_sidebars' => '',
												$shortname.'_category_sidebars' => '',
											),
							),
		'width'			=> 0,
	),	
	$shortname . '_category_sidebars' => array(
		'title' 		=> 'Sidebars on category pages',
		'id'			=> $shortname . '_category_sidebars',
		'category'		=> 'Sidebars',
		'std'			=> 'right_sidebar',
		'description'	=> 'Select what sidebars must be displayed',
		'valueset'		=> 'SIDEBARS',
		'inherit'			=> array ('std'	=>	'none',  // none - doesn't inherit
								'from'	=>	array(
												$shortname.'_index_sidebars' => ''
											),
							),
		'width'			=> 0,
	),	
	$shortname . '_tag_sidebars' => array(
		'title' 		=> 'Sidebars on tag pages',
		'id'			=> $shortname . '_tag_sidebars',
		'category'		=> 'Sidebars',
		'std'			=> 'right_sidebar',
		'description'	=> 'Select what sidebars must be displayed',
		'valueset'		=> 'SIDEBARS',
		'inherit'			=> array ('std'	=>	'none',  // none - doesn't inherit
								'from'	=>	array(
												$shortname.'_index_sidebars' => '',
												$shortname.'_category_sidebars' => '',
											),
							),
		'width'			=> 0,
	),	
	$shortname . '_archive_sidebars' => array(
		'title' 		=> 'Sidebars on archive pages',
		'id'			=> $shortname . '_archive_sidebars',
		'category'		=> 'Sidebars',
		'std'			=> 'right_sidebar',
		'description'	=> 'Select what sidebars must be displayed',
		'valueset'		=> 'SIDEBARS',
		'inherit'			=> array ('std'	=>	'none',  // none - doesn't inherit
								'from'	=>	array(
												$shortname.'_index_sidebars' => '',
												$shortname.'_category_sidebars' => '',
											),
							),
		'width'			=> 0,
	),
	
	$shortname . '_search_sidebars' => array(
		'title' 		=> 'Sidebars on search results pages',
		'id'			=> $shortname . '_search_sidebars',
		'category'		=> 'Sidebars',
		'std'			=> 'right_sidebar',
		'description'	=> 'Select what sidebars must be displayed',
		'valueset'		=> 'SIDEBARS',
		'width'			=> 0,
		'inherit'			=> array ('std'	=>	'none',  // none - doesn't inherit
								'from'	=>	array(
												$shortname.'_index_sidebars' => '',
												$shortname.'_category_sidebars' => '',
												$shortname.'_archive_sidebars' => '',
											),
							),
	),
	
	$shortname . '_404_sidebars' => array(
		'title' 		=> 'Sidebars on "Error 404 - Not Found" pages',
		'id'			=> $shortname . '_404_sidebars',
		'category'		=> 'Sidebars',
		'std'			=> 'right_sidebar',
		'description'	=> 'Select what sidebars must be displayed',
		'valueset'		=> 'SIDEBARS',
		'width'			=> 0,
		'inherit'			=> array ('std'	=>	'none',  // none - doesn't inherit
								'from'	=>	array(
												$shortname.'_index_sidebars' => '',
												$shortname.'_single_page_sidebars' => '',
												$shortname.'_single_post_sidebars' => '',
											),
							),
	),
	
	$shortname . '_other_sidebars' => array(
		'title' 		=> 'Sidebars on other pages',
		'category'		=> 'Sidebars',
		'std'			=> 'right_sidebar',
		'description'	=> 'This layout will be applied for all other pages not listed in options above. E.g. this layout will be applied to custom taxonomy pages',
		'valueset'		=> 'SIDEBARS',
		'width'			=> 0,
		'inherit'			=> array ('std'	=>	'none',  // none - doesn't inherit
								'from'	=>	array(
												$shortname.'_index_sidebars' => '',
												$shortname.'_single_page_sidebars' => '',
												$shortname.'_single_post_sidebars' => '',
												$shortname.'_category_sidebars' => '',
											),
							),
	),
	
	$shortname . '_page_width' => array(
		'title' 		=> 'Whole Page Width',
		'id'			=> $shortname . '_page_width',
		'category'		=> 'Sidebars',
		'std'			=> array ('value'=>'990','uom'=>'px'),
		'description'	=> 'The Width of the entire page. Enter a number and select a unit of measure.',
		'valueset'		=> array ('value'=>'NUMBER','uom'=>'WIDTH_UOM'),
		'width'			=> 7,
	),
	
	$shortname . '_blue_sidebar_width' => array(
		'title' 		=> 'Blue Sidebar Width',
		'id'			=> $shortname . '_blue_sidebar_width',
		'category'		=> 'Sidebars',
		'std'			=> array ('value'=>'270','uom'=>'px'),
		'description'	=> 'Enter a number and select a unit of measure',
		'valueset'		=> array ('value'=>'NUMBER','uom'=>'WIDTH_UOM'),
		'width'			=> 7,
	),
	
	$shortname . '_cyan_sidebar_width' => array(
		'title' 		=> 'Cyan Sidebar Width',
		'id'			=> $shortname . '_cyan_sidebar_width',
		'category'		=> 'Sidebars',
		'std'			=> array ('value'=>'210','uom'=>'px'),
		'description'	=> 'Enter a number and select a unit of measure',
		'valueset'		=> array ('value'=>'NUMBER','uom'=>'WIDTH_UOM'),
		'width'			=> 7,
	),
	$shortname . '_green_sidebar_width' => array(
		'title' 		=> 'Green Sidebar Width',
		'id'			=> $shortname . '_green_sidebar_width',
		'category'		=> 'Sidebars',
		'std'			=> array ('value'=>'210','uom'=>'px'),
		'description'	=> 'Enter a number and select a unit of measure',
		'valueset'		=> array ('value'=>'NUMBER','uom'=>'WIDTH_UOM'),
		'width'			=> 7,
	),	
	
	$shortname . '_orange_sidebar_width' => array(
		'title' 		=> 'Orange Sidebar Width',
		'id'			=> $shortname . '_orange_sidebar_width',
		'category'		=> 'Sidebars',
		'std'			=> array ('value'=>'380','uom'=>'px'),
		'description'	=> 'Enter a number and select a unit of measure. 
						 Please note that if you selected 4-sidebar layout the width will override the widths of cyan and green sidebars.',
		'valueset'		=> array ('value'=>'NUMBER','uom'=>'WIDTH_UOM'),
		'width'			=> 7,
	),	
	
	$shortname . '_sidebar_font' => array(
		'title' 		=> 'Sidebar Font',
		'category'		=> 'Sidebars',
		'std'			=> array ('family'=>'Georgia, serif', 'weight'=>'normal','size'=>'13', 'uom'=>'px',),
		'description'	=> '',
		'valueset'		=> array ('family'=>'FONT_FAMILY', 'weight'=>'FONT_WEIGHT','size'=>'NUMBER', 'uom'=>'FONT_SIZE_UOM',),
		'width'			=> 3,
		'inherit'			=> array ('std'	=>	$shortname.'_sidebar_headings_font', // 'none' - doesn't inherit
								'from'	=>	array(
												$shortname.'_sidebar_headings_font' => array('family' => 'family')
											),
							),
	),
	
	
	$shortname . '_sidebar_link_color' => array(
		'title' 		=> 'Sidebar Link Color',
		'category'		=> 'Sidebars',
		'std'			=> array ('regular'=>'#73b655','hover'=>'#000000'),
		'description'	=> '',
		'valueset'		=> array ('regular'=>'COLOR','hover'=>'COLOR'),
		'width'			=> 8,
	),	
	
	$shortname . '_blogroll_link_description_color' => array(
		'title' 		=> 'Blogroll Link Description Color',
		'category'		=> 'Sidebars',
		'std'			=> '#a0a0a0',
		'description'	=> '',
		'valueset'		=> 'COLOR',
		'width'			=> 8,
	),	
	
	$shortname . '_column_divider' => array(
		'title' 		=> 'Column Divider',
		'category'		=> 'Sidebars',
		'std'			=> 'no',
		'description'	=> 'Define whether to show column (sidebars) divider or not',
		'valueset'		=> 'YES_NO',
	),	
	
	$shortname . '_sidebar_headings_font' => array(
		'title' 		=> 'Sidebar Headings Font',
		'category'		=> 'Sidebars',
		'std'			=> array ('family'=>'Georgia, serif', 'weight'=>'normal','size'=>'22', 'uom'=>'px',),
		'description'	=> '',
		'valueset'		=> array ('family'=>'FONT_FAMILY', 'weight'=>'FONT_WEIGHT','size'=>'NUMBER', 'uom'=>'FONT_SIZE_UOM',),
		'width'			=> 3,
		'inherit'			=> array ('std'	=>	$shortname.'_h1_font', // 'none' - doesn't inherit
								'from'	=>	array(
												$shortname.'_h1_font' => array('family' => 'family')
											),
							),
	),
	
	$shortname . '_calendar_widget_font' => array(
		'title' 		=> 'Calendar Widget Font',
		'category'		=> 'Sidebars',
		'std'			=> array ('family'=>'Georgia, serif', 'weight'=>'normal'),
		'description'	=> '',
		'valueset'		=> array ('family'=>'FONT_FAMILY', 'weight'=>'FONT_WEIGHT',),
		'width'			=> 3,
		'inherit'			=> array ('std'	=>	$shortname.'_sidebar_font', // 'none' - doesn't inherit
								'from'	=>	array(
												$shortname.'_sidebar_font' => array('family' => 'family','weight'=>'weight')
											),
							),
	),
	
	$shortname . '_calendar_th_color' => array(
		'title' 		=> 'Calendar Days of Week color',
		'category'		=> 'Sidebars',
		'std'			=> array ('text'=>'#505050', 'background'=>'#eeeeee'),
		'description'	=> '',
		'valueset'		=> array ('text'=>'COLOR', 'background'=>'COLOR',),
		'width'			=> 8,
		'before'		=> array('text'=>'Text', 'background'=>'Background'),
		'inherit'			=> array ('std'	=>	$shortname.'_content_background', // 'none' - doesn't inherit
								'from'	=>	array(
												$shortname.'_content_background' => array('text' => 'color'),
												$shortname.'_h1_color' => array('text' => 'regular'),
											),
							),
	),
	
	$shortname . '_calendar_today' => array(
		'title' 		=> 'Calendar Today Highlighting',
		'category'		=> 'Sidebars',
		'std'			=> array ('background'=>'#eeeeee', 'border_style'=>'dotted', 'border_color'=>'#dddddd'),
		'description'	=> '',
		'valueset'		=> array ('background'=>'COLOR', 'border_style'=>'BORDER_STYLE', 'border_color'=>'COLOR'),
		'width'			=> 8,
		'before'		=> array('background'=>'Background color', 'border_style'=>'Border'),
		'inherit'			=> array ('std'	=>	$shortname.'_top_menu_background_color', // 'none' - doesn't inherit
								'from'	=>	array(
												$shortname.'_top_menu_background_color' => array('background' => '')
											),
							),
	),
	$shortname . '_footer_show_demo_data' => array(
		'title' 		=> 'Show Demo Data in the Footer',
		'category'		=> 'Footer',
		'std'			=> 'yes',
		'description'	=> 'Show or not demo data in footer columns if there were no widgets added',
		'valueset'		=> 'YES_NO',
		'width'			=> 0,
	),		
	$shortname . '_footers' => array(
		'title' 		=> 'Columns in The Footer',
		'category'		=> 'Footer',
		'std'			=> '3',
		'description'	=> '',
		'valueset'		=> 'FOOTERS',
		'width'			=> 0,
	),
	
	$shortname . '_footer_equal_columns' => array(
		'title' 		=> 'Equal Footer Columns',
		'category'		=> 'Footer',
		'std'			=> 'yes',
		'description'	=> 'Note that if you select YES, the followng options do not affect the appearance',
		'valueset'		=> 'YES_NO',
		'width'			=> 0,
	),	
	
	$shortname . '_blue_footer_column_width' => array(
		'title' 		=> 'Blue Footer Column Width',
		'category'		=> 'Footer',
		'std'			=> array ('value'=>'200','uom'=>'px'),
		'description'	=> 'Enter a number and select a unit of measure',
		'valueset'		=> array ('value'=>'NUMBER','uom'=>'WIDTH_UOM'),
		'width'			=> 7,
	),
	$shortname . '_green_footer_column_width' => array(
		'title' 		=> 'Green Footer Column Width',
		'category'		=> 'Footer',
		'std'			=> array ('value'=>'200','uom'=>'px'),
		'description'	=> 'Enter a number and select a unit of measure',
		'valueset'		=> array ('value'=>'NUMBER','uom'=>'WIDTH_UOM'),
		'width'			=> 7,
	),	
	$shortname . '_orange_footer_column_width' => array(
		'title' 		=> 'Orange Footer Column Width',
		'category'		=> 'Footer',
		'std'			=> array ('value'=>'200','uom'=>'px'),
		'description'	=> 'Enter a number and select a unit of measure',
		'valueset'		=> array ('value'=>'NUMBER','uom'=>'WIDTH_UOM'),
		'width'			=> 7,
	),
	$shortname . '_red_footer_column_width' => array(
		'title' 		=> 'Red Footer Column Width',
		'category'		=> 'Footer',
		'std'			=> array ('value'=>'200','uom'=>'px'),
		'description'	=> 'Enter a number and select a unit of measure',
		'valueset'		=> array ('value'=>'NUMBER','uom'=>'WIDTH_UOM'),
		'width'			=> 7,
	),	
	$shortname . '_footer_background_color' => array(
		'title' 		=> 'Footer Background Color',
		'category'		=> 'Footer',
		'std'			=> '#fbfbfb',
		'description'	=> '',
		'valueset'		=> 'COLOR',
		'width'			=> 8,
		'inherit'		=> array ('std'	=>	$shortname.'_top_menu_background_color', //'none', // none - doesn't inherit
						'from'	=>	array(
										$shortname.'_top_menu_background_color' => array('' => '')
									),
					),		
	),	
	
	$shortname . '_text_font' => array(
		'title' 		=> 'Text Font',
		'id'			=> $shortname . '_text_font',
		'category'		=> 'General',
		'std'			=> array ('family'=>'Verdana, Geneva, sans-serif', 'weight'=>'normal','size'=>'12', 'uom'=>'px',),
		'description'	=> '',
		'valueset'		=> array ('family'=>'FONT_FAMILY', 'weight'=>'FONT_WEIGHT','size'=>'NUMBER', 'uom'=>'FONT_SIZE_UOM',),
		'width'			=> 3,
	),
	$shortname . '_text_color' => array(
		'title' 		=> 'Text Color',
		'id'			=> $shortname . '_text_color',
		'category'		=> 'General',
		'std'			=> '#505050',
		'description'	=> 'Body text color',
		'valueset'		=> 'COLOR',
		'width'			=> 8,
	),

	$shortname . '_body_background_color' => array(
		'title' 		=> 'Body Background Color',
		'id'			=> $shortname . '_body_background_color',
		'category'		=> 'General',
		'std'			=> '#ffffff',
		'description'	=> 'This is the background color of the entire web page',
		'valueset'		=> 'COLOR',
		'width'			=> 8,
	),
	
	
	$shortname . '_content_background' => array(
		'title' 		=> 'Content Background Color',
		'category'		=> 'General',
		'std'			=> array ('transparent'=>'no', 'color'=>'#ffffff'),
		'valueset'		=> array('transparent'=>'YES_NO', 'color'=>'COLOR'),
		'before'		=>array ('transparent'=>__('Transparent:'), 'color'=>__('Color:')),
		'width'			=> 8,
	),
	
	$shortname . '_base_color' => array(
		'title' 		=> 'Base Color',
		'id'			=> $shortname . '_base_color',
		'category'		=> 'General',
		'std'			=> '#93d675',
		'description'	=> 'Base Color of lines',
		'valueset'		=> 'COLOR',
		'width'			=> 8,
	),
	
	$shortname . '_show_blog_title_and_description' => array(
		'title' 		=> 'Show Blog Title And Description',
		'category'		=> 'Header',
		'std'			=> 'yes',
		'description'	=> 'You might want to hide the blog title and description when using full-width header image. '.
							'Please note that the folowing option "header font size" is still meaningful - in this case it means header height',
		'valueset'		=> 'YES_NO',
		'width'			=> 0,
	),
	$shortname . '_header_font' => array(
		'title' 		=> 'Header Font',
		'id'			=> $shortname . '_header_font',
		'category'		=> 'Header',
		'std'			=> array ('family'=>'Georgia, serif', 'weight'=>'normal','size'=>'64', 'uom'=>'px',),
		'description'	=> '',
		'valueset'		=> array ('family'=>'FONT_FAMILY', 'weight'=>'FONT_WEIGHT','size'=>'NUMBER', 'uom'=>'FONT_SIZE_UOM',),
		'width'			=> 3,
	),
	$shortname . '_header_description_font' => array(
		'title' 		=> 'Header Description Font',
		'id'			=> $shortname . '_header_description_font',
		'category'		=> 'Header',
		'std'			=> array ('family'=>'Georgia, serif', 'weight'=>'normal','size'=>'18', 'uom'=>'px',),
		'description'	=> '',
		'valueset'		=> array ('family'=>'FONT_FAMILY', 'weight'=>'FONT_WEIGHT','size'=>'NUMBER', 'uom'=>'FONT_SIZE_UOM',),
		'width'			=> 3,
	),
	$shortname . '_header_left_paddig' => array(
		'title' 		=> 'Header Title Left Padding',
		'category'		=> 'Header',
		'std'			=> '0',
		'description'	=> 'If you want to place an image before the blog title, set the value to the width of the image. E.g. if your image width is 100px set the value to 100.',
		'valueset'		=> 'NUMBER',
		'after'			=>'px',
		'width'			=> 3,
	),
	$shortname . '_header_top_paddig' => array(
		'title' 		=> 'Header Title Top Padding',
		'category'		=> 'Header',
		'std'			=> '0',
		'description'	=> 'If you want to have more space above the blog title, set a non-zero value. ',
		'valueset'		=> 'NUMBER',
		'after'			=>'px',
		'width'			=> 3,
	),


	$shortname . '_custom_blog_title' => array(
		'title' 		=> 'Custom Blog Title',
		'category'		=> 'Header',
		'std'			=> '',
		'description'	=> 'custom blog title option',
		'valueset'		=> 'TEXTAREA',
		'rows'			=> 5,
	),

	$shortname . '_header_image_size' => array(
		'title' 		=> 'Header Image Size',
		'category'		=> 'Header',
		'std'			=> array('x'=>'1600', 'y'=>'150', 'fit_height' =>'no'),
		'description'	=> 'Image of this size should be uploaded at Appearance -> Header. The uploaded image will be displayed in the header as a background image.',
		'valueset'		=> array('x'=>'NUMBER', 'y'=>'NUMBER', 'fit_height' =>'YES_NO'),
		'before'		=> array('x'=>'', 'y'=>' x ', 'fit_height' =>'Fit header space height to the image height'),
		'width'			=> 3,
	),
	$shortname . '_header_background_position_css' => array(
		'title' 		=> 'Header Background Position CSS',
		'category'		=> 'Header',
		'std'			=> 'left top',
		'description'	=> 'You can select a header image at Appearance -> Header. The image  will be placed according to this option. '
							. 'The option value will be placed right after "background-position:" in #header css. '
							. 'To place the image to the right of your blog title, set the value to "80% top".' ,
		'valueset'		=> 'TEXT',
		'width'			=> 20,
	),
	
	$shortname . '_header_background' => array(
		'title' 		=> 'Header Background Color',
		'category'		=> 'Header',
		'std'			=> array ('transparent'=>'no', 'color'=>'#ffffff'),
		'valueset'		=> array('transparent'=>'YES_NO', 'color'=>'COLOR'),
		'before'		=>array ('transparent'=>__('Transparent:'), 'color'=>__('Color:')),
		'width'			=> 8,
	),	
	$shortname . '_show_top_menu' => array(
		'title' 		=> 'Show Top Menu',
		'category'		=> 'Navigation',
		'std'			=> 'yes',
		'description'	=> 'If you set the option to NO, the top menu will be hidden',
		'valueset'		=> 'YES_NO',
	),	
	$shortname . '_top_menu_font' => array(
		'title' 		=> 'Top Menu Font',
		'id'			=> $shortname . '_top_menu_font',
		'category'		=> 'Navigation',
		'std'			=> array ('family'=>'Trebuchet MS, Helvetica, sans-serif', 'weight'=>'normal','size'=>'18', 'uom'=>'px',),
		'description'	=> '',
		'valueset'		=> array ('family'=>'FONT_FAMILY', 'weight'=>'FONT_WEIGHT','size'=>'NUMBER', 'uom'=>'FONT_SIZE_UOM',),
		'width'			=> 3,
	),
	$shortname . '_top_menu_height' => array(
		'title' 		=> 'Top Menu Height',
		'category'		=> 'Navigation',
		'std'			=> '38',
		'after'			=> 'px',
		'description'	=> '',
		'valueset'		=> 'NUMBER',
		'width'			=> 3,
	),
	$shortname . '_top_menu_text_color' => array(
		'title' 		=> 'Top Menu Font Color',
		'category'		=> 'Navigation',
		'std'			=> array ('regular'=>'#707070', 'hover'=>'#000000'),
		'description'	=> 'Top Menu Text Color - regular and hovered',
		'valueset'		=> array ('regular'=>'COLOR', 'hover'=>'COLOR',),
		'width'			=> 8,
	),
	
	$shortname . '_top_menu_borders' => array(
		'title' 		=> 'Top Menu Borders',
		'category'		=> 'Navigation',
		'std'			=> array('top_width'=>4, 'top_style'=>'solid','top_color'=>'#93D675','bottom_width'=>2, 'bottom_style'=>'solid','bottom_color'=>'#93D675'),
		'description'	=> '',
		'valueset'		=> array('top_width'=>'NUMBER', 'top_style'=>'BORDER_STYLE','top_color'=>'COLOR','bottom_width'=>'NUMBER', 'bottom_style'=>'BORDER_STYLE','bottom_color'=>'COLOR'),
		'before'		=> array ('top_width'=>'Top border: ','bottom_width'=>'Bottom border: '),
		'after'		=> array ('top_width'=>'px','bottom_width'=>'px', 'top_color' => '<br>'),
		'inherit'			=> array ('std'	=>	$shortname.'_base_color', //'none', // none - doesn't inherit
								'from'	=>	array(
												$shortname.'_base_color' => array('top_color'=>'','bottom_color'=>''),
												$shortname.'_top_menu_background_color' => array('top_color'=>'','bottom_color'=>''),
											),
							),
		'width'			=> array('top_width'=>1, 'top_color'=>8,'bottom_width'=>1,'bottom_color'=>8),
	),
	
	$shortname . '_breadcrumbs_show' => array(
		'title' 		=> 'Show Breadcrumbs',
		'category'		=> 'Navigation',
		'std'			=> 'yes',
		'description'	=> 'Select YES to show entire path (categories) to current single post',
		'valueset'		=> 'YES_NO',
	),	

	$shortname . '_breadcrumbs_font' => array(
		'title' 		=> 'Breadcrumbs Font',
		'category'		=> 'Navigation',
		'std'			=> array ('family'=>'Trebuchet MS, Helvetica, sans-serif', 'weight'=>'normal','size'=>'13', 'uom'=>'px',),
		'description'	=> '',
		'valueset'		=> array ('family'=>'FONT_FAMILY', 'weight'=>'FONT_WEIGHT','size'=>'NUMBER', 'uom'=>'FONT_SIZE_UOM',),
		'width'			=> 3,
	),

	$shortname . '_breadcrumbs_color' => array(
		'title' 		=> 'Breadcrumbs Color',
		'id'			=> $shortname . '_breadcrumbs_color',
		'category'		=> 'Navigation',
		'std'			=> '#707070',
		'description'	=> 'Base Color',
		'valueset'		=> 'COLOR',
		'width'			=> 8,
	),	

	$shortname . '_top_menu_background_color' => array(
		'title' 		=> 'Top Menu Background Color',
		'id'			=> $shortname . '_top_menu_background_color',
		'category'		=> 'Navigation',
		'std'			=> '#fbfbfb',
		'description'	=> 'Top Background Color',
		'valueset'		=> 'COLOR',
		'width'			=> 8,
	),	
	$shortname . '_top_menu_current_item_color' => array(
		'title' 		=> 'Top Menu Current Item Color',
		'id'			=> $shortname . '_top_menu_current_item_color',
		'category'		=> 'Navigation',
		'std'			=> array('text'=>'#505050','background'=>'#f0f0f0',),
		'description'	=> 'Text and Background color of current item of the Top menu',
		'valueset'		=> array('text'=>'COLOR','background'=>'COLOR',),
		'width'			=> 8,
	),	
	$shortname . '_top_submenu_font' => array(
		'title' 		=> 'Top Submenu Font',
		'id'			=> $shortname . '_top_submenu_font',
		'category'		=> 'Navigation',
		'std'			=> array ('family'=>'Trebuchet MS, Helvetica, sans-serif', 'weight'=>'normal','size'=>'13', 'uom'=>'px',),
		'description'	=> '',
		'valueset'		=> array ('family'=>'FONT_FAMILY', 'weight'=>'FONT_WEIGHT','size'=>'NUMBER', 'uom'=>'FONT_SIZE_UOM',),
		'width'			=> 3,
	),
	$shortname . '_top_submenu_width' => array(
		'title' 		=> 'Width of Top Menu Submenus',
		'id'			=> $shortname . '_top_submenu_width',
		'category'		=> 'Navigation',
		'std'			=> 170,
		'description'	=> 'Width of the top menu submenus in pixels',
		'valueset'		=> 'NUMBER',
		'width'			=> 3,
	),
	
	$shortname . '_h1_font' => array(
		'title' 		=> 'H1 Headings Font',
		'id'			=> $shortname . '_h1_font',
		'category'		=> 'Headings',
		'std'			=> array ('family'=>'Georgia, serif', 'weight'=>'normal','size'=>'36', 'uom'=>'px',),
		'description'	=> '',
		'valueset'		=> array ('family'=>'FONT_FAMILY', 'weight'=>'FONT_WEIGHT','size'=>'NUMBER', 'uom'=>'FONT_SIZE_UOM',),
		'width'			=> 3,
	),
	
	$shortname . '_h1_color' => array(
		'title' 		=> 'Headings Color',
		'id'			=> $shortname . '_h1_color',
		'category'		=> 'Headings',
		'std'			=> '#505050',
		'description'	=> 'Headings',
		'valueset'		=> 'COLOR',
		'width'			=> 8,
	),
	$shortname . '_h1_hover_color' => array(
		'title' 		=> 'Headings Hover Color',
		'id'			=> $shortname . '_h1_hover_color',
		'category'		=> 'Headings',
		'std'			=> '#000000',
		'description'	=> 'Headings',
		'valueset'		=> 'COLOR',
		'width'			=> 8,
	),
	$shortname . '_h2_font' => array(
		'title' 		=> 'H2 Headings Font',
		'category'		=> 'Headings',
		'std'			=> array ('family'=>'Georgia, serif', 'weight'=>'normal','size'=>'24', 'uom'=>'px',),
		'description'	=> '',
		'valueset'		=> array ('family'=>'FONT_FAMILY', 'weight'=>'FONT_WEIGHT','size'=>'NUMBER', 'uom'=>'FONT_SIZE_UOM',),
		'inherit'		=> array ('std'	=>	$shortname . '_h1_font',  // 'none' - doesn't inherit
				'from'	=>	array(
								$shortname.'_h1_font' => array('family'=>'family'),
							),
			),
		'width'			=> 3,
	),
	$shortname . '_h2_color' => array(
		'title' 		=> 'H2 Headings Color',
		'category'		=> 'Headings',
		'std'			=> '#505050',
		'description'	=> 'Headings',
		'valueset'		=> 'COLOR',
		'width'			=> 8,
		'inherit'		=> array ('std'	=>	$shortname.'_h1_color', //'none', // none - doesn't inherit
						'from'	=>	array(
										$shortname.'_h1_color' => array('' => '')
									),
					),
	),
	$shortname . '_h3_font' => array(
		'title' 		=> 'H3 Headings Font',
		'category'		=> 'Headings',
		'std'			=> array ('family'=>'Georgia, serif', 'weight'=>'normal','size'=>'18', 'uom'=>'px',),
		'description'	=> '',
		'valueset'		=> array ('family'=>'FONT_FAMILY', 'weight'=>'FONT_WEIGHT','size'=>'NUMBER', 'uom'=>'FONT_SIZE_UOM',),
		'inherit'		=> array ('std'	=>	$shortname . '_h1_font',  // 'none' - doesn't inherit
				'from'	=>	array(
								$shortname.'_text_font' => array('family'=>'family'),
								$shortname.'_h1_font' => array('family'=>'family'),
								$shortname.'_h2_font' => array('family'=>'family'),
							),
			),
		'width'			=> 3,
	),	
	$shortname . '_h3_color' => array(
		'title' 		=> 'H3 Headings Color',
		'category'		=> 'Headings',
		'std'			=> '#98293D',
		'description'	=> '',
		'valueset'		=> 'COLOR',
		'width'			=> 8,
		'inherit'		=> array ('std'	=>	'none', //'none', // none - doesn't inherit
						'from'	=>	array(
										$shortname.'_h1_color' => array('' => ''),
										$shortname.'_base_color' => array('' => '')
									),
					),
	),
	$shortname . '_h4_font' => array(
		'title' 		=> 'H4 Headings Font',
		'category'		=> 'Headings',
		'std'			=> array ('family'=>'Georgia, serif', 'weight'=>'bold','size'=>'13', 'uom'=>'px',),
		'description'	=> '',
		'valueset'		=> array ('family'=>'FONT_FAMILY', 'weight'=>'FONT_WEIGHT','size'=>'NUMBER', 'uom'=>'FONT_SIZE_UOM',),
		'inherit'		=> array ('std'	=>	$shortname . '_text_font',  // 'none' - doesn't inherit
				'from'	=>	array(
								$shortname.'_text_font' => array('family'=>'family'),
								$shortname.'_h1_font' => array('family'=>'family'),
								$shortname.'_h2_font' => array('family'=>'family'),
								$shortname.'_h3_font' => array('family'=>'family'),
							),
			),
		'width'			=> 3,
	),		
	$shortname . '_h4_color' => array(
		'title' 		=> 'H4 Headings Color',
		'category'		=> 'Headings',
		'std'			=> '#505050',
		'description'	=> '',
		'valueset'		=> 'COLOR',
		'width'			=> 8,
		'inherit'		=> array ('std'	=>	$shortname.'_h1_color', //'none', // none - doesn't inherit
						'from'	=>	array(
										$shortname.'_h1_color' => array('' => ''),
										$shortname.'_base_color' => array('' => '')
									),
					),
	),
	
	$shortname . '_show_post_info' => array(
		'title' 			=> 'Show Post Info',
		'id'				=> $shortname . '_show_post_info',
		'category'		=> 'Post',
		'std'				=> 'yes',
		'description'		=> 'Show or not date, author and categories under post title',
		'valueset'		=> 'YES_NO',
		'width'			=> 0,
	),
	
	$shortname . '_post_link' => array(
		'title' 		=> 'Post Link',
		'id'			=> $shortname . '_post_link',
		'category'		=> 'Post',
		'std'			=> array('regular_color'=>'#a17244','regular_decoration'=>'underline','hover_color'=>'#de8435','hover_decoration'=>'underline'),
		'description'	=> 'Define color and text decoration for regular post links',
		'valueset'		=> array('regular_color'=>'COLOR','regular_decoration'=>'TEXT_DECORATION','hover_color'=>'COLOR','hover_decoration'=>'TEXT_DECORATION'),
		'width'			=> 8,
	),	

	$shortname . '_post_link_visited' => array(
		'title' 		=> 'Post Link Visited',
		'id'			=> $shortname . '_post_link_visited',
		'category'		=> 'Post',
		'std'			=> array('color'=>'#756455','decoration'=>'underline'),
		'description'	=> 'Define color and text decoration for visited post links',
		'valueset'		=> array('color'=>'COLOR','decoration'=>'TEXT_DECORATION'),
		'width'			=> 8,
	),	
	
	$shortname . '_pre_color' => array(
		'title' 		=> 'Preformatted Text Block Color',
		'id'			=> $shortname . '_pre_color',
		'category'		=> 'Post',
		'std'			=> array('border'=>'#cccccc','background'=>'#fbfbfb',),
		'description'	=> 'Border Color and Background Color of the preformatted text (PRE tag)',
		'valueset'		=> array('border'=>'COLOR','background'=>'COLOR',),
		'width'			=> 8,
	),
	
	$shortname . '_blockquote_color' => array(
		'title' 		=> 'Blockquote Color',
		'id'			=> $shortname . '_blockquote_color',
		'category'		=> 'Post',
		'std'			=> array('border'=>'#cccccc','background'=>'#fbfbfb',),
		'description'	=> 'Border Color and Background Color of the Blockquote text (BLOCKQUOTE tag)',
		'valueset'		=> array('border'=>'COLOR','background'=>'COLOR',),
		'width'			=> 8,
	),	
	
	$shortname . '_show_comments_off' => array(
		'title' 		=> 'Show "Comments off" text',
		'id'			=> $shortname . '_show_comments_off',
		'category'		=> 'Post',
		'std'			=> 'yes',
		'description'	=> 'Show or not "Comments off" text if comments are closed.',
		'valueset'		=> 'YES_NO',
		'width'			=> 0,
	),
	/*_post_info_panel_border_color*/
	$shortname . '_dividers_color' => array(
		'title' 		=> 'Dividers color',
		'id'			=> $shortname . '_post_info_panel_border_color',
		'category'		=> 'Post',
		'std'			=> '#eeeeee',
		'description'	=> 'The color affects various kinds of dividers: <code>&lt;hr&gt;</code> tag, post info panels top border, comments borders etc.',
		'valueset'		=> 'COLOR',
		'width'			=> 8,
	),
	
	$shortname . '_show_post_author' => array(
		'title' 		=> 'Show post\'s author',
		'id'			=> $shortname . '_show_post_author',
		'category'		=> 'Post',
		'std'			=> 'yes',
		'description'	=> 'Show or not post\'s author',
		'valueset'		=> 'YES_NO',
		'width'			=> 0,
	),
	
	$shortname . '_table_font' => array(
		'title' 		=> 'Table Font',
		'category'		=> 'Post',
		'std'			=> array ('family'=>'Trebuchet MS, Helvetica, sans-serif', 'weight'=>'normal','size'=>'90', 'uom'=>'%',),
		'description'	=> '',
		'valueset'		=> array ('family'=>'FONT_FAMILY', 'weight'=>'FONT_WEIGHT','size'=>'NUMBER', 'uom'=>'FONT_SIZE_UOM',),
		'inherit'		=> array ('std'	=>	'none',  // 'none' - doesn't inherit
				'from'	=>	array(
								$shortname.'_text_font' => array('family'=>'family'),
							),
			),
		'width'			=> 3,
	),		
	
	$shortname . '_show_allowed_tags_below_comment_box' => array(
		'title' 		=> 'Show Allowed Tags Below Comment Box',
		'category'		=> 'Comments',
		'std'			=> 'yes',
		'description'	=> 'Show or not tags (like <code>&lt;a href="" title=""&gt;</code>) allowed in comments',
		'valueset'		=> 'YES_NO',
	),
	
	$shortname . '_comments_avatar_size' => array(
		'title' 		=> 'Avatar size in comments (in pixels)',
		'category'		=> 'Comments',
		'std'			=> '26',
		'description'	=> 'Avatar size in comments (in pixels)',
		'valueset'		=> 'NUMBER',
		'width'			=> 3,
	),
	
	$shortname . '_comments_metadata_font' => array(
		'title' 		=> 'Comments Metadata Font',
		'id'			=> $shortname . '_comments_metadata_font',
		'category'		=> 'Comments',
		'std'			=> array ('family'=>'Trebuchet MS, Helvetica, sans-serif', 'weight'=>'normal','size'=>'11', 'uom'=>'px',),
		'description'	=> 'The font that will be used to display comment\'s author, date and action links',
		'valueset'		=> array ('family'=>'FONT_FAMILY', 'weight'=>'FONT_WEIGHT','size'=>'NUMBER', 'uom'=>'FONT_SIZE_UOM',),
		'width'			=> 3,
	),
	
	$shortname . '_comment_metadata_color' => array(
		'title' 		=> 'Comment metadata color',
		'category'		=> 'Comments',
		'std'			=> '#707070',
		'description'	=> 'Color of permanent links to comments and "edit" links color',
		'valueset'		=> 'COLOR',
		'width'			=> 8,
	),

	$shortname . '_comment_border' => array(
		'title' 		=> 'Top level comment border',
		'category'		=> 'Comments',
		'std'			=> array('show'=>'yes','color'=>'#707070'),
		'description'	=> 'Define show border for the top level comment or not. Set it\'s color',
		'valueset'		=> array('show'=>'YES_NO','color'=>'COLOR'),
		'before'			=> array('show'=>'Show border','color'=>''),
		'inherit'			=> array ('std'	=>	$shortname.'_base_color', //'none', // none - doesn't inherit
								'from'	=>	array(
												$shortname.'_base_color' => array('color' => '')
											),
							),
		'width'			=> 8,
	),
	
	$shortname . '_commentator_font' => array(
		'title' 			=> 'Commenter Font',
		'id'			=> $shortname . '_comments_author_font',
		'category'		=> 'Comments',
		'std'			=> array ('family'=>'Verdana, Geneva, sans-serif','weight'=>'bold','size'=>'14', 'uom'=>'px',),
		'description'	=> 'The font that will be used to display comment\'s author. ',
		'valueset'		=> array ('family'=>'FONT_FAMILY','weight'=>'FONT_WEIGHT','size'=>'NUMBER', 'uom'=>'FONT_SIZE_UOM',),
		'width'			=> 3,
	),
	
	$shortname . '_commentator_link_color' => array(
		'title' 		=> 'Color of links to commenter websites',
		'category'		=> 'Comments',
		'std'			=> array('regular'=>'#723419','hover'=>'#de8435'),
		'description'	=> 'Regular and hovered colors of link to website of the comment author',
		'valueset'		=> array('regular'=>'COLOR','hover'=>'COLOR'),
		'inherit'			=> array ('std'	=>	$shortname.'_top_menu_text_color', //'none', // none - doesn't inherit
								'from'	=>	array(
												$shortname.'_post_link' => array('regular'=>'regular_color','hover' => 'hover_color'),
												$shortname.'_top_menu_text_color' => array('regular'=>'regular','hover' => 'hover'),
												//$shortname.'_base_color' => array('regular'=>''),
											),
							),
		'width'			=> 8,
	),
	
	$shortname . '_post_author_link_color' => array(
		'title' 		=> 'Post Author Link Color',
		'category'		=> 'Comments',
		'std'			=> array('regular'=>'#98293D','hover'=>'#000000'),
		'description'	=> 'Color of link to the website of the post author',
		'valueset'		=> array('regular'=>'COLOR','hover'=>'COLOR'),
		'inherit'			=> array ('std'	=>	'none', //'none', // none - doesn't inherit
								'from'	=>	array(
												$shortname.'_post_link' => array('regular'=>'regular_color','hover' => 'hover_color'),
												$shortname.'_commentator_link_color' => array('regular'=>'regular','hover' => 'hover'),
												$shortname.'_top_menu_text_color' => array('regular'=>'regular','hover' => 'hover'),
												$shortname.'_base_color' => array('regular'=>''),
											),
							),
		'width'			=> 8,
	),	
	
	$shortname . '_post_author_comment_color' => array(
		'title' 		=> 'Color of Comments by the Post Author',
		'category'		=> 'Comments',
		'std'			=> '#98293D',
		'description'	=> '',
		'valueset'		=> 'COLOR',
		'inherit'			=> array ('std'	=>	'none', //'none', // none - doesn't inherit
								'from'	=>	array(
												$shortname.'_text_color' => array(''=>''),
												$shortname.'_base_color' => array(''=>''),

											),
							),
		'width'			=> 8,
	),	
	
	$shortname . '_comment_author_background' => array(
		'title' 		=> 'Background Color of comment author and metadata bar',
		'category'		=> 'Comments',
		'std'			=> array('use'=>'yes','color'=>'#fbfbfb'),
		'description'	=> 'Background Color of comment author and metadata bar',
		'valueset'		=> array('use'=>'YES_NO','color'=>'COLOR'),
		'before'		=> array ('use'=>'Use the background color'),
		'inherit'			=> array ('std'	=>	$shortname.'_top_menu_background_color', //'none', // none - doesn't inherit
								'from'	=>	array(
												$shortname.'_top_menu_background_color' => array('color'=>'')
											),
							),
		'width'			=> 8,
	),

	$shortname . '_comment_reply_link_color' => array(
		'title' 		=> 'Color of reply link',
		'category'		=> 'Comments',
		'std'			=> array('regular'=>'#723419','hover'=>'#de8435'),
		'description'	=> '',
		'valueset'		=> array('regular'=>'COLOR','hover'=>'COLOR'),
		'inherit'			=> array ('std'	=>	$shortname.'_top_menu_text_color', //'none', // none - doesn't inherit
								'from'	=>	array(
												$shortname.'_post_link' => array('regular'=>'regular_color','hover' => 'hover_color'),
												$shortname.'_top_menu_text_color' => array('regular'=>'regular','hover' => 'hover'),
											),
							),
		'width'			=> 8,
	),	
	$shortname . '_comment_reply_background' => array(
		'title' 		=> 'Background Color of comment reply link',
		'category'		=> 'Comments',
		'std'			=> array('use'=>'yes','color'=>'#fbfbfb'),
		'description'	=> '',
		'valueset'		=> array('use'=>'YES_NO','color'=>'COLOR'),
		'before'		=> array ('use'=>'Use the background color'),
		'inherit'			=> array ('std'	=>	$shortname.'_top_menu_background_color', //'none', // none - doesn't inherit
								'from'	=>	array(
												$shortname.'_top_menu_background_color' => array('color'=>''),
												$shortname.'_base_color' => array('color'=>''),
												
											),
							),
		'width'			=> 8,
	),	

	$shortname . '_comment_reply_border' => array(
		'title' 		=> 'Border Color of comment reply link',
		'category'		=> 'Comments',
		'std'			=> array('style'=>'dotted','color'=>'#fbfbfb'),
		'description'	=> '',
		'valueset'		=> array('style'=>'BORDER_STYLE','color'=>'COLOR'),
		'before'		=> array ('style'=>'Border style'),
		'inherit'			=> array ('std'	=>	$shortname.'_comment_border', //'none', // none - doesn't inherit
								'from'	=>	array(
												$shortname.'_comment_border' => array('color'=>'color'),
												$shortname.'_top_menu_background_color' => array('color'=>''),
												$shortname.'_base_color' => array('color'=>'')
											),
							),
		'width'			=> 8,
	),	

	$shortname . '_image_border' => array(
		'title' 		=> 'Image Border',
		'category'		=> 'Images',
		'std'			=> array('color'=>'#ff0000','radius'=>'3', 'uom' => 'px'),
		'description'	=> 'Border color and corner radius for images in posts when using captions or <code>wp-caption</code> class',
		'valueset'		=> array('color'=>'COLOR','radius'=>'NUMBER', 'uom' => 'WIDTH_UOM'),
		'before'		=> array ('radius'=>'Round corners radius'),
		'inherit'			=> array ('std'	=>	$shortname.'_dividers_color', //'none', // none - doesn't inherit
								'from'	=>	array(
												$shortname.'_dividers_color' => array('color'=>''),
												$shortname.'_top_menu_background_color' => array('color'=>''),
												$shortname.'_base_color' => array('color'=>'')
											),
							),
		'width'			=> array('color'=>8,'radius' =>2)
	),	

	$shortname . '_image_caption_font' => array(
		'title' 		=> 'Image Caption Font',
		'category'		=> 'Images',
		'std'			=> array ('family'=>'Verdana, Geneva, sans-serif', 'weight'=>'normal','size'=>'12', 'uom'=>'px',),
		'description'	=> '',
		'valueset'		=> array ('family'=>'FONT_FAMILY', 'weight'=>'FONT_WEIGHT','size'=>'NUMBER', 'uom'=>'FONT_SIZE_UOM',),
		'width'			=> 3,
		'inherit'			=> array ('std'	=>	$shortname.'_text_font', //'none', // none - doesn't inherit
								'from'	=>	array(
												$shortname.'_text_font' => array('family'=>'family','weight'=>'weight','size'=>'size','uom'=>'uom'),
												$shortname.'_top_menu_font' => array('family'=>'family'),
											),
							),
	),
	
	$shortname . '_image_caption_text_color' => array(
		'title' 		=> 'Image Caption Font',
		'category'		=> 'Images',
		'std'			=> '#707070',
		'description'	=> '',
		'valueset'		=> 'COLOR',
		'width'			=> 8,
		'inherit'			=> array ('std'	=>	$shortname.'_text_color', //'none', // none - doesn't inherit
								'from'	=>	array(
												$shortname.'_text_color' => array(''=>''),
												$shortname.'_top_menu_text_color' => array(''=>'regular'),
											),
							),
	),

	$shortname . '_pagination_page_box' => array(
		'title' 		=> 'Page Box',
		'category'		=> 'Pagination',
		'std'			=> array('text_color'=>'#505050','border_style'=>'solid', 'border_color'=>'#eeeeee' ),
		'description'	=> '',
		'valueset'		=> array('text_color'=>'COLOR','border_style'=>'BORDER_STYLE', 'border_color'=>'COLOR'),
		'before'		=> array ('text_color'=>'Text color', 'border_style'=>'Border'),
		'width'			=> 8
	),
	$shortname . '_pagination_current_page_box' => array(
		'title' 		=> 'Current Page Box',
		'category'		=> 'Pagination',
		'std'			=> array('text_color'=>'#ffffff','border_style'=>'solid', 'border_color'=>'#505050' , 'background_color' => '#505050'),
		'description'	=> '',
		'valueset'		=> array('text_color'=>'COLOR','border_style'=>'BORDER_STYLE', 'border_color'=>'COLOR' ,'background_color' => 'COLOR'),
		'before'		=> array ('text_color'=>'Text color', 'border_style'=>'Border','background_color' => 'Background'),
		'width'			=> 8
	),
	
	$shortname . '_pagination_page_box_hover' => array(
		'title' 		=> 'Page Box Hovered',
		'category'		=> 'Pagination',
		'std'			=> array('text_color'=>'#505050','border_style'=>'solid', 'border_color'=>'#505050' , 'background_color' => '#f7f7f7'),
		'description'	=> '',
		'valueset'		=> array('text_color'=>'COLOR','border_style'=>'BORDER_STYLE', 'border_color'=>'COLOR' ,'background_color' => 'COLOR'),
		'before'		=> array ('text_color'=>'Text color', 'border_style'=>'Border','background_color' => 'Background'),
		'width'			=> 8
	),
	$shortname . '_pagination_inactive_button' => array(
		'title' 		=> 'Pageination Inactive Button',
		'category'		=> 'Pagination',
		'std'			=> array('text_color'=>'#cccccc','border_style'=>'solid', 'border_color'=>'#eeeeee' , 'background_color' => '#ffffff'),
		'description'	=> '',
		'valueset'		=> array('text_color'=>'COLOR','border_style'=>'BORDER_STYLE', 'border_color'=>'COLOR' ,'background_color' => 'COLOR'),
		'before'		=> array ('text_color'=>'Text color', 'border_style'=>'Border','background_color' => 'Background'),
		'width'			=> 8
	),
	
	$shortname . '_seo_use_plugin' => array(
		'title' 		=> 'Use 3rd Party Plugin',
		'category'		=> 'SEO',
		'std'			=> 'no',
		'description'	=> '',
		'valueset'		=> 'YES_NO',
	),
	
	$shortname . '_seo_home_title' => array(
		'title' 		=> 'Home Title',
		'category'		=> 'SEO',
		'std'			=> '',
		'description'	=> '',
		'valueset'		=> 'TEXTAREA',
		'rows'			=> 2,
	),
	
	$shortname . '_seo_home_description' => array(
		'title' 		=> 'Home Description',
		'category'		=> 'SEO',
		'std'			=> '',
		'description'	=> '',
		'valueset'		=> 'TEXTAREA',
	),	
	$shortname . '_seo_home_keywords' => array(
		'title' 		=> 'Home Keywords',
		'category'		=> 'SEO',
		'std'			=> '',
		'description'	=> '',
		'valueset'		=> 'TEXTAREA',
	),
	$shortname . '_seo_post_title_format' => array(
		'title' 		=> 'Post Title Format',
		'category'		=> 'SEO',
		'std'			=> '%post_title% | %blog_title%',
		'description'	=> '',
		'valueset'		=> 'TEXT',
		'width'			=> 50,
	),
	$shortname . '_seo_page_title_format' => array(
		'title' 		=> 'Page Title Format',
		'category'		=> 'SEO',
		'std'			=> '%page_title% | %blog_title%',
		'description'	=> '',
		'valueset'		=> 'TEXT',
		'width'			=> 50,
	),
	$shortname . '_seo_category_title_format' => array(
		'title' 		=> 'Category Title Format',
		'category'		=> 'SEO',
		'std'			=> '%category% | %blog_title%',
		'description'	=> '',
		'valueset'		=> 'TEXT',
		'width'			=> 50,
	),
	$shortname . '_seo_tag_title_format' => array(
		'title' 		=> 'Tag Title Format',
		'category'		=> 'SEO',
		'std'			=> '%tag% | %blog_title%',
		'description'	=> '',
		'valueset'		=> 'TEXT',
		'width'			=> 50,
	),
	$shortname . '_post_list_column_count' => array(
		'title' 		=> 'Column Count',
		'category'		=> 'Post List',
		'std'			=> '2',
		'description'	=> '',
		'valueset'		=> 'NUMBER',
		'width'			=> 3,
	),
	$shortname . '_post_list_column_rows' => array(
		'title' 		=> 'Column Rows',
		'category'		=> 'Post List',
		'std'			=> '2',
		'description'	=> '',
		'valueset'		=> 'NUMBER',
		'width'			=> 3,
	),
	$shortname . '_show_category_in_column' => array(
		'title' 		=> 'Show in columns post from this category',
		'category'		=> 'Post List',
		'std'			=> '0',
		'description'	=> '',
		'valueset'		=> 'CATEGORY_SELECT',
	),
	
	$shortname . '_show_latest_post_before_columns' => array(
		'title' 		=> 'Show Latest Post Before Columns',
		'category'		=> 'Post List',
		'std'			=> 'yes',
		'description'	=> '',
		'valueset'		=> 'YES_NO',
	),
	
	$shortname . '_normal_thumbnail_size' => array(
		'title' 		=> 'Normal Thumbnail Size',
		'category'		=> 'Post List',
		'std'			=> array('x'=>'100', 'y'=>'100'),
		'description'	=> '',
		'valueset'		=> array('x'=>'NUMBER', 'y'=>'NUMBER'),
		'before'		=> array('x'=>'', 'y'=>' x '),
		'width'			=> 3,
	),
	$shortname . '_column_thumbnail_size' => array(
		'title' 		=> 'Column Thumbnail Size',
		'category'		=> 'Post List',
		'std'			=> array('x'=>'270', 'y'=>'60'),
		'description'	=> '',
		'valueset'		=> array('x'=>'NUMBER', 'y'=>'NUMBER'),
		'before'		=> array('x'=>'', 'y'=>' x '),
		'width'			=> 3,
	),
	$shortname . '_thumbnail_show_border' => array(
		'title' 		=> 'Show Thumbnail Border',
		'category'		=> 'Post List',
		'std'			=> 'yes',
		'description'	=> '',
		'valueset'		=> 'YES_NO',
	),

	$shortname . '_regular_post_thumbnail_position' => array(
		'title' 		=> 'Thumbnail Position in Regular Posts',
		'category'		=> 'Post List',
		'std'			=> 'at_the_left_under_post_title',
		'description'	=> '',
		'valueset'		=> 'REGULAR_POST_THUMBNAIL_POSITION',
	),
	
	$shortname . '_show_excerpts_on' => array(
		'title' 		=> 'Show excerpts on',
		'category'		=> 'Post List',
		'std'			=> array(
			'index' =>'on',
			'category' =>'on',
			'tag' =>'on',
			'archive' =>'on',
			'search' =>'on',
			'author' =>'on',
		),
		'description'	=> '',
		'width' => 450,
		'column_width' => 150,
		'valueset'		=> 'PAGE_TYPES',
	),	
	
	
	$shortname . '_excerpt_length' => array(
		'title' 		=> 'Excerpts Length',
		'category'		=> 'Post List',
		'std'			=> '55',
		'after'			=>'words',
		'description'	=> 'Excerpts Length',
		'valueset'		=> 'NUMBER',
		'width'			=> '3',
	),
	$shortname . '_excerpt_more_link' => array(
		'title' 		=> 'Show "More" link for excerpts',
		'category'		=> 'Post List',
		'std'			=> array('show'=>'no', 'text'=>'more'),
		'description'	=> 'This option defines whether show "more" link or not when showing post excerps',
		'valueset'		=> array('show'=>'YES_NO','text'=>'TEXT'),
		'before'		=> array('show'=>__('Show'),'text'=>__('Link Text',THEME_DOMAIN)),
	),
	$shortname . '_show_content_if_no_excerpt' => array(
		'title' 		=> 'Show Content if no excerpt was provided',
		'category'		=> 'Post List',
		'std'			=> 'no',
		'description'	=> 'The option defines what to display if <b>Show Post Excerpts</b> is set to "Yes" but no excerpt is provided for a post:<br/>'
							.'- if "No": generate excerpt from the post content. If a thumbnail is set for the post, it will be displayed;<br/>'
							.'- if "Yes": show content of the post. You can use &lt;!--more--&gt; tag to shorten oputput.<br/><br/>'
							.'Please note that <b>columnar posts are always displayed as excerpts</b> regardless of the option value.<br/>',
		'valueset'		=> 'YES_NO',
	),
	$shortname . '_show_column_post_info' => array(
		'title' 		=> 'Show Post Info in Columns',
		'category'		=> 'Post List',
		'std'			=> 'yes',
		'description'	=> '',
		'valueset'		=> 'YES_NO',
	),	
	$shortname . '_social_buttons_theme' => array(
		'title' 		=> 'Social Buttons Theme',
		'category'		=> 'Social',
		'std'			=> 'grey',
		'description'	=> '',
		'valueset'		=> 'SOCIAL_THEME',
	),		
	$shortname . '_sharing_buttons_on_blue_sidebar' => array(
		'title' 		=> 'Sharing Buttons on Blue Sidebar',
		'category'		=> 'Social',
		'std'			=> array('show'=>'yes', 'services'=>array(
			'delicious' =>'on',
			'digg' =>'off',
			'facebook' =>'on',
			'stumbleupon' =>'on',
			'reddit' =>'off',
			'twitter' =>'on',
		)),
		'description'	=> '',
		'width' => array ('services'=>450),
		'before' => array('show'=>__('Show')),
		'column_width' => array('services'=>150),
		'valueset'		=> array('show'=>'YES_NO', 'services'=>'SOCIAL'),
	),	
	$shortname . '_sharing_buttons_on_orange_sidebar' => array(
		'title' 		=> 'Sharing Buttons on Orange Sidebar',
		'category'		=> 'Social',
		'std'			=> array('show'=>'yes', 'services'=>array(
			'delicious' =>'on',
			'digg' =>'on',
			'facebook' =>'on',
			'stumbleupon' =>'on',
			'reddit' =>'on',
			'twitter' =>'on',
		)),
		'description'	=> '',
		'width' => array ('services'=>450),
		'before' => array('show'=>__('Show')),
		'column_width' => array('services'=>150),
		'valueset'		=> array('show'=>'YES_NO', 'services'=>'SOCIAL'),
	),
	
	$shortname . '_sharing_buttons_on_green_sidebar' => array(
		'title' 		=> 'Sharing Buttons on Green Sidebar',
		'category'		=> 'Social',
		'std'			=> array('show'=>'yes', 'services'=>array(
			'delicious' =>'on',
			'digg' =>'off',
			'facebook' =>'on',
			'stumbleupon' =>'off',
			'reddit' =>'off',
			'twitter' =>'on',
		)),
		'description'	=> '',
		'width' => array ('services'=>450),
		'before' => array('show'=>__('Show')),
		'column_width' => array('services'=>150),
		'valueset'		=> array('show'=>'YES_NO', 'services'=>'SOCIAL'),
	),	
	$shortname . '_show_rss_button_at_top' => array(
		'title' 		=> 'Show RSS Button at top of the page',
		'category'		=> 'Social',
		'std'			=> 'yes',
		'description'	=> '',
		'valueset'		=> 'YES_NO',
	),
	
);
foreach ($vtm_clr_admin_options as $k=>$v)
{
	$vtm_clr_admin_options[$k]['id'] = $k;
}
