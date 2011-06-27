<?php function vtm_content()
{
$shortname = & ClearLineOptions::cfg('shortname');
$options = & ClearLineOptions::getOptions();

if (have_posts()) : the_post(); update_post_caches($posts); 
	if ($options[$shortname.'_breadcrumbs_show']=='yes'):?>

		<div id="postpath">
			<a title="<?php _e('Goto homepage', THEME_DOMAIN); ?>" href="<?php echo home_url('') ?>/"><?php _e('Home'); ?></a>
			 &raquo; <?php echo(get_post_path(get_the_ID(), ' &raquo; ')); ?>
			&raquo; <?php the_title(); ?>
		</div>
	<?php 
	endif;?>


	<!--div class="post"-->
	<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
		 <h1><?php the_title(); ?></h1>
		<?php if ($options[$shortname.'_show_post_info']=='yes'):?>
			<?php echoPostInfo();?>
		<?php endif;?>

		<div class="content">
			<?php 
				the_content();
?>
			<div class="clear"></div>
			<div class="postpages">
				<?php 
				if (function_exists('multipagebar'))
					multipagebar();
				else
					wp_link_pages('pagelink=<span>%</span>'); ?>
			</div>
			<?php if ($options[$shortname . '_show_post_info']=='yes'):?>
				<div class="under">
					<?php $t=get_the_tag_list('',', ');
					if ($t):?>
						<span class="tags"><?php echo __('Tags').': ' . $t ?></span>
					<?php endif;?>
					<div class="clear"></div>
				</div>
			<?php endif;?>
		</div>
		
	</div>
	<?php 
		comments_template();

	?>

	<div id="postnavi" class="navigation">
		<div class="nav prev left"><?php next_post_link('%link','&laquo;  %title'); ?></div>
		<div class="nav next right"><?php previous_post_link('%link', ' %title &raquo;'); ?></div>
		<div class="fixed"></div>
	</div>

	<?php else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
	
<?php
}
get_template_part( 'layouts/'. ClearLineOptions::getLayoutCSS() );
//include (TEMPLATEPATH . '/layouts/'. ClearLineOptions::getLayoutCSS().'.php');