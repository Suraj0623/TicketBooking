<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OffersSection extends Component
{
    public $offers;
    public $colors;

    public function __construct($offers)
    {
        $this->offers = $offers;
        $this->colors = ['cyan', 'blue', 'green', 'orange', 'purple'];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.offers-section');
    }
}
