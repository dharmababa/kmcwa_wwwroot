//custom fullCalendar views created for calendarize-it.

(function($){
$.fullCalendar.views.rhc_event = EventView;	
function EventView(element, calendar) {
	var t = this;
	var body;
	t.name = 'rhc_event';
	t.render = render;
	t.unselect = unselect;
	t.setHeight = setHeight;
	t.setWidth = setWidth;
	t.clearEvents = clearEvents;
	t.renderEvents = renderEvents;
	t.trigger = trigger;
	t.viewChanged = viewChanged;
	t.beforeAnimation = beforeAnimation;
	t.setEventData = setEventData; //fc 1.64
	t.clearEventData = clearEventData;//fc 1.64
	t.triggerEventDestroy = triggerEventDestroy;//fc 1.64
	
	t.element = element;
	t.oldView = null;
	//not part of fc api.
	t.calendar = calendar;//needed for clicking event title.
	function viewChanged(oldView){
		if(oldView){
			if( oldView.visStart && oldView.visEnd ){
				t.title = oldView.title;
				//t.visStart = oldView.visStart;
				t.visStart = oldView.start;
				t.visEnd = oldView.visEnd;
				t.oldView = oldView;

				if( calendar.options.eventList.upcoming && calendar.options.eventList.upcoming=='1' ){
					var _now = new Date();
					t.visStart = t.visStart.getTime() > _now.getTime() ? t.visStart : _now ;
				}		
				
				var months = calendar.options.eventList.monthsahead?calendar.options.eventList.monthsahead:'';
				months = months.replace(' ','')==''?1:parseInt(months);	
				if( months>0 ){
					var _visEnd = new Date( t.visStart );
					_visEnd.setMonth( _visEnd.getMonth() + months );
					t.visEnd = _visEnd;		
				}			
			}	
		}
	}

	
	function setEventData(){
	
	}
	
	function clearEventData(){
	
	}
	
	function triggerEventDestroy(){
	
	}
	
	//not part of fc api.
	function beforeAnimation(oldView){
		
	}
	
	function render(date,delta){
		t.start = date;//if not defined, hidden views do not update size on window resize.
		var firstTime = !body;
		if(firstTime){
			$('<div class="fc-events-holder"></div>').appendTo(element);
			body = true;
		}else{
			 
		}
		
		if(t.oldView){
		
		}else{
			t.oldView = new $.fullCalendar.views['month']( $('<div>') ,calendar);
//			calendar.gotoDate(date);//this produces a double load. i dont remember what this was for. but it no longer seems aplicable
		}
		
		if(t.oldView){	
			t.oldView.render(date,delta);
			if( t.oldView.visStart && t.oldView.visEnd ){
				t.title = t.oldView.title;
				t.start = t.oldView.start;
				t.end = t.oldView.end;
				//t.visStart = t.oldView.visStart;
				t.visStart = t.oldView.start;
				t.visEnd = t.oldView.visEnd;
				
			
			}		
		}

		if( calendar.options.eventList.upcoming && calendar.options.eventList.upcoming=='1' ){
			var _now = new Date();
			_now.setHours(0,0,0);//set the first hour of the day for the cache.
			dayspast = calendar.options.widgetlist.dayspast || 0 ;
			_now.setDate(_now.getDate()-parseInt(dayspast));		
			t.visStart = t.visStart.getTime() > _now.getTime() ? t.visStart : _now ;
		}
		
		var months = calendar.options.eventList.monthsahead?calendar.options.eventList.monthsahead:'';
		months = months.replace(' ','')==''?1:parseInt(months);	

		if( months>0 ){
			var _visEnd = new Date( t.visStart );
			_visEnd.setMonth( _visEnd.getMonth() + months );
			t.visEnd = _visEnd;		
		}
	}
	function unselect(){

	}
	function setHeight(h){
		//element.css('min-height',h);
		element.css('min-height','200px');
		element.css('height','auto');
	}
	function setWidth(){/*console.log('setWidth');*/}
	function clearEvents(){
		element.find('.fc-events-holder').empty();
	}
	function renderEvents(_events, modifiedEventId){
		var view_template = $(rhc_event_tpl);
		var item_template = view_template.find('.fc-event-list-item').clone().removeClass('fc-remove');
		var date_template = view_template.find('.fc-event-list-date').clone().removeClass('fc-remove');
		var no_events_template = view_template.find('.fc-event-list-no-events').clone().removeClass('fc-remove');
		if(calendar.options.eventList && calendar.options.eventList.eventListNoEventsText){
			no_events_template.find('.fc-no-list-events-message').html(calendar.options.eventList.eventListNoEventsText);
		}
		
		//--support widget templates
		widget_templates = false;
		if( calendar.options.eventList && calendar.options.eventList.eventlist_template && ''!=calendar.options.eventList.eventlist_template ){
			if( $(calendar.options.eventList.eventlist_template).length>0 ){
				widget_templates = true;
				item_template = $(calendar.options.eventList.eventlist_template).find('.rhc-widget-upcoming-item');
			}		
		}
		//---
		
		view_template
			.appendTo( element.find('.fc-events-holder') )
			.find('.fc-remove').remove();
					
		if(_events.length>0){		
			if(widget_templates){
				//widget template based render.
				var date_options = calendar.options;
				var options = calendar.options.widgetlist;
				var render_events=_events;		
				var sel = '#'+options.sel;
				options.dayspast = options.dayspast?options.dayspast:0;
				 				
				var vis_end = $.fullCalendar.parseDate( options.end );			
				if(options.horizon && ( options.horizon=='hour' || options.horizon=='end') ){
					var tmp = [];
					var _now = new Date();					
					_now.setDate(_now.getDate()-options.dayspast);				

					if(options.historic && options.historic=='1'){
						_now = $.fullCalendar.parseDate( options.specific_date );
					}
								
					for(var a=0;a<render_events.length;a++){
						if( render_events[a].end && options.horizon=='end' ){
							if(  render_events[a].end.getTime() < _now.getTime() )
								continue;						
						}else{
							if(  render_events[a].start.getTime() < _now.getTime() )
								continue;
						}
						
						if(  render_events[a].start.getTime() > vis_end.getTime() )
							continue;
							
						tmp[tmp.length]=render_events[a];	
					}
					render_events = tmp;
				}else{
					//handle a situation where repeat events are added and have
					//a  date before the start date
					var tmp = [];
					var _now = new Date();	
					_now.setDate(_now.getDate()-options.dayspast);	
					if(options.historic){
						if(''!=options.specific_date){
							_now = $.fullCalendar.parseDate( options.specific_date );
						}					
					}							
					for(var a=0;a<render_events.length;a++){
						var event_start = new Date(render_events[a].start);
						_now.setHours(0,0,0,0);
						event_start.setHours(0,0,0,0);
						
						if(  event_start.getTime() < _now.getTime() )			
							continue;

						if(  event_start.getTime() > vis_end.getTime() )	
							continue;
							
						tmp[tmp.length]=render_events[a];	
					}
					render_events = tmp;
				}
					
				render_events.sort( _rhc_sort_events );
				
				//handle premiere
				if( options.premiere && options.premiere=='1' ){
					var done_ids = [];
					var tmp = [];
					for(var a=0;a<render_events.length;a++){								
						if( render_events[a].id ){
							done_id = render_events[a].id;
							if( -1==$.inArray(done_id,done_ids) ){
								done_ids.push(done_id);
							}else{
								continue;
							}						
						}
		
						tmp[tmp.length]=render_events[a];	
					}
					render_events = tmp;					
				}
				//--					
				
				
				render_events = render_events.slice(0, options.number );				
				
				var done_days = [];//for eventlist widget supppport.	
				$.each(render_events,function(i,ev){
					var item = item_template.clone();
					//-- support widget templates:
					var e = ev;
					var desc = e.description.split(' ');
					desc = desc.slice(0, options.words);
					e.description = desc.join(' ');
					//--
					if( options.using_calendar_url && ''!=options.using_calendar_url ){
						e.url = options.using_calendar_url; 
					}
					var href = e.url;
		
					var str = item_template.clone();
					str
						.find('.rhc-title-link')
							.html( e.title )
							.data('rhc_event',e)
							.attr('href', href )
							.end()
						.find('.rhc-description').html( e.description ).end()
						.find('.rhc-widget-date').html('').end()
						.find('.rhc-widget-time').html('').end()
						.find('.rhc-widget-end-date').html('').end()
						.find('.rhc-widget-end-time').html('').end()
						;
					
					if(''!=options.fcdate_format){
						str.find('.rhc-widget-date').html( $.fullCalendar.formatDate(e.start,options.fcdate_format,date_options) );
						str.find('.rhc-widget-end-date').html( $.fullCalendar.formatDate(e.end,options.fcdate_format,date_options) );
					}
				
					if(''!=options.fctime_format && !e.allDay){
						str.find('.rhc-widget-time').html(  $.fullCalendar.formatDate(e.start,options.fctime_format,date_options) );
						str.find('.rhc-widget-end-time').html(  $.fullCalendar.formatDate(e.end,options.fctime_format,date_options) );
					}
					
					if(e.allDay){
						str.find('.rhc-widget-date-time').hide();
					}
					
					//--- date parts
					str.find('.rhc-date-start').each(function(i,el){
						$(el).html( $.fullCalendar.formatDate(e.start, $(el).html(), date_options) );				
					});
					//--//rhc-featured-date 
					var done_day = $.fullCalendar.formatDate(e.start,'yyyyMMdd',date_options);
					if( -1==$.inArray(done_day,done_days) ){
						done_days.push(done_day);
					}else{
						str.find('.hide-repeat-date').addClass('repeated-date');
					}
					//---
					
					if(options.showimage==1){
						str.addClass('featured-1');
						if( e.image && e.image[0] && e.image[0]!='' ){
							$('<a></a>')
								.addClass('rhc-image-link')
								.data('rhc_event',e)
								.attr('href',href)
								.append( $('<img></img>').attr('src',e.image[0]) )
								.appendTo( str.find('.rhc-widget-upcoming-featured-image') )
							;
						}
					}else{
						str.addClass('featured-0');
						str.find('.rhc-widget-upcoming-featured-image').remove();
					}
					
					$(str).find('.rhc-title-link').click(function(_e){
						var args = {url: e.url}
						if(e.gotodate){
							args.gotodate = e.gotodate;
						}
						if(e.event_rdate){
							args.event_rdate = e.event_rdate;
						}
						return _rhc_widget_link_click(args);	
					});
					//--terms
					item=str;
					item.find('.fc-event-term')
						.empty().hide()
						.parent().addClass('rhc_event-empty-taxonomy')
					;
					if(ev.terms && ev.terms.length>0){
						$.each(ev.terms,function(i,t){		
							if( item.find('.taxonomy-'+t.taxonomy).parent().find('a').length>0 ){
								item.find('.taxonomy-'+t.taxonomy).parent().append( '<span class="rhc-event-list tax-term-divider"></span>' );
							}
													
							if( t.name && ''!=t.name && item.find('.taxonomy-'+t.taxonomy).length>0 ){
								if( t.url=='' ){
									$('<span>'+ t.name +'</span>')
										.appendTo( item.find('.taxonomy-'+t.taxonomy).show().parent().removeClass('rhc_event-empty-taxonomy') )
									;	
								}else{
									$('<a>'+ t.name +'</a>')
										.attr('href',t.url)
										.appendTo( item.find('.taxonomy-'+t.taxonomy).show().parent().removeClass('rhc_event-empty-taxonomy') )
									;								
								}
		
							}
							
							if( item.find('.taxonomy-'+t.taxonomy+'-gaddress').length>0 && t.gaddress && t.gaddress!=''){
								if( item.find('.taxonomy-'+t.taxonomy+'-gaddress' ).parent().find('a').length>0 ){
									item.find('.taxonomy-'+t.taxonomy+'-gaddress' ).parent().append( '<span class="rhc-event-list tax-term-divider"></span>' );
								}							
								
								var _url = 'http://www.google.com/maps?f=q&hl=en&source=embed&q=' + escape(t.gaddress);
								$('<a>'+ t.gaddress +'</a>')
									.attr('href', _url)
									.attr('target','_blank')
									.appendTo( item.find('.taxonomy-'+t.taxonomy+'-gaddress' ).show().parent().removeClass('rhc_event-empty-taxonomy').end() )
								;	
							}
						});
					}
					//-----------------------------------------------------------------							
					if(str.find('.move-out').length>0){
						str.find('.move-out').appendTo(sel);
					}		
					
					triggerRes = trigger('eventRender', ev, ev, str);
					if(false===triggerRes){
					
					}else{
						view_template.find('.fc-event-list-holder').append(str);
					}					
					trigger('loading', null, false);
					return;		
				});
			}else{
				calendar.options.widgetlist.dayspast = calendar.options.widgetlist.dayspast?calendar.options.widgetlist.dayspast:0;
				//default original view render
				events = [];
				var now = new Date();
				now.setDate(now.getDate()-calendar.options.widgetlist.dayspast);
				$.each(_events,function(i,ev){
					if(calendar.options.eventList && calendar.options.eventList.outofrange=='1'){
						if(ev.end!=null && ev.start<t.visStart && ev.end<t.visEnd)return;
					}else{
						if(ev.start<t.visStart)return;
						if(ev.start>t.visEnd)return;				
					}
					events[events.length]=ev;
				});
				if(events.length==0)return;
				//---
				if( '1'==calendar.options.eventList.reverse ){
					events.sort(_rsort_events);
				}else{
					events.sort(_sort_events);
				}
				
				var extended_details_ids = [];
				var extended_details = calendar.options.eventList.extendedDetails && '1'==calendar.options.eventList.extendedDetails ? true : false;
				var last_date = '';		
				var done_days = [];//for eventlist widget supppport.	
				$.each(events,function(i,ev){
				
					if( 'undefined'!=typeof(calendar.options.eventList.display) && calendar.options.eventList.display>0 ){
						if(i>=calendar.options.eventList.display)return;
					}
					
					var item = item_template.clone();
					
					if(ev.gcal || ev.url==''){
						item
							.find('.fc-event-list-title').parent()
							.empty()
							.append( $('<span></span>').addClass('fc-event-list-title').html(ev.title) )
						;
					}else if(ev.direct_link){
						item
							.find('.fc-event-list-title').html(ev.title).end()
							.find('a.fc-event-link')
								.attr('href',ev.url)	
								.end()	
						;
					}else{
						item
							.find('.fc-event-list-title').html(ev.title).end()
							.find('a.fc-event-link')
								.attr('target','')
								.attr('href','javascript:void(0);')	
								.bind('click',function(e){
									var click_method = calendar.options.eventClick?calendar.options.eventClick:fc_click;
									click_method(ev,e,t);
								})
								.end()	
						;
					}
//extended_details=true;//force extended details
					var local_feed = ev.local_feed ? true : false;					
					if(extended_details && local_feed){									
						item.find('.fe-extrainfo-container')
							.addClass('skip-render')
							.addClass('ext_det_'+ev.id)
							.hide()
							.data('ev',ev)
							.before('<div class="ext-list-loading loading-events"><div class="ext-list-loading-1 ajax-loader loading-events"><div class="ext-list-loading-2x xspinner icon-xspinner-3"></div></div></div>')
							;
							
						if(-1==$.inArray(ev.id,extended_details_ids) ){
							extended_details_ids.push(ev.id);
						}	
					}
					
					if( true ){		
						//regular template
						//-----------------------------------------------------------------
						item
							.find('.fc-event-list-description').html(ev.description).end()
						;
		
						if( ''==ev.description.replace(' ','') ){
							item.find('.fc-event-list-description').addClass('rhc-empty-description');
						}
						
						if(ev.fc_click_link=='none'){
							item.find('a.fc-event-link').addClass('fc-no-link');
						}
						
						//--thumbnail
						if(ev.image&&ev.image[0]){
							item.find('img.fc-event-list-image').attr('src',ev.image[0]);
						}else{
							item.find('.fc-event-list-featured-image').empty();
						}	
						//--hour
						if(ev.allDay){
							item.find('.fc-time').remove();
							var _start_date_format = calendar.options.eventList.StartDateFormatAllDay||'dddd MMMM d, yyyy.';
						}else{
							item.find('.fc-time').html( $.fullCalendar.formatDate(ev.start,'h:mmtt') );
							var _start_date_format = calendar.options.eventList.StartDateFormat||'dddd MMMM d, yyyy. h:mmtt';
						}
					
						//--start
						if(ev.start){
							item.find('.fc-start').html( $.fullCalendar.formatDate(ev.start,_start_date_format,calendar.options) );
						}else{
							item.find('.fc-start').remove();
						}
						//--end
						if(ev.end){
							item.find('.fc-end').html( $.fullCalendar.formatDate(ev.end,_start_date_format,calendar.options) );
						}else{
							item.find('.fc-end')
								.parent().addClass('rhc_event-empty-taxonomy').end()
								.remove()
								
							;
						}
						//--terms
						item.find('.fc-event-term')
							.empty().hide()
							.parent().addClass('rhc_event-empty-taxonomy')
						;
						if(ev.terms && ev.terms.length>0){
							$.each(ev.terms,function(i,t){		
								if( item.find('.taxonomy-'+t.taxonomy).parent().find('a').length>0 ){
									item.find('.taxonomy-'+t.taxonomy).parent().append( '<span class="rhc-event-list tax-term-divider"></span>' );
								}
														
								if( t.name && ''!=t.name && item.find('.taxonomy-'+t.taxonomy).length>0 ){
									if( t.url=='' ){
										$('<span>'+ t.name +'</span>')
											.appendTo( item.find('.taxonomy-'+t.taxonomy).show().parent().removeClass('rhc_event-empty-taxonomy') )
										;	
									}else{
										$('<a>'+ t.name +'</a>')
											.attr('href',t.url)
											.appendTo( item.find('.taxonomy-'+t.taxonomy).show().parent().removeClass('rhc_event-empty-taxonomy') )
										;								
									}
			
								}
								
								if( item.find('.taxonomy-'+t.taxonomy+'-gaddress').length>0 && t.gaddress && t.gaddress!=''){
									if( item.find('.taxonomy-'+t.taxonomy+'-gaddress' ).parent().find('a').length>0 ){
										item.find('.taxonomy-'+t.taxonomy+'-gaddress' ).parent().append( '<span class="rhc-event-list tax-term-divider"></span>' );
									}							
									
									var _url = 'http://www.google.com/maps?f=q&hl=en&source=embed&q=' + escape(t.gaddress);
									$('<a>'+ t.gaddress +'</a>')
										.attr('href', _url)
										.attr('target','_blank')
										.appendTo( item.find('.taxonomy-'+t.taxonomy+'-gaddress' ).show().parent().removeClass('rhc_event-empty-taxonomy').end() )
									;	
								}
							});
						}
						//-----------------------------------------------------------------						
					}
					
					
					if( calendar.options.eventList.ShowHeader && parseInt(calendar.options.eventList.ShowHeader)==1){
						var header_date = ev.start;
						if($.fullCalendar.formatDate(header_date,'yyyyMMdd')!=$.fullCalendar.formatDate(last_date,'yyyyMMdd')){
							last_date = header_date;
							var date_str = date_template.clone();
							date_str.find('.fc-event-list-date-header').html( $.fullCalendar.formatDate(ev.start, calendar.options.eventList.DateFormat||'dddd MMMM d, yyyy',calendar.options) );
							view_template.find('.fc-event-list-holder').append(date_str);
						}				
					}
					
					triggerRes = trigger('eventRender', ev, ev, item);
					if(false===triggerRes){
					
					}else{
						view_template.find('.fc-event-list-holder').append(item);
					}
				});	
				
				if( extended_details_ids.length>0 ){
					var ajax_args = {
						url: RHC.ajaxurl,
						type:'POST',
						dataType:'html',
						data: {
							rhc_action: 'extended_details',
							ids: extended_details_ids						
						},
						success: function(data){
							$.each(extended_details_ids,function(i,id){
								if( $(data).find('.'+id).length > 0 ){
									view_template.find('.ext_det_'+id).each(function(j,el){
										var replacement = $(data).find('.'+id);
										var ev = $(el).data('ev');
										//-------------------------------------
										//fc_start
										replacement.find('.postmeta-fc_start .fe-extrainfo-value').html( 
											$.fullCalendar.formatDate(ev.start, calendar.options.eventList.extDateFormat||'MMMM d, yyyy',calendar.options)
										);
										//fc_start_time
										replacement.find('.postmeta-fc_start_time .fe-extrainfo-value').html( 
											$.fullCalendar.formatDate(ev.start, calendar.options.eventList.extTimeFormat||'h:mm tt',calendar.options)
										);
										//fc_start_datetime
										replacement.find('.postmeta-fc_start_datetime .fe-extrainfo-value').html( 
											$.fullCalendar.formatDate(ev.start, calendar.options.eventList.extDateTimeFormat||'MMMM d, yyyy. h:mm tt',calendar.options)
										);
										//fc_end
										replacement.find('.postmeta-fc_end .fe-extrainfo-value').html( 
											$.fullCalendar.formatDate(ev.end, calendar.options.eventList.extDateFormat||'MMMM d, yyyy',calendar.options)
										);
										//fc_end_time
										replacement.find('.postmeta-fc_end_time .fe-extrainfo-value').html( 
											$.fullCalendar.formatDate(ev.end, calendar.options.eventList.extTimeFormat||'h:mm tt',calendar.options)
										);
										//fc_end_datetime
										replacement.find('.postmeta-fc_end_datetime .fe-extrainfo-value').html( 
											$.fullCalendar.formatDate(ev.end, calendar.options.eventList.extDateTimeFormat||'MMMM d, yyyy. h:mm tt',calendar.options)
										);
										//-------------------------------------

										original = 	$(el).replaceWith(replacement);
										replacement.parent().find('.ext-list-loading').fadeOut('fast');
									});
									
								}else{
									$(element).find('.skip-render.ext_det_'+id)
										.removeClass('skip-render')
										.removeClass('ext_det_'+id)
										.fadeIn('fast')
										.parent().find('.ext-list-loading').fadeOut('fast')
									;	
								}
							});
							$('BODY').trigger('dbox.loaded');
						},
						error: function(){
							$(element).find('.skip-render').show();
							$(element).parent().find('.ext-list-loading').fadeOut('fast');
						}
					}					
					$.ajax(ajax_args);
				}	
				
			}	
		}else{
			view_template.find('.fc-event-list-holder').append(no_events_template);	
		}
		trigger('loading', null, false);
	}
	
	function trigger(name, thisObj) {
		return calendar.trigger.apply(
			calendar,
			[name, thisObj || t].concat(Array.prototype.slice.call(arguments, 2), [t])
		);
	}
	
	function _sort_events(o,p){
		if(o.start>p.start){
			return 1;
		}else if(o.start<p.start){
			return -1;
		}else{
			return 0;
		}
	}
	function _rsort_events(o,p){
		if(o.start<p.start){
			return 1;
		}else if(o.start>p.start){
			return -1;
		}else{
			return 0;
		}
	}
}	

$.fullCalendar.views.rhc_detail = DetailView;	
function DetailView(element, calendar) {
	var t = this;
	var body;
	t.name = 'rhc_detail';
	t.render = render;
	t.unselect = unselect;
	t.setHeight = setHeight;
	t.setWidth = setWidth;
	t.clearEvents = clearEvents;
	t.renderEvents = renderEvents;
	t.trigger = trigger;
	t.viewChanged = viewChanged;
	t.beforeAnimation = beforeAnimation;
	
	t.element = element;
	
	function viewChanged(){
	
	}
	
	function beforeAnimation(oldView){
	
	}	
	function render(date,delta){
		t.start = date;//if not defined, hidden views do not update size on window resize.
		var firstTime = !body;
		if(firstTime){
			$('<div class="fc-detail-view-holder"><div class="fc-detail-view-content">TODO: a single event details. The button will be removed on the top right controls, and this view will be triggered when selecting an event.</div><div class="fc-detail-view-wp_footer" style="display:none;"></div></div>').appendTo(element);
			body = true;
		}else{
			 
		}
	}
	function unselect(){/*console.log('unselect');*/}
	function setHeight(h){
		//element.css('height',h);
		
		element.css('min-height','200px');
		element.css('height','auto');		
	}
	function setWidth(){/*console.log('setWidth');*/}
	function clearEvents(){
		/*console.log('clearEvents');*/
		$('.fc-detail-view-content').html( '' );
	}
	function renderEvents(){
		//console.log( calendar.last_clicked_event );
		//console.log('renderEvents');
		
		var args = {
			'id' : calendar.last_clicked_event.id
		};
		
		
		$.post(calendar.options.singleSource,args,function(data){
			if(data.R=='OK'){
				
				if( $('body .fc-single-item-holder').length==0 ){
					$('body').append('<div class="fc-single-item-holder"></div>');
				}
				
				$('body .fc-single-item-holder').empty();
				$(data.DATA.footer).each(function(i,inp){
					if( inp.nodeName && inp.nodeName=='SCRIPT'){
						var script   = document.createElement("script");
						if( $(inp).attr('type') ){
							script.type  = ($(inp).attr('type')||'');
						}
						if($(inp).attr('src')){
							script.src   = ($(inp).attr('src')||'');    // use this for linked script
						
						}else{
							script.text  = ($(inp).html()||'');
						}
						
						
						document.body.appendChild(script);
						
						//$('body .fc-single-item-holder').append( script );
						
					}else{
						$('body .fc-single-item-holder').append( inp );					
					}
				});
				
				$('.fc-detail-view-content').html( data.DATA.body );
			}
		},'json');
		
	}
	function trigger(){/*console.log('trigger');*/}
}	

})(jQuery);

function _rhc_widget_link_click(calEvent){
	if(calEvent.event_rdate || calEvent.gotodate){
		jQuery('form#calendarizeit_repeat_instance').remove();
		var form = '<form id="calendarizeit_repeat_instance" method="post"></form>';
		jQuery(form)
			.attr('action',calEvent.url)
			.appendTo('BODY')	
		;
		if(calEvent.gotodate){
			jQuery('<input type="hidden" name="gotodate" value="' + calEvent.gotodate + '"/>')
				.appendTo('form#calendarizeit_repeat_instance')
			;
		}
		if(calEvent.event_rdate){
			jQuery('<input type="hidden" name="event_rdate" value="' + calEvent.event_rdate + '" />')
				.appendTo('form#calendarizeit_repeat_instance')
			;
		}
		jQuery('form#calendarizeit_repeat_instance').submit();	
	}else{
		window.open(calEvent.url);
	}
	return false;
}

function _rhc_sort_events(o,p){
	if(o.start>p.start){
		return 1;
	}else if(o.start<p.start){
		return -1;
	}else{
		return 0;
	}
}