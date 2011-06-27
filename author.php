<?php
function vtm_content()
{
	$options = & ClearLineOptions::getOptions(); 
	$shortname = & ClearLineOptions::cfg('shortname');
	echo single_tag_title('', false);

	?>

		<div class="post">
			<?php 	if ( have_posts() )	the_post();	?>

			<h1 class="page-title author"><?php printf( __( 'Author: %s', THEME_DOMAIN ), "<span class='vcard'><a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a></span>" ); ?></h1>
<hr/>
			<?php
			// If a user has filled out their description, show a bio on their entries.
			if ( get_the_author_meta( 'description' ) ) : ?>
				<div id="entry-author-info">
					<div id="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
					</div><!-- #author-avatar -->
					<div id="author-description">
						<h2><?php printf( __( 'About %s', THEME_DOMAIN ), get_the_author() ); ?></h2>
						<?php the_author_meta( 'description' ); ?>
					</div><!-- #author-description	-->
					<div class="clear"></div>
				</div><!-- #entry-author-info -->
				<hr/>
			<?php endif; ?>
		</div>
		<?php 
		rewind_posts();
		
		if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="post">
				 <h2 id="post-<?php the_ID(); ?>" class="h1"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo '<div class="archive-meta">' . $category_description . '</div>';
					?>
				
				<?php if ($options[$shortname.'_show_post_info']=='yes'):?>
					<?php echoPostInfo();?>
				<?php endif;?>
				
				<div class="storycontent">
					<?php the_content(__('(more...)')); ?>
				</div>
			</div>

		<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>

		<div class="clear"></div>
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