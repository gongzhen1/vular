<?php
namespace Water\Vular\Admin;
use Water\Vular\Elements\Authable;

class BatchMenuItem {
    use Authable;
    public function __construct($icon, $label, $action){
        $this->icon = $icon;
        $this->label = $label;
        $this->action = $action;
    }
}