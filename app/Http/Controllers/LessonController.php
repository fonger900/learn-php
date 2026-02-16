<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LessonController extends Controller
{
    public function show(Course $course, Lesson $lesson): Response
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
            ->each(function ($module) use ($completedLessons) {
                $module->lessons->each(function ($l) use ($completedLessons) {
                    if ($completedLessons->has($l->id)) {
                        $l->setRelation('pivot', $completedLessons->get($l->id)->pivot);
                    }
                });
            });

        if ($completedLessons->has($lesson->id)) {
            $lesson->setRelation('pivot', $completedLessons->get($lesson->id)->pivot);
        }

        return Inertia::render('Lessons/Show', [
            'course' => $course,
            'lesson' => $lesson,
            'modules' => $modules,
        ]);
    }

    public function complete(Request $request, $lesson): RedirectResponse
    {
        $lesson = Lesson::findOrFail($lesson);
        
        $request->user()->lessons()->syncWithoutDetaching([
            $lesson->id => ['completed_at' => now()]
        ]);
        
        return back();
    }
}
