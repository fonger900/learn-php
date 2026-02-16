<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return \Inertia\Inertia::render('Courses/Index', [
            'courses' => \App\Models\Course::query()
                ->withCount('modules', 'lessons') // Assuming Course hasManyThrough lessons
                ->get()
                ->map(fn($course) => [
                    'id' => $course->id,
                    'title' => $course->title,
                    'slug' => $course->slug,
                    'description' => $course->description,
                    'level' => $course->level,
                    'modules_count' => $course->modules_count,
                    // lessons_count would need a relationship on Course model or manual calculation
                ]),
        ]);
    }

    public function show(\App\Models\Course $course)
    {
        $course->load(['modules.lessons' => function ($query) {
            $query->orderBy('order');
        }]);

        return \Inertia\Inertia::render('Courses/Show', [
            'course' => $course,
        ]);
    }
}
