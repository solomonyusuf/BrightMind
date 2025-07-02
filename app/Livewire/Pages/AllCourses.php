<?php

namespace App\Livewire\Pages;

use App\Models\Course;
use Livewire\Component;

class AllCourses extends Component
{
    public $videos;

    public function mount()
    {
        $this->videos  = Course::get();
    }
    public function render()
    {
        return view('pages.all-courses')->layout('shared.main');
    }
}
