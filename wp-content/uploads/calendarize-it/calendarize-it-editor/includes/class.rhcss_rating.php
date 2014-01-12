<?php

/**
 * 
 *
 * @version $Id$
 * @copyright 2003 
 **/

 
class rhcss_rating extends module_righthere_css{
	function rhcss_rsvp($args=array()){
		$args['cb_init']=array(&$this,'cb_init');
		return $this->module_righthere_css($args);
	}
	
	function cb_init(){
		//called on the head when editor is active.
	}
	
	function options($t=array()){
		$i = count($t);
		
		$box_prefix = 'rhcdb_rating';
		$box_selector = '.se-ratingbox';	
		$with_image = true;

		//-- Background bar --------------------------------			
		$label = isset($label)?$label:array();
		//--  --------------------------------			
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= $box_prefix.'-outer'; 
		$t[$i]->label 		= isset($label['outer'])?$label['outer']:__('Back Container','rhc');
		$t[$i]->options = array();		

		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_back_width',
				'type'				=> 'css',
				'label'				=> isset($label['image_width'])?$label['image_width']:__('Width','rhc'),
				'input_type'		=> 'number',
				'class'				=> 'input-mini',
				'unit'				=> '%',
				'min'				=> 0,
				'max'				=> 100,
				'step'				=> 1,
				'holder_class'		=> '',
				'selector'			=> ".fe-extrainfo-container$box_selector",
				'property'			=> 'width',
				'other_options'		=> array(
					'transparent'	=> 'transparent'
				),				
				'real_time'			=> true
			);	
		
		$t[$i]->options = $this->add_padding_options($t[$i]->options,array(
			'prefix'	=> $box_prefix.'_outer_pad',
			'selector'	=> ".fe-extrainfo-container$box_selector"
		));				

		$t[$i]->options = $this->add_border_options($t[$i]->options,array(
			'prefix'	=> $box_prefix.'_outer_border',
			'selector'	=> ".fe-extrainfo-container$box_selector"
		));		
				
		$t[$i]->options = $this->add_border_radius_options($t[$i]->options,array(
			'prefix'	=> $box_prefix.'_outer_radius',
			'selector'	=> ".fe-extrainfo-container$box_selector,$box_selector .fe-extrainfo-container2"
		));		
		//--  --------------------------------			
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= $box_prefix.'-outer-bg'; 
		$t[$i]->label 		= isset($label['outer-bg'])?$label['outer-bg']:__('Back Container background','rhc');
		$t[$i]->options = array();		
		$t[$i]->options = $this->add_backgroud_options( $t[$i]->options, array(
			'label'		=> __('Back background','rhc'),
			'prefix'	=> $box_prefix.'_outer_bg',
			'selector'	=> ".fe-extrainfo-container$box_selector"			
		));	
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= $box_prefix.'-inner'; 
		$t[$i]->label 		= isset($label['inner'])?$label['inner']:__('Top container','rhc');
		$t[$i]->options = array();			
		$t[$i]->options = $this->add_backgroud_options( $t[$i]->options, array(
			'label'		=> __('Inner background','rhc'),
			'prefix'	=> $box_prefix.'_inner_bg',
			'selector'	=> "$box_selector .fe-extrainfo-container2"		
		));				
		//--  --------------------------------			
		
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= $box_prefix.'-main-title'; 
		$t[$i]->label 		= isset($label['main_title'])?$label['main_title']:__('Fonts','rhc');
		$t[$i]->options = array();	
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_line_height',
				'type'				=> 'css',
				'label'				=> isset($label['line_height'])?$label['line_height']:__('Line height','rhc'),
				'input_type'		=> 'number',
				'class'				=> 'input-mini',
				'min'				=> 0,
				'max'				=> 10,
				'step'				=> 0.01,
				'holder_class'		=> '',
				'selector'			=> "$box_selector .rch_h1 , $box_selector .rch_h2",
				'property'			=> 'line-height',		
				'real_time'			=> true
			);			
				
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_main_title',
			'selector'	=> "$box_selector .fe-extrainfo-holder .fe-cell-label label.fe-extrainfo-label",
			'labels'	=> (object)array(
				'family'	=> __('Main title','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_subtitle',
			'selector'	=> "$box_selector .fe-extrainfo-holder .rhc-info-cell:not(.fe-cell-label) label.fe-extrainfo-label",
			'labels'	=> (object)array(
				'family'	=> __('Sub title','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));		
		
		
		
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= $box_prefix.'-rating-box'; 
		$t[$i]->label 		= isset($label['rating-box'])?$label['rating-box']:__('Rating Box','rhc');
		$t[$i]->options = array();	
		
		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_top_title',
			'selector'	=> ".cit_rhc_rating_ .totalselect_text",
			'labels'	=> (object)array(
				'family'	=> __('Top Rating Text','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_rating_main_stars_color',
				'type'				=> 'css',
				'label'				=> __('Stars color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .totalselect',
				'property'			=> 'color',
				'real_time'			=> true
		);	
		
		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_avarage_title',
			'selector'	=> ".cit_rhc_rating_ .totalsub_text",
			'labels'	=> (object)array(
				'family'	=> __('Avarage Text','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));		
		
		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_bar_title',
			'selector'	=> ".fe-extrainfo-holder table td",
			'labels'	=> (object)array(
				'family'	=> __('Bar Text','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_rating_bar_color',
				'type'				=> 'css',
				'label'				=> __('Bar color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .progress-bar',
				'property'			=> 'background-color',
				'real_time'			=> true
		);
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_rating_bar_color_bg',
				'type'				=> 'css',
				'label'				=> __('Bar bg color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .progress',
				'property'			=> 'background-color',
				'real_time'			=> true
		);
			
			
			
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= $box_prefix.'-rating-box-button'; 
		$t[$i]->label 		= isset($label['rating-box-button'])?$label['rating-box-button']:__('Rating Box Button','rhc');
		$t[$i]->options = array();		
			
			
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_button_top_filter',
			'selector'	=> ".cit_rhc_rating_ .columbox .select-multiple button.btn-primary,.cit_rhc_rating_ .btn-group > .dropdown-menu, .cit_rhc_rating_ .btn-group > .popover",
			'labels'	=> (object)array(
				'family'	=> __('Filter','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_top_filter_default',
				'type'				=> 'css',
				'label'				=> __('Filter default color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .columbox .select-multiple button.btn-primary',
				'property'			=> 'background-color',
				'real_time'			=> true
			);
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_top_filter_hover',
				'type'				=> 'css',
				'label'				=> __('Filter Hover color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .columbox .select-multiple button.btn-primary:hover',
				'property'			=> 'background-color',
				'real_time'			=> true
			);
			
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_top_filter_dropdown_default',
				'type'				=> 'css',
				'label'				=> __('Dropdown default color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .mbl.select-multiple ul li:not(.selected) a',
				'property'			=> 'background-color',
				'real_time'			=> true
			);
			
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_top_filter_dropdown_hover',
				'type'				=> 'css',
				'label'				=> __('Dropdown Hover color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .mbl.select-multiple ul li > a:hover, .cit_rhc_rating_ .mbl.select-multiple ul li > a:active, .cit_rhc_rating_ .mbl.select-multiple ul li > a:focus',
				'property'			=> 'background-color',
				'real_time'			=> true
			);
			
			
			
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_button_top_view',
			'selector'	=> ".cit_rhc_rating_ .columbox a.btn_view_rating",
			'labels'	=> (object)array(
				'family'	=> __('View','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_top_view_default',
				'type'				=> 'css',
				'label'				=> __('View default color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .columbox a.btn_view_rating',
				'property'			=> 'background-color',
				'real_time'			=> true
			);
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_top_view_hover',
				'type'				=> 'css',
				'label'				=> __('View Hover color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .columbox a.btn_view_rating:hover',
				'property'			=> 'background-color',
				'real_time'			=> true
			);	
					
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_button_top_submit',
			'selector'	=> ".cit_rhc_rating_ .columbox a.btn_submit_rating",
			'labels'	=> (object)array(
				'family'	=> __('Submit','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
			
			
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_top_submit_default',
				'type'				=> 'css',
				'label'				=> __('Submit default color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .columbox a.btn_submit_rating',
				'property'			=> 'background-color',
				'real_time'			=> true
			);
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_top_submit_hover',
				'type'				=> 'css',
				'label'				=> __('Submit Hover color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .columbox a.btn_submit_rating:hover',
				'property'			=> 'background-color',
				'real_time'			=> true
			);	
		
				
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= $box_prefix.'-Submit_box'; 
		$t[$i]->label 		= isset($label['Submit_box'])?$label['Submit_box']:__('Submit Box','rhc');
		$t[$i]->options = array();			
			
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_forms',
			'selector'	=> ".cit_rhc_rating_ .form-control",
			'labels'	=> (object)array(
				'family'	=> __('Input fields','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_ss_forms_outer_hover',
				'type'				=> 'css',
				'label'				=> __('Focus border color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .form-group.focus .form-control, .cit_rhc_rating_ .form-control:focus',
				'property'			=> 'border-color',
				'real_time'			=> true
		);
		
		$t[$i]->options = $this->add_border_options($t[$i]->options,array(
			'prefix'	=> $box_prefix.'_forms_outer_border',
			'selector'	=> ".cit_rhc_rating_ .form-control"
		));		
				
		$t[$i]->options = $this->add_border_radius_options($t[$i]->options,array(
			'prefix'	=> $box_prefix.'_forms_outer_radius',
			'selector'	=> ".cit_rhc_rating_ .form-control"
		));	
			
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_rating_submit_stars_color',
				'type'				=> 'css',
				'label'				=> __('Stars color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .ratting_select',
				'property'			=> 'color',
				'real_time'			=> true
		);
			
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= $box_prefix.'-Submit_box_button'; 
		$t[$i]->label 		= isset($label['Submit_box_button'])?$label['Submit_box_button']:__('Submit Box Button','rhc');
		$t[$i]->options = array();		
			

			
			
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_button_back',
			'selector'	=> ".cit_rhc_rating_ .columbox a.back",
			'labels'	=> (object)array(
				'family'	=> __('Back','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_Back_default',
				'type'				=> 'css',
				'label'				=> __('Back default color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .columbox a.back',
				'property'			=> 'background-color',
				'real_time'			=> true
			);
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_Back_hover',
				'type'				=> 'css',
				'label'				=> __('Back hover color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .columbox a.back:hover',
				'property'			=> 'background-color',
				'real_time'			=> true
			);		
	
			
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_button_twitter',
			'selector'	=> ".cit_rhc_rating_ .columbox a.twitter",
			'labels'	=> (object)array(
				'family'	=> __('Twitter','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_twitter_default',
				'type'				=> 'css',
				'label'				=> __('Twitter default color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .columbox .btn-social-twitter',
				'property'			=> 'background-color',
				'real_time'			=> true
			);
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_twitter_hover',
				'type'				=> 'css',
				'label'				=> __('Twitter Hover color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .columbox .btn-social-twitter:hover',
				'property'			=> 'background-color',
				'real_time'			=> true
			);
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_twitter_icon',
				'type'				=> 'css',
				'label'				=> __('Twitter Icon color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .columbox .fui-twitter',
				'property'			=> 'color',
				'real_time'			=> true
			);
		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_button_facebook',
			'selector'	=> ".cit_rhc_rating_ .columbox a.facebook",
			'labels'	=> (object)array(
				'family'	=> __('Facebook','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_facebook_default',
				'type'				=> 'css',
				'label'				=> __('Facebook default color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .columbox .btn-social-facebook',
				'property'			=> 'background-color',
				'real_time'			=> true
			);
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_facebook_hover',
				'type'				=> 'css',
				'label'				=> __('Facebook Hover color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .btn-social-facebook:hover',
				'property'			=> 'background-color',
				'real_time'			=> true
			);
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_facebook_icon',
				'type'				=> 'css',
				'label'				=> __('Facebook Icon color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .fui-facebook',
				'property'			=> 'color',
				'real_time'			=> true
			);
		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_button_join',
			'selector'	=> ".cit_rhc_rating_ .columbox a.next.btn-primary",
			'labels'	=> (object)array(
				'family'	=> __('Submit','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));			
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_join_default',
				'type'				=> 'css',
				'label'				=> __('Submit default color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .columbox a.next.btn-primary',
				'property'			=> 'background-color',
				'real_time'			=> true
			);
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_join_hover',
				'type'				=> 'css',
				'label'				=> __('Submit Hover color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .columbox a.next.btn-primary:hover',
				'property'			=> 'background-color',
				'real_time'			=> true
			);
			
			
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= $box_prefix.'-view_box'; 
		$t[$i]->label 		= isset($label['view_box'])?$label['view_box']:__('Rating and Review Box','rhc');
		$t[$i]->options = array();			
			
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_commentheadtext',
			'selector'	=> ".cit_rhc_rating_ .commentheadtext",
			'labels'	=> (object)array(
				'family'	=> __('Title','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_textcomment',
			'selector'	=> ".cit_rhc_rating_ .textcomment",
			'labels'	=> (object)array(
				'family'	=> __('Content','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_timeClock',
			'selector'	=> ".cit_rhc_rating_ .timeClock",
			'labels'	=> (object)array(
				'family'	=> __('Date/Time','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_rating_view_stars_color',
				'type'				=> 'css',
				'label'				=> __('Stars color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rhc_rating_ .commentselect',
				'property'			=> 'color',
				'real_time'			=> true
		);
		
		
		
		
		
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= $box_prefix.'_alert_error-outer'; 
		$t[$i]->label 		= isset($label['outer'])?$label['outer']:__('Error Alert Box','rhc');
		$t[$i]->options = array();		
		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_alert_error_textcomment',
			'selector'	=> ".cit_rhc_rating_ .rhc_rating_alert_dialog .text",
			'labels'	=> (object)array(
				'family'	=> __('Text','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	

		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_alert_error_width',
				'type'				=> 'css',
				'label'				=> isset($label['image_width'])?$label['image_width']:__('Width','rhc'),
				'input_type'		=> 'number',
				'class'				=> 'input-mini',
				'unit'				=> '%',
				'min'				=> 0,
				'max'				=> 100,
				'step'				=> 1,
				'holder_class'		=> '',
				'selector'			=> ".cit_rhc_rating_ .alert-error",
				'property'			=> 'width',
				'other_options'		=> array(
					'transparent'	=> 'transparent'
				),				
				'real_time'			=> true
			);	
		
		$t[$i]->options = $this->add_padding_options($t[$i]->options,array(
			'prefix'	=> $box_prefix.'_alert_error_outer_pad',
			'selector'	=> ".cit_rhc_rating_ .alert-error"
		));				

		$t[$i]->options = $this->add_border_options($t[$i]->options,array(
			'prefix'	=> $box_prefix.'_alert_error_outer_border',
			'selector'	=> ".cit_rhc_rating_ .alert-error"
		));		
				
		$t[$i]->options = $this->add_border_radius_options($t[$i]->options,array(
			'prefix'	=> $box_prefix.'_alert_error_outer_radius',
			'selector'	=> ".cit_rhc_rating_ .alert-error"
		));		
	
		$t[$i]->options = $this->add_backgroud_options( $t[$i]->options, array(
			'label'		=> __('Background','rhc'),
			'prefix'	=> $box_prefix.'_alert_error_outer_bg',
			'selector'	=> ".cit_rhc_rating_ .alert-error"			
		));	

		
		
		
		
		
		
		
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= $box_prefix.'_alert_success-outer'; 
		$t[$i]->label 		= isset($label['outer'])?$label['outer']:__('Success Alert Box','rhc');
		$t[$i]->options = array();		
		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_alert_success_textcomment',
			'selector'	=> ".cit_rhc_rating_ .rhc_rating_success_dialog .text",
			'labels'	=> (object)array(
				'family'	=> __('Text','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	

		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_alert_success_width',
				'type'				=> 'css',
				'label'				=> isset($label['image_width'])?$label['image_width']:__('Width','rhc'),
				'input_type'		=> 'number',
				'class'				=> 'input-mini',
				'unit'				=> '%',
				'min'				=> 0,
				'max'				=> 100,
				'step'				=> 1,
				'holder_class'		=> '',
				'selector'			=> ".cit_rhc_rating_ .alert-success",
				'property'			=> 'width',
				'other_options'		=> array(
					'transparent'	=> 'transparent'
				),				
				'real_time'			=> true
			);	
		
		$t[$i]->options = $this->add_padding_options($t[$i]->options,array(
			'prefix'	=> $box_prefix.'_alert_success_outer_pad',
			'selector'	=> ".cit_rhc_rating_ .alert-success"
		));				

		$t[$i]->options = $this->add_border_options($t[$i]->options,array(
			'prefix'	=> $box_prefix.'_alert_success_outer_border',
			'selector'	=> ".cit_rhc_rating_ .alert-success"
		));		
				
		$t[$i]->options = $this->add_border_radius_options($t[$i]->options,array(
			'prefix'	=> $box_prefix.'_alert_success_outer_radius',
			'selector'	=> ".cit_rhc_rating_ .alert-success"
		));		
	
		$t[$i]->options = $this->add_backgroud_options( $t[$i]->options, array(
			'label'		=> __('Background','rhc'),
			'prefix'	=> $box_prefix.'_alert_success_outer_bg',
			'selector'	=> ".cit_rhc_rating_ .alert-success"			
		));	

								
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