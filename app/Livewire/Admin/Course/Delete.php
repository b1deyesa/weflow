<?php

namespace App\Livewire\Admin\Course;

use App\Models\Course;
use Livewire\Component;

class Delete extends Component
{
    public Course $course;
    
    public function close()
    {
        $this->dispatch('reload-page');
    }
    
    public function destroy()
    {
        $this->course->delete();
        
        return redirect(route('admin.course.index'))->with('success','Success delete course');
    }
    
    public function render()
    {
        return view('livewire.admin.course.delete');
    }
}
