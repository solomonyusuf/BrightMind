<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class ResetPage extends Component
{
    public function render()
    {
        return view('auth.reset-page')->layout('shared.auth');
    }
}
