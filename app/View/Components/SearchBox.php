<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchBox extends Component
{
    public $searchRoute;
    public $placeholder;

    public function __construct($searchRoute, $placeholder = 'Search...')
    {
        $this->searchRoute = $searchRoute;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search-box');
    }
}
