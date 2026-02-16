<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function show(\App\Models\Course $course, \App\Models\Lesson $lesson)
    {
        return \Inertia\Inertia::render('Lessons/Show', [
            'course' => $course,
            'lesson' => $lesson,
            'modules' => $course->modules()->with('lessons')->orderBy('order')->get(),
        ]);
    }

    public function complete(\Illuminate\Http\Request $request, \App\Models\Lesson $lesson)
    {
        $request->user()->lessons()->syncWithoutDetaching([$lesson->id => ['completed_at' => now()]]);
        
        return back();
    }
}
