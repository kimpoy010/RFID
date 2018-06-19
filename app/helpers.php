<?php
	
	if (!function_exists('ordinal')) {
		function ordinal($number) {
		    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
		    if ((($number % 100) >= 11) && (($number%100) <= 13))
		        return $number. 'th';
		    else
		        return $number. $ends[$number % 10];
		} 
	}

	if (!function_exists('titleCase')) {
		function titleCase($string) {
		   return str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($string))));
		} 
	}

	if (!function_exists('acronym')) {
		function acronym($string){
			$words = explode(" ", $string);
			$acronym = "";

		foreach ($words as $w) {
		  $acronym .= $w[0];
		}

		return $acronym;
		}

	}

	if (!function_exists('deleteFirstChar')) {
		function deleteFirstChar( $string ) {
			return substr( $string, 1 );
		}
	}

	

?>