<?php get_header();?>
<?php
	$options = & ClearLineOptions::getOptions(); 
	$shortname = & ClearLineOptions::cfg('shortname');
?>
<div id="wrapper">
	<div id="content-wrapper">
		<div id="content" role="main">
			<?php vtm_content(); ?>
		</div>
	</div>
</div>
<div id="cyan-sidebar" class="sidebar">
	<div class="column">
		<div class = "margines">
			<?php if ( (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Cyan Sidebar') ) 
					&& $options[$shortname . '_sidebars_show_demo_data'] == 'yes') : ?>
					<?php the_widget('WP_Widget_Categories', '', 'before_title=<h5>&after_title=</h5>'); ?>
					<?php the_widget('WP_Widget_Archives', '', ''); ?> 
			<?php endif;?>
		</div>
	</div>
</div>

<div id="green-sidebar" class="sidebar">
	<div class="column">
		<div class = "margines">

						<?php if ($options[$shortname . '_sharing_buttons_on_green_sidebar_show'] == 'yes'):?>
							<div class="widget">
								<h5><?php _e('Share This',THEME_DOMAIN)?></h5>
								<div class="widget textwidget" style="padding:5px 0px 3px 0;">
									<?php echo_share_this('_sharing_buttons_on_green_sidebar')?>
									<div class="clear"></div>
								</div>
							</div>
						<?php endif;?>


			<?php if ( (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Green Sidebar')) 
					&& $options[$shortname . '_sidebars_show_demo_data'] == 'yes') : ?>
					<?php the_widget('WP_Widget_Pages', '', 'before_title=<h5>&after_title=</h5>'); ?> 
					<?php the_widget('WP_Widget_Meta'); ?> 
			<?php endif;?>
		</div>
	</div>
</div>
<div class="clear"></div>
<?php get_footer();