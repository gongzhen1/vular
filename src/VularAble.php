<?php
namespace Water\Vular;

interface VularAble{

	//返回一个VularNode对象，或者一个VularNode对象的数组 
	function toVular();
}