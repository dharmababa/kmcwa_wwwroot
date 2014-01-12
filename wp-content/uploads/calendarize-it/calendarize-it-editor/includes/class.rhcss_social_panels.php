<?php

/**
 * 
 *
 * @version $Id$
 * @copyright 2003 
 **/

class rhcss_social_panels extends module_righthere_css{
	function rhcss_social_panels($args=array()){
		$args['cb_init']=array(&$this,'cb_init');
		return $this->module_righthere_css($args);
	}
	
	function cb_init(){
		//called on the head when editor is active.
	}
	
	function options($t=array()){
		$i = count($t);

		//-- HEAD --------------------------------			
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rhp-header'; 
		$t[$i]->label 		= __('Header','rhc');
		$t[$i]->options = array();		
		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> 'rhp_header_font',
			'selector'	=> 'body .cbp-spmenu h3',
			'labels'	=> (object)array(
				'family'	=> __('Header font','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options = $this->add_backgroud_options( $t[$i]->options, array(
			'label'		=> __('Background','rhc'),
			'prefix'	=> 'rhp_header_bg',
			'selector'	=> 'body .cbp-spmenu h3'	
		));		
		
		//-- Links --------------------------------			
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rhp-links'; 
		$t[$i]->label 		= __('Links','rhc');
		$t[$i]->options = array();		
		
		$t[$i]->options = $this->add_font_options( $t[$i]->options, array(
			'prefix'	=> 'rhp_body_font',
			'selector'	=> 'body .cbp-spmenu a, body .cbp-spmenu a:active',
			'labels'	=> (object)array(
				'family'	=> __('Links font','rhc'),
				'size'		=> __('Size','rhc'),
				'color'		=> __('Color','rhc')				
			)
		));	
		
		$t[$i]->options[] =	(object)array(
				'id'				=> 'rhp_body_border',
				'type'				=> 'css',
				'label'				=> __('Border color','rhc'),
				'input_type'		=> 'color_or_something_else',
				'holder_class'		=> '',
				'opacity'			=> true,
				'btn_clear'			=> true,
				'selector'			=> 'body .cbp-spmenu-vertical a',
				'property'			=> 'border-color',
				'real_time'			=> true
			);			
		
		$t[$i]->options = $this->add_backgroud_options( $t[$i]->options, array(
			'label'		=> __('Background','rhc'),
			'prefix'	=> 'rhp_links_bg',
			'selector'	=> 'body .cbp-spmenu a'	
		));	
		
		//-- Links rollover --------------------------------			
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rhp-links-hover'; 
		$t[$i]->label 		= __('Links hover','rhc');
		$t[$i]->options = array();	
		
		$t[$i]->options = $this->add_backgroud_options( $t[$i]->options, array(
			'label'		=> __('Background','rhc'),
			'prefix'	=> 'rhp_links_hover_bg',
			'selector'	=> 'body .cbp-spmenu a:hover'	
		));			
		//-- Body --------------------------------			
		$i++;
		$t[$i]=(object)array();
		$t[$i]->id 			= 'rhp-body'; 
		$t[$i]->label 		= __('Body','rhc');
		$t[$i]->options = array();	
		
		$t[$i]->options = $this->add_backgroud_options( $t[$i]->options, array(
			'label'		=> __('Background','rhc'),
			'prefix'	=> 'rhp_body_bg',
			'selector'	=> 'body .cbp-spmenu'	
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