<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $user = $request->user();

        // Stats
        $enrolledCoursesCount = $user->courses()->count();
        $completedLessonsCount = $user->lessons()->count();
        
        // This is simplified. In a real app, you might track "total hours" via lesson duration metadata.
        // Assuming 1 hour per lesson for demo purposes.
        $totalHours = $completedLessonsCount * 1.5; 

        // Achievements could be a separate model/relation. Mocking count for now.
        $achievementsCount = floor($completedLessonsCount / 5);

        // Recent Activity (Last 5 completed or updated pivot records)
        $recentActivity = $user->lessons()
            ->with('module.course')
            ->orderByPivot('updated_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function (Lesson $lesson) {
                return [
                    'lesson' => $lesson->title,
                    'course' => $lesson->module->course->title,
                    'completed' => (bool) $lesson->pivot->completed_at,
                    'time' => $lesson->pivot->updated_at->diffForHumans(),
                ];
            });

        // Overall Progress per Enrolled Course
        $coursesProgress = $user->courses()
            ->withCount('lessons') // Total lessons in course
            ->get()
            ->map(function (Course $course) use ($user) {
                // Count completed lessons for this course
                // This query might be N+1 if not careful, but for dashboard (few courses) it's okay for now.
                // A better way is to use a subquery or join.
                // Let's use a simpler approach for clarity now, or optimize if needed.
                // Actually, we can get completed lessons ids for this user and filter.
                
                $completedCount = $user->lessons()
                    ->whereHas('module', function ($q) use ($course) {
                        $q->where('course_id', $course->id);
                    })
                    ->count();

                $total = $course->lessons_count ?: 1; // Avoid division by zero
                $percent = round(($completedCount / $total) * 100);

                return [
                    'title' => $course->title,
                    'percent' => $percent,
                ];
            });

        // Overall "Total" completion average
        $totalCompletion = $coursesProgress->avg('percent') ?? 0;

        return Inertia::render('Dashboard', [
            'stats' => [
                'coursesEnrolled' => $enrolledCoursesCount,
                'lessonsCompleted' => $completedLessonsCount,
                'totalHours' => $totalHours,
                'achievements' => $achievementsCount,
            ],
            'recentActivity' => $recentActivity,
            'coursesProgress' => $coursesProgress,
            'totalCompletion' => round($totalCompletion),
        ]);
    }
}
