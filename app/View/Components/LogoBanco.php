<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LogoBanco extends Component
{
    public $banco;

    public function __construct($banco){

        $this->banco = $banco;
    }
    public function render()
    {
        return view('components.logo-banco');
    }
}
