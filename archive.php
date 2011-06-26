<?php
function vtm_content()
{
	$options = & ClearLineOptions::getOptions(); 
	$shortname = & ClearLineOptions::cfg('shortname');

  	if ( have_posts() )
		the_post();?>

	<h1 class="page-title">
		<?php if ( is_day() ) : ?>
						<?php printf( __( 'Daily Archives: <span>%s</span>', THEME_DOMAIN ), get_the_date() ); ?>
		<?php elseif ( is_month() ) : ?>
						<?php printf( __( 'Monthly Archives: <span>%s</span>', THEME_DOMAIN ), get_the_date('F Y') ); ?>
		<?php elseif ( is_year() ) : ?>
						<?php printf( __( 'Yearly Archives: <span>%s</span>', THEME_DOMAIN ), get_the_date('Y') ); ?>
		<?php elseif ( is_tag() ) : ?>
				<?php printf( __( 'Posts Tagged by <span>%s</span>', THEME_DOMAIN ), single_tag_title( '', false )); ?>

		<?php elseif ( is_category() ) : ?>
				<?php printf( __( 'Category: <span>%s</span>', THEME_DOMAIN ), single_cat_title( '', false )); ?>
		<?php else : ?>
						<?php _e( 'Blog Archives', THEME_DOMAIN ); ?>
		<?php endif; ?>
	</h1>
  
  <?php rewind_posts() ?>

		<?php if (have_posts()) :  
			display_regular_posts();?>
<!--
		<div class="post">
			 <h2 id="post-<?php the_ID(); ?>" class="h1"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			
			<?php if ($options[$shortname.'_show_post_info']=='yes'):?>
				<?php echoPostInfo();?>
			<?php endif;?>
			
			<div class="storycontent">
				<?php the_content(__('(more...)')); ?>
			</div>
			
		</div>
-->
		<?php comments_template(); // Get wp-comments.php template ?>

		<?php else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>


		<?php if(function_exists('wp_paginate')) 
		{
			wp_paginate();
		} 
		elseif(function_exists('wp_pagenavi'))
		{
			wp_pagenavi();
		}
		elseif (function_exists('postbar')) //PAGEBAR
		{
			postbar();
		}
		else
		{
			posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;'));
		}

}
get_template_part( 'layouts/'. ClearLineOptions::getLayoutCSS() );
//include (TEMPLATEPATH . '/layouts/'. ClearLineOptions::getLayoutCSS().'.php');