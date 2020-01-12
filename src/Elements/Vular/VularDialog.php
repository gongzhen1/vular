<?php
namespace Water\Vular\Elements\Vular;

use Water\Vular\Elements\VularNode;

class VularDialog extends VularNode{
	use AuthorityCheck;
    public function __construct(){
        parent::__construct();
        $this->name = getbase(__CLASS__);
        //$this->pageid = vularize(get_called_class());
        //$this->props('vularId', $vid ? $vid:uniqid('vid'));
 	}

	function width($value){
		return $this->props(__FUNCTION__, $value);
	}


}