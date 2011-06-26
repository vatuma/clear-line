<?php
	$options = & ClearLineOptions::getOptions(); 
	$shortname = & ClearLineOptions::cfg('shortname');
?>
<div id="outer-footer">
<div id="footer">

<div id="blue-footer">
	<div class="footer-column">
		<?php if (( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Blue Footer') ) 
						&& $options[$shortname . '_footer_show_demo_data'] =='yes') : ?>
			<div class="widget">
				<h5><?php _e('Recent Posts')?></h5>
				<ul>
					<?php wp_get_archives('type=postbypost&limit=5&format=html'); ?>
				</ul>
			</div>
		<?php endif;?>

	</div>
</div>
<?php if($options[$shortname . '_footers']>=2):?>
	<div id="green-footer">
		<div class="footer-column">
			<?php if (( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Green Footer')) 
						&& $options[$shortname . '_footer_show_demo_data'] =='yes') : ?>
				<?php the_widget('WP_Widget_Recent_Comments', '', array('before_title'=>'<h5>','after_title'=>'</h5>')); ?> 
			<?php endif;?>
		</div>
	</div>
<?php endif;?>
<?php if($options[$shortname . '_footers']>=3):?>
	<div id="orange-footer">
		<div class="footer-column">
			<?php if ( (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Orange Footer')) 
						&& $options[$shortname . '_footer_show_demo_data'] =='yes') : ?>
				<h5>Add Widgets Here</h5>
				<div class="widget" style="padding:5px 7px 3px 0;">
					<img src="<?php  echo get_stylesheet_directory_uri();?>/options/img/footer_3.gif" class="alignleft"/>
					This is the default footer layout. You can easily add or remove columns in the footer. 
					<p>Just go to <code>Admin area > Appearence > Clear Line Options > Footer</code> and select column number and their width.
					<p>Every footer column is the widget area. Go to <code>Admin area > Appearence > Widgets</code> and add what you like here.
				</div>
			<?php endif;?>
		</div>
	</div>
<?php endif;?>
<?php if($options[$shortname . '_footers']>=4):?>
	<div id="red-footer">
		<div class="footer-column">
			<?php if (( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Red Footer') ) 
						&& $options[$shortname . '_footer_show_demo_data'] =='yes') : ?>
				<?php the_widget('WP_Widget_Links', '', array('before_title'=>'<h5>','after_title'=>'</h5>')); ?> 
			<?php endif;?>
		</div>
	</div>
<?php endif;?>
<div class="clear"></div>
</div> <!-- footer -->
</div> <!-- outer-footer -->
<div id="copyright" style="margin:5px; text-align:center; float:left;">
<b><?php bloginfo('name'); ?></b> powered by <a href="http://wordpress.org">WordPress</a> and 
<a href="http://vatuma.com/">The Clear Line Theme</a><br/><br/>
</div>
<div style="float:right;">
	<?php if  (function_exists('dynamic_sidebar')) dynamic_sidebar('Footer Counters') ; ?>
	<div class="clear"></div>
</div>
<div class="clear"></div>
<?php wp_footer(); ?>

		</div> <!--container -->
</body>
</html>