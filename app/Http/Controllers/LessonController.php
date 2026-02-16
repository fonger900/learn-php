<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function show(\App\Models\Course $course, \App\Models\Lesson $lesson)
    {
        $user = auth()->user();
        
        $completedLessons = $user->lessons()
            ->wherePivotIn('lesson_id', $course->lessons->pluck('id'))
            ->get()
            ->keyBy('id');

        $modules = $course->modules()
            ->with('lessons')
            ->orderBy('order')
            ->get()
            ->map(function ($module) use ($completedLessons) {
                $module->lessons->each(function ($l) use ($completedLessons) {
                    if ($completedLessons->has($l->id)) {
                        $l->setRelation('pivot', $completedLessons->get($l->id)->pivot);
                    }
                });
                return $module;
            });

        // Also attach pivot to the main lesson if completed
        if ($completedLessons->has($lesson->id)) {
            $lesson->setRelation('pivot', $completedLessons->get($lesson->id)->pivot);
        }

        return \Inertia\Inertia::render('Lessons/Show', [
            'course' => $course,
            'lesson' => $lesson,
            'modules' => $modules,
        ]);
    }

    public function complete(\Illuminate\Http\Request $request, $lesson)
    {
        $lesson = \App\Models\Lesson::findOrFail($lesson);
        $request->user()->lessons()->syncWithoutDetaching([$lesson->id => ['completed_at' => now()]]);
        
        return back();
    }
}
