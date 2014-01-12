<?php

/**
 * 
 *
 * @version $Id$
 * @copyright 2003 
 **/

 
class rhcss_rsvp extends module_righthere_css{
	function rhcss_rsvp($args=array()){
		$args['cb_init']=array(&$this,'cb_init');
		return $this->module_righthere_css($args);
	}
	
	function cb_init(){
		//called on the head when editor is active.
	}
	
	function options($t=array()){
		$i = count($t);
		
		$box_prefix = 'rhcdb_rsvp';
		$box_selector = '.se-rsvpbox';	
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
		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_email',
			'selector'	=> ".cit_rsvp .checkbox",
			'labels'	=> (object)array(
				'family'	=> __('Subscription text','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= $box_prefix.'-form-box'; 
		$t[$i]->label 		= isset($label['form-box'])?$label['from-box']:__('Input items','rhc');
		$t[$i]->options = array();	
		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_forms',
			'selector'	=> ".cit_rsvp .form-control",
			'labels'	=> (object)array(
				'family'	=> __('Input fields','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
	
	
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_ss_forms_outer_hover',
				'type'				=> 'css',
				'label'				=> __('Hover border color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rsvp .form-group.focus .form-control, .cit_rsvp .form-control:focus',
				'property'			=> 'border-color',
				'real_time'			=> true
		);
		
		
		
		$t[$i]->options = $this->add_border_options($t[$i]->options,array(
			'prefix'	=> $box_prefix.'_forms_outer_border',
			'selector'	=> ".cit_rsvp .form-control"
		));		
				
		$t[$i]->options = $this->add_border_radius_options($t[$i]->options,array(
			'prefix'	=> $box_prefix.'_forms_outer_radius',
			'selector'	=> ".cit_rsvp .form-control"
		));	
		
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= $box_prefix.'-answer-box'; 
		$t[$i]->label 		= isset($label['answer-box'])?$label['answer-box']:__('Attending Status','rhc');
		$t[$i]->options = array();	
		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_answer_box_title',
			'selector'	=> "$box_selector .fe-extrainfo-holder .rsvp_namespace:not(.rsvp_smallnamespace)",
			'labels'	=> (object)array(
				'family'	=> __('Title','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc'),				
			)
		));	
		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_answer_box_text',
			'selector'	=> "$box_selector .fe-extrainfo-holder .rsvp_smallnamespace",
			'labels'	=> (object)array(
				'family'	=> __('Text','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_answer_box_bobble',
			'selector'	=> ".cit_rsvp  .rsvp_number",
			'labels'	=> (object)array(
				'family'	=> __('Bubble','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_answer_box_bobble_bg',
				'type'				=> 'css',
				'label'				=> __('Bubble bg','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rsvp .rsvp_number',
				'property'			=> 'background-color',
				'real_time'			=> true
			);
			
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_answer_box_icon_bg',
				'type'				=> 'css',
				'label'				=> __('Icon bg','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rsvp .rsvp_object',
				'property'			=> 'color',
				'real_time'			=> true
			);
			
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_answer_box_yes_defulat',
				'type'				=> 'css',
				'label'				=> __('Yes default color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rsvp .cit_rsvpselect li:nth-child(1)',
				'property'			=> 'background-color',
				'real_time'			=> true
			);
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_answer_box_yes_hover',
				'type'				=> 'css',
				'label'				=> __('Yes hover color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rsvp .cit_rsvpselect li:nth-child(1):hover ',
				'property'			=> 'background-color',
				'real_time'			=> true
			);	
	
		$t[$i]->options[] =(object)array(
				'id'				=> $box_prefix.'_answer_box_maybe_defulat',
				'type'				=> 'css',
				'label'				=> __('Maybe default color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rsvp .cit_rsvpselect li:nth-child(2)',
				'property'			=> 'background-color',
				'real_time'			=> true
			);		
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_answer_box_maybe_hover',
				'type'				=> 'css',
				'label'				=> __('Maybe Hover color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rsvp .cit_rsvpselect li:nth-child(2):hover',
				'property'			=> 'background-color',
				'real_time'			=> true
			);	
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_answer_box_no_defulat',
				'type'				=> 'css',
				'label'				=> __('No default color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rsvp .cit_rsvpselect li:nth-child(3)',
				'property'			=> 'background-color',
				'real_time'			=> true
			);
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_answer_box_no_hover',
				'type'				=> 'css',
				'label'				=> __('No Hover color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rsvp .cit_rsvpselect li:nth-child(3):hover',
				'property'			=> 'background-color',
				'real_time'			=> true
			);
		
			
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= $box_prefix.'-button_controle'; 
		$t[$i]->label 		= isset($label['answer-box'])?$label['answer-box']:__('Buttons','rhc');
		$t[$i]->options = array();			
			
			
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_button_twitter',
			'selector'	=> ".cit_rsvp .columbox a.twitter",
			'labels'	=> (object)array(
				'family'	=> __('Twitter','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_twitter_defulat',
				'type'				=> 'css',
				'label'				=> __('Twitter default color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rsvp .btn-social-twitter',
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
				'selector'			=> '.cit_rsvp .btn-social-twitter:hover',
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
				'selector'			=> '.cit_rsvp .fui-twitter',
				'property'			=> 'color',
				'real_time'			=> true
			);
		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_button_facebook',
			'selector'	=> ".cit_rsvp .columbox a.facebook",
			'labels'	=> (object)array(
				'family'	=> __('Facebook','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_facebook_defulat',
				'type'				=> 'css',
				'label'				=> __('Facebook default color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rsvp .btn-social-facebook',
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
				'selector'			=> '.cit_rsvp .btn-social-facebook:hover',
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
				'selector'			=> '.cit_rsvp .fui-facebook',
				'property'			=> 'color',
				'real_time'			=> true
			);
		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> $box_prefix.'_button_join',
			'selector'	=> ".cit_rsvp .columbox a.next",
			'labels'	=> (object)array(
				'family'	=> __('Join','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));			
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_join_defulat',
				'type'				=> 'css',
				'label'				=> __('Join default color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rsvp .btn.btn-primary',
				'property'			=> 'background-color',
				'real_time'			=> true
			);
		
		$t[$i]->options[] = (object)array(
				'id'				=> $box_prefix.'_button_join_hover',
				'type'				=> 'css',
				'label'				=> __('Join Hover color','rhc'),
				'input_type'		=> 'colorpicker',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> '.cit_rsvp .btn.btn-primary:hover',
				'property'			=> 'background-color',
				'real_time'			=> true
			);
		
		
								
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