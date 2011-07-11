<?php
define ('SHOW_DEVELOPER_TOOLS',0);
class ClearLineOptions
{
	function & cfg($name)
	{
		$cfg= array(
			'shortname' => "vtm_clr",
			'style-prefix' => "vtm-clr",
			'text-domain' =>'vtmclr',
		);
		return $cfg[$name];
	}
	function & getAdminOptions($option_name='')
	{
		static $vtm_clr_admin_options = null;
		if (!$vtm_clr_admin_options)
		{
			include (str_replace('//','/',dirname(__FILE__)).'/admin.options.php');
		}
		if ($option_name) return $vtm_clr_admin_options[$option_name];
		return $vtm_clr_admin_options;
	}
	function & getOptions($option_name='', $renew = false) 
	{
		static $options = null;
		static $i = 0;
		$i++;
		if ($renew) {$options = null;}
		//echo $i.'. getOptions ('.$options['vtm_clr_normal_thumbnail_size_x'].') <br/>'; 
		if (!$options)
		{
			//echo 'RENEW ';
			$options = get_option('vtm_clr_options');
			$defaults = & self::getDefaults();
//if ($renew) {echo "!----";print_r($defaults);}
			//if (is_admin())
			{
				foreach ($defaults as $id=>$value)
				{
					if (!isset($options[$id]))
					{
						$options[$id] = $value;
					}
				}
				update_option('vtm_clr_options', $options);
			}
			//echo "!----";print_r($options);
			if (!is_array($options)) 
			{
				$options = & self::getDefaults();
				update_option('vtm_clr_options', $options);
			}
			stripslashes_deep ($options);
			//var_dump($options);
		}
		//echo 'end getOptions ('.$options['vtm_clr_normal_thumbnail_size_x'].') <br/>'; 
		if ($option_name) return $options[$option_name];
		return $options;
	}
	function & getValueSets($valueset_name='')
	{
		static $value_sets = null;
		if (!$value_sets)
		{
			include (str_replace('//','/',dirname(__FILE__)).'/value_sets.php');
		}
		if ($valueset_name) return $value_sets[$valueset_name];
		return $value_sets;
	}
	function & getDefaults()
	{
		static $default_values = null;
		if (!$default_values)
		{
			$vtm_clr_admin_options = & self::getAdminOptions();
			foreach ($vtm_clr_admin_options as $k=>$v)
			{
				if (is_array($v['std']) && is_array($v['valueset']))
				{
					foreach ($v['std'] as $sub_key=>$sub_value)
					{
						if (is_array($sub_value))
						{
							foreach ($sub_value as $arr_key => $arr_value)
							{
								$default_values [$k.'_'.$sub_key.'_'.$arr_key] = $arr_value;
							}
						}
						else 
						{
							$default_values [$k.'_'.$sub_key] = $sub_value;
						}
					}
				}
				else
				{
					if (is_array($v['std']))
					{
						foreach ($v['std'] as $arr_key => $arr_value)
						{
							$default_values [$k.'_'.$arr_key] = $arr_value;
						}
					} else
						$default_values [$k] = $v['std'];
				}
				if (isset($v['inherit']['std']))
				{
					$default_values [$k.'_inherit'] = $v['inherit']['std'];
				}
			}
		}
		//if ($option_name) return $options[$default_values];
		return $default_values;
	}
	function & getOptionsCategories()
	{
		static $options_categories = null;
		
		if (!$options_categories)
		{
			include (str_replace('//','/',dirname(__FILE__)).'/options_categories.php');
			if (!$options_categories)
			{
				$admin_options = & self::getAdminOptions();
				foreach ($admin_options as $v)
					$options_categories[$v['category']]=array('description'=>null);
			}
		}
		return $options_categories;
		
	}
	function replaceDescriptionVariables($desc)
	{
		static $template_url = '';
		if ($template_url === '') $template_url = get_bloginfo ('template_url');
		$option_count = self::countOptions();
		$replace_vars = array(
			'${template_url}'	=>	$template_url,
			'${option_count[\'full-fledged\']}'	=>	$option_count['size'],
			'${option_count[\'sub-options\']}'		=>	$option_count['total_count'],
		);
		$search = array_keys($replace_vars);
		$replace = array_values($replace_vars);
		return str_replace ($search, $replace, $desc);
	}
	function getInherited($option_name,$sub_option_key)
	{
		$inherided = self::getInheritedOption($option_name,$sub_option_key);
		return $inherided['value'];
	}
	function echoInherited($option_name,$sub_option_key)
	{
		$inherided = self::getInherited($option_name,$sub_option_key);
		echo $inherided;
	}
	function getInheritedOption($option_name,$sub_option_key, $level=1)
	{
		//echo 'level='.$level.'<br>';
		//echo '$option_name='.$option_name.'<br>';
		//echo '$option_name='.print_r(debug_backtrace(),true).'<br>';
		
		$value='Inherited value not found';
		$option_name_full = $option_name . (($sub_option_key)? '_' . $sub_option_key : '');
		$option = & self::getOptions($option_name_full);
		$admin_option = & self::getAdminOptions($option_name);
		$inherit_option = & self::getOptions($admin_option['id'] . '_inherit');
		if (!$inherit_option && isset($admin_option['inherit']['std'])) $inherit_option = $admin_option['inherit']['std'];
		//echo '$inherit_option='.$inherit_option.'<br>';
		
		$valueset_name = ($sub_option_key)?$admin_option['valueset'][$sub_option_key] : $admin_option['valueset'];
		
		if (isset ($inherit_option) && $inherit_option !=='none' && 
				(
					isset($admin_option['inherit']['from'][$inherit_option][$sub_option_key])
					|| 
					!is_array($admin_option['inherit']['from'][$inherit_option])
				)
			)
		{
			//echo 'INHERITED'.'<br>';
			
			$parent_admin_option = & self::getAdminOptions($inherit_option);
			//echo '$parent_admin_option='.print_r($parent_admin_option,true).'<br>';
			
			$parent_inherit_option = & self::getOptions($parent_admin_option['id'] . '_inherit');
			//echo '$parent_inherit_option='.$parent_inherit_option.'<br>';
			$parent_sub_option_key = ((is_array($admin_option['inherit']['from'][$inherit_option])?($admin_option['inherit']['from'][$inherit_option][$sub_option_key]):$admin_option['inherit']['from'][$inherit_option]));
			
			if (isset ($parent_inherit_option) && $parent_inherit_option !=='none' && 
				(
					isset($parent_admin_option['inherit']['from'][$parent_inherit_option][$parent_sub_option_key])
					|| 
					!is_array($parent_admin_option['inherit']['from'][$parent_inherit_option])
				)
			)
			{
				if ($level<10)	$value = self::getInheritedOption($inherit_option,$parent_sub_option_key, $level+1);
			}
			else
			{

				$valueset_name = ($parent_sub_option_key)?$parent_admin_option['valueset'][$parent_sub_option_key] : $parent_admin_option['valueset'];
				$value = self::getOptions($parent_admin_option['id'] . (($parent_sub_option_key)? '_' . $parent_sub_option_key : ''));
			}
			
		}
		else
		{
			$value=$option;
		}
		//echo 'value='.print_r($value,true).'<br/>';
		return is_array($value)?$value:array('value'=>$value,'valueset_name'=>$valueset_name);
	}
	
	
	function displaySingleOptionField($valueset,$admin_option,$sub_option_key)
	{
		$br ='';
		$option_name = $admin_option['id'] . (($sub_option_key)? '_' . $sub_option_key : '');
		$std = (($sub_option_key)? $admin_option['std'][$sub_option_key] : $admin_option['std']);
		$option = & self::getOptions($option_name);
		$inherit_option = & self::getOptions($admin_option['id'] . '_inherit');
		
		$template_url = get_bloginfo ('template_url');
		$class='';
		
		if (isset ($inherit_option) && $inherit_option !=='none' && 
				(
					isset($admin_option['inherit']['from'][$inherit_option][$sub_option_key])
					|| 
					!is_array($admin_option['inherit']['from'][$inherit_option])
				)
			)
		{
			//print_r ($admin_option);
			$class='class="mouse-over-opacity"';
		}
		
		echo '<div style="margin-right:5px;float:left;" '.$class.'>';
		if (isset($admin_option['before']))
		{
			$before = ((is_array($admin_option['before']))?
						((isset($admin_option['before'][$sub_option_key]))?$admin_option['before'][$sub_option_key]:'')
					   :
						((isset($admin_option['before']))?$admin_option['before']:''));
		}
		if (!empty($before))
		{
			echo '<div style="margin-right:5px;float:left;line-height:24px;">';
				echo $before.' ';
			echo '</div>';
		}
		switch ($valueset['input_type'])
		{
			case 'select':
				echo '<select name="'.$option_name.'">';
				$selected = (($option)? $option : $std);
				foreach ($valueset['values'] as $value => $diplay_text)
				{
					echo '<option value="'.$value.'"'.(($selected ==$value)?'selected="selected"':'').'" '
						. (isset($valueset['styles'])?' style="' . $valueset['styles'][$value] . '" ':'')
						. (isset($valueset['class'])?' class="' . $valueset['class'][$value] . '" ':'')
						. '>'.$diplay_text.'</option>';
				}
				echo '</select>'."\n";
				break;
			case 'text':
				if (isset($admin_option['width']))
				{
					$width = (isset($admin_option['width'][$sub_option_key]))?$admin_option['width'][$sub_option_key]
							:((!is_array($admin_option['width']))?$admin_option['width']:'');
				} else $width = 8;
				echo '<input type="text" name="'.$option_name
					.'" value="'.((!is_null($option))?$option:$std).'" '.(($width)? "size=\"$width\"":'').'>';
				break;
				
			case 'checkbox':
				$width = (isset($admin_option['width'][$sub_option_key]))?$admin_option['width'][$sub_option_key]
						  :((!is_array($admin_option['width']))?$admin_option['width']:'');
				$column_width = (isset($admin_option['column_width'][$sub_option_key]))?$admin_option['column_width'][$sub_option_key]
						  :((!is_array($admin_option['column_width']))?$admin_option['column_width']:'');
				echo "<div style=\"width:${width}px;\">";

				foreach ($valueset['values'] as $value => $diplay_text)
				{
					$option = & self::getOptions($option_name . '_' . $value);
					$std_value = (is_array($std))?((isset($std[$value]))?$std[$value]:0):$std;

					$field_name = $option_name . '_'.$value;

					$checked = (($option)? $option : $std_value);

					$checked = ($checked === 'on')?' checked="checked" ':'';
					echo "<div  style=\"width:${column_width}px; float:left;\">" 
						. '<input type="checkbox" name="' . $field_name . '" ' . $checked .' id="' . $field_name . '">'
						. '<label for="'.$field_name.'" '.((isset($valueset['styles']))?' style="' . $valueset['styles'][$value] . '" ':'')
						. ((isset($valueset['class']))?' class="' . $valueset['class'][$value] . '" ':'')
						. '>'.$diplay_text . '</label></div>';
				}
				echo '<div class="clear"></div></div>';
				break;	
				
			case 'textarea':
				$cols = (isset($admin_option['cols'][$sub_option_key]))?$admin_option['cols'][$sub_option_key]
						  :((isset($admin_option['cols']) && !is_array($admin_option['cols']))?$admin_option['cols']:'60');
				$rows = (isset($admin_option['rows'][$sub_option_key]))?$admin_option['rows'][$sub_option_key]
						  :((isset($admin_option['rows']) && !is_array($admin_option['rows']))?$admin_option['rows']:'2');
				echo '<textarea name="'.$option_name . '" cols="'.$cols.'" rows="'.$rows.'" >' 
					. ((!is_null($option))?$option:$std)
					. '</textarea>';
				break;
			
			case 'radio_image':
				echo '<div class="image-select">';
				$selected = ((!is_null($option))?$option:$std);
				foreach ($valueset['values'] as $value => $img_file_name)
				{
					echo '<div class="alignleft' . (($selected==$value)?' img-selected':'') . 
						'" value="' . $value . '" data-value="' . $value.'">';
						echo '<img src="' . $template_url . '/options/img/' . $img_file_name . '"'
						. ' title="' . (($valueset['alt'][$value])?$valueset['alt'][$value]:$img_file_name) . '"'
						. '>';
					echo '</div>'."\n";
				}
				echo '<input type="hidden"  name="' . $option_name .'" id="' . $option_name . '" value="' . $selected . '">';
				echo '<div class="clear"></div>'."\n";
				echo '</div>';
				break;
			
			case 'color':
				if (isset($admin_option['width']))
				{
					$width = (isset($admin_option['width'][$sub_option_key]))?$admin_option['width'][$sub_option_key]
							:((!is_array($admin_option['width']))?$admin_option['width']:'');
				} else $width = 8;
				echo '<div class="colorSelector" id="' . $option_name . '-div"><div style="background-color:'.((!is_null($option))?$option:$std).'"></div></div>';
				echo '<input type="text" name="'.$option_name .'" id="' . $option_name . '"' 
					.'" value="'.((!is_null($option))?$option:$std)."\" size=\"$width\"" .'>';
				?>
				<script>
				jQuery(document).ready	(function($)
				{

					$('#<?php echo $option_name?>-div').ColorPicker({
						color: $('#<?php echo $option_name?>').val(),
						onShow: function (colpkr) {
							$(colpkr).fadeIn(200);
							return false;
						},
						onBeforeShow: function () {
							$(this).ColorPickerSetColor($('#<?php echo $option_name?>').val());
						},

						onHide: function (colpkr) {
							$(colpkr).fadeOut(200);
							return false;
						},
						onChange: function (hsb, hex, rgb) {
							$('#<?php echo $option_name?>-div div').css('backgroundColor', '#' + hex);
							//$('#<?php echo $option_name?>').css('backgroundColor', '#' + hex);
							$('#<?php echo $option_name?>').val('#'+hex);
						}
					});
				});
				</script>
				<?php
				break;
		}
		if (isset($admin_option['after']))
		{
			$after = ((is_array($admin_option['after']))?
						((isset($admin_option['after'][$sub_option_key]))?$admin_option['after'][$sub_option_key]:'')
					   :
						((isset($admin_option['after']))?$admin_option['after']:''));
		}
		if (!empty($after))
		{
			$br = substr($after, -4);
			if ($br==='<br>')
			{
				$after = substr($after, 0, -4);
			}
			if (!empty($after))
			{
				echo '<span style="margin-left:5px;line-height:24px;">';
					echo $after.' ';
				echo '</span>';
			}
		}		

		echo '</div>';
		if ($br==='<br>')
		{
			echo '<div class="clear"></div>';
		}
	}
	function displaySingleInheritedField($valueset,$admin_option,$sub_option_key)
	{
		$valuesets = & self::getValueSets();
		$option_name = $admin_option['id'] . (($sub_option_key)? '_' . $sub_option_key : '');
		$option = & self::getOptions($option_name);
		$inherited = self::getInheritedOption($admin_option['id'],$sub_option_key);
		echo '<div style="margin-right:5px;float:left">';
			switch ($valueset['input_type'])
			{
				case 'text':
					echo $inherited['value'];
					break;
				case 'select':
					echo $inherited['value'];
					break;
				case 'radio_image':
					echo $valuesets[$inherited['valueset_name']]['alt'][$inherited['value']];
					break;
				case 'color':
					echo '<span style = "line-height:24px;padding:2px;background-color:'.$inherited['value'].'">'.$inherited['value'].'</span>';
					break;
			}
			//echo '---------------------------------------'.$admin_option['id'].','.$sub_option_key.'-';
			//echo '='.self::getInheritedOption($admin_option['id'],$sub_option_key).'=';
		echo '</div>';
	}
	function displaySingleAdminOption($option_name)
	{
		static $desc;
		if (!$desc)
		{
			include (str_replace('//','/',dirname(__FILE__)).'/option_descriptions.php');
			$desc = $option_descriptions;
			//var_dump($desc);
		}
		
		$valuesets = & self::getValueSets();
		$options = & self::getOptions();
		$admin_option = & self::getAdminOptions($option_name);
		$shortname = & self::cfg('shortname');

		echo '<div class="'.self::cfg('style-prefix').'-admin-option">'; // start of a single admin option
			echo '<div class="'.self::cfg('style-prefix').'-admin-option-name" name="'.$admin_option['id'].'" id="'.$admin_option['id'].'-option-help"><b>' 
				. ((isset($desc[$admin_option['id']]))?$desc[$admin_option['id']]['title'] :$admin_option['title']).'</b>'
				. '</div>';
			echo '<div class="'.self::cfg('style-prefix').'-admin-option-value'
				. '" id="div-'.$admin_option['id'].'">';
			
			
			if (isset ($admin_option['inherit']))
			{
				echo '<div style="margin-right:5px;float:left">';
				echo 'Inherit from <select name="'.$admin_option['id'].'_inherit">';
				echo '<option value="none">'.__('none',THEME_DOMAIN).'</option>';
				foreach ($admin_option['inherit']['from'] as $inherit_option_name =>$v)
				{
					$inherit_option = & self::getAdminOptions($inherit_option_name);
					//$inhrit_from = 
					//echo $options[$option_name . '_inherit'].'='.$inherit_option['id'].'<br>';
					echo 
					'<option value="'.$inherit_option['id'].'" '.
						(($options[$option_name . '_inherit']===$inherit_option['id'])?'selected="selected"':'').'>'.
						$inherit_option['title'].
						//gettype($options[$option_name . '_inherit']).'='.gettype($inherit_option['id']).
					'</option>';
				}
				echo '</select>';
				echo '</div>';
				if (isset($options[$option_name . '_inherit']) && $options[$option_name . '_inherit'] !=='none')
				{
					$sub_options = $admin_option['inherit']['from'][$options[$option_name . '_inherit']];
					if (is_array($sub_options))
					{
						foreach ($sub_options as $sub_option_key =>$inherit_sub_option_key)
						{
							$valueset_name = ($sub_option_key)?$admin_option['valueset'][$sub_option_key] : $admin_option['valueset'];
							self::displaySingleInheritedField($valuesets[$valueset_name],$admin_option,$sub_option_key);
						}
					}
					else
					{
					//TODO:
						$valueset_name = ($sub_option_key)?$admin_option['valueset'][$sub_option_key] : $admin_option['valueset'];
						self::displaySingleInheritedField($valuesets[$valueset_name],$admin_option,'');
					}
				}
				echo '<div style="clear:both;"></div>'."\n";
			}
			
			if (is_array($admin_option['valueset']))
			{
				foreach( $admin_option['valueset'] as $sub_option_key=>$valueset_name)
					self::displaySingleOptionField($valuesets[$valueset_name],$admin_option,$sub_option_key);
			}
			else
				self::displaySingleOptionField($valuesets[$admin_option['valueset']],$admin_option, '');
			//echo '<div style="clear:both;"></div>'."\n";
			echo '</div>'."\n"; //admin-option-value
			echo '<div style="clear:both;"></div>'."\n";
			if (isset($desc[$admin_option['id']]) && isset($desc[$admin_option['id']]['desc'])) $option_description = $desc[$admin_option['id']]['desc'];
			elseif (isset($admin_option['description'])) $option_description = $admin_option['description'];

			echo '<div class="'.self::cfg('style-prefix').'-admin-option-descr" id="'.$admin_option['id'].'-admin-option">';
				echo self::replaceDescriptionVariables($option_description);
			echo '</div>'; //admin-option-descr
			echo '<div style="clear:both;"></div>';
		echo '</div><!-- end of a single admin option -->'."\n"; // end of a single admin option
		
	}
	function displayCategoryAdminOptions($category)
	{
		$admin_options = & self::getAdminOptions();
		$categories = & self::getOptionsCategories();
		echo '<div class="'.self::cfg('style-prefix') . '-category-options' . '" id="'.self::cfg('style-prefix') . '-category-'.str_replace(' ','_',$category).'-options">';
		if ($categories[$category]['description'])
		{
			echo '<div class="'.self::cfg('style-prefix').'-admin-option">';
				echo self::replaceDescriptionVariables($categories[$category]['description']);
			echo '</div>';
		}
		
		foreach ($admin_options as $option_name => $option)
		{
			if ($option['category'] === $category)
				self::displaySingleAdminOption($option_name);
		}
		echo '</div>';
	}
	function countOptions()
	{
		$admin_options = & self::getAdminOptions();
		$a['size'] =  sizeof($admin_options);
		$total_count=0;
		foreach ($admin_options as $k=>$v)
		{
			$total_count += sizeof($v['valueset']);
		}
		$a['total_count'] = $total_count;
		return $a;
	}
	function displayAdminOptions()
	{
		$categories = & self::getOptionsCategories();
		$options = & self::getOptions('');

		echo '<form action="#" method="post" enctype="multipart/form-data" name="'. self::cfg('shortname').'_form">';
		//var_dump ($categories);
		echo '<div class="'.self::cfg('style-prefix') . '-categories">';
			foreach ($categories as $category => $v)
			{
				if (!isset($v['display_name'])) $v['display_name'] = $category;
				echo '<div class="'.self::cfg('style-prefix') . '-category-button' . '" id="'.self::cfg('style-prefix') . '-category-'.str_replace(' ','_',$category).'-button">'
						. $v['display_name']
					. '</div>';
			}
		echo '</div>';
		//print_r ($categories);
		foreach ($categories as $category => $v)
			self::displayCategoryAdminOptions($category);
		echo '<div class="clear"></div><br/><br/>';
		echo '<input type="hidden" name="'. self::cfg('shortname') . '-current-tab'.'" id="'. self::cfg('shortname') . '-current-tab'.'"/><br/>';
		echo '<div id="save"><input type="submit" value="Save options" class="save" name="'. self::cfg('shortname') . '_save_options'.'"/></div><br/><br/><br/><br/><br/><br/><br/>';
		
		echo '<input type="submit" class="reset-options" value= "Reset ALL Options" name="'. self::cfg('shortname') . '_reset_options'.'"/><br/><br/><br/>';
		if (SHOW_DEVELOPER_TOOLS)
		{
			echo 'Developer tools <br/>';
			echo '<input type="submit" class ="dev" value= "Show Option Descriptions" name="'. self::cfg('shortname') . '_show_options_decription'.'"/>';
		}
		echo '</form>';
		?>
		<script>
		//alert ('---------------------');
		jQuery(document).ready(function($) 
		{ 
			var prefix='<?php echo self::cfg('style-prefix');?>';
			var shortname ='<?php echo self::cfg('shortname');?>';
			//alert ("."+prefix+"-category-button");
			var set_tab = "<?php echo ((isset($_POST[self::cfg('shortname').'-current-tab']))?$_POST[self::cfg('shortname').'-current-tab']:'') ?>";

			$("."+prefix+"-category-button").click(function()
			{
				var buttonid = $(this).attr('id');				
				//alert(id);
				var id = buttonid.substr(0, buttonid.length-7)+'-options';
				//alert(id);
				$("."+prefix+"-category-options").hide();
				$("#"+id).show();
				//alert ("#"+shortname+"-current-tab");
				$("#"+shortname+"-current-tab").val(buttonid);
				$("."+prefix+"-category-button").removeClass('selected');
				$(this).addClass('selected');

			});

			if (set_tab)
			{
				//$("."+prefix+"-category-options").hide();
				//$("#"+set_tab).show();
				//$("#"+shortname+"-current-tab").val(set_tab);
				$("#"+set_tab).click();
			} else
			{
				$("."+prefix+"-category-button:first").click();
			}
			
			$("."+prefix+"-admin-option-name").click(function(){
				var helpid = '#'+$(this).attr('name')+'-admin-option';
				//alert($(helpid).css('display'));
				if ($(helpid).css('display')=='none') $("."+prefix+"-admin-option-descr").slideUp(200);
				$(helpid).slideToggle(200);
			});
			
			$("div.image-select > div[class!=clear]").click(function(){
				
				var id=$(this).parent().parent().parent().attr('id');
				//alert ('id = '+ id);
				$('#'+id+' div.img-selected').removeClass('img-selected');
				id = id.substr(4);
				//alert ('id.substr(4) = '+ id);
				$(this).addClass('img-selected');
				if ($(this).attr('value')) 				// WP velsion 3.1 and less compatibility
					$("#"+id).val($(this).attr('value'));
				else
					$("#"+id).val($(this).data('value')); // WP version 3.2+
			});
			
			$("div.image-select > div[class!=clear]").mouseenter(function(){
				$(this).addClass('hover');
			});

			$("div.image-select > div[class!=clear]").mouseleave(function(){
				$(this).removeClass('hover');
			})
			
		});
		</script>
		<?php
	}
	function getOptionNewValue ($option_name, $new_value, $valueset_name, $std)
	{
		//$admin_option = & self::getAdminOptions($option_name);
		$valueset = & self::getValueSets($valueset_name);
		//$tmp = null;
		
		if (is_null($new_value)) return $std;
		
		switch ($valueset['validate'])
		{
			case 'integer':
				if ((string)(int)$new_value === (string) $new_value) return (int)$new_value;
				if (intval($new_value)>0) return intval($new_value);
				return $std;
				break;
			case 'float':
				$new_value = str_replace(',' , '.', $new_value);
				if (floatval($new_value)>0) return floatval($new_value);
				return $std;
			case 'string':
				return stripslashes((string)$new_value);
				break;
		}
	}
	function getLayoutCSS()
	{
		global $wp_query;
		if (strpos($_SERVER["SERVER_NAME"], 'wp-themes.com') !== false) return '4_right_sidebars';

		$page_templates = array(
			'pg-tpl-1-left-sidebar.php'=>'left_sidebar',
			'pg-tpl-1-right-sidebar.php'=>'right_sidebar',
			'pg-tpl-2-left-sidebars.php'=>'2_left_sidebars',
			'pg-tpl-2-right-sidebars.php'=>'2_right_sidebars',
			'pg-tpl-4-left-sidebars.php'=>'4_left_sidebars',
			'pg-tpl-4-right-sidebars.php'=>'4_right_sidebars',
			'pg-tpl-left-right-sidebars.php'=>'left_right_sidebars',
			'pg-tpl-no-sidebars.php'=>'no_sidebars',
		);
		$options = & self::getOptions();
		$shortname = self::cfg('shortname');
		if (is_home() || is_front_page() ) return self::getInherited($shortname.'_index_sidebars','');
		if (is_single()) 	return self::getInherited($shortname.'_single_post_sidebars','');
		if (is_page()) 
		{
			$id = (int) $wp_query->get_queried_object_id();
			$template = get_post_meta($id, '_wp_page_template', true);
			if (isset($page_templates[$template])) return $page_templates[$template];
			//else
			return self::getInherited($shortname.'_single_page_sidebars','');
		}
		if (is_category()) 	return self::getInherited($shortname.'_category_sidebars','');
		if (is_tag()) 		return self::getInherited($shortname.'_tag_sidebars','');
		if (is_search()) 	return self::getInherited($shortname.'_search_sidebars','');
		if (is_404()) 		return self::getInherited($shortname.'_404_sidebars','');
		if (is_date()) 		return self::getInherited($shortname.'_archive_sidebars','');
		if (is_author()) 	return self::getInherited($shortname.'_category_sidebars','');

		return self::getInherited($shortname.'_other_sidebars','');;
	}
	function resetOptions()
	{
		$shortname = self::cfg('shortname');
		delete_option($shortname .'_options');
		//echo 'RESET ';
	}
	function echoOptionDescriptions()
	{
		include (str_replace('//','/',dirname(__FILE__)).'/option_descriptions.php');
		header('Content-Type: text/plain');
		$admin_options = & self::getAdminOptions();
		$shortname = self::cfg('shortname');
		$sl = strlen($shortname);
		//$option_descriptions = array();
		echo '$shortname = & self::cfg(\'shortname\');\n';
		echo '$option_descriptions = array('."\n";
		foreach ($admin_options as $id => $option)
		{
			$option_descriptions[$id]['desc'] = str_replace("\r\n", "\n", $option_descriptions[$id]['desc']);
			$truncated_id = substr($id, $sl);
			echo "\t".'$shortname . \'' . $truncated_id .'\' => array('."\n";
			echo "\t\t".'\'title\' => __(\''. addcslashes(stripslashes(($option_descriptions[$id]['title'])?$option_descriptions[$id]['title']:$option['title']), "'") .'\', THEME_DOMAIN),'."\n";
			echo "\t\t".'\'desc\' => __(\''. addcslashes(stripslashes(($option_descriptions[$id]['desc'])?$option_descriptions[$id]['desc']:$option['description']), "'") .'\', THEME_DOMAIN),'."\n";
			echo "\t),\n";
		}
		echo ');';
	}
	
	function echoInlineCSS()
	{
		//require_once 'options/inline.css.php';
		ob_start();
		get_template_part( 'options/inline.css');
		
		$css = ob_get_contents();
		ob_end_clean();
		
		$css = str_replace(array("\r\n\t","\r\n","\t"),array(' ',' '), $css);
		
		echo '<style type="text/css">' . $css . '</style>';
	}
	
	
	function adminMenu() 
	{
		$shortname = self::cfg('shortname');
		if(isset($_POST[$shortname . '_reset_options']))
		{
			self::resetOptions();
		}
		if(isset($_POST[$shortname . '_show_options_decription']))
		{
			//developer
			self::echoOptionDescriptions();
			die();
		}
		$options = & self::getOptions('', true);
		$admin_options = & self::getAdminOptions();
		$valuesets = & self::getValueSets();
		
		if(isset($_POST[$shortname . '_save_options'])) 
		{
			//var_dump($_POST);
			// meta
			//echo 'SAVED <br>';
			foreach  ($admin_options as $option_name => $admin_option)
			{
				//print_r ( $admin_option); echo "<br><br>\n\n";
				
				if (!is_array($admin_option['valueset']))
				{
					//if ($admin_option['valueset']=='SOCIAL') echo '!is_array($admin_option[valueset])';
					$valueset_name = $admin_option['valueset'];
					if (isset($valuesets[$valueset_name]['multiselect']) && $valuesets[$valueset_name]['multiselect'])
					{
						
						foreach ($valuesets[$valueset_name]['values'] as $k=>$v)
						{
							//if ($admin_option['valueset']=='SOCIAL') echo $k.'-';
							
							$option_value = isset($_POST[$option_name . '_' .$k])?$_POST[$option_name . '_' .$k]:'off';
							if (!$option_value) $option_value = 'off';
							//if ($admin_option['valueset']=='SOCIAL') echo "option_value = $option_value  $option_value | ";
							$options[$option_name . '_'.$k] = 
								self::getOptionNewValue($option_name . '_'.$k, $option_value,$valueset_name,$admin_option['std'][$k]);
						}
					}
					else
					{
						$option_value = $_POST[$option_name];
						$options[$option_name] = self::getOptionNewValue($option_name, $option_value, $admin_option['valueset'], $admin_option['std']);
					}
				} else
				{
					foreach($admin_option['valueset'] as $sub_name=>$valueset_name)
					{
						//echo "$sub_name" ;print_r ( $valueset_name); echo "<br><br>\n\n";
						if (isset($valuesets[$valueset_name]['multiselect']) && $valuesets[$valueset_name]['multiselect'])
						{
							foreach ($valuesets[$valueset_name]['values'] as $k=>$v)
							{
								$option_value = isset($_POST[$option_name . '_' . $sub_name . '_'.$k])?$_POST[$option_name . '_' . $sub_name . '_'.$k]:'off';
								if (!$option_value) $option_value = 'off';
							
								$options[$option_name . '_' . $sub_name. '_'.$k] = 
									self::getOptionNewValue($option_name . '_' . $sub_name. '_'.$k, $option_value,$valueset_name,$admin_option['std'][$sub_name][$k]);
							}
						}
						else
						{
							$option_value = $_POST[$option_name . '_' . $sub_name];
							$options[$option_name . '_' . $sub_name] = 
								self::getOptionNewValue($option_name . '_' . $sub_name, $option_value,$valueset_name,$admin_option['std'][$sub_name]);
						}
					}
				}
				if (isset($admin_option['inherit'])) //TODO: inherit checkbox valuesets
				{
					$option_value = $_POST[$admin_option['id'].'_inherit'];
					$options[$admin_option['id'].'_inherit'] = ($option_value)?$option_value:$admin_option['inherit']['std'];
				}
			}
			//$options[$shortname .'_blog_title_font_size'] = (int)($_POST[$shortname .'_blog_title_font_size']);
			//print_r($options);
			$options['last_update_time'] = time();
			update_option('vtm_clr_options', $options);
			//$options = & self::getOptions('', true);
			//print_r(self::getOptions());

		}

		add_theme_page(__("Clear Line Theme Options"), __("Clear Line Theme Options"), 
				'edit_themes', basename(__FILE__), array('ClearLineOptions', 'displayAdminOptions'));
	} //adminMenu

} //ClearLineOptions