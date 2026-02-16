<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Inertia\Inertia;
use Inertia\Response;

class CourseController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Courses/Index', [
            'courses' => Course::withCount(['modules', 'lessons'])->get(),
        ]);
    }

    public function show(Course $course): Response
    {
        $course->load(['modules.lessons' => function ($query) {
            $query->orderBy('order');
        }]);

        return Inertia::render('Courses/Show', [
            'course' => $course,
        ]);
    }
}
