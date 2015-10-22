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

	
/**
 * 
 * @param unknown $array
 * @return boolean|Ambigous <multitype:, multitype:unknown >
 */
function array_flatten($x) 
{
	if (!is_array($x)) 
		return FALSE;
	
	$result = array();
	foreach ($x as $key => $val) 
		if (is_array($val)) 
			$result = array_merge($result, array_flatten($val));		
		else 
			$result[$key] = $val;

	return $result;
}

/**
 * Finds out wheter a given array is multidimensional or not
 * 
 * @param unknown $x
 * @return boolean
 */
function is_multidim($x) 
{
	/* checks for every argument of the array if it is an array too
	 * to find out whether is a multidimensional array or not */
	foreach ($x as $value)
		if (is_array($value))
			return true;
		
	// if the loop finishes there are no array inside the given one
	return false;
}

/**
 * Removes all NULL values from the given $x variable
 * 
 * @param unknown $x
 */
function null_rm($x) 
{
	if(is_array($var))
		
		$new_x = array();
		
	return $new_x;
}

?>