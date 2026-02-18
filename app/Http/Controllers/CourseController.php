<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Inertia\Inertia;
use Inertia\Response;

class CourseController extends Controller
{
    public function index(): Response
    {
        $courses = Course::withCount(['modules', 'lessons', 'students'])
            ->get()
            ->map(function ($course) {
                $isEnrolled = false;
                if (auth()->check()) {
                    $isEnrolled = $course->students()->where('user_id', auth()->id())->exists();
                }

                return [
                    'id' => $course->id,
                    'title' => $course->title,
                    'slug' => $course->slug,
                    'description' => $course->description,
                    'level' => $course->level,
                    'modules_count' => $course->modules_count,
                    'lessons_count' => $course->lessons_count,
                    'students_count' => $course->students_count,
                    'estimated_hours' => $course->lessons_count * 1.5,
                    'is_enrolled' => $isEnrolled,
                ];
            });

        return Inertia::render('Courses/Index', [
            'courses' => $courses,
        ]);
    }

    public function show(Course $course): Response
    {
        $course->load(['modules.lessons' => function ($query) {
            $query->orderBy('order');
        }]);

        $totalLessons = $course->lessons()->count();
        $estimatedHours = round($totalLessons * 1.5);

        $isEnrolled = auth()->check()
            ? $course->students()->where('user_id', auth()->id())->exists()
            : false;

        $completedLessons = auth()->check()
            ? auth()->user()->lessons()
                ->whereHas('module', fn ($q) => $q->where('course_id', $course->id))
                ->count()
            : 0;

        $progress = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;

        return Inertia::render('Courses/Show', [
            'course' => array_merge($course->toArray(), [
                'total_lessons' => $totalLessons,
                'estimated_hours' => $estimatedHours,
                'is_enrolled' => $isEnrolled,
                'completed_lessons' => $completedLessons,
                'progress' => $progress,
            ]),
        ]);
    }
}
