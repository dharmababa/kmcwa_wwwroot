<?php

/**
 * 
 *
 * @version $Id$
 * @copyright 2003 
 **/
class calendar_ajax {
	var $numberposts = -1;
	var $skip_duplicates = true;
	var $done_ids = array();
	var $request_md5=false;
	function calendar_ajax(){
		add_action('wp_loaded', array(&$this,'init'));
		$this->fc_intervals = array(
					''			=> __('Never(Not a recurring event)','rhc'),
					'1 DAY'		=> __('Every day','rhc'),
					'1 WEEK'	=> __('Every week','rhc'),
					'2 WEEK'	=> __('Every 2 weeks','rhc'),
					'1 MONTH'	=> __('Every month','rhc'),
					'1 YEAR'	=> __('Every year','rhc')
				);			
	}
	
	function init(){
		if(!isset($_REQUEST['rhc_action']))return;
		$action = $_REQUEST['rhc_action'];

		$this->handle_rhc_cache($_REQUEST);
	
		if(method_exists($this,$action))$this->$action();
	}
	
	function handle_rhc_cache($request){
		global $rhc_plugin,$wpdb;
		if('1'==$rhc_plugin->get_option('disable_rhc_cache','',true))return;
		
		$request['_']='cache';
		$this->request_md5 = md5(serialize($request));	

		$minutes = intval($rhc_plugin->get_option('rhc_cache_minutes','10080',true));//default to a week.
		if($minutes==0)return;

		$user_id = ('1'==$rhc_plugin->get_option('rhc_cache_by_user','',true)) ? intval(get_current_user_id()) : 0 ;
		
		$sql = "SELECT `response` FROM `{$wpdb->prefix}rhc_cache` C ";
		$sql.= " WHERE (1)";
		$sql.= " AND( `request_md5`='{$this->request_md5}')";
		$sql.= " AND( `user_id`={$user_id} )";
		$sql.= " AND( DATE_ADD(C.cdate, INTERVAL $minutes MINUTE) > NOW() )";
		$sql = "SELECT COALESCE(($sql),'')";
		$cached_response = $wpdb->get_var($sql,0,0);
		if(!empty($cached_response)){
			die($cached_response);
		}
	}
	
	function send_response($response){
		global $rhc_plugin;
		if('1'==$rhc_plugin->get_option('ajax_catch_warnings','',true)){
			ob_end_clean();
		}
		if(false!==$this->request_md5){
			$encoded_response = json_encode($response);
			//---save
			try {
				global $wpdb,$rhc_plugin;
				$user_id = ('1'==$rhc_plugin->get_option('rhc_cache_by_user','',true)) ? intval(get_current_user_id()) : 0 ;
				$sql = $wpdb->prepare("INSERT INTO `{$wpdb->prefix}rhc_cache` (`request_md5`,`user_id`,`cdate`,`action`,`response`)VALUES(%s,%d,NOW(),%s,%s) ON DUPLICATE KEY UPDATE cdate=NOW(),`response`=%s",
					$this->request_md5,
					$user_id,
					$_REQUEST['rhc_action'],
					$encoded_response,
					$encoded_response
				);
	
				if($wpdb->query($sql)){
				
				}else{
					
				}			
			}catch(Exception $e){
			
			}
			//----
		}else{
			$encoded_response = json_encode($response);
		}
		ob_start();
		echo $encoded_response;
		ob_end_flush();
		die();
	}
	
	function get_rendered_item(){
		$item_id = explode('-',$_REQUEST['id']);
		if(count($item_id)==2){
			global $wp_query;
			query_posts( 'page_id='.$item_id[0] );	
			query_posts( array(
				'p'=>$item_id[0],
				'post_type'=>$item_id[1]
			) );	

			ob_start();
			wp_head();
			$header = ob_get_contents();
			ob_end_clean();
			
			ob_start();
			include RHC_PATH.'templates/calendar-single-post.php';
			$content = ob_get_contents();
			ob_end_clean();
			
			ob_start();
			wp_footer();
			$footer = ob_get_contents();
			ob_end_clean();
			
			$response = (object)array(
				'R'=>'OK',
				'MSG'=>'',
				'DATA'=>array(
					'body'		=> $content,
					'footer'	=> $footer
				)
			);
			$this->send_response($response);	
		}else{
			$this->send_response(array('R'=>'ERR','MSG'=> __('Invalid item id','rhc') ));
		}
	}
	
	function get_calendar_items(){
		$this->send_response($this->_get_calendar_items());
	}
	
	function get_calendar_events(){
		if(isset($_REQUEST['uew']))return $this->get_upcoming_events_widget();
		$r = array(
			'R'			=> 'OK',
			'MSG'		=> '',
			'EVENTS' 	=> $this->_get_calendar_items()
		);		
		$this->send_response($r);
	}
	
	function get_upcoming_events_widget(){
		global $rhc_plugin;
		
		foreach(array('args','calendar_url','words') as $var){
			$$var = isset($_REQUEST[$var])?$_REQUEST[$var]:null;
		}

		foreach($args as $index => $value){
			if(in_array($value,array('true','false'))){
				$args[$index]=$value=='true'?true:false;
			}
		}
		
		//---
		$valid_args = array(
			'post_type' => false,
			'start'		=> false,
			'end'		=> false,
			'taxonomy'	=> false,
			'terms'		=> false,
			'calendar'	=> false,
			'venue'		=> false,
			'organizer'	=> false,
			'author'	=> false,
			'author_name'=>false,
			'tax'		=> false,
			'tax_by_id' => false,
			'numberposts' => false
		);		
		
		//--only use limited arguments.
		$query_args = array();
		foreach($valid_args as $field => $notusednow){
			if(isset($args[$field])){
				$query_args[$field] = $args[$field];
			}
		}
		//--- do some server side post validation
		$post_types = $rhc_plugin->get_option('post_types',array());
		$post_types[] = RHC_EVENTS;
		if(is_array($query_args['post_type']) && count($query_args['post_type'])>0){
			foreach($query_args['post_type'] as $post_type){
				if(!in_array($post_type,$post_types)){
					$query_args['post_type'] = RHC_EVENTS;
				}
			}
		}else if(is_string($query_args['post_type']) &&!in_array($query_args['post_type'],$post_types) ){
			$query_args['post_type'] = RHC_EVENTS;
		}
		//---
				
		$events = $this->get_events_set($query_args);
		
		if(is_array($events)&&count($events)>0){
			$using_calendar_url = false;
			if($calendar_url!=''){
				$using_calendar_url = true;
				foreach($events as $index => $e){
					$events[$index]['url']=$calendar_url;
				}
			}		
			//---	
			foreach($events as $i => $e){			
				$description = '';
				$drr = explode(' ',$e['description']);
				for($a=0;$a<$words;$a++){
					if(isset($drr[$a]))
						$description.=" ".$drr[$a];
				}
				
				if(count($drr)>$words)
				$description.="<a href=\"".$e['url']."\">...</a>";
				
				$events[$i]['description']=$description;
			}				
		}
	
		$r = array(
			'R'			=> 'OK',
			'MSG'		=> '',
			'EVENTS' 	=> $events
		);		
		$this->send_response($r);
	}
	
	function get_icalendar_events(){
		global $rhc_plugin;
		require 'class.rhc_icalendar.php';
		$_REQUEST['start']=0;
		$_REQUEST['end']=mktime(0,0,0,0,0,date('Y')+20);
		$post_ID = isset($_REQUEST['ID'])&&intval($_REQUEST['ID'])>0?intval($_REQUEST['ID']):false;
		if( '1'==$rhc_plugin->get_option('disable_icalendar_utc','',true) ){
			$gmt_offset = false;
		}else{
			$gmt_offset = get_option('gmt_offset');
		}
		$tzid = apply_filters('rhc_tzid','');
		$vtimezone = apply_filters('rhc_vtimezone','');
		$ical = new events_to_vcalendar( $this->_get_calendar_items($post_ID), $gmt_offset, $tzid, $vtimezone );
		$output=trim($ical->get_vcalendar());
		if(isset($_REQUEST['ics'])){
			if($post_ID>0){
				$filename = "event_".$post_ID.".ics";
			}else{
				$filename = "events.ics";
			}
			header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-Length: ". strlen($output) .";");
			header('Content-Type: text/calendar; charset=utf-8');//change mainly for google.
			header("Content-Disposition: attachment; filename=$filename");
			//header("Content-Type: application/octet-stream; "); 
			header("Content-Transfer-Encoding: binary");		
		}else{
			header('Content-Type: text/html; charset=utf-8');
		}
		die( $output );
	}
	
	function _get_calendar_items($post_ID=false){
		global $rhc_plugin;

		$post_types = $rhc_plugin->get_option('post_types',array());
		$post_types[] = RHC_EVENTS;
		
		$post_fields = array(
			'post_type' 	=> RHC_EVENTS,
			'start'		=> date('Y-m-d 00:00:00'),
			'end'		=> date('Y-m-d 23:59:59'),
			'taxonomy'	=> false,
			'terms'		=> false,
			'calendar'	=> false,
			'venue'		=> false,
			'organizer'	=> false,
			'author'	=> false,
			'author_name'=>false,
			'tax'		=> false,
			'tax_by_id'	=> false
		);
		
		//limit query to a specific id.
		if(false!==$post_ID){
			$post_fields['ID']=$post_ID;
		}
		
		foreach($post_fields as $field => $default){
			if($field=='tax_by_id'){
				$value = isset($_REQUEST[$field])&&$_REQUEST[$field]=='1'?true:false;
			}else if($field=='start'){
				$value = isset($_REQUEST[$field])? date('Y-m-d 00:00:00', intval($_REQUEST['start'])):$default;
			}else if($field=='end'){
				$value = isset($_REQUEST[$field])? date('Y-m-d 23:59:59', intval($_REQUEST['end'])):$default;			
			}else{
				$value = isset($_REQUEST[$field])?$_REQUEST[$field]:$default;
			}
			$$field = $value;
		}
		
		if(is_array($post_type)){
			$arr = $post_type;
		}else{
			$arr = explode(',',$post_type);
		}
		
		if(is_array($arr)&&count($arr)>0){
			$tmp=array();
			foreach($arr as $post_type){
				if(!in_array($post_type,$post_types)){
					continue;
				}	
				$tmp[]=$post_type;
			}
			if(empty($tmp)){
				return array();
			}else{
				$post_type=$tmp;
			}
		}else{
			if(!in_array($post_type,$post_types)){
				return array();
				//die(json_encode(array()));
			}		
		}
				
		$field_names = array_keys($post_fields);
		
		$args = compact($field_names);		
		if('1'==$rhc_plugin->get_option('show_all_post_types','',true)){
			$args['post_type']=$post_types;
		}

		return $this->get_events_set($args);
	}
	
	function get_events_set($args){
		global $rhc_plugin;
		
		$this->done_ids = array();
		$events = array();
	
		if( '1'==$rhc_plugin->get_option('original_ajax_enable','0',true) ){
			$events = $this->events_in_start_range($events, $args);
			$events = $this->events_in_rdatetime_range($events, $args); //for some cases where the events on the first day do not show	
			$events = $this->non_recurring_events_in_range($events,$args);//this one is redundant with the previous, but this fails when an end date is not specified, so keep it an just remove the duplicates.		
			$events = $this->recurring_events_with_end_interval($events, $args);
			$events = $this->recurring_events_without_end_interval($events, $args);				
		}else{
			$events = $this->events_in_fc_range($events, $args);
			$events = $this->recurring_events_without_end_interval($events, $args);
		}

		return $events;
	}
	
	function repeat_recurring_events($events){
		return $events;
	}
	
	function get_events($r,$args){
		global $rhc_plugin,$wpdb;
		$disable_event_link = '1'==$rhc_plugin->get_option('disable_event_link')?true:false;
		//----
		$args['numberposts'] = $this->numberposts;
		$args['suppress_filters'] = false;
//error_log(print_r($args,true)."\n\r",3,ABSPATH.'cal2.log');	
		if(isset($args['author'])&&empty($args['author']))return $r;
		if(isset($args['author_name'])&&empty($args['author_name']))return $r;
	
		$posts = get_posts($args);
		if(!empty($posts)){
			if(!function_exists('get_term_meta'))require_once RHC_PATH.'custom-taxonomy-with-meta/taxonomy-metadata.php';
			foreach($posts as $post){
				setup_postdata($post);	
				//---
				$attachment_id = get_post_meta($post->ID,'rhc_tooltip_image',true);
				$size = $this->get_image_size();
				$image = wp_get_attachment_image_src( $attachment_id, $size );
				if(false===$image){
					$image = (has_post_thumbnail( $post->ID )?wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $this->get_image_size() ):'');
				}
				//---
				$tmp = array(
					'id' 			=> sprintf("%s-%s",$post->ID,$post->post_type),
					'title' 		=> get_the_title($post->ID),
					'start' 		=> $this->get_start_from_post_id($post->ID),
					'end' 			=> $this->get_end_from_post_id($post->ID),
					'url' 			=> $disable_event_link?"javascript:void(0);":get_permalink($post->ID),
					'description'	=> do_shortcode($post->post_excerpt),
					'image'			=> $image,
					'terms'			=> array(),
					'fc_click_link' => 'view'
				);
				//----handle duplicates
				if($this->skip_duplicates){
					if(in_array($tmp['id'],$this->done_ids)){
						continue;
					}else{
						$this->done_ids[]=$tmp['id'];
					}
				}
				//----
				foreach(array( 'fc_rdate'=>'fc_rdate', 'fc_exdate'=>'fc_exdate', 'fc_allday'=>'allDay', 'fc_start'=>'fc_start','fc_start_time'=>'fc_start_time','fc_end'=>'fc_end','fc_end_time'=>'fc_end_time', 'fc_interval'=>'fc_interval','fc_rrule'=>'fc_rrule','fc_end_interval'=>'fc_end_interval','fc_color'=>'color','fc_text_color'=>'textColor','fc_click_link'=>'fc_click_link','fc_click_target'=>'fc_click_target') as $meta_field => $event_field){
					$meta_value = get_post_meta($post->ID,$meta_field,true);
					if(''!=trim($meta_value)){
						$tmp[$event_field]=$meta_value;
					}
				}
				$tmp['allDay']=isset($tmp['allDay'])&&$tmp['allDay']?true:false;
				//----
				$taxonomies = get_object_taxonomies(array('post_type'=>$post->post_type),'objects');
				if(!empty($taxonomies)){
					foreach($taxonomies as $taxonomy => $tax){
						$terms = wp_get_post_terms( $post->ID, $taxonomy );
						if(is_array($terms) && count($terms)>0){
							foreach($terms as $term){
//								$url = get_term_meta($term->term_id,'website',true);
//								$url = trim($url)==''?get_term_meta($term->term_id,'url',true):$url;
//								$url = trim($url)==''?get_term_link( $term, $taxonomy ):$url;
								$url = get_term_link( $term, $taxonomy );
								$gaddress = get_term_meta($term->term_id,'gaddress',true);
								$color = get_term_meta($term->term_id,'color',true);
								$bg = get_term_meta($term->term_id,'background_color',true);
								$image = get_term_meta($term->term_id,'image',true);
								$glat = get_term_meta($term->term_id,'glat',true);
								$glon = get_term_meta($term->term_id,'glon',true);
								
								$new = (object)array(
									'term_id'=>$term->term_id,
									'taxonomy'=>$taxonomy,
									'taxonomy_label'=>$tax->labels->singular_name,
									'slug'=>$term->slug,
									'name'=>$term->name,
									'url'=>$url,
									'gaddress'=>$gaddress,
									'glat'	=> $glat,
									'glon'	=> $glon,
									'color'=>$color,
									'background_color'=>$bg,
									'image'=>$image
								);
								
								foreach(array('address','city','state','zip','country') as $meta){
									$new->$meta = get_term_meta($term->term_id,$meta,true);
								}
								
								$tmp['terms'][]=apply_filters('rhc_event_term_meta', $new, $term->term_id, $taxonomy);
							}
						}
					}
				}
				//----
				$r[]=$tmp;
			}
		}
		return $r;
	}

	function events_in_fc_range($r,$parameters){
		extract($parameters);
		$args = array(
			'post_type'		=> $post_type,
			'post_status' 	=> 'publish',
			'meta_query'	=> array(		
				'relation'	=> 'AND',
				array(
					'key'		=> 'fc_range_end',
					'value'		=> $start,
					'compare'	=> '>=',
					'type'		=> 'DATE'
				),	
				array(
					'key'		=> 'fc_range_start',
					'value'		=> $end,
					'compare'	=> '<=',
					'type'		=> 'DATE'
				)					
			)
		);
	
		$args = $this->apply_parameters($args,$parameters);
		return $this->get_events($r,$args);
	}
	
	function non_recurring_events_in_range($r,$parameters){
		extract($parameters);
		$args = array(
			'post_type'		=> $post_type,
			'post_status' 	=> 'publish',
			'meta_query'	=> array(
				'relation' => 'AND',
				array(
					'key'		=> 'fc_interval',
					'value'		=> '',
					'compare'	=> '=',
					'type'		=> 'CHAR'
				),	
				array(
					'key'		=> 'fc_start_datetime',
					'value'		=> $end,
					'compare'	=> '<',
					'type'		=> 'DATETIME'
				),	
				array(
					'key'		=> 'fc_end_datetime',
					'value'		=> $start,
					'compare'	=> '>',
					'type'		=> 'DATETIME'
				)
			)
		);
	
		$args = $this->apply_parameters($args,$parameters);
		return $this->get_events($r,$args);
	}
	/* MySQL is not liking the query WordPress generates from this
	// the OR and fc_rdatetime part of the query was added for a case where a customer had events that where not showing when on the first calendar day. 
	function events_in_start_range($r,$parameters){
		extract($parameters);
		$args = array(
			'post_type'		=> $post_type,
			'post_status' 	=> 'publish',
			'meta_query'	=> array(
				'relation'		=> 'OR',
				array(
					'key'		=> 'fc_start',
					'value'		=> array($start,$end),
					'compare'	=> 'BETWEEN',
					'type'		=> 'DATE'
				),
				array(
					'key'		=> 'fc_rdatetime',
					'value'		=> array($start,$end),
					'compare'	=> 'BETWEEN',
					'type'		=> 'DATE'
				)		
			)
		);
		$args = $this->apply_parameters($args,$parameters);
		return $this->get_events($r,$args);
	}
	*/ 
	
	function events_in_start_range($r,$parameters){
		extract($parameters);
		$args = array(
			'post_type'		=> $post_type,
			'post_status' 	=> 'publish',
			'meta_query'	=> array(
				array(
					'key'		=> 'fc_start',
					'value'		=> array($start,$end),
					'compare'	=> 'BETWEEN',
					'type'		=> 'DATE'
				)	
			)
		);
		$args = $this->apply_parameters($args,$parameters);
		return $this->get_events($r,$args);
	}
	
	function events_in_rdatetime_range($r,$parameters){
		extract($parameters);
		$args = array(
			'post_type'		=> $post_type,
			'post_status' 	=> 'publish',
			'meta_query'	=> array(
				
				/*
				array(
					'key'		=> 'fc_rdatetime',
					'value'		=> array($start,$end),
					'compare'	=> 'BETWEEN',
					'type'		=> 'DATE'
				)	
				*/
				'relation'	=> 'AND',
				array(
					'key'		=> 'fc_range_end',
					'value'		=> $start,
					'compare'	=> '>=',
					'type'		=> 'DATE'
				),	
				array(
					'key'		=> 'fc_range_start',
					'value'		=> $end,
					'compare'	=> '<=',
					'type'		=> 'DATE'
				)						
			)
		);
		$args = $this->apply_parameters($args,$parameters);
		return $this->get_events($r,$args);
	}
	
	function events_in_end_range($r,$parameters){
		extract($parameters);
		$args = array(
			'post_type'		=> $post_type,
			'post_status' 	=> 'publish',
			'meta_query'	=> array(
				array(
					'key'		=> 'fc_end',
					'value'		=> array($start,$end),
					'compare'	=> 'BETWEEN',
					'type'		=> 'DATE'
				)			
			)
		);
		$args = $this->apply_parameters($args,$parameters);
		return $this->get_events($r,$args);
	}
	
	function recurring_events_with_end_interval($r,$parameters){
		extract($parameters);
		$args = array(
			'post_type'		=> $post_type,
			'post_status' 	=> 'publish',
			'meta_query'	=> array(
				'relation' => 'AND',
				array(
					'key'		=> 'fc_start',
					'value'		=> $start,
					'compare'	=> '<',
					'type'		=> 'DATE'
				),
				array(
					'key'		=> 'fc_interval',
					'value'		=> '',
					'compare'	=> '!=',
					'type'		=> 'CHAR'
				),
				array(
					'key'		=> 'fc_end_interval',
					'value'		=> '',
					'compare'	=> '!=',
					'type'		=> 'CHAR'
				),
				array(
					'key'		=> 'fc_end_interval',
					'value'		=> $start,
					'compare'	=> '>',
					'type'		=> 'DATE'
				)
			)
		);	
		$args = $this->apply_parameters($args,$parameters);
		return $this->get_events($r,$args);
	}
	
	function recurring_events_without_end_interval($r,$parameters){
		extract($parameters);
		$args = array(
			'post_type'		=> $post_type,
			'post_status' 	=> 'publish',
			'meta_query'	=> array(
				'relation' => 'AND',
				array(
					'key'		=> 'fc_start',
					'value'		=> $start,
					'compare'	=> '<',
					'type'		=> 'DATE'
				),
				array(
					'key'		=> 'fc_interval',
					'value'		=> '',
					'compare'	=> '!=',
					'type'		=> 'CHAR'
				),
				array(
					'key'		=> 'fc_end_interval',
					'value'		=> '',
					'compare'	=> '=',
					'type'		=> 'CHAR'
				)
			)
		);	
		$args = $this->apply_parameters($args,$parameters);
		return $this->get_events($r,$args);
	}
	
	function get_start_from_post_id($post_ID){
		return $this->event_date(get_post_meta($post_ID,'fc_start',true),get_post_meta($post_ID,'fc_start_time',true));
	}
	
	function get_end_from_post_id($post_ID){
		$date = get_post_meta($post_ID,'fc_end',true);
		$time = get_post_meta($post_ID,'fc_end_time',true);
		return $this->event_date($date,$time);
	}
	
	function event_date($date,$time,$default=null){
		$time = ''==trim($time)?'00:00:00':$time;
		if(''==trim($date))return $default;
		return date('Y-m-d H:i:s',strtotime(sprintf("%s %s", trim($date), trim($time) )));
	}
	
	function apply_parameters($args,$parameters){			
		foreach(array('taxonomy','tax','calendar','venue','organizer','tax_by_id') as $field){
			if(empty($parameters[$field])){
				$parameters[$field]=false;
			}
		}		
		foreach(array('author','author_name') as $field){
			if(''==$parameters[$field]){
				$parameters[$field]=false;
			}
		}
	
		extract($parameters);
		//--
		if(isset($parameters['ID'])){
			$args['p']=$parameters['ID'];
		}
		
		//--- build taxonomies query
		// tax have priority over taxonomy, tax is passed when checking terms on the search dialog
		$taxonomies = array();	
		if(false!==$tax && is_array($tax) && count($tax)>0){
			foreach($tax as $slug => $terms){
				$taxonomies[$slug]=explode(',',str_replace(' ','',$terms));
			}
		}else{
			if(false!==$taxonomy && false!==$terms){
				$taxonomies[$taxonomy]=explode(',',str_replace(' ','',$terms));
			}
			
			if(false!==$calendar){
				$taxonomies[RHC_CALENDAR]=$calendar;
			}
			
			if(false!==$venue){
				$taxonomies[RHC_VENUE]=$venue;
			}
			
			if(false!==$organizer){
				$taxonomies[RHC_ORGANIZER]=$organizer;
			}	
			/* bugged: only one is added to args where all shoul be possible.:			
			if(false!==$taxonomy && false!==$terms){
				$taxonomies[$taxonomy]=explode(',',str_replace(' ','',$terms));
			}else if(false!==$calendar){
				$taxonomies[RHC_CALENDAR]=$calendar;
			}else if(false!==$venue){
				$taxonomies[RHC_VENUE]=$venue;
			}else if(false!==$organizer){
				$taxonomies[RHC_ORGANIZER]=$organizer;
			}		
			*/ 
		}
			
		if(!empty($taxonomies)){
			$args['tax_query']=array(
				/*'relation'=>'OR'*/////--- multiple taxonomies with relation OR does not work as expected when combined with meta_query
			);
			foreach($taxonomies as $taxonomy => $terms){
				$args['tax_query'][]=array(
					'taxonomy'	=> $taxonomy,
					'field'		=> $tax_by_id?'id':'slug',
					'terms'		=> $terms,
					'operator'	=> 'IN'
				);
			}
		}
		//---done with taxonomies
		//---built author query
		if(false!==$author){
			//$args['author']=explode(',',str_replace(' ','',$author));
			$args['author']=$author;
		}
		if(false!==$author_name){
			$args['author_name']=$author_name;
		}		
		//---end author query
		return $args;
	}
	
	function get_image_size(){
		global $rhc_plugin;
		return $rhc_plugin->get_option('rhc_media_size','thumbnail',true);
		//other options
		return array('175','175');
	}
	
	function extended_details(){
		global $post;
		$output = '<div>';
		$ids = isset($_POST['ids'])&&is_array($_POST['ids'])?$_POST['ids']:array();
		if(!empty($ids)){
			foreach($ids as $id){
				$arr = explode('-',$id);
				if(count($arr)=='2'){
					$post = (object)array(
						'ID'		=> $arr[0],
						'post_type'	=> $arr[1]
					);
					$output.=rhc_post_info_shortcode::handle_shortcode(array('class'=>'se-dbox '.$id));
				}
			}
		}
		$output.= '</div>';
//sleep(3);		
		die($output);
	}
}

?>