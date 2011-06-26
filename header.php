<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<?php 
	$options = & ClearLineOptions::getOptions();
	$shortname = & ClearLineOptions::cfg('shortname');
?>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php if ($options[$shortname . '_seo_use_plugin']=='no'):
	$meta = get_seo_meta();
?>
	<title><?php  echo $meta['title']?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php if ($meta['description']) {?><meta name="description" content="<?php  echo $meta['description']?>" /><?php } ?>
	<?php if ($meta['keywords']) {?><meta name="keywords" content="<?php  echo $meta['keywords']?>" /><?php } ?>
<?php endif;?>

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php ClearLineOptions::echoInlineCSS();?>
	
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' );?>
	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
	<div id="container" class="hfeed">
	<div id="header">
		<div id="masthead">
			<?php if ($options[$shortname . '_show_rss_button_at_top']=='yes'):?>
				<!--div class="subscribe-button" style="float:right;margin-top:-20px;"-->
					<?php $template_url =  get_bloginfo('template_url');?>
					<a href="<?php echo bloginfo( 'rss_url');?>" class="subscribe-button" >
						<img src="<?php echo $template_url?>/img/social/<?php echo $options[$shortname . '_social_buttons_theme'];?>/rss.png" style="border:none;" alt="Subscribe RSS" title="Subscribe RSS">
					</a>
				<!--/div-->
			<?php endif;?>
			<div style="float:left;">
				<?php if (trim($options[$shortname . '_custom_blog_title'])===''): ?>
					<?php if ($options[$shortname . '_show_blog_title_and_description']=='yes'):?>
						<?php if (is_home()):?>
							<h1><a href="<?php echo home_url( '' ); ?>/"><?php bloginfo('name'); ?></a></h1>
						<?php else:?>
							<h3><a href="<?php echo home_url( '' ); ?>/"><?php bloginfo('name'); ?></a></h3>
						<?php endif;?>
							<div class="description"><?php bloginfo('description'); ?></div>
					<?php else: ?>
						<a class="blankheader" href="<?php echo home_url( '' ); ?>/">&nbsp;</a>
					<?php endif;?>
				<?php else: 
					echo $options[$shortname . '_custom_blog_title'];
				endif;?>
			</div>
			<div class="clear"></div>
		</div>
		<?php if ($options[$shortname . '_show_top_menu']=='yes'):?>
			<div id="access">
				<?php 
					if (function_exists('wp_nav_menu'))
					{
						wp_nav_menu( array( 'theme_location'=>'top_menu', 'sort_column' => 'menu_order', 'container_class' => 'menu-header' ) ); 
					}
					else wp_list_pages();
				?>
				<div class="clear"></div>
			</div>
		<?php endif;?>
		<div class="clear"></div>
	</div>
		<div class="sidebar">
			<?php if ( function_exists('dynamic_sidebar')) dynamic_sidebar('Under Top Menu');?>
		</div>
<?php 

?>


<!-- end header -->