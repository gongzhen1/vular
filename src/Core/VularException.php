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
class VularException extends Exception
{
	public function __construct($messsage){
		parent::__construct($messsage);
	}
}