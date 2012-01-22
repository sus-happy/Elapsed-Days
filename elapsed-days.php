<?php
/*
Plugin Name: Elapsed Days
Plugin URI: http://sus-happy.net
Description: View Elapsed Days
Author: SUSH
Version: 0.1
Author URI: http://sus-happy.net
*/

if( !class_exists( 'ElapsedDays' ) ){

	class ElapsedDays {

		var $VIEW_BORDER;
		var $VIEW_FORMAT;

		var $error_message;

		function ElapsedDays() {
			add_action( "admin_menu", array($this, "setMenu") );
		}

		/* #####################################
			Set Admin Menu
		##################################### */
		function setMenu() {
			add_options_page('Elapsed Days', 'Elapsed Days', 'manage_options', 'elapsed-days-options', array( $this, 'setParamaterView') );
		}

		/* #####################################
			Get Options Page Template
		##################################### */
		function setParamaterView() {
			require_once( dirname(__FILE__)."/template/options.php" );
		}

		/* #####################################
			Set Paramater
		##################################### */
		function setParamater() {
			$this->VIEW_BORDER	= get_option('ElapsedDaysBorderLine');
			$this->VIEW_FORMAT	= array(
				"t" => get_option('ElapsedDaysViewFormat'),
				"y" => get_option('ElapsedDaysViewFormatYear'),
				"m" => get_option('ElapsedDaysViewFormatMonth'),
				"d" => get_option('ElapsedDaysViewFormatDay')
			);
			if(
				empty( $this->VIEW_BORDER ) &&
				empty( $this->VIEW_FORMAT )
			) {
				$error_message[] = "Get Paramater Error";
				return FALSE;
			}

			return TRUE;
		}
		
		function setFormat($format) {
			$this->VIEW_FORMAT = $format;
		}

		function getElapsedDays($id) {
			$nDate = $this->getDateInfo();
			$pDate = $this->getDateInfo( get_the_time( "U", $id ) );

			$diff = array();
			
			/* Year */
			if( $nDate["m"] > $pDate["m"] )
				$diff["y"] = $nDate["y"] - $pDate["y"];
			else if( $nDate["m"] == $pDate["m"] ) {
				if( $nDate["d"] >= $pDate["d"] )
					$diff["y"] = $nDate["y"] - $pDate["y"];
				else
					$diff["y"] = $nDate["y"] - $pDate["y"] -1;
			} else
				$diff["y"] = $nDate["y"] - $pDate["y"] -1;

			/* Month */
			$month = 0;
			if( $nDate["m"] > $pDate["m"] )
				$month = $nDate["m"] - $pDate["m"];
			if( $nDate["m"] == $pDate["m"] ) {
				if( $nDate["y"] > $pDate["y"] && $nDate["d"] <= $pDate["d"] )
					$month = 12;
			} else
				$month = $nDate["m"] + ( 12-$pDate["m"] );
			if( $nDate["d"] <= $pDate["d"] )
				$month --;
			$diff["m"] = $month;

			/* Day */
			if( $nDate["d"] >= $pDate["d"] )
				$diff["d"] = $nDate["d"] - $pDate["d"];
			else
				$diff["d"] = $nDate["d"] + ( $pDate["t"] - $pDate["d"] );

			$result = array();

			if( $diff["y"] ) $result[] = str_replace("%y", $diff["y"], $this->VIEW_FORMAT["y"] );
			else $result[] = "";

			if( $diff["m"] ) $result[] = str_replace("%m", $diff["m"], $this->VIEW_FORMAT["m"] );
			else $result[] = "";

			if( $diff["d"] ) $result[] = str_replace("%d", $diff["d"], $this->VIEW_FORMAT["d"] );
			else $result[] = "";
			
			return str_replace( array("%y", "%m" ,"%d"), $result, $this->VIEW_FORMAT["t"] );
		}
		
		function getDateInfo( $time=NULL ) {
			if(! $time ) $time = time();
			return array(
				"y" => (int)date("Y", $time),
				"m" => (int)date("n", $time),
				"d" => (int)date("j", $time),
				"t" => (int)date("t", $time),
			);
		}
	}

} // END Class ElapsedDays

if( class_exists( 'ElapsedDays' ) ){
	global $ElDays;
	$ElDays = new ElapsedDays();

	function the_elapsedDays($format=NULL) {
		echo get_the_elapsedDays($format);
	}
	function get_the_elapsedDays($format=NULL) {
		global $ElDays;
		$id = get_the_ID();
		if(! empty( $id )  ) {
			if( $ElDays->setParamater() ) {
				if(! empty( $format ) )
					$ElDays->setFormat( $format );
				return $ElDays->getElapsedDays( $id );
			} else return $ElDays->error_message;
		}
		return FALSE;
	}
}