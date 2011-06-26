<?php

function array_merge_recursive_distinct () {
  $arrays = func_get_args();
  $base = array_shift($arrays);
  if(!is_array($base)) $base = empty($base) ? array() : array($base);
  foreach($arrays as $append) {
    if(!is_array($append)) $append = array($append);
    foreach($append as $key => $value) {
      if(!array_key_exists($key, $base) and !is_numeric($key)) {
        $base[$key] = $append[$key];
        continue;
      }
      if(is_array($value) or is_array($base[$key])) {
        $base[$key] = array_merge_recursive_distinct($base[$key], $append[$key]);
      } else if(is_numeric($key)) {
        if(!in_array($value, $base)) $base[] = $value;
      } else {
        $base[$key] = $value;
      }
    }
  }
  return $base;
}


function array_merge_recursive2($array1, $array2)
{
    $arrays = func_get_args();
    $narrays = count($arrays);
   
    // check arguments
    // comment out if more performance is necessary (in this case the foreach loop will trigger a warning if the argument is not an array)
    for ($i = 0; $i < $narrays; $i ++) {
        if (!is_array($arrays[$i])) {
            // also array_merge_recursive returns nothing in this case
            trigger_error('Argument #' . ($i+1) . ' is not an array - trying to merge array with scalar! Returning null!', E_USER_WARNING);
            return;
        }
    }
   
    // the first array is in the output set in every case
    $ret = $arrays[0];
   
    // merege $ret with the remaining arrays
    for ($i = 1; $i < $narrays; $i ++) {
        foreach ($arrays[$i] as $key => $value) {
			{ // string key - megre
                if (is_array($value) && isset($ret[$key])) {
                    // if $ret[$key] is not an array you try to merge an scalar value with an array - the result is not defined (incompatible arrays)
                    // in this case the call will trigger an E_USER_WARNING and the $ret[$key] will be null.
                    $ret[$key] = array_merge_recursive2($ret[$key], $value);
                }
                else {
                    $ret[$key] = $value;
                }
            }
        }   
    }
   
    return $ret;
}



	function get_categories_deep ($parent_id = 0, $level = 0)
	{
		//echo '<br>deep'.$level.'<br>'."\n";
		global $wpdb;
		$sql = "SELECT t.term_id, t.name 
				FROM $wpdb->terms AS t INNER JOIN $wpdb->term_taxonomy AS tt 
				ON t.term_id = tt.term_id
				WHERE tt.taxonomy = 'category' AND tt.parent = $parent_id";	
		
		$items = $wpdb->get_results ($sql);
		//if ($items) {echo 'items = ';print_r($items );}
		$categories='';
		foreach ($items as $item)
		{
			$categories['values'][(string) $item->term_id] = str_repeat("- ", $level) . $item->name;
			$categories['class'][(string) $item->term_id] = 'level-'.$level;
			//echo '<br>cur item '.$item->name.' '.$item->term_id.' <br>'."\n";
			$child_categories = get_categories_deep ($item->term_id, $level+1);
			//echo '<br>cur item '.$item->name.' <br>'."\n";
			//echo '<br>ret to deep'.$level.'<br>'."\n";
			//echo 'child_categories = ';print_r($child_categories );
			if (is_array($child_categories))
			{
				//echo 'before merge = ';print_r($categories );
				//$categories = array_merge_recursive  ($categories, $child_categories);
				$categories = array_merge_recursive2  ($categories, $child_categories);
				//echo 'after merge = ';print_r($categories );
			}
		}
		return $categories;
	}
	
	
	function echo_select_catagories ($args)
	{
		global $wpdb;
		$defaults = array(
			'selected'=>false,
			'show_select_a_category' => 1,
			'show_all_categories' => 1,
			'html_select_id' => '',
			'html_select_class' =>'',
			'html_select_name' => '',
			'html_option_level_class' => 'level-'
		);
		$r = wp_parse_args( $args, $defaults );
		echo '<select'.(($r['html_select_id'])?' id="'.$r['html_select_id'].'"':'')
			. (($r['html_select_class'])?' class="'.$r['html_select_class'].'"':'')
			. (($r['html_select_name'])?' name="'.$r['html_select_name'].'"':'').'>';
		echo_option_catagories_deep($r);
		echo '</select>';
		
	}

	function echo_option_catagories_deep ($args, $parent_id = 0, $level = 0)
	{
		global $wpdb;
		/*
			$args must be provided with all parameters. See echo_select_catagories()
		*/
		
		if ($level == 0)
		{
			if ($args['show_select_a_category']) 
				echo '<option value=""'.(($args['selected'] === '')?' selected="selected"':'').'>'.__('select one',DOMAIN).'</option>';
			if ($args['show_all_categories']) 
				echo '<option value="0"'.(($args['selected'] === '0')?' selected="selected"':'').'>'.__('All Categories',DOMAIN).'</option>';
		}

		$sql = "SELECT t.term_id, t.name 
				FROM $wpdb->terms AS t INNER JOIN $wpdb->term_taxonomy AS tt 
				ON t.term_id = tt.term_id
				WHERE tt.taxonomy = 'category' AND tt.parent = $parent_id";			

		$items = $wpdb->get_results ($sql);
		
		foreach ($items as $item)
		{
			$option = '<option value="'.$item->term_id.'"';// style="';
			if ($args['selected'] === $item->term_id) $option .= ' selected="selected"';
			if ($level == 0) $option .= '';
			elseif ($level == 1) $option .= 'class = "'.$args['html_option_level_class'].$level.'"';	//' font-size:90%; color:#777777;';
			else $option .= 'class = "'.$args['html_option_level_class'].'2"';	//' font-size:90%; color:#aaaaaa;';
			$option .= '>';
			
			$option .= str_repeat("- ", $level) . $item->name;
			$option .= '</option>';
			echo $option;
			$list = echo_option_catagories_deep ($args, $item->term_id, $level+1);
		}

		//return $list;
	}