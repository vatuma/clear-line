<?php 
function vtm_content()
{?>
<h1 class="page-title" style="font-size:12px;">Error 404: <span><?php _e('page not found',THEME_DOMAIN)?></span></h1>
<h2><?php _e('The page you are looking for is not here',THEME_DOMAIN)?></h2>
<div class="post">
<h3><?php _e('Here are some ways to find what you are looking for',THEME_DOMAIN)?></h3>
<br/>
<form action="/"  method="get" role="search">
	<div>
		<h4><?php _e('<b>Search</b> the site',THEME_DOMAIN)?></h4><br/>
		<input type="text" name="s" value="" size="45">
		<input type="submit" value="<?php _e('Search',THEME_DOMAIN)?>" name="searchsubmit" class="button">
	</div>
</form>
</div>
<br/>
<h4><?php _e('<b>Browse</b>  categories, pages, tags',THEME_DOMAIN)?></h4>
<div class="sidebar alignleft" style=" width:30%; margin: 10px 20px 10px 0;">
	<div class="widget">
		<h5><?php _e('Categories',THEME_DOMAIN)?></h5>
		<ul>
		<?php wp_list_categories(); ?>
		</ul>
	</div>
</div>
<div class="sidebar alignleft" style=" width:30%; margin: 10px 20px 10px 0;">
	<div class="widget">
		<h5><?php _e('Pages',THEME_DOMAIN)?></h5>
		<ul>
		<?php wp_list_pages(array ('title_li'=>'')); ?>
		</ul>
	</div>
</div>

<div class="sidebar alignleft" style=" width:30%; margin: 10px 0px 10px 0;">
	<div class="widget">
		<h5><?php _e('Tags',THEME_DOMAIN)?></h5>
		<ul>
		<?php wp_tag_cloud('smallest=12&largest=20&unit=px&number=15&format=list&order=ASC'); ?>
		</ul>
	</div>
</div>
<div class="clear"></div>
<div class="post"><h3><?php _e('No! I\'d better read something else!',THEME_DOMAIN)?></h3></div>
<div class="sidebar" style="">
	<div class="widget">
		<h5><?php _e('Read recent posts',THEME_DOMAIN)?></h5>
		<ul>
		<?php wp_get_archives('type=postbypost&limit=10'); ?>
		</ul>
	</div>
</div>
<?php
}
get_template_part( 'layouts/'. ClearLineOptions::getLayoutCSS() );
//include (TEMPLATEPATH . '/layouts/'. ClearLineOptions::getLayoutCSS().'.php');
