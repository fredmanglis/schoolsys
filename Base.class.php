<?php


Class base {
	
	private $uniqueID;
	
	function setUniqueID( $uniqueID ) {
		
		$this -> uniqueID = $uniqueID;
	
	}
	
	function getUniqueID() {
		
		return $this -> uniqueID;
	
	}

	function genUniqueID( $length = 5, $seed = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' ) {
		
		$returnValue = '00000';

			for( $i = 0; $i < $length; $i++ ) {
		
				$returnValue[ $i ] = $seed[ rand( 0, strlen( $seed ) - 1 ) ];

			}
		
		return $returnValue;
			
	}

	function __construct( $uniqueID = "00000" ) {
		
		if( $uniqueID == "00000" ) {
			
			// No unique ID was passed, this is a new record, generate a new one
			
			$this -> setUniqueID( $this -> genUniqueID() );
		
		}
		else {
			
			// A unique ID was passed, set it
			
			$this -> setUniqueID( $uniqueID );
		
		}
	
	}

}


?>
