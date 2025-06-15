<?php

namespace App\Livewire\Shared;

use App\Models\User;
use Livewire\Component;

class Sidebar extends Component
{
    public $user;

    public function mount()
    {
        $this->user = User::find(auth()?->user()?->id);
    }
    public function render()
    {

        return view('shared.sidebar');
    }
}
