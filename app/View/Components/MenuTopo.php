<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MenuTopo extends Component
{
    
    public $topoInfo;

    public function __construct($topoInfo = '')
    {
        $this->topoInfo = $topoInfo;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menu-topo');
    }
}
