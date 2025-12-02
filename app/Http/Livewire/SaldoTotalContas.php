<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Conta;

class SaldoTotalContas extends Component
{   
    public $totalContas;

    public function mount(){

        $this->atualizarSaldo();
    }

    public function atualizarSaldo(){

        $this-> total = Conta::where('usuario_id', auth()->id())->sum('saldo');
    }


    public function render()
    {
        return view('livewire.saldo-total-contas');
    }
}
