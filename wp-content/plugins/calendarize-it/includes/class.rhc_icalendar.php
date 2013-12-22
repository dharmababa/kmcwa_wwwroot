<?php

/**
 * 
 *
 * @version $Id$
 * @copyright 2003 
 **/
 
if (!function_exists("quoted_printable_encode")) {
	function quoted_printable_encode($string) {
	      $string = str_replace(array('%20', '%0D%0A', '%'), array(' ', "\r\n", '='), rawurlencode($string));
	      $string = preg_replace('/[^\r\n]{73}[^=\r\n]{2}/', "$0=\r\n", $string);
	
	      return $string;
	}
}

class events_to_vcalendar {
	var $events = array();
	var $dtend_is_exclusive = true;//google calendar and ical seem to treat it that way.
	var $gmt_offset = false;
	var $gmt_offset_seconds = false;
	var $tzid='';
	var $vtimezone='';
	var $skip_location=false;
	function events_to_vcalendar($events,$gmt_offset=false,$tzid='',$vtimezone='',$skip_location=false) {
		$this->events = $events;
		$this->tzid = $tzid;
		$this->vtimezone = $vtimezone;
		$this->skip_location = $skip_location;
		if(!empty($gmt_offset)){
			$this->gmt_offset = $gmt_offset;		
			$this->gmt_offset_seconds = $gmt_offset * 60 * 60 ;
		}
	}
	
	function get_vcalendar(){	
		ob_start();
?>
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//RIGHTHERE//CALENDARIZE IT V2.5//EN
<?php echo $this->get_vtimezone() ?>
<?php echo $this->get_vcalendar_body() ?>
END:VCALENDAR

<?php		
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
	
	function get_vtimezone(){
		return $this->vtimezone;
	}
	
	function get_vcalendar_body(){
		$properties = array(
			'UID'		=> 'id',
			'DTSTART'	=> 'start',
			'DTEND'		=> 'end',
			'SUMMARY'	=> 'title',
			'RRULE'		=> 'fc_rrule',
			'EXDATE'	=> 'fc_exdate',
			'RDATE'		=> 'fc_rdate',
			'URL'		=> 'url'
		);
		$str = "";
		
		if(!empty($this->events)){
			foreach($this->events as $event){

				$str .= "BEGIN:VEVENT\r\n";
				foreach( $properties as $property => $field ){
					$method = "_".strtolower($property);
					if(method_exists($this,$method)){
						$str.=$this->$method( $field, $property, $event );
					}
				}
				$str.= $this->get_location($event);
				$str.= "END:VEVENT\r\n";
				$str.= "\r\n";			
			}
		}
		
		return $str;
	}
	
	function get_location($event){
		if(isset($event['terms']) && is_array($event['terms']) && !empty($event['terms'])){
			foreach($event['terms'] as $term){
				if($term->taxonomy==RHC_VENUE){
					$out = '';
					if( ''!=trim($term->glat) && ''!=trim($term->glon) ){
						$out.=$this->vevent_row('GEO', sprintf('%s;%s',$term->glat,$term->glon) );
					}
	
					$value = empty( $term->gaddress )?$term->name:$term->gaddress;//googl cal seems to ignore GEO coordinates. so prefer gaddress here.				
					$value = html_entity_decode( $value, ENT_NOQUOTES, 'UTF-8'); 
					$out .= $this->vevent_row('LOCATION', $value);
					return $out;
				}
			}
		}
		return '';
	}
	
	function text_encode($text){
		return quoted_printable_encode($text);
	}
	
	function unencoded_text( $field, $property, $e ){
		if(!isset($e[$field]) || ''==trim( $e[$field] ) )return '';
		$value = html_entity_decode( $e[$field], ENT_NOQUOTES, 'UTF-8'); 
	//	$value = utf8_encode($value);
		return $this->vevent_row($property, $value );	
	}
	
	function datetime(  $field, $property, $e ){
		if(!isset($e[$field]))return '';
		$ts = strtotime($e[$field]);
		if(false==$ts||-1==$ts)return '';
		$tzid = isset($e['tzid']) && ''!=trim($e['tzid'])?trim($e['tzid']):$this->tzid;
		if(''!=$tzid){
			$property = $property.';TZID='.$tzid;
			$format = 'Ymd\THis';
		}else if(false!==$this->gmt_offset_seconds){
			$ts = $ts - $this->gmt_offset_seconds;
			$format = 'Ymd\THis\Z';
		}else{
			$format = 'Ymd\THis';
		}
		return $this->vevent_row($property, date( $format, $ts ) );
	}
	
	function allday_date( $field, $property, $e ){
		if(!isset($e[$field]))return '';
		$ts = strtotime($e[$field]);
		if($field=='end' && $this->dtend_is_exclusive && $e['fc_start']!=$e['fc_end']){
			$ts = $ts + 86400;//we use fc_end inclusive, whilst most ical implementation seem to do dtend exclusive.
		}
		if(false==$ts||-1==$ts)return '';
		return $this->vevent_row($property.';VALUE=DATE', date( 'Ymd', $ts ) );
	}
	
	function vevent_row($field,$value){
		return sprintf( "%s:%s\r\n", $field, $value );
	}
	
	function _uid( $field, $property, $e ){
		$arr = parse_url( site_url() );
		$id = $e['id'].'@'.$arr['host'];
		return $this->vevent_row($property, $id );
	}
	
	function _dtstart( $field, $property, $e ){
		return isset($e['allDay'])&&$e['allDay']? $this->allday_date( $field, $property, $e ) : $this->datetime(  $field, $property, $e );
	}
	
	function _dtend( $field, $property, $e ){
		return isset($e['allDay'])&&$e['allDay']? $this->allday_date( $field, $property, $e ) : $this->datetime(  $field, $property, $e );
	}
	
	function _rrule( $field, $property, $e ){
		if(!isset($e[$field]) || ''==trim( $e[$field] ) )return '';
		$e[$field]=rtrim($e[$field], ';');//remove ending semicolon
		return $this->vevent_row($property, $e[$field] );			
		//return $this->unencoded_text( $field, $property, $e );
	}
	
	function _exdate($field, $property, $e){
		if(!isset($e[$field]) || ''==trim( $e[$field] ) )return '';
		
		if( isset($e['allDay'])&&$e['allDay'] ){
			$dates = explode(',',$e[$field]);
			$new_dates = array();
			foreach($dates as $date){
				$ts = strtotime($date);
				$new_dates[]=date('Ymd',$ts);
			}	
			$e[$field] = implode(',',$new_dates);	
		}

		$tzid = isset($e['tzid']) && ''!=trim($e['tzid'])?trim($e['tzid']):$this->tzid;		
		if($tzid!=''){
			if( isset($e['allDay'])&&$e['allDay'] ){
			
			}else{
				$property = $property.';TZID='.$tzid;
			}
		}else if(false!==$this->gmt_offset_seconds){
			if( isset($e['allDay'])&&$e['allDay'] ){

			}else{
				$dates = explode(',',$e[$field]);
				$new_dates = array();
				foreach($dates as $date){
					$ts = strtotime($date) - $this->gmt_offset_seconds;
					$new_dates[]=date('Ymd\THis\Z',$ts);
				}	
				$e[$field] = implode(',',$new_dates);
			}
		}
		//----
		return $this->vevent_row($property, $e[$field] );
	}
	
	function _rdate($field, $property, $e){
		if(!isset($e[$field]) || ''==trim( $e[$field] ) )return '';
		//return sprintf( "%s;VALUE=DATE:%s\r\n", $property, $e[$field] );
		$tzid = isset($e['tzid']) && ''!=trim($e['tzid'])?trim($e['tzid']):$this->tzid;		
		if($tzid!=''){
			if( isset($e['allDay'])&&$e['allDay'] ){
			
			}else{
				$property = $property.';TZID='.$tzid;
			}
		}else if(false!==$this->gmt_offset_seconds){
			if( isset($e['allDay'])&&$e['allDay'] ){
			
			}else{
				$dates = explode(',',$e[$field]);
				$new_dates = array();
				foreach($dates as $date){
					$ts = strtotime($date) - $this->gmt_offset_seconds;
					$new_dates[]=date('Ymd\THis\Z',$ts);
				}	
				$e[$field] = implode(',',$new_dates);		
			}
		}
		//----
		return $this->vevent_row($property, $e[$field] );
	}
	
	function _summary( $field, $property, $e ){
		return $this->unencoded_text( $field, $property, $e );
		//return $this->vevent_row('SUMMARY', $this->text_encode( $e['title'] ) );
		//return sprintf( "SUMMARY;ENCODING=QUOTED-PRINTABLE:%s\r\n", $this->text_encode( $e['title'] ) );
	}
	
	function _url( $field, $property, $e ){
		return $this->unencoded_text( $field, $property, $e );
	}
	

}

?>