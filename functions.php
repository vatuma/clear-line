<?php 
//error_reporting(E_ALL);
define ('THEME_DOMAIN','clear-line');	//Translation domain
load_theme_textdomain(THEME_DOMAIN, get_template_directory() . '/languages');

//if (function_exists('add_theme_support')) add_theme_support( 'nav-menus' );
if ( function_exists( 'register_nav_menu' ) ) {
	register_nav_menus( array('top_menu'=>'Clear Line Top Navigation Menu'));
}

$clear_line_options =null;
include ('functions-core.php');
include ('options/options.php');

//delete_option('clear_line_options');

/*
	Выдает строку с путем до поста (все родительские категории)
*/
function get_post_path($post_id,$delimiter, $links=true)
{
	$out ='';
	$categories = &get_the_category($post_id);
	
	if (!$categories) return ''; //TODO: проверять на is_attachment и выводить путь до поста.
	
	if (is_array($categories))
	{
		foreach ($categories as $category)
		{
			if ($out) $out .= ', ';
			$out .= (($links)?'<a href="'.get_category_link($category->cat_ID).'">':'').$category->name.(($links)?'</a>':'');
			//echo "out=";var_dump($out); echo "<br>";
		}
		$category_list = get_category_parents($categories[0]->cat_ID, $links, $delimiter);
		if (is_string($category_list))
		{
			//var_dump($category_list);
			$category_list =substr($category_list,0, strrpos($category_list,$delimiter));
			$category_list =substr($category_list,0, strrpos($category_list,$delimiter));
			if ($category_list)
				$out =  $category_list . $delimiter . $out;
		}
	}
	return $out;
}

/* 
	@param $post_id	int
	@param $category int
	определяет, находится ли пост в заданной корневой категории 
*/
function in_root_category($post_id, $root_category_id='')
{
	$categories = &get_the_category($post_id);
	if (is_array($categories))
	{
		foreach ($categories as $category)
		{
			if ($root_category_id == get_root_category($category->cat_ID)) return true;
		}
	}
	return false;
}
/*
	returns category IDs of the post separated by comma
*/
function get_post_categories_list($post_id)
{
	$categories = &get_the_category($post_id);
	$out='';
	foreach ($categories as $category)
	{
		if ($out) $out .= ', ';
		$out .= $category->cat_ID;
	}
	return $out;
}

function get_post_category_names_list($post_id)
{
	$categories = &get_the_category($post_id);
	$out='';
	foreach ($categories as $category)
	{
		if ($out) $out .= ', ';
		$out .= $category->name;
	}
	return $out;
}
function get_post_root_category($post_id)
{
	$categories = &get_the_category($post_id);
	if (is_array($categories))
	{
		foreach ($categories as $category_id)
		{
			return get_root_category($category_id);
		}
	}
	return false;
}

function get_root_category($category_id='')
{
	$category = &get_category( $category_id );

	if ($category->parent)
	{
		$parent_id = get_root_category($category->parent);
		//echo "+"; print_r($parent);
		return $parent_id;
	}
	else
		return $category_id;
}

function post_has_immage($post)
{
	return (bool)preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content);
}

// не проверялась!
function catch_that_image() {
  global $post;
  $first_img = '';
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //определяем картинку по умолчанию
    $first_img = "/images/default.jpg";
  }
  return $first_img;
}

// custom comments

function clearline_comment($comment, $args, $depth) 
{
   $GLOBALS['comment'] = $comment; 
	$options = & ClearLineOptions::getOptions();
	$shortname = & ClearLineOptions::cfg('shortname');   
   //print_r($comment);
   ?>
   <li <?php comment_class('common-comment'); ?> id="comment-<?php comment_ID() ?>">

      <div class="comment-author vcard">
         <?php echo get_avatar($comment,$options[$shortname.'_comments_avatar_size']); ?>

        <div class="fn floatleft"><?php echo get_comment_author_link()?><span class="commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>" title="<?php _e("Permanent link to the comment")?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a> <?php edit_comment_link(__('(Edit)'),'  ','') ?></span></div>
		<div class="clear"></div>
	  </div>
		<div class="comment-body">
			<?php if ($comment->comment_approved == '0') : ?>
				 <em><?php _e('Your comment is awaiting moderation.') ?></em>
				 <br />
			<?php endif; ?>

			<?php comment_text() ?>
		</div>
		<div class="reply">
		 <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>

<?php 
}

/** l10n */
function theme_init()
{
	
}
/*
function legacy_comments( $file ) 
{
	if ( !function_exists('wp_list_comments') )
	{
		$file = TEMPLATEPATH . '/legacy.comments.php';
	}
	return $file;
}
*/
// [a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?

function get_tags_for_post($post_id, $type='post_tag') 
{
	$tags = get_the_terms($post_id,$type);
	$tag_list='';
	if (is_array($tags))
		foreach ($tags as $tag)
			$tag_list .= ' '.$tag->name;
	return $tag_list;
}

function fix_caption_width($x=null, $attr, $content)
{
	$xs= 8; //add 8px to image width
	extract(shortcode_atts(array(
			'id'    => '',
			'align'    => 'alignnone',
			'width'    => '',
			'caption' => ''
		), $attr));

	if ( 1 > (int) $width || empty($caption) ) {
		return $content;
	}

	if ( $id ) $id = 'id="' . $id . '" ';

	return '<div ' . $id . 'class="wp-caption ' . $align . '" style="width: ' . ((int) $width + $xs) . 'px">'
	. $content . '<p class="wp-caption-text">' . $caption . '</p></div>';
}



// #######################################################################################3


function draw_image_thumb($args)
{
	global $post;
	$defaults = array(
		'max_width' => 700, 
		'max_height' => 700,
		'caption' => false,
		'align'=>'alignnone',
		'link_to' => 'post',
		'thumb_only'=>false,
		'fit_entire_size'=>true,
		'img'=>null,
		'margin'=>false,
		'aclass'=>'agallery wp-caption',
		'padding'=>4,
	);
	$r = wp_parse_args( $args, $defaults );
	$awidth = $r['max_width'];
	$aheight = $r['max_height'];
	if ($r['caption']) $aheight +=22;
	$pad=$r['padding']; //padding;
	if ($r['img'])
		$img =$r['img'];
	else
	{
		$args = array( 
				'post_parent' => $post->ID,
				'post_type' => 'attachment', 
			    'post_mime_type' => image,
				'order' => 'ASC', 
				'orderby' => 'menu_order ID'
			);
		$images =& get_children( $args );
		if (($images))
		{
			$found_thumb=false;
			foreach ( $images as $attachment_id => $attachment )
			{
				if (preg_match('/thumb/i',$attachment->post_name))
				{
					$found_thumb=true;
					$img = wp_get_attachment_image_src( $attachment_id,'full');
					break;
				}
			}
			if (!$found_thumb && !$thumb_only)
			{
				foreach ( $images as $attachment_id => $attachment )
				{
						$img = wp_get_attachment_image_src( $attachment_id,'full');
						break;
				}
			}
		}
		else
			return;
	}
	$h = round(min($img[2]*$r['max_width']/$img[1],$r['max_height']));
	$w = round(min($img[1]*$h/$img[2],$r['max_width']));
	//echo "h=$h, w=$w ";
	$img_url = substr($img[0], 7);
	$img_url = substr($img_url, strpos($img_url,'/'));
	//echo $img_url;
	?>
	
	<a href="<?php if ($r['link_to']=='post'){the_permalink();} else {echo $img_url;}?>" <?php echo (($r['link_to']=='image')?'rel="lightbox[' . $post->ID . ']"':'')?> class="<?php echo $r['aclass']?> <?php echo $r['align']?>" title="<?php the_title()?>" 
		style="width: <?php echo $awidth?>px; height:<?php echo $aheight;?>px; <?php echo (($r['margin']===false)?'':'margin:'.$r['margin'])?>">
		<?php if ($img[1] <= $r['max_width'] && $img[2] <= $r['max_height']):?>
			<img src="<?php echo $img[0]?>" width="<?php echo $img[1]?>"  height="<?php echo $img[2]?>" class="agallery" 
			style="padding-top:<?php echo round(($r['max_height']-$img[2])/2)+$r['padding']?>px; !important"/>

		<?php elseif ($r['fit_entire_size']):?>
			<img src="<?php echo get_thumb_image_url($img_url,$r['max_width'],$r['max_height'],1,80)?>" class="thumb" style="padding-top:0px !important; padding-bottom:0px"
			/>
		<?php else:?>
			<img src="<?php echo get_thumb_image_url($img_url,$w,$h,1,80)?>" class="thumb" style="padding-top:<?php echo round(($r['max_height']-$h)/2)?>px !important; padding-bottom:<?php echo round(($r['max_height']-$h)/2)?>px"
			 width="<?php echo $w?>"  height="<?php echo $h?>" />	
		<?php endif?>
		<?php if ($r['caption']):?><p><?php echo $attachment->post_excerpt?></p><?php endif;?>
	</a>

	<?php 
}

// ################################################################################



function admin_register_head() {
	$siteurl = get_template_directory_uri();
	$url = get_template_directory_uri() . '/options/style.css';
	echo "<link rel='stylesheet' type='text/css' href='$url' />\n";
}
function addThemeStyles()
{
/*
	$time = ClearLineOptions::getOptions('last_update_time');
	
	if (strpos($_SERVER["SERVER_NAME"], 'wp-themes.com') !== false)
		wp_enqueue_style('vtm-theme-css', get_stylesheet_directory_uri().'/sample.css');
	else
		wp_enqueue_style('vtm-theme-css', home_url('').'/index.php?vtm-theme=css&lud='.$time.'&layout='.ClearLineOptions::getLayoutCSS());
*/
}
function echoPostInfo($column = false)
{
	$options = & ClearLineOptions::getOptions();
	$shortname = & ClearLineOptions::cfg('shortname');
?>
<table class="info entry-meta">
				<tr>
					<td class="date"><?php echo get_the_date(); ?></td>
					<td>
						<?php if ($options[$shortname.'_show_post_author']=='yes' && !$column):?>
							<span class="postedby">
								<?php _e('Posted by',THEME_DOMAIN)?> <?php the_author_link(); ?> 
							</span>
								<span class="filledunder"><?php _e('under','clear-line')?></span>
						<?php elseif ($options[$shortname.'_show_post_author']!='yes' && !$column):?>
								<span class="filledunder"><?php _e('Filled under','clear-line')?></span>
						<?php endif;?>
						<span class="filledunder">
							<?php the_category(', '); ?>
						</span>
					</td>
					<?php if (!$column):?>
						<td>
						
				
							<div class="act">
								<?php if (get_comments_number() >= 1 || comments_open()) : ?>
									<span class="comments"><?php comments_popup_link(__('No Comments'), __('1 Comment'), __('% Comments') );?></span>
								<?php elseif ($options[$shortname.'_show_comments_off'] == 'yes'): ?>
									<span class="comments"><?php _e('Comments off','clear-line')?></span>
								<?php endif; ?>
								<?php edit_post_link(__('Edit This'), '<span class="editpost">', '</span>'); ?>
							</div>
						</td>
					<?php endif;?>

				</tr>
			</table>
<?php
}
function get_short_url()
{
	$http = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] || strtoupper ($_SERVER['HTTPS'])!=='OFF' ))?'https://':'http://';
	$long_url = $http . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; 
	if (is_page() || is_single())
	{
		global $wp_query;
		$postid = $wp_query->post->ID;

		$url = get_post_meta($postid, '_short_url', true); 
		if (!$url)
		{
			$url = wp_remote_retrieve_body(
						wp_remote_get(	'http://api.bit.ly/api?url=' . $long_url )
					);
		}
		if (!$url) 
		{
			return sprintf('%s?p=%s', home_url(),$postid);
		}
		add_post_meta( $postid, '_short_url', $url);
		return $url;
	}
	else
	{
		$r = wp_remote_get('http://api.bit.ly/api?url=' . urlencode($long_url) );
		$url = wp_remote_retrieve_body($r);
		if ( is_wp_error($url) ) 
		{
		   $error_string = $url->get_error_message();
		   echo '<div id="message" class="error"><p>' . $error_string . '</p></div>';
		}

		if (!$url) 
		{
			return $long_url;
		}
		//return $long_url;
		return $url;	
	}
}
function get_seo_meta()
{
	global $wp_query;
	$options = & ClearLineOptions::getOptions();
	$shortname = & ClearLineOptions::cfg('shortname');
	if (is_home () ) 
	{
		$title=$options[$shortname . '_seo_home_title'];
		if (!$title) $title = get_bloginfo('name') . ' - ' . get_bloginfo('description');
		$description=$options[$shortname . '_seo_home_description'];
		$keywords=$options[$shortname . '_seo_home_keywords'];
	}
	elseif ( is_category() ) 
	{
		$title_format=$options[$shortname . '_seo_category_title_format'];
		
		$title = str_replace( 
			array('%blog_title%', 		'%blog_description%', 			'%category%', 				'%category_description%'), 
			array(get_bloginfo('name'),	get_bloginfo('description'), 	single_cat_title('',false),	category_description()),
			$title_format
		);
		$description = category_description();
		$keywords = $description;
	}
	elseif (is_single() )
	{
		$post_id = $wp_query->post->ID;
		$categories = get_post_path($post_id,'&#8213;', false);	
		$title_format=$options[$shortname . '_seo_post_title_format'];
		$title = str_replace(
			array('%blog_title%', 		'%blog_description%', 			'%category%', 				'%post_title%'), 
			array(get_bloginfo('name'),	get_bloginfo('description'), 	$categories,	single_post_title('',false)),
			$title_format
		);
		$description = get_the_excerpt();
		$keywords = $description . ', '. $categories;
	}
	elseif (is_page() )
	{
		$title_format=$options[$shortname . '_seo_page_title_format'];
		$title = str_replace(
			array('%blog_title%', 		'%blog_description%', 			'%page_title%'), 
			array(get_bloginfo('name'),	get_bloginfo('description'), 	single_post_title('',false)),
			$title_format
		);
		$description = '';
		$keywords = single_post_title('',false) . ' ' . get_bloginfo('name') . ' ' . get_bloginfo('description');
	}
	elseif(is_tag())
	{
		$title_format=$options[$shortname . '_seo_tag_title_format'];
		$title = str_replace(
			array('%blog_title%', 		'%blog_description%', 			'%tag%'), 
			array(get_bloginfo('name'),	get_bloginfo('description'), 	single_cat_title('',false)),
			$title_format
		);
		$description = '';
		$keywords=single_tag_title( '', false );
	}
	else
	{
		$title = wp_title(' - ',false,'right') . ' '. get_bloginfo('description') ; 
		$description = get_bloginfo('description');
		$keywords = $title;
	}
	return (array(
				'title' => str_replace('"','',strip_tags($title)), 
				'description' => str_replace('"','',strip_tags($description)), 
				'keywords' => str_replace('"','',strip_tags($keywords))
			)
		);
}

function echo_share_this($show = null)
{
	$options = & ClearLineOptions::getOptions();
	$shortname = & ClearLineOptions::cfg('shortname');
	$social_theme = $options[$shortname . '_social_buttons_theme'];
	if (!$show)
	{
		$show = array('rss'=>1,'delicious'=>1,'digg'=>1, 'facebook'=>1, 'stumbleupon'=>1,'reddit'=>1,'twitter'=>1);
	}
	if (!is_array($show))
	{
		$options = & ClearLineOptions::getOptions(); 
		$shortname = & ClearLineOptions::cfg('shortname');
		$option_name = $shortname . $show;
		if ($options[$option_name . '_show'] != 'yes') return;
		$show = array(
			'delicious'=>	($options[$option_name . '_services_'.  'delicious']=='on'),
			'digg'=>		($options[$option_name . '_services_'.  'digg']=='on'), 
			'facebook'=>	($options[$option_name . '_services_'.  'facebook']=='on'), 
			'stumbleupon'=>	($options[$option_name . '_services_'.  'stumbleupon']=='on'),
			'reddit'=>		($options[$option_name . '_services_'.  'reddit']=='on'),
			'twitter'=>		($options[$option_name . '_services_'.  'twitter']=='on')
		);
		
	}
	$template_url =  get_template_directory_uri();
?>
<?php if (isset ($show['delicious']) && $show['delicious']):?>
	<div style="float:left;padding:1px">
		<script>document.write('<a href="http://del.icio.us/post?url='+encodeURIComponent(document.location)+'&title='+encodeURIComponent(document.title)+'">')</script>
			<img src="<?php echo $template_url?>/img/social/<?php echo $social_theme;?>/delicious.png" style="border:none;">
		<script>document.write('</a>');</script>
	</div>
<?php endif; ?>

<?php if (isset ($show['digg']) && $show['digg']):?>
	<div style="float:left;padding:1px">
		<script>document.write('<a href="http://digg.com/submit?phase=2&url='+encodeURIComponent(document.location)+'&title='+encodeURIComponent(document.title)+'">')</script>
			<img src="<?php echo $template_url?>/img/social/<?php echo $social_theme;?>/digg.png" style="border:none;">
		<script>document.write('</a>');</script>
	</div>
<?php endif; ?>

<?php if (isset ($show['facebook']) && $show['facebook']):?>	
	<div style="float:left;padding:1px">
		<script>document.write('<a href="http://www.facebook.com/share.php?u='+encodeURIComponent(document.location)+'&t='+encodeURIComponent(document.title)+'">')</script>
			<img src="<?php echo $template_url?>/img/social/<?php echo $social_theme;?>/facebook.png" style="border:none;">
		<script>document.write('</a>');</script>
	</div>
<?php endif; ?>

<?php if (isset ($show['stumbleupon']) && $show['stumbleupon']):?>	
	<div style="float:left;padding:1px">
		<script>document.write('<a href="http://www.stumbleupon.com/submit?url='+encodeURIComponent(document.location)+'&title='+encodeURIComponent(document.title)+'">')</script>
			<img src="<?php echo $template_url?>/img/social/<?php echo $social_theme;?>/stumbleupon.png" style="border:none;">
		<script>document.write('</a>');</script>
	</div>
<?php endif; ?>

<?php if (isset ($show['reddit']) && $show['reddit']):?>
	<div style="float:left;padding:1px">
		<script>document.write('<a href="http://www.reddit.com/share.php?url='+encodeURIComponent(document.location)+'&title='+encodeURIComponent(document.title)+'">')</script>
			<img src="<?php echo $template_url?>/img/social/<?php echo $social_theme;?>/reddit.png" style="border:none;">
		<script>document.write('</a>');</script>
	</div>
<?php endif; ?>

<?php if (isset ($show['twitter']) && $show['twitter' ]):?>
	<div style="float:left;padding:1px">
		<script>document.write('<a href="http://twitter.com/home?status='+encodeURIComponent(document.title)+':'+encodeURIComponent('<?php echo get_short_url()?>')+'">')</script>
			<img src="<?php echo $template_url?>/img/social/<?php echo $social_theme;?>/twitter.png" style="border:none;">
		<script>document.write('</a>');</script>
	</div>
<?php endif; ?>
<div class="clear"></div>
<?php
}
function trim_excerpt($text) 
{
	$options = & ClearLineOptions::getOptions(); 
	$shortname = & ClearLineOptions::cfg('shortname');
	$text = str_replace(' [...]', '…', $text);
	if ($options[$shortname . '_excerpt_more_link_show']==='yes') 
		$text .= ' <a href="' . get_permalink() . '" rel="bookmark">'.$options[$shortname . '_excerpt_more_link_text'] .'</a>';
	return $text;
}
function get_current_page_type()
{
		if (is_home() || is_front_page() ) return 'index';
		if (is_single()) 	return 'post';
		if (is_page()) 		return 'page';
		if (is_category()) 	return 'category';
		if (is_tag()) 		return 'tag';
		if (is_search()) 	return 'search';
		if (is_404()) 		return '404';
		if (is_date()) 		return 'archive';
		if (is_author()) 	return 'author';
}
function echo_regular_post()
{
	$options = & ClearLineOptions::getOptions(); 
	$shortname = & ClearLineOptions::cfg('shortname');
	$has_excerpt =  has_excerpt();
	$page_type = get_current_page_type();
	$show_excerpt = ($options[$shortname.'_show_excerpts_on_'.$page_type] == 'on'
						&& ($has_excerpt || $options[$shortname.'_show_content_if_no_excerpt']=='no')
					);

	?>
	<?php if ($options[$shortname.'_regular_post_thumbnail_position'] == 'at_the_left_of_title'):?>
		<?php if (has_post_thumbnail() && $show_excerpt ):?>
			<div class="regular-post-thumbnail">
					<a href="<?php the_permalink() ?>" rel="bookmark">
						<?php the_post_thumbnail(); ?>
					</a>
				</div>
		<?php endif; ?>
	<?php endif; ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
		<h2 class="h1"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>

		<?php if ($options[$shortname.'_show_post_info']=='yes'):?>
			<?php echoPostInfo();?>
		<?php endif;?>
		
		<?php if ($options[$shortname.'_regular_post_thumbnail_position'] == 'at_the_left_under_post_title'): ?>
			<?php if (has_post_thumbnail() && $show_excerpt ):?>
				<div class="regular-post-thumbnail">
						<a href="<?php the_permalink() ?>" rel="bookmark">
							<?php the_post_thumbnail(); ?>
						</a>
					</div>
			<?php endif; ?>
		<?php endif; ?>		
		
		
		<div class="content">
			
			<?php 
			if ($show_excerpt)
			{
				the_excerpt();
			}
			else the_content(__('(more...)'));
			?>
		</div>
		<div class="clear"></div>
		
	</div>
<?php
}
function echo_column_post()
{
	$options = & ClearLineOptions::getOptions(); 
	$shortname = & ClearLineOptions::cfg('shortname');
?>
	<div class="post-list-column post">
		<div class="margins">
			<div class="post-thumbnail">
				<a href="<?php the_permalink() ?>" rel="bookmark">
					<?php if (has_post_thumbnail())
						the_post_thumbnail('column-thumbnail'); 
						else echo '<img src="'.get_stylesheet_directory_uri().'/img/thumbnail.jpg" '
						.' height="'.$options[$shortname . '_column_thumbnail_size_y'].'" class="wp-post-image"/>';
					?>
				</a>
			</div>
			<h2 id="post-<?php the_ID(); ?>" class="small"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<?php if ($options[$shortname.'_show_column_post_info']=='yes'):?>
				<?php echoPostInfo(true);?>
			<?php endif;?>
			<div class="content">
				<?php the_excerpt();//the_content(__('(more...)')); ?>
			</div>
		</div>
	</div>
<?php
}
function display_regular_posts($wpq = null, $displayed_ids = null)
// wpq - WP_Query object
// returns displayed post ids and number of displayed posts
{
	global $wp_query;
	if (!$wpq) $wpq = & $wp_query;
	
	$ids = array();
	$count=0;
	if ($wpq->have_posts())
	{
		while ($wpq->have_posts()) : $wpq->the_post();
			$id=get_the_ID();
			if (!isset($displayed_ids[$id]))
			{
				$count++;
				$ids[$id] = $id;
				echo_regular_post();
			}
		endwhile;
	}
	return array('count'=>$count, 'ids'=>$ids);
}



function display_column_posts($wpq = null, $rows = -1)
// wpq - WP_Query object
// rows = 0 - get from the theme options
// rows = -1 - show all posts in column 
// returns displayed post ids and number of displayed posts
{
	global $wp_query;
	if (!$wpq) $wpq = & $wp_query;
	$options = & ClearLineOptions::getOptions(); 
	$shortname = & ClearLineOptions::cfg('shortname');
	
	$ids = array();
	$count=0;
	$col = 0;
	if ($rows == 0) $row = $options[$shortname.'_post_list_column_rows'];
	elseif ($rows == -1) $row = 999999;
	else $row = $rows;
		
	if ($wpq->have_posts())
	{
		while ($wpq->have_posts() && $row > 0) : $wpq->the_post();
			$count++;
			$id=get_the_ID();
			$ids[$id] = $id;
			
				if ($col == 0) $col = $options[$shortname.'_post_list_column_count'];
				if ($col>=1 )
				{
					echo_column_post();
					$col--;
				} 
				if ($col == 0)
				{
					echo '<div class="clear"></div>';
					$row--;
				}	
		endwhile;
	}
	return array('count'=>$count, 'ids'=>$ids);
}
function header_style() 
{
	$options = & ClearLineOptions::getOptions(); 
	$shortname = & ClearLineOptions::cfg('shortname');
	if(get_header_image())
	{
		?><style type="text/css">
			#header {
				background: url(<?php header_image(); ?>) no-repeat;
				background-position: <?php echo $options[$shortname . '_header_background_position_css'] ?>; 
			}
		</style><?php
	}
}
function admin_header_style() 
{
    ?><style type="text/css">
        #headimg {
            width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
            height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
        }
    </style><?php
}
function vtm_excerpt_length($length) 
{
	$options = & ClearLineOptions::getOptions();
	$shortname = & ClearLineOptions::cfg('shortname');
	return $options[$shortname . '_excerpt_length'];
}

/****************************************************
	START
*****************************************************/
	$options = & ClearLineOptions::getOptions();
	$shortname = & ClearLineOptions::cfg('shortname');
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	//echo "message";
} 
function blog_favicon() 
{
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('wpurl').'/favicon.ico" />';
}
function vtm_remove_version() 
{
	return '';
}

if (is_admin())
{
	wp_enqueue_script('vtm-colorpicker', get_stylesheet_directory_uri().'/options/js/colorpicker.js');
	wp_enqueue_style ('vtm-colorpicker1', get_stylesheet_directory_uri().'/options/js/css/colorpicker.css');
	//wp_enqueue_script('colorpicker');
}
if (!is_admin()) 
{    
    
    /**
     * Parse request
     *
     * @param unknown_type $wp
     */
    function vtm_theme_parse_request() 
	{
		$param = get_query_var('vtm-theme');
		switch ($param) 
		{
			case 'css':
				//require_once 'options/css.php';
				get_template_part( 'options/css');
				die(); // die after return data
		}
    }
	add_action('template_redirect', 'vtm_theme_parse_request');
    //add_action('wp', 'vtm_theme_parse_request');

    function vtm_register_query_vars($vars) {
        $vars[] = 'vtm-theme';
		$vars[] = 'lud'; //last updated date
		$vars[] = 'layout';
        return $vars;
    }
    add_filter('query_vars', 'vtm_register_query_vars');
	
}
add_filter('excerpt_length', 'vtm_excerpt_length');

// add a favicon to your
add_action('wp_head', 'blog_favicon');
add_filter('the_generator', 'vtm_remove_version');

add_filter('the_excerpt', 'do_shortcode');
add_filter('get_the_excerpt', 'do_shortcode');

if (function_exists('add_theme_support')) add_theme_support( 'post-thumbnails' );
if (function_exists('set_post_thumbnail_size')) set_post_thumbnail_size( $options[$shortname . '_normal_thumbnail_size_x'], $options[$shortname . '_normal_thumbnail_size_y']);
if (function_exists('add_image_size')) add_image_size( 'column-thumbnail', $options[$shortname . '_column_thumbnail_size_x'], $options[$shortname . '_column_thumbnail_size_y'],true ); // Permalink thumbnail size
//var_dump ($shortname . '_column_thumbnail_size_x');
//var_dump ($options[$shortname . '_column_thumbnail_size_y']);
add_filter('img_caption_shortcode', 'fix_caption_width', 10, 3);
//add_filter( 'comments_template', 'legacy_comments' );
add_action ('init', 'theme_init');
add_action('admin_menu', array('ClearLineOptions', 'adminMenu'));
add_action('admin_head', 'admin_register_head');

if (function_exists('add_theme_support')) add_theme_support('automatic-feed-links');
if (function_exists('add_custom_background')) add_custom_background();

define('HEADER_TEXTCOLOR', '');
//define('HEADER_IMAGE', '%s/img/header/tree-small.jpg'); // %s is the template dir uri
define('HEADER_IMAGE_WIDTH', $options[$shortname . '_header_image_size_x']); // use width and height appropriate for your theme
define('HEADER_IMAGE_HEIGHT', $options[$shortname . '_header_image_size_y']);
define('NO_HEADER_TEXT', true );
add_custom_image_header('header_style', 'admin_header_style');


//add_action('wp_head', 'addThemeStyles',  1);

add_filter('get_the_excerpt', 'trim_excerpt');


if( function_exists('register_sidebar') ) 
{
	register_sidebar(array(
		'name' => 'Blue Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	));
	register_sidebar(array(
		'name' => 'Cyan Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	));
	register_sidebar(array(
		'name' => 'Green Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	));
	register_sidebar(array(
		'name'	=> 'Orange Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	));
	register_sidebar(array(
		'name'	=> 'Red Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	));
	register_sidebar(array(
		'name'	=> 'Blue Footer',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	));
	register_sidebar(array(
		'name'	=> 'Green Footer',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	));
	register_sidebar(array(
		'name'	=> 'Orange Footer',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	));
	register_sidebar(array(
		'name'	=> 'Red Footer',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	));
	register_sidebar(array(
		'name'	=> 'Before Columns on Index Page',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div><div class="clear"></div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	));
	register_sidebar(array(
		'name'	=> 'Footer Counters',
		'before_widget' => '<div id="%1$s" style="float:left;">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => ''
	));
	register_sidebar(array(
		'name'	=> 'Under Top Menu',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => '</div><div class="clear"></div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	));
	register_sidebar(array(
		'name'	=> 'Before Sticky Post',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => '</div><div class="clear"></div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	));
	register_sidebar(array(
		'name'	=> 'Before Latest Post',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => '</div><div class="clear"></div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	));

	if ( ! isset( $content_width ) ) $content_width = 640;
}