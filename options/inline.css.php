<?php
//header('Content-type: text/css');

$options = & ClearLineOptions::getOptions();
$shortname = & ClearLineOptions::cfg('shortname');
$layout = ClearLineOptions::getLayoutCSS();
$sidebars = & ClearLineOptions::getValueSets('SIDEBARS');
if (isset($sidebars ['values'][$layout])) include (TEMPLATEPATH . '/layouts/'.  $layout.'.css');

function getInherited($option_name, $sub_option_key)
{
	static $shortname = '';
	if (! $shortname) $shortname = ClearLineOptions::cfg('shortname');
	$inherided = ClearLineOptions::getInheritedOption($shortname . $option_name,$sub_option_key);
	return $inherided['value'];
}
function echoInherited($option_name, $sub_option_key)
{
	static $shortname = '';
	if (! $shortname) $shortname = ClearLineOptions::cfg('shortname');
	$inherided = ClearLineOptions::getInherited($shortname . $option_name,$sub_option_key);
	echo $inherided;
}
?>

body {
	font-size:<?php echo $options[$shortname . '_text_font_size']. $options[$shortname . '_text_font_uom']?>;
	font-family:<?php echo $options[$shortname . '_text_font_family'] ?>;
	font-weight:<?php echo $options[$shortname . '_text_font_weight'] ?>;
	color:<?php echo $options[$shortname . '_text_color'] ?>;
	background-color:<?php echo $options[$shortname . '_body_background_color'] ?>;
}

/* LAYOUT */
#container {
	margin: 0 auto;
	width: <?php echo $options[$shortname . '_page_width_value'].$options[$shortname . '_page_width_uom'] ?>;
	min-width:600px;
	<?php if ($options[$shortname . '_content_background_transparent'] =='no'):?>
	background-color:<?php echo $options[$shortname . '_content_background_color'] ?>;
	<?php endif;?>
}
#wrapper
{
	<?php if ($options[$shortname . '_content_background_transparent'] =='no'):?>
	background-color:<?php echo $options[$shortname . '_content_background_color'] ?>;
	<?php endif;?>
	padding-top:10px;
}
#content
{
	padding:0 15px 10px 15px;
}

.sidebar .column
{
	<?php
		if ($options[$shortname . '_h1_font_uom'] == $options[$shortname . '_sidebar_headings_font_uom'])
		{
			echo 'margin:'.($options[$shortname . '_h1_font_size'] - $options[$shortname . '_sidebar_headings_font_size']+5)
				 . $options[$shortname . '_sidebar_headings_font_uom'].'  0 10px 0;';
		} else echo 'margin:18px  0 10px 0;';
	?>
}

.sidebar > :first-child h5
{
	margin-top:0;
}
#outer-footer
{
	padding-top: 10px
}
#footer
{
	border-bottom: 4px solid <?php echo $options[$shortname . '_base_color'] ?>;
	border-top: 2px solid <?php echo $options[$shortname . '_base_color'] ?>;
	background-color: <?php echoInherited('_footer_background_color','') ?>;
}

#header
{
	color: <?php echo $options[$shortname . '_base_color'] ?>;
	font-family:<?php echo $options[$shortname . '_header_font_family'] ?>;
	<?php if ($options[$shortname . '_header_background_transparent'] =='no'):?>
	background-color:<?php echo $options[$shortname . '_header_background_color'] ?>;
	<?php endif;?>
	margin: 0;
	padding: 0;
	margin: 0;
}
#masthead
{
	margin: 0px 0px 0px 10px;
	padding-left:<?php echo $options[$shortname . '_header_left_paddig'] ?>px;
	<?php if ($options[$shortname . '_header_image_size_fit_height'] =='yes'):?>
		height: <?php echo $options[$shortname . '_header_image_size_y']; ?>px;
	<?php endif;?>
}
#header h1, #header h3
{
	font-size:<?php echo $options[$shortname . '_header_font_size']. $options[$shortname . '_header_font_uom']?>;
	margin:0;
	font-weight:<?php echo $options[$shortname . '_header_font_weight'] ?>;
	letter-spacing: -2px;
	padding:10px 0 0 0;
}
#header a.blankheader
{
	display:block;
	height: <?php echo $options[$shortname . '_header_font_size']. $options[$shortname . '_header_font_uom']?>;
	width:300px;
}
#header a
{
	text-decoration:none;
	color: <?php echo $options[$shortname . '_base_color'] ?>;
	border-bottom:none;
}
#header .description
{
	font-family:<?php echo $options[$shortname . '_header_description_font_family'] ?>;
	font-size:<?php echo $options[$shortname . '_header_description_font_size']. $options[$shortname . '_header_description_font_uom']?>;
	font-weight:<?php echo $options[$shortname . '_header_description_font_weight'] ?>;
	font-style:italic;
	margin-top: -0.25em;
	padding-bottom: 5px;
}

#header a.subscribe-button 
{ 
	display:block;
	float:right;
	margin-top:-20px;
}
#header a.subscribe-button:hover
{ 
	margin-top:-10px;
}
/* NAVIGATION */
/* =Menu
-------------------------------------------------------------- */

#access {
	/*background: #000;*/
	margin: 0 auto;
	width: 100%;
	display:block;
	float:left;
	/*padding: 1px 0 1px 8px;*/
	border-top: <?php echo $options[$shortname . '_top_menu_borders_top_width'] ?>px <?php echo $options[$shortname . '_top_menu_borders_top_style'] ?> <?php echoInherited('_top_menu_borders','top_color'); ?>;
	border-bottom: <?php echo $options[$shortname . '_top_menu_borders_bottom_width'] ?>px <?php echo $options[$shortname . '_top_menu_borders_bottom_style'] ?> <?php echoInherited('_top_menu_borders','bottom_color'); ?>;
	background-color: <?php echo $options[$shortname . '_top_menu_background_color'] ?>;
}
#access .menu-header,
div.menu {
	font-size: 13px;
	margin-left: 12px;
}
#access .menu-header ul,
div.menu ul {
	list-style: none;
	margin: 0;
}
#access .menu-header li,
div.menu li {
	float:left;
	position: relative;
	margin: 0;
}
#access a {
	display:block;
	text-decoration:none;
	padding:0 10px;
	line-height:<?php echo $options[$shortname . '_top_menu_height'] ?>px;
	color: <?php echo $options[$shortname . '_top_menu_text_color_regular'] ?>; 
	font-family:<?php echo $options[$shortname . '_top_menu_font_family'] ?>;
	font-size:<?php echo $options[$shortname . '_top_menu_font_size']. $options[$shortname . '_top_menu_font_uom']?>;
	font-weight:<?php echo $options[$shortname . '_top_menu_font_weight'] ?>;

	
}
#access ul ul {
	display:none;
	position:absolute;
	top:<?php echo $options[$shortname . '_top_menu_height'] ?>px;
	left:0;
	float:left;
	z-index: 99999;
	border-left:  1px <?php echo $options[$shortname . '_top_menu_borders_bottom_style'] ?> <?php echoInherited('_top_menu_borders','bottom_color'); ?>;
	border-right: 1px <?php echo $options[$shortname . '_top_menu_borders_bottom_style'] ?> <?php echoInherited('_top_menu_borders','bottom_color'); ?>;
	border-bottom:1px <?php echo $options[$shortname . '_top_menu_borders_bottom_style'] ?> <?php echoInherited('_top_menu_borders','bottom_color'); ?>;
	background-color: <?php echo $options[$shortname . '_top_menu_background_color'] ?>;
}
#access ul ul ul {
	left:100%;
	top:1px;
	border-top:1px <?php echo $options[$shortname . '_top_menu_borders_bottom_style'] ?> <?php echoInherited('_top_menu_borders','bottom_color'); ?>;
	
}
#access ul ul a
{
	font-family:<?php echo $options[$shortname . '_top_submenu_font_family'] ?>;
	font-size:<?php echo $options[$shortname . '_top_submenu_font_size']. $options[$shortname . '_top_submenu_font_uom']?>;
	font-weight:<?php echo $options[$shortname . '_top_submenu_font_weight'] ?>;
}
#access ul ul a {
	/*background:#333;*/
	height:auto;
	line-height:1em;
	padding:10px;
	width: <?php echo $options[$shortname . '_top_submenu_width'] ?>px;
}
#access li:hover > a,
#access ul ul :hover > a {
	color:<?php echo $options[$shortname . '_top_menu_text_color_hover'] ?>;
	/*background:#333;*/
	
}
#access ul li:hover > ul {
	display:block;
}

/*
menu-item menu-item-type-post_type current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor
menu-item menu-item-type-post_type current-menu-item page_item page-item-155 current_page_item
*/

#access .current-menu-item,
#access .current_page,
#access .current_page_item,
#access .current_page_item a,
#access .current-menu-ancestor,
#access .current_page_ancestor
{
	color: <?php echo $options[$shortname . '_top_menu_current_item_color_text'] ?>;
	background-color: <?php echo $options[$shortname . '_top_menu_current_item_color_background'] ?>;
}

div.post-list-column
{
	float:left;
	width:<?php echo  (($options[$shortname.'_post_list_column_count'])? round(100/ $options[$shortname.'_post_list_column_count']):'100')?>%;
}
div.post-list-column .margins
{
	padding: 0 10px 15px 10px;
}
.post-list-column .storycontent,
.post-list-column .content
{
	padding:0 0 0 4px;
}
<?php
if ($options[$shortname.'_thumbnail_show_border']=='yes'):?>
	.post-thumbnail,
	.regular-post-thumbnail
	{
		border: 1px solid <?php echo $options[$shortname . '_dividers_color']?>;
		padding:3px;
	}

<?php else:?>
	.post-thumbnail,
	.regular-post-thumbnail
	{
		border: none;
	}
<?php endif;?>
.regular-post-thumbnail
{
	float:left;
	width: <?php echo ($options[$shortname . '_normal_thumbnail_size_x']); ?>px;
	margin:<?php echo(($options[$shortname.'_thumbnail_show_border']=='yes')? 18:15);?>px 5px 10px 10px;
}
.wp-post-image
{
	max-width:100%;
	border: none;
}

div.post-list-column .wp-post-image
{
	display:block;
}

#postpath, #postpath a
{
	font-family:<?php echo $options[$shortname . '_breadcrumbs_font_family'] ?>;
	font-size:<?php echo $options[$shortname . '_breadcrumbs_font_size']. $options[$shortname . '_breadcrumbs_font_uom']?>;
	font-weight:<?php echo $options[$shortname . '_breadcrumbs_font_weight'] ?>;
	color:<?php echo $options[$shortname . '_breadcrumbs_color'] ?>;
}

/* LINKS */

a {
	color:<?php echo $options[$shortname . '_post_link_regular_color'] ?>;
	text-decoration:<?php echo $options[$shortname . '_post_link_regular_decoration'] ?>;
}
.post a:visited
{
	color: <?php echo $options[$shortname . '_post_link_visited_color'] ?>;
	text-decoration:<?php echo $options[$shortname . '_post_link_visited_decoration'] ?>;
}
.post a:hover
{
	color: <?php echo $options[$shortname . '_post_link_hover_color'] ?>;
	text-decoration:<?php echo $options[$shortname . '_post_link_hover_decoration'] ?>;
}
.post h1 a:hover, 
.post h2 a:hover
{
	border-bottom:none;
	text-decoration:none;
}

/*
	HEADINGS
*/

h1,h2,h3, h4, h5, h6
{
	color: <?php echo $options[$shortname . '_h1_color'] ?>;
	margin-top:5px;
	font-family:<?php echo $options[$shortname . '_h1_font_family'] ?>;
	font-weight: normal;
}
h1, h2.h1
{
	font-size:<?php echo $options[$shortname . '_h1_font_size']. $options[$shortname . '_h1_font_uom']?>;
	font-weight: <?php echo $options[$shortname . '_h1_font_weight'] ?>;
	margin:0px 0 3px 0;
	padding:10px 0 0 5px;
	color: <?php echo $options[$shortname . '_h1_color'] ?>;
	overflow:hidden;
}
.post-list-column h2
{
	font-size: 24px;
	font-weight: normal;
	margin:0px 0 0px 0;
	padding:3px 0 0px 4px;
	color: <?php echoInherited('_h2_color','')?>;
}
h2
{
	/*font-size:24px;*/
	margin:5px 0 2px 0;
	color: <?php echoInherited('_h2_color','')?>;
	font-size:<?php echo $options[$shortname . '_h2_font_size']. $options[$shortname . '_h2_font_uom']?>;
	font-weight: <?php echo $options[$shortname . '_h2_font_weight'] ?>;
	font-family:<?php echoInherited('_h2_font','family'); ?>;
}
h3
{
	margin:5px 0 0px 0;
	font-size:<?php echo $options[$shortname . '_h3_font_size']. $options[$shortname . '_h3_font_uom']?>;
	font-weight: <?php echo $options[$shortname . '_h3_font_weight'] ?>;
	font-family:<?php echoInherited('_h3_font','family'); ?>;
}
.post h3
{
	color: <?php echoInherited('_h3_color','')?>;
}
h4
{
	font-size:<?php echo $options[$shortname . '_h4_font_size']. $options[$shortname . '_h4_font_uom']?>;
	font-weight: <?php echo $options[$shortname . '_h4_font_weight'] ?>;
	font-family:<?php echoInherited('_h4_font','family'); ?>;
}
h1 a, h2.h1 a,
h1 a:visited, h2.h1 a:visited,
.post h1 a, .post h2.h1 a,
.post h1 a:visited, .post h2.h1 a:visited,
.post-list-column h2 a, .post-list-column h2 a:visited
{
	color: <?php echo $options[$shortname . '_h1_color'] ?>;
	border-bottom: none;
	text-decoration:none;
}
h1 a:hover,
h2.h1 a:hover,
h1 a:visited:hover, h2.h1 a:visited:hover,
.post h1 a:hover,
.post h2.h1 a:hover,
.post h1 a:visited:hover, .post h2.h1 a:visited:hover,
.post-list-column h2 a:hover, .post-list-column h2 a:visited:hover
{
	color: <?php echo $options[$shortname . '_h1_hover_color'] ?>;
	border-bottom: none;
	text-decoration:none;
}
h1.page-title
{
	font-size:18px;
}
h1.page-title span
{
	color: <?php echo $options[$shortname . '_base_color'] ?>;
}
/*
	POST
*/
div.post
{
	overflow:hidden;
}
table.info {
	padding:0;
	margin:0;
	border-collapse:collapse;
}
table.info td, 
table.info th {
	padding:0;
	margin:0;
	font-weight:normal;
}
pre {
	border:1px dotted <?php echo $options[$shortname . '_pre_color_border'] ?>;;
	margin:5px 0;
	padding:10px 10px 10px 20px;
	background-color:<?php echo $options[$shortname . '_pre_color_background'] ?>;
}
blockquote{
	/*background:#f2f2f2 url(img/blockquote.gif) 3px 3px no-repeat;*/
	border:1px dotted <?php echo $options[$shortname . '_blockquote_color_border'] ?>;
	padding:10px 10px 10px 20px;
	margin:5px 0 5px 20px;
	background-color:<?php echo $options[$shortname . '_blockquote_color_background'] ?>;
}
code
{
	background-color:<?php echo $options[$shortname . '_blockquote_color_background'] ?>;
	font-family: Courier New, Courier, monospace;
	border:1px dotted <?php echo $options[$shortname . '_blockquote_color_border'] ?>;
}
.post .storycontent,
.post .content {
	padding:5px 10px 5px 10px;
	overflow:hidden;
	line-height: 1.5;
}

.post .info {
	padding:3px 0px 3px 0px;
	margin: 2px 0 2px 0;
	border-top: 1px solid <?php echo $options[$shortname . '_dividers_color'] ?>;
}

.post .date {
	background-position:0 -48px;
	color: #707070;
	padding:0 0px;
}
.post .info  .postedby,
.post .info  .filledunder
{
	color: #bbb;
}
.post .info  .postedby  a,
.post .info  .filledunder a
{
	color: #707070;
	text-decoration:none;
}
.post .info  .postedby a:hover,
.post .info  .filledunder a:hover
{
	color: <?php echo $options[$shortname . '_h1_hover_color'] ?>;
	text-decoration:none;
}
.post .info td
{
	border: none;
	padding: 0 5px;
}
.post table.info
{
	width:100%;
}
.post .info .act
{
	white-space: nowrap;
	text-align:right;
}
.post table.info .date
{
	width:1%;
	white-space: nowrap;
}
.post .act span {
	padding-left:15px;
}
.post .info *
{
	font-family: <?php echo $options[$shortname . '_text_font_family'] ?>;
	line-height:16px;
	font-size:10px;
	overflow:hidden;
}
hr
{
	border: 0px none;
	background-color: <?php echo $options[$shortname . '_dividers_color'] ?>;
	color: <?php echo $options[$shortname . '_dividers_color'] ?>;
	height:2px;
}
fieldset{
	border: 1px solid <?php echo $options[$shortname . '_dividers_color'] ?>;
	padding:5px 10px 5px 10px;
}
legend
{
	padding: 0px 5px 1px 5px;
	border: 1px solid <?php echo $options[$shortname . '_dividers_color'] ?>;
}
input.text, input.textbox, input.password, input.file, textarea,
input[type=text], input[type=password],input[type=file],
select
{
	border:1px solid #bbbbbb;
	background-color:<?php echo $options[$shortname . '_content_background_color'] ?>;
	padding:2px;
	color: <?php echo $options[$shortname . '_text_color'] ?>;

}
input.text:focus, input.textbox:focus, input.password:focus, input.file:focus, textarea:focus,
input[type=text]:focus, input[type=password]:focus,input[type=file]:focus,
select
{
	border:1px solid #505050;
}

.post table {
	border-collapse:collapse;
	border: none;
}
.post  th, .post  td {
	border-bottom:1px solid <?php echo $options[$shortname . '_dividers_color'] ?>;
	border-left:none;
	border-right:none;
	padding:2px 10px;
	text-align:left;
	vertical-align:top;

	font-size: <?php echo $options[$shortname . '_table_font_size'] ?><?php echo $options[$shortname . '_table_font_uom'] ?>; 
	font-weight: <?php echo $options[$shortname . '_table_font_weight'] ?>;
	font-family: <?php echoInherited('_table_font','family'); ?>;
	
}
.post tr.even td
{
	background-color: <?php echo $options[$shortname . '_top_menu_background_color'] ?>;
}
.post th 
{
	background-color: <?php echo $options[$shortname . '_top_menu_background_color'] ?>;
	border-bottom: 1px solid <?php echo $options[$shortname . '_base_color'] ?>;
	border-top: 2px solid <?php echo $options[$shortname . '_base_color'] ?>;
	color: <?php echo $options[$shortname . '_top_menu_text_color_regular'] ?>;
}
#author-avatar
{
	float:left;
	width: 100px;
	margin:7px 15px 7px 10px;
}

/* comment START */
/*
	COMMENTS
*/
#comments > ol {list-style-type: none;line-height: 18px;margin: 0px;padding: 0px 0px 10px 10px; text-align: justify;}
#comments ul li {list-style-type: none;list-style-image: none;list-style-position: outside;margin: 0 0 0 5px; padding: 5px 0 0 0;}
.commentlist li {margin: 15px 0 10px;padding: 2px 2px 5px 2px;list-style: none;}
.commentlist li > ul > li {background:none;list-style:none;margin:3px 0 3px 20px;padding:3px 0;}
.commentlist li .avatar {border:none; margin:0;padding:1px 8px 1px 1px; width: <?php echo $options[$shortname.'_comments_avatar_size']?>px;float:left; background:none;}
.commentlist .fn
{
	font-size: <?php echo $options[$shortname . '_commentator_font_size'] ?><?php echo $options[$shortname . '_commentator_font_uom'] ?>; 
	font-weight: <?php echo $options[$shortname . '_commentator_font_weight'] ?>;
	font-style: normal;
	padding:4px 2px 2px 2px; 
	font-family: <?php echo $options[$shortname . '_commentator_font_family'] ?>;
}
.commentlist .fn > a 
{
	font-weight:<?php echo $options[$shortname . '_commentator_font_weight'] ?>;
	font-style: normal;
	text-decoration:none;
}
.commentlist .fn a:hover {/*text-decoration:underline;*/}
.commentmetadata 
{
	/*color:#723419;*/
	font-weight: normal; 
	font-family: <?php echo $options[$shortname . '_comments_metadata_font_family'] ?>;
	font-size:<?php echo $options[$shortname . '_comments_metadata_font_size'] ?><?php echo $options[$shortname . '_comments_metadata_font_uom'] ?>; 
	margin:0 0 0px 20px;
	text-decoration: none;
}

.commentmetadata a 
{
	font-weight: normal;
	text-decoration: none;
	color: <?php echo $options[$shortname . '_comment_metadata_color'] ?>;
}


.vcard a.url{
	color: <?php echoInherited('_commentator_link_color','regular');?>; /*#723419;*/
	text-decoration: none;
}
.vcard a.url:hover{
	color: <?php echoInherited('_commentator_link_color','hover');?>; /*#723419;*/
	text-decoration: none;
}

.bypostauthor >.vcard div.fn >a
{
	color:<?php echoInherited('_post_author_link_color','regular');?>;
}
.bypostauthor >.vcard div.fn >a:hover
{
	color:<?php echoInherited('_post_author_link_color','hover');?>;
}
.bypostauthor>div
{
	color:<?php echoInherited('_post_author_comment_color','');?>;
}
/* 
	Uncomment following text to assign specific color to admin (or to any other user)
	You may need to change user name here
	E.g.  comment-author-MyUserName instead of  comment-author-admin
*/
/*
.comment-author-admin>*,
.comment-author-admin >.vcard div.fn >a
{
	color:#106000;
}*/
.comment
{
	color:<?php echo $options[$shortname . '_text_color'] ?>;
}
.commentmetadata a, .commentmetadata a:visited {color: #707070;}
.commentmetadata a:hover{ color: #000000;}
#comments .children { padding: 0 0 0 20px; }
.thread-alt {background-color:transparent}
.thread-even {background-color: transparent;}
.depth-1 
{
	border: <?php echo(($options[$shortname . '_comment_border_show']=='yes')?'1px solid '. getInherited('_comment_border','color'):'none'); ?>;
}
.depth-2, .depth-3{/*border-top: 1px solid #dac2a3;*/}
.even, .alt {}
.vcard {
	<?php echo (($options[$shortname . '_comment_author_background_use']=='yes')?'background-color:'.getInherited('_comment_author_background','color'):'').';'; ?>
}
.depth-2 .vcard,
.depth-3 .vcard,
.depth-4 .vcard,
.depth-5 .vcard,
.depth-6 .vcard,
.depth-7 .vcard,
.depth-8 .vcard
{
	border-top: <?php echo '1px dotted '. getInherited('_comment_border','color'); ?>;
	border-bottom: <?php echo '1px dotted '. getInherited('_comment_border','color'); ?>;
}
.reply {margin: 0px 0px 0px 10px;}
.comment-reply-link {
	<?php echo (($options[$shortname . '_comment_reply_background_use']=='yes')?'background-color:'.getInherited('_comment_reply_background','color'):'').';' ?>
	color: <?php echoInherited('_comment_reply_link_color','regular')?>;
	padding: 1px 4px;
	font-size:12px;
	text-decoration: none;
	border: 1px <?php echo $options[$shortname . '_comment_reply_border_style']?> <?php echoInherited('_comment_reply_border','color')?>;
}
.comment-reply-link:hover {
	color: <?php echoInherited('_comment_reply_link_color','hover')?>;
	text-decoration: none;
}


#comments .comment-body ul li
{
	list-style:square;
	margin: 0 0 0 30px;
	padding:0;
}
#comments .comment-body ol 
{
	margin: 0;
	padding: 0;
}
#comments .comment-body ol li
{
	list-style-type:decimal;
	padding:0;
	margin: 0 0 0 30px;
	display: list-item;
}
.comment-body
{
	padding:2px 2px 2px 10px;
}

/************************** IMAGES *************************************/

.post img.wp-caption,
.wp-caption,
.gallery-caption {
	-moz-border-radius: <?php echo $options[$shortname . '_image_border_radius']?><?php echo $options[$shortname . '_image_border_uom']?>; /* Firefox */
	-webkit-border-radius: <?php echo $options[$shortname . '_image_border_radius']?><?php echo $options[$shortname . '_image_border_uom']?>; /* Safari, Chrome */
	-khtml-border-radius: <?php echo $options[$shortname . '_image_border_radius']?><?php echo $options[$shortname . '_image_border_uom']?>; /* KHTML */
	border-radius: <?php echo $options[$shortname . '_image_border_radius']?><?php echo $options[$shortname . '_image_border_uom']?>; /* CSS3 */
  
	border:1px solid <?php echoInherited('_image_border','color')?>;
	display:block;
	height:auto;
	margin-bottom:10px;
	padding-top:4px;
	text-align:center;
	max-width:100%;
}
.regular-post-thumbnail img.attachment-post-thumbnail
{
	display:block;
	margin: auto;
}
.post img.wp-caption{
	padding:4px;
}
.post .wp-caption img,
.wp-caption img {
	border:0 none !important;
	margin:0 !important;
	padding:0 !important;
	max-width:99.5%;
}
.post img {
	border:none;
	padding:0px;
	vertical-align:bottom;
	height:auto;
	max-width:100%;
}
a.wp-caption {
	color: <?php echoInherited('_image_caption_text_color','')?>;
	text-decoration:none;
}
a.wp-caption p,a.wp-caption:hover p,
.wp-caption p.wp-caption-text,
.full-image-caption {
	color:<?php echoInherited('_image_caption_text_color','')?>;
	font-size:11px;
	font-family:<?php echoInherited('_image_caption_font','family')?>;
	line-height:<?php echoInherited('_image_caption_font','size')?><?php echoInherited('_image_caption_font','uom')?>;
	margin:0;
	padding:2px 4px 4px;
}
a.wp-caption:hover
{
	border:1px solid /*#dac2a3;*/#777777;
	background-color:#f2f2f2;
}


/******************************************************************************************
	SIDEBAR
*******************************************************************************************/
#sidebar .subscribe-rss
{
	padding:10px 0 0px 42px;
	height:30px;
	display:block;
	font-size:20px;
	font-family:Verdana,Geneva,sans-serif;
	margin:0 0 10px 0;
}

#sidebar a.subscribe-rss:hover
{
	color:#000000;
	text-decoration:none;
}
.sidebar
{
	font-family:<?php echoInherited('_sidebar_font','family') ?>;
	font-size:<?php echo $options[$shortname . '_sidebar_font_size'] ?><?php echo $options[$shortname . '_sidebar_font_uom'] ?>;
}

.widget
{
	margin-bottom:10px;
	line-height:1.5;
	overflow:hidden;
}
.textwidget
{
	padding:10px 5px 10px 5px;
	border-bottom: 1px dotted <?php echo $options[$shortname . '_dividers_color'] ?>;
	line-height:1.5;
}
.sidebar h5
{
	font-size:<?php echo $options[$shortname . '_sidebar_headings_font_size'] ?><?php echo $options[$shortname . '_sidebar_headings_font_uom'] ?>;
	font-family: <?php echoInherited('_sidebar_headings_font','family') ?>;
	font-weight:<?php echo $options[$shortname . '_sidebar_headings_font_weight'] ?>;
	border-bottom: 2px solid <?php echo $options[$shortname . '_dividers_color'] ?>;
	padding: 5px 5px 10px 10px;
}
.sidebar a
{
	color: <?php echo $options[$shortname . '_sidebar_link_color_regular'] ?>;/*#64ae42;*/
	font-size:<?php echo $options[$shortname . '_sidebar_font_size'] ?><?php echo $options[$shortname . '_sidebar_font_uom'] ?>;
	text-decoration:none;
}
.sidebar .widget_text a,
.sidebar .widget_text a:hover
{
	text-decoration:underline;
}
.sidebar a:hover
{
	color: <?php echo $options[$shortname . '_sidebar_link_color_hover'] ?>;
	text-decoration:none;
}
.sidebar li
{
	list-style:none;
	margin:0;
	padding: 7px 5px;
}
.sidebar .widget>ul>li,
.sidebar ul.menu>li
{
	border-bottom: 1px dotted <?php echo $options[$shortname . '_dividers_color'] ?>;
}
.sidebar .widget>ul>li>.children,
.sidebar .widget .sub-menu
{
	padding-top:7px;
}
.sidebar li>ul li
{
	padding: 7px 5px 7px 10px;
}
.sidebar li a
{
	/*display: block;*/
}
.sidebar .blogroll li
{
	color:  <?php echo $options[$shortname . '_blogroll_link_description_color'] ?>;
	font-size: 11px;
}
#wp-calendar table {
	border-collapse:collapse;
	border:0px solid <?php echo $options[$shortname . '_dividers_color'] ?>;
}
#wp-calendar th, 
#wp-calendar  td 
{
	border:none;
	padding:0px 4px;
	vertical-align:top;
	font-family: <?php echoInherited('_calendar_widget_font','family') ?>;
	font-size:90%;
}
#wp-calendar td {
	text-align:right;
}
#wp-calendar th 
{
	background-color: <?php echo $options[$shortname . '_calendar_th_color_background'] ?>;
	color:<?php echoInherited('_calendar_th_color','text') ?>;
	text-align:center;
	padding: 1px 4px 1px 4px;
}
#wp-calendar caption
{
	font-family: <?php echoInherited('_calendar_widget_font','family') ?>;
	font-weight:bold;
	/*color:#777777;*/
	padding:10px 0 2px 0;
}

#wp-calendar td#prev
{
	text-align:left;
}
#wp-calendar td#next
{
	text-align:right;
}
#wp-calendar #today
 /*TODO!*/
{
	border: 1px <?php echo $options[$shortname . '_calendar_today_border_style'] ?> <?php echo $options[$shortname . '_calendar_today_border_color'] ?>;
	background-color: <?php echoInherited('_calendar_today','background') ?>;
}

/*Search widget*/

#searchform label 
{
	display:block;
}
#s
{
	width:110px;
}
#searchsubmit,
.button,
input#submit
{
	border:1px solid #505050;
	color:#ffffff;
	font-weight:bold;
	font-family:Trebucht MS, Arial;
	text-shadow:0 -1px 0 rgba(0, 0, 0, 0.3);
	cursor: pointer;
	padding:1px 5px 1px 5px;
	background: #555555; 
	/* for non-css3 browsers */
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#bbbbbb', endColorstr='#000000'); /* for IE */
	background: -webkit-gradient(linear, left top, left bottom, from(#bbbbbb), to(#000000)); /* for webkit browsers */
	background: -moz-linear-gradient(top,  #bbbbbb,  #000000); /* for firefox 3.6+ */
}
#searchsubmit:hover,
.button:hover
{
	border:1px solid #000000;
}

#searchsubmit:active,
.button:active {
	cursor: pointer;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#505050', endColorstr='#777777'); /* for IE */
	background: -webkit-gradient(linear, left top, left bottom, from(#505050), to(#777777)); /* for webkit browsers */
	background: -moz-linear-gradient(top,  #505050,  #777777); /* for firefox 3.6+ */
}
/*
	PAGINATION
*/

#comments a.page-numbers,
#comments span.page-numbers
{
	text-decoration: none;
	border: 1px <?php echo $options[$shortname . '_pagination_page_box_border_style'] ?> <?php echo $options[$shortname . '_pagination_page_box_border_color'] ?>;
	padding: 2px 5px;
	margin: 2px;
	color: <?php echo $options[$shortname . '_pagination_page_box_text_color'] ?>;
}

#comments .navigation
{
	margin: 10px 0;
}

#comments .navigation a:hover
{
	border: 1px <?php echo $options[$shortname . '_pagination_page_box_hover_border_style'] ?> <?php echo $options[$shortname . '_pagination_page_box_hover_border_color'] ?>;
	background-color: <?php echo $options[$shortname . '_pagination_page_box_hover_background_color'] ?>;
	color: <?php echo $options[$shortname . '_pagination_page_box_hover_text_color'] ?>;
	text-decoration:none;
}
#comments span.page-numbers
{
	font-weight: bold;
	color: <?php echo $options[$shortname . '_pagination_current_page_box_text_color'] ?>;
	background-color: <?php echo $options[$shortname . '_pagination_current_page_box_background_color'] ?>;
	border: 1px <?php echo $options[$shortname . '_pagination_current_page_box_border_style'] ?> <?php echo $options[$shortname . '_pagination_current_page_box_border_color'] ?>;
}

/*
	WP-PageNavi
	http://wordpress.org/extend/plugins/wp-pagenavi/
*/

.wp-pagenavi {
	clear: both;
}

.wp-pagenavi a, .wp-pagenavi span 
{
	text-decoration: none;
	border: 1px <?php echo $options[$shortname . '_pagination_page_box_border_style'] ?> <?php echo $options[$shortname . '_pagination_page_box_border_color'] ?>;
	padding: 2px 5px;
	margin: 2px;
	color: <?php echo $options[$shortname . '_pagination_page_box_text_color'] ?>;
}

.wp-pagenavi a:hover
{
	border: 1px <?php echo $options[$shortname . '_pagination_page_box_hover_border_style'] ?> <?php echo $options[$shortname . '_pagination_page_box_hover_border_color'] ?>;
	background-color: <?php echo $options[$shortname . '_pagination_page_box_hover_background_color'] ?>;
	color: <?php echo $options[$shortname . '_pagination_page_box_hover_text_color'] ?>;
	text-decoration:none;
}

.wp-pagenavi span.current
{
	font-weight: bold;
	color: <?php echo $options[$shortname . '_pagination_current_page_box_text_color'] ?>;
	background-color: <?php echo $options[$shortname . '_pagination_current_page_box_background_color'] ?>;
	border: 1px <?php echo $options[$shortname . '_pagination_current_page_box_border_style'] ?> <?php echo $options[$shortname . '_pagination_current_page_box_border_color'] ?>;
}
.wp-pagenavi .extend {
	background:transparent; 
	border:0px none transparent; 
	color: <?php echo $options[$shortname . '_pagination_page_box_text_color'] ?>;
	margin-right:6px; 
	padding:0; 
	text-align:center; 
	text-decoration:none;
}

/*	
	used by PAGBEAR plugin for multipaged posts.
	http://wordpress.org/extend/plugins/pagebar/
*/
.pagebar {
	padding:0;
	margin:4px 0;
}

.pagebar a
{
	background:transparent; 
	border: 1px <?php echo $options[$shortname . '_pagination_page_box_border_style'] ?> <?php echo $options[$shortname . '_pagination_page_box_border_color'] ?>;
	color: <?php echo $options[$shortname . '_pagination_page_box_text_color'] ?>;
	margin: 2px; padding:2px 5px; text-align:center; text-decoration:none;
}
.pageList .this-page 
{
	font-weight: bold;
	color: <?php echo $options[$shortname . '_pagination_current_page_box_text_color'] ?>;
	background-color: <?php echo $options[$shortname . '_pagination_current_page_box_background_color'] ?>;
	border: 1px <?php echo $options[$shortname . '_pagination_current_page_box_border_style'] ?> <?php echo $options[$shortname . '_pagination_current_page_box_border_color'] ?>;
	margin: 2px; padding:2px 5px; text-align:center; text-decoration:none;
}
.pagebar a:visited {
	color: <?php echo $options[$shortname . '_pagination_page_box_text_color'] ?>;
	text-decoration:none;
}

.pagebar .break {
	background:transparent; 
	border:0px none transparent; 
	color: <?php echo $options[$shortname . '_pagination_page_box_text_color'] ?>;
	margin-right:6px; 
	padding:0; 
	text-align:center; 
	text-decoration:none;
}

.pagebar .this-page {
	font-weight: bold;
	color: <?php echo $options[$shortname . '_pagination_current_page_box_text_color'] ?>;
	background-color: <?php echo $options[$shortname . '_pagination_current_page_box_background_color'] ?>;
	border: 1px <?php echo $options[$shortname . '_pagination_current_page_box_border_style'] ?> <?php echo $options[$shortname . '_pagination_current_page_box_border_color'] ?>;
	margin: 2px; padding:2px 5px; text-align:center; text-decoration:none;
}

.pagebar a:hover {
	border: 1px <?php echo $options[$shortname . '_pagination_page_box_hover_border_style'] ?> <?php echo $options[$shortname . '_pagination_page_box_hover_border_color'] ?>;
	background-color: <?php echo $options[$shortname . '_pagination_page_box_hover_background_color'] ?>;
	color: <?php echo $options[$shortname . '_pagination_page_box_hover_text_color'] ?>;
	text-decoration:none;
}

.pagebar .inactive
{
	border: 1px <?php echo $options[$shortname . '_pagination_inactive_button_border_style'] ?> <?php echo $options[$shortname . '_pagination_inactive_button_border_color'] ?>;
	background-color: <?php echo $options[$shortname . '_pagination_inactive_button_background_color'] ?>;
	color: <?php echo $options[$shortname . '_pagination_inactive_button_text_color'] ?>;
	text-decoration: none;
	padding:2px 4px;
}

#postnavi .prev a 
{
	float:left;
}
#postnavi .next a
{
	float:right;
}
#postnavi  a 
{
	background:transparent; 
	border: 1px <?php echo $options[$shortname . '_pagination_page_box_border_style'] ?> <?php echo $options[$shortname . '_pagination_page_box_border_color'] ?>;
	color: <?php echo $options[$shortname . '_pagination_page_box_text_color'] ?>;
	margin: 2px; padding:2px 5px; text-align:center; text-decoration:none;
}
#postnavi a:hover {
	border: 1px <?php echo $options[$shortname . '_pagination_page_box_hover_border_style'] ?> <?php echo $options[$shortname . '_pagination_page_box_hover_border_color'] ?>;
	background-color: <?php echo $options[$shortname . '_pagination_page_box_hover_background_color'] ?>;
	color: <?php echo $options[$shortname . '_pagination_page_box_hover_text_color'] ?>;
	text-decoration:none;
}
/*
	FOOTER
*/

<?php $fw=(( $options[$shortname . '_footer_equal_columns']=='yes')?(100/$options[$shortname . '_footers']).'%':''); ?>

.footer-column 
{
	margin:0;
	padding:10px;
	line-height:1.5;
}

#blue-footer
{
	float:left;
	width: <?php echo(($fw)?$fw:$options[$shortname . '_blue_footer_column_width_value'].$options[$shortname . '_blue_footer_column_width_uom'])?>;
}
#green-footer
{
	float:left;
	width: <?php echo(($fw)?$fw:$options[$shortname . '_green_footer_column_width_value'].$options[$shortname . '_green_footer_column_width_uom'])?>;
}
#orange-footer
{
	float:left;
	width: <?php echo(($fw)?$fw:$options[$shortname . '_orange_footer_column_width_value'].$options[$shortname . '_orange_footer_column_width_uom'])?>;
}
#red-footer
{
	float:left;
	width: <?php echo(($fw)?$fw:$options[$shortname . '_red_footer_column_width_value'].$options[$shortname . '_red_footer_column_width_uom'])?>;
}
#footer h5
{
	font-size:<?php echo $options[$shortname . '_sidebar_headings_font_size'] ?><?php echo $options[$shortname . '_sidebar_headings_font_uom'] ?>;
	font-family: <?php echoInherited('_sidebar_headings_font','family') ?>;
	font-weight:<?php echo $options[$shortname . '_sidebar_headings_font_weight'] ?>;
	border-bottom: 2px solid <?php echo $options[$shortname . '_dividers_color'] ?>;
	padding: 5px 5px 10px 10px;
}
#footer  a
{
	color: <?php echo $options[$shortname . '_sidebar_link_color_regular'] ?>;/*#64ae42;*/
	font-size:<?php echo $options[$shortname . '_sidebar_font_size'] ?><?php echo $options[$shortname . '_sidebar_font_uom'] ?>;
	text-decoration:none;
}
#footer  .widget_text a,
#footer .widget_text a:hover
{
	text-decoration:underline;
}
#footer  a:hover
{
	color: <?php echo $options[$shortname . '_sidebar_link_color_hover'] ?>;
	text-decoration:none;
}
#footer  li
{
	list-style:none;
	margin:0;
	padding: 7px 5px;
}
#footer .widget>ul>li,
#footer  ul.menu>li
{
	border-bottom: 1px dotted <?php echo $options[$shortname . '_dividers_color'] ?>;
}
#footer  .widget>ul>li>.children,
#footer  .widget .sub-menu
{
	padding-top:7px;
}
#footer  li>ul li
{
	padding: 7px 5px 7px 10px;
}
/*#footer li a
{
	display: block;
}*/


