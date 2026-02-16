<?php

use App\Models\Course;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
        'courses' => Course::latest()->take(3)->get(),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/courses', [\App\Http\Controllers\CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course:slug}', [\App\Http\Controllers\CourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{course:slug}/lessons/{lesson:slug}', [\App\Http\Controllers\LessonController::class, 'show'])->name('lessons.show');
    Route::post('/lessons/{lesson}/complete', [\App\Http\Controllers\LessonController::class, 'complete'])->name('lessons.complete');
});

require __DIR__ . '/settings.php';
