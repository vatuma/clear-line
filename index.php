
<?php 
function vtm_content()
{
 global $posts_per_page;
	$wpq = new WP_Query();
	//echo "wp_query = $posts_per_page";
	
	$options = & ClearLineOptions::getOptions(); 
	$shortname = & ClearLineOptions::cfg('shortname');
	//print_r($options);
	$displayed_posts = 0;
	$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$displayed_ids = array();

	if (is_home() && $page == 1) 
	{
		$sticky = get_option('sticky_posts');
		if ($sticky && is_array($sticky))
		{
			echo '<div class="sidebar">';
			if ( function_exists('dynamic_sidebar')) dynamic_sidebar('Before Sticky Post');
			echo '</div>';
			
			rsort( $sticky );
			$sticky = array_slice( $sticky, 0, 3);
			$wpq->query( array( 'post__in' => $sticky, 'caller_get_posts' => 1 ) );
			$res= display_regular_posts($wpq);
			$displayed_posts += $res['count'];
			$displayed_ids = $displayed_ids + $res['ids'];
		}
		
		if ($options[$shortname.'_show_latest_post_before_columns']=='yes')
		{
			echo '<div class="sidebar">';
			if ( function_exists('dynamic_sidebar')) dynamic_sidebar('Before Latest Post');
			echo '</div>';
			
			$wpq->query("paged=$page&posts_per_page=1&caller_get_posts=1");
			$res= display_regular_posts($wpq, $displayed_ids);
			$displayed_posts += $res['count'];
			$displayed_ids = $displayed_ids + $res['ids'];
		}
		
		$cat = $options[$shortname.'_show_category_in_column'];
		

		if ($cat <= 0) $cat = null;
		if ($options[$shortname.'_post_list_column_count'] > 1)
		{
			if ($displayed_ids) 
			{
				echo '<hr/>';
			}
			echo '<br/>';
			echo '<div class="sidebar">';
			if ( function_exists('dynamic_sidebar')) dynamic_sidebar('Before Columns on Index Page');
			echo '</div>';

			$show_posts = $options[$shortname.'_post_list_column_count'] * $options[$shortname.'_post_list_column_rows'];
			$wpq->query(array('post__not_in' => $displayed_ids,'cat'=>$cat,'posts_per_page'=>$show_posts));
			$res = display_column_posts($wpq, $displayed_ids);
			$displayed_posts += $res['count'];
			if ($res['count'] < $show_posts) echo '<div class="clear"></div>';
			$displayed_ids = $displayed_ids + $res['ids'];
		}
		$show_posts = $posts_per_page - $displayed_posts;
		display_regular_posts(null,$displayed_ids);
	}
	else 
		display_regular_posts();
 ?>

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

} //end of vtm_conent()
get_template_part( 'layouts/'. ClearLineOptions::getLayoutCSS() );
//include (TEMPLATEPATH . '/layouts/'. ClearLineOptions::getLayoutCSS().'.php');