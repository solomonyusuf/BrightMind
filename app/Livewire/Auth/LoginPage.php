<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class LoginPage extends Component
{
    public function render()
    {
        return view('auth.login-page')->layout('shared.auth');
    }
}
