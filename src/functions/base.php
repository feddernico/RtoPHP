<?php

/**
 * The core functions of RtoPHP
 *
 * @category   Zend
 * @package    RtoPHP
 * @subpackage Wand
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    $Id:$
 * @link       http://framework.zend.com/package/PackageName
 * @since      File available since Release 1.5.0
 */

/* Includes: */
include_once 'util.php';

/* Functions: */
/**
 * 
 * 
 * @param unknown $x
 * @param unknown $y
 * @param unknown $null_rm
 */
function covariance($x, $y, $null_rm = FALSE) 
{    
    // flatten the two arrays if they are
    if(is_multidim($x))
        array_flatten($x);
    
    if(is_multidim($y))
        array_flatten($y);
    
    if(sizeof($x) != sizeof($y)) {
        trigger_error('Warning message in mean(...): $x and $y do not have same'
            . ' dimensions.', E_USER_ERROR);
        return NULL;
    }
        
    $mean_x = mean($x, 1, $null_rm);
    $mean_y = mean($y, 1, $null_rm);
    
    echo "mean x: " . $mean_x . "<br>";
    echo "mean y: " . $mean_y . "<br>";
    
    $temp_calc = 0;
    
    foreach($x as $val_x) 
        foreach($y as $val_y)
            $temp_calc += (($val_x - $mean_x) * ($val_y - $mean_y));
        
    return $temp_calc / sizeof($x);
}

 /**
  * Calculates the mean of the given data
  * 
  * 
  * 
  * @param unknown $x
  * @param number $trim
  * @param string $null_rm
  * @return NULL|number|Ambigous <boolean, Ambigous>
  */
function mean($x, $trim = 1, $null_rm = false) 
{
    // if there are NULL values return NULL
    if(in_array(NULL, $x) && !$null_rm)
        return NULL;
	
	// $sum starts with 0
	$sum = 0;
	
	// checks if the given argument is an array
	if(is_array($x)) {
		
		// if $trim is not numeric return NULL with a error
		if(!is_numeric($trim)) {
			trigger_error('Error message in mean(...): $trim must be '
					. 'numeric of length one', E_USER_ERROR);
			return NULL;
		}
	
		// if $x is multidimensional, it will be flattened
		if(is_multidim($x))
		    $x = array_flatten($x);
		
		// if $null_rm is equal to TRUE removes NULL values
		if($null_rm)
		     $x = array_filter($x);
		
		$n = sizeof($x);
		$p = 100;
		/* if $trim is in a valid percentage range (0, 1) gets the
		 * porportion $P */
		if($trim > 0 && $trim < 1) {
	
		    sort($x);
			// calculates the first index to be extracted from the original $x
			$k = floor( ($n * $trim) / 2 );
	        // returns the trimmed mean		
			return ( sum( array_slice($x, $k, $n-$k-1), $null_rm) / ($n - (2*$k)) );
		}
		return (sum($x, $null_rm) / $n);
			
	} else if(is_numeric($x) || is_bool($x))
		return $x;
	else {
		trigger_error('Warning message:\r\n In mean(...):\r\n $x: ' . $x . 
				' is not numeric or logic: NULL returned', E_WARNING);
		return NULL;
	}
}

/**
 * Calculates the median of the given data
 * 
 * @param unknown $x
 * @param string $null_rm
 * @return NULL|array|number
 */
function median($x, $null_rm = FALSE) 
{
    // if there are NULL values return NULL
    if(in_array(NULL, $x) && !$null_rm)
        return NULL;
    
    sort($x);
    
    $x = array_unique($x);
    
    $i = sizeof($x) / 2;
    // if the length of $x is an even number
    if(sizeof($x) % 2 != 0)
        return $x[ ceil($i) ];
    
    return ( ($x[$i-1] + $x[$i]) / 2 );
}

function mode($x) 
{
    // if $x 
    if(is_numeric($x) || is_bool($x))
        return $x;
    
    // if $x is multidimensional it flattens the former
    if(is_multidim($x))
        $x = array_flatten($x);
    
    $values = array_count_values($valueArray);
    $mode = array_search(max($values), $values);
}

/**
 * Calculates the sum of all values containes in $x
 * 
 * @param unknown $x
 * @param string $null_rm
 * @return Ambigous <number, boolean, Ambigous>
 */
function sum($x, $null_rm = FALSE) 
{
    // if there are NULL values return NULL
    if(in_array(NULL, $x) && !$null_rm)
        return NULL;
    
	// $sum starts from 0
	$sum = 0;
	$values = $x;
	
	// if $x is multidimensional it flattens the former
	if(is_multidim($x))
		$x = array_flatten($x);

	// if $null_rm is equal to TRUE removes NULL values
	if($null_rm)
	    $x = array_filter($x);
	
	// sums all the $x values
	foreach($x as $val) 
		$sum += $val;
	
	return $sum;
}

/**
 * Calculates the standard deviation of the given data
 * 
 * @param unknown $x
 * @param string $null_rm
 */
function sd($x, $null_rm = FALSE) 
{ 
    // if there are NULL values return NULL
    if(in_array(NULL, $x) && !$null_rm)
        return NULL;
    
    return sqrt(variance($x, $null_rm)); 
}

/**
 * Calculates the variance
 * 
 * @param unknown $x
 * @param string $na_rm
 */
function variance($x, $null_rm = FALSE) 
{   
    // if there are NULL values return NULL
    if(in_array(NULL, $x) && !$null_rm)
        return NULL;
    
	$mean = mean($x, 1, $null_rm);
    $temp_calc = 0;
	
    // if $x is multidimensional it flattens the former
	if(is_multidim($x))
	    array_flatten($x);
	
	// calculates the sum of squared deviations from the mean
	foreach($x as $val)	    
	    $temp_calc += pow(($val - $mean), 2);

	return $temp_calc / (sizeof($x) - 1);
} 

?>