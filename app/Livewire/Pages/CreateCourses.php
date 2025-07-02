<?php

namespace App\Livewire\Pages;

use App\Http\Controllers\UploadController;
use App\Models\Course;
use Illuminate\Http\Request;
use Livewire\Component;

class CreateCourses extends Component
{

     public function delete($id){
       
        Course::find($id)->delete();

        toast('Deletion Successful','success');

        return redirect()->back();
     }
    public function create(Request $request)
    {
        Course::create([
            'image' => UploadController::UploadFile($request),
            'title'=> $request->title,
            'description'=> $request->description,
            'link'=> $request->link
        ]);

        toast('Course Created', 'success');

        return redirect()->back();
    }
    public function render()
    {
        return view('pages.create-courses')->layout('shared.main');
    }
}
