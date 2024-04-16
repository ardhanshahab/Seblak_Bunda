<?php

namespace App\View\Components\Button;

use Illuminate\View\Component;

class ButtonIcon extends Component
{
 
    public $title,$icon,$route,$type;
    public function __construct($title,$icon,$route,$type)
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->route = $route;
        $this->type = $type;
    }

   
    public function render()
    {
        return view('components.button.button-icon');
    }
}
