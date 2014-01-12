<?php

/**
 * 
 *
 * @version $Id$
 * @copyright 2003 
 **/

 
class rhcss_gmap_view extends module_righthere_css{
	function rhcss_gmap_view($args=array()){
		$args['cb_init']=array(&$this,'cb_init');
		return $this->module_righthere_css($args);
	}
	
	function cb_init(){
		//called on the head when editor is active.
		//adjust the height to accomodate more tabs on this screen.
?>
<style>
body .rh-css-edit .accordion-heading .accordion-toggle {
	padding-top:6px;
	padding-bottom:6px;
}
</style>
<?php		
	}
	
	function options($t=array()){
		$i = count($t);

		//-- FILTER BAR --------------------------------			
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rhcmap-header'; 
		$t[$i]->label 		= __('Filter bar','rhcmap');
		$t[$i]->options = array();		
		
		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_bar_btn_color',
				'type'				=> 'css',
				'label'				=> __('Button color','rhc'),
				'input_type'		=> 'color_or_something_else',
				'selector'			=> 'body .tax_filter_holder .tax_filter_item_holder button.dropdown-toggle,body .fc-head-control .tax_filter_previous.btn.btn-small.btn-taxfilter.fui-arrow-left',
				'property'			=> 'background-color',
				'other_options'		=> array(
					'transparent'	=> 'transparent'
				),
				'btn_clear'			=> true,
				'opacity'			=> true,
				'real_time'			=> true
			);		
			
		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_bar_btn_color_hover',
				'type'				=> 'css',
				'label'				=> __('Button color hover','rhc'),
				'input_type'		=> 'color_or_something_else',
				'selector'			=> 'body .tax_filter_holder .tax_filter_item_holder button.dropdown-toggle:hover,body .fc-head-control .tax_filter_previous.btn.btn-small.btn-taxfilter.fui-arrow-left:hover',
				'property'			=> 'background-color',
				'other_options'		=> array(
					'transparent'	=> 'transparent'
				),
				'btn_clear'			=> true,
				'opacity'			=> true,
				'real_time'			=> true
			);	
			
		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_bar_btn_color_open',
				'type'				=> 'css',
				'label'				=> __('Button color open','rhc'),
				'input_type'		=> 'color_or_something_else',
				'selector'			=> 'body .tax_filter_holder .tax_filter_item_holder .btn-group.open .btn.btn-taxfilter.dropdown-toggle',
				'property'			=> 'background-color',
				'other_options'		=> array(
					'transparent'	=> 'transparent'
				),
				'btn_clear'			=> true,
				'opacity'			=> true,
				'real_time'			=> true
			);	
			
		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_bar_btn_caret',
				'type'				=> 'css',
				'label'				=> __('Icon color','rhc'),
				'input_type'		=> 'color_or_something_else',
				'selector'			=> 'body .rhcalendar .fc-head-control .select .caret',
				'property'			=> 'border-top-color',
				'other_options'		=> array(
					'transparent'	=> 'transparent'
				),
				'btn_clear'			=> true,
				'opacity'			=> true,
				'real_time'			=> true,
				'derived'			=> array(
						array(
							'type'	=> 'same',
							'val'	=> '',
							'sel'	=> "body .rhcalendar .fc-head-control .select .caret",
							'arg'	=> array(
								(object)array(
									'name' => 'border-color',
									'tpl'	=>'__value__ transparent __value__ transparent;'
								)
							)
						),	
						array(
							'type'	=> 'same',
							'val'	=> '',
							'sel'	=> "body .rhcalendar .fc-head-control a.btn.tax_filter_previous",
							'arg'	=> array(
								(object)array(
									'name' => 'color',
									'tpl'	=>'__value__;'
								)
							)
						)		
					)	
				
			);		

		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_bar_bg',
				'type'				=> 'css',
				'label'				=> __('Background','rhc'),
				'input_type'		=> 'color_or_something_else',
				'selector'			=> 'body .rhc_holder.gmap-fullscreen .fc-head-control, body .tax_filter_nav',
				'property'			=> 'background-color',
				'other_options'		=> array(
					'transparent'	=> 'transparent'
				),
				'btn_clear'			=> true,
				'opacity'			=> true,
				'real_time'			=> true
			);	
			
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> 'rhcmap_bar_font',
			'selector'	=> '.rhcalendar .fc-head-control .btn span, .rhcalendar .fc-head-control .btn:hover span, .rhcalendar .fc-head-control .btn:focus span',
			'labels'	=> (object)array(
				'family'	=> __('Font','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_bar_font_shadow',
				'type'				=> 'css',
				'label'				=> __('Font shadow','rhc'),
				'input_type'		=> 'textshadow',
				'opacity'			=> true,
				'selector'			=> '.rhcalendar .fc-head-control .btn, .rhcalendar .fc-head-control .btn:hover, .rhcalendar .fc-head-control .btn:focus',
				'property'			=> 'text-shadow',
				'real_time'			=> true,
				'btn_clear'			=> true
			);	
			
		//--- Filter Dropdown
		//-- FILTER BAR --------------------------------			
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rhcmap-filter-dropdown'; 
		$t[$i]->label 		= __('Filter dropdown','rhcmap');
		$t[$i]->options = array();				

		$prefix = 'rhcmap_filter_dropdown_';
		$selector = '.fullCalendar .tax_filter_holder .tax_filter_item_holder ul.dropdown-menu';
		$selector_font = '.fullCalendar .tax_filter_holder .tax_filter_item_holder ul.dropdown-menu span'; 
		$t[$i]->options[] =(object)array(
				'id'				=> $prefix.'bg',
				'type'				=> 'css',
				'label'				=> __('Background','rhc'),
				'input_type'		=> 'color_or_something_else',
				'selector'			=> $selector,
				'property'			=> 'background-color',
				'other_options'		=> array(
					'transparent'	=> 'transparent'
				),
				'btn_clear'			=> true,
				'opacity'			=> true,
				'real_time'			=> true,
				'derived'			=> array(
						array(
							'type'	=> 'same',
							'val'	=> '',
							'sel'	=> ".btn-group.select.tax_filter_field .dropdown-arrow",
							'arg'	=> array(
								(object)array(
									'name' => 'border-color',
									'tpl'	=>'transparent transparent __value__;'
								)
							)
						)
				)					
			);	

//.btn-group.select.tax_filter_field .dropdown-arrow
			
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $prefix.'font',
			'selector'	=> $selector_font,
			'labels'	=> (object)array(
				'family'	=> __('Font','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options[] =(object)array(
				'id'				=> $prefix.'shadow',
				'type'				=> 'css',
				'label'				=> __('Font shadow','rhc'),
				'input_type'		=> 'textshadow',
				'opacity'			=> true,
				'selector'			=> $selector,
				'property'			=> 'text-shadow',
				'real_time'			=> true,
				'btn_clear'			=> true
			);		
			
		//--- Filter Dropdown Hover
		//-- FILTER BAR --------------------------------			
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rhcmap-filter-dropdown-hover'; 
		$t[$i]->label 		= __('Filter dropdown hover','rhcmap');
		$t[$i]->options = array();				

		$prefix = 'rhcmap_filter_dropdown_hover_';
		$selector = 'body .rhcalendar .fullCalendar .fc-head-control .tax_filter_holder .tax_filter_item_holder ul.dropdown-menu li > a:hover';
		$selector_font = 'body .rhcalendar .fullCalendar .fc-head-control .tax_filter_holder .tax_filter_item_holder ul.dropdown-menu li > a:hover span'; 
		$t[$i]->options[] =(object)array(
				'id'				=> $prefix.'bg',
				'type'				=> 'css',
				'label'				=> __('Background','rhc'),
				'input_type'		=> 'color_or_something_else',
				'selector'			=> $selector,
				'property'			=> 'background-color',
				'other_options'		=> array(
					'transparent'	=> 'transparent'
				),
				'btn_clear'			=> true,
				'opacity'			=> true,
				'real_time'			=> true
			);	
			
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $prefix.'font',
			'selector'	=> $selector_font,
			'labels'	=> (object)array(
				'family'	=> __('Font','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options[] =(object)array(
				'id'				=> $prefix.'shadow',
				'type'				=> 'css',
				'label'				=> __('Font shadow','rhc'),
				'input_type'		=> 'textshadow',
				'opacity'			=> true,
				'selector'			=> $selector,
				'property'			=> 'text-shadow',
				'real_time'			=> true,
				'btn_clear'			=> true
			);	
		//-- FILTER dropdown SELECTED --------------------------------			
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rhcmap-filter-dropdown-selected'; 
		$t[$i]->label 		= __('Filter dropdown selected','rhcmap');
		$t[$i]->options = array();				

		$prefix = 'rhcmap_filter_dropdown_selected_';
		$selector = implode(',',array(
			'.fullCalendar .tax_filter_holder .tax_filter_item_holder ul.dropdown-menu li.active > a',
			'.fullCalendar .tax_filter_holder .tax_filter_item_holder ul.dropdown-menu li.selected > a'
		));
		$selector_font = implode(',',array(
			'.fullCalendar .tax_filter_holder .tax_filter_item_holder ul.dropdown-menu li.active > a span',
			'.fullCalendar .tax_filter_holder .tax_filter_item_holder ul.dropdown-menu li.selected > a span'
		));

		
		$t[$i]->options[] =(object)array(
				'id'				=> $prefix.'bg',
				'type'				=> 'css',
				'label'				=> __('Background','rhc'),
				'input_type'		=> 'color_or_something_else',
				'selector'			=> $selector,
				'property'			=> 'background-color',
				'other_options'		=> array(
					'transparent'	=> 'transparent'
				),
				'btn_clear'			=> true,
				'opacity'			=> true,
				'real_time'			=> true
			);	
			
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $prefix.'font',
			'selector'	=> $selector_font,
			'labels'	=> (object)array(
				'family'	=> __('Font','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options[] =(object)array(
				'id'				=> $prefix.'shadow',
				'type'				=> 'css',
				'label'				=> __('Font shadow','rhc'),
				'input_type'		=> 'textshadow',
				'opacity'			=> true,
				'selector'			=> $selector,
				'property'			=> 'text-shadow',
				'real_time'			=> true,
				'btn_clear'			=> true
			);	
										
//-- fullscreen button 
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rhcmap-fsbtn'; 
		$t[$i]->label 		= __('Fullscreen tab','rhcmap');
		$t[$i]->options = array();	
			
		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_fsbtn_bg',
				'type'				=> 'css',
				'label'				=> __('Background','rhc'),
				'input_type'		=> 'color_or_something_else',
				'selector'			=> 'body .fc-gmap-fullscreen',
				'property'			=> 'background-color',
				'other_options'		=> array(
					'transparent'	=> 'transparent'
				),
				'btn_clear'			=> true,
				'opacity'			=> true,
				'real_time'			=> true
			);		
			
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> 'rhcmap_fsbtn_font',
			'selector'	=> 'body .fc-gmap-fullscreen',
			'labels'	=> (object)array(
				'family'	=> __('Font','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_fsbtn_font_shadow',
				'type'				=> 'css',
				'label'				=> __('Font shadow','rhc'),
				'input_type'		=> 'textshadow',
				'opacity'			=> true,
				'selector'			=> 'body .fc-gmap-fullscreen',
				'property'			=> 'text-shadow',
				'real_time'			=> true,
				'btn_clear'			=> true
			);							
				//		
						
		//-- Sidelist Tab --------------------------------			
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rhcmap-sidelist-tab'; 
		$t[$i]->label 		= __('Side list tab','rhcmap');
		$t[$i]->options = array();		
		
		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_sltab_bg',
				'type'				=> 'css',
				'label'				=> __('Background','rhc'),
				'input_type'		=> 'color_or_something_else',
				'selector'			=> 'body .rhc-sidelist-tab',
				'property'			=> 'background-color',
				'other_options'		=> array(
					'transparent'	=> 'transparent'
				),
				'btn_clear'			=> true,
				'opacity'			=> true,
				'real_time'			=> true
			);		
			
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> 'rhcmap_sltab_font',
			'selector'	=> 'body .rhc-sidelist-tab',
			'labels'	=> (object)array(
				'family'	=> __('Font','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_sltab_font_shadow',
				'type'				=> 'css',
				'label'				=> __('Font shadow','rhc'),
				'input_type'		=> 'textshadow',
				'opacity'			=> true,
				'selector'			=> 'body .rhc-sidelist-tab',
				'property'			=> 'text-shadow',
				'real_time'			=> true,
				'btn_clear'			=> true
			);	
		//-- Sidelist Tab --------------------------------			
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rhcmap-sidelist'; 
		$t[$i]->label 		= __('Side list','rhcmap');
		$t[$i]->options = array();		
		
		//.rhc-sidelist		
		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_sl_bg',
				'type'				=> 'css',
				'label'				=> __('Background','rhc'),
				'input_type'		=> 'color_or_something_else',
				'selector'			=> 'body .rhc-sidelist',
				'property'			=> 'background-color',
				'other_options'		=> array(
					'transparent'	=> 'transparent'
				),
				'btn_clear'			=> true,
				'opacity'			=> true,
				'real_time'			=> true
			);	
			
		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_sl_border',
				'type'				=> 'css',
				'label'				=> __('Border','rhc'),
				'input_type'		=> 'color_or_something_else',
				'selector'			=> 'body .rhc-sidelist .rhc-sidelist-item',
				'property'			=> 'border-bottom',
				'other_options'		=> array(
					'transparent'	=> 'transparent'
				),
				'btn_clear'			=> true,
				'opacity'			=> true,
				'real_time'			=> true
			);			

		//-- Sidelist title --------------------------------			
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rhcmap-sltit'; 
		$t[$i]->label 		= __('Side list title','rhcmap');
		$t[$i]->options = array();	
			
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> 'rhcmap_sltit_font',
			'selector'	=> 'body .rhc-sidelist-holder .rhc-sidelist .rhc-sidelist-item a',
			'labels'	=> (object)array(
				'family'	=> __('Font','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_sltit_font_shadow',
				'type'				=> 'css',
				'label'				=> __('Font shadow','rhc'),
				'input_type'		=> 'textshadow',
				'opacity'			=> true,
				'selector'			=> 'body .rhc-sidelist-holder .rhc-sidelist .rhc-sidelist-item a',
				'property'			=> 'text-shadow',
				'real_time'			=> true,
				'btn_clear'			=> true
			);		
			
		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_sltit_font_decor',
				'type'				=> 'css',
				'label'				=> __('Text decoration','rhc'),
				'input_type'		=> 'select',
				'selector'			=> 'body .rhc-sidelist-holder .rhc-sidelist .rhc-sidelist-item a',
				'property'			=> 'text-decoration',
				'options'		=> array(
					'none'		=> 'none',
					'underline'	=> 'underline',
					'line-through'	=> 'line-through',
					'overline'	=> 'overline',
					'inherit'	=> 'inherit'
				),
				'btn_clear'			=> true,
				'opacity'			=> true,
				'real_time'			=> true
			);		
			
		//-- Sidelist title --------------------------------			
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rhcmap-sldate'; 
		$t[$i]->label 		= __('Side list date','rhcmap');
		$t[$i]->options = array();	
			
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> 'rhcmap_sldate_font',
			'selector'	=> 'body .rhc-sidelist-date',
			'labels'	=> (object)array(
				'family'	=> __('Font','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_sldate_font_shadow',
				'type'				=> 'css',
				'label'				=> __('Font shadow','rhc'),
				'input_type'		=> 'textshadow',
				'opacity'			=> true,
				'selector'			=> 'body .rhc-sidelist-date',
				'property'			=> 'text-shadow',
				'real_time'			=> true,
				'btn_clear'			=> true
			);		

		//-- Info window --------------------------------		
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rhcmap-info-window'; 
		$t[$i]->label 		= __('Venue tooltip','rhcmap');
		$t[$i]->options = array();	
		
		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_info_window_bg',
				'type'				=> 'css',
				'label'				=> __('Background','rhc'),
				'input_type'		=> 'color_or_something_else',
				'selector'			=> '.fc-view-rhc_gmap .gmap_tooltip',
				'property'			=> 'background-color',
				'other_options'		=> array(
					'transparent'	=> 'transparent'
				),
				'btn_clear'			=> true,
				'opacity'			=> true,
				'real_time'			=> true,
				'derived'			=> array(
						array(
							'type'	=> 'same',
							'val'	=> '',
							'sel'	=> ".fc-view-rhc_gmap .gmap_tooltip:after",
							'arg'	=> array(
								(object)array(
									'name' => 'border-color',
									'tpl'	=>'__value__ transparent transparent transparent;'
								)
							)
						)	
					)					
				
			);		
			
		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_info_window_font_color',
				'type'				=> 'css',
				'label'				=> __('Font color','rhc'),
				'input_type'		=> 'color_or_something_else',
				'selector'			=> '.fc-view-rhc_gmap .gmap_tooltip',
				'property'			=> 'color',
				'other_options'		=> array(
					'transparent'	=> 'transparent'
				),
				'btn_clear'			=> true,
				'opacity'			=> true,
				'real_time'			=> true				
				
			);			
		//-- Cluster Small --------------------------------			
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rhcmap-cluster1'; 
		$t[$i]->label 		= __('Small cluster','rhcmap');
		$t[$i]->options = array();	

		$prefix = 'rhcmap_cluster1_';
		$selector = 'body .cluster.cluster-1';
		$selector_font = 'body .cluster.cluster-1 .cluster-1-count';
		
		$t[$i]->options[] =(object)array(
				'id'				=> $prefix.'img',
				'type'				=> 'css',
				'label'				=> __('Image','rhc'),
				'input_type'		=> 'image_url',
				'selector'			=> $selector,
				'property'			=> 'background-image',
				'real_time'			=> true
			);	
		
		$t[$i]->options[] =(object)array('input_type'		=> 'grid_start');
			
		$t[$i]->options[] =(object)array(
				'id'				=> $prefix.'width',
				'type'				=> 'css',
				'label'				=> __('Image width','rhc'),
				'input_type'		=> 'number',
				//'input_type'		=> 'element_size',
				'unit'				=> 'px',
				'class'				=> 'input-font-size',
				'holder_class'		=> 'span6',				
				//'class'				=> 'input-mini pop_rangeinput',
				'min'				=> '6',
				'max'				=> '144',
				'step'				=> '1',
				'selector'			=> $selector,
				'property'			=> 'width',
				'real_time'			=> true
			);
			
		$t[$i]->options[] =(object)array(
				'id'				=> $prefix.'height',
				'type'				=> 'css',
				'label'				=> __('Image height','rhc'),
				'input_type'		=> 'number',
				//'input_type'		=> 'element_size',
				'unit'				=> 'px',
				'class'				=> 'input-font-size',
				'holder_class'		=> 'span6',				
				//'class'				=> 'input-mini pop_rangeinput',
				'min'				=> '6',
				'max'				=> '144',
				'step'				=> '1',
				'selector'			=> $selector,
				'property'			=> 'height',
				'real_time'			=> true
			);
		
		$t[$i]->options[] =(object)array('input_type'		=> 'grid_end');		
			
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $prefix.'font',
			'selector'	=> $selector_font,
			'labels'	=> (object)array(
				'family'	=> __('Font','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options[] =(object)array(
				'id'				=>  $prefix.'shadow',
				'type'				=> 'css',
				'label'				=> __('Font shadow','rhc'),
				'input_type'		=> 'textshadow',
				'opacity'			=> true,
				'selector'			=> $selector_font,
				'property'			=> 'text-shadow',
				'real_time'			=> true,
				'btn_clear'			=> true
			);	
			
		$t[$i]->options[] =(object)array('input_type'		=> 'grid_start');
			
		$t[$i]->options[] =(object)array(
				'id'				=>  $prefix.'x',
				'type'				=> 'css',
				'label'				=> __('Font x','rhc'),
				'input_type'		=> 'number',
				//'input_type'		=> 'element_size',
				'unit'				=> 'px',
				'class'				=> 'input-font-size',
				'holder_class'		=> 'span6',				
				//'class'				=> 'input-mini pop_rangeinput',
				'min'				=> '0',
				'max'				=> '50',
				'step'				=> '1',
				'selector'			=> $selector_font,
				'property'			=> 'margin-left',
				'real_time'			=> true
			);
			
		$t[$i]->options[] =(object)array(
				'id'				=> $prefix.'y',
				'type'				=> 'css',
				'label'				=> __('Font y','rhc'),
				'input_type'		=> 'number',
				//'input_type'		=> 'element_size',
				'unit'				=> 'px',
				'class'				=> 'input-font-size',
				'holder_class'		=> 'span6',				
				//'class'				=> 'input-mini pop_rangeinput',
				'min'				=> '0',
				'max'				=> '50',
				'step'				=> '1',
				'selector'			=> $selector_font,
				'property'			=> 'margin-top',
				'real_time'			=> true
			);
		
		$t[$i]->options[] =(object)array('input_type'		=> 'grid_end');		
			
		//-- Cluster Medium --------------------------------			
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rhcmap-cluster2'; 
		$t[$i]->label 		= __('Medium cluster','rhcmap');
		$t[$i]->options = array();	

		$prefix = 'rhcmap_cluster2_';
		$selector = 'body .cluster.cluster-2';
		$selector_font = 'body .cluster.cluster-2 .cluster-2-count';
		
		$t[$i]->options[] =(object)array(
				'id'				=> $prefix.'img',
				'type'				=> 'css',
				'label'				=> __('Image','rhc'),
				'input_type'		=> 'image_url',
				'selector'			=> $selector,
				'property'			=> 'background-image',
				'real_time'			=> true
			);	
		
		$t[$i]->options[] =(object)array('input_type'		=> 'grid_start');
			
		$t[$i]->options[] =(object)array(
				'id'				=> $prefix.'width',
				'type'				=> 'css',
				'label'				=> __('Image width','rhc'),
				'input_type'		=> 'number',
				//'input_type'		=> 'element_size',
				'unit'				=> 'px',
				'class'				=> 'input-font-size',
				'holder_class'		=> 'span6',				
				//'class'				=> 'input-mini pop_rangeinput',
				'min'				=> '6',
				'max'				=> '144',
				'step'				=> '1',
				'selector'			=> $selector,
				'property'			=> 'width',
				'real_time'			=> true
			);
			
		$t[$i]->options[] =(object)array(
				'id'				=> $prefix.'height',
				'type'				=> 'css',
				'label'				=> __('Image height','rhc'),
				'input_type'		=> 'number',
				//'input_type'		=> 'element_size',
				'unit'				=> 'px',
				'class'				=> 'input-font-size',
				'holder_class'		=> 'span6',				
				//'class'				=> 'input-mini pop_rangeinput',
				'min'				=> '6',
				'max'				=> '144',
				'step'				=> '1',
				'selector'			=> $selector,
				'property'			=> 'height',
				'real_time'			=> true
			);
		
		$t[$i]->options[] =(object)array('input_type'		=> 'grid_end');		
			
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $prefix.'font',
			'selector'	=> $selector_font,
			'labels'	=> (object)array(
				'family'	=> __('Font','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options[] =(object)array(
				'id'				=>  $prefix.'shadow',
				'type'				=> 'css',
				'label'				=> __('Font shadow','rhc'),
				'input_type'		=> 'textshadow',
				'opacity'			=> true,
				'selector'			=> $selector_font,
				'property'			=> 'text-shadow',
				'real_time'			=> true,
				'btn_clear'			=> true
			);	
			
		$t[$i]->options[] =(object)array('input_type'		=> 'grid_start');
			
		$t[$i]->options[] =(object)array(
				'id'				=>  $prefix.'x',
				'type'				=> 'css',
				'label'				=> __('Font x','rhc'),
				'input_type'		=> 'number',
				//'input_type'		=> 'element_size',
				'unit'				=> 'px',
				'class'				=> 'input-font-size',
				'holder_class'		=> 'span6',				
				//'class'				=> 'input-mini pop_rangeinput',
				'min'				=> '0',
				'max'				=> '50',
				'step'				=> '1',
				'selector'			=> $selector_font,
				'property'			=> 'margin-left',
				'real_time'			=> true
			);
			
		$t[$i]->options[] =(object)array(
				'id'				=> $prefix.'y',
				'type'				=> 'css',
				'label'				=> __('Font y','rhc'),
				'input_type'		=> 'number',
				//'input_type'		=> 'element_size',
				'unit'				=> 'px',
				'class'				=> 'input-font-size',
				'holder_class'		=> 'span6',				
				//'class'				=> 'input-mini pop_rangeinput',
				'min'				=> '0',
				'max'				=> '50',
				'step'				=> '1',
				'selector'			=> $selector_font,
				'property'			=> 'margin-top',
				'real_time'			=> true
			);
		
		$t[$i]->options[] =(object)array('input_type'		=> 'grid_end');		
		
		//-- Cluster Large --------------------------------			
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rhcmap-cluster3'; 
		$t[$i]->label 		= __('Large cluster','rhcmap');
		$t[$i]->options = array();	

		$prefix = 'rhcmap_cluster3_';
		$selector = 'body .cluster.cluster-3';
		$selector_font = 'body .cluster.cluster-3 .cluster-3-count';
		
		$t[$i]->options[] =(object)array(
				'id'				=> $prefix.'img',
				'type'				=> 'css',
				'label'				=> __('Image','rhc'),
				'input_type'		=> 'image_url',
				'selector'			=> $selector,
				'property'			=> 'background-image',
				'real_time'			=> true
			);	
		
		$t[$i]->options[] =(object)array('input_type'		=> 'grid_start');
			
		$t[$i]->options[] =(object)array(
				'id'				=> $prefix.'width',
				'type'				=> 'css',
				'label'				=> __('Image width','rhc'),
				'input_type'		=> 'number',
				//'input_type'		=> 'element_size',
				'unit'				=> 'px',
				'class'				=> 'input-font-size',
				'holder_class'		=> 'span6',				
				//'class'				=> 'input-mini pop_rangeinput',
				'min'				=> '6',
				'max'				=> '144',
				'step'				=> '1',
				'selector'			=> $selector,
				'property'			=> 'width',
				'real_time'			=> true
			);
			
		$t[$i]->options[] =(object)array(
				'id'				=> $prefix.'height',
				'type'				=> 'css',
				'label'				=> __('Image height','rhc'),
				'input_type'		=> 'number',
				//'input_type'		=> 'element_size',
				'unit'				=> 'px',
				'class'				=> 'input-font-size',
				'holder_class'		=> 'span6',				
				//'class'				=> 'input-mini pop_rangeinput',
				'min'				=> '6',
				'max'				=> '144',
				'step'				=> '1',
				'selector'			=> $selector,
				'property'			=> 'height',
				'real_time'			=> true
			);
		
		$t[$i]->options[] =(object)array('input_type'		=> 'grid_end');		
			
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $prefix.'font',
			'selector'	=> $selector_font,
			'labels'	=> (object)array(
				'family'	=> __('Font','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options[] =(object)array(
				'id'				=>  $prefix.'shadow',
				'type'				=> 'css',
				'label'				=> __('Font shadow','rhc'),
				'input_type'		=> 'textshadow',
				'opacity'			=> true,
				'selector'			=> $selector_font,
				'property'			=> 'text-shadow',
				'real_time'			=> true,
				'btn_clear'			=> true
			);	
			
		$t[$i]->options[] =(object)array('input_type'		=> 'grid_start');
			
		$t[$i]->options[] =(object)array(
				'id'				=>  $prefix.'x',
				'type'				=> 'css',
				'label'				=> __('Font x','rhc'),
				'input_type'		=> 'number',
				//'input_type'		=> 'element_size',
				'unit'				=> 'px',
				'class'				=> 'input-font-size',
				'holder_class'		=> 'span6',				
				//'class'				=> 'input-mini pop_rangeinput',
				'min'				=> '0',
				'max'				=> '50',
				'step'				=> '1',
				'selector'			=> $selector_font,
				'property'			=> 'margin-left',
				'real_time'			=> true
			);
			
		$t[$i]->options[] =(object)array(
				'id'				=> $prefix.'y',
				'type'				=> 'css',
				'label'				=> __('Font y','rhc'),
				'input_type'		=> 'number',
				//'input_type'		=> 'element_size',
				'unit'				=> 'px',
				'class'				=> 'input-font-size',
				'holder_class'		=> 'span6',				
				//'class'				=> 'input-mini pop_rangeinput',
				'min'				=> '0',
				'max'				=> '50',
				'step'				=> '1',
				'selector'			=> $selector_font,
				'property'			=> 'margin-top',
				'real_time'			=> true
			);
		
		$t[$i]->options[] =(object)array('input_type'		=> 'grid_end');		
		
		//---------------
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rhcmap-dialog'; 
		$t[$i]->label 		= __('Dialog','rhcmap');
		$t[$i]->options = array();	

		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_dlg_bg',
				'type'				=> 'css',
				'label'				=> __('Background color','rhc'),
				'input_type'		=> 'color_or_something_else',
				'selector'			=> '.fullCalendar .fc-slider-wrapper, .fullCalendar .fc-slider, .fullCalendar .slider-venue-events',
				'property'			=> 'background-color',
				'other_options'		=> array(
					'transparent'	=> 'transparent'
				),
				'btn_clear'			=> true,
				'opacity'			=> true,
				'real_time'			=> true,
				'derived'			=> array(
						array(
							'type'	=> 'same',
							'val'	=> '',
							'sel'	=> ".fullCalendar .fc-slider-wrapper",
							'arg'	=> array(
								(object)array(
									'name' => 'border-color',
									'tpl'	=>'__value__ __value__ __value__ __value__;'
								),
								(object)array(
									'name' => 'border-color',
									'tpl'	=>'__value__;'
								)
							)
						)	
					)					
			);		
			
		$t[$i]->options = $this->add_border_options($t[$i]->options,array(
			'prefix'	=> 'rhcmap_dlg_border_',
			'selector'	=> ".rhcalendar .fullCalendar .fc-slider-wrapper"
		));					
		
		
		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_dlg_close_color',
				'type'				=> 'css',
				'label'				=> __('Close button color','rhc'),
				'input_type'		=> 'color_or_something_else',
				'selector'			=> 'body .fullCalendar .fc-slider-wrapper:hover .rhc-gmap-close, body .fullCalendar .fc-slider-wrapper .rhc-gmap-close',
				'property'			=> 'background-color',
				'other_options'		=> array(
					'transparent'	=> 'transparent'
				),
				'btn_clear'			=> true,
				'opacity'			=> true,
				'real_time'			=> true
			);

		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_dlg_prev_color',
				'type'				=> 'css',
				'label'				=> __('Previous button color','rhc'),
				'input_type'		=> 'color_or_something_else',
				'selector'			=> 'body .fullCalendar .rhc-gmap-prev',
				'property'			=> 'background-color',
				'other_options'		=> array(
					'transparent'	=> 'transparent'
				),
				'btn_clear'			=> true,
				'opacity'			=> true,
				'real_time'			=> true
			);

		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_dlg_next_color',
				'type'				=> 'css',
				'label'				=> __('Next button color','rhc'),
				'input_type'		=> 'color_or_something_else',
				'selector'			=> 'body .fullCalendar .rhc-gmap-next',
				'property'			=> 'background-color',
				'other_options'		=> array(
					'transparent'	=> 'transparent'
				),
				'btn_clear'			=> true,
				'opacity'			=> true,
				'real_time'			=> true
			);		
	
			
		//.slider-venue-description		
		//--------------- DIALOG HEAD
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rhcmap-dlg-head'; 
		$t[$i]->label 		= __('Dialog head','rhcmap');
		$t[$i]->options = array();				
		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> 'rhcmap_dlg_head_font',
			'selector'	=> '.fullCalendar .slider-venue-title',
			'labels'	=> (object)array(
				'family'	=> __('Title Font','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options = $this->add_backgroud_options( $t[$i]->options, array(
			'label'		=> __('Background','rhc'),
			'prefix'	=> 'rhcmap_dlg_head_bg',
			'selector'	=> '.fullCalendar .has-image .slider-venue-title'	
		));				
		//---------------
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rhcmap-dialog-bar'; 
		$t[$i]->label 		= __('Dialog bar','rhcmap');
		$t[$i]->options = array();	

		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> 'rhcmap_dlg_font',
			'selector'	=> '.rhcalendar .slider-venue-description',
			'labels'	=> (object)array(
				'family'	=> __('Font','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
				
		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_dlg_font_shadow',
				'type'				=> 'css',
				'label'				=> __('Font shadow','rhc'),
				'input_type'		=> 'textshadow',
				'opacity'			=> true,
				'selector'			=> '.rhcalendar .slider-venue-description',
				'property'			=> 'text-shadow',
				'real_time'			=> true,
				'btn_clear'			=> true
			);	
					
		$t[$i]->options = $this->add_backgroud_options( $t[$i]->options, array(
			'label'		=> __('Bar background','rhc'),
			'prefix'	=> 'rhcmap_dlg_bar_bg',
			'selector'	=> '.rhcalendar .slider-venue-description'	
		));		
		
		//--------------- DIALOG BODY
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rhcmap-dlg-body'; 
		$t[$i]->label 		= __('Dialog body','rhcmap');
		$t[$i]->options = array();				
		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> 'rhcmap_dlg_body_date_font',
			'selector'	=> '.fullCalendar .slider-venue-events .fc-start',
			'labels'	=> (object)array(
				'family'	=> __('Date Font','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> 'rhcmap_dlg_body_link_font',
			'selector'	=> '.fullCalendar .fc-slider .slider-venue-events a.fc-gmap-title-link',
			'labels'	=> (object)array(
				'family'	=> __('Event Font','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options[] =(object)array(
				'id'				=> 'rhcmap_dlg_body_link_lheight',
				'type'				=> 'css',
				'label'				=> __('Line height','rhc'),
				'input_type'		=> 'number',
				//'input_type'		=> 'element_size',
				'unit'				=> 'px',
				'class'				=> 'input-font-size',
				'holder_class'		=> '',				
				//'class'				=> 'input-mini pop_rangeinput',
				'min'				=> '0',
				'max'				=> '150',
				'step'				=> '1',
				'selector'			=> '.fullCalendar .fc-slider .slider-venue-events a.fc-gmap-title-link,.fullCalendar .slider-venue-events .fc-start',
				'property'			=> 'line-height',
				'real_time'			=> true
			);		
		//
		/*
		$t[$i]->options = $this->add_backgroud_options( $t[$i]->options, array(
			'label'		=> __('Background','rhc'),
			'prefix'	=> 'rhcmap_dlg_head_bg',
			'selector'	=> '.fullCalendar .has-image .slider-venue-title'	
		));		
		*/					
		//-- Saved and DC  -----------------------		
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rh-saved-list'; 
		$t[$i]->label 		= __('Templates','rhc');
		$t[$i]->options = array(
			(object)array(
				'id'				=> 'rh_saved_settings',
				'input_type'		=> 'backup_list'
			)			
		);			
//----------------------------------------------------------------------
		return $t;
	}
}
?>