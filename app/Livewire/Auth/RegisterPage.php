<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class RegisterPage extends Component
{
    public function render()
    {
        return view('auth.register-page')->layout('shared.auth');
    }
}
