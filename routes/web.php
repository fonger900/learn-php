<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Models\Course;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Fortify\Features;

Route::get('/', function (): Response {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
        'courses' => Course::latest()->take(3)->get(),
    ]);
})->name('home');

Route::get('dashboard', function (): Response {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{course:slug}/lessons/{lesson:slug}', [LessonController::class, 'show'])->name('lessons.show');
    Route::post('/lessons/{lesson}/complete', [LessonController::class, 'complete'])->name('lessons.complete');
});

require __DIR__ . '/settings.php';
