<?php

/**
 * 
 *
 * @version $Id$
 * @copyright 2003 
 **/
if('shortcode_calendarize'==get_class($this)):
		global $rhc_plugin;
		$atts = $this->replace_att_with_posted($atts);
		$month_names = __('January,February,March,April,May,June,July,August,September,October,November,December','rhc');
		$short_month_names = __('Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec','rhc');
		$day_names = __('Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday','rhc');
		$short_day_names = __('Sun,Mon,Tue,Wed,Thu,Fri,Sat','rhc');
		//--
		$label_today 		= __('today','rhc');
		$label_month 		= __('month','rhc');
		$label_day 			= __('day','rhc');
		$label_week 		= __("week",'rhc');
		$label_Calendar 	= __('Calendar','rhc');
		$label_event 		= __('event','rhc');
		$label_detail 		= __('detail','rhc');
		//--
		$tax_filter_label_year 	= __('Year','rhc');
		$tax_filter_label_month	= __('Month','rhc');
		
		$default_events_source = $rhc_plugin->get_option( 'rhc-api-url', '', true );
		if(''==trim($default_events_source)){
			$default_events_source = site_url('/?rhc_action=get_calendar_events');
		}
		//--
		extract(shortcode_atts(array(
			'id'		=> sprintf("calendarize-%s",$this->id++),
			'class'		=> '',
			'post_type' => RHC_EVENTS,
			'taxonomy' 	=> '',
			'terms' 	=> '',
			'calendar'	=> '',
			'venue'		=> '',
			'organizer'	=> '',
			'author'	=> '',
			'author_name'=> '',
			'editable'	=> '1',
			'notransition'=>'0',
			'transition_easing'=>'easeInOutExpo',
			'transition_duration'=>'600',
			'transition_direction'=>'horizontal',
			//'theme'		=> 'sunny'
			//'theme'		=> 'smoothness'
			'mode'		=> 'view',//or edit *edit not currenlty supported.
			'theme'		=> '',
			'defaultview' => 'month',//month, basicWeek, basicDay, agendaWeek, agendaDay
			'aspectratio' => 1.35,
	//		'header_left'	=> 'prevYear,prev,next,nextYear today ',
			'header_left'	=> 'rhc_search prevYear,prev,next,nextYear today',
			'header_center'	=> 'title',
			'header_right'	=> 'month,agendaWeek,agendaDay,rhc_event',
			'weekends'		=> '1',
			'alldaydefault'	=> '1',
			'timeformat'		=>  __('h(:mm)t','rhc'),
			'titleformat_month'	=> 	__('MMMM yyyy','rhc'),
			'titleformat_week'	=> 	__("MMM d[ yyyy]{ '&#8212;'[ MMM] d yyyy}",'rhc'),
			'titleformat_day'	=>  __('dddd, MMM d, yyyy','rhc'),
			'columnformat_month'=> 	__('ddd','rhc'),
			'columnformat_week'	=> 	__('ddd M/d','rhc'),
			'columnformat_day'	=> 	__('dddd M/d','rhc'),
			'timeformat_month'	=> __('h(:mm)t','rhc'),
			'timeformat_week'	=> __('h:mm{ - h:mm}','rhc'),
			'timeformat_day'	=> __('h:mm{ - h:mm}','rhc'),
			'timeformat_default'=> __('h(:mm)t','rhc'),
			'axisformat'		=> __('h(:mm)tt','rhc'),
			'eventlistextendeddetails'=>'0',
			'eventlistextdateformat'=> __('MMMM d, yyyy','rhc'),
			'eventlistexttimeformat'=> __('h:mm tt','rhc'),
			'eventlistextdatetimeformat'=> __('MMMM d, yyyy.  h:mm tt','rhc'),
			'eventlistdateformat'=> __('dddd MMMM d, yyyy','rhc'),
			'eventliststartdateformat'=> __('dddd MMMM d, yyyy. h:mmtt','rhc'),
			'eventliststartdateformat_allday'=> __('dddd MMMM d, yyyy.','rhc'),
			'eventlistshowheader'=> '1',
			'eventlistnoeventstext'=>__('No upcoming events in this date range','rhc'),
			'eventlistmonthsahead'=>'',
			'eventlistupcoming'=>'',
			'eventlistreverse'=>'',
			'eventlistoutofrange'=>'',
			'eventlist_display'=>'',
			'eventlist_template'=>'',
			'tooltip_startdate'	=> __('ddd MMMM d, yyyy h:mm TT','rhc'),
			'tooltip_startdate_allday'	=> __('ddd MMMM d, yyyy','rhc'),
			'tooltip_enddate'	=> __('ddd MMMM d, yyyy h:mm TT','rhc'),
			'tooltip_enddate_allday'	=> __('ddd MMMM d, yyyy','rhc'),
			'tooltip_disable_title_link'	=> '0',
			'isrtl'	=> '',
			'firstday' => '1',
			'monthnames'		=> $month_names,
			'monthnamesshort'	=> $short_month_names,
			'daynames'			=> $day_names,
			'daynamesshort'		=> $short_day_names,
			'button_text_today'	=> $label_today,
			'button_text_month'	=> $label_month,
			'button_text_day'	=> $label_day,
			'button_text_week'	=> $label_week,
			'button_text_prev'	=> '&lsaquo;',
			'button_text_next'	=> '&rsaquo;',
			'button_text_prevYear'	=> '&laquo;',
			'button_text_nextYear'	=> '&raquo;',
			'button_text_calendar' => $label_Calendar,
			'button_text_event'=> $label_event,
			'button_text_detail'=> $label_detail,
			'buttonicons_prev'	=> 'circle-triangle-w',
			'buttonicons_next'	=> 'circle-triangle-e',
			'for_widget'		=> 0,
			'widget_link'		=> '',
			'widget_link_view'	=> '',
			'gotodate'			=> '',
			'alldayslot'		=> '1',
			'alldaytext'		=> __('all-day','rhc'),
			'firsthour'			=> 6,
			'slotminutes'		=> 30,
			'mintime'			=> 0,
			'maxtime'			=> 24,
			'tooltip_target'	=> '_self',
			'icalendar'			=> 1,
			'icalendar_width'	=> 400,
			'icalendar_button'	=> __('iCal Feed','rhc'),
			'icalendar_title' 	=> __('iCal Feed','rhc'),
			'icalendar_description' => __('Get Feed for iCal (Google Calendar). This is for subscribing to the events in the Calendar. Add this URL to either iCal (Mac) or Google Calendar, or any other calendar that supports iCal Feed.','rhc'),
			'icalendar_align'	=> 'right',
			'events_source'		=> $default_events_source,
			'week_mode'			=> 'fixed',
			'loading_overlay'	=> false,
			'week_numbers'		=> '0',
			'week_numbers_title'=> 'W',
			'json_feed'			=> '',
			'json_only'			=> 0,
			'google_feed'		=> '',
			'google_only'		=> 0,
			'feed'				=> '',// 0 for local, 1 for external, empty for both.,
			'widgetlist_sel'				=> '',
			'widgetlist_number'				=> '',
			'widgetlist_showimage'			=> '',
			'widgetlist_fcdate_format'		=> '',
			'widgetlist_fctime_format'		=> '',
			'widgetlist_start'				=> '',
			'widgetlist_end'				=> '',
			'widgetlist_horizon'			=> '',
			'widgetlist_using_calendar_url'	=> '',
			'widgetlist_loading_method'		=> '',
			'widgetlist_historic'			=> '',
			'widgetlist_specific_date'		=> '',
			'widgetlist_words'				=> '10',
			'widgetlist_dayspast'			=> 0,
			'widgetlist_premiere'			=> '',
			'tax_by_id'						=> '',
			'tax_filter'					=> '1',
			'tax_filter_label_year'			=> $tax_filter_label_year,
			'tax_filter_label_month'		=> $tax_filter_label_month,
			'tax_filter_skip'				=> '',
			'sidelist_template'				=> 'sidelist_item.php',
			'sidelist_link_target'			=> '_blank',
			'hiddendays'					=> ''//fc 1.64
		), $atts));
			
		$sidelist_link_target = $rhc_plugin->get_option('sidelist_link_target',$sidelist_link_target,true);
			
		$tax_filter_skip = $tax_filter_skip==''?array():explode(',',$tax_filter_skip);	
		$tax_filter_skip = is_array($tax_filter_skip)?$tax_filter_skip:array();
		if(empty($tax_filter_skip)){
			foreach(array(RHC_CALENDAR,RHC_ORGANIZER,RHC_VENUE,'core_year','core_month') as $tax_slug){
				$opt_name = 'tax_filter_skip_'.$tax_slug;
				if('1'==$rhc_plugin->get_option($opt_name,'0',true)){
					$tax_filter_skip[]=$tax_slug;
				}
			}
			$other = $rhc_plugin->get_option('tax_filter_skip','',true);
			if(''!=$other){
				$other_tax_skip = explode(',',$other);
				if(is_array($other_tax_skip) && count($other_tax_skip)>0){
					foreach($other_tax_skip as $skip){
						if(trim($skip)=='')continue;
						$tax_filter_skip[]=trim($skip);
					}
				}
			}
		}	
				
		$json_feed = isset($google_feed)?$google_feed:$json_feed;
		$json_only = isset($google_only)?$google_only:$json_only;
		$json_only = $feed=='1'?1:0;
		
		if(empty($isrtl)){
			$isrtl = is_rtl() ? '1' : '';
		}

		$events_source_query = '';
		
		$single_source = site_url('/?rhc_action=get_rendered_item');
	
		if($author=='current_user'){
			$current_user = wp_get_current_user();
			$author=$current_user->ID;		
			$default_events_source .= "&author=$author";
			$single_source .= "&author=$author";
			$events_source .= "&author=$author";
		}
		
		if($author_name=='current_user'){
			$current_user = wp_get_current_user();
			$author_name=$current_user->user_login;		
			$default_events_source .= "&author_name=$author_name";
			$single_source .= "&author_name=$author_name";
			$events_source .= "&author_name=$author_name";
		}

		if(!empty($tax_by_id)){	
			$default_events_source .= "&tax_by_id=1";
			$single_source .= "&tax_by_id=1";
			$events_source .= "&tax_by_id=1";
		}
		
		if(!$this->added_footer){
			$this->added_footer = true;
			add_action('wp_footer',array(&$this,'wp_footer'));	
		}
		

		
		foreach(array('post_type','calendar','venue','organizer','author','author_name') as $field){
			if(!empty($$field)){
				if($field=='post_type'){
					$arr = explode(',',$$field);
					foreach($arr as $post_type){
						if(trim($post_type)=='')continue;
						$events_source_query.=sprintf("&post_type[]=%s",trim($$field));	
					}
				}else{
					$events_source_query.=sprintf("&%s=%s",$field,$$field);
				}				
			}
		}
				
		if(!empty($taxonomy)&&!empty($terms)){
			$events_source_query.=sprintf("&taxonomy=%s&terms=%s",$taxonomy,$terms);	
		}

		$event_click = 'fc_click';
		
		if($json_feed!=''){
			$icalendar=0;
			$json_feed = explode('||',$json_feed);
			if(is_array($json_feed) && count($json_feed)>0){
				$tmp = array();
				foreach($json_feed as $f){
					$arr = explode('|',$f);
					if(count($arr)==1){
						$tmp[]=$f;
					}else if(count($arr)==3){
						$tmp[]=(object)array(
							'url'=>$arr[0],
							'color'=>$arr[1],
							'textColor'=>$arr[2]
						);
					}
				}
				$json_feed = $tmp;
			}
		}else{
			if($feed!='0'){
				if(!empty($calendar)){
					$json_feed = apply_filters('rhc_json_feed',false,RHC_CALENDAR,$calendar);	
				}else{
					$json_feed = apply_filters('rhc_json_feed',false,$taxonomy,$terms);	
				}	
			}
		}

		//---- 
		if(''!=$eventlist_template){
			$template_filename = $eventlist_template; 
			$template_filename = $rhc_plugin->get_template_path($template_filename);
			if( file_exists($template_filename) ){
				//$template = file_get_contents($template_filename);	
				ob_start();
				include $template_filename;
				$template = ob_get_contents();
				ob_end_clean();
				
				$eventlist_template = 'elist_template_'.$id;
				$this->wp_footer.=sprintf('<div id="%s" style="display:none;">%s</div>',
					$eventlist_template,
					$template
				);
				$eventlist_template='#'.$eventlist_template;
			}else{
				$eventlist_template='';
			}
		}
		
		if(''!=$sidelist_template){
			$template_filename = $sidelist_template; 
			$template_filename = $rhc_plugin->get_template_path($template_filename);
			if( file_exists($template_filename) ){
				//$template = file_get_contents($template_filename);	
				ob_start();
				include $template_filename;
				$template = ob_get_contents();
				ob_end_clean();
										
				$sidelist_template = 'sidelist_template_'.$id;
				$this->wp_footer.=sprintf('<div id="%s" style="display:none;">%s</div>',
					$sidelist_template,
					$template
				);
				$sidelist_template='#'.$sidelist_template;
			}else{
				$sidelist_template='';
			}
		}
		//$event_list_templates
		//----

		//$slotminutes=0 crashes the agenda and day views.
		$slotminutes = intval($slotminutes)==0?60:$slotminutes;
		
		if($hiddendays==''){
			$hiddendays=array();
		}else{
			$hiddendays = explode(',',str_replace(' ','',$hiddendays));		
			if(is_array($hiddendays) && count($hiddendays)>0){
				foreach($hiddendays as $j => $hd){
					$hiddendays[$j]=intval($hd);
				}
			}			
		}
		
		$options = (object)array(
			'editable'		=> ($editable && current_user_can($this->capabilities['calendarize_author'])),
			'mode'			=> $mode,
			'modes'			=> array(
				'view' => array(
					'label'		=> 'View',
					'options'	=> (object)array(
						'weekNumberTitle'=>$week_numbers_title,
						'weekNumbers'	=> ($week_numbers?true:false),
						'loadingOverlay' => $loading_overlay,
						'weekMode'	=> $week_mode,
						'header'	=> (object)array(
							'left' 		=> $header_left,
							'center'	=> $header_center,
							'right'		=> $header_right
						),
						'events_source'	=> $events_source,
						'events_source_query' => $events_source_query,
						'defaultView'	=> $defaultview,
						'aspectRatio'	=> $aspectratio,
						'weekends'		=> $this->get_bool($weekends),
						'allDayDefault'	=> $this->get_bool($alldaydefault),
						'titleFormat'	=> (object)array(
							'month'	=> $titleformat_month,
							'week'	=> html_entity_decode($titleformat_week),
							'day'	=> $titleformat_day
						),
						'columnFormat'	=> (object)array(
							'month'	=> $columnformat_month,
							'week'	=> $columnformat_week,
							'day'	=> $columnformat_day
						),
						'timeFormat'	=> (object)array(
							'month'	=> $timeformat_month,
							'week'	=> $timeformat_week,
							'day'	=> $timeformat_day,
							''		=> $timeformat_default
						),
						'tooltip'	=> (object)array(
							'startDate' 		=> $tooltip_startdate,
							'startDateAllDay' 	=> $tooltip_startdate_allday,
							'endDate'			=> $tooltip_enddate,
							'endDateAllDay'		=> $tooltip_enddate_allday,
							'target'			=> $tooltip_target,
							'disableTitleLink' 	=> $tooltip_disable_title_link
						),
						'axisFormat' => $axisformat,
						'isRTL'				=> $this->get_bool($isrtl),
						'firstDay'			=> $firstday,
						'monthNames' 		=> explode(',',$monthnames),
						'monthNamesShort' 	=> explode(',',$monthnamesshort),
						'dayNames' 			=> explode(',',$daynames),
						'dayNamesShort'		=> explode(',',$daynamesshort),
						'buttonText'		=> (object)array(
							'today'	=> $button_text_today,
							'month'	=> $button_text_month,
							'week'	=> $button_text_week,
							'day'	=> $button_text_day,
							'prev'	=> $button_text_prev,
							'next'	=> $button_text_next,
							'prevYear'	=> $button_text_prevYear,
							'nextYear'	=> $button_text_nextYear,
							'rhc_search'=> $button_text_calendar,
							'rhc_event' => $button_text_event,
							'rhc_detail'=> $button_text_detail,
							'rhc_gmap'	=> 'map',//todo replace with customized label.
							'rhc_filter'=> '&nbsp;'
						),
						'buttonIcons'	=> (object)array(
							'prev'	=> $buttonicons_prev,
							'next'	=> $buttonicons_next
						),
						'transition'	=> (object)array(
							'notransition'=> $notransition,
							'easing'	=> $transition_easing,
							'duration'	=> $transition_duration,
							'direction'	=> $transition_direction
						),
						'eventList'		=> (object)array(
							'DateFormat'  	=> $eventlistdateformat,
							'StartDateFormat' => $eventliststartdateformat,
							'StartDateFormatAllDay' => $eventliststartdateformat_allday,
							'ShowHeader'	=> $eventlistshowheader,
							'eventListNoEventsText'=>$eventlistnoeventstext,
							'monthsahead'	=>$eventlistmonthsahead,
							'upcoming' 	=> $eventlistupcoming,
							'reverse' 	=> $eventlistreverse,
							'display'	=> $eventlist_display,
							'outofrange'=> $eventlistoutofrange,
							'eventlist_template'=> $eventlist_template,
							'extDateFormat'	=> $eventlistextdateformat,
							'extTimeFormat'	=> $eventlistexttimeformat,
							'extDateTimeFormat' => $eventlistextdatetimeformat,
							'extendedDetails'=> $eventlistextendeddetails
						),
						'widgetlist'	=> (object)array(
							'sel'				=> $widgetlist_sel,
							'number'			=> $widgetlist_number,
							'showimage'			=> $widgetlist_showimage,
							'fcdate_format'		=> $widgetlist_fcdate_format,
							'fctime_format'		=> $widgetlist_fctime_format,
							'start'				=> $widgetlist_start,
							'end'				=> $widgetlist_end,
							'horizon'			=> $widgetlist_horizon,
							'using_calendar_url'=> $widgetlist_using_calendar_url,
							'loading_method'	=> $widgetlist_loading_method,
							'historic'			=> $widgetlist_historic,
							'specific_date'		=> $widgetlist_specific_date,
							'words'				=> $widgetlist_words,
							'dayspast'			=> $widgetlist_dayspast,
							'premiere'			=> $widgetlist_premiere
						),
						'eventClick'	=> $event_click,
						'eventMouseover'=> 'fc_mouseover',
						'singleSource'	=> $single_source,
						'for_widget'	=> $for_widget,
						'widget_link'	=> $widget_link,
						'widget_link_view'	=> $widget_link_view,
						'gotodate'		=> $gotodate,
						'ev_calendar'	=> $calendar,
						'ev_venue'		=> $venue,
						'ev_organizer'	=> $organizer,
						'allDaySlot'	=> $this->get_bool($alldayslot),
						'allDayText'	=> $alldaytext,
						'firstHour'		=> $firsthour,
						'slotMinutes'	=> intval($slotminutes),
						'minTime'		=> $mintime,
						'maxTime'		=> $maxtime,
						'json_feed'		=> $json_feed,
						'json_only'		=> $json_only,
						'tax_filter'	=> $tax_filter,
						'tax_filter_label'	=> (object)array(
							'year' 	=> $tax_filter_label_year,
							'month'	=> $tax_filter_label_month
						),
						'tax_filter_skip'=> $tax_filter_skip,
						'sidelist'		=> (object)array(
								'link_target'=> $sidelist_link_target,
								'template'	=> $sidelist_template,
								'labels'	=> (object)array(
									'tab'	=> __('Event list','rhc')
								)
						),
						'hiddenDays'	=> $hiddendays
					)	
				)			
			),
			'common' => array(
				'theme' => ($theme==''?false:true),
				'icalendar_align' => $icalendar_align
			)
		);
		
		if('1'!=$for_widget){
			$class.=' not-widget';
		}
endif;		
?>