<?php

/**
 * 
 *
 * @version $Id$
 * @copyright 2003 
 **/

class shortcode_calendarize {
	var $id = 0;
	var $added_footer = false;
	var $wp_footer = '';
	var $event_list_templates = array();
	var $capabilities = array();
	function shortcode_calendarize($args=array()){
		$defaults = array(
			'capabilities'				=> array(
				'calendarize_author'	=> 'calendarize_author'
			)
		);
		foreach($defaults as $property => $default){
			$this->$property = isset($args[$property])?$args[$property]:$default;
		}	
		//---------
		
		
		add_shortcode(SHORTCODE_CALENDARIZE, array(&$this,'calendarize'));
		add_shortcode(SHORTCODE_CALENDARIZEIT, array(&$this,'calendarizeit'));
		add_shortcode('btn_ical_feed', array(&$this,'sc_ical_feed'));
		
		add_shortcode('rhc_start_date', array(&$this,'handle_date_shortcode'));
		add_shortcode('rhc_end_date', array(&$this,'handle_date_shortcode'));
		
		add_shortcode('rhc_upcoming_events', array(&$this,'rhc_upcoming_events'));
	}
	
	function rhc_upcoming_events($atts,$content=null,$code=""){
		$output='';

		$fields = array(
			'number'			=> 5,
			'fcdate_format'		=> 'MMM d, yyyy',
			'fctime_format'		=> 'h:mmtt',
			'post_type'			=> false,
			'template'			=> false,
			'calendar'			=> false,
			'venue'				=> false,
			'organizer'			=> false,
			'words'				=> '1000',
			'horizon'			=> 'hour',
			'showimage'			=> '1',
			'loading_method'	=> 'ajax',
			'auto'				=> 0,
			'calendar_url'		=> '',
			'taxonomy'			=> false,
			'terms'				=> false,
			'premiere'			=> '0'
		);
		
		foreach($fields as $field => $default){
			if(isset($atts[$field])){
				$instance[$field]=$atts[$field];
			}else if(false!==$default){
				$instance[$field]=$default;
			}
		}

		if(''!=$instance['post_type']){
			$arr=explode(',',$instance['post_type']);
			if(is_array($arr)&&count($arr)>0){
				$instance['post_type']=array();
				foreach($arr as $post_type){
					$instance['post_type'][]=$post_type;
				}
			}
		}
		
		foreach( array('calendar'=>RHC_CALENDAR,'venue'=>RHC_VENUE,'organizer'=>RHC_ORGANIZER) as $field => $taxonomy ){
			if( isset($instance[$field]) && false!=$instance[$field] ){
				$term = get_term_by('slug', $instance[$field], $taxonomy);
				if(false!=$term){
					$instance[$field]=$term->term_id;
				}else{
					$instance[$field]=false;
				}					
			}
		}		

		ob_start();
		the_widget('UpcomingEvents_Widget',$instance);
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
	
	function get_bool($value){
		return (in_array(trim(strtolower($value)),array('1','yes','y','true','s')))?true:false;
	}
	
	function calendarizeit($atts,$content=null,$code=""){
		return do_shortcode(generate_calendarize_shortcode($atts));
	}
	
	function calendarize($atts,$content=null,$code=""){
		require 'class.shortcode_calendarize.calendarize.php';

		if(isset($taxonomy) && isset($terms) && RHC_VENUE==$taxonomy){
			if( $t=get_term_by('slug',$terms,$taxonomy) ){
				if( $t->count==0 ){
					return '';
				}			
			}
		}

		return sprintf('<div id="%s" class="rhcalendar %s rhc_holder" data-rhc_ui_theme="%s" data-rhc_options="%s"><div class="fullCalendar"></div>%s%s<div style="clear:both"></div></div>',
			$id,
			$class,
			(trim($theme)==''?'':$this->get_ui_theme_url($theme)),
			htmlspecialchars($this->get_calendarize_args($options,$atts)),
			$this->calendars_form($post_type),
			$this->icalendar_dialog($icalendar,$icalendar_title,$icalendar_description,$icalendar_button,$icalendar_width,$icalendar_align)
		);
	}
	
	function replace_att_with_posted($atts){
		if(isset($atts['ignoreposted'])&&$atts['ignoreposted']==1)return $atts;
		global $rhc_plugin;
		$str = $rhc_plugin->get_option('postable_args','',true);
		$str = str_replace("\n","",trim($str));
		$str = str_replace("\r","",trim($str));
		$arr = explode(',',$str);
		$arr = is_array($arr)?$arr:array();
		$arr[]='defaultview';
		$arr[]='gotodate';
		
		foreach($arr as $field){
			if(isset($_REQUEST[$field])){
				$atts[$field]=$_REQUEST[$field];
			}
		}
		foreach(array('venue','calendar','organizer') as $_field){
			$field = 'f'.$_field;
			if(isset($_REQUEST[$field])){
				$atts[$_field]=$_REQUEST[$field];
			}
		}		
	
		return $atts;
	}
	
	function get_ui_theme_url($theme){
		$url = sprintf('%sui-themes/%s/style.css',RHC_URL,$theme);
		return apply_filters('rhc_ui_theme_url',$url,$theme);
	}
	
	function get_calendarize_args($options,$atts){
		$options = apply_filters('get_calendarize_args_options',$options,$atts);
		$out = json_encode($options); 
		$out = apply_filters('get_calendarize_args_output',$out);
		foreach(array('fc_select','fc_click','no_link','fc_mouseover') as $method_name){
			$out = str_replace('"'.$method_name.'"',$method_name,$out);
		}
		return $out;
	}
	
	function wp_footer(){	
		$this->items_tooltip();
		echo $this->wp_footer;		
	}
	
	function calendarize_form_fields($t){
		$i = count($t);
		//--Custom Post Types -----------------------		
		$i++;
		$t[$i]->id 			= 'cbw-custom-types'; 
		$t[$i]->label 		= __('Custom Post Types','rhc');
		$t[$i]->right_label	= __('Enable calendar metabox for other post types.','rhc');
		$t[$i]->page_title	= __('Custom Post Types','rhc');
		$t[$i]->theme_option = true;
		$t[$i]->plugin_option = true;
		$t[$i]->options = array();
		
		//--------------
		$post_types=array();
		foreach(get_post_types(array(/*'public'=> true,'_builtin' => false*/),'objects','and') as $post_type => $pt){
			if(in_array($post_type,array('revision','nav_menu_item')))continue;
			$post_types[$post_type]=$pt;
		} 
		$post_types = apply_filters('calendar_metabox_post_type_options',$post_types);
		//--------------		
		if(count($post_types)==0){
			$t[$i]->options[]=(object)array(
				'id'=>'no_ctypes',
				'type'=>'description',
				'label'=>__("There are no additional Post Types to enable.",'rhc')
			);
		}else{
			$j=0;
			foreach($post_types as $post_type => $pt){
				$tmp=(object)array(
					'id'	=> 'post_types_'.$post_type,
					'name'	=> 'post_types[]',
					'type'	=> 'checkbox',
					'option_value'=>$post_type,
					'label'	=> (@$pt->labels->name?$pt->labels->name:$post_type),
					'el_properties' => array(),
					'save_option'=>true,
					'load_option'=>true
				);
				if($j==0){
					$tmp->description = __("Calendarizer metabox can be enabled for other post types.  Check the post types, where you want the calendar metabox to be displayed.",'rhc');
					$tmp->description_rowspan = count($post_types);
				}
				$t[$i]->options[]=$tmp;
				$j++;
			}
		}
		
		
		$t[$i]->options[]=(object)array(
				'type'=>'clear'
			);
		$t[$i]->options[]=(object)array(
				'type'	=> 'submit',
				'label'	=> __('Save','rhc'),
				'class' => 'button-primary'
			);
			
		return $t;	
	}
	
	function calendarize_form(){
		global $rhc_plugin;
		$this->fc_intervals = $rhc_plugin->get_intervals();
		include $rhc_plugin->get_template_path('calendarize_form.php');				
	}
	
	function calendars_form_tabs($post_type){
		$taxonomies = get_object_taxonomies(array('post_type'=>$post_type),'objects');
		if(!empty($taxonomies)){	
			$tabs = array();
			foreach($taxonomies as $taxonomy => $tax){
				$tabs[$taxonomy] = sprintf('<li class="fbd-tabs"><a data-tab-target=".tab-%s">%s</a></li>',$taxonomy,$tax->label);
			}
			//--
			
			$tabs_content = array();
			foreach($taxonomies as $taxonomy => $tax){
				$terms = get_terms($taxonomy);
				if(is_array($terms) && count($terms)>0){
					$tmp = sprintf("<div data-taxonomy=\"%s\" class='fbd-filter-group fbd-tabs-panel tab-%s'>",$taxonomy,$taxonomy);
					
					$tmp.='<div class="fbd-checked"></div>';
					$tmp.='<div class="fbd-unchecked">';
					foreach($terms as $i => $term){
						$tmp.=sprintf('<div data-tab-index="%s" class="fbd-cell"><input class="fbd-checkbox fbd-filter" type="checkbox" name="%s" value="%s"/>&nbsp;<span class="fbd-term-label">%s</span></div>',
							$i,
							$taxonomy.'_'.$term->slug,
							$term->slug,
							$term->name
						);
					}
					$tmp.='</div>';
					$tmp.='<div class="fbd-clear"></div>';
					$tmp.= '</div>';
					
					$tabs_content[$taxonomy] = $tmp;
				}else{
					unset($tabs[$taxonomy]);	
				}
			}
			
			if(count($tabs)>0){
				$content = "<ul class='fbd-ul'>".implode('',$tabs)."</ul>";
				$content.= implode("",$tabs_content);
				return $content;			
			}
		}
		return sprintf('<div class="no-filters">%s</div>',__('No filters available.','rhc'). 'post_type:'.$post_type  );	
	}
	
	function calendars_form($post_type){
		global $rhc_plugin; 
		ob_start();
		include $rhc_plugin->get_template_path('calendars_form.php');			
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
	
	function items_tooltip(){
		global $rhc_plugin; 
		include $rhc_plugin->get_template_path('calendar_item_tooltip.php');	
	}
	
	function icalendar_dialog($icalendar,$icalendar_title,$icalendar_description,$icalendar_button,$width=450,$align,$id='rhc-icalendar-modal',$class=""){
		//return '';
		if($icalendar!='1')return;
		ob_start();
?>
<div class="ical-tooltip-template" title="<?php echo $icalendar_title?>" style='display:none;width:<?php echo $width?>px;' data-button_text="<?php echo $icalendar_button ?>">
	<div class="ical-tooltip-holder">
		<div class="fbd-main-holder">
			<div class="fbd-head">
				<div class="rhc-close-icon"><a class="ical-close" href="javascript:void(0);"></a></div>				
			</div>
			<div class="fbd-body">
				<div class="fbd-dialog-content">
					<label class="fbd-label"><?php _e('iCal feed URL','rhc')?></label>
					<textarea class="ical-url"></textarea>
					<p class="rhc-icalendar-description"><?php echo $icalendar_description?></p>			
					<div class="fbd-buttons">
						<a class="ical-clip fbd-button-secondary" href="#"><?php _e('Copy feed url to clipboard','rhc')?></a>
						<a class="ical-ics fbd-button-primary" href="#"><?php _e('Download ICS file','rhc')?></a>
						
					</div>
				</div>
		
			</div>	
		</div>
	</div>
</div>
<?php	
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
	
	function sc_ical_feed($atts,$content=null,$code=""){
		extract(shortcode_atts(array(
			'post_ID'					=> false,
			'icalendar_title'			=> __('iCal Feed','rhc'),
			'icalendar_description'		=> __('Get Feed for iCal (Google Calendar). This is for subscribing to the events in the Calendar. Add this URL to either iCal (Mac) or Google Calendar, or any other calendar that supports iCal Feed.','rhc'),
			'icalendar_button'			=> __('iCal Feed','rhc'),
			'icalendar_width'			=> 450,
			'theme'						=> 'fc',//or ui
			'linkonly'					=> false
		), $atts));
		
		global $rhc_plugin,$post;
		$field_option_map = array(
			"icalendar_width", "icalendar_button", "icalendar_title", "icalendar_description"
		);
		foreach($field_option_map as $field){
			$option = 'cal_'.$field;
			$value = $rhc_plugin->get_option($option,false,true);
			$$field = false===$value?$$field:$value;
		}		
		$id = 'rhc-btn-single-feed-'.$this->id++;

		$post_ID = is_object($post) && property_exists($post,'ID') ? $post->ID : $post_ID;
		$post_ID = intval($post_ID);
		if(0==$post_ID)return '';
		
		$feed = site_url('/?rhc_action=get_icalendar_events&ID='.$post_ID);
		$ics_download = $feed.'&ics=1';
		//------
		
		//------
		ob_start();
?>

<div class="rhcalendar">
	<div id="<?php echo $id ?>" data-width="<?php echo $icalendar_width?>" data-title="<?php echo $icalendar_title?>" data-theme="<?php echo $theme?>" class="rhc-ical-feed-cont ical-tooltip ical-tooltip-holder" title="<?php echo $icalendar_title?>" style='display:none;' data-icalendar_button="<?php echo $icalendar_button ?>">
		<div class="fbd-main-holder">
			<div class="fbd-head">
				<div class="rhc-close-icon"><a class="ical-close" href="javascript:void(0);"></a></div>				
			</div>
			<div class="fbd-body">
				<div class="fbd-dialog-content">
					<label class="fbd-label"><?php _e('iCal feed URL','rhc')?></label>
					<textarea class="ical-url"><?php echo $feed?></textarea>
					<p class="rhc-icalendar-description"><?php echo $icalendar_description?></p>			
					<div class="fbd-buttons">
						<a class="ical-ics fbd-button-primary" href="<?php echo ($ics_download)?>"><?php _e('Download ICS file','rhc')?></a>						
					</div>
				</div>
		
			</div>	
		</div>
	</div>
</div>
<?php	
		$content = ob_get_contents();
		ob_end_clean();
		return $content;		
	}
	
	function handle_date_shortcode($atts,$content=null,$code=""){
		extract(shortcode_atts(array(
			'post_id'				=> false,
			'date_format'			=> false
		), $atts));
		
		$post_id = false===$post_id ? get_the_ID() : $post_id ;
		if($code=='rhc_start_date'){
			return fc_get_repeat_start_date($post_id, $date_format);
		}elseif($code=='rhc_end_date'){
			return fc_get_repeat_end_date($post_id, $date_format);
		}else{
			return '';
		}
	}
}

?>