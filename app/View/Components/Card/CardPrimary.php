<?php

namespace App\View\Components\Card;

use Illuminate\View\Component;

class CardPrimary extends Component
{
    protected $title,$action;
    public function __construct($title,$action)
    {
        $this->title = $title;
        $this->action = $action;
    }

    public function render()
    {
        return view('components.card.card-primary');
    }
}
