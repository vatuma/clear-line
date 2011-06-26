<?php
function vtm_content()
{
	$options = & ClearLineOptions::getOptions(); 
	$shortname = & ClearLineOptions::cfg('shortname');

	
	$searchquery = esc_html(get_search_query(),1);
	if($searchquery):?>
		<h1 class="page-title">
			<?php printf(__("Search results for %s",THEME_DOMAIN),'<span>'.$searchquery.'</span>'); ?>
		</h1>
		<?php if (have_posts()) :
			display_regular_posts();
			?>

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
	endif;
}
get_template_part( 'layouts/'. ClearLineOptions::getLayoutCSS() );
//include (TEMPLATEPATH . '/layouts/'. ClearLineOptions::getLayoutCSS().'.php');