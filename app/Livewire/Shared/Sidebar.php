<?php

namespace App\Livewire\Shared;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Sidebar extends Component
{ 
    public $user;
    public $recent;
    public $yesterday;
    public $previous;

    public function mount()
    {
        $this->user = User::find(auth()?->user()?->id);
        
        $this->recent = Chat::where(['user_id' => auth()?->user()?->id])->whereDate('created_at', '=', Carbon::today())->get();
        $this->yesterday = Chat::where(['user_id' => auth()?->user()?->id])->whereDate('created_at', '=',Carbon::yesterday())->get();
        $this->previous = Chat::where(['user_id' => auth()?->user()?->id])->whereDate('created_at', '<', Carbon::yesterday())->get();
    }
    public function render()
    {
        return view('shared.sidebar');
    }
}
