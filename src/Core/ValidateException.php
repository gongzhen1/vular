<?php
/* ===========================================================================
 * 
 *
 * 
 * =========================================================================== */

namespace Water\Vular\Core;

use Exception;

/**
 * Security exception class
 */
class ValidateException extends Exception
{
	public $errors;
	public function __construct($errors){
		$this->errors = $errors;
	}
}