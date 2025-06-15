<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class ChatPage extends Component
{
    public function render()
    {
        return view('pages.chat-page')->layout('shared.main');
    }
}
